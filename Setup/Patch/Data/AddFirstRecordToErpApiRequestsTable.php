<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Setup\Patch\Data;

use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Sales\Model\AbstractModel;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests;
use Rubenromao\ErpApiRequests\Model\Api\ErpApiRequestsRepository;

/**
 * Add first dummy record to our custom table
 */
class AddFirstRecordToErpApiRequestsTable implements DataPatchInterface
{
    protected const ORDER_ID = 0;
    protected const CODE = 999;
    protected const ARRAY = [0, 999];

    private ErpApiRequestsRepository $resourceModel;

    /**
     * AddFirstRecordToErpApiRequestsTable constructor
     *
     * @param ErpApiRequestsRepository $resourceModel
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ErpApiRequestsRepository $resourceModel
    ) {
        $this->resourceModel = $resourceModel;
    }

    /**
     * {@inheritdoc}
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function apply()
    {
        //$this->resourceModel->saveErpApiRequest(self::ORDER_ID, self::CODE);
        //$object = $this->setData('order_id', self::ORDER_ID)->setData('code', self::CODE);
        //$object->_getResource()->load()
        //var_dump($object);exit();
        //$this->resourceModel->save($object->resourceModel->save($object));
        $this->resourceModel->save($this->getObject(self::ARRAY));

    }

    protected function getObject($array)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $collection = $objectManager->create(\Magento\Framework\Model\AbstractModel::class);
        //$collection = $this->collectionFactory->create((array)\Magento\Framework\Data\Collection::class);

        foreach ($array as $row) {
            $varienObject = new \Magento\Framework\DataObject();
            $varienObject->setData($row);
            //$collection->addItem($varienObject);
        }
        return $varienObject;//$collection;

//        foreach (self::ARRAY as $row) {
//            $object = new \Magento\Framework\DataObject();
//            $object->setData($row);
//            //$collection->addItem($object);
//        }
//        return $collection;
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
