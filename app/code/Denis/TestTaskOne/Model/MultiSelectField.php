<?php
namespace Denis\TestTaskOne\Model;

use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class MultiSelectField extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var array<array> $_options
     */
    protected $_options;

    /**
     * @var CollectionFactory
     */
    protected $_categoryCollection;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param StoreManagerInterface $storeManager
     * @param CollectionFactory $categoryCollection
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        CollectionFactory $categoryCollection
    ) {
        $this->_categoryCollection = $categoryCollection;
        $this->_storeManager = $storeManager;
    }

    /**
     * @return Collection
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCategoryCollection()
    {
        $collection = $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->setStore($this->_storeManager->getStore())
            ->addAttributeToFilter('is_active', '1');
        return $collection;
    }

    /**
     * @return array<array>
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $collection = $this->getCategoryCollection();
            foreach ($collection as $category) {
                $this->_options = [
                    [
                        'value' => $category->getId(),
                        'label' => $category->getName() . ' (ID: ' . $category->getId() . ')'
                    ]
                ];
            }
        }
        return $this->_options;
    }

    /**
     * @return array<array>
     */
    public function toOptionArray()
    {
        $collection = $this->getCategoryCollection();
        foreach ($collection as $category) {
            $array[] = [
                'value' => $category->getId(),
                'label' => $category->getName() . ' (ID: ' . $category->getId() . ')'
            ];
        }
        return $array;
    }
}
