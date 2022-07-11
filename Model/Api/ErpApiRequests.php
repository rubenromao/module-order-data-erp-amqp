<?php
/**
 * @package Rubenromao_ErpApiRequests
 * @autor rubenromao@gmail.com
 */
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Api;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Sales\Api\Data\OrderInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiRequestsInterface;
use Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface;
use Rubenromao\ErpApiRequests\Model\ResourceModel\ErpApiRequests as ResourceModel;
use Magento\Framework\DataObject;

/**
 * Class RequestItem
 */
class ErpApiRequests extends AbstractModel implements ErpApiRequestsInterface
{
    /**
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceModel::class);
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
     * @param $orderId
     * @return ErpApiRequests
     */
    public function setOrderId($orderId): ErpApiRequests
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->getData(self::CODE);
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
     * @return null|string
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param $createdAt
     * @return ErpApiRequests
     */
    public function setCreatedAt($createdAt): ErpApiRequests
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param string $customerEmail
     * @return ErpApiRequestsInterface|null
     */
    public function setCustomerEmail($customerEmail): ?ErpApiRequestsInterface
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * @return int|null
     */
    public function getOrderItems(): ?int
    {
        return $this->getData(self::ORDER_ITEMS);
    }

    /**
     * @param int $orderItems
     * @return ErpApiRequestsInterface|null
     */
    public function setOrderItems($orderItems): ?ErpApiRequestsInterface
    {
        return $this->setData(self::ORDER_ITEMS, $orderItems);
    }
}
