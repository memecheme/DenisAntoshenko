<?php
    namespace Denis\DecSchema\Controller\Index;
    
    class AddSalesData extends \Magento\Framework\App\Action\Action {
        protected $_salesFactory;

        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Denis\DecSchema\Model\SalesFactory $salesFactory
        ) {
            $this->_salesFactory = $salesFactory;
            return parent::__construct($context);
        }

        public function execute() {
            $saleDT6 = $this->_salesFactory->create();
            $saleDT6->setData([
                'name_sold_product' => 'Mandarin',
                'amount_sold_product' => 20,
                'sale_date' => '2021-11-12',
                'bonus' => 0.09,
                'price_sold_product' => 6
            ]);
            $saleDT6->save();

            $saleDT7 = $this->_salesFactory->create();
            $saleDT7->setData([
                'name_sold_product' => 'Orange',
                'amount_sold_product' => 10,
                'sale_date' => '2021-11-12',
                'bonus' => 0.09,
                'price_sold_product' => 8
            ]);
            $saleDT7->save();

        return $this->_redirect('decschema/index/index');
        }
    }