<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
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
     * @param \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface $erpApiRequests
     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface
     */
    public function save(Data\ErpApiRequestsInterface $erpApiRequests);

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ErpApiRequestsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
