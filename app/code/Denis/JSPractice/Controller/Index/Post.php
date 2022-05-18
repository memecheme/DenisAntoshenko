<?php
namespace Denis\JSPractice\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {
                $model = $this->_objectManager->create('Denis\JSPractice\Model\SellerConsultation');
                $model->setName($this->getRequest()->getParam('name'))
                      ->setEmail($this->getRequest()->getParam('email'))
                      ->setPhone($this->getRequest()->getParam('telephone'))
                      ->setComment($this->getRequest()->getParam('comment'))
                      ->setDate(date("Y-m-d"))
                      ->save(); 
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;

    }
}