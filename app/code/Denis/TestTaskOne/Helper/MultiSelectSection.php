<?php
namespace Denis\TestTaskOne\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class MultiSelectSection extends AbstractHelper
{
    const XML_PATH_HELLOWORLD = 'mss/';

    /**
     * @param string $field
     * @param int|null $storeId
     * @return mixed
     */
    public function getConfigValue(string $field, int $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param string $code
     * @param int|null $storeId
     * @return mixed
     */
    public function getGeneralConfig(string $code, int $storeId = null)
    {
        return $this->getConfigValue(
            self::XML_PATH_HELLOWORLD.'general/'. $code,
            $storeId
        );
    }

    /**
     * @param string $field
     * @param int|null $storeId
     * @return array|string[]
     */
    public function getCategoryValue(string $field, int $storeId = null)
    {
        $list = $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
        return $list !== null ? explode(',', $list) : [];
    }

    /**
     * @param string $code
     * @param int|null $storeId
     * @return array|string[]
     */
    public function getGeneralCategory(string $code, int $storeId = null)
    {
        return $this->getCategoryValue(
            self::XML_PATH_HELLOWORLD.'general/'. $code,
            $storeId
        );
    }
}
