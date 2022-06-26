<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ErpApiRequestsRepositoryInterface
 * @package Rubenromao\ErpApiRequests\Api
 */
interface ErpApiRequestsRepositoryInterface
{
    /**
     * Save ERP Api Call.
     *
     * @param $orderId
     * @param $code
     * @return mixed
     */
    public function save($orderId, $code);

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save API call response from ERP to database.
     *
     * @param $orderId
     * @param $code
     * @return mixed
     */
    public function saveErpApiRequests($orderId, $code);

    /**
     * Get ERP Requests from database
     *
     * @param $orderId
     * @param $code
     * @return mixed
     */
    public function getErpApiRequests($orderId, $code);
}
