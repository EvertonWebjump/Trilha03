<?php


namespace Webjump\Pets\Controller\Adminhtml\Pets;


use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Webjump\Pets\Model\PetRepository;
use Webjump\Pets\Api\Data\PetInterfaceFactory;

class Save extends Action implements HttpPostActionInterface
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
        PetRepository $petRepository,
        PetInterfaceFactory $petFactory
    )
    {
        parent::__construct($context);
        $this->petRepository= $petRepository;
        $this->petFactory= $petFactory;
    }

    public function execute()
    {
        $request = $this->getRequest();

        $pet = $this->petFactory->create();
        $pet->setName($request->getParam('name'));
        $pet->setDescription($request->getParam('description'));
        if(!empty($request->getParam('entity_id'))){
            $pet->setId($request->getParam('entity_id'));
        }

        $this->petRepository->save($pet);

        $this->messageManager->addSuccessMessage(__('pet save with success'));

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('webjump_pets/pets/index');
    }
}