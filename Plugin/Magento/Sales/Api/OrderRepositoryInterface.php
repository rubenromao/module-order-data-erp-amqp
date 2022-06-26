<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Plugin\Magento\Sales\Api;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Logger\Monolog;
use Magento\Sales\Api\OrderRepositoryInterface as CoreClassOrderRepositoryInterface;

use Rubenromao\ErpApiRequests\Model\Amqp\OrderDetailsAmqpMessageBuilder;
use Rubenromao\ErpApiRequests\Helpers\RabbitMQ;

class OrderRepositoryInterface
{
    /**
     * @var  PublisherInterface
     */
    protected $publisher;
    /**
     * @var  OrderDetailsAmqpMessageBuilder
     */
    protected $amqpMessageBuilder;
    /**
     * @var Monolog
     */
    private $logger;
    /**
     * @var RabbitMQ
     */
    private $rabbitMQ;

    /**
     * @param PublisherInterface $publisher
     * @param OrderDetailsAmqpMessageBuilder $amqpMessageBuilder
     * @param Monolog $logger
     * @param RabbitMQ $rabbitMQ
     */
    public function __construct(
        PublisherInterface $publisher,
        OrderDetailsAmqpMessageBuilder $amqpMessageBuilder,
        Monolog $logger,
        RabbitMQ $rabbitMQ
    ) {
        $this->publisher = $publisher;
        $this->amqpMessageBuilder = $amqpMessageBuilder;
        $this->logger = $logger;
        $this->rabbitMQ = $rabbitMQ;
    }

    /**
     * @param CoreClassOrderRepositoryInterface $subject
     * @param $result
     * @return CoreClassOrderRepositoryInterface|null
     */
    public function afterSave(CoreClassOrderRepositoryInterface $subject, $result): ?CoreClassOrderRepositoryInterface
    {
        $order = $subject->get($result->getEntityId());
        $rabbitMQMessage = $this->amqpMessageBuilder->buildRabbitMQMessage(
            $order
        );
        try {
            $this->publisher->publish(
                'erp.order.api.data.0.1.0',
                $rabbitMQMessage
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        return $result;
    }
}
