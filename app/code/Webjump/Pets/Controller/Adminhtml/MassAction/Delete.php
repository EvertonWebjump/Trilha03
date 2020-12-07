<?php


namespace Webjump\Pets\Controller\Adminhtml\MassAction;


use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Webjump\Pets\Api\PetRepositoryInterface;
use Webjump\Pets\Model\PetRepository;

class Delete extends Action implements HttpPostActionInterface
{

    /**
     * @var PetRepositoryInterface
     */
    private $petRepository;

    /**
     * Delete constructor.
     * @param PetRepositoryInterface $petRepository
     * @param Action\Context $context
     */
    public function __construct(
        PetRepositoryInterface $petRepository,
        Action\Context $context)
    {
        $this->petRepository = $petRepository;

        parent::__construct($context);
    }


    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $params = $this->_request->getParam('selected');

        foreach ($params as $item) {
            $this->petRepository->deleteById($item);
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('webjump_pets/pets/index');
    }
}