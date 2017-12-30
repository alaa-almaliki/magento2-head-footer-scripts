<?php

namespace Alaa\HeadFooterScripts\Model;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use \Alaa\HeadFooterScripts\Model\ResourceModel\Script as Resource;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Script
 * @package Alaa\HeadFooterScripts\Model
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Script extends AbstractModel implements ScriptInterface, IdentityInterface
{
    /**
     * Initialize entity
     */
    protected function _construct()
    {
        $this->_init(Resource::class);
    }

    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setId($id)
    {
        $this->setData(self::ATTRIBUTE_ID, $id);
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::ATTRIBUTE_ID);
    }

    /**
     * @param string $area
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setArea($area)
    {
        $this->setData(self::ATTRIBUTE_AREA, $area);
        return $this;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->_getData(self::ATTRIBUTE_AREA);
    }

    /**
     * @param string $title
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setTitle($title)
    {
        $this->setData(self::ATTRIBUTE_TITLE, $title);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_getData(self::ATTRIBUTE_TITLE);
    }

    /**
     * @param string $content
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setContent($content)
    {
        $this->setData(self::ATTRIBUTE_CONTENT, $content);
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_getData(self::ATTRIBUTE_CONTENT);
    }

    /**
     * @param bool $isActive
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setIsActive($isActive)
    {
        $this->setData(self::ATTRIBUTE_IS_ACTIVE, $isActive);
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->_getData(self::ATTRIBUTE_IS_ACTIVE);
    }

    /**
     * @param array $storeIds
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setStores(array $storeIds)
    {
        $this->setData(self::ATTRIBUTE_STORE_IDS, implode(',', $storeIds));
        return $this;
    }

    /**
     * @return int[]
     */
    public function getStores()
    {
        return explode(',', $this->_getData(self::ATTRIBUTE_STORE_IDS));
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @param int $sortOrder
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setSortOrder($sortOrder)
    {
        $this->setData(self::ATTRIBUTE_SORT_ORDER, $sortOrder);
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->_getData(self::ATTRIBUTE_SORT_ORDER);
    }

    /**
     * @param array $pages
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setPages(array $pages)
    {
        $this->setData(self::ATTRIBUTE_PAGES, implode(',', $pages));
        return $this;
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return explode(',', $this->_getData(self::ATTRIBUTE_PAGES));
    }
}
