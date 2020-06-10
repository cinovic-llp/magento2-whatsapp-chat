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
namespace Cinovic\Whatsapp\Block\Adminhtml\Personlist\Edit;

/**
 * Class Image
 * @package Cinovic\Whatsapp\Block\Adminhtml\Personlist\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('whatsappcustomer');
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );
        $form->setHtmlIdPrefix('test_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Add Person'), 'class' => 'fieldset-wide']
        );
        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id', 'value' => $model->getId()]);
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'image_url',
            'image',
            [
                'title' => __('Image'),
                'label' => __('Image'),
                'name' => 'image_url',
                'note' => 'Allow image type: jpg, jpeg, gif, png',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'number',
            'text',
            [
                'label' => __('Phone Number'),
                'title' => __('Phone Number'),
                'name' => 'number',
                'required' => true,
                'class' => 'validate-number'
            ]
        );
        $fieldset->addField(
            'department_name',
            'text',
            [
                'label' => __('Department Name'),
                'title' => __('Department Name'),
                'name' => 'department_name',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'custom_message',
            'text',
            [
                'label' => __('Custom Message'),
                'title' => __('Custom Message'),
                'name' => 'custom_message',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'disable_enable',
            'select',
            [
                'label' => __('Disable/Enable'),
                'name' => 'disable_enable',
                'values' => [
                    [
                        'value' => 1,
                        'label' => __('Enable'),
                    ],
                    [
                        'value' => 0,
                        'label' => __('Disable'),
                    ],
                ],
                'required' => true,
            ]
        );
        $form->setUseContainer(true);
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
