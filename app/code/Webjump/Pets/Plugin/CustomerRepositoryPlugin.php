<?php

namespace Webjump\Pets\Plugin;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Webjump\Pets\Model\PetRepository;
use Magento\Customer\Api\Data\CustomerExtensionFactory;

class CustomerRepositoryPlugin
{
    /**
     * @var PetRepository
     */
    private $petRepository;
    /**
     * @var CustomerExtensionFactory
     */
    private $customerExtensionFactory;

    public function __construct(
        PetRepository $petRepository,
        CustomerExtensionFactory $customerExtensionFactory
    ) {
        $this->petRepository = $petRepository;
        $this->customerExtensionFactory = $customerExtensionFactory;
    }
    public function afterGet
    (
        CustomerRepositoryInterface $subject,
        CustomerInterface $entity
    ) {
        $customAttribute =
        $petKind = $this->petRepository->getById($entity->getId());

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setPetKind($petKind);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    public function afterGetById
    (
        CustomerRepositoryInterface $subject,
        CustomerInterface $entity
    ) {
        $customAttribute = $entity->getCustomAttribute('pet_kind_id');

        if(empty($customAttribute)){
            return $entity;
        }

        $petKindId = (int) $customAttribute->getValue();

        $petKind = $this->petRepository->getById($petKindId);
        $extensionAttributes = $entity->getExtensionAttributes();

        if (empty($extensionAttributes)){
            $extensionAttributes = $this->customerExtensionFactory->create();
        }

        $extensionAttributes->setPetKind($petKind);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

//    public function afterSave
//    (
//        CustomerRepositoryInterface $subject,
//        CustomerInterface $entity
//    ) {
//        $extensionAttributes = $entity->getExtensionAttributes();
//        $petKind = $extensionAttributes->getPetKind();
//        $this->petRepository->save($petKind);
//
//        return $entity;
//    }
}
