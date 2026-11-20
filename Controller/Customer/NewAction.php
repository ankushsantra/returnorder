<?php
namespace Ankush\Returnorder\Controller\Customer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\Forward;
use Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory;

class NewAction extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\Page 
     */
    protected $resultForwardFactory;
    protected $resultPageFactory;
    protected $session;
    protected $_returnCollectionFactory;
    /**
     * * @param \Magento\Framework\App\Action\Context $context      
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        Forward $resultForward,
        CollectionFactory $returnCollectionFactory
    ) {
        $this->session = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForward;
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
            $resultPage = $this->resultPageFactory->create();
            $resultPage->addHandle('returnorder_customer_form'); //loads the layout of module_custom_customlayout.xml file with its name
            return $resultPage;
        }
    }
}