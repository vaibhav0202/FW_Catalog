<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2012 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Block_Product_Widget_List
    extends Mage_Catalog_Block_Product_List
    implements Mage_Widget_Block_Interface
{
    
    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('catalog/product/list.phtml');
        
        $catWidgetData = explode('/', $this->getCatalogId());
        $cid = (int)$catWidgetData[1];
        $this->setCategoryId($cid);
        
        $this->setColumnCount(5);
        
        $this->addData(array(
            'cache_lifetime'    => 86400,
            'cache_tags'        => array('fw_catalog_block_widget_list'),
            'cache_key'         => $cid
        ));
    }

    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $collection = parent::_getProductCollection();
            $collection->getSelect()->orderRand();
            $collection->setPage(1, 5)->load();
            $this->_productCollection = $collection;
            //var_dump($collection->getSelect());
        }
        /*
        if (is_null($this->_productCollection)) {
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $collection = $category->getProductCollection();
                    $collection->getSelect()->order('rand()');
                    $collection->setPage(1, 5);
                }
            }
            $this->_productCollection = $collection;
            /*
            $collection = Mage::getResourceModel('catalog/product_collection');
            Mage::getModel('catalog/layer')->prepareProductCollection($collection);
            $collection->getSelect()->order('rand()');
            $collection->addStoreFilter();
            $numProducts = $this->getNumProducts() ? $this->getNumProducts() : 0;
            $collection->setPage(1, $numProducts);

            $this->_productCollection = $collection;
        }
         * 
         */
        return $this->_productCollection;
    }
}