<?php
namespace Denis\UIPractice\Model\ResourceModel\SC;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Denis\UIPractice\Model\SC as SCModel;
use Denis\UIPractice\Model\ResourceModel\SC as SCResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SCModel::class, SCResourceModel::class);
    }
}