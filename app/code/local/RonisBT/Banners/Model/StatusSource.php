<?php

class RonisBT_Banners_Model_StatusSource
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'enable', 'label' => Mage::helper('ronisbt_banners')->__('Enable')),
            array('value' =>'disable', 'label' => Mage::helper('ronisbt_banners')->__('Disable')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'enable'  => Mage::helper('ronisbt_banners')->__('Enable'),
            'disable' => Mage::helper('ronisbt_banners')->__('Disable'),
        );
    }
}