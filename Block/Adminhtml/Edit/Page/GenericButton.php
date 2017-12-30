<?php

namespace Alaa\HeadFooterScripts\Block\Adminhtml\Edit\Page;

use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 * @package Alaa\HeadFooterScripts\Block\Adminhtml\Edit
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(Context $context, PageRepositoryInterface $pageRepository)
    {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return int|null
     */
    public function getPageId()
    {
        try {
            return $this->pageRepository->getById(
                $this->context->getRequest()->getParam('page_id')
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
