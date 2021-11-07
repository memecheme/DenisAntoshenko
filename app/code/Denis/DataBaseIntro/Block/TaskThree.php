<?php
    namespace Denis\DataBaseIntro\Block;

    class TaskThree extends \Magento\Framework\View\Element\Template
    {
        protected $_postFactory;
        protected $_productRepository;

        public function __construct(
            \Magento\Backend\Block\Template\Context $context, 
            \Denis\DataBaseIntro\Model\PostFactory $postFactory,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            array $data = []
        ) {
            $this->_postFactory = $postFactory;
            $this->_productRepository = $productRepository;
            parent::__construct($context, $data);
        }

        public function getFullTable()
        {
            $post = $this->_postFactory->create();
            $collection = $post->getCollection();
            return $collection;       
        }
        
        public function getProductFromSpecWarehouse($name)
        {
            $masName = [];
            $post = $this->_postFactory->create();
            $collection = $post->getCollection();
            foreach($collection as $item) {
                if($item->getData('name_war') == $name) {
                    $masName[] = $item->getData('id_prod');
                }
            }
            return $masName;
        }

        public function getProductById($id)
        {
            return $this->_productRepository->getById($id);
        }
    }  