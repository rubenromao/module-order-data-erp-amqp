<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rubenromao\ErpApiRequests\Api\ErpApiRequestsRepositoryInterface;

/**
 * Add first dummy record to our custom table
 */
class AddFirstRecordToErpApiRequestsTable implements DataPatchInterface
{
    protected const ORDER_ID = 0;
    protected const CODE = 999;

    /**
     * @var ErpApiRequestsRepositoryInterface
     */
    private $repositoryInterface;

    /**
     * @param ErpApiRequestsRepositoryInterface $repositoryInterface
     */
    public function __construct(
        ErpApiRequestsRepositoryInterface $repositoryInterface
    ) {
        $this->repositoryInterface = $repositoryInterface;
    }

    /**
     * @return void
     * @throws CouldNotSaveException
     */
    public function apply(): void
    {
        $this->repositoryInterface->save(self::ORDER_ID, self::CODE);
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
