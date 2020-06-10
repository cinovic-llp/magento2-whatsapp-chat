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
namespace Cinovic\Whatsapp\Block\Adminhtml\Personlist;

/**
 * Class Edit
 * @package Cinovic\Whatsapp\Block\Adminhtml\Personlist
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     * @param MagentoBackendBlockWidgetContext $context
     * @param MagentoFrameworkRegistry         $registry
     * @param array                            $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Cinovic_Whatsapp';
        $this->_controller = 'adminhtml_personlist';
        parent::_construct();
    }
}
