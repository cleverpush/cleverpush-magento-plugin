<?php
/**
 * Register cleverpush for magento website
 *
 * @category Class
 * @package  Register
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
namespace Cleverpush\WebPush\Controller\Adminhtml\Home;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\Client\Curl;

/**
 * Register Config Class
 *
 * @category Class
 * @package  Register
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
class Register extends \Magento\Backend\App\Action
{
    /**
     * Config constructor.
     *
     * @param Context                 $context           context
     * @param WriterInterface         $configSave        save config
     * @param TypeListInterface       $cacheTypeList     cacheType
     * @param CacheFrontendPool       $cacheFrontendPool cacheFrontend
     * @param ProductMetadataInterface       $productMetaData productMetaData
     * @param ResultFactory           $resultFactory     ResultFactory
     * @param Curl                    $curl              curl request
     * @param MessageManagerInterface $messageManager    successMessage
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Config\Storage\WriterInterface $configSave,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\App\ProductMetadataInterface $productMetaData,
        Curl $curl
    ) {
        $this->resultFactory = $context->getResultFactory();
        $this->configSave= $configSave;
        $this->messageManager = $context->getMessageManager();
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        $this->productMetaData = $productMetaData;
        $this->curl= $curl;
        parent::__construct($context);
    }
    
    /**
     * Register cleverpush config json
     *
     * @return \Magento\Framework\Controller\ResultFactory
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        
        if (!empty($post['channelId'])) {
            $channelId = $post['channelId'];
            $scriptDisabled = !empty($post['scriptDisabled']) ? true : false;

            $this->configSave->save('corecleverpush/settings/channel_id', $channelId);
            $this->configSave->save('corecleverpush/settings/script_disabled', $scriptDisabled);

            $this->messageManager->addSuccess(__("CleverPush settings successfully saved"));

            $types = ['config'];
            foreach ($types as $type) {
                $this->cacheTypeList->cleanType($type);
            }
            foreach ($this->cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }
        }
 
        $url = $this->_redirect->getRefererUrl();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($url);
        return $resultRedirect;
    }
}
