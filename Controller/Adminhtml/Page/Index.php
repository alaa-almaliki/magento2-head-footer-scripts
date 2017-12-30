<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Index extends PageController
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $pageFactory, $pageRepository);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $page = $this->resultPageFactory->create();
        $page->getConfig()->getTitle()->set('Head Footer Script Page');
        $page->setActiveMenu('Alaa_HeadFooterScripts::scripts_settings');
        return $page;
    }

}
