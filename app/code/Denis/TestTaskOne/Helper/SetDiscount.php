<?php
namespace Denis\TestTaskOne\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SetDiscount extends AbstractHelper
{
    /**
     * @var WriterInterface
     */
    protected $_configWriter;

    /**
     * @param WriterInterface $configWriter
     */
    public function __construct(WriterInterface $configWriter)
    {
        $this->_configWriter = $configWriter;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setConfig(string $value)
    {
        $this->_configWriter->save(
            'mss/general/discount_enable',
            $value,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            0
        );
        return $this;
    }
}
