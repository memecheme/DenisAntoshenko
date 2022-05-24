<?php
namespace Denis\UIPractice\Ui\Component\Listing\Column;

class SCActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_REPLY_PATH = 'uipractice/index/reply';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param \Magento\Framework\UrlInterface                              $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')] = [
                        'reply' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_REPLY_PATH,
                                [
                                    'id' => $item['id'
                                    ],
                                ]
                            ),
                            'label' => __('Reply'),
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}