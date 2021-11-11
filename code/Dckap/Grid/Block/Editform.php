<?php

namespace Dckap\Grid\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Dckap\Grid\Model\GridFactory;

class Editform extends Template
{
    private $GridFactory;
    public function __construct(GridFactory $GridFactory, Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->GridFactory = $GridFactory;
    }

    public function getEditFormAction()
    {
        return $this->getUrl('grid/index/Editsubmit', ['_secure' => true]);
    }
    public function getAllData()
    {
        $id = $this->getRequest()->getParam("id");
        $data = (array)$this->getRequest()->getParams();
        $model = $this->GridFactory->create();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/check.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($data['id']);
        return $model->load($data['id']);
    }
}
