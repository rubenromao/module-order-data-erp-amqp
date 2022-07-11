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
use Magento\Framework\Exception\NoSuchEntityException;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollection;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterfaceFactory;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterfaceFactory;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterfaceFactory;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;

use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests as ResourceModelErpApiRequests;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests\CollectionFactory as CustomOrderCollection;

/**
 * Class ErpApiRequestsRepository
 * @package Rubenromao\ErpApiRequests\Model
 */
class ErpApiRequestsRepository implements ErpApiRequestsRepositoryInterface
{
    /**
     * @var ResourceModelErpApiRequests
     */
    private $resourceModelErpApiRequests;
    /**
     * @var CustomOrderCollection
     */
    private $collectionFactory;
    /**
     * @var ErpApiRequestsSearchResultsInterface
     */
    private $searchResultsFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var OrderCollection
     */
    private $orderCollectionFactory;
    /**
     * @var ErpApiResponseInterfaceFactory
     */
    private $responseFactory;
    /**
     * @var ErpApiRequestsInterfaceFactory
     */
    private $requestFactory;

    /**
     * ErpApiRequestsRepository constructor.
     *
     * @param ResourceModelErpApiRequests $resourceModelErpApiRequests
     * @param CustomOrderCollection $collectionFactory
     * @param OrderCollection $orderCollectionFactory
     * @param ErpApiRequestsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ErpApiResponseInterfaceFactory $responseFactory
     * @param ErpApiRequestsInterfaceFactory $requestFactory
     */
    public function __construct(
        ResourceModelErpApiRequests $resourceModelErpApiRequests,
        CustomOrderCollection $collectionFactory,
        OrderCollection $orderCollectionFactory,
        ErpApiRequestsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        ErpApiResponseInterfaceFactory $responseFactory,
        ErpApiRequestsInterfaceFactory $requestFactory
    ) {
        $this->resourceModelErpApiRequests = $resourceModelErpApiRequests;
        $this->collectionFactory = $collectionFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->responseFactory = $responseFactory;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param $erpApiRequests
     * @return ErpApiRequestsInterface|void
     * @throws CouldNotSaveException
     */
    public function save($erpApiRequests): ?ErpApiRequestsInterface
    {
        //var_dump($erpApiRequests);exit();
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
     * @return ErpApiRequestsSearchResultsInterface|null
     */
    public function getList($searchCriteria): ?ErpApiRequestsSearchResultsInterface
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
     * @param int $id
     * @return ErpApiResponseInterface|null
     * @throws NoSuchEntityException
     */
    public function getItem($id): ?ErpApiResponseInterface
    {
        $collection = $this->orderCollectionFactory->create();
        $collection->addAttributeToFilter('entity_id', ['eq' => $id]);

        /** @var OrderInterface $order */
        $order = $collection->getFirstItem();
        if (!$order->getId()) {
            throw new NoSuchEntityException(__('Order not found'));
        }

        return $this->getResponseItemFromErp($order);
    }

    /**
     * @param OrderInterface $order
     * @return ErpApiResponseInterface
     */
    private function getResponseItemFromErp($order): ErpApiResponseInterface
    {
        /** @var ErpApiResponseInterface $response */
        $response = $this->responseFactory->create();

        $response->setOrderId($order->getEntityId())
                    ->setCustomerEmail($order->getCustomerEmail())
                    ->setOrderItems($order->getTotalItemCount());

        return $response;
    }

//    /**
//     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
//     */
//    private function getOrderCollection(): \Magento\Sales\Model\ResourceModel\Order\Collection
//    {
//        /** @var \Magento\Sales\Model\ResourceModel\Order\Collection $collection */
//        $collection = $this->orderCollectionFactory->create();
//
//        $collection->load();
//
//        return $collection;
//    }

//    /**
//     * {@inheritDoc}
//     *
//     * @return \Rubenromao\ErpApiRequests\Api\ErpApiResponseInterface[]
//     */
//    public function getListV2()
//    {
//        $collection = $this->getOrderCollection();
//
//        $result = [];
//        /** @var \Magento\Sales\Api\Data\OrderInterface $order */
//        foreach ($collection->getItems() as $order) {
//            $result[] = $this->getResponseItemFromErp($order);
//        }
//
//        return $result;
//    }

    /**
     * @param OrderInterface $order
     * @return ErpApiResponseInterface|null
     */
    public function getResponseFromErp($order): ?ErpApiResponseInterface
    {
        /** @var ErpApiResponseInterface $responseItem */
        $response = $this->responseFactory->create();

        $response->setOrderId($order->getEntityId())
                    ->setCustomerEmail($order->getCustomerEmail())
                    ->setOrderItems($order->getTotalItemCount()
                );

        return $response;
    }

    /**
     * @param int $orderId
     * @param string $customerEmail
     * @param int $orderItems
     * @return ErpApiRequestsInterface|null
     */
    public function sendRequestToErp($orderId, $customerEmail, $orderItems): ?ErpApiRequestsInterface
    {
        /** @var ErpApiRequestsInterface $request */
        $request = $this->requestFactory->create();

        $request
            ->setOrderId($orderId)
            ->setCustomerEmail($customerEmail)
            ->setOrderItems($orderItems);

        return $request;
//                    [ErpApiResponseInterface::ORDER_ID => $orderId],
//                    [ErpApiResponseInterface::CUSTOMER_EMAIL => $customerEmail],
//                    [ErpApiResponseInterface::ORDER_ITEMS => $orderItems],
    }
}
