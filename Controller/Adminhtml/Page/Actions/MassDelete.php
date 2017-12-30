<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Page\Actions;

use Magento\Framework\App\ResponseInterface;

/**
 * Class MassDelete
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Page\Actions
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class MassDelete extends AbstractController
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
        /** @var \Alaa\HeadFooterScripts\Api\Data\PageInterface $page */
        foreach ($collection as $page) {
            try {
                $this->pageRepository->delete($page);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirectResult->setPath('*/*/');
            }
        }
        $this->messageManager->addSuccessMessage(__('%1 pages were deleted', $collectionSize));
        return $redirectResult->setPath('*/*/');
    }
}
