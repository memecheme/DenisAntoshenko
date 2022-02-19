<?php
namespace Denis\TestTaskTwo\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class GetConfigHelper extends AbstractHelper
{
    const XML_PATH_HELLOWORLD = 'pr_gr/';

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
}
