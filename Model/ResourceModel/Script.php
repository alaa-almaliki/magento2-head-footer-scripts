<?php

namespace Alaa\HeadFooterScripts\Model\ResourceModel;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Script
 * @package Alaa\HeadFooterScripts\Model\ResourceModel
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Script extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ScriptInterface::TABLE_NAME, ScriptInterface::ATTRIBUTE_ID);
    }
}
