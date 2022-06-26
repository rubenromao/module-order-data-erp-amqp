<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Api\Amqp;

/**
 * This interface contains the full order data
 */
interface FullOrderInterface
{
    /**
     * @return string
     */
    public function getOrderId(): string;

    /**
     * @param string $orderId
     *
     * @return \Rubenromao\ErpApiRequests\Api\Amqp\FullOrderInterface
     */
    public function setOrderId($orderId): \Rubenromao\ErpApiRequests\Api\Amqp\FullOrderInterface;
}
