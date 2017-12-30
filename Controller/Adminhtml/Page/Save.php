<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page;

use Alaa\HeadFooterScripts\Api\Data\PageInterfaceFactory;
use Alaa\HeadFooterScripts\Api\PageRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Save
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Save extends PageController
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param PageInterfaceFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     * @param RedirectFactory $resultRedirectFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PageInterfaceFactory $pageFactory,
        PageRepositoryInterface $pageRepository,
        RedirectFactory $resultRedirectFactory,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context, $pageFactory, $pageRepository);
        $this->dataPersistor = $dataPersistor;
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
        $redirectResult = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();
        $page = $this->pageFactory->create();
        if ($postData) {
            $pageId = (int) $postData['page_id'];
            if ($pageId !== 0) {
                $page = $this->pageRepository->getById($pageId);
                if (!$page->getId()) {
                    $this->messageManager->addErrorMessage(__('The Page is no longer exists'));
                    return $redirectResult->setPath('*/*/');
                }
            }
            $page->setName($postData['name'])
                ->setLayoutHandle($postData['layout_handle']);

            try {
                $this->pageRepository->save($page);
                $this->messageManager->addSuccessMessage(__('Page with id %1 is saved successfully', $page->getId()));
                $this->dataPersistor->clear('page');
                if ($this->getRequest()->getParam('back')) {
                    return $redirectResult->setPath('*/*/edit', ['page_id' => $this->getRequest()->getParam('page_id')]);
                }

                return $redirectResult->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e);
            }
            $this->dataPersistor->set('script', $postData);
            return $redirectResult->setPath('*/*/edit', ['page_id' => $this->getRequest()->getParam('page_id')]);
        }
        return $redirectResult->setPath('*/*/');
    }
}