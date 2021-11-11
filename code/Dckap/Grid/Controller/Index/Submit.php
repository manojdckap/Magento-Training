<?php

namespace Dckap\Grid\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Dckap\Grid\Model\GridFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Message\ManagerInterface;

class Submit extends Action
{
    protected $_messageManager;
    protected $resultPageFactory;
    protected $GridFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        GridFactory $GridFactory,
        ManagerInterface $messageManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->GridFactory = $GridFactory;
        $this->_messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();


            if ($data) {
                $model = $this->GridFactory->create();
                $model->setData($data)->save();

                $this->_messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->_messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
