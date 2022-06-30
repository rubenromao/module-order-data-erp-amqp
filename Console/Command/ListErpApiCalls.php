<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Console\Command;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Exception\InputException;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;

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
    private $erpApiRequestsRepository;
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
     * Order Status constructor
     *
     * @param ErpApiRequestsRepositoryInterface $erpApiRequestsRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Filter $filter
     * @param SortOrder $sortOrder
     */
    public function __construct(
        ErpApiRequestsRepositoryInterface $erpApiRequestsRepository,
        SearchCriteriaBuilder             $searchCriteriaBuilder,
        Filter                            $filter,
        SortOrder                         $sortOrder
    ) {
        $this->erpApiRequestsRepository = $erpApiRequestsRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filter = $filter;
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
            $listType = $this->getListType($input) ?? 'eq';

            $filters[] = $this->filter
                ->setField('code')
                ->setValue(200)
                ->setConditionType("$listType");

            $sort[] = $this->sortOrder
                ->setField("order_id")
                ->setDirection("ASC");

            $searchCriteria = $this->searchCriteriaBuilder
                ->setFilterGroups($filters)
                ->setSortOrders($sort)
                ->setPageSize(self::LIMIT)
                ->create();

            $dataBatch = $this->erpApiRequestsRepository->getList($searchCriteria);

            foreach ($dataBatch as $data) {
                print_r($data);
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
