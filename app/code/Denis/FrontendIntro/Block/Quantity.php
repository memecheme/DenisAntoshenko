<?php
namespace Denis\FrontendIntro\Block;
class Quantity extends \Magento\Framework\View\Element\Template
{    
    protected $_stockItemRepository;
    protected $_registry;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_stockItemRepository = $stockItemRepository;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }
    
    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }

    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }
}
?>