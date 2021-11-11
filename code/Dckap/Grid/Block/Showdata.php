<?php

namespace Dckap\Grid\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Dckap\Grid\Model\ResourceModel\Grid\CollectionFactory;

class Showdata extends Template
{

    public $collection;

    public function __construct(Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        return $this->collection->create();
    }
    public function getDeleteAction()
    {
        return $this->getUrl('grid/index/delete', ['_secure' => true]);
    }

    public function getEditAction()
    {
        return $this->getUrl('grid/index/edit', ['_secure' => true]);
    }
}
