<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Page;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}