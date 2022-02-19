<?php
namespace Denis\TestTaskTwo\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Backend\Block\Template\Context;
use Denis\TestTaskTwo\Helper\GetConfigHelper;
use Magento\Catalog\Api\Data\TierPriceInterface;
use Magento\Catalog\Api\TierPriceStorageInterface;

class ShowPrices extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var GetConfigHelper
     */
    protected $_configHelper;

    /**
     * @var TierPriceStorageInterface
     */
    protected $_tierPrice;

    /**
     * @param Context $context
     * @param GetConfigHelper $configHelper
     * @param Registry $registry
     * @param TierPriceStorageInterface $tierPrice
     * @param array<array> $data
     */
    public function __construct(
        Context $context,
        GetConfigHelper $configHelper,
        Registry $registry,
        TierPriceStorageInterface $tierPrice,
        array $data = []
    ) {
        $this->_configHelper = $configHelper;
        $this->_registry = $registry;
        $this->_tierPrice = $tierPrice;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed|null
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * @return mixed
     */
    public function getModuleStatus()
    {
        return $this->_configHelper->getGeneralConfig('module_enable');
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function getPriceStatus(string $type)
    {
        return $this->_configHelper->getGeneralConfig($type);
    }

    /**
     * @return string|null
     */
    public function getBasePrice()
    {
        if ($this->getCurrentProduct()->getTypeId() == 'configurable') {
            $basePrice = $this->getCurrentProduct()->getPriceInfo()
                ->getPrice('regular_price')->getMinRegularAmount()->getValue();
            return 'Base price: ' . $basePrice . '<br>';
        } elseif ($this->getCurrentProduct()->getTypeId() == 'simple') {
            $basePrice = $this->getCurrentProduct()->getPriceInfo()
                ->getPrice('regular_price')->getValue();
            return 'Base price: ' . $basePrice . '<br>';
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getFinalPrice()
    {
        if (($this->getCurrentProduct()->getTypeId() == 'configurable'
            || $this->getCurrentProduct()->getTypeId() == 'simple')) {
            $finalPrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('final_price')->getValue();
            return 'Final price: ' . $finalPrice . '<br>';
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getSpecialPrice()
    {
        if (($this->getCurrentProduct()->getTypeId() == 'configurable'
            || $this->getCurrentProduct()->getTypeId() == 'simple')) {
            $specialPrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('special_price')->getValue();
            return 'Special Price: ' . $specialPrice . '<br>';
        } else {
            return null;
        }
    }

    /**
     * @param array<string> $sku
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getTierPriceArray(array $sku)
    {
        $result = [];
        $result = $this->_tierPrice->get($sku);
        return $result;
    }

    /**
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getTierPrice()
    {
        if ($this->getCurrentProduct()->getTypeId() == 'configurable'
            || $this->getCurrentProduct()->getTypeId() == 'simple') {
            $tierPrice = 0;
            $result = $this->getTierPriceArray([$this->getCurrentProduct()->getSku()]);
            if (count($result)) {
                foreach ($result as $item) {
                    $tierPrice = round($item['price'], 0);
                }
            }
            return 'Tier Price: ' . $tierPrice . '<br>';
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getCatalogRulePrice()
    {
        if ($this->getCurrentProduct()->getTypeId() == 'configurable'
            || $this->getCurrentProduct()->getTypeId() == 'simple') {
            $catalogRule = $this->getCurrentProduct()->getPriceInfo()->getPrice('catalog_rule_price')->getValue();
            return 'Catalog Rule Price: ' . $catalogRule . '<br>';
        } else {
            return null;
        }
    }
}
