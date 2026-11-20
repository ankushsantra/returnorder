<?php
namespace Ankush\Returnorder\Block;

use Magento\Framework\View\Element\Template\Context;
use Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;

class Returnorderview extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    
    public function __construct(
        Context $context,
        CollectionFactory $returnCollectionFactory,
        PageFactory $resultPageFactory,
        Session $customerSession,
        RequestInterface $request,
        array $data = []
    ) {
        $this->_returnCollectionFactory = $returnCollectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_customerSession = $customerSession;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $return_id = $this->request->getParam('return_id');
        $this->pageConfig->getTitle()->set(__('Request #'.$return_id));
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getReturn()
    {
        if (!($customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }else{
            $return_id = $this->request->getParam('return_id');
            $collection = $this->_returnCollectionFactory->create();
            $collection->addFieldToFilter('request_id', $return_id);
            $collection->addFieldToFilter('customer_id', $customerId);
            return $collection->getFirstItem();
        }
    }
}