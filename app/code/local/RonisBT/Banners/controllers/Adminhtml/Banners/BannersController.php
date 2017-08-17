<?php

class RonisBT_Banners_Adminhtml_Banners_BannersController extends Mage_Adminhtml_Controller_Action {
    public function indexAction(){
        $this->loadLayout();
        $this->_setActiveMenu('cms');

        $contentBlock = $this->getLayout()->createBlock('ronisbt_banners/adminhtml_banners');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction(){
        $this->_forward('edit');
    }

    public function editAction(){
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_banner', Mage::getModel('ronisbt_banners/banners')->load($id));

        $this->loadLayout()->_setActiveMenu('cms');
        $this->_addContent($this->getLayout()->createBlock('ronisbt_banners/adminhtml_banners_edit'));
        $this->renderLayout();
    }

    public function saveAction(){
        if($data = $this->getRequest()->getPost()){
            try {
                $model = Mage::getModel('ronisbt_banners/banners');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                $model->save();
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $image_path = Mage::helper('ronisbt_banners')->saveBannerImage($_FILES['image'], $model->getId());
                    $model->setImagePath($image_path);
                    $model->save();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Banner was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $data['image'] = Mage::helper('ronisbt_banners')->saveBannerImage($_FILES['image'], $model->getId());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', [
                   'id' => $this->getRequest()->getParam('id')
                ]);
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find banner for saving'));

        $this->_redirect('*/*/');
    }

    public function deleteAction(){
        if($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('ronisbt_banners/banners')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Banner is deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction(){
        $banners = $this->getRequest()->getParam('massaction', null);
        if(is_array($banners) && sizeof($banners) > 0){
            try{
                foreach ($banners as $banner){
                    Mage::getModel('ronisbt_banners/banners')->setId($banner)->delete();
                }
                $this->_getSession()->addSuccess($this->__("Total of %d banners have been deleted", sizeof($banners)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select banners'));
        }

        $this->_redirect('*/*');
    }

    public function massEnableAction(){
        $banners = $this->getRequest()->getParam('massaction', null);
        if(is_array($banners) && sizeof($banners) > 0){
            try{
                foreach ($banners as $banner){
                    Mage::getModel('ronisbt_banners/banners')->setId($banner)->setStatus('enable')->save();
                }
                $this->_getSession()->addSuccess($this->__("Banners successfully enabled"));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select banners'));
        }

        $this->_redirect('*/*');
    }

    public function massDisableAction(){
        $banners = $this->getRequest()->getParam('massaction', null);
        if(is_array($banners) && sizeof($banners) > 0){
            try{
                foreach ($banners as $banner){
                    Mage::getModel('ronisbt_banners/banners')->setId($banner)->setStatus('disable')->save();
                }
                $this->_getSession()->addSuccess($this->__("Banners successfully disabled"));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select banners'));
        }

        $this->_redirect('*/*');
    }

    // next function is for ajax loading grid

    public function gridAction(){
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('ronisbt_banners/adminhtml_banners_grid')->toHtml()
        );
    }
}