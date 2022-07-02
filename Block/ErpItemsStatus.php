<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Rubenromao\ErpApiRequests\Model\ErpApiRequests;

/**
 * List block
 */
class ErpItemsStatus extends Template
{
    /**
     * @var ErpApiRequests
     */
    private $erpModel;

    /**
     * @param Context $context
     * @param ErpApiRequests $test
     */
    public function __construct(
        Context $context,
        ErpApiRequests $test
    ) {
        $this->erpModel = $test;
        parent::__construct($context);
    }

    /**
     * @return ErpItemsStatus
     */
    public function _prepareLayout(): ErpItemsStatus
    {
        $this->pageConfig->getTitle()->set(__('List Page'));

        return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getErpApiRequestsCollection()
    {
        return $this->erpModel->getCollection()->getItems();
    }
}
