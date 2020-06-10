<?php
/**
 * Cinovic Technologies LLP.
 *
 * @category  Cinovic
 * @package   Cinovic_Whatsapp
 * @author    Cinovic
 * @copyright Copyright (c) Cinovic Technologies LLP (https://cinovic.com)
 * @license   https://store.cinovic.com/license.html
 */
namespace  Cinovic\Whatsapp\Block;

/**
 * Class Whatsappchat
 * @package Cinovic\Whatsapp\Block\Adminhtml
 */
class Whatsappchat extends \Magento\Framework\View\Element\Template
{
    const CONFIG_ENABLED = 'whatsapp/general/enabled';
    const CONFIG_LOGO = 'whatsapp/general/logo';
    const CONFIG_CLOSE = 'whatsapp/general/closebutton';
    const CONFIG_BUTTON_TYPE = 'whatsapp/general/button_type';
    const CONFIG_TOP = 'whatsapp/general/top';
    const CONFIG_LEFT = 'whatsapp/general/left';
    const CONFIG_RIGHT = 'whatsapp/general/right';
    const CONFIG_BOTTOM = 'whatsapp/general/bottom';
    const CONFIG_NUMBER = 'whatsapp/general/number';
    const CONFIG_CUS_MSG = 'whatsapp/general/custom_message';

    /**
     * Whatsappchat constructor.
     * @param MagentoBackendBlockWidgetContext           $context
     * @param MagentoStoreModelStoreManagerInterface     $storeManager
     * @param CinovicWhatsappModelWhatsappmessageFactory $whatsappmessageCollection
     * @param MagentoFrameworkRegistry                   $registry
     * @param array                                      $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Cinovic\Whatsapp\Model\WhatsappmessageFactory $whatsappmessageCollection,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_scopeConfig = $context;
        $this->_coreRegistry = $registry;
        $this->_whatsappmessageCollection = $whatsappmessageCollection;
        parent::__construct($context, $data);
    }

    /**
     * @param  String $config_path
     * @return string
     */
    public function getConfig($config_path)
    {
        return $this->_scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getWhatsappchat(){
        $mobile = $this->getConfig(self::CONFIG_NUMBER);
        $custom_message = $this->getConfig(self::CONFIG_CUS_MSG);
        $chatdata = $mobile."&text=" .$custom_message;
        return $chatdata;
    }

    /**
     * @param  String $image
     * @return string
     */
    public function getImageUrl($image){
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . "whatsapp/logo/".$image;
    }

    /**
     * @return array
     */
    public function getWhatsappUrl()
    {
        $custom_message = $this->getConfig(self::CONFIG_CUS_MSG);
        $data = [];

        try {
            $datacollection = $this->_whatsappmessageCollection->create()->getCollection()
                ->addFieldToFilter('disable_enable', ['eq' => '1']);

            if ($datacollection->count() > 0) {
                foreach ($datacollection as $value) {
                    $number = str_replace("+", "", $value['number']);
                    if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])) {
                        $message = urlencode($custom_message);
                        $number = str_replace("+", "", $number);
                        if (preg_match('/(Chrome|CriOS)\//i', $_SERVER['HTTP_USER_AGENT'])
                            && !preg_match('/(Aviator|ChromePlus|coc_|Dragon|Edge|Flock|Iron|Kinza|Maxthon|MxNitro|Nichrome|OPR|Perk|Rockmelt|Seznam|Sleipnir|Spark|UBrowser|Vivaldi|WebExplorer|YaBrowser)/i', $_SERVER['HTTP_USER_AGENT'])) {
                            $hrefurl = "https://wa.me/$number/?text=$message";
                            $whatsappurl['url'] = "<a href='" . $hrefurl . "'  class='whatsappPersonAccount'>";
                        } else {
                            $hrefurl = "https://wa.me/$number";
                            $whatsappurl['url'] = "<a href='" . $hrefurl . "'  class='whatsappPersonAccount'>";
                        }
                    } else {
                        $weburl = "https://web.whatsapp.com/send?l=en&phone=" . $number . "&text=" . $custom_message;
                        $whatsappurl['url'] = "<a href='" . $weburl . "' target='_blank' class='whatsappPersonAccount'>";
                    }
                    $whatsappurl['name'] = $value['name'];
                    $whatsappurl['image_url'] = $value['image_url'];
                    $whatsappurl['department_name'] = $value['department_name'];
                    $whatsappurl['custom_message'] = $value['custom_message'];
                    array_push($data, $whatsappurl);
                }
            } else {
                $whatsappurl['url'] = '';
                $whatsappurl['name'] = '';
                $whatsappurl['image_url'] = '';
                $whatsappurl['department_name'] = '';
                $whatsappurl['custom_message'] = '';
                array_push($data, $whatsappurl);
            }
        } catch (\Exception $e) {

        }
        return $data;
    }
}
