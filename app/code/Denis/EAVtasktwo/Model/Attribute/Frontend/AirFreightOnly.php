<?php
namespace Denis\EAVtasktwo\Model\Attribute\Frontend;

class AirFreightOnly extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        return $object->getData($this->getAttribute()->getAttributeCode());
    }
}
