<?php
    namespace Denis\DataBaseIntro\Block;

    class AdditionalTask extends \Magento\Framework\View\Element\Template
    {
        protected $_postFactory;
        protected $_registry;

        public function __construct(
            \Magento\Backend\Block\Template\Context $context, 
            \Denis\DataBaseIntro\Model\PostFactory $postFactory,
            \Magento\Framework\Registry $registry,
            array $data = []
        ) {
            $this->_postFactory = $postFactory;
            $this->_registry = $registry;
            parent::__construct($context, $data);
        }
        
        public function getInfoFromCurrentProduct($product)
        {
            $result = '';
            $post = $this->_postFactory->create();
            $collection = $post->getCollection();
            foreach($collection as $item) {
                if($item->getData('id_prod') == $product) {
                    if($item->getData('kol_prod') > 0) {
                        $result = 'Название склада: ' . $item->getData('name_war') . 
                                  '<br>Адрес склада: ' . $item->getData('addr_war') .
                                  '<br>Количество продукта: ' . $item->getData('kol_prod');
                    }
                }
            }
            return $result;
        }

        public function getCurrentProduct()
        {        
            return $this->_registry->registry('current_product');
        }
    }  