<?php
namespace Ankush\Returnorder\Controller\Customer;

use Magento\Framework\Filesystem;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\Forward;
use Ankush\Returnorder\Model\ReturnorderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Ankush\Returnorder\Model\ResourceModel\Returnorder\CollectionFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\Page 
     */
    protected $session;
    protected $request;
    protected $_filesystem;
    protected $resultForwardFactory;
    protected $resultPageFactory;
    protected $_returnorderFactory;
    protected $_returnCollectionFactory;
    
    /**
     * * @param \Magento\Framework\App\Action\Context $context      
     */
    public function __construct(
        Context $context,
        Forward $resultForward,
        Filesystem $fileSystem,
        Session $customerSession,
        PageFactory $resultPageFactory,
        ReturnorderFactory $returnorderFactory,
        CollectionFactory $returnCollectionFactory
    ) {
        $this->_filesystem = $fileSystem;
        $this->session = $customerSession;
        $this->resultForwardFactory = $resultForward;
        $this->resultPageFactory = $resultPageFactory;
        $this->_returnorderFactory = $returnorderFactory;
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
        $postData = (array) $this->getRequest()->getPost();
        $postData['status'] = 0;
        $postData['customer_id'] = $this->session->getCustomerId();
        $postData['customer_name'] = $this->session->getCustomer()->getName();
        $postData['customer_email'] = $this->session->getCustomer()->getEmail();
        $postData['product_name'] = implode("<br>", $postData['product_name']);
        $result = array();
        if ($_FILES['product_image']['name']) {
            try {
                $uploader = $this->_objectManager->create(
                    'Magento\MediaStorage\Model\File\Uploader',
                    ['fileId' => 'product_image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $mediaDirectory->getAbsolutePath();
                $result = $uploader->save($mediaDirectory->getAbsolutePath('returnImages'));
                $postData['product_image'] = $result['file'];
            } catch (Exception $e) {
                \Zend_Debug::dump($e->getMessage());
            }
        }
        $model = $this->_returnorderFactory->create();
        if($postData != '') {
            $model->setData($postData);
            $model->save();
            $lastId = $model->getId();
            if($lastId != '') {
                $this->messageManager->addSuccessMessage('Request created successfully.');
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('returnorder/customer/view', ['return_id' => $lastId]);
                return $resultRedirect;
            } 
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('returnorder/customer/new');
        return $resultRedirect;
    }
}