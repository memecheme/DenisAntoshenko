<?php
namespace Denis\TestTaskOne\Plugins;

use Denis\TestTaskOne\Block\MultiSelectSection;
use Magento\Framework\App\Request\Http;

class Title
{
    /**
     * @var MultiSelectSection
     */
    protected $_MSSBlock;

    /**
     * @var Http
     */
    protected $_request;

    public function __construct(
        MultiSelectSection $MSSBlock,
        Http $request
    ) {
        $this->_MSSBlock = $MSSBlock;
        $this->_request = $request;
    }

    /**
     * @SuppressWarnings("unused")
     * @return string
     */
    public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $subject, string $title)
    {
        if ($this->_MSSBlock->getModuleStatus() && $this->_MSSBlock->getCurrentProduct()) {
            $product_id = $this->_MSSBlock->getCurrentProduct()->getId();
            $product_sku = $this->_MSSBlock->getCurrentProduct()->getSku();
            $product_type = $this->_MSSBlock->getCurrentProduct()->getTypeId();
            $product_category_ids = $this->_MSSBlock->getCurrentProduct()->getCategoryIds();
            $selected_category_ids = $this->_MSSBlock->getSelectedCategories();
            if ($this->_request->getFullActionName() == 'catalog_product_view') {
                foreach ($selected_category_ids as $scategory) {
                    foreach ($product_category_ids as $pcategory) {
                        if ($scategory == $pcategory) {
                            $title .= ' ' . $this->_MSSBlock->getCategoryNameById($pcategory) .
                                '_' . $product_id . '_' . $product_sku . '_' . $product_type;
                            break;
                        }
                    }
                }
            }
            return $title;
        } else {
            return $title;
        }
    }
}
