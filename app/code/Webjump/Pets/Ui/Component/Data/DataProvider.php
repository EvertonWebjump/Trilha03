<?php
declare(strict_types=1);
namespace Webjump\Pets\Ui\Component\Data;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Webjump\Pets\Model\ResourceModel\Pet\CollectionFactory;
use Webjump\Pets\Api\Data\PetInterface;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $petCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $petCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * Get Data
     *
     * @return array
     */
    public function getData()
    {
        $loadedData = [];
        /** @var PetInterface[] $items */
        $items = $this->collection->getItems();
        foreach ($items as $minQtyItem) {
            $loadedData[$minQtyItem->getEntityId()] = $minQtyItem->getData();
        }
        return $loadedData;
    }
}