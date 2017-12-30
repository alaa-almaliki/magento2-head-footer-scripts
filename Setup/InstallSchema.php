<?php

namespace Alaa\HeadFooterScripts\Setup;

use Alaa\HeadFooterScripts\Api\Data\PageInterface;
use Alaa\HeadFooterScripts\Model\Script;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Alaa\HeadFooterScripts\Setup
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();

        $scriptTableName = $installer->getTable(Script::TABLE_NAME);
        $scriptTable = $connection->newTable($scriptTableName)
            ->addColumn(
                Script::ATTRIBUTE_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Script ID'
            )->addColumn(
                Script::ATTRIBUTE_AREA,
                Table::TYPE_TEXT,
                255,
                ['identity' => false, 'nullable' => false],
                'Script Area'
            )->addColumn(
                Script::ATTRIBUTE_TITLE,
                Table::TYPE_TEXT,
                255,
                ['identity' => false, 'nullable' => true],
                'Script Title'
            )->addColumn(
                Script::ATTRIBUTE_CONTENT,
                Table::TYPE_TEXT,
                255,
                ['identity' => false, 'nullable' => false],
                'Script Content'
            )->addColumn(
                Script::ATTRIBUTE_IS_ACTIVE,
                Table::TYPE_SMALLINT,
                2,
                ['identity' => false, 'unsigned' => true, 'nullable' => false],
                'Script Is Active'
            )->addColumn(
                Script::ATTRIBUTE_STORE_IDS,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Script Store Ids'
            )->addColumn(
                Script::ATTRIBUTE_PAGES,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Script Pages'
            )->addColumn(
                Script::ATTRIBUTE_SORT_ORDER,
                Table::TYPE_SMALLINT,
                null,
                ['identity' => false, 'unsigned' => true, 'nullable' => false],
                'Script Sort Order'
            )->addIndex(
                $setup->getIdxName($scriptTableName, [Script::ATTRIBUTE_ID, Script::ATTRIBUTE_AREA]),
                [Script::ATTRIBUTE_ID, Script::ATTRIBUTE_AREA],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            )->setComment('Head Footer Script');

        if (!$setup->tableExists($scriptTableName)) {
            $connection->createTable($scriptTable);
        }

        $pageTableName = $installer->getTable(PageInterface::TABLE_NAME);
        $pageTable = $connection->newTable($pageTableName)
            ->addColumn(
                PageInterface::ATTRIBUTE_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Page ID'
            )->addColumn(
                PageInterface::ATTRIBUTE_NAME,
                Table::TYPE_TEXT,
                255,
                ['identity' => false, 'nullable' => false],
                'Page Name'
            )->addColumn(
                PageInterface::ATTRIBUTE_LAYOUT_HANDLE,
                Table::TYPE_TEXT,
                255,
                ['identity' => false, 'nullable' => false],
                'Layout Handle'
            )->addIndex(
                $setup->getIdxName($scriptTableName, [PageInterface::ATTRIBUTE_LAYOUT_HANDLE]),
                [PageInterface::ATTRIBUTE_LAYOUT_HANDLE],
                ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
            )->setComment('Head Footer Script Page');

        if (!$setup->tableExists($pageTableName)) {
            $connection->createTable($pageTable);
        }

        $indexTableName = $installer->getTable('head_footer_script_page_index');
        $indexTable = $connection->newTable($indexTableName)
            ->addColumn(
                'script_page_index_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Index ID'
            )->addColumn(
                PageInterface::ATTRIBUTE_ID,
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Page ID'
            )->addColumn(
                Script::ATTRIBUTE_ID,
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Script ID'
            )->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Store Id'
            )->addForeignKey(
                $installer->getFkName('head_footer_script_page_index', 'script_id', 'head_footer_script', 'script_id'),
                'script_id',
                $installer->getTable('head_footer_script'),
                'script_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('head_footer_script_page_index', 'page_id', 'head_footer_script_page', 'page_id'),
                'page_id',
                $installer->getTable('head_footer_script_page'),
                'page_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('head_footer_script_page_index', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )->setComment('Head Footer Script Page Index Table');

        if (!$setup->tableExists($indexTableName)) {
            $connection->createTable($indexTable);
        }
        $installer->endSetup();
    }
}
