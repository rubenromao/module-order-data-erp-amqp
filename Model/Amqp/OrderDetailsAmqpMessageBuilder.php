<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Amqp;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\OrderFactory;

class OrderDetailsAmqpMessageBuilder
{
    /**
     * @var OrderInterface
     */
    private $orderInterface;
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     * @param OrderInterface $orderInterface
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        OrderInterface $orderInterface,
        OrderFactory $orderFactory
    ) {
        $this->orderInterface = $orderInterface;
        $this->orderFactory = $orderFactory;
    }

    /**
     * @param OrderInterface $order
     * @return array
     */
    public function buildRabbitMQMessage(OrderInterface $order): array
    {
        //$order->load($order->getCreatedAt());

        $orderData = $this->orderFactory->create();
        $orderId = $orderData->getEntityId();// $order->getEntityId();
        $customerEmail = $order->getCustomerEmail();
        $orderItems = $order->getTotalItemCount();

        $timestamp = $order->getCreatedAt();
        $orderData->setOrderId($orderId);
        $orderData->setTimestamp($timestamp);
        $orderData->setIsVirtual((bool)$order->getIsVirtual());

        return $orderData;

        //$order->load($order->getCreatedAt());
        $orderData = [];
        $orderData[1] = $order->getEntityId();
        $orderData[2] = $order->getTotalItemCount();
        $orderData[3] = $order->getCustomerEmail();

        return $orderData;
    }
}
