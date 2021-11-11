<?php

namespace Dckap\Grid\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Dckap\Grid\Model\GridFactory;

class Editsubmit extends Action
{
    protected $resultPageFactory;
    protected $GridFactory;
    private $url;

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
            $data = (array)$this->getRequest()->getPost();
            $id = $data['c_id'];

            if ($data) {
                $model = $this->GridFactory->create();
                $model->setId($id)->addData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Updated Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getUrl('grid/index/showdata'));
        return $resultRedirect;
    }
}
