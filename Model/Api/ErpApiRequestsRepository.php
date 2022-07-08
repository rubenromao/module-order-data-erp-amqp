<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterfaceFactory;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests as ResourceModelErpApiRequests;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests\CollectionFactory;

/**
 * Class ErpApiRequestsRepository
 * @package Rubenromao\ErpApiRequests\Model
 */
class ErpApiRequestsRepository implements ErpApiRequestsRepositoryInterface
{
    /**
     * @var ResourceModelErpApiRequests
     */
    protected $resourceModelErpApiRequests;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var ErpApiRequestsSearchResultsInterface
     */
    protected $searchResultsFactory;
    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * ErpApiRequestsRepository constructor.
     *
     * @param ResourceModelErpApiRequests $resourceModelErpApiRequests
     * @param CollectionFactory $collectionFactory
     * @param ErpApiRequestsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceModelErpApiRequests $resourceModelErpApiRequests,
        CollectionFactory $collectionFactory,
        ErpApiRequestsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceModelErpApiRequests = $resourceModelErpApiRequests;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param $apiRequests
     * @return ErpApiRequestsInterface|void
     * @throws CouldNotSaveException
     */
    /**
     * @param $erpApiRequests
     * @return ErpApiRequestsInterface
     * @throws CouldNotSaveException
     */
    public function save($erpApiRequests): ErpApiRequestsInterface
    {
        try {
            $this->resourceModelErpApiRequests->save($erpApiRequests);
        } catch (\Exception $exception) {
            return throw new CouldNotSaveException(
                __('Could not save the API request: %1', $exception->getMessage()),
                $exception
            );
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ErpApiRequestsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ErpApiRequestsSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
    /**
     * {@inheritDoc}
     *
     * @param int $id
     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getItem(int $id)
    {
        $collection = $this->getOrderCollection()
            ->addAttributeToFilter('entity_id', ['eq' => $id]);

        /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
        $product = $collection->getFirstItem();
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Product not found'));
        }

        return $this->getResponseItemFromProduct($product);
    }

//    /**
//     * {@inheritDoc}
//     *
//     * @return \Rubenromao\ErpApiRequests\Api\ErpApiResponseInterface[]
//     */
//    public function getList()
//    {
//        $collection = $this->getOrderCollection();
//
//        $result = [];
//        /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
//        foreach ($collection->getItems() as $product) {
//            $result[] = $this->getResponseItemFromProduct($product);
//        }
//
//        return $result;
//    }

    /**
     * @param \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface[] $orderData
     * @return void
     */
    public function prepareToSendOrderDataToErp($orderData)
    {
        foreach ($orderData as $order) {
            $this->sendOrderDataToErp(
                $order->getOrderId(),
                $order->getOrderId(),
                $order->getOrderId()
            );
        }
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface
     */
    private function getResponseFromErp(OrderInterface $order)
    {
        /** @var \Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface $responseItem */
        $responseItem = $this->responseItemFactory->create();

        $responseItem->setId($order->getId())
                    ->setSku($order->getSku())
                    ->setName($order->getCustomerEmail()
                );

        return $responseItem;
    }

    /**
     * @param int $orderId
     * @param string $customerEmail
     * @param int $orderItems
     * @return void
     */
    public function sendOrderDataToErp($orderId, $customerEmail, $orderItems)
    {
        $this->orderAction->updateAttributes(
                    ['order_id' => $orderId],
                    ['description' => $customerEmail],
                    ['description' => $orderItems],
        );
    }
}
