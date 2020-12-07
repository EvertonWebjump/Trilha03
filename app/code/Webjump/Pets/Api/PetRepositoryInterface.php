<?php


namespace Webjump\Pets\Api;


use Magento\Framework\Api\SearchCriteriaInterface;
use Webjump\Pets\Api\Data\PetInterface;
use Webjump\Pets\Api\Data\PetSearchResultInterface;

interface PetRepositoryInterface
{
    /**
     * Create or update a data
     * @param PetInterface $pet
     *
     * @return PetInterface
     */
    public function save(PetInterface $pet);

    /**
     * @param int
     * @return PetInterface
     */
    public function getById($id);

    /**
     * @param $petId
     * @return void
     */
    public function deleteById($petId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PetSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

}
