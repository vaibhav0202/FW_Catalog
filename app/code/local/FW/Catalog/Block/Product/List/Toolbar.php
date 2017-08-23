<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2012 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{
    /**
     * Set collection to pager
     * 
     * Overwrite to allow the setting of a secondary sort.  This location was picked for performance
     * concerns since the sort can be set before the collection is loaded to avoid having to reload the collection.
     *
     * @param Varien_Data_Collection $collection
     * @return Mage_Catalog_Block_Product_List_Toolbar
     */
    public function setCollection($collection)
    {
        // Call parent method to do normal CORE work
        parent::setCollection($collection);
        
        // Both Catalog and SOLR collections supports setOrder method for adding additional sorts
        $this->_collection->setOrder('publication_date', 'desc');
        
        return $this;   // return this object to preserve CORE behavior
    }
}