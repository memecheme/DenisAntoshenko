<?php
    namespace Denis\DataBaseIntro\Setup;

    use Magento\Framework\Setup\InstallDataInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    class InstallData implements InstallDataInterface
    {
        protected $_postFactory;
        
        public function __construct(
            \Denis\DataBaseIntro\Model\PostFactory $postFactory
        ) {
            $this->_postFactory = $postFactory;
        }

        public function install(
            ModuleDataSetupInterface $setup,
            ModuleContextInterface $context
        ) {
            $data = [
                'name_war' => "Warehouse1",
                'addr_war' => "Address1", 
                'id_cat' => '23',
                'id_prod' => '1371', 
                'kol_prod' => 100
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();

            $data = [
                'name_war' => "Warehouse2",
                'addr_war' => "Address2", 
                'id_cat' => '23',
                'id_prod' => '1371', 
                'kol_prod' => 0
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();

            $data = [
                'name_war' => "Warehouse3",
                'addr_war' => "Address3", 
                'id_cat' => '23',
                'id_prod' => '1371', 
                'kol_prod' => 80
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();

            $data = [
                'name_war' => "Warehouse2",
                'addr_war' => "Address2", 
                'id_cat' => '24',
                'id_prod' => '1203', 
                'kol_prod' => 30
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();

            $data = [
                'name_war' => "Warehouse2",
                'addr_war' => "Address2", 
                'id_cat' => '25',
                'id_prod' => '1580', 
                'kol_prod' => 0
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();

            $data = [
                'name_war' => "Warehouse1",
                'addr_war' => "Address1", 
                'id_cat' => '25',
                'id_prod' => '1548', 
                'kol_prod' => 140
            ];
            $post = $this->_postFactory->create();
            $post->addData($data)->save();
        }
    }