<?php

namespace Dckap\Grid\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Dckap\Grid\Model\GridFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\UrlInterface;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $GridFactory;

    public function __construct(
        UrlInterface $url,
        Context $context,
        PageFactory $resultPageFactory,
        GridFactory $GridFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->GridFactory = $GridFactory;
        $this->url = $url;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getParams();
            if ($data) {
                $model = $this->GridFactory->create()->load($data['id']);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getUrl('grid/index/showdata'));
        return $resultRedirect;
    }
}
