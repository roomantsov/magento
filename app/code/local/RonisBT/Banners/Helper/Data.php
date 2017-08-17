<?php

class RonisBT_Banners_Helper_Data extends Mage_Core_Helper_Abstract {
    public function saveBannerImage($image, $banner_id){
        $uploader = new Varien_File_Uploader('image');
        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $uploaded_image_name = "{$banner_id}_" . $image['name'];
        $uploaded_image_url = '/ronisbt_banners/' . $uploaded_image_name;
        $uploader->save(Mage::getBaseDir() . '/media/ronisbt_banners', $uploaded_image_name);

        return $uploaded_image_url;
    }
}