<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Model\Api;

use Rubenromao\ErpApiRequests\Api\Data\ErpApiResponseInterface;
use Magento\Framework\DataObject;

/**
 * Class ErpApiResponse
 */
class ErpApiResponse extends DataObject implements ErpApiResponseInterface
{
    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @param $orderId
     * @return ErpApiResponse
     */
    public function setOrderId($orderId): ErpApiResponse
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
     * @return ErpApiResponse
     */
    public function setCode($code): ErpApiResponse
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
     * @return ErpApiResponse
     */
    public function setCreatedAt($createdAt): ErpApiResponse
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
     * @return ErpApiResponseInterface|null
     */
    public function setCustomerEmail(string $customerEmail): ?ErpApiResponseInterface
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
     * @return ErpApiResponseInterface|null
     */
    public function setOrderItems(int $orderItems): ?ErpApiResponseInterface
    {
        return $this->setData(self::ORDER_ITEMS, $orderItems);
    }
}
