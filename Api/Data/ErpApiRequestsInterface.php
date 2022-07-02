<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

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
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param $orderId
     * @return ErpApiRequestsInterface
     */
    public function setOrderId($orderId): ErpApiRequestsInterface;

    /**
     * @param $code
     * @return ErpApiRequestsInterface
     */
    public function setCode($code): ErpApiRequestsInterface;

    /**
     * @param $createdAt
     * @return ErpApiRequestsInterface
     */
    public function setCreatedAt($createdAt): ErpApiRequestsInterface;
}
