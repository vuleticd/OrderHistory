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
 
 namespace Vuleticd\OrderHistory\Model;
  
 class OrderRepository extends \Magento\Sales\Model\OrderRepository
 {
	public function get($id)
    {
		//var_dump('Vuleticd\OrderHistory\Model\OrderRepository');
        if (!$id) {
            throw new InputException(__('Id required'));
        }
        if (!isset($this->registry[$id])) {
            /** @var \Magento\Sales\Api\Data\OrderInterface $entity */
            $entity = $this->metadata->getNewInstance()->load($id);
			
            $this->registry[$id] = $entity;
        }
        return $this->registry[$id];
    }
 }