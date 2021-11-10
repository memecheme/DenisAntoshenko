<?php
    namespace Denis\DecSchema\Setup\Patch\Data;
    
    use Magento\Framework\Setup\Patch\DataPatchInterface;
    use Magento\Framework\Setup\Patch\PatchVersionInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;
    use Denis\DecSchema\Model\SalesFactory;
    Use Denis\DecSchema\Model\ResourceModel\Sales;
    
    class AddSalesData implements DataPatchInterface, PatchVersionInterface {
        private $salesFactory;
        private $salesResource;
        private $moduleDataSetup;

        public function __construct(
            SalesFactory $salesFactory,
            Sales $salesResource,
            ModuleDataSetupInterface $moduleDataSetup
        ) {
            $this->salesFactory = $salesFactory;
            $this->salesResource = $salesResource;
            $this->moduleDataSetup = $moduleDataSetup;
        }

        public function apply() {
            $this->moduleDataSetup->startSetup();

            $saleDT1 = $this->salesFactory->create();
            $saleDT1->setNameSoldProduct('Apple')
                    ->setAmountSoldProduct(20)
                    ->setSaleDate('2021-11-09')
                    ->setDiscount(0.06)
                    ->setPriceSoldProduct(3);
            $this->salesResource->save($saleDT1);

            $saleDT2 = $this->salesFactory->create();
            $saleDT2->setNameSoldProduct('Banana')
                    ->setAmountSoldProduct(5)
                    ->setSaleDate('2021-11-09')
                    ->setDiscount(0.08)
                    ->setPriceSoldProduct(7);
            $this->salesResource->save($saleDT2);

            $saleDT3 = $this->salesFactory->create();
            $saleDT3->setNameSoldProduct('Apple')
                    ->setAmountSoldProduct(15)
                    ->setSaleDate('2021-11-10')
                    ->setDiscount(0.06)
                    ->setPriceSoldProduct(3);
            $this->salesResource->save($saleDT3);

            $saleDT4 = $this->salesFactory->create();
            $saleDT4->setNameSoldProduct('Pineapple')
                    ->setAmountSoldProduct(3)
                    ->setSaleDate('2021-11-10')
                    ->setDiscount(0.05)
                    ->setPriceSoldProduct(15);
            $this->salesResource->save($saleDT4);

            $saleDT5 = $this->salesFactory->create();
            $saleDT5->setNameSoldProduct('Pear')
                    ->setAmountSoldProduct(10)
                    ->setSaleDate('2021-11-11')
                    ->setDiscount(0.07)
                    ->setPriceSoldProduct(5);
            $this->salesResource->save($saleDT5);

            $this->moduleDataSetup->endSetup();
        }

        public static function getDependencies() {
            return [];
        }

        public static function getVersion() {
            return '1.0.1';
        }

        public function getAliases() {
            return [];
        }
    }