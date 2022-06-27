<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Amqp;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;

/**
 * Publishes message with the order id, items and customer to RabbitMQ.
 */
class OrderPublisher
{
    public const TOPIC_NAME = 'erp.api.process';

    /**
     * @var PublisherInterface
     */
    private $publisher;
    /**
     * @var Json
     */
    private $jsonSerializer;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * OrderPublisher constructor.
     *
     * @param PublisherInterface $publisher
     * @param Json $jsonSerializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        PublisherInterface $publisher,
        Json $jsonSerializer,
        LoggerInterface $logger
    ) {
        $this->publisher = $publisher;
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
    }

    /**
     * @param OrderInterface $order
     * @return void
     */
    public function execute(OrderInterface $order): void
    {
        $orderDataToErpApiArr[] = [
            'order_id' => $order->getEntityId(),
            'customer_email' => $order->getCustomerEmail(),
            'order_items' => $order->getTotalItemCount()
        ];

        $rabbitMQMessage = $this->jsonSerializer->serialize($orderDataToErpApiArr);

        try {
            $this->publisher->publish(self::TOPIC_NAME, $rabbitMQMessage);
            $this->logger->info(
                __("AMQP MESSAGE PUBLISHED FOR ORDER ID #%1: %2", $order->getEntityId(), $rabbitMQMessage)
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
