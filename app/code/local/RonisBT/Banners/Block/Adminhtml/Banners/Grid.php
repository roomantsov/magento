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
            'header' => $helper->__('banner title'),
            'index'  => 'title',
            'type'   => 'text'
        ]);

        $this->addColumn('order', [
            'header' => $helper->__('order'),
            'index'  => 'order',
            'type'   => 'integer'
        ]);

        $this->addColumn('status', [
            'header'  => $helper->__('status'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => [
                'enable'  => 'enable',
                'disable' => 'disable'
            ]
        ]);

        $this->addColumn('url', [
            'header' => $helper->__('URL'),
            'index'  => 'url',
            'type'   => 'text'
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
}