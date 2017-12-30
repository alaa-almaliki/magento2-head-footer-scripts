<?php

namespace Alaa\HeadFooterScripts\Model\ResourceModel;


use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Api\Data\ScriptInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Page
 * @package Alaa\HeadFooterScripts\Model\ResourceModel
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Page extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PageInterface::TABLE_NAME, PageInterface::ATTRIBUTE_ID);
    }

    /**
     * @param int $pageId
     * @return array
     */
    public function getScriptsData($pageId)
    {
        $connection = $this->getConnection();
        $sql = $connection->select()
            ->from(['index' => 'head_footer_script_page_index'], ['page_id', 'script_id'])
            ->joinLeft(['script' => ScriptInterface::TABLE_NAME], 'index.script_id=script.script_id')
            ->where(sprintf('index.page_id="%s" AND script.is_active=1', $pageId))
            ->group('script.script_id')
            ->distinct(true);

        return $connection->fetchAssoc($sql);
    }
}
