<?php
    namespace Denis\DecSchema\Model\ResourceModel;
    class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
        public function _construct() {
            $this->_init("sales", 'stock_number');
        }
    }
?>