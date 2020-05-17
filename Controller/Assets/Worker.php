<?php
/**
 * Return a Service worker for push notification
 *
 * @category Class
 * @package  Sw
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
namespace Cleverpush\WebPush\Controller\Assets;

use Magento\Framework\Controller\ResultFactory;

/**
 * ServiceWorker Class
 *
 * @category Class
 * @package  ServiceWorker
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */

class Worker extends \Magento\Framework\App\Action\Action
{
    /**
     * ServiceWorker constructor.
     *
     * @param Context              $context     context
     * @param ScopeConfigInterface $scopeConfig to get config json
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
    
    /**
     * Return ServiceWorker code for push notification if config found
     *
     * @return \Magento\Framework\Controller\ResultFactory
     */
    public function execute()
    {
        $channelId = $this->scopeConfig->getValue(
            'corecleverpush/settings/channel_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $swContent = '';
        
        if (!empty($channelId)) {
            $sw = "https://static.cleverpush.com/channel/worker/$channelId.js";
            $swContent = "importScripts('$sw');";
        }
        
        $outputData = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        return $outputData->setHeader('Content-Type', 'application/javascript')
            ->setHeader('Service-Worker-Allowed', '/')->setContents($swContent);
    }
}
