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
    public function getOrderId();

    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param int $orderId
     * @return int
     */
    public function setOrderId($orderId);

    /**
     * @param int $code
     * @return int
     */
    public function setCode($code);

    /**
     * @param $createdAt
     * @return string|null
     */
    public function setCreatedAt($createdAt);
}
