<?php
namespace Denis\UIPractice\Model;

use Denis\UIPractice\Model\ResourceModel\SC\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $scCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $scCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    // @codingStandardsIgnoreEnd

    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $sc) {
            $this->loadedData[$sc->getId()] = $sc->getData();
        }
        return $this->loadedData;
    }
}