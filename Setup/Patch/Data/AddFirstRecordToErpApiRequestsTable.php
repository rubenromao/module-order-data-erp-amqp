<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterfaceFactory;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;
//use Rubenromao\ErpApiRequests\Model\ErpApiRequestsRepository;

/**
 * Class AddFirstRecordToErpApiRequestsTable
 * @package Rubenromao/ErpApiRequests\Setup\Patch\Data
 *
 * Add first dummy record to our custom table
 */
class AddFirstRecordToErpApiRequestsTable implements DataPatchInterface
{
    protected const ORDER_ID = 0;
    protected const CODE = 999;

    /**
     * @var ErpApiRequestsInterfaceFactory
     */
    private $erpApiRequestsRepository;
    /**
     * @var ErpApiRequestsRepositoryInterface
     */
    private $erpApiRequestsInterface;
    private ErpApiRequestsInterfaceFactory $erpApiRequestsFactory;

    /**
     * @param ErpApiRequestsRepositoryInterface $erpApiRequestsRepository
     * @param ErpApiRequestsInterfaceFactory $erpApiRequestsFactory
     */
    public function __construct(
        ErpApiRequestsRepositoryInterface $erpApiRequestsRepository,
        ErpApiRequestsInterfaceFactory $erpApiRequestsFactory
    ) {
        $this->erpApiRequestsRepository = $erpApiRequestsRepository;
        $this->erpApiRequestsFactory = $erpApiRequestsFactory;
    }

    /**
     * @return void
     * @throws CouldNotSaveException
     */
    public function apply(): void
    {
        $object = $this->erpApiRequestsFactory->create();
        $object->setOrderId('0');
        $object->setCode('999');
        $this->erpApiRequestsRepository->save($object);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}
