<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CustomOrderErpApi
 * @package Rubenromao_OrderDataErpAmqp
 */
class CustomOrderErpApi extends AbstractDb
{
    /**
     * @see \Magento\Framework\Model\ResourceModel\AbstractResource::_construct()
     */
    public function _construct()
    {
        $this->_init('custom_order_api_erp_status', 'order_id');
    }
}
