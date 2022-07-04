<?php

namespace Rubenromao\ErpApiRequests\Controller;

class Items extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
//class Index extends \Magento\Framework\App\Action\Action
//{
//    protected $_pageFactory;
//
//    protected $_postFactory;
//
//    public function __construct(
//        \Magento\Framework\App\Action\Context $context,
//        \Magento\Framework\View\Result\PageFactory $pageFactory,
//        \Rubenromao\ErpApiRequests\Model\ErpApiRequestsFactory $postFactory
//    )
//    {
//        $this->_pageFactory = $pageFactory;
//        $this->_postFactory = $postFactory;
//        return parent::__construct($context);
//    }
//
//    public function execute()
//    {
//        $post = $this->_postFactory->create();
//        $collection = $post->getCollection();
//        foreach($collection as $item){
//            echo "<pre>";
//            print_r($item->getData());
//            echo "</pre>";
//        }
//        exit();
//        return $this->_pageFactory->create();
//    }
//}
