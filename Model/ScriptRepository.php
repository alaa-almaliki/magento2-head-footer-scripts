<?php

namespace Alaa\HeadFooterScripts\Model;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\Data\ScriptSearchResultInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Alaa\HeadFooterScripts\Helper\SearchResultHelper;
use Alaa\HeadFooterScripts\Model\ResourceModel\Script\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class ScriptRepository
 * @package Alaa\HeadFooterScripts\Model
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScriptRepository implements ScriptRepositoryInterface
{
    /**
     * @var ResourceModel\Script
     */
    private $resourceModel;

    /**
     * @var ScriptInterfaceFactory
     */
    private $scriptFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ScriptSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var SearchResultHelper
     */
    private $searchResultHelper;

    /**
     * ScriptRepository constructor.
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ResourceModel\Script $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param ScriptSearchResultInterfaceFactory $searchResultFactory
     * @param SearchResultHelper $searchResultHelper
     */
    public function __construct(
        ScriptInterfaceFactory $scriptFactory,
        ResourceModel\Script $resourceModel,
        CollectionFactory $collectionFactory,
        ScriptSearchResultInterfaceFactory $searchResultFactory,
        SearchResultHelper $searchResultHelper
    ) {
        $this->resourceModel = $resourceModel;
        $this->scriptFactory = $scriptFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->searchResultHelper = $searchResultHelper;
    }

    /**
     * @param int $id
     * @return \Alaa\HeadFooterScripts\Api\Data\ScriptInterface
     */
    public function getById($id)
    {
        $scriptModel = $this->scriptFactory->create();
        $this->resourceModel->load($scriptModel, $id);
        return $scriptModel;
    }

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\ScriptInterface $script
     * @return void
     */
    public function save(ScriptInterface $script)
    {
        $this->resourceModel->save($script);
    }

    /**
     * @param \Alaa\HeadFooterScripts\Api\Data\ScriptInterface $script
     * @return void
     */
    public function delete(ScriptInterface $script)
    {
        $this->resourceModel->delete($script);
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Data\SearchResultInterface|\Alaa\HeadFooterScripts\Api\Data\ScriptSearchResultInterface
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
