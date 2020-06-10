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
 * Class Grid
 * @package Cinovic\Whatsapp\Block\Adminhtml\Personlist
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Grid constructor.
     * @param MagentoBackendBlockTemplateContext         $context
     * @param MagentoBackendHelperData                   $backendHelper
     * @param CinovicWhatsappModelWhatsappmessageFactory $whatsappmessageCollection
     * @param array                                      $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Cinovic\Whatsapp\Model\WhatsappmessageFactory $whatsappmessageCollection,
        array $data = []
    ) {
        $this->_whatsappmessageCollection = $whatsappmessageCollection;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * @return mixed
     */
    protected function _prepareCollection()
    {
        $collection = $this->_whatsappmessageCollection->create()->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return mixed
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'type' => 'text',
                'index' => 'name',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
        $this->addColumn(
            'department_name',
            [
                'header' => __('Department Name'),
                'type' => 'text',
                'index' => 'department_name',
                'header_css_class' => 'col-department_name',
                'column_css_class' => 'col-department_name',
            ]
        );
        $this->addColumn(
            'image_url',
            [
                'header' => __('Image'),
                'index' => 'image_url',
                'header_css_class' => 'col-image_url',
                'column_css_class' => 'col-image_url',
				'filter' => false,
                'renderer'=>'Cinovic\Whatsapp\Block\Adminhtml\Personlist\Helper\Renderer\Image'
            ]
        );
        $this->addColumn(
            'number',
            [
                'header' => __('Phone Number'),
                'type' => 'number',
                'index' => 'number',
                'header_css_class' => 'col-number',
                'column_css_class' => 'col-number',
            ]
        );
        $this->addColumn(
            'custom_message',
            [
                'header' => __('Custom Message'),
                'type' => 'text',
                'index' => 'custom_message',
                'header_css_class' => 'col-custom_message',
                'column_css_class' => 'col-custom_message',
            ]
        );
        $this->addColumn(
            'disable_enable',
            [
                'header' => __('disable/enable'),
                'type' => 'options',
                'options' => [
                    '0' => 'Disable',
                    '1' => 'Enable',
                ],
                'index' => 'disable_enable',
                'header_css_class' => 'col-disable_enable',
                'column_css_class' => 'col-disable_enable',
            ]
        );

        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'whatsapp/*/edit',
                        ],
                        'field' => 'entity_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return object
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('whatsappcustomer');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('*/*/MassDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );
        return $this;
    }

    /**
     * @return String
     */
    public function getGridUrl()
    {
        return $this->getUrl('whatsapp/*/grid', array('_current' => true));
    }

    /**
     * @param  Object $row
     * @return String
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'whatsapp/*/edit',
            array('entity_id' => $row->getId())
        );
    }
}
