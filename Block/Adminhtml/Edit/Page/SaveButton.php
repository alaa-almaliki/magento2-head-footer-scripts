<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Page;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Page'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'Save'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
