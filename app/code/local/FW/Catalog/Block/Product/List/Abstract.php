<?php
/**
 * This class is used for default logic shared between all the featured blocks
 * 
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List_Abstract extends Mage_Catalog_Block_Product_Abstract
{
    protected $_category;
    
    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        $layer = Mage::getModel('catalog/layer');       // Get the catalog layer model
        if ($this->_category) {                         // Make sure a category is loaded            
            $this->setName($this->_category->getName());    // Set the category name to block (used in template)
            $layer->setCurrentCategory($this->_category);   // Set the category to the layer
        }
        $collection = $layer->getProductCollection();   // Get the product collection from the layer
        $collection->getSelect()->order('rand()');      // Set a random order on the collection
        $collection->setPageSize(1);                    // Set number of products to display from collection
        return $collection;                             // Return the collection
    }

    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function getLoadedProductCollection()
    {
        return $this->_getProductCollection();        // Return the collection (used in template)
    }

    /**
     * Do not output the toolbar for this list
     * @return string
     */
    public function getToolbarHtml()
    {
         return '';        // Return empty string as toolbar (used in template)
    }

    /**
     * Retrieve current view mode
     * @return string
     */
    public function getMode()
    {
        return 'list';        // Force the view mode for the block (used in template)
    }      
}
