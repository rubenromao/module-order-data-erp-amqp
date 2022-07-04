<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Console\Command;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\InputException;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rubenromao\ErpApiRequests\Model\ErpApiRequestsRepository;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsSearchResultsInterface;

/**
 * Command to list the 10 last failed or success api calls to erp
 */
class ListErpApiCalls extends Command
{
    protected const COMMAND = 'erp:list';
    protected const PARAM_LIST_TYPE = 'code';
    protected const PASS = 'pass';
    protected const FAIL = 'fail';
    protected const LIMIT = 10;

    /**
     * @var ErpApiRequestsRepositoryInterface
     */
    private $erpRepositoryInterface;
    /**
     * @var ErpApiRequestsRepository
     */
    private $erpRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var SortOrder
     */
    private $sortOrder;
    /**
     * @var Filter
     */
    private $filter;
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteriaInterface;
    /**
     * @var FilterGroup
     */
    private FilterGroup $filterGroup;
    /**
     * @var ErpApiRequestsSearchResultsInterface
     */
    private $erpApiRequestsSearchResult;

    /**
     * ListErpApiCalls constructor
     *
     * @param ErpApiRequestsRepositoryInterface $erpRepositoryInterface
     * @param ErpApiRequestsSearchResultsInterface $erpApiRequestsSearchResult
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchCriteriaInterface $searchCriteriaInterface
     * @param Filter $filter
     * @param FilterGroup $filterGroup
     * @param SortOrder $sortOrder
     */
    public function __construct(
        ErpApiRequestsRepositoryInterface $erpRepositoryInterface,
        ErpApiRequestsRepository $erpRepository,
        ErpApiRequestsSearchResultsInterface $erpApiRequestsSearchResult,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchCriteriaInterface $searchCriteriaInterface,
        Filter $filter,
        FilterGroup $filterGroup,
        SortOrder $sortOrder
    ) {
        $this->erpRepositoryInterface = $erpRepositoryInterface;
        $this->erpRepository = $erpRepository;
        $this->erpApiRequestsSearchResult = $erpApiRequestsSearchResult;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->filter = $filter;
        $this->filterGroup = $filterGroup;
        $this->sortOrder = $sortOrder;
        parent::__construct(self::COMMAND);
    }

    /**
     * @return void
     */
    public function configure()
    {
        $arguments = $this->getArgs();
        $this->setName(self::COMMAND)
            ->setDescription(__('List 10 last Order Sent To ERP'))
            ->setDefinition($arguments);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        try {
            $listType = $this->getListType($input);

            /** @var Filter[] $filters */
            $filters[] = $this->filter
                ->setField('code')
                ->setConditionType("$listType")
                ->setValue(999);

            $sort[] = $this->sortOrder
                ->setField("order_id")
                ->setDirection("ASC");

            $searchCriteria = $this->searchCriteriaInterface
                ->setFilterGroups([$this->filterGroup->setFilters($filters)])
                ->setSortOrders($sort)
                ->setPageSize(self::LIMIT);

//            $searchCriteria = $this->searchCriteriaBuilder
//                ->addFilters($filters)
//                ->setSortOrders($sort)
//                ->setPageSize(self::LIMIT)
//                ->create();

            if ($items = $this->erpRepositoryInterface->getList($searchCriteria)->getItems()) {
                foreach ($items as $item) {
                    echo $item["order_id"] . $item["code"] . $item["created_at"] . PHP_EOL;
                }
            } else {
                echo 'No records found' . PHP_EOL;
            }

        } catch (InputException $e) {
            $output->writeln("Error: " . $e->getMessage());
            return;
        }
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function getListType(InputInterface $input): string
    {
        $listType = $input->getOption(self::PARAM_LIST_TYPE);
        if ($listType === self::PASS || $listType === null) {
            // code 200
            $listType = 'eq';
        } else {
            // all but 200
            $listType = 'neq';
        }

        return $listType;
    }

    /**
     * @return array
     */
    protected function getArgs()
    {
        $args   = [];
        $args[] = new InputOption(
            self::PARAM_LIST_TYPE,
            null,
            InputOption::VALUE_REQUIRED,
            'The http response code must be specified'
        );

        return $args;
    }
}
