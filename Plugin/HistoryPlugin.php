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
 
namespace Vuleticd\OrderHistory\Plugin;

class HistoryPlugin
{
	/**
     * @var \Vuleticd\OrderHistory\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_oldCollectionFactory;
	
	/**
     * @var \Vuleticd\OrderHistory\Model\Order\CollectionFactory
     */
    protected $_blankCollectionFactory;
	
	/**
     * @var \Psr\Logger\LoggerInterface
     */
	protected $_logger;
	
	/**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;
	
	/**
     * @param \Vuleticd\OrderHistory\Model\ResourceModel\Order\CollectionFactory $oldCollectionFactory
	 * @param \Vuleticd\OrderHistory\Model\Order\CollectionFactory $blankCollectionFactory
	 * @param \Magento\Sales\Model\OrderFactory $orderFactory
	 * @param \Psr\Log\LoggerInterface $logger
     */
	public function __construct(
		\Vuleticd\OrderHistory\Model\ResourceModel\Order\CollectionFactory $oldCollectionFactory,
		\Vuleticd\OrderHistory\Model\Order\CollectionFactory $blankCollectionFactory,
		\Magento\Sales\Model\OrderFactory $orderFactory,
		\Psr\Log\LoggerInterface $logger
	)
    {
		$this->_oldCollectionFactory = $oldCollectionFactory;
		$this->_blankCollectionFactory = $blankCollectionFactory;
		$this->orderFactory = $orderFactory;
		$this->_logger = $logger;
    }
	
	
    public function afterGetOrders(\Magento\Sales\Block\Order\History $subject, $result)
    {
		$old = $this->_oldCollectionFactory->create();
		$blank = $this->_blankCollectionFactory->create();
		
		//$this->_logger->debug(print_r($blank->getAllIds(), true));
		
		// add orders from new website to blank collection , first
        foreach ($result as $new) {
            $blank->addItem($new);
        }
		// add orders from old website to blank collection
		foreach ($old as $o) {
			//$this->_logger->debug(print_r($o->getData(), true));
			
			$clone = $this->orderFactory->create();
			$clone->setId($o->getOrderId());
			$clone->setStatus(trim($o->getStatus()));
			$clone->setState(trim($o->getState()));
            $clone->setOrderId($o->getOrderId());
            $clone->setRealOrderId($o->getIncrementId());
			$clone->setCustomerId($o->getCustomerId());
            $clone->setIsFromImport(1);
            $blank->addItem($clone);
        }
		
		foreach ($blank as $b) {
			//$this->_logger->debug(print_r($b->getData(), true));
		}
		
		//$this->_logger->debug(print_r($blank->getAllIds(), true));
        return $blank;
    }
	
	public function aroundGetViewUrl(\Magento\Sales\Block\Order\History $subject, $procede, $order)
    {
		if ($order->getIsFromImport()) {
            return $subject->getUrl('sales/order/old', ['order_id' => $order->getId()]);
        }
        return $procede($order);
    }
	
}