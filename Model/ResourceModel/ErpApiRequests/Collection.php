<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Rubenromao\ErpApiRequests\Model\ErpApiRequests as ModelErpApiRequests;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests as ResourceModelErpApiRequests;

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
    protected function _construct(): void
    {
        $this->_init(
            ModelErpApiRequests::class,
            ResourceModelErpApiRequests::class
        );
    }
}
