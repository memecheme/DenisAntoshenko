<?php
namespace Denis\DataGetting\Controller\TaskOne;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class TaskOne implements ActionInterface
{
    protected $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}