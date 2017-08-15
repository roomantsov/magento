<?php

class RonisBT_Banners_Block_Adminhtml_Banners_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
    protected function _prepareForm()
    {
        $helper = Mage::helper('ronisbt_banners');
        $model = Mage::registry('current_banner');
        $model->image = $model->getImagePath();

        $form = new Varien_Data_Form([
            'id'      => 'edit_form',
            'action'  => $this->getUrl('/*/save', [
                'id' => $this->getRequest()->getParam('id')
            ]),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ]);

        $this->setForm($form);

        $fieldset = $form->addFieldset('banner_from', ['legend' => $helper->__('Banner information')]);

        $fieldset->addField('title', 'text', [
            'label'    => $helper->__('Title'),
            'required' => true,
            'name'     => 'title'
        ]);

        $fieldset->addField('url', 'text', [
            'label'    => $helper->__('URL'),
            'required' => true,
            'name'     => 'url'
        ]);

        $fieldset->addField('order', 'text', [
            'label'    => $helper->__('Order'),
            'required' => true,
            'name'     => 'order'
        ]);

        $fieldset->addField('status', 'select', [
            'label'    => $helper->__('Status'),
            'required' => true,
            'name'     => 'status',
            'values'   => [
                'disable' => 'disable',
                'enable' => 'enable'
            ]
        ]);

        $fieldset->addField('image', 'image', array(
            'label' => $helper->__('Image'),
            'name' => 'image',
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }
}