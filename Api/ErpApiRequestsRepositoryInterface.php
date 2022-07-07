<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;

/**
 * Interface ErpApiRequestsRepositoryInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsRepositoryInterface
{
    /**
     * Save ERP Api Call.
     *
     * @param ErpApiRequestsInterface $erpApiRequests
     * @return ErpApiRequestsInterface
     */
    public function save(ErpApiRequestsInterface $erpApiRequests): ErpApiRequestsInterface;

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ErpApiRequestsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ErpApiRequestsSearchResultsInterface;
}
