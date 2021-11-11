<?php

namespace Dckap\Custom\Block\Catalog\Product\View;

class Enquiry extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Dckap\Custom\Helper\Data $helperData)
    {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    public function customText()
    {
        $config_text = "";
        if ($this->helperData->getGeneralConfig('enable')) {
            $config_text = $this->helperData->getGeneralConfig('display_text');
        }
        echo $config_text;
        return $config_text;
    }
}
