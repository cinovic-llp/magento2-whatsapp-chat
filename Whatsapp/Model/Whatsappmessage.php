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
namespace Cinovic\Whatsapp\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Whatsappmessage
 * @package Cinovic\Whatsapp\Model
 */
class Whatsappmessage extends AbstractModel
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Cinovic\Whatsapp\Model\ResourceModel\Whatsappmessage');
    }
}
