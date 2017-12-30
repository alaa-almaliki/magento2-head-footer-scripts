<?php

namespace Alaa\HeadFooterScripts\Api;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface PageRepositoryInterface
 * @package Alaa\HeadFooterScripts\Api
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface PageRepositoryInterface
{
    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function getById($id);

    /**
     * @param string $layoutHandle
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function getByLayoutHandle($layoutHandle);

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\PageInterface $page
     * @return void
     */
    public function save(PageInterface $page);

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\PageInterface $page
     * @return void
     */
    public function delete(PageInterface $page);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Alaa\HeadFooterScripts\Api\Data\PageSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
