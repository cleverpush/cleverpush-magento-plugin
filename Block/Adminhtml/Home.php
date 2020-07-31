<?php
/**
 * Home block cleverpush for admin panel and frontend
 *
 * @category Class
 * @package  Home
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
namespace Cleverpush\WebPush\Block\Adminhtml;

/**
 * Home block
 *
 * @category Class
 * @package  Home
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
class Home extends \Magento\Framework\View\Element\Template
{
    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context                $context     context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig get config
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }
    
    /**
     * Get cleverpush config
     *
     * @return $cleverpushConfig
     */
    public function getChannelId()
    {
          $path = "corecleverpush/settings/channel_id";
          $channelId = $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
          return $channelId;
    }
    
    /**
     * Get cleverpush script disabled
     *
     * @return boolean
     */
    public function getScriptDisabled()
    {
          $path = "corecleverpush/settings/script_disabled";
          $scriptDisabled = $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
          return !empty($scriptDisabled) && $scriptDisabled;
    }

    /**
     * Add block on frontend
     *
     * @return The JavaScript
     */
    public function cleverpushJs()
    {
        $channelId = $this->getChannelId();
        $scriptDisabled = $this->getScriptDisabled();
        if (!empty($channelId) && !$scriptDisabled) {
            return "https://static.cleverpush.com/channel/loader/$channelId.js";
        }
        return '';
    }
}
