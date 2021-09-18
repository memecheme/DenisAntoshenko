<?php
namespace Denis\DataGetting\Block\TaskFour;

class TaskFour extends \Magento\Framework\View\Element\Template
{
    protected $productRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Catalog\Model\ProductRepository $productRepository, 
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getCatalogPriceRuleProductIds()
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->create(
            '\Magento\Store\Model\StoreManagerInterface');
        $catalogRule = \Magento\Framework\App\ObjectManager::getInstance()->create(
            '\Magento\CatalogRule\Model\RuleFactory');
    
        $websiteId = $storeManager->getStore()->getWebsiteId();

        $resultProductIds = [];
        $catalogRuleCollection = $catalogRule->create()->getCollection();
        $catalogRuleCollection->addIsActiveFilter(1);
        foreach ($catalogRuleCollection as $catalogRule) {
            $productIdsAccToRule = $catalogRule->getMatchingProductIds();
            foreach ($productIdsAccToRule as $productId => $ruleProductArray) {
                if (!empty($ruleProductArray[$websiteId])) {
                    $resultProductIds[$productId] = $productId;
                }
            }
        }
    return $resultProductIds;
    }

    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }
}