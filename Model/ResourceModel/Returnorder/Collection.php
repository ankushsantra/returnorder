<?php

namespace Ankush\Returnorder\Model\ResourceModel\Returnorder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ankush\Returnorder\Model\Returnorder', 'Ankush\Returnorder\Model\ResourceModel\Returnorder');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>