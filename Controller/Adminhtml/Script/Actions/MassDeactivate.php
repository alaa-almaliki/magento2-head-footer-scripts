<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script\Actions;

use Magento\Framework\App\ResponseInterface;

/**
 * Class MassDeactivate
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script\Actions
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class MassDeactivate extends AbstractController
{

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
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        /** @var \Alaa\HeadFooterScripts\Api\Data\ScriptInterface $script */
        foreach ($collection as $script) {
            try {
                $script->setIsActive(false);
                $this->scriptRepository->save($script);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirectResult->setPath('*/*/');
            }
        }
        $this->messageManager->addSuccessMessage(__('%1 scripts were deactivated', $collectionSize));
        return $redirectResult->setPath('*/*/');
    }
}
