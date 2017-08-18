<?php

class RonisBT_Banners_Helper_Image extends Mage_Core_Helper_Abstract {
    protected $_model;
    protected $_scheduleResize = false;
    protected $_banner;
    protected $_placeholder;

    public function init(RonisBT_Banners_Model_Banners $banner){
        $this->_banner = $banner;
        $this->_model = Mage::getModel('ronisbt_banners/image')->init('/media' . $this->_banner->getImagePath());
        $this->_placeholder = Mage::getDesign()->getSkinUrl('images/' . Mage::getStoreConfig('banners/image/placeholder'));
        echo 'OK!';
    }

    public function resize($width, $height = null){
        $this->_getModel()->setWidht($width)->setHeight($height);
        $this->_scheduleResize = true;
        return $this;
    }

    public function setQuality($quality){
        $this->_getModel()->setQuality($quality);
        return $this;
    }

    public function keepAspectRatio($flag = true){
        $this->_getModel()->setKeepAspectRatio($flag);
        return $this;
    }

    public function keepFrame($flag = true){
        $this->_getModel()->setKeepFrame($flag);
        return $this;
    }

    public function keepTransparency($flag = true){
        $this->_getModel()->setKeepTransparency($flag);
        return $this;
    }

    public function constrainOnly($flag = true){
        $this->_getModel()->setConstrainOnly($flag);
        return $this;
    }

    public function getPlaceholder(){
        if(!$this->_placeholder){
            return '';
        }
        return $this->_placeholder;
    }

    public function __toString(){
        // generate image path hash
        // check if image exist
            // throw image
        // else
            // generate image
            // save image
            // throw image
        return '';
    }

    protected function _getModel(){
        return $this->_model;
    }

    protected function _getBanner(){
        return $this->_banner;
    }

    public function validateUploadImage($filePath){
        $maxDimension = Mage::getStoreConfig('banners/image/max_dimension');
        $imageInfo = getimagesize($filePath);
        if(!$imageInfo){
            Mage::throwException($this->__('Disallowed file type'));
        }

        if($imageInfo[0] > $maxDimension || $imageInfo[1] > $maxDimension){
            Mage::throwException($this->__('Disallowed file format'));
        }

        $_processor = new Varien_Image($filePath);
        return $_processor->getMimeType() !== null;
    }
}