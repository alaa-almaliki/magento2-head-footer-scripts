<?php

namespace Alaa\HeadFooterScripts\Model\Scripts;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Alaa\HeadFooterScripts\Helper\CacheKey;
use Alaa\HeadFooterScripts\Model\Indexer\ScriptIndexer\Helper;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Renderer
 * @package Alaa\HeadFooterScripts\Model\Scripts
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Renderer
{
    /**
     * @var Helper
     */
    private $indexerHelper;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CacheKey
     */
    private $cacheKey;

    /**
     * Renderer constructor.
     * @param Helper $indexerHelper
     * @param RequestInterface $request
     * @param StoreManagerInterface $storeManager
     * @param CacheInterface $cache
     * @param CacheKey $cacheKey
     */
    public function __construct(
        Helper $indexerHelper,
        RequestInterface $request,
        StoreManagerInterface $storeManager,
        CacheInterface $cache,
        CacheKey $cacheKey
    ) {
        $this->indexerHelper = $indexerHelper;
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->cache = $cache;
        $this->cacheKey = $cacheKey;
    }

    /**
     * @param string $area
     * @return string
     */
    public function render($area)
    {
        $pageHandle = $this->request->getFullActionName();
        $cacheKey = $this->cacheKey->get($pageHandle, $area, $this->storeManager->getStore()->getId());
        $content = unserialize($this->cache->load($cacheKey));
        if (strlen($content) > 0) {
            return $content;
        }

        $scripts = $this->indexerHelper->getScripts($pageHandle, $area);
        foreach ($scripts as $script) {
            $content .= PHP_EOL . $script['content'] . PHP_EOL;
        }

        if (strlen($content) > 0) {
            $this->cache->save(serialize($content), $cacheKey);
        }

        return $content;
    }

    /**
     * Render footer script
     */
    public function renderFooterScripts()
    {
        if ($footerScripts = $this->getFooterScripts()) {
            echo $footerScripts;
        }
    }

    /**
     * Render head script
     */
    public function renderHeadScripts()
    {
        if ($headScripts = $this->getHeadScripts()) {
            echo $headScripts;
        }
    }

    /**
     * @return string
     */
    public function getFooterScripts()
    {
        return $this->render(ScriptInterface::SCRIPT_AREA_FOOTER);
    }

    /**
     * @return string
     */
    public function getHeadScripts()
    {
        return $this->render(ScriptInterface::SCRIPT_AREA_HEAD);
    }
}
