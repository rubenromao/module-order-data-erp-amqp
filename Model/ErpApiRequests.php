<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;

/**
 * Class ErpApiRequests
 * @package Rubenromao_ErpApiRequests
 */
class ErpApiRequests extends AbstractModel implements ErpApiRequestsInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(ResourceModel\ErpApiRequests::class);
    }

    /**
     * ErpApiRequests constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->getData(self::CODE);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param $orderId
     * @return ErpApiRequests
     */
    public function setOrderId($orderId): ErpApiRequests
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @param $code
     * @return ErpApiRequests
     */
    public function setCode($code): ErpApiRequests
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * @param $createdAt
     * @return ErpApiRequests
     */
    public function setCreatedAt($createdAt): ErpApiRequests
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
