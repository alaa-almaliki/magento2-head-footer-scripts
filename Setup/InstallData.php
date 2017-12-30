<?php

namespace Alaa\HeadFooterScripts\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Alaa\HeadFooterScripts\Setup
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class InstallData implements InstallDataInterface
{
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $install = $setup;
        $install->startSetup();
        $install->getConnection()
            ->insertArray(
                'head_footer_script_page',
                ['name', 'layout_handle'],
                [
                    [
                        'All Pages',
                        'default'
                    ],
                    [
                        'Home Page',
                        'cms_index_index'
                    ],
                    [
                        'Category Page',
                        'catalog_category_view'
                    ],
                    [
                        'Product Page',
                        'catalog_product_view'
                    ],
                    [
                        'Cart Page',
                        'checkout_cart_page'
                    ],
                    [
                        'Checkout Page',
                        'checkout_index_index'
                    ],
                    [
                        'Success Page',
                        'checkout_onepage_success'
                    ]
                ]
            );
        $install->endSetup();
    }
}
