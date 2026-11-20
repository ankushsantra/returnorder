<?php
namespace Ankush\Returnorder\Block;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session;

class Returnordernew extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    protected $_orderCollectionFactory;
    
    public function __construct(
        Context $context,
        \Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory $returnCollectionFactory,
        Session $customerSession,
        CollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
        $this->_returnCollectionFactory = $returnCollectionFactory;
        $this->_customerSession = $customerSession;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('Submit Return Request'));
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getOrders()
    {
        if (!($customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }
        $ordersList = $this->_orderCollectionFactory->create($customerId)->addFieldToSelect('*');
        return $ordersList;
    }
    
    public function getReasons()
    {
        $reasonList = \Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getValueArray8();
        return $reasonList;
    }
}