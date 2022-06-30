<?php
declare(strict_types=1);

namespace Rubenromao\ErpApiRequests\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Rubenromao\ErpApiRequests\Model\ErpApiRequestsFactory;

/**
 * List block
 */
class ErpItemsStatus extends Template
{
    /**
     * @var ErpApiRequestsFactory
     */
    private $erpRepo;

    /**
     * @param Context $context
     * @param ErpApiRequestsFactory $test
     */
    public function __construct(
        Context $context,
        ErpApiRequestsFactory $test
    ) {
        $this->erpRepo = $test;
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
        $test = $this->erpRepo->create();

        return $test->getCollection();
    }
}
