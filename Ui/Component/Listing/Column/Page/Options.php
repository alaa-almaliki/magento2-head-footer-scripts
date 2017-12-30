<?php

namespace Alaa\HeadFooterScripts\Ui\Component\Listing\Column\Page;

use Alaa\HeadFooterScripts\Model\Page;
use Alaa\HeadFooterScripts\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Options
 * @package Alaa\HeadFooterScripts\Ui\Component\Listing\Column\Page
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Options implements OptionSourceInterface
{
    /**
     * @var \Alaa\HeadFooterScripts\Model\ResourceModel\Page\Collection
     */
    private $collection;

    /**
     * Options constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collection = $collectionFactory->create();
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        static $options = [];
        if (!empty($options)) {
            return $options;
        }

        /** @var Page $page */
        foreach ($this->collection as $page) {
            $options[] = [
                'label' => $page->getName(),
                'value' => $page->getLayoutHandle()
            ];
        }

        return $options;
    }
}