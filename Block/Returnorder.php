<?php
namespace Ankush\Returnorder\Block;
class Returnorder extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory $returnCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_returnCollectionFactory = $returnCollectionFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('My Return Requests'));
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getReturns()
    {
        if (!($customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }else{
            $collection = $this->_returnCollectionFactory->create();
            $collection->addFieldToFilter('customer_id', $customerId);
            return $collection;
        }
    }
    
    public function getViewUrl($return)
    {
        return $this->getUrl('returnorder/customer/view', ['return_id' => $return->getId()]);
    }
}