<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Api\Amqp;

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
     * @return \Rubenromao\OrderDataErpAmqp\Api\Amqp\FullOrderInterface
     */
    public function setOrderId($orderId): \Rubenromao\OrderDataErpAmqp\Api\Amqp\FullOrderInterface;
}
