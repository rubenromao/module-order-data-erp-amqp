<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ErpApiRequests
 * @package Rubenromao_ErpApiRequests
 */
class ErpApiRequests extends AbstractDb
{
    protected const ERP_API_CALLS_TABLE = 'erp_api_requests';
    protected const ERP_API_CALLS_ID_FIELD = 'order_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::ERP_API_CALLS_TABLE, self::ERP_API_CALLS_ID_FIELD);
    }

    /**
     * Save API call response from ERP to database.
     *
     * @param $orderId
     * @param $code
     * @return $this
     */
    public function saveErpApiRequest($orderId, $code): static
    {
        $connection = $this->getConnection();
        $bind = [
            'order_id' => (int) $orderId,
            'code' => (int) $code
        ];
        $connection->insert(
            $this->getTable(self::ERP_API_CALLS_TABLE),
            $bind
        );

        return $this;
    }

    /**
     * @param int $orderId
     * @param int $code
     * @return array
     */
    public function getAllErpApiRequests(): array
    {
        $select = $this->getConnection()->select(
            )->from(
                $this->getTable(self::ERP_API_CALLS_TABLE),
                [
                    'order_id',
                    'code',
                    'created_at'
                ]
            );
        $bind = [];

        return $this->getConnection()->fetchAll($select, $bind);
    }
}
