<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Amqp;

use Magento\Framework\Amqp\Queue;
use Magento\Framework\Amqp\QueueFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;

/**
 * TODO: needs to be finished
 */
class OrderConsumer
{
    public const QUEUE_NAME = 'erp_api_process';
    public const CONNECTION_NAME = 'amqp';

    /**
     * @var Json
     */
    private $jsonSerializer;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var QueueFactory
     */
    private $queueFactory;

    /**
     * OrderConsumer constructor.
     *
     * @param Json $jsonSerializer
     * @param QueueFactory $queueFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Json $jsonSerializer,
        QueueFactory $queueFactory,
        LoggerInterface $logger
    ) {
        $this->jsonSerializer = $jsonSerializer;
        $this->queueFactory = $queueFactory;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function processMessage()
    {
        try {
            $this->execute();
        } catch (\Exception $e) {
            $message = __('Something went wrong while adding orders to queue');
            $this->logger->critical($e->getCode() . ': ' . $message);
        }
    }
}
