<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Amqp;

use Rubenromao\ErpApiRequests\Api\Amqp\Data\AddressInterface;
use Rubenromao\ErpApiRequests\Api\Amqp\FullOrderInterface;

class FullOrder implements FullOrderInterface
{
    private string $orderId;

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
