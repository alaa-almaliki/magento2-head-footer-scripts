<?php

namespace Alaa\HeadFooterScripts\Ui\DataProvider\Listing;

use Alaa\HeadFooterScripts\Model\ResourceModel\Script\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class ScriptDataProvider
 * @package Alaa\HeadFooterScripts\Ui\DataProvider\Listing
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScriptDataProvider extends AbstractDataProvider
{
    /**
     * @var \Alaa\HeadFooterScripts\Model\ResourceModel\Script\Collection
     */
    protected $collection;

    /**
     * ScriptDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!$this->collection->isLoaded()) {
            $this->collection->addFieldToSelect('*');
        }
        $data =  parent::getData();

        foreach ($data['items'] as &$item) {
            $stores = explode(',',  $item['stores']);
            $item['stores'] =  $stores;
        }

        return $data;
    }
}
