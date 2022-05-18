<?php
namespace Denis\JSPractice\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Helper\Image;
use Magento\Framework\Registry;

class ProductImage extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ProductRepository
     */
    protected $_productRepository;

    /**
     * @var Image
     */
    protected $_imageHelper;

    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @param Context $context
     * @param ProductRepository $productRepository
     * @param Image $imageHelper
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context, 
        ProductRepository $productRepository,
        Image $imageHelper,
        Registry $registry,
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        $this->_imageHelper = $imageHelper;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

    /**
     * @return string
     * @param int $id
     */
    public function getProductImage(int $id)
    {
        $product = $this->_productRepository->getById($id);
        $image = $this->_imageHelper->init($product, 'product_base_image')->getUrl();
        return '<img src="' . $image . '" alt="product-image" height="500" width="500"/>';
    }

    /**
     * @return string
     * @param int $id
     */
    public function getProductName(int $id)
    {
        $product = $this->_productRepository->getById($id);
        return $product->getName();
    }
}  