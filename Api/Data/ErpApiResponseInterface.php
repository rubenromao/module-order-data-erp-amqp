<?php
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
     * @return ErpApiResponseInterface
     */
    public function setOrderId(int $orderId): ErpApiResponseInterface;

    /**
     * @param int $code
     * @return ErpApiResponseInterface
     */
    public function setCode(int $code): ErpApiResponseInterface;

    /**
     * @param $createdAt
     * @return ErpApiResponseInterface
     */
    public function setCreatedAt($createdAt): ErpApiResponseInterface;
}
