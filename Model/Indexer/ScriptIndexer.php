<?php

namespace Alaa\HeadFooterScripts\Model\Indexer;

use Alaa\HeadFooterScripts\Model\Indexer\ScriptIndexer\Helper;
use Magento\Framework\Indexer\ActionInterface as IndexerActionInterface;
use Magento\Framework\Mview\ActionInterface as MviewActionInterface;

/**
 * Class ScriptIndexer
 * @package Alaa\HeadFooterScripts\Model\Indexer
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScriptIndexer implements IndexerActionInterface, MviewActionInterface
{
    /**
     * @var Helper
     */
    private $helper;

    /**
     * ScriptIndexer constructor.
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Execute full indexation
     *
     * @return void
     */
    public function executeFull()
    {
        $this->helper->indexScripts();
    }

    /**
     * Execute partial indexation by ID list
     *
     * @param int[] $ids
     * @return void
     */
    public function executeList(array $ids)
    {
        $this->helper->indexScriptsByIds($ids);
    }

    /**
     * Execute partial indexation by ID
     *
     * @param int $id
     * @return void
     */
    public function executeRow($id)
    {
        $this->helper->indexScriptById($id);
    }

    /**
     * Execute materialization on ids entities
     *
     * @param int[] $ids
     * @return void
     * @api
     */
    public function execute($ids)
    {
        $this->helper->indexScriptsByIds($ids);
    }
}
