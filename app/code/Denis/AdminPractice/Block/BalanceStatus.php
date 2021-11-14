<?php
namespace Denis\AdminPractice\Block;

class BalanceStatus extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $_registry;
    protected $_helperBalanceStatus;
    protected $_stockItemRepository;

    public function __construct(
        \Denis\AdminPractice\Helper\BalanceStatus $helperBalanceStatus,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_helperBalanceStatus = $helperBalanceStatus;
        $this->_stockItemRepository = $stockItemRepository;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

	public function showRemainderProduct() {
        if($this->_helperBalanceStatus->getGeneralConfig('enable')) {
            $product = $this->_registry->registry('current_product')->getId();
            $productQtyInfo = $this->_stockItemRepository->get($product-1)->getQty();
            if($this->_helperBalanceStatus->getGeneralConfig('criterion') > $productQtyInfo) {
                return '<br>Осталось ' . $productQtyInfo . ' единиц';
            }
        }
    }

	public function showMessageEndProduct($product) {
        if($this->_helperBalanceStatus->getGeneralConfig('enable')) {
            $productQtyInfo = $this->_stockItemRepository->get($product->getId()-1)->getQty();
            if($this->_helperBalanceStatus->getGeneralConfig('criterion') > $productQtyInfo) {
                return '<b>Заканчивается!</b>';
            }
        }
    }
}