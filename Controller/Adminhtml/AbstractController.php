<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml;

use Magento\Backend\App\Action;


/**
 * Class AbstractController
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
abstract class AbstractController extends Action
{
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Alaa_HeadFooterScripts::scripts_settings');
    }
}
