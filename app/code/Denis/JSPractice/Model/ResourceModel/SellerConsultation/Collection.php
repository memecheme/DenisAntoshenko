<?php
namespace Denis\JSPractice\Model\ResourceModel\SellerConsultation;

class SellerConsultation extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {       
        $this->_init('Denis\JSPractice\Model\SellerConsultation',
            'Denis\JSPractice\Model\ResourceModel\SellerConsultation');
    }
}
