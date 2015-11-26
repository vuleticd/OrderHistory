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
 
namespace Vuleticd\OrderHistory\Api\Data;
interface OrderInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
	const ORDER_ID						= 'order_id';
	const CUSTOMER_EMAIL 				= 'customer_email';
	const CUSTOMER_ID					= 'customer_id';
	const INCREMENT_ID					= 'increment_id';
	const STATE							= 'state';
	const STATUS						= 'status';
	const CREATED_AT					= 'created_at';
	const SUBTOTAL						= 'subtotal';
	const SHIPPING_AMOUNT				= 'shipping_amount';
	const DISCOUNT_AMOUNT				= 'discount_amount';
	const GRAND_TOTAL					= 'grand_total';
	const SHIPPING_METHOD				= 'shipping_method';
	const SHIPPING_DESCRIPTION			= 'shipping_description';
	const SHIPPING_ADDRESS_PREFIX 		= 'shipping_address_prefix';
	const SHIPPING_ADDRESS_FIRSTNAME	= 'shipping_address_firstname';
	const SHIPPING_ADDRESS_LASTNAME		= 'shipping_address_lastname';
	 
    /**
     * Get ORDER_ID
     *
     * @return int
     */
    public function getOrderId();
    /**
     * Set ORDER_ID
     *
     * @param int $order_id
     * @return \Vuleticd\OrderHistory\Api\Data\OrderInterface
     */
    public function setOrderId($order_id);
}
