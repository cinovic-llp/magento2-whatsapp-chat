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
namespace Cinovic\Whatsapp\Block\Adminhtml\Personlist\Helper\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
		protected $_storeManager;
    protected $_whatsappmessageCollection;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Cinovic\Whatsapp\Model\WhatsappmessageFactory $whatsappmessageCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_whatsappmessageCollection = $whatsappmessageCollection;
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        $image = $this->_whatsappmessageCollection->create()->load($row->getId());
        $srcImage = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $image->getImageUrl();
          return '<image width="50" src ="'.$srcImage.'" alt="'.$image->getImagePhoto().'" />';
    }
}
