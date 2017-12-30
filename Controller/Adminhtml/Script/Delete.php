<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Delete
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Delete extends ScriptController
{
    /**
     * @var RedirectFactory
     */
    private $redirectFactory;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ScriptRepositoryInterface $scriptRepository
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Action\Context $context,
        ScriptInterfaceFactory $scriptFactory,
        ScriptRepositoryInterface $scriptRepository,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context, $scriptFactory, $scriptRepository);
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
        $scriptId = $this->getRequest()->getParam('script_id', 0);
        if ($scriptId) {
            $script = $this->scriptRepository->getById($scriptId);
            if ($script->getId()) {
                try {
                    $this->scriptRepository->delete($script);
                    $this->messageManager->addSuccessMessage(
                        __('Script with id %1 has been deleted successfully', $scriptId)
                    );
                    return $redirectResult->setPath('*/*/');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                    return $redirectResult->setPath('*/*/edit', ['script_id', $script->getId()]);
                }
            }
        }
        $this->messageManager->addErrorMessage(__('Script with id %1 is no longer exist', $scriptId));
        return $redirectResult->setPath('*/*/');
    }
}
