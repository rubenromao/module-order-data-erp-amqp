<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Data;

/**
 * Interface ErpApiResponseInterface
 */
interface ErpApiResponseInterface
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
     * @return ErpApiResponseInterface
     */
    public function setOrderId(int $orderId): ErpApiResponseInterface;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @param int $code
     * @return ErpApiResponseInterface
     */
    public function setCode(int $code): ErpApiResponseInterface;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param $createdAt
     * @return ErpApiResponseInterface
     */
    public function setCreatedAt($createdAt): ErpApiResponseInterface;

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string;

    /**
     * @param string $customerEmail
     * @return ErpApiResponseInterface|null
     */
    public function setCustomerEmail(string $customerEmail): ?ErpApiResponseInterface;

    /**
     * @return int|null
     */
    public function getOrderItems(): ?int;

    /**
     * @param int $orderItems
     * @return ErpApiResponseInterface|null
     */
    public function setOrderItems(int $orderItems): ?ErpApiResponseInterface;
}
