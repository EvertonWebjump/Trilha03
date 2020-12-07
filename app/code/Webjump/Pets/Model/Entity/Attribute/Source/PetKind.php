<?php

namespace Webjump\Pets\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Option\ArrayInterface;
use Webjump\Pets\Model\PetRepository;
use Webjump\Pets\Model\ResourceModel\Pet\CollectionFactory;

class PetKind extends AbstractSource
{
    /**
     * @var PetRepository
     */
    private $petRepository;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
      PetRepository $petRepository,
      CollectionFactory $collectionFactory
    ) {
        $this->petRepository = $petRepository;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get options as array.
     *
     * @return array|null
     */
    public function getAllOptions()
    {
        $options[] = [
            'label' => __('Select Pet'),
            'value' => '0'
        ];

        $petCollection = $this->collectionFactory->create();
        $petsItens = $petCollection->getItems();

        foreach ($petsItens as $item) {
            $options[] = [
                'label' => $item->getName(),
                'value' => $item->getId()
            ];
        }

        return $options;
    }

}
