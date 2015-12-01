Summary
------------------------

**THIS IS NOT PRODUCTION READY, COPY-PASTE, MAGENTO 2 MODULE**

Showcasing the concept of customer order history migration, from old website into fresh Magento2 website.

Motivation
------------------------
 
Assumptions:

- you just want your customers to feel at home on new website and prevent "Where are my old orders ?" question.
- you want to provide read-only access to historical orders, without Reorder action.
- you want to display historical orders temporary, and be able to easy deactivate historical orders display at some point in the future
- you want to prevent performance issues caused by starting the fresh new Magento 2 website with already full orders database table 
- you can ensure that all uncompleted orders from old website are either completed before new website is published or handled by some other system (ERP,...) 

In this scenario, creation of Magento order entities for historical customer orders, is questionable approach, yet, it is usual first choice taken.
Instead, we can apply the concept from this repository.

Technical feature
------------------------

The custom flat database tables are created, for historical orders and their order items, and filled with historical orders data.
The custom order view page is added, displaying historical order data from custom tables. The view can be single template, matching design of default order view page.
The collection displayed on My Account -> My Orders page, is rebuild, using the blank \Magento\Framework\Data\Collection filled with:

- normal orders from new website. Initially, there will be no new orders on fresh website.
- historical orders for specific customer. This assumes that customers are migrated from old website before orders, so valid customer_id is available when orders are imported.



Installation
------------------------

Enter following commands to install module:

```bash
cd MAGE2_ROOT_DIR
# install
composer config repositories.vuleticd_orderhistory git https://github.com/vuleticd/OrderHistory.git
composer require vuleticd/orderhistory:dev-master
# enable
php bin/magento module:enable Vuleticd_OrderHistory --clear-static-content
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Module is instantly enabled, however, it is advisable to create configuration On/Off switch for this module functionality.

Uninstall
------------------------

Enter following commands to disable and uninstall module:

```bash
cd MAGE2_ROOT_DIR
# disable
php bin/magento module:disable Vuleticd_OrderHistory --clear-static-content    
# uninstall
php bin/magento module:uninstall Vuleticd_OrderHistory --clear-static-content
php bin/magento setup:static-content:deploy
```
