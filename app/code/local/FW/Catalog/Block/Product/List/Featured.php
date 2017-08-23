<?php
/**
 * This class is used for "Today's Feature" block on homepage and category
 * 
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 * @author      Ian Frizzel <ian.frizzel@fwmedia.com>
 */
class FW_Catalog_Block_Product_List_Featured extends FW_Catalog_Block_Product_List_Abstract
{
    /**
     * Called after ToHtml() is called, but before the HTML output logic
     */
    protected function _beforeToHtml()
    {
        $_communities = Mage::getConfig()->getNode('iw/communities');   // Get communities node from config
                
        $todaysfeature = ''; // init
        if (Mage::registry('current_category')) {       // If category in registry this block is on a category page
			$_catid = Mage::registry('current_category')->getId();                          // Get the category id of current category
            $todaysfeature = $_communities->xpath('*[@id='.$_catid.']/todaysfeature/@id');  // Run XPath on config to get todays featured cat id
            $todaysfeature = isset($todaysfeature[0]) ? (int) $todaysfeature[0] : '';       // Make sure there was an id returned from XPath
        } else {        // No category in registry means the block is likely being used on the homepage
            $todaysfeature = Mage::getConfig()->getNode('iw/home/todaysfeature')->getAttribute('id');   // Get homepage todays featured cat id   
        }
        if ($todaysfeature) {       // Make sure we have a cat id for the todays feature block to use
            $todaysfeature = Mage::getModel('catalog/category')->load($todaysfeature);  // Load category
            if ($todaysfeature->getId()) {                                      // Make sure a category loaded
                $this->_category = $todaysfeature;                              // Set category to block
                $this->setTemplate('catalog/product/list/featured.phtml');      // Set Template to the block so that it will render
                return parent::_beforeToHtml();     // Return parent method to maintain any core functionality
            }
        }        
    } 
}
