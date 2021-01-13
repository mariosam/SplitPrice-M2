<?php
/**
 * Class Prices
 * 
 * @author      MarioSAM <eu@mariosam.com.br>
 * @version     1.0.0
 * @date        2020/11
 * @copyright   Blog do Mario SAM
 * 
 * Give the new options value to config the system module.
 */
namespace MarioSAM\SplitPrice\Model\Config\Source;

class Prices implements \Magento\Framework\Option\ArrayInterface
{ 
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'base-price'    => __('Base Price Only'),
            'promo-price'   => __('Promo Price Only'),
            'promo-first'   => __('Promo Price (if exist) > Base Price')
        ];
    }
}
