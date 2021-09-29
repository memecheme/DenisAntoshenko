<?php
namespace Denis\DataGetting\Block\TestTaskOne;

class TestTaskOne extends \Magento\Framework\View\Element\Template
{    
    protected $_stockItemRepository;
    protected $_productRepository;
    protected $_productImageHelper;
    protected $_customerCollectionFactory;
    protected $_orderCollectionFactory;
    protected $_groupCollectionFactory;
    protected $_scopeConfigInterface;
    protected $_shippingModelConfig;
    protected $_paymentMethodListInterface;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Helper\Image $productImageHelper,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Customer\Model\ResourceModel\Group\CollectionFactory $groupCollectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface,
        \Magento\Shipping\Model\Config $shippingModelConfig,
        \Magento\Payment\Api\PaymentMethodListInterface $paymentMethodListInterface,
        array $data = []
    ) {
        $this->_stockItemRepository = $stockItemRepository;
        $this->_productRepository = $productRepository;
        $this->_productImageHelper= $productImageHelper;
        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_groupCollectionFactory = $groupCollectionFactory;
        $this->_scopeConfigInterface = $scopeConfigInterface;
        $this->_shippingModelConfig = $shippingModelConfig;
        $this->_paymentMethodListInterface = $paymentMethodListInterface;
        parent::__construct($context, $data);
    }
    
    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function getImageOriginalWidth($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getWidth();
    }
    
    public function getImageOriginalHeight($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getHeight();
    }
    
    public function getImageOriginalUrl($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getUrl();
    }
    
    public function getCustomerCollection()
    {
        return $this->_customerCollectionFactory->create();
    }

    public function getOrderCollectionByDate($from, $to) 
    {
        $collection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('created_at', array('gteq' => $from))
            ->addFieldToFilter('created_at', array('lteq' => $to))
            ->setOrder('created_at','desc');         
        return $collection;
    }

    public function getCustomerGroups() 
    {
        if (!$this->hasData('customer_group_collection')) {
            $collection = $this->_groupCollectionFactory->create();
            $this->setData('customer_group_collection', $collection);
        }
        return $this->getData('customer_group_collection');
    }

    public function getPaymentMethods() 
    {
        return $this->_paymentMethodListInterface->getList(1);
    }

    public function getActiveShippingMethods()
    {
        $shippingMethods = $this->_shippingModelConfig->getActiveCarriers();
        $shippingMethodsArray = array();
        foreach ($shippingMethods as $shippigCode => $shippingModel) {
            $shippingTitle = $this->_scopeConfigInterface->getValue('carriers/'.$shippigCode.'/title');
            $shippingMethodsArray[$shippigCode] = array(
                'label' => $shippingTitle,
                'value' => $shippigCode
            );
        }
        return $shippingMethodsArray;
    }
}