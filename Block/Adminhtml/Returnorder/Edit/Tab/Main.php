<?php

namespace Ankush\Returnorder\Block\Adminhtml\Returnorder\Edit\Tab;

/**
 * Returnorder edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Ankush\Returnorder\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param \Magento\Store\Model\System\Store       $systemStore
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Ankush\Returnorder\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return                                        $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Ankush\Returnorder\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('returnorder');

        $isElementDisabled = false;

        /**
 * @var \Magento\Framework\Data\Form $form 
*/
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('request_id', 'hidden', ['name' => 'request_id']);
        }

        
        $fieldset->addField(
            'order_id',
            'label',
            [
                'name' => 'order_id',
                'label' => __('Order ID'),
                'title' => __('Order ID'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    
        $fieldset->addField(
            'customer_id',
            'label',
            [
                'name' => 'customer_id',
                'label' => __('Customer ID'),
                'title' => __('Customer ID'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    
        $fieldset->addField(
            'customer_name',
            'label',
            [
                'name' => 'customer_name',
                'label' => __('Customer Name'),
                'title' => __('Customer Name'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    
        $fieldset->addField(
            'customer_email',
            'label',
            [
                'name' => 'customer_email',
                'label' => __('Customer Email'),
                'title' => __('Customer Email'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    
        /* $fieldset->addField(
            'product_name',
            'label',
            [
                'name' => 'product_name',
                'label' => __('Product(s)'),
                'title' => __('Product(s)'),
                
                'disabled' => $isElementDisabled
            ]
        );*/
        
        $fieldset->addType(
            'customProductName',
            '\Ankush\Returnorder\Block\Adminhtml\Quotation\Renderer\ReturnProduct'
        );
        $fieldset->addField(
            'product_name',
            'customProductName',
            [
                'name'  => 'product_name',
                'label' => __('Product Name'),
                'title' => __('Product Name')
            ]
        );

        $fieldset->addType(
            'customImageField',
            '\Ankush\Returnorder\Block\Adminhtml\Quotation\Renderer\ReturnImage'
        );
        $fieldset->addField(
            'product_image',
            'customImageField',
            [
                'name'  => 'product_image',
                'label' => __('Product Image'),
                'title' => __('Product Image')
            ]
        );
                                                
        $fieldset->addField(
            'reason',
            'select',
            [
                'label' => __('Reason'),
                'title' => __('Reason'),
                'name' => 'reason',
                'readonly' => __('readonly'),
                
                'options' => \Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray8(),
                'disabled' => 'disabled'
            ]
        );                    
                        
        $fieldset->addField(
            'customer_message',
            'label',
            [
                'name' => 'customer_message',
                'label' => __('Customer Message'),
                'title' => __('Customer Message'),
                
                'disabled' => $isElementDisabled
            ]
        );
                                                    
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
            'required' => true,
                'options' => \Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray10(),
                'disabled' => $isElementDisabled
            ]
        );
                        
                        
        $fieldset->addField(
            'created_at',
            'label',
            [
                'name' => 'created_at',
                'label' => __('Created'),
                'title' => __('Created'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    
        $fieldset->addField(
            'updated_at',
            'label',
            [
                'name' => 'updated_at',
                'label' => __('Updated'),
                'title' => __('Updated'),
                'readonly' => __('readonly'),
                
                'disabled' => $isElementDisabled
            ]
        );
                    

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
        
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param  string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray()
    {
        return array(
                    '_self' => "Self",
        '_blank' => "New Page",
                    );
    }
}
