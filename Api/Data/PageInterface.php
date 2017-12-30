<?php

namespace Alaa\HeadFooterScripts\Api\Data;

/**
 * Interface PageInterface
 * @package Alaa\HeadFooterScripts\Api\Data
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface PageInterface
{
    const TABLE_NAME = 'head_footer_script_page';
    const CACHE_TAG = 'head_footer_script_page';

    const ATTRIBUTE_ID = 'page_id';
    const ATTRIBUTE_NAME = 'name';
    const ATTRIBUTE_LAYOUT_HANDLE = 'layout_handle';

    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $name
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $layoutHandle
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function setLayoutHandle($layoutHandle);

    /**
     * @return string
     */
    public function getLayoutHandle();
}
