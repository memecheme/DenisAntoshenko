<?php
namespace Denis\TestTaskOne\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Backend\Block\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Denis\TestTaskOne\Helper\MultiSelectSection as MSSHelper;
use Magento\Framework\App\Http\Context as HTTPContext;

class MultiSelectSection extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CollectionFactory
     */
    protected $_categoryCollection;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var MSSHelper
     */
    protected $_MSSHelper;

    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var HTTPContext
     */
    protected $_HTTPContext;
    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param CollectionFactory $categoryCollection
     * @param MSSHelper $MSSHelper
     * @param Registry $registry
     * @param HTTPContext $HTTPContext
     * @param array<array> $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        CollectionFactory $categoryCollection,
        MSSHelper $MSSHelper,
        Registry $registry,
        HTTPContext $HTTPContext,
        array $data = []
    ) {
        $this->_categoryCollection = $categoryCollection;
        $this->_storeManager = $storeManager;
        $this->_MSSHelper = $MSSHelper;
        $this->_registry = $registry;
        $this->_HTTPContext = $HTTPContext;
        parent::__construct($context, $data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCategoryNameById(int $id)
    {
        $category_name = [];
        $collection = $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->setStore($this->_storeManager->getStore())
            ->addAttributeToFilter('is_active', '1');
        foreach ($collection as $category) {
            if ($category->getId() == $id) {
                $category_name = $category->getName();
                break;
            }
        }
        return $category_name;
    }

    /**
     * @return mixed
     */
    public function getModuleStatus()
    {
        return $this->_MSSHelper->getGeneralConfig('enable');
    }

    /**
     * @return array|string[]
     */
    public function getSelectedCategories()
    {
        return $this->_MSSHelper->getGeneralCategory('msf');
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
    public function getSaleCompletionDate()
    {
        return $this->_MSSHelper->getGeneralConfig('scd');
    }

    /**
     * @return mixed
     */
    public function getSCDNValue()
    {
        return $this->_MSSHelper->getGeneralConfig('scd_n');
    }

    /**
     * @return mixed
     */
    public function getDiscountStatus()
    {
        return $this->_MSSHelper->getGeneralConfig('discount_enable');
    }

    /**
     * @return mixed
     */
    public function getDiscountPercent()
    {
        return $this->_MSSHelper->getGeneralConfig('discount_percent');
    }

    /**
     * @return mixed|null
     */
    public function getCustomerGroupId()
    {
        return $this->_HTTPContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
    }

    /**
     * @return string|void|null
     * @throws NoSuchEntityException
     */
    public function getDateSaleInfoMessage()
    {
        $difference_of_days = date('d', strtotime($this->getSaleCompletionDate())) -
            date('d', strtotime(date('Y-m-d')));
        if ($difference_of_days <= $this->getSCDNValue() && $this->getSaleCompletionDate() >= date('Y-m-d')) {
            foreach ($this->getSelectedCategories() as $scategory) {
                foreach ($this->getCurrentProduct()->getCategoryIds() as $pcategory) {
                    if ($scategory == $pcategory) {
                        return 'The sale of this product ends at: ' . $this->getSaleCompletionDate();
                    }
                }
            }
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getDiscountInfoMessage()
    {
        if ($this->getDiscountStatus() && $this->getCustomerGroupId() == 4) {
            return '<br />' . $this->getDiscountPercent() . '% discount for pensioners from 8 am to 10 am';
        } else {
            return null;
        }
    }
}
