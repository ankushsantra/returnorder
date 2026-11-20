<?php
namespace Ankush\Returnorder\Controller\Customer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\Page 
     */
    protected $resultPageFactory;
    protected $session;
    protected $request;
    protected $_returnCollectionFactory;
    /**
     * * @param \Magento\Framework\App\Action\Context $context      
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        RequestInterface $request,
        PageFactory $resultPageFactory,
        CollectionFactory $returnCollectionFactory
    ) {
        $this->request = $request;
        $this->session = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->_returnCollectionFactory = $returnCollectionFactory;
        parent::__construct($context);
    }
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account/login');
            return $resultRedirect;
        }else{
            $customerId = $this->session->getCustomerId();
            $return_id = $this->request->getParam('return_id');
            $collection = $this->_returnCollectionFactory->create();
            $collection->addFieldToFilter('request_id', $return_id);
            $collection->addFieldToFilter('customer_id', $customerId);
            if(count($collection)==0) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('returnorder/customer/index');
                return $resultRedirect;
            }else{
                $resultPage = $this->resultPageFactory->create();
                return $resultPage;
            }
        }
    }
}