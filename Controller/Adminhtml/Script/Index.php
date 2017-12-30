<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Index extends ScriptController
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ScriptRepositoryInterface $scriptRepository
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        ScriptInterfaceFactory $scriptFactory,
        ScriptRepositoryInterface $scriptRepository,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $scriptFactory, $scriptRepository);
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
        $page->getConfig()->setContentType('Head Footer Script');
        $page->setActiveMenu('Alaa_HeadFooterScripts::scripts_settings');
        return $page;
    }

}
