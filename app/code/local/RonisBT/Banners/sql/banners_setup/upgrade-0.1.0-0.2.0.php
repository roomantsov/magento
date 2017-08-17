<?php
$installer = $this;
$tableBanners = $installer->getTable('ronisbt_banners/table_banners');
$installer->startSetup();
if ($installer->getConnection()->isTableExists($tableBanners)) {
    $table = $installer->getConnection();
    $table->addIndex($tableBanners, 'status', array('status'));
    $table->addIndex($tableBanners, 'position', array('position'));
    $table->addColumn($tableBanners, 'created_at', [
        'type'     => Varien_Db_Ddl_Table::TYPE_DATETIME,
        'nullable' => false,
        'comment'  => 'created_at',
    ]);
    $table->addColumn($tableBanners, 'updated_at', [
        'type'     => Varien_Db_Ddl_Table::TYPE_DATETIME,
        'nullable' => false,
        'comment'  => 'updated_at'
    ]);
    $table->update($tableBanners,[
        'created_at' => now(),
        'updated_at' => now()
    ]);
    $installer->endSetup();
}