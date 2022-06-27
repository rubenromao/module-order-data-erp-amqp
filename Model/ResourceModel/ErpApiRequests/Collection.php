<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\ResourceModel\CustomOrderErpApi;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Rubenromao_ErpApiRequests
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Rubenromao\ErpApiRequests\Model\ErpApiRequests::class,
            Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests::class
        );
    }
}
