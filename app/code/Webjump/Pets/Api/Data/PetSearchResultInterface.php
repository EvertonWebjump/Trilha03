<?php


namespace Webjump\Pets\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PetSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return PetInterface[]
     */
    public function getItems();

    /**
     * @param PetInterface[] $items
     * @return void
     */
    public function setItems(array $items);

}
