<?php

/**
 * Grid Grid Collection.
 *
 * @category  Webkul
 * @package   Dckap_Grid
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Dckap\Grid\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Dckap\Grid\Model\Grid',
            'Dckap\Grid\Model\ResourceModel\Grid'
        );
    }
}
