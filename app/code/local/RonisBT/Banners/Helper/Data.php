<?php
class RonisBT_Banners_Helper_Data extends Mage_Core_Helper_Abstract {
    public function saveBannerImage($image, $banner_id){
        $uploader = new Varien_File_Uploader('image');
        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $media_folder = '/media';
        $banners_folder = '/ronisbt_banners';
        $uploaded_image_name = $image['name'];
        $unificator = 0;
        while(file_exists(Mage::getBaseDir() . $media_folder . $banners_folder . $this->getSubFolders($uploaded_image_name) . DS . $uploaded_image_name)){
            $uploaded_image_name = $this->renameImageFile($image['name'], $unificator);
            $unificator++;
        };
        $uploaded_image_url = $banners_folder . $this->getSubFolders($uploaded_image_name) . DS . $uploaded_image_name;
        $uploader->save(Mage::getBaseDir() . $media_folder . $banners_folder . $this->getSubFolders($uploaded_image_name), $uploaded_image_name);

        return $uploaded_image_url;
    }

    public function getSubFolders($image_name){
        $folders = "/" . $image_name[0];
        if(strlen($image_name) === 1 || $image_name[1] == '.'){
            $folders .= '/_';
        } else {
            $folders .= "/{$image_name[1]}";
        }
        return $folders;
    }

    public function renameImageFile($image_name, $unificator){
        $file_name_array = explode('.', $image_name);
        $mime_type = array_pop($file_name_array);
        $file_name = count($file_name_array) > 1 ? implode('.', $file_name_array) : $file_name_array[0];
        $file_name .= "_{$unificator}";
        return $file_name . ".$mime_type";
    }
}
