<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
