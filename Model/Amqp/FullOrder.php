<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Model\Amqp;

use Rubenromao\OrderDataErpAmqp\Api\Amqp\Data\AddressInterface;
use Rubenromao\OrderDataErpAmqp\Api\Amqp\FullOrderInterface;

class FullOrder implements FullOrderInterface
{
    private $orderId;
    private $products;

    /**
     * {@inheritdoc}
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrderId($orderId): FullOrderInterface
    {
        $this->orderId = $orderId;
        return $this;
    }
}
