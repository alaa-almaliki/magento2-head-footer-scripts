<?php

namespace Alaa\HeadFooterScripts\Helper;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class SearchResultHelper
 * @package Alaa\HeadFooterScripts\Helper
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class SearchResultHelper
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    public function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            if (!empty($fields)) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    public function addSortOrderToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() === SortOrder::SORT_ASC ? : SortOrder::SORT_DESC;
            $collection->setOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    public function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchResultInterface $searchResult
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     * @return SearchResultInterface
     */
    public function buildSearchResult(
        SearchResultInterface $searchResult,
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());
        return $searchResult;
    }
}