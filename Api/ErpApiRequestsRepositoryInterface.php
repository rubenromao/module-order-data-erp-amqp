<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface;

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
     * @return ErpApiRequestsInterface|null
     */
    public function save($erpApiRequests): ?ErpApiRequestsInterface;

    /**
     * Get list of API requests.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ErpApiRequestsSearchResultsInterface|null
     */
    public function getList($searchCriteria): ?ErpApiRequestsSearchResultsInterface;

    /**
     * Return a filtered product.
     *
     * @param int $id
     * @return Data\ErpApiResponseInterface|null
     * @throws NoSuchEntityException
     */
    public function getItem($id): ?ErpApiResponseInterface;

//    /**
//     * Return a list of the filtered products.
//     *
//     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface[]
//     */
//    public function getList(): array;

    /**
     * Get response
     *
     * @param OrderInterface $order
     * @return ErpApiResponseInterface|null
     */
    public function getResponseFromErp($order): ?ErpApiResponseInterface;

    /**
     * Set Order data.
     *
     * @param int $orderId
     * @param string $customerEmail
     * @param int $orderItems
     * @return ErpApiRequestsInterface|null
     */
    public function sendRequestToErp($orderId, $customerEmail, $orderItems): ?ErpApiRequestsInterface;
}
