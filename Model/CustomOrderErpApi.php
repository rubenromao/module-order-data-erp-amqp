<?php
declare(strict_types=1);

namespace Rubenromao\OrderDataErpAmqp\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

/**
 * Class CustomOrderErpApi
 * @package Rubenromao_OrderDataErpAmqp
 */
class CustomOrderErpApi extends AbstractModel
{
    /**
     * Author constructor.
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
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @see \Magento\Framework\Model\AbstractModel::_construct()
     */
    public function _construct()
    {
        $this->_init('Rubenromao\OrderDataErpAmqp\Model\ResourceModel\CustomOrderErpApi');
    }

    /**
     * Loading Book data
     *
     * @param mixed $key
     * @param string $field
     * @return  $this
     * @throws LocalizedException
     */
    public function load($key, $field = null)
    {
        if ($field === null) {
            $this->_getResource()->load($this, $key, 'order_id');
            return $this;
        }
        $this->_getResource()->load($this, $key, $field);
        return $this;
    }
}
