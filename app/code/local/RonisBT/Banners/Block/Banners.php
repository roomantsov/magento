<?php

class RonisBT_Banners_Block_Banners extends Mage_Core_Block_Template {
    public function getBannersCollection(){
        $bannersCollection = Mage::getModel('ronisbt_banners/banners')
                            ->getCollection()
                            ->addFieldToFilter('status', 'enable');
        $bannersCollection->setOrder('`order`', 'ASC');
        return $bannersCollection;
    }
}