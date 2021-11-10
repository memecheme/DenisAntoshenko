<?php
    namespace Denis\DecSchema\Setup\Patch\Schema;
    
    use Magento\Framework\DB\Ddl\Table;
    use Magento\Framework\Setup\Patch\SchemaPatchInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    class ChangeColumn implements SchemaPatchInterface {
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
            $this->moduleDataSetup->getConnection()->changeColumn(
            $this->moduleDataSetup->getTable('sales'),
                'discount',
                'bonus',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'comment' => 'Discount', 'nullable' => false,
                    'scale' => 2, 'precision' => 3
                ]
            );
            $this->moduleDataSetup->endSetup();
        }
    }