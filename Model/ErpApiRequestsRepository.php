<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
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
     * @return \Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface|void
     * @throws CouldNotSaveException
     */
    public function save($apiRequests)
    {
        try {
            $this->resourceModelErpApiRequests->save($apiRequests);
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
        /** @var \Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests\Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
}



























