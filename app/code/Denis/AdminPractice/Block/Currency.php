<?php
namespace Denis\AdminPractice\Block;

class Currency extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $_helperCurrency;
    protected $_productRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry,
        \Denis\AdminPractice\Helper\Currency $helperCurrency,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_helperCurrency = $helperCurrency;
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function showPriceInOtherCurrencies() {
        if($this->_helperCurrency->getGeneralConfig('enable')) {
            if($this->_helperCurrency->getGeneralConfig('uah')) {
                $product = $this->_registry->registry('current_product')->getId();
                $productPriceInUSD = $this->_productRepository->getById($product-1)->getPrice();
                $productPriceInUAH = $this->_helperCurrency->getGeneralConfig('uah_course');
                echo '<br><b>₴' . $productPriceInUSD * $productPriceInUAH . '</b>';
            }
            if($this->_helperCurrency->getGeneralConfig('rub')) {
                $product = $this->_registry->registry('current_product')->getId();
                $productPriceInUSD = $this->_productRepository->getById($product-1)->getPrice();
                $productPriceInRUB = $this->_helperCurrency->getGeneralConfig('rub_course');
                echo '<br><b>₽' . $productPriceInUSD * $productPriceInRUB . '</b>';
            }
            if($this->_helperCurrency->getGeneralConfig('euro')) {
                $product = $this->_registry->registry('current_product')->getId();
                $productPriceInUSD = $this->_productRepository->getById($product-1)->getPrice();
                $productPriceInEURO = $this->_helperCurrency->getGeneralConfig('euro_course');
                echo '<br><b>€' . $productPriceInUSD * $productPriceInEURO . '</b>';
            }
        }
    }
}