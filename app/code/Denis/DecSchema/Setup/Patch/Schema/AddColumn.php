<?php
    namespace Denis\DecSchema\Setup\Patch\Schema;
    
    use Magento\Framework\DB\Ddl\Table;
    use Magento\Framework\Setup\Patch\SchemaPatchInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    class AddColumn implements SchemaPatchInterface {
        private $moduleDataSetup;
        
        public function __construct(
            ModuleDataSetupInterface $moduleDataSetup
        ) {
            $this->moduleDataSetup = $moduleDataSetup;
        }

        public static function getDependencies() {
            return [];
        }

        public function getAliases() {
            return [];
        }

        public function apply() {
            $this->moduleDataSetup->startSetup();
            $this->moduleDataSetup->getConnection()->addColumn(
            $this->moduleDataSetup->getTable('sales'),
                'price_sold_product',
                [
                    'type' => Table::TYPE_INTEGER,
                    'padding' => 10, 'nullable' => true, 'unsigned' => true,
                    'comment' => 'Price',
                ]
            );
            $this->moduleDataSetup->endSetup();
        }
    }