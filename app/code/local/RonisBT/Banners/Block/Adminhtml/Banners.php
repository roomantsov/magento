<?php

class RonisBT_Banners_Block_Adminhtml_Banners extends Mage_Adminhtml_Block_Widget_Grid_Container {
    public function _construct(){
        parent::_construct();

        $helper = Mage::helper('ronisbt_banners');
        $this->_blockGroup = 'ronisbt_banners';
        $this->_controller = 'adminhtml_banners';

        $this->_headerText = $helper->__('Banners management');
        $this->_addButtonLabel = $helper->__('Add banner');
    }
}