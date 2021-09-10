<?php
namespace Denis\DataGetting\Controller\TaskOne;

class TaskOne implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}