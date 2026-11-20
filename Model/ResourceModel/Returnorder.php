<?php
namespace Ankush\Returnorder\Model\ResourceModel;

class Returnorder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sales_order_return', 'request_id');
    }
}
?>