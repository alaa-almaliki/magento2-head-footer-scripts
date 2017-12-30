<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script;

use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var ScriptRepositoryInterface
     */
    private $scriptRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param ScriptRepositoryInterface $scriptRepository
     */
    public function __construct(Context $context, ScriptRepositoryInterface $scriptRepository)
    {
        $this->context = $context;
        $this->scriptRepository = $scriptRepository;
    }

    /**
     * @return int|null
     */
    public function getScriptId()
    {
        try {
            return $this->scriptRepository->getById(
                $this->context->getRequest()->getParam('script_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
