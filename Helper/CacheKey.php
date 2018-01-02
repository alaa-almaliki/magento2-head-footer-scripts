<?php

namespace Alaa\HeadFooterScripts\Helper;

/**
 * Class CacheKey
 * @package Alaa\HeadFooterScripts\Helper
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class CacheKey
{
    /**
     * @param $pageLayout
     * @param $area
     * @param $storeId
     * @return string
     */
    public function get($pageLayout, $area, $storeId)
    {
        return implode('_', [$pageLayout, $area, $storeId]);
    }
}