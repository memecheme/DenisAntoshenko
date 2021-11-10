<?php
    namespace Denis\DecSchema\Model\ResourceModel\Sales;

    class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {
        protected function _construct()
        {       
            $this->_init('Denis\DecSchema\Model\Sales',
                'Denis\DecSchema\Model\ResourceModel\Sales');
        }
    }