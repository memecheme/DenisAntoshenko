<?php
namespace Denis\UIPractice\Block\Adminhtml\Index\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Send extends Generic implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Send'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'uipractice_form.uipractice_form',
                                'actionName' => 'save',
                                'params' => [false],
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }
}