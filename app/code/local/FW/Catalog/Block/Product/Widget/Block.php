<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2012 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */
class FW_Catalog_Block_Product_Widget_Block
    extends Mage_Catalog_Block_Product_Abstract
    implements Mage_Widget_Block_Interface
{
    /**
     * 
     */
    protected function _toHtml()
    {
        $_pid = explode('/', $this->getId());
        $_pid = $_pid[1];
        $_product = Mage::getModel('catalog/product')->load($_pid);
        return '
            <a class="left" href="'.$_product->getProductUrl().'">
                <img src="'.Mage::helper('catalog/image')->init($_product, 'thumbnail')->resize(120,120).'" />
            </a>
            <div style="margin-left:144px;">
                <h3 class="product-name">
                    <a href="'.$_product->getProductUrl().'">'.$_product->getName().'</a>
                </h3>
                <p>'.$_product->getShortDescription().'</p>'
                .$this->getPriceHtml($_product).'
            </div>'
        ;
    }
}