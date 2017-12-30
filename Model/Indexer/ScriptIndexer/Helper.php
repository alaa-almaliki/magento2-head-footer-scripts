<?php

namespace Alaa\HeadFooterScripts\Model\Indexer\ScriptIndexer;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Alaa\HeadFooterScripts\Model\ResourceModel\Script\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Helper
 * @package Alaa\HeadFooterScripts\Model\Indexer\ScriptIndexer
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Helper
{
    /**
     * Indexer Table
     */
    const SCRIPT_PAGE_INDEX_TABLE = 'head_footer_script_page_index';

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $connection;

    /**
     * @var ScriptRepositoryInterface
     */
    private $scriptRepository;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Helper constructor.
     * @param ResourceConnection $resourceConnection
     * @param ScriptRepositoryInterface $scriptRepository
     * @param CollectionFactory $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        ScriptRepositoryInterface $scriptRepository,
        CollectionFactory $collectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeManager
    ) {
        $this->connection= $resourceConnection->getConnection();
        $this->scriptRepository = $scriptRepository;
        $this->collectionFactory = $collectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
    }

    /**
     * @param $pageLayout
     * @param $area
     * @param null $storeId
     * @return array
     */
    public function getScripts($pageLayout, $area, $storeId = null)
    {
        $pageIds = $this->getPageIds($pageLayout);
        if (empty($pageIds)) {
            return [];
        }

        $storeId = $this->resolveStoreId($storeId);

        $conditions = [
            sprintf('index.page_id IN (%s)', implode(', ', $pageIds)),
            'script.is_active=1',
            sprintf('script.stores IN (%s)', implode(', ', [$storeId, 0])),
            sprintf('script.area="%s"', $area)
        ];

        $sql = $this->connection->select()
            ->from(['index' => self::SCRIPT_PAGE_INDEX_TABLE], ['script_id', 'page_id'])
            ->joinLeft(['script' => 'head_footer_script'], 'index.script_id=script.script_id', '*')
            ->where(implode(' AND ', $conditions))
            ->group(['script.script_id'])
            ->order(['script.sort_order'])
            ->distinct(true);

        return $this->connection->fetchAssoc($sql);
    }

    /**
     * @param $scriptId
     * @return $this|Helper
     */
    public function indexScriptById($scriptId)
    {
        $script = $this->scriptRepository->getById($scriptId);
        if ($script->getId()) {
            return $this->indexScript($script);
        }

        return $this;
    }

    /**
     * @param ScriptInterface $script
     * @return $this
     */
    public function indexScript(ScriptInterface $script)
    {
        if (!$script->getId()) {
            return $this;
        }

        $stores = $script->getStores();
        $pages = $script->getPages();
        $data = [];

        $this->connection->delete(
            self::SCRIPT_PAGE_INDEX_TABLE,
            sprintf('script_id=%d', $script->getId())
        );

        if (in_array(0, $stores)) {
            foreach ($pages as $pageLayout) {
                $data[] = $this->getDataToReindex($script, $pageLayout, 0);
            }
        } else {
            foreach ($stores as $storeId) {
                foreach ($pages as $pageLayout) {
                    $data[] = $this->getDataToReindex($script, $pageLayout, $storeId);
                }
            }
        }

        $columns = array_keys($data[0]);
        $this->connection->insertArray(self::SCRIPT_PAGE_INDEX_TABLE, $columns, $data);
        return $this;
    }

    /**
     * @return $this
     */
    public function indexScripts()
    {
        $collection = $this->collectionFactory->create();
        /** @var ScriptInterface $script */
        foreach ($collection as $script) {
            $this->indexScript($script);
        }

        return $this;
    }

    /**
     * @param array $ids
     * @return $this
     */
    public function indexScriptsByIds(array $ids)
    {
        foreach ($ids as $id) {
            $this->indexScriptById($id);
        }

        return $this;
    }

    /**
     * @param ScriptInterface $script
     * @param $pageLayout
     * @param $storeId
     * @return array
     */
    protected function getDataToReindex(ScriptInterface $script, $pageLayout, $storeId)
    {
        $pageId = $this->getPageId($pageLayout);
        if (!$pageId) {
            return [];
        }

        return [
            'script_id' => $script->getId(),
            'page_id' => $pageId,
            'store_id' => $storeId
        ];
    }

    /**
     * @param int|null $storeId
     * @return int
     */
    protected function resolveStoreId($storeId)
    {
        if ($storeId === null) {
            $storeId = $this->storeManager->getStore()->getId();
        }

        return $storeId;
    }

    /**
     * @param string $pageLayout
     * @return string[]
     */
    protected function getPageIds($pageLayout)
    {
        $pageIds = [];
        if ($defaultPageId = $this->getPageId('default')) {
            $pageIds[] = $defaultPageId;
        }

        if ($pageId = $this->getPageId($pageLayout)) {
            $pageIds[]= $pageId;
        }

        return $pageIds;
    }

    /**
     * @param string $pageLayout
     * @return string|int
     */
    protected function getPageId($pageLayout)
    {
        $sql = $this->connection->select()->from(
            PageInterface::TABLE_NAME,
            ['page_id']
        )->where(sprintf('layout_handle="%s"', $pageLayout));
        return $this->connection->fetchOne($sql);
    }
}
