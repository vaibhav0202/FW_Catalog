<?php
/**
 * This class is used by FPC to in place of a hole in the cached HTML
 * 
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Model_Container_Product_List_Featured extends Enterprise_PageCache_Model_Container_Abstract
{
    /**
     * Get container individual cache id
     *
     * @return string|false
     */
    protected function _getCacheId()
    {
        return $this->_placeholder->getName();		// Return the placeholder name as the cache id
    }
    
    /**
     * Render block content
     *
     * @return string
     */
    protected function _renderBlock()
    {
        if (!Mage::registry('current_category')) {                                      // Check if there is a category in the registry
            if ($_catId = $this->_processor->getMetaData('catalog_category_id')) {      // Try to get the catid from FPC Processor
                $_category = Mage::getModel('catalog/category')->load($_catId);         // Load the category from FPC Processor
                Mage::register('current_category', $_category);                         // Register the category to the Mage registry
            }            
        }
        $blockName = $this->_placeholder->getAttribute('block');        // Get the block name from the placeholder
        $block = Mage::app()->getLayout()->createBlock($blockName);     // Create the block
        return $block->toHtml();                                        // Return the blocks HTML
    }

    /**
     * Save data to cache storage
     *
     * @param string $data
     * @param string $id
     * @param array $tags
     * @param null|int $lifetime
     * @return Enterprise_PageCache_Model_Container_Abstract
     */
    protected function _saveCache($data, $id, $tags = array(), $lifetime = null)
    {
        return false;    // Return false to disable caching of the block
    }
}
