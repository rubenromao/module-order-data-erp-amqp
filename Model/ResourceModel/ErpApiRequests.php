<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ErpApiRequests
 * @package Rubenromao_ErpApiRequests
 */
class ErpApiRequests extends AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('erp_api_requests', 'order_id');
    }

    /**
     * @param $orderId
     * @param $code
     * @return array
     */
    public function getErpApiRequests($orderId, $code): array
    {
        $select = $this->getConnection()->select()->from(
                $this->getTable('erp_api_requests'),
                ['order_id', 'code', 'created_at']
            )->where(
                'order_id = :order_id and code = :code'
            );
        $bind = [
            'order_id' => (int)$orderId,
            'code' => (int)$code
        ];

        return $this->getConnection()->fetchAll($select, $bind);
    }

    /**
     * @param $orderId
     * @param $code
     * @return $this
     */
    public function saveErpApiRequests($orderId, $code): ErpApiRequests
    {
        $connection = $this->getConnection();
        $bind = [
            'order_id' => (int)$orderId,
            'code' => (int)$code
        ];
        $connection->insert($this->getTable('erp_api_requests'), $bind);

        return $this;
    }
}
