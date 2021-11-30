<?php
namespace Denis\EAVtaskone\Model;

class TrueFalse extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_options;

    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '1', 'label' => __('True')],
                ['value' => '0', 'label' => __('False')]
            ];
        }
        return $this->_options;
    }

    final public function toOptionArray()
    {
         return array(
            array('value' => '1', 'label' => __('True')),
            array('value' => '0', 'label' => __('False'))
         );
     }
}