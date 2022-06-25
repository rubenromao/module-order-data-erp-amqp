<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Setup\Patch\Data;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Rubenromao\OrderDataErpAmqp\Model\CustomOrderErpApi;

/**
 * Class AddData
 * @package Ced\GraphQl\Setup\Patch\Data
 */
class AddCustomOrderDefaultData implements DataPatchInterface
{
    /**
     * @var CustomOrderErpApi
     */
    private $customOrderTable;

    /**
     * @param CustomOrderErpApi $customOrderTable
     */
    public function __construct(
        CustomOrderErpApi $customOrderTable
    ) {
        $this->customOrderTable = $customOrderTable;
    }

    /**
     * @return void
     * @throws AlreadyExistsException
     */
    public function apply(): void
    {
        $tableInitData = [];
        $tableInitData['order_id'] = 0;
        $tableInitData['timestamp'] = 999;
        $data = $this->customOrderTable->addData($tableInitData);

//        $data = $this->customOrderTable->create();
//        $data->setData($tableInitData);
//        $this->customOrderTable->getResource()->save($data);
        $this->customOrderTable->getResource()->save($data);
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
