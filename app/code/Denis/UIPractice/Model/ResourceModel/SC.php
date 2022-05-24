<?php
namespace Denis\UIPractice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SC extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SellerConsultation', 'id');
    }
}