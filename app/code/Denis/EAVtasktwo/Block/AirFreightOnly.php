<?php
namespace Denis\EAVtasktwo\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Denis\EAVtasktwo\Helper\AirFreightOnlyHelper;
use Magento\Catalog\Model\Product;

class AirFreightOnly extends \Magento\Framework\View\Element\Template
{
    /** @var Registry */
    protected $_registry;

    /** @var AirFreightOnlyHelper */
    protected $_helperAFO;

    /** @var Product */
    protected $_productCatalog;

    /**
     * @param Registry $registry
     * @param AirFreightOnlyHelper $helperAFO
     * @param Product $productCatalog
     * @param array<array> $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AirFreightOnlyHelper $helperAFO,
        Product $productCatalog,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_helperAFO = $helperAFO;
        $this->_productCatalog = $productCatalog;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct() : object
    {
        return $this->_registry->registry('current_product');
    }

    public function getProductAFOType(int $product_id) : string
    {
        $afo_type = $this->_productCatalog->load($product_id)->getData('air_freight_only');
        $result = '';
        switch ($afo_type) {
            case 0:
                $result = 'none';
                break;
            case 1:
                $result = 'balloon';
                break;
            case 2:
                $result = 'charter_plane';
                break;
            case 3:
                $result = 'highspeed_plane';
                break;
            case 4:
                $result = 'spaceship';
                break;
        }
        return $result;
    }

    public function getProductAFOName(int $product_id) : string
    {
        $afo_name = $this->_productCatalog->load($product_id)->getData('air_freight_only');
        $result = '';
        switch ($afo_name) {
            case 0:
                $result = 'None';
                break;
            case 1:
                $result = 'Balloon';
                break;
            case 2:
                $result = 'Charter Plane';
                break;
            case 3:
                $result = 'High-speed Plane';
                break;
            case 4:
                $result = 'Spaceship';
                break;
        }
        return $result;
    }

    public function getProductWeight(int $product_id) : float
    {
        $product_weight = $this->_productCatalog->load($product_id)->getWeight();
        if ($product_weight) {
            return $product_weight;
        } else {
            return 0;
        }
    }

    public function isTheModuleEnabled() : int
    {
        return $this->_helperAFO->getGeneralConfig('enable');
    }

    public function getXValue(string $type) : int
    {
        return $this->_helperAFO->getGeneralConfig($type . '_x');
    }

    public function getYValue(string $type) : int
    {
        return $this->_helperAFO->getGeneralConfig($type . '_y');
    }

    public function getAdditionalFreightCharges(int $product_id) : float
    {
        $product_weight = $this->getProductWeight($product_id);
        $product_afo_type = $this->getProductAFOType($product_id);
        if ($product_afo_type != 'none') {
            $product_afo_x = $this->getXValue($product_afo_type);
            $product_afo_y = $this->getYValue($product_afo_type);
            if ($product_weight > $product_afo_x) {
                return ($product_weight - $product_afo_x) * $product_afo_y;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getMessage(string $afo_name, float $addfc) : string
    {
        $message = 'For transportation by ' .
            $afo_name .
            ', an additional fee will be charged ' .
            $addfc .
            '$';
        return $message;
    }
}
