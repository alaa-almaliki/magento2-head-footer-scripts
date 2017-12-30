<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Edit extends ScriptController
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
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ScriptRepositoryInterface $scriptRepository
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        ScriptInterfaceFactory $scriptFactory,
        ScriptRepositoryInterface $scriptRepository,
        Registry $registry,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $scriptFactory, $scriptRepository);
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
        $id = $this->getRequest()->getParam('script_id');
        if ($id !== null) {
            $script = $this->scriptRepository->getById($id);
            if (!$script->getId()) {
                $this->messageManager->addErrorMessage(__('This Script no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }

            $this->registry->register('script', $script);
        } else {
            $script = $this->scriptFactory->create();
        }


        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Script') : __('New Script'),
            $id ? __('Edit Script') : __('New Script')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Script'));
        $resultPage->getConfig()->getTitle()->prepend($script->getId() ? $script->getTitle() : __('New Script'));
        return $resultPage;
    }

    /**
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage(Page $resultPage)
    {
        $resultPage->setActiveMenu('Alaa_HeadFooterScripts:scripts_operations')
            ->addBreadcrumb(__('Script'), __('Script'))
            ->addBreadcrumb(__('Script'), __('Script'));
        return $resultPage;
    }
}
