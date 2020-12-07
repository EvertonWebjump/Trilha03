<?php


namespace Webjump\Pets\Model;


//use Webjump\Pets\Api\Data\PetExtensionInterface;
//use Webjump\Pets\Api\Data\PetExtensionInterface;
use Webjump\Pets\Api\Data\PetInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Pet extends AbstractModel implements IdentityInterface, PetInterface
{

    const CACHE_TAG = 'pet_kind';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const CREATED_AT = 'created_at';

    protected $_cacheTag = 'pet_kind';

    protected $_eventPrefix = 'pet_kind';

    protected function _construct()
    {
        $this->_init('Webjump\Pets\Model\ResourceModel\Pet');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName(string $name)
    {
        $this->setData(self::NAME, $name);
    }

    public function getDescription()
    {
        return $this->_getData(self::DESCRIPTION);
    }

    public function setDescription(string $name)
    {
        $this->setData(self::DESCRIPTION, $name);
    }

    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

//    public function getExtensionAttributes()
//    {
//    }
//
//    public function setExtensionAttributes(\Webjump\Pets\Api\Data\PetExtensionInterface $extensionAttributes)
//    {
//    }
}
