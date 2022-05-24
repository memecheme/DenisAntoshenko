<?php
namespace Denis\UIPractice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Denis\UIPractice\Model\SC;

class Send extends \Magento\Backend\App\Action
{
    /**
     * @var SC
     */
    protected $uipModel;

    /**
     * @param Action\Context $context
     * @param SC           $uipModel
     */
    public function __construct(
        Action\Context $context,
        SC $uipModel
    ) {
        parent::__construct($context);
        $this->uipModel = $uipModel;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $this->uipModel->load($id);
            }

            $this->uipModel->setData($data)->setStatus(2)->save();
            $emailModel = $this->_objectManager->create('Denis\UIPractice\Helper\Email');
            $emailModel->sendEmail(
                $this->uipModel->getName(),
                $this->uipModel->getId(),
                $this->uipModel->getDate(),
                $this->uipModel->getEmail(),
                $this->uipModel->getComment(),
                $this->uipModel->getAnswer()
            );
            $this->messageManager->addSuccess(__('The response was successfully sent to the customer.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}