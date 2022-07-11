<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests;

/**
 * Add first dummy record to our custom table
 */
class AddFirstRecordToErpApiRequestsTable implements DataPatchInterface
{
    private const ORDER_ID = 0;
    private const CODE = 999;

    /**
     * @var ErpApiRequests
     */
    private $resourceModel;

    /**
     * AddFirstRecordToErpApiRequestsTable constructor
     *
     * @param ErpApiRequests $resourceModel
     */
    public function __construct(
        ErpApiRequests $resourceModel
    ) {
        $this->resourceModel = $resourceModel;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->resourceModel->saveErpApiRequest(self::ORDER_ID, self::CODE);
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
