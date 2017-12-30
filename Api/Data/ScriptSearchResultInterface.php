<?php

namespace Alaa\HeadFooterScripts\Api\Data;

use Magento\Framework\Data\SearchResultInterface;

/**
 * Interface ScriptSearchResultInterface
 * @package Alaa\HeadFooterScripts\Api\Data
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface ScriptSearchResultInterface extends SearchResultInterface
{
    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\ScriptInterface[] $items
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptSearchResultInterface
     */
    public function setItems(array $items);

    /**
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface[]
     */
    public function getItems();
}
