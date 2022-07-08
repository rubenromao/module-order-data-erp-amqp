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
     * @return ErpApiResponse
     */
    public function setOrderId($orderId): ErpApiResponse
    {
        return $this->setData(self::ORDER_ID, $orderId);
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
     * @param $createdAt
     * @return ErpApiResponse
     */
    public function setCreatedAt($createdAt): ErpApiResponse
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
