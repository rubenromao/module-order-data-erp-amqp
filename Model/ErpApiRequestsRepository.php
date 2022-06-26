<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterfaceFactory;

use Rubenromao\ErpApiRequests\Model\ErpApiRequestsFactory as ModelErpApiRequestsFactory;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests as ResourceModelErpApiRequests;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests\Collection;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests\CollectionFactory as CollectionErpApiRequestsFactory;

/**
 * Class ErpApiRequestsRepository
 * @package Rubenromao\ErpApiRequests\Model
 */
class ErpApiRequestsRepository implements ErpApiRequestsRepositoryInterface
{
    /**
     * @var ResourceModelErpApiRequests
     */
    protected $modelErpApiRequestsFactory;
    /**
     * @var ResourceModelErpApiRequests
     */
    protected $resourceModelErpApiRequests;
    /**
     * @var CollectionErpApiRequestsFactory
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
     * @param CollectionErpApiRequestsFactory $collectionFactory
     * @param ErpApiRequestsSearchResultsInterface $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceModelErpApiRequests $resourceModelErpApiRequests,
        CollectionErpApiRequestsFactory $collectionFactory,
        ErpApiRequestsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceModelErpApiRequests = $resourceModelErpApiRequests;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param $orderId
     * @param $code
     * @throws CouldNotSaveException
     */
    public function save($orderId, $code)
    {
        try {
            $this->resourceModelErpApiRequests->saveErpApiRequests($orderId, $code);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the API request: %1', $exception->getMessage()),
                $exception
            );
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

//    /**
//     * @param $orderId
//     * @param $code
//     * @return mixed|void
//     */
//    public function saveErpApiRequests($orderId, $code)
//    {
//        $this->resourceModelErpApiRequests->saveErpApiRequests($orderId, $code);
//    }
//
//    /**
//     * @param $orderId
//     * @param $code
//     * @return array|mixed
//     */
//    public function getErpApiRequests($orderId, $code)
//    {
//        return $this->resourceModelErpApiRequests->getErpApiRequests($orderId, $code);
//    }
}
