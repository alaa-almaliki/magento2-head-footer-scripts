# Magento2 Head Footer Scripts
The extension enables developers and merchants to add scripts to head or footer by adding them from the admin panel.

# Supported Versions
The module is tested on community edition versions 2.1.9, 2.2.0, 2.2.1, and 2.2.2

# Features
* It comes with a list of pages out of the box such as: All Pages, Home Page, Category Page, Product Page, Cart Page, Checkout Page, and Success Page.
* More pages can be added.
* It supports store views.
* It is configurable with feature switch, so you can turn it off by disabling the functionality
* Scripts are cached once loaded from the db, so the page load is reduced to minimum and all page related scripts are cached in one file.
* Scripts are ordered by their sort order values, so the order of which script is included before others is simply configurable.
* It reduces development time for developers and is a convenient way for merchants to add scripts on which page sections and which pages.
* The module does not add an extra layer of complexity, try it out, you like it use it otherwise trash it at no expense.

# Installation
1. `composer require alaa/magento2-head-footer-scripts:1.0.0`
2. `php bin/magento module:enable Alaa_HeadFooterScripts`
3. `php bin/magento setup:upgrade`

# Usage
* The module is enabled by default, but it can be disabled from **Admin > Stores > Configuration > Head Footer Scripts** section
* Add Scripts from **Admin > Head Footer Scripts > Scripts**
* Add more pages from **Admin > Head Footer Scripts > Pages**
* Once a new script is saved, it is indexed by its pages (Layout Handles) and stores
* Editing existing or saving new scripts will need to flush `block_html` cache to take effect
* It can be re-indexed by running the command `php bin/magento indexer:reindex head_footer_script`

# Contribution
Please feel free to raise any issues and contribute if you have found any bugs or want to add any missing features

# Licence
MIT