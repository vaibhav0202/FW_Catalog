<?php
/**
 * Catalog product related items block
 *
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2015 F+W (http://www.fwcommunity.com)
 * @author      J.P. Daniel <jp.daniel@fwcommunity.com>
 */

class FW_Catalog_Block_Product_List_Additional_Formats extends Mage_Catalog_Block_Product_List_Related
{
    protected function _prepareData()
    {
        $product = Mage::registry('product');
        /* @var $product Mage_Catalog_Model_Product */

        $this->_itemCollection = $product->getRelatedProductCollection()
            ->addAttributeToSelect('required_options')
            ->addAttributeToSelect('format')
            ->setPositionOrder()
            ->addStoreFilter()
        ;

        if (Mage::helper('catalog')->isModuleEnabled('Mage_Checkout')) {
            Mage::getResourceSingleton('checkout/cart')->addExcludeProductFilter($this->_itemCollection,
                Mage::getSingleton('checkout/session')->getQuoteId()
            );
            $this->_addProductAttributesAndPrices($this->_itemCollection);
        }
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($this->_itemCollection);

        $this->_itemCollection->load();

        foreach ($this->_itemCollection as $product) {
            $product->setDoNotUseCategoryId(true);
        }

        return $this;
    }
}
