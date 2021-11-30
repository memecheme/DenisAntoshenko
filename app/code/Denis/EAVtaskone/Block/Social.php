<?php
namespace Denis\EAVtaskone\Block;

class Social extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $_helperSocial;
    protected $_productRepository;
    protected $_productCatalog;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry,
        \Denis\EAVtaskone\Helper\Social $helperSocial,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Model\Product $productCatalog,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_helperSocial = $helperSocial;
        $this->_productRepository = $productRepository;
        $this->_productCatalog = $productCatalog;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function isTheAttributeIncluded($product_id) 
    {
        return $this->_productCatalog->load($product_id)->getSocial();
    }

    public function isTheModuleEnabled() 
    {
        return $this->_helperSocial->getGeneralConfig('enable');
    }

    public function getDiscountPercent() 
    {
        return $this->_helperSocial->getGeneralConfig('percent');
    }

    public function getDiscountPrice($product_id) 
    {
        return $this->getProductById($product_id-1)->getPrice()
            - ($this->getProductById($product_id-1)->getPrice() 
            * $this->getDiscountPercent() / 100);
    }
}