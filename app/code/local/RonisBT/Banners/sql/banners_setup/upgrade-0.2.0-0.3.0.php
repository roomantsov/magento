<?php
$installer = $this;
$tableBanners = $installer->getTable('ronisbt_banners/table_banners');

$installer->startSetup();
$installer->getConnection()->dropTable($tableBanners);
$table = $installer->getConnection()
    ->newTable($tableBanners)
    ->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable'  => false,
    ))
    ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
    ))
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('image_path', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_VARCHAR, '255', array(
        'nullable'  => false,
        'default'   => true
    ));
$installer->getConnection()->createTable($table);

$installer->endSetup();

//die('module sql setup');