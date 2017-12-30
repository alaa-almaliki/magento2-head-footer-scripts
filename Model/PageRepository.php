<?php

namespace Alaa\HeadFooterScripts\Model;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\Data\PageSearchResultsInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Alaa\HeadFooterScripts\Helper\SearchResultHelper;
use Alaa\HeadFooterScripts\Model\ResourceModel\Page;
use Alaa\HeadFooterScripts\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class PageRepository
 * @package Alaa\HeadFooterScripts\Model
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class PageRepository implements PageRepositoryInterface
{
    /**
     * @var ResourceModel\Page
     */
    private $resourceModel;

    /**
     * @var PageInterfaceFactory
     */
    private $pageFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var SearchResultHelper
     */
    private $searchResultHelper;

    /**
     * @var PageSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * PageRepository constructor.
     * @param Page $resourceModel
     * @param PageInterfaceFactory $pageFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultHelper $searchResultHelper
     * @param PageSearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        Page $resourceModel,
        PageInterfaceFactory $pageFactory,
        CollectionFactory $collectionFactory,
        SearchResultHelper $searchResultHelper,
        PageSearchResultsInterfaceFactory $searchResultFactory
    )
    {
        $this->resourceModel = $resourceModel;
        $this->pageFactory = $pageFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultHelper = $searchResultHelper;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function getById($id)
    {
        $page = $this->pageFactory->create();
        $this->resourceModel->load($page, $id);
        return $page;
    }

    /**
     * @param string $layoutHandle
     * @return \Alaa\HeadFooterScripts\Api\Data\PageInterface
     */
    public function getByLayoutHandle($layoutHandle)
    {
        $page = $this->pageFactory->create();
        $this->resourceModel->load($page, $layoutHandle, PageInterface::ATTRIBUTE_LAYOUT_HANDLE);
        return $page;
    }

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\PageInterface $page
     * @return void
     */
    public function save(PageInterface $page)
    {
        $this->resourceModel->save($page);
    }

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\PageInterface $page
     * @return void
     */
    public function delete(PageInterface $page)
    {
        $this->resourceModel->delete($page);
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Data\SearchResultInterface|\Alaa\HeadFooterScripts\Api\Data\PageSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->searchResultHelper->addFiltersToCollection($searchCriteria, $collection);
        $this->searchResultHelper->addPagingToCollection($searchCriteria, $collection);
        $this->searchResultHelper->addPagingToCollection($searchCriteria, $collection);
        $collection->load();
        $searchResults = $this->searchResultFactory->create();
        return $this->searchResultHelper->buildSearchResult($searchResults, $searchCriteria, $collection);
    }
}
