<?php


namespace Webjump\Pets\Plugin;


use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerExtensionInterface;
use Magento\Customer\Api\Data\CustomerExtensionFactory;

class CustomerAttributesLoad
{
    /**
     * @var CustomerExtensionFactory
     */
    private $extensionFactory;

    /**
     * @param CustomerExtensionFactory $extensionFactory
     */
    public function __construct(CustomerExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * Loads product entity extension attributes
     *
     * @param CustomerInterface $entity
     * @param CustomerExtensionInterface|null $extension
     * @return CustomerExtensionFactory
     */
    public function afterGetExtensionAttributes(
        CustomerInterface $entity,
        CustomerExtensionInterface $extension = null
    ) {
        if ($extension === null) {
            $extension = $this->extensionFactory->create();
        }

        return $extension;
    }
}