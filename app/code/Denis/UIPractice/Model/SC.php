<?php
namespace Denis\UIPractice\Model;

use Magento\Framework\Model\AbstractModel;
use Denis\UIPractice\Model\ResourceModel\SC as SCResourceModel;

class SC extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(SCResourceModel::class);
    }
}