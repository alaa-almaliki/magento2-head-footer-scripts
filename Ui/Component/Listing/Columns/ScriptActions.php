<?php

namespace Alaa\HeadFooterScripts\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class ScriptActions
 * @package Alaa\HeadFooterScripts\Ui\Component\Listing\Columns
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScriptActions extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * ScriptActions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'head_footer_scripts/script/edit',
                        ['script_id' => $item['script_id']]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];

                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'head_footer_scripts/script/delete',
                        ['script_id' => $item['script_id']]
                    ),
                    'label' => __('Delete'),
                    'hidden' => false,
                ];

                $item[$this->getData('name')]['activate'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'head_footer_scripts/script/active',
                        ['script_id' => $item['script_id'], 'active' => 1]
                    ),
                    'label' => __('Activate'),
                    'hidden' => false,
                ];

                $item[$this->getData('name')]['deactivate'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'head_footer_scripts/script/active',
                        ['script_id' => $item['script_id'], 'active' => 0]
                    ),
                    'label' => __('Deactivate'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
