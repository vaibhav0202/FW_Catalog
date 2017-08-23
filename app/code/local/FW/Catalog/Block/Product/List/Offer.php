<?php
/**
 * This class is used for "Featured Offer" block on the sub category pages
 * 
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 * @author      Ian Frizzel <ian.frizzel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List_Offer extends FW_Catalog_Block_Product_List_Abstract
{
    /**
     * Called after ToHtml() is called, but before the HTML output logic
     */
    protected function _beforeToHtml()
    {
        $_communities = Mage::getConfig()->getNode('iw/communities');   // Get communities node from config
        
        if (Mage::registry('current_category') && Mage::registry('current_category')->getShowFeatured()) {  // Check if show_featured is "yes"
            $subCategories = explode(',', Mage::registry('current_category')->getChildren());       // Get the children ids as an array
            foreach ($subCategories as $cid) {                              // Loop through the children ids
                $_subCat = Mage::getModel('catalog/category')->load($cid);  // Load the child category
                if ($_subCat->getIsFeatured()) {                            // Check if child category is featured
                    $this->_category = $_subCat;                            // Set category to block
                    $this->setTemplate('catalog/product/list/featured.phtml');       // Set Template to the block so that it will render
                    return parent::_beforeToHtml();     // Return parent method to maintain any core functionality
                } 
            }
        }   
    } 
}
