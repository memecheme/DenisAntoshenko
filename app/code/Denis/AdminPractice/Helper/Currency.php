<?php
    namespace Denis\AdminPractice\Helper;
    
    use Magento\Framework\App\Helper\AbstractHelper;
    use Magento\Store\Model\ScopeInterface;
    
    class Currency extends AbstractHelper {     
        const XML_PATH_HELLOWORLD = 'settingcurrencies/';
        
        public function getConfigValue($field, $storeId = null) {
            return $this->scopeConfig->getValue($field, 
                ScopeInterface::SCOPE_STORE, $storeId);
        }

        public function getGeneralConfig($code, $storeId = null) {
            return $this->getConfigValue(self::XML_PATH_HELLOWORLD.'general/'. $code, 
                $storeId);
        }
    }