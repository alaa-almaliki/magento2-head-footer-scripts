<?php

namespace Alaa\HeadFooterScripts\Api\Data;

/**
 * Interface ScriptInterface
 * @package Alaa\HeadFooterScripts\Api\Data
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface ScriptInterface
{
    const TABLE_NAME = 'head_footer_script';
    const CACHE_TAG = 'head_footer_scripts';

    const SCRIPT_AREA_HEAD = 'head';
    const SCRIPT_AREA_FOOTER = 'footer';

    const ATTRIBUTE_ID = 'script_id';
    const ATTRIBUTE_AREA = 'area';
    const ATTRIBUTE_TITLE = 'title';
    const ATTRIBUTE_CONTENT = 'content';
    const ATTRIBUTE_IS_ACTIVE = 'is_active';
    const ATTRIBUTE_STORE_IDS = 'stores';
    const ATTRIBUTE_SORT_ORDER = 'sort_order';
    const ATTRIBUTE_PAGES = 'pages';

    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $area
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setArea($area);

    /**
     * @return string
     */
    public function getArea();

    /**
     * @param string $title
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $content
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param bool $isActive
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setIsActive($isActive);

    /**
     * @return bool
     */
    public function getIsActive();

    /**
     * @param array $storeIds
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setStores(array $storeIds);

    /**
     * @return int[]
     */
    public function getStores();

    /**
     * @param int $sortOrder
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * @return int
     */
    public function getSortOrder();

    /**
     * @param array $pages
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function setPages(array $pages);

    /**
     * @return string[]
     */
    public function getPages();
}
