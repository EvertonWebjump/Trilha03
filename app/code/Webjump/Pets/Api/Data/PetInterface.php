<?php


namespace Webjump\Pets\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PetInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $name
     * @return void
     */
    public function setDescription(string $name);

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt);

//    /**
//     * @return PetExtensionInterface|null
//     */
//    public function getExtensionAttributes();
//
//    /**
//     * @param  $extensionAttributes
//     * @return void
//     */
//    public function setExtensionAttributes(PetExtensionInterface $extensionAttributes);
}
