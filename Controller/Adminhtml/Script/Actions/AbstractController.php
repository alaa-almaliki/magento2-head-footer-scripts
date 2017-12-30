<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script\Actions;

use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Alaa\HeadFooterScripts\Model\ResourceModel\Script\CollectionFactory;

/**
 * Class AbstractController
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script\Actions
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
abstract class AbstractController extends Action
{
    /**
     * @var RedirectFactory
     */
    protected $redirectFactory;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ScriptRepositoryInterface
     */
    protected $scriptRepository;

    /**
     * AbstractController constructor.
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ScriptRepositoryInterface $scriptRepository
     */
    public function __construct(
        Context $context,
        RedirectFactory $redirectFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ScriptRepositoryInterface $scriptRepository
    ) {
        parent::__construct($context);
        $this->redirectFactory = $redirectFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->scriptRepository = $scriptRepository;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Alaa_HeadFooterScripts::scripts_settings');
    }
}
