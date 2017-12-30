<?php

namespace Alaa\HeadFooterScripts\Plugin;

use Alaa\HeadFooterScripts\Model\Indexer\ScriptIndexer\Helper;

/**
 * Class IndexScript
 * @package Alaa\HeadFooterScripts\Plugin
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class IndexScript
{
    /**
     * @var Helper
     */
    private $indexerHelper;

    /**
     * IndexScript constructor.
     * @param Helper $indexerHelper
     */
    public function __construct(Helper $indexerHelper)
    {
        $this->indexerHelper = $indexerHelper;
    }

    /**
     * @param \Alaa\HeadFooterScripts\Model\ResourceModel\Script $subject
     * @param callable $proceed
     * @param \Alaa\HeadFooterScripts\Model\Script $script
     */
    public function aroundSave(
        \Alaa\HeadFooterScripts\Model\ResourceModel\Script $subject,
        callable $proceed,
        \Alaa\HeadFooterScripts\Model\Script $script
    ) {
        $proceed($script);
        $this->indexerHelper->indexScript($script);
    }
}
