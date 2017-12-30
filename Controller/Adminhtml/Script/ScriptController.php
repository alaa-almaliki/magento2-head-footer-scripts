<?php

namespace Alaa\HeadFooterScripts\Controller\Adminhtml\Script;

use Alaa\HeadFooterScripts\Api\Data\ScriptInterfaceFactory;
use Alaa\HeadFooterScripts\Api\ScriptRepositoryInterface;
use Alaa\HeadFooterScripts\Controller\Adminhtml\AbstractController;
use Magento\Backend\App\Action;

/**
 * Class ScriptController
 * @package Alaa\HeadFooterScripts\Controller\Adminhtml\Script
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
abstract class ScriptController extends AbstractController
{
    /**
     * @var ScriptInterfaceFactory
     */
    protected $scriptFactory;

    /**
     * @var ScriptRepositoryInterface
     */
    protected $scriptRepository;

    /**
     * ScriptController constructor.
     * @param Action\Context $context
     * @param ScriptInterfaceFactory $scriptFactory
     * @param ScriptRepositoryInterface $scriptRepository
     */
    public function __construct(
        Action\Context $context,
        ScriptInterfaceFactory $scriptFactory,
        ScriptRepositoryInterface $scriptRepository
    ) {
        parent::__construct($context);
        $this->scriptFactory = $scriptFactory;
        $this->scriptRepository = $scriptRepository;
    }
}
