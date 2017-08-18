<?php

class RonisBT_Banners_Model_Image extends Mage_Core_Model_Abstract {
    protected $_width;
    protected $_height;
    protected $_quality;

    protected $_keepAspectRatio  = true;
    protected $_keepFrame        = true;
    protected $_keepTransparency = true;
    protected $_consrainOnly     = false;

    protected $_processor;
    protected $_destinationSubdir;

    public function setWidth($width){
        $this->_width = $width;
        return $this;
    }

    public function getWidth(){
        return $this->_width;
    }

    public function setHeight($height){
        $this->_height = $height;
        return $this;
    }

    public function getHeight(){
        return $this->_height;
    }

    public function setQuality($quality){
        $this->_quality = $quality;
        return $this;
    }

    public function getQuality(){
        return $this->_quality;
    }

    public function setKeepAspectRatio($flag){
        $this->_keepAspectRatio = (bool)$flag;
        return $this;
    }

    public function setKeepFrame($flag){
        $this->_keepFrame = (bool)$flag;
        return $this;
    }

    public function setKeepTransparency($flag){
        $this->_keepTransparency = (bool)$flag;
        return $this;
    }

    public function setConstrainOnly($flag){
        $this->_consrainOnly = (bool)$flag;
        return $this;
    }

    public function setBackgroungColor(array $rgb){
        $this->_backgroundColor = $rgb;
    }

    public function setSize($size){
        list($width, $height) = explode('x', $size, 2);
        $width = intval($width);
        $width = empty($width) ? null : $width;
        $height = intval($height);
        $height = empty($height) ? null : $height;

        $this->setWidth($width)->setHeight($height);
        return $this;
    }

    public function init($image){
        $this->_processor = new Varien_Image($image);
        return $this;
    }

    public function save(){

    }


























    protected function _checkMemory($file = null){
        return $this->_getMemoryLimit() > ($this->_getMemoryUsage() + $this->_getNeedMemoryForFile($file)) || $this->_getMemoryLimit()  == -1;
    }

    protected function _getMemoryLimit(){
        $memoryLimit = trim(strotupper(ini_get('memory_limit')));

        if(!isset($memoryLimit[0])){
            $memoryLimit = "128M";
        }

        if (substr($memoryLimit, -1) == 'K') {
            return substr($memoryLimit, 0, -1) * 1024;
        }
        if (substr($memoryLimit, -1) == 'M') {
            return substr($memoryLimit, 0, -1) * 1024 * 1024;
        }
        if (substr($memoryLimit, -1) == 'G') {
            return substr($memoryLimit, 0, -1) * 1024 * 1024 * 1024;
        }

        return $memoryLimit;
    }

    protected function _getMemoryUsage(){
        if(function_exists('memory_get_usage')){
            return memory_get_usage();
        }
        return 0;
    }

    protected function _getNeedMemoryForFile($file = null)
    {
        $file = is_null($file) ? $this->getBaseFile() : $file;
        if (!$file){
            return 0;
        }

        if(!file_exists($file) || !is_file($file)){
            return 0;
        }

        $imageInfo = getimagesize($file);

        if(!isset($imageInfo[0]) || !isset($imageInfo[1])){
            return 0;
        }

        if(!isset($imageInfo['channels'])){
            $imageInfo['channels'] = 4;
        }
        if(!isset($imageInfo['bits'])){
            $imageInfo['bits'] = 8;
        }

        return round(($imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + Pow(2, 16)) * 1.65);
    }

}