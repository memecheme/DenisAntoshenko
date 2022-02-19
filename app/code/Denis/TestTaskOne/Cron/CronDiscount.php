<?php
namespace Denis\TestTaskOne\Cron;

use Denis\TestTaskOne\Helper\MultiSelectSection;
use Denis\TestTaskOne\Helper\SetDiscount;
use Magento\Framework\App\ResourceConnection;

class CronDiscount
{
    /**
     * @var MultiSelectSection
     */
    protected $_MSSHelper;

    /**
     * @var SetDiscount
     */
    protected $_SDHelper;

    /**
     * @var ResourceConnection
     */
    protected $_resource;

    /**
     * @param MultiSelectSection $MSSHelper
     * @param SetDiscount $SDHelper
     * @param ResourceConnection $resource
     */
    public function __construct(
        MultiSelectSection $MSSHelper,
        SetDiscount $SDHelper,
        ResourceConnection $resource
    ) {
        $this->_MSSHelper = $MSSHelper;
        $this->_SDHelper = $SDHelper;
        $this->_resource = $resource;
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
     * @param string $value
     * @return $this
     */
    public function setDiscountEnable(string $value)
    {
        $this->_SDHelper->setConfig($value);
        return $this;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $connection = $this->_resource->getConnection();
        $discount = $this->getDiscountPercent();
        $name = $discount . '% for each product for Pensioners';
        if ($this->getDiscountStatus() == 0) {
            $status = '1';
        } else {
            $status = '0';
        }
        $this->setDiscountEnable($status);
        $tableName = $connection->getTableName('catalogrule');
        $data = ['name' => $name, 'description' => $name, 'is_active' => $status, 'discount_amount' => $discount];
        $where = ['rule_id = ?' => '2'];
        $connection->update($tableName, $data, $where);
        return $this;
    }
}
