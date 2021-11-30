<?php
namespace Denis\EAVtaskone\Block;

class SocialCategory extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $_helperSocial;
    protected $_productCatalog;

    public function __construct(
        \Denis\EAVtaskone\Helper\Social $helperSocial,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Catalog\Model\Product $productCatalog,
        array $data = []
    ) {
        $this->_helperSocial = $helperSocial;
        $this->_productCatalog = $productCatalog;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function isTheAttributeIncluded($product_id) 
    {
        return $this->_productCatalog->load($product_id)->getSocial();
    }

    public function isTheModuleEnabled() 
    {
        return $this->_helperSocial->getGeneralConfig('enable');
    }
}