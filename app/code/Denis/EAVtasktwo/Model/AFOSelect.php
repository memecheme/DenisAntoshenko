<?php
namespace Denis\EAVtasktwo\Model;

class AFOSelect extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var array<array> $_options
     */
    protected $_options;

    /**
     * @return array<array>
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '0', 'label' => __('None')],
                ['value' => '1', 'label' => __('Balloon')],
                ['value' => '2', 'label' => __('Charter Plane')],
                ['value' => '3', 'label' => __('High-speed Plane')],
                ['value' => '4', 'label' => __('Spaceship')]
            ];
        }
        return $this->_options;
    }

    /**
     * @return array<array>
     */
    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('None')],
            ['value' => '1', 'label' => __('Balloon')],
            ['value' => '2', 'label' => __('Charter Plane')],
            ['value' => '3', 'label' => __('High-speed Plane')],
            ['value' => '4', 'label' => __('Spaceship')]
        ];
    }
}
