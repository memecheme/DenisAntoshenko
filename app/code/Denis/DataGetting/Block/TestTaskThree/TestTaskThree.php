<?php
namespace Denis\DataGetting\Block\TestTaskThree;

class TestTaskThree extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_configurableProductModel;
    protected $_productRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableProductModel,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_configurableProductModel = $configurableProductModel;
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getBundleProducts()
    {
		$collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToSelect('type');
        $collection->addFieldToFilter('type_id', array('eq' => 'bundle'));
        return $collection;
	}

    public function getGroupedProducts()
    {
		$collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToSelect('type');
        $collection->addFieldToFilter('type_id', array('eq' => 'grouped'));
        return $collection;
	}

    public function getParentIds($childId)
    {
        return $this->_configurableProductModel->getParentIdsByChild($childId);
    }

    public function getChildrenIds($parentId, $required = true)
    {
        return $this->_configurableProductModel->getChildrenIds($parentId, $required);
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }
}