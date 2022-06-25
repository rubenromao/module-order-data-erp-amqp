<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Model\ResourceModel\CustomOrderErpApi;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Rubenromao_OrderDataErpAmqp
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'order_id';

    /**
     * @see \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection::_construct()
     */
    protected function _construct()
    {
        $this->_init(
            'Rubenromao\OrderDataErpAmqp\Model\CustomOrderErpApi',
            'Rubenromao\OrderDataErpAmqp\Model\ResourceModel\CustomOrderErpApi'
        );
    }
}
