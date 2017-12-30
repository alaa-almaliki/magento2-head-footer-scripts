<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Alaa\HeadFooterScripts\Controller\Adminhtml\AbstractController;
use Magento\Backend\App\Action;

/**
 * Class PageController
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
abstract class PageController extends AbstractController
{
    /**
     * @var PageInterfaceFactory
     */
    protected $pageFactory;

    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepository;

    /**
     * PageController constructor.
     * @param Action\Context $context
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        Action\Context $context,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->pageRepository = $pageRepository;
    }
}
