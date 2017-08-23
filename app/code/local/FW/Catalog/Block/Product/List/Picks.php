<?php
/**
 * This class is used for "Top Picks" block on the community/category landing pages
 * 
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 * @author      Ian Frizzel <ian.frizzel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List_Picks extends FW_Catalog_Block_Product_List_Abstract
{
    /**
     * Called after ToHtml() is called, but before the HTML output logic
     */
    protected function _beforeToHtml()
    {
        $_communities = Mage::getConfig()->getNode('iw/communities');   // Get communities node from config

        if (Mage::registry('current_category')) {   // Check if there is a category in registry
			$_catid = Mage::registry('current_category')->getId();                  // Get the category id of current category	
            $toppicks = $_communities->xpath('*[@id='.$_catid.']/toppicks/@id');    // Run XPath on config to get top picks cat id
            $toppicks = isset($toppicks[0]) ? (int) $toppicks[0] : '';              // Make sure there was an id returned from XPath
            
            if ($toppicks) {    // Make sure we have a cat id for the top picks block to use
                $toppicks = Mage::getModel('catalog/category')->load($toppicks);    // Load category
                if ($toppicks->getId()) {                                           // Make sure a category loaded
                    $this->_category = $toppicks;                                   // Load the category and set to block
                    $this->setTemplate('catalog/product/list/featured.phtml');      // Set Template to the block so that it will render
                    return parent::_beforeToHtml();     // Return parent method to maintain any core functionality
                }
            }
        }        
    }
    
    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        return parent::_getProductCollection()->setPageSize(3);     // Return the collection with numbers of products to display (used in template)
    }

    /**
     * Retrieve current view mode
     * @return string
     */
    public function getMode()
    {
        return 'grid';  // Force grid mode (used in template)
    }    
}
