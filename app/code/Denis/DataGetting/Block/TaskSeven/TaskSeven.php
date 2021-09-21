<?php
namespace Denis\DataGetting\Block\TaskSeven;

class TaskSeven extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
  
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {    
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }
        
    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }
}