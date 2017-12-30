<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getScriptId()) {
            $data = [
                'label' => __('Delete Script'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['script_id' => $this->getScriptId()]);
    }
}
