<?php
namespace Denis\EAVtaskone\Model\Attribute\Frontend;

class Social extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        return $object->getData($this->getAttribute()->getAttributeCode());
    }
}