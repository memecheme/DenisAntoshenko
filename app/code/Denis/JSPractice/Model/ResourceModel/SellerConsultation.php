<?php
namespace Denis\JSPractice\Model\ResourceModel;

class SellerConsultation extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init("SellerConsultation", 'id');
    }
}
