<?php
namespace Ankush\Returnorder\Model;

class Returnorder extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ankush\Returnorder\Model\ResourceModel\Returnorder');
    }
}
?>