<?php
namespace Denis\DataGetting\ViewModel;

class TestTaskTwoVM implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => 23]);
        $collection->addAttributeToFilter('price', array('gteq' => 50));
        $collection->addAttributeToFilter('price', array('lteq' => 60));
        return $collection;
    }
}