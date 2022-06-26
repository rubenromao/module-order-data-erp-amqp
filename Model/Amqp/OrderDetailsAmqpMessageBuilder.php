<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Amqp;

use Magento\Sales\Api\Data\OrderInterface;

class OrderDetailsAmqpMessageBuilder
{
    /**
     * @var OrderInterface
     */
    private $orderFactory;

    /**
     * @param OrderInterface $orderFactory
     */
    public function __construct(
        OrderInterface $orderFactory
    ) {
        $this->orderFactory = $orderFactory;
    }

    /**
     * @param OrderInterface $order
     * @return array
     */
    public function buildRabbitMQMessage(OrderInterface $order): array
    {
        //$order->load($order->getCreatedAt());
        $orderData = [];
        $orderData[1] = $order->getEntityId();
        $orderData[2] = $order->getTotalItemCount();
        $orderData[3] = $order->getCustomerEmail();


        return $orderData;
    }
}
