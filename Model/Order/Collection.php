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
 // \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
namespace Vuleticd\OrderHistory\Model\Order;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\App\RequestInterface;

class Collection extends \Magento\Framework\Data\Collection
{
	/**
     * @var EntityFactoryInterface
     */
    protected $_entityFactory;
	
	/**
     * Request
     *
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;
	
	/**
     * @param EntityFactoryInterface $entityFactory
	 * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
		EntityFactoryInterface $entityFactory,
		RequestInterface $request
	)
    {
		$this->_request = $request;
        parent::__construct($entityFactory);
    }
	
	/**
     * Get request
     *
     * @return \Magento\Framework\App\RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }
	
	public function getIterator()
    {
		$this->setPageSize(10); // hard coded here but could listen to configuration or request
		
		$iterator = parent::getIterator();
        if (FALSE === $size = $this->getPageSize()) {
            return $iterator;
        }
		
		$page = $this->getRequest()->getParam('p', 1);
        if ($page < 1) {
            return $iterator;
        }
        $offset = $size * $page - $size;
		
		return new \LimitIterator($iterator, $offset, $size);
    }
}