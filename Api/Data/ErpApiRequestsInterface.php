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
     * @return mixed
     */
    public function getOrderId();

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $orderId
     * @return mixed
     */
    public function setOrderId($orderId);

    /**
     * @param $code
     * @return mixed
     */
    public function setCode($code);

    /**
     * @param $createdAt
     * @return ErpApiRequestsInterface
     */
    public function setCreatedAt($createdAt);
}
