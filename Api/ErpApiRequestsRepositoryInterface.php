<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;

/**
 * Interface ErpApiRequestsRepositoryInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsRepositoryInterface
{
    /**
     * Save ERP Api Call.
     *
     * @param $orderId
     * @param $code
     * @return ErpApiRequestsInterface
     */
    public function save($orderId, $code): ErpApiRequestsInterface;

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
