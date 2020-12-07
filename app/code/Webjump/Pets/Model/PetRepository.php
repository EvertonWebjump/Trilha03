<?php


namespace Webjump\Pets\Model;


use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\Pets\Api\Data\PetInterface;
use Webjump\Pets\Api\PetRepositoryInterface;
use Webjump\Pets\Api\Data\PetSearchResultInterface;
use Webjump\Pets\Api\Data\PetSearchResultInterfaceFactory;
use Webjump\Pets\Model\ResourceModel\Pet\Collection;
use Webjump\Pets\Model\ResourceModel\Pet\CollectionFactory;
use Webjump\Pets\Api\Data\PetInterfaceFactory;

class PetRepository implements PetRepositoryInterface
{
    /**
     * @var PetInterfaceFactory
     */
    private $petFactory;
    /**
     * @var CollectionFactory
     */
    private $petCollectionFactory;
    /**
     * @var PetSearchResultInterfaceFactory
     */
    private $petSearchResultInterfaceFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        PetInterfaceFactory $petFactory,
        CollectionFactory $petCollectionFactory,
        PetSearchResultInterfaceFactory $petSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->petFactory = $petFactory;
        $this->petCollectionFactory = $petCollectionFactory;
        $this->petSearchResultInterfaceFactory = $petSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(PetInterface $pet)
    {
        $pet->getResource()->save($pet);
        return $pet;
    }

    public function getById($id)
    {
        $pet = $this->petFactory->create();
        $pet->getResource()->load($pet, $id);
        if (! $pet->getId()) {
            throw new NoSuchEntityException(__('Unable to find pet with ID "%1"', $id));
        }
        return $pet;
    }

    public function delete(PetInterface $pet)
    {
        $pet->getResource()->delete($pet);
    }

    public function deleteById($petId)
    {
        $pet = $this->petFactory->create();
        $pet->getResource()->load($pet, $petId);

        if (! $pet->getId()) {
            throw new NoSuchEntityException(__('Unable to find pet with ID "%1"', $petId));
        }

        $pet->getResource()->delete($pet);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->petCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->petSearchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
