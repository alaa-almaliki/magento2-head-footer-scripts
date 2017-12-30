<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Delete
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Delete extends PageController
{

    /**
     * @var RedirectFactory
     */
    private $redirectFactory;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Action\Context $context,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context, $pageFactory, $pageRepository);
        $this->redirectFactory = $redirectFactory;
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
        $redirectResult = $this->redirectFactory->create();
        $pageId = $this->getRequest()->getParam('page_id', 0);
        if ($pageId) {
            $page = $this->pageRepository->getById($pageId);
            if ($page->getId()) {
                try {
                    $this->pageRepository->delete($page);
                    $this->messageManager->addSuccessMessage(
                        __('Page with id %1 has been deleted successfully', $pageId)
                    );
                    return $redirectResult->setPath('*/*/');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                    return $redirectResult->setPath('*/*/edit', ['page_id', $page->getId()]);
                }
            }
        }
        $this->messageManager->addErrorMessage(__('Page with id %1 is no longer exist', $pageId));
        return $redirectResult->setPath('*/*/');
    }
}
