<?php

namespace Alaa\HeadFooterScripts\Model\ResourceModel\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Alaa\HeadFooterScripts\Model\ResourceModel\Script as Resource;
use Alaa\HeadFooterScripts\Model\Script as Model;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Alaa\HeadFooterScripts\Model\ResourceModel\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize collection
     */
    protected function _construct()
    {
        $this->_init(Model::class, Resource::class);
        $this->_setIdFieldName(ScriptInterface::ATTRIBUTE_ID);
    }
}
