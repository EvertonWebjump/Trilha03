<?php


namespace Webjump\Pets\Model;


use Magento\Ui\DataProvider\AbstractDataProvider;
use Webjump\Pets\Model\ResourceModel\Pet\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $petCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $petCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $petCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return [];
    }
}
