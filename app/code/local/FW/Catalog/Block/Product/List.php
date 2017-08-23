<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2012 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List extends Mage_Catalog_Block_Product_List {

    /**
     * This functionality has been moved to FW_Catalog_Block_Product_List_Toolbar
     * Leaving this stub to make sure this change doesn't break anything LIVE
     * 
     * @deprecated
     */
    protected function _beforeToHtml()
    {
        return parent::_beforeToHtml();
    }
}