<?php
namespace Denis\EAVtasktwo\Helper;
    
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
    
class AirFreightOnlyHelper extends AbstractHelper
{
    const XML_PATH_HELLOWORLD = 'afo/';
        
    public function getConfigValue(string $field, int $storeId = null) : int
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getGeneralConfig(string $code, int $storeId = null) : int
    {
        return $this->getConfigValue(
            self::XML_PATH_HELLOWORLD.'general/'. $code,
            $storeId
        );
    }
}
