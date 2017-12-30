<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Save
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Save extends ScriptController
{
    /**
     * Save constructor.
     * @param Action\Context $context
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ScriptRepositoryInterface $scriptRepository
     * @param RedirectFactory $resultRedirectFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        ScriptInterfaceFactory $scriptFactory,
        ScriptRepositoryInterface $scriptRepository,
        RedirectFactory $resultRedirectFactory,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context, $scriptFactory, $scriptRepository);
        $this->resultRedirectFactory = $resultRedirectFactory;
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
        $script = $this->scriptFactory->create();
        if ($postData) {
            $scriptId = (int) $postData['script_id'];
            if ($scriptId !== 0) {
                $script = $this->scriptRepository->getById($scriptId);
                if (!$script->getId()) {
                    $this->messageManager->addErrorMessage(__('The script is no longer exists'));
                    return $redirectResult->setPath('*/*/');
                }
            }

            $script->setTitle($postData['title'])
                ->setArea($postData['area'])
                ->setStores($postData['stores'])
                ->setContent($postData['content'])
                ->setIsActive($postData['is_active'])
                ->setSortOrder($postData['sort_order'])
                ->setPages($postData['pages']);

            try {
                $this->scriptRepository->save($script);
                $this->messageManager->addSuccessMessage(__('Script with id %1 is saved successfully', $script->getId()));
                $this->dataPersistor->clear('script');
                if ($this->getRequest()->getParam('back')) {
                    return $redirectResult->setPath('*/*/edit', ['script_id' => $this->getRequest()->getParam('script_id')]);
                }

                return $redirectResult->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e);
            }
            $this->dataPersistor->set('script', $postData);
            return $redirectResult->setPath('*/*/edit', ['script_id' => $this->getRequest()->getParam('script_id')]);
        }
        return $redirectResult->setPath('*/*/');
    }
}
