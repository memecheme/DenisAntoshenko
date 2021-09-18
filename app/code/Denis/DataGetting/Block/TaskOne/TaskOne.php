<?php
namespace Denis\DataGetting\Block\TaskOne;

class TaskOne extends \Magento\Framework\View\Element\Template
{
    public $productRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Catalog\Model\ProductRepository $productRepository, 
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }
    
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
}