<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

use Rubenromao\ErpApiRequests\Model\Api\ErpApiRequests;

/**
 * Interface ErpApiRequests
 * @package Rubenromao_ErpApiRequests
 */
interface ErpApiRequestsInterface
{
    public const ORDER_ID = 'order_id';
    public const CODE = 'code';
    public const CREATED_AT = 'created_at';

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param int $orderId
     * @return ErpApiRequests
     */
    public function setOrderId(int $orderId): ErpApiRequestsInterface;

    /**
     * @param int $code
     * @return ErpApiRequests
     */
    public function setCode(int $code): ErpApiRequestsInterface;

    /**
     * @param $createdAt
     * @return ErpApiRequests
     */
    public function setCreatedAt($createdAt): ErpApiRequestsInterface;

    /**
     * @param $orderData
     * @return ErpApiRequestsInterface
     */
    public function sendOrderDataToErp($orderData): ErpApiRequestsInterface;

}
