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
namespace Cinovic\Whatsapp\Model\ResourceModel;

/**
 * Class Whatsappmessage
 * @package Cinovic\Whatsapp\Model\ResourceModel
 */
class Whatsappmessage extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cinovic_whatsapptable', 'entity_id');
    }
}
