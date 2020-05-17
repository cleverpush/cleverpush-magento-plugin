<?php
/**
 * CleverPush admin panel
 *
 * @category Class
 * @package  Register
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
namespace Cleverpush\WebPush\Controller\Adminhtml\Home;

/**
 * Index Class
 *
 * @category Class
 * @package  Index
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context        $context           context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory resultfactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
         parent::__construct($context);
         $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/cleverpushadmin_home_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
         return  $resultPage = $this->resultPageFactory->create();
    }
}
