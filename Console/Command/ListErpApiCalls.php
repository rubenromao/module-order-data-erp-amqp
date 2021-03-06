<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Console\Command;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\InputException;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;

/**
 * Command to list the 10 last failed or success api calls to erp
 */
class ListErpApiCalls extends Command
{
    protected const COMMAND = 'erp:list';
    protected const PARAM_LIST_TYPE = 'code';
    protected const PASS = "pass";
    protected const FAIL = 'fail';
    protected const LIMIT = 10;

    /**
     * @var ErpApiRequestsRepositoryInterface
     */
    private $erpRepositoryInterface;
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
     * ListErpApiCalls constructor
     *
     * @param ErpApiRequestsRepositoryInterface $erpRepositoryInterface
     * @param SearchCriteriaInterface $searchCriteriaInterface
     * @param Filter $filter
     * @param FilterGroup $filterGroup
     * @param SortOrder $sortOrder
     */
    public function __construct(
        ErpApiRequestsRepositoryInterface $erpRepositoryInterface,
        SearchCriteriaInterface $searchCriteriaInterface,
        Filter $filter,
        FilterGroup $filterGroup,
        SortOrder $sortOrder
    ) {
        $this->erpRepositoryInterface = $erpRepositoryInterface;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->filter = $filter;
        $this->filterGroup = $filterGroup;
        $this->sortOrder = $sortOrder;
        parent::__construct(self::COMMAND);
    }

    /**
     * @return void
     */
    public function configure(): void
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
                ->setField(self::PARAM_LIST_TYPE)
                ->setConditionType("$listType")
                ->setValue(200);

            $sort[] = $this->sortOrder
                ->setField("order_id")
                ->setDirection("ASC");

            $searchCriteria = $this->searchCriteriaInterface
                ->setFilterGroups([$this->filterGroup->setFilters($filters)])
                ->setSortOrders($sort)
                ->setPageSize(self::LIMIT);

            if ($items = $this->erpRepositoryInterface->getList($searchCriteria)->getItems()) {
                foreach ($items as $item) {
                    $output->writeln(
                        "Order ID: " . $item["order_id"] .
                        " | Code: "  . $item["code"] .
                        " | Created At: " . $item["created_at"]
                    );
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
        if ($listType == self::PASS || $listType === '') {
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
    protected function getArgs(): array
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
