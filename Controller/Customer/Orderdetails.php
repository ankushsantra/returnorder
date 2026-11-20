<?php
namespace Ankush\Returnorder\Controller\Customer;

use Magento\Customer\Model\Session;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\Forward;
use Ankush\Returnorder\Model\ReturnorderFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory;

class Orderdetails extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\Page 
     */
    protected $request;
    protected $session;
    protected $orderFactory;
    protected $resultForwardFactory;
    protected $resultPageFactory;
    protected $_returnorderFactory;
    protected $resultJsonFactory;
    
    /**
     * * @param \Magento\Framework\App\Action\Context $context      
     */
    public function __construct(
        Context $context,
        Forward $resultForward,
        Session $customerSession,
        OrderFactory $orderFactory,
        JsonFactory $resultJsonFactory,
        PageFactory $resultPageFactory,
        ReturnorderFactory $returnorderFactory,
        CollectionFactory $returnCollectionFactory
    ) {
        $this->session = $customerSession;
        $this->orderFactory = $orderFactory;
        $this->resultForwardFactory = $resultForward;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_returnorderFactory = $returnorderFactory;
        parent::__construct($context);
    }
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            $postData = (array) $this->getRequest()->getPost();
            $dataString = '';
            $incrementId = $postData['orderIncrementId'];
            if($incrementId=='') {
                return $result->setData($dataString);
            }else{
                //$order = $this->orderRepository->get(3);
                $order = $this->orderFactory->create()->loadByIncrementId($incrementId);
                foreach ($order->getAllVisibleItems() as $item)
                {
                    $dataString .= '<option value="'.$item->getName().' ( '.$item->getSku().' )'.'">'.$item->getName().'</option>';
                }
                return $result->setData($dataString);
            }
        }
    }
}