<?php

namespace Webjump\Pets\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pets\Api\PetRepositoryInterface;
use Webjump\Pets\Model\ResourceModel\Pet\CollectionFactory;

class Pet implements ResolverInterface
{
    /**
     * @var PetRepositoryInterface
     */
    private $petRepository;

    public function __construct(
        PetRepositoryInterface $petRepository
    )
    {
        $this->petRepository = $petRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $collection = $this->petRepository->getList();
    }
}