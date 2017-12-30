<?php

namespace Alaa\HeadFooterScripts\Api;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ScriptRepositoryInterface
 * @package Alaa\HeadFooterScripts\Api
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface ScriptRepositoryInterface
{
    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function getById($id);

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\ScriptInterface $script
     * @return void
     */
    public function save(ScriptInterface $script);

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\ScriptInterface $script
     * @return void
     */
    public function delete(ScriptInterface $script);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}