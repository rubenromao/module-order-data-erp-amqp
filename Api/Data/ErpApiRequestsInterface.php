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
    public const CUSTOMER_EMAIL = 'customer_email';
    public const ORDER_ITEMS = 'order_items';

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @param int $orderId
     * @return ErpApiRequests
     */
    public function setOrderId($orderId): ErpApiRequestsInterface;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @param int $code
     * @return ErpApiRequests
     */
    public function setCode($code): ErpApiRequestsInterface;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param int $createdAt
     * @return ErpApiRequests
     */
    public function setCreatedAt($createdAt): ErpApiRequestsInterface;

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string;

    /**
     * @param string $customerEmail
     * @return ErpApiRequestsInterface|null
     */
    public function setCustomerEmail($customerEmail): ?ErpApiRequestsInterface;

    /**
     * @return int|null
     */
    public function getOrderItems(): ?int;

    /**
     * @param int $orderItems
     * @return ErpApiRequestsInterface|null
     */
    public function setOrderItems($orderItems): ?ErpApiRequestsInterface;
}
