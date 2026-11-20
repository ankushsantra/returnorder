<?php

namespace Ankush\Returnorder\Controller\Adminhtml\returnorder;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPagee;
    protected $resultPageFactory;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /**
 * @var \Magento\Backend\Model\View\Result\Page $resultPage 
*/
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ankush_Returnorder::returnorder');
        $resultPage->addBreadcrumb(__('Ankush'), __('Ankush'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage Returnorder'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Returnorder'));

        return $resultPage;
    }
}
?>