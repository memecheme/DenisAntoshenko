<?php
namespace Denis\DataGetting\Block\TaskFour;

class TaskFour extends \Magento\Framework\View\Element\Template
{
    protected $_productRepository;
    protected $_ruleCollectionFactory;
    protected $_storeManagerInterface;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory $ruleCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        $this->_ruleCollectionFactory = $ruleCollectionFactory;
        $this->_storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);
    }

    public function getCatalogPriceRuleProductIds() 
    {
        $websiteId = $this->_storeManagerInterface->getStore()->getWebsiteId();
        $resultProductIds = [];
        $catalogRuleCollection = $this->_ruleCollectionFactory->create();
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
        return $this->_productRepository->getById($id);
    }
}