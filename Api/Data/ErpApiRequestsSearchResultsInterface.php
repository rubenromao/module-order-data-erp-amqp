<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

use Magento\Customer\Api\Data\CustomerSearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;

/**
 * Interface ErpApiRequestsSearchResultsInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
