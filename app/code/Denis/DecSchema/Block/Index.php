<?php
    namespace Denis\DecSchema\Block;

    class Index extends \Magento\Framework\View\Element\Template {
        protected $_salesFactory;

        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Denis\DecSchema\Model\SalesFactory $salesFactory
        ) {
            parent::__construct($context);
            $this->_salesFactory = $salesFactory;
        }

        public function getSales() {
            $post = $this->_salesFactory->create();
            $collection = $post->getCollection();
            return $collection;
        }

        public function getSalesByProduct($product) {
            $collection = $this->_salesFactory->create()->getCollection()
            ->addFieldToFilter('name_sold_product', $product);
            return $collection;
        }
}