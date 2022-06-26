<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Queue;

class Consumer
{
    /* @var \Magento\Framework\Serialize\Serializer\Json  */
    protected $_json;

    /**
     * @param string $orders
     */
    public function processMessage($orders): void
    {
        try{
            $this->execute($orders);

        }catch (\Exception $e){
            $errorCode = $e->getCode();
            $message = __('Something went wrong while adding orders to queue');
            $this->_notifier->addCritical(
                $errorCode,
                $message
            );
            $this->_logger->critical($errorCode .": ". $message);
        }
    }

    /**
     * @param $orderItems
     *
     * @throws LocalizedException
     */
    private function execute($orderItems)
    {
        $orderCollectionArr = [];
        /* @var \Rubenromao\ErpApiRequests\Model\Queue $queue */
        $queue = $this->_queueFactory->create();
        $orderItems = $this->_json->unserialize($orderItems);
        if(is_array($orderItems)){
            foreach ($orderItems as $type => $orderId) {
            $orderCollectionArr[] = [
                    'type' => 'order',
                    'entity_id' => $orderId,
                    'priority' => 1,
                ];
            }
            //handle insert Multi orders into ERP queue
            $queue->add($orderCollectionArr);
        }
    }
}
