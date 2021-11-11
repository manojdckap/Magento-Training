<?php

namespace Dckap\Grid\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Dckap\Grid\Model\GridFactory;

class Edit extends Action
{
    protected $resultPageFactory;

    private $GridFactory;

    private $url;

    public function __construct(UrlInterface $url, GridFactory $GridFactory, Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->GridFactory = $GridFactory;
        $this->url = $url;
    }

    public function execute()
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/login.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        if ($this->isCorrectData()) {
            return $this->resultPageFactory->create();
        } else {
            $this->messageManager->addErrorMessage(__("Record Not Found"));
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->url->getUrl('grid/index/showdata'));
            return $resultRedirect;
        }
    }

    public function isCorrectData()
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/login1.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($this->getRequest()->getParam("id"));
        if ($id = $this->getRequest()->getParam("id")) {
            $model = $this->GridFactory->create();
            $model->load($id);
            if ($model->getId()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
