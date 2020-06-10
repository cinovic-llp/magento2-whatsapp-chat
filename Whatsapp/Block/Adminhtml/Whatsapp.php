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
namespace Cinovic\Whatsapp\Block\Adminhtml;

/**
 * Class Whatsapp
 * @package Cinovic\Whatsapp\Block\Adminhtml
 */
class Whatsapp extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Cinovic\Whatsapp\Block\Adminhtml\Personlist\Grid', 'cinovic.personlist.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * Render grid
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
