<?php

namespace Alaa\HeadFooterScripts\Model;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Model\ResourceModel\Page as Resource;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Page
 * @package Alaa\HeadFooterScripts\Model
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Page extends AbstractModel implements PageInterface, IdentityInterface
{
    /**
     * @var \Alaa\HeadFooterScripts\Api\Data\ScriptInterface[]
     */
    protected $scripts = [];

    /**
     * Initialize Page Model
     */
    protected function _construct()
    {
        $this->_init(Resource::class);
    }

    /**
     * @param int|mixed $id
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setId($id)
    {
        $this->setData(self::ATTRIBUTE_ID, $id);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_getData(self::ATTRIBUTE_ID);
    }

    /**
     * @param string $name
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setName($name)
    {
        $this->setData(self::ATTRIBUTE_NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::ATTRIBUTE_NAME);
    }

    /**
     * @param string $layoutHandle
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setLayoutHandle($layoutHandle)
    {
        $this->setData(self::ATTRIBUTE_LAYOUT_HANDLE, $layoutHandle);
        return $this;
    }

    /**
     * @return string
     */
    public function getLayoutHandle()
    {
        return $this->_getData(self::ATTRIBUTE_LAYOUT_HANDLE);
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
