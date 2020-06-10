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
namespace Cinovic\Whatsapp\Model\ResourceModel\Whatsappmessage;

/**
 * Class Collection
 * @package Cinovic\Whatsapp\Model\ResourceModel\Whatsappmessage
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cinovic\Whatsapp\Model\Whatsappmessage', 'Cinovic\Whatsapp\Model\ResourceModel\Whatsappmessage');
    }
}
