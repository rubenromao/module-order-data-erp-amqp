<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Plugin\Magento\Sales\Api;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Logger\Monolog;
use Magento\Sales\Api\OrderRepositoryInterface as CoreClassOrderRepositoryInterface;
use Rubenromao\OrderDataErpAmqp\Model\Amqp\OrderDetailsAmqpMessageBuilder;

use Rezolve\General\Model\MerchantIdResolver;
use Rezolve\API\Model\Basket\Order as OriginalClass;
use Rezolve\General\Helpers\RabbitMQ;

class OrderRepositoryInterface
{
    /**
     * @var PublisherInterface
     */
    protected $publisher;
    /**
     * @var OrderDetailsAmqpMessageBuilder
     */
    protected $amqpMessageBuilder;
    /**
     * @var MerchantIdResolver
     */
    protected $merchantIdResolver;
    /**
     * @var Monolog
     */
    private $logger;

    /**
     * OrderPlaced constructor
     *
     * @param PublisherInterface $publisher
     * @param OrderDetailsAmqpMessageBuilder $amqpMessageBuilder
     * @param MerchantIdResolver $merchantIdResolver
     * @param OrderHelper $order
     * @param Monolog $logger
     */
    public function __construct(
        PublisherInterface $publisher,
        OrderDetailsAmqpMessageBuilder $amqpMessageBuilder,
        MerchantIdResolver $merchantIdResolver,
        Monolog $logger
    ) {
        $this->publisher = $publisher;
        $this->amqpMessageBuilder = $amqpMessageBuilder;
        $this->merchantIdResolver = $merchantIdResolver;
        $this->logger = $logger;
    }

    /**
     * @param OriginalClass $subject
     * @param $result
     * @return mixed
     */
    public function afterPlaceOrder(CoreClassOrderRepositoryInterface $subject, $result)
    {
        $order = $subject->get();//$subject->fetchOrderByCoreId($result->getOrderId());
        $rabbitMQMessage = $this->amqpMessageBuilder->buildRabbitMQMessage(
            $order,
            $this->merchantIdResolver->execute()
        );
        try {
            $this->publisher->publish(
                'rce.order.create.data.0.1.0',
                $rabbitMQMessage
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }
}
