<?php
/**
 * @package
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Observer;

use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Psr\Log\LoggerInterface;

/**
 * Save order details to our custom table and publish the message.
 */
class AfterPlaceOrder implements ObserverInterface
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var ProductFactory
     */
    private $productFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Order $order
     * @param ProductFactory $productFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Order $order,
        ProductFactory $productFactory,
        LoggerInterface $logger
    ) {
        $this->order = $order;
        $this->productFactory = $productFactory;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getId();

        if($order->getState() == "new")
        {
            $this->logger->info("OrderId ".$orderId);
            $this->logger->info($order->getState());

            $product = $this->productFactory->create();
            foreach($order->getAllVisibleItems() as $item ) {
                // $productColl = $product->load($item->getProductId());
                $productId = $item->getProductId();
                $QtyOrdered = $item->getQtyOrdered();
                $this->logger->info("Order Items ".$productId." Total Qty".$QtyOrdered);
            }
            $this->logger->info('Catched event succssfully');
        }
    }
}
