<?php

namespace Alaa\HeadFooterScripts\Model\ResourceModel\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Model\Page as Model;
use Alaa\HeadFooterScripts\Model\ResourceModel\Page as Resource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * uthor Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize Page Collection
     */
    public function _construct()
    {
        $this->_init(Model::class, Resource::class);
        $this->_setIdFieldName(PageInterface::ATTRIBUTE_ID);
    }
}
