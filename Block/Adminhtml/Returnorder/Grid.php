<?php
namespace Ankush\Returnorder\Block\Adminhtml\Returnorder;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Ankush\Returnorder\Model\returnorderFactory
     */
    protected $_returnorderFactory;

    /**
     * @var \Ankush\Returnorder\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context      $context
     * @param \Magento\Backend\Helper\Data                 $backendHelper
     * @param \Ankush\Returnorder\Model\returnorderFactory $returnorderFactory
     * @param \Ankush\Returnorder\Model\Status             $status
     * @param \Magento\Framework\Module\Manager            $moduleManager
     * @param array                                        $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Ankush\Returnorder\Model\ReturnorderFactory $ReturnorderFactory,
        \Ankush\Returnorder\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_returnorderFactory = $ReturnorderFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('request_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_returnorderFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return                                        $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'request_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'request_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


        
        $this->addColumn(
            'order_id',
            [
            'header' => __('Order ID'),
            'index' => 'order_id',
            ]
        );
                
        $this->addColumn(
            'customer_name',
            [
            'header' => __('Customer Name'),
            'index' => 'customer_name',
            ]
        );
                
                        
        $this->addColumn(
            'reason',
            [
                                'header' => __('Reason'),
                                'index' => 'reason',
                                'type' => 'options',
                                'options' => \Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray8()
            ]
        );
                        
                        
                        
        $this->addColumn(
            'status',
            [
                                'header' => __('Status'),
                                'index' => 'status',
                                'type' => 'options',
                                'options' => \Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray10()
            ]
        );
                        
                        
        $this->addColumn(
            'created_at',
            [
            'header' => __('Created'),
            'index' => 'created_at',
            ]
        );
                
        $this->addColumn(
            'updated_at',
            [
            'header' => __('Updated'),
            'index' => 'updated_at',
            ]
        );
                


        
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'request_id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
        

        
        $this->addExportType($this->getUrl('returnorder/*/exportCsv', ['_current' => true]), __('CSV'));
        $this->addExportType($this->getUrl('returnorder/*/exportExcel', ['_current' => true]), __('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('request_id');
        //$this->getMassactionBlock()->setTemplate('Ankush_Returnorder::returnorder/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('returnorder');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('returnorder/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('returnorder/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
        

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('returnorder/*/index', ['_current' => true]);
    }

    /**
     * @param  \Ankush\Returnorder\Model\returnorder|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        
        return $this->getUrl(
            'returnorder/*/edit',
            ['request_id' => $row->getId()]
        );
        
    }

    
    static public function getOptionArray8()
    {
            $data_array=array(); 
        $data_array[0]='Wrong Size';
        $data_array[1]='Wrong Product';
        $data_array[2]='Excessive Amount';
        $data_array[3]='Found Better Product';
        $data_array[4]='Late Delivery';
        $data_array[5]='No Longer Needed';
        $data_array[6]='Customer Fraud';
        $data_array[7]='Others';
            return($data_array);
    }
    static public function getValueArray8()
    {
            $data_array=array();
        foreach(\Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray8() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);        
        }
            return($data_array);

    }
        
    static public function getOptionArray10()
    {
            $data_array=array(); 
        $data_array[0]='Pending';
        $data_array[1]='Processing';
        $data_array[2]='Approved';
            return($data_array);
    }
    static public function getValueArray10()
    {
            $data_array=array();
        foreach(\Ankush\Returnorder\Block\Adminhtml\Returnorder\Grid::getOptionArray10() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);        
        }
            return($data_array);

    }
        

}