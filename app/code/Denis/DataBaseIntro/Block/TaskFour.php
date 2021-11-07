<?php
    namespace Denis\DataBaseIntro\Block;

    class TaskFour extends \Magento\Framework\View\Element\Template
    {
        protected $_postFactory;
        protected $_productRepository;
        protected $_imageHelper;

        public function __construct(
            \Magento\Backend\Block\Template\Context $context, 
            \Denis\DataBaseIntro\Model\PostFactory $postFactory,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Magento\Catalog\Helper\Image $imageHelper,
            array $data = []
        ) {
            $this->_postFactory = $postFactory;
            $this->_productRepository = $productRepository;
            $this->_imageHelper = $imageHelper;
            parent::__construct($context, $data);
        }
        
        public function getProductFromSpecCategory($category)
        {
            $masName = []; $i = 0;
            $post = $this->_postFactory->create();
            $collection = $post->getCollection();
            foreach($collection as $item) {
                if($item->getData('id_cat') == $category) {
                    if($item->getData('kol_prod') > 0) {
                        $masName[$i][] = $item->getData('name_war');
                        $masName[$i][] = $item->getData('id_prod');
                        $i++;
                    }
                }
            }
            return $masName;
        }

        public function getProductById($id)
        {
            return $this->_productRepository->getById($id);
        }

        public function getProductImage($id)
        {
            $product = $this->_productRepository->getById($id);
            $image_url = $this->_imageHelper->init($product, 'product_base_image')->getUrl();
            return $image_url;
        }
    }  