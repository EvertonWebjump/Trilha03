<?php

namespace Webjump\Pets\Controller\Adminhtml\InlineAction;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Webjump\Pets\Api\Data\PetInterfaceFactory;
use Webjump\Pets\Model\PetRepository;

class Edit extends Action implements HttpPostActionInterface
{

    /**
     * @var PetRepository
     */
    private $petRepository;
    /**
     * @var PetInterfaceFactory
     */
    private $petFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PetRepository $petRepository
    ) {
        parent::__construct($context);
        $this->petRepository= $petRepository;
    }

    public function execute()
    {
        $items = $this->_request->getParam('items');

        /** @var int|string $recordId */
        $itemData = array_pop($items);

        $pet = $this->petRepository->getById($itemData['entity_id']);

        $pet->setName($itemData['name']);
        $pet->setDescription($itemData['description']);

        $this->petRepository->save($pet);

        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $result->setData(['messages' => __('pet save with success'),
            'error' => (isset($errorMessage)) ? count($errorMessage) : false,
        ]);

        return $result;

    }
}