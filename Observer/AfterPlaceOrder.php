<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Rubenromao\ErpApiRequests\Model\Amqp\OrderPublisher;

/**
 * Intercepts the order object after save.
 */
class AfterPlaceOrder implements ObserverInterface
{
    /**
     * @var OrderPublisher
     */
    private $orderPublisher;

    /**
     * AfterPlaceOrder constructor.
     *
     * @param OrderPublisher $orderPublisher
     */
    public function __construct(
        OrderPublisher $orderPublisher,
    ) {
        $this->orderPublisher = $orderPublisher;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $order = $observer->getEvent()->getOrder();
        // only proceed with publish message
        // if it's a new order
        if($order->getState() === Order::STATE_NEW) {
            $this->orderPublisher->execute($order);
        }
    }
}
