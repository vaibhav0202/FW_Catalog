<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2014 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Model_Observer extends Mage_Catalog_Model_Observer
{
    /**
     * Adds catalog categories to top menu
     *
     * @param Varien_Event_Observer $observer
     */
    public function addCatalogToTopmenuItems(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        $block->addCacheTag(Mage_Catalog_Model_Category::CACHE_TAG);
        $package = Mage::getDesign()->getPackageName();
        $catObj = Mage::registry('current_product') ?: Mage::registry('current_category');
        $design = Mage::getSingleton('catalog/design')->getDesignSettings($catObj)->getCustomDesign();
        if ($package == 'iw' && $design === null) return;
        $categories = Mage::helper('catalog/category')->getStoreCategories();   // Get the store categories
        if ($communityData = Mage::getConfig()->getNode('iw/communities')) {  // read config data
            $currentTheme = explode('/', $design);
            $currentTheme = end($currentTheme);
            $communityData = $communityData->xpath($currentTheme.'/@id');
            if($rootCat = (int) reset($communityData)) {
                if (isset($categories[$rootCat])) {     // If the root cat is a top level category
                    $rootCat = $categories[$rootCat];   // Use rootCat ID to get the rootCat object
                    if (Mage::helper('catalog/category_flat')->isEnabled()) {   // Check if flat tables are enabled
                        $categories = (array) $rootCat->getChildrenNodes();     // Get children of flat table model
                    } else {
                        $categories = $rootCat->getChildren();      // Get children for non flat table model
                    }
                }
            }
        }
        $this->_addCategoriesToMenu($categories, $observer->getMenu(), $block);  // Add the children to the menu
    }

    public function addCategoryLayoutHandle(Varien_Event_Observer $observer)
    {
        if ($observer->getAction()->getFullActionName() != 'catalog_category_view') return;  // Return if not a category view

        $category = Mage::registry('current_category');             // Get the current category
        if (!$category) return;                                     // Return if category model not available

        $update = $observer->getLayout()->getUpdate();              // Get layout updates
        if (!$update) return;                                       // Return if layout updates not available

        if ($category->getLevel() == 2) {                           // Check if category is a top category
            $update->addHandle('fw_catalog_category_top');          // Add the top category layout handle
        }
        if ($category->hasChildren()) {                             // Check if category has children
            $update->addHandle('fw_catalog_category_haschildren');  // Add the has children layout handle
        }
    }
}
