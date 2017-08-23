<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2013 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Model_Design extends Mage_Catalog_Model_Design
{
    /**
     * Apply package and theme
     *
     * @param string $package
     * @param string $theme
     */
    protected function _apply($package, $theme)
    {
        $design = Mage::getSingleton('core/design_package');
        if ($design->getPackageName() != 'iw-mobile') parent::_apply($package, $theme);
    }
    
    /**
     * Force the category design on the product
     */
    protected function _mergeSettings($categorySettings, $productSettings)
    {
        if ($categorySettings->getCustomDesign()) {     // Check if there is a category design
            $productSettings->setCustomDesign($categorySettings->getCustomDesign());    // Set the category design to the product
        }
        return parent::_mergeSettings($categorySettings, $productSettings);     // return parent method for any additional core functionality
    }
}
