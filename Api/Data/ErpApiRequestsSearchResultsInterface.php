<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ErpApiRequestsSearchResultsInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return ErpApiRequestsInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param ErpApiRequestsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
