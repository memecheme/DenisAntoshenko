<?php
namespace Denis\UIPractice\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Reply extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Reply to customer'));

        $id = $this->getRequest()->getParam('id');
        if ($id) {   
            $modelSC = $this->_objectManager->create('Denis\UIPractice\Model\SC');
            $modelSC->load($id)->setStatus(1)->save();
        }

        return $resultPage;
    }
}