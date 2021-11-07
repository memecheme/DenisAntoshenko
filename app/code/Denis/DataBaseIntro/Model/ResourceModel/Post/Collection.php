<?php
    namespace Denis\DataBaseIntro\Model\ResourceModel\Post;

    class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {
        protected function _construct()
        {       
            $this->_init('Denis\DataBaseIntro\Model\Post',
                'Denis\DataBaseIntro\Model\ResourceModel\Post');
        }
    }