<?php

namespace Alaa\HeadFooterScripts\Block\Script;

use Alaa\HeadFooterScripts\Model\Scripts\Renderer as ScriptsRenderer;
use Magento\Framework\View\Element\Template;

/**
 * Class Renderer
 * @package Alaa\HeadFooterScripts\Block\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Renderer extends Template
{
    /**
     * @var ScriptsRenderer
     */
    private $scriptsRenderer;

    /**
     * Renderer constructor.
     * @param Template\Context $context
     * @param ScriptsRenderer $scriptsRenderer
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScriptsRenderer $scriptsRenderer,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scriptsRenderer = $scriptsRenderer;
    }

    /**
     *  Render head scripts
     */
    public function renderHeadScripts()
    {
        $this->scriptsRenderer->renderHeadScripts();
    }

    /**
     * Render footer scripts
     */
    public function renderFooterScripts()
    {
        $this->scriptsRenderer->renderFooterScripts();
    }
}
