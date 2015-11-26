<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Vuleticd
 * @package     Vuleticd_OrderHistory
 * @copyright   Copyright (c) 2015 Vuletic Dragan (http://www.vuleticd.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Vuleticd\OrderHistory\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

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

		// sales_history_order DB table

		if (!$installer->tableExists($installer->getTable('sales_history_order'))) {
			$table = $installer->getConnection()
				->newTable($installer->getTable('sales_history_order'))
				->addColumn('order_id', Table::TYPE_INTEGER, null, [
					'identity'  => true,
					'unsigned'  => true,
					'nullable'  => false,
					'primary'   => true,
				], 'order Id')
				->addColumn('customer_email', Table::TYPE_TEXT, 255,
						[], 'customer_email')
				->addColumn('customer_id', Table::TYPE_INTEGER, null,
						['unsigned' => true, 'nullable' => false, 'default' => '0'], 'customer_id')
				->addColumn('increment_id', Table::TYPE_TEXT, 50,
						[], 'increment_id')
				->addColumn('state', Table::TYPE_TEXT, 50,
							[], 'state')
				->addColumn('status', Table::TYPE_TEXT, 50,
							[], 'status')
				->addColumn('created_at', Table::TYPE_TIMESTAMP, null,
							[], 'created_at')
				->addColumn('subtotal', Table::TYPE_DECIMAL, '12,4',
							[], 'subtotal')
				->addColumn('shipping_amount', Table::TYPE_DECIMAL, '12,4',
							[], 'shipping_amount')
				->addColumn('discount_amount', Table::TYPE_DECIMAL, '12,4',
							[], 'discount_amount')
				->addColumn('grand_total', Table::TYPE_DECIMAL, '12,4',
							[], 'grand_total')
				->addColumn('shipping_method', Table::TYPE_TEXT, 255,
							[], 'shipping_method')
				->addColumn('shipping_description', Table::TYPE_TEXT, 255,
							[], 'shipping_description')
				->addColumn('shipping_address_prefix', Table::TYPE_TEXT, 255,
							[], 'shipping_address_prefix')
				->addColumn('shipping_address_firstname', Table::TYPE_TEXT, 255,
							[], 'shipping_address_firstname')
				->addColumn('shipping_address_lastname', Table::TYPE_TEXT, 255,
							[], 'shipping_address_lastname')
				->addColumn('shipping_address_company', Table::TYPE_TEXT, 255,
							[], 'shipping_address_company')
				->addColumn('shipping_address_street', Table::TYPE_TEXT, 255,
							[], 'shipping_address_street')
				->addColumn('shipping_address_postcode', Table::TYPE_TEXT, 255,
							[], 'shipping_address_postcode')
				->addColumn('shipping_address_country_id', Table::TYPE_TEXT, 255,
							[], 'shipping_address_country_id')
				->addColumn('shipping_address_region', Table::TYPE_TEXT, 255,
							[], 'shipping_address_region')
				->addColumn('shipping_address_city', Table::TYPE_TEXT, 255,
							[], 'shipping_address_city')
				->addColumn('shipping_address_district', Table::TYPE_TEXT, 255,
							[], 'shipping_address_district')
				->addColumn('shipping_address_telephone', Table::TYPE_TEXT, 255,
							[], 'shipping_address_telephone')
				->addColumn('shipping_address_mobile_phone_number', Table::TYPE_TEXT, 255,
							[], 'shipping_address_mobile_phone_number')
				->addColumn('billing_address_prefix', Table::TYPE_TEXT, 255,
							[], 'billing_address_prefix')
				->addColumn('billing_address_firstname', Table::TYPE_TEXT, 255,
							[], 'billing_address_firstname')
				->addColumn('billing_address_lastname', Table::TYPE_TEXT, 255,
							[], 'billing_address_lastname')
				->addColumn('billing_address_company', Table::TYPE_TEXT, 255,
							[], 'billing_address_company')
				->addColumn('billing_address_street', Table::TYPE_TEXT, 255,
							[], 'billing_address_street')
				->addColumn('billing_address_postcode', Table::TYPE_TEXT, 255,
							[], 'billing_address_postcode')
				->addColumn('billing_address_country_id', Table::TYPE_TEXT, 255,
							[], 'billing_address_country_id')
				->addColumn('billing_address_region', Table::TYPE_TEXT, 255,
							[], 'billing_address_region')
				->addColumn('billing_address_city', Table::TYPE_TEXT, 255,
							[], 'billing_address_city')
				->addColumn('billing_address_district', Table::TYPE_TEXT, 255,
							[], 'billing_address_district')
				->addColumn('billing_address_telephone', Table::TYPE_TEXT, 255,
							[], 'billing_address_telephone')
				->addColumn('billing_address_mobile_phone_number', Table::TYPE_TEXT, 255,
							[], 'billing_address_mobile_phone_number')
				->addColumn('payment_method', Table::TYPE_TEXT, 255,
							[], 'payment_method')
				->addColumn('payment_method_title', Table::TYPE_TEXT, 255,
							[], 'payment_method_title')

				->addIndex($installer->getIdxName('sales_history_order', ['customer_id']), ['customer_id'])
				->addForeignKey(
					$installer->getFkName(
						'sales_history_order',
						'customer_id',
						'customer_entity',
						'entity_id'),
					'customer_id',
					$installer->getTable('customer_entity'),
					'entity_id',
					Table::ACTION_CASCADE);		

			$installer->getConnection()->createTable($table);
		}
		
		// sales_history_order_item DB table 

		if (!$installer->tableExists($installer->getTable('sales_history_order_item'))) {
			$table = $installer->getConnection()
				->newTable($installer->getTable('sales_history_order_item'))
				->addColumn('id', Table::TYPE_INTEGER, null, [
					'identity'  => true,
					'unsigned'  => true,
					'nullable'  => false,
					'primary'   => true,
				], 'item Id')
				->addColumn('order_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'order_id')
				->addColumn('item_name', Table::TYPE_TEXT, 255, [], 'item_name')
				->addColumn('item_sku', Table::TYPE_TEXT, 255, [], 'item_sku')
				->addColumn('item_price', Table::TYPE_DECIMAL, '12,4', [], 'item_price')
				->addColumn('item_discount_amount', Table::TYPE_DECIMAL, '12,4', [], 'item_discount_amount')
				->addColumn('item_row_total', Table::TYPE_DECIMAL, '12,4', [], 'item_row_total')
				->addColumn('item_qty_ordered', Table::TYPE_DECIMAL, '12,4', [], 'item_qty_ordered')
				->addIndex($installer->getIdxName('sales_history_order_item', ['order_id']), ['order_id'])
				->addForeignKey(
					$installer->getFkName(
						'sales_history_order_item', 
						'order_id', 
						'sales_history_order', 
						'order_id'),
					'order_id', 
					$installer->getTable('sales_history_order'), 
					'order_id',
					Table::ACTION_CASCADE);
				;
			$installer->getConnection()->createTable($table);
		}
    }
}
