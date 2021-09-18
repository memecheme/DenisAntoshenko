<?php
namespace Denis\DataGetting\Block\TaskThree;

class TaskThree extends \Magento\Framework\View\Element\Template
{    
    protected $_categoryCollectionFactory;
    protected $_productRepository;
    protected $_registry;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        array $data = []
        )
        {
            $this->_categoryCollectionFactory = $categoryCollectionFactory;
            $this->_productRepository = $productRepository;
            $this->_registry = $registry;
            parent::__construct($context, $data);
    }

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');        
        
        if ($isActive) {
            $collection->addIsActiveFilter();
        }
                
        if ($level) {
            $collection->addLevelFilter($level);
        }
        
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }
        
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        }            
        return $collection;
    }
    
    public function getProductById($id)
    {        
        return $this->_productRepository->getById($id);
    }
    
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }
}