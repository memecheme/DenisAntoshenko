<?php
    namespace Denis\DataBaseIntro\Setup;

    class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
    {
        public function install(
            \Magento\Framework\Setup\SchemaSetupInterface $setup,
            \Magento\Framework\Setup\ModuleContextInterface $context
        ) {
            $installer = $setup;
            $installer->startSetup();
            if (!$installer->tableExists('denis_warehouse')) 
            {
                $table = $installer->getConnection()->newTable(
                $installer->getTable('denis_warehouse')

                // ID идентификатор записи (числовое, ключевое поле)
                )->addColumn('id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'ID'
                // NameWar название склада (текстовое)
                )->addColumn('name_war', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Name Warehouse'

                // AddrWar адрес склада (текстовое)
                )->addColumn('addr_war', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Address Warehouse'

                // IDCat категории продукта (текстовое)
                )->addColumn('id_cat', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'ID Category'

                // IDProd продукта (текстовое)
                )->addColumn('id_prod', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'ID Product'

                // KolProd количество продукта на складе (числовое)
                )->addColumn('kol_prod', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                [],
                'Amount Product'

                // DataProd дата появления продукта на складе (дата)
                )->addColumn('data_prod', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [   
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ],
                'Date'

                )->setComment('Post Table');

                $installer->getConnection()->createTable($table);
                $installer->getConnection()->addIndex(
                    $installer->getTable('denis_warehouse'),
                    $setup->getIdxName(
                        $installer->getTable('denis_warehouse'),
                        ['name_war','addr_war','id_cat','id_prod'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['name_war','addr_war','id_cat','id_prod'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
            $installer->endSetup();
        }
    }