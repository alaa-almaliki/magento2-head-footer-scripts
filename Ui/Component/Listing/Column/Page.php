<?php

namespace Alaa\HeadFooterScripts\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Page
 * @package Alaa\HeadFooterScripts\Ui\Component\Listing\Column
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Page extends Column
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }

        return $dataSource;
    }

    /**
     * @param array $item
     * @return string
     */
    public function prepareItem(array &$item)
    {
        $pages = $item['pages'];
        $pagesContent = str_replace(',', '<br />', $pages);
        return $pagesContent;
    }
}
