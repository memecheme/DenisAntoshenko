<?php
    namespace Denis\DataBaseIntro\Model;
    
    class Post extends \Magento\Framework\Model\AbstractModel
    {
        protected function _construct()
        {
            $this->_init('Denis\DataBaseIntro\Model\ResourceModel\Post');
        }
    }