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
     * @return FullOrderInterface
     */
    public function buildRabbitMQMessage(OrderInterface $order)
    {
        $order->load($order->getCreatedAt());

        $order->setEntityId($order->getEntityId());
        $order->setTotalItemCount($order->getTotalItemCount());
        $order->setCustomerEmail($order->getCustomerEmail());

        //return $orderData;
    }
}
