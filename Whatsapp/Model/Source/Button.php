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
namespace Cinovic\Whatsapp\Model\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Button
 * @package Cinovic\Whatsapp\Model\Source
 */
class Button implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'icon', 'label' => __('Icon')],
            ['value' => 'box', 'label' => __('Box')]
        ];
    }
}
