<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;

/**
 * Interface ErpApiRequestsSearchResultsInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return array
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param array $items
     * @return ErpApiRequestsSearchResultsInterface
     */
    public function setItems(array $items);
}
