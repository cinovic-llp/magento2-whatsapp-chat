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

class Whatsappmessage extends AbstractModel
{
    public function _construct()
    {
        $this->_init('Cinovic\Whatsapp\Model\ResourceModel\Whatsappmessage');
    }
}
