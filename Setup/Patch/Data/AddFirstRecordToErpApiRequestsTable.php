<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rubenromao\ErpApiRequests\Model\ErpApiRequestsRepository;

/**
 * Class AddFirstRecordToErpApiRequestsTable
 * @package Rubenromao/ErpApiRequests\Setup\Patch\Data
 *
 * Add first dummy record to our custom table
 */
class AddFirstRecordToErpApiRequestsTable implements DataPatchInterface
{
    /**
     * @var ErpApiRequestsRepository
     */
    private $erpApiRequestsRepository;

    /**
     * @param ErpApiRequestsRepository $erpApiRequestsRepository
     */
    public function __construct(
        ErpApiRequestsRepository $erpApiRequestsRepository
    ) {
        $this->erpApiRequestsRepository = $erpApiRequestsRepository;
    }

    /**
     * @return void
     * @throws CouldNotSaveException
     */
    public function apply(): void
    {
        $this->erpApiRequestsRepository->save(0,999);
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
