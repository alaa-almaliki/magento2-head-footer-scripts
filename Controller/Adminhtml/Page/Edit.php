<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Edit extends PageController
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository,
        Registry $registry,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $pageFactory, $pageRepository);
        $this->registry = $registry;
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
        $id = $this->getRequest()->getParam('page_id');
        if ($id !== null) {
            $page = $this->pageRepository->getById($id);
            if (!$page->getId()) {
                $this->messageManager->addErrorMessage(__('This Page no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }

            $this->registry->register('page', $page);
        } else {
            $page = $this->pageFactory->create();
        }


        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Page') : __('New Page'),
            $id ? __('Edit Page') : __('New Page')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Page'));
        $resultPage->getConfig()->getTitle()->prepend($page->getId() ? $page->getTitle() : __('New Page'));
        return $resultPage;
    }

    /**
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage(Page $resultPage)
    {
        $resultPage->setActiveMenu('Alaa_HeadFooterScripts:scripts_operations')
            ->addBreadcrumb(__('Page'), __('Page'))
            ->addBreadcrumb(__('Page'), __('Page'));
        return $resultPage;
    }
}
