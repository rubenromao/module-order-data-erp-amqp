<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Model\ErpApiRequestsRepository;

/**
 * Interface ErpApiRequestsRepositoryInterface
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsRepositoryInterface
{
    /**
     * Save ERP Api Call.
     *
     * @param ErpApiRequestsInterface $erpApiRequest
     * @return ErpApiRequestsInterface
     */
    public function save(ErpApiRequestsInterface $erpApiRequest);
//    public function save(ErpApiRequestsInterface $orderId, $code);

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
