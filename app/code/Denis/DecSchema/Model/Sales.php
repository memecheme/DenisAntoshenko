<?php
    namespace Denis\DecSchema\Model;
    class Sales extends \Magento\Framework\Model\AbstractModel {
        protected function _construct() {
            $this->_init("Denis\DecSchema\Model\ResourceModel\Sales");
        }
    }
?>