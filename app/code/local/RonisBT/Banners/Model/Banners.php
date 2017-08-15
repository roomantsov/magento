<?php

class RonisBT_Banners_Model_Banners extends Mage_Core_Model_Abstract {
    public function _construct()
    {
        parent::_construct();
        $this->_init('ronisbt_banners/banners');
    }

    protected function _beforeDelete()
    {
        $helper = Mage::helper('ronisbt_banners');
        $image_path = Mage::getModel('ronisbt_banners/banners')->load($this->getId())->getImagePath();
        @unlink(Mage::getBaseDir() . $image_path);
        return parent::_beforeDelete();
    }
}