<?php

namespace Rubenromao\ErpApiRequests\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Rubenromao\ErpApiRequests\Model\ErpApiRequestsFactory;

/**
 * Test List block
 */
class ListErpApiRequests extends Template
{
    /**
     * @param Context $context
     * @param ErpApiRequestsFactory $test
     */
    public function __construct(
        Context $context,
        ErpApiRequestsFactory $test
    ) {
        $this->_test = $test;
        parent::__construct($context);
    }

    /**
     * @return ListErpApiRequests
     */
    public function _prepareLayout(): ListErpApiRequests
    {
        $this->pageConfig->getTitle()->set(__('Simple Custom Module List Page'));

        return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getErpApiRequestsCollection()
    {
        $test = $this->_test->create();

        return $test->getCollection();
    }
}
