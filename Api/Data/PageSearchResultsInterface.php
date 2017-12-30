<?php

namespace Alaa\HeadFooterScripts\Api\Data;

use Magento\Framework\Data\SearchResultInterface;

/**
 * Interface PageSearchResultsInterface
 * @package Alaa\HeadFooterScripts\Api\Data
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface PageSearchResultsInterface extends SearchResultInterface
{
    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\PageInterface[] $items
     * @return \Alaa\HeadFooterScripts\Api\Data\PageSearchResultsInterface
     */
    public function setItems(array $items);

    /**
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface[]
     */
    public function getItems();
}
