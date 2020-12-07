<?php

namespace Webjump\Pets\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Setup\Patch\Data\UpdateIdentifierCustomerAttributesVisibility;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\DB\Ddl\Table;

class AddCustomerAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(Customer::ENTITY, 'pet_name', [
            'label' => 'Pet Name',
            'type' => 'varchar',
            'input' => 'text',
            'required' => false,
            'default' => '',
        ]);

        /* Specify which place you want to display customer attribute */
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'pet_name')
            ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
            ]
        ]);

        $attribute->save();

        $customerSetup->addAttribute(Customer::ENTITY, 'pet_kind_id', [
            'label' => 'Pet Kind',
            'type' => 'int',
            'input' => 'select',
            'required' => false,
            'source' => \Webjump\Pets\Model\Entity\Attribute\Source\PetKind::class,
            'default' => '',
        ]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'pet_kind_id')
            ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
            ]
        ]);

        $attribute->save();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [
            UpdateIdentifierCustomerAttributesVisibility::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}