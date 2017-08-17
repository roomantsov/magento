<?php

class RonisBT_Banners_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ronisbt_banners/banners')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = mage::helper('ronisbt_banners');
        $this->addColumn('banner_id', [
            'header' => $helper->__('Banner ID'),
            'index'  => 'banner_id'
        ]);

        $this->addColumn('title', [
            'header' => $helper->__('Banner Title'),
            'index'  => 'title',
            'type'   => 'text'
        ]);

        $this->addColumn('position ', [
            'header' => $helper->__('Position'),
            'index'  => 'position',
            'type'   => 'number'
        ]);

        $this->addColumn('status', [
            'header'  => $helper->__('Status'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => Mage::getModel('ronisbt_banners/statusSource')->toArray(),
        ]);

        $this->addColumn('url', [
            'header' => $helper->__('URL'),
            'index'  => 'url',
            'type'   => 'text'
        ]);

        $this->addColumn('created_at',[
            'header' => $helper->__('Created At'),
            'index'  => 'created_at',
            'type'   => 'datetime'
        ]);

        $this->addColumn('updated_at',[
            'header' => $helper->__('Updated At'),
            'index'  => 'updated_at',
            'type'   => 'datetime'
        ]);

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldname('banners');

        $this->getMassactionBlock()->addItem('enable',[
            'label' => $this->__('Enable'),
            'url'   => $this->getUrl('*/*/massEnable')
        ]);


        $this->getMassactionBlock()->addItem('disable',[
            'label' => $this->__('Disable'),
            'url'   => $this->getUrl('*/*/massDisable')
        ]);

        $this->getMassactionBlock()->addItem('delete', [
            'label' => $this->__('Delete'),
            'url'   => $this->getUrl('*/*/massDelete')
        ]);

        return $this;
    }

    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', [
            'id' => $item->getId()
        ]);
    }

    // next functions is for ajax

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    public function _construct()
    {
        parent::_construct();

        $this->setId('ronisbt_banners_grid');
        $this->setSaveParametersInSession(false);
        $this->setUseAjax(true);
    }
}