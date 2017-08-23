<?php
/**
 * @category    FW
 * @package     FW_Catalog
 * @copyright   Copyright (c) 2012 F+W Media, Inc. (http://www.fwmedia.com)
 * @author      J.P. Daniel <jp.daniel@fwmedia.com>
 */

$installer = $this;

$installer->startSetup();

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'featured_image',
    array(
        'type'                       => 'varchar',
        'label'                      => 'Featured Image',
        'input'                      => 'image',
        'backend'                    => 'catalog/category_attribute_backend_image',
        'required'                   => false,
        'sort_order'                 => 1,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'                      => 'Featured Settings',
    )
);

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'featured_heading',
    array(
        'type'                       => 'text',
        'label'                      => 'Featured Heading',
        'input'                      => 'text',
        'required'                   => false,
        'sort_order'                 => 2,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'                      => 'Featured Settings',
    )
);

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'featured_description',
    array(
        'type'                       => 'text',
        'label'                      => 'Featured Description',
        'input'                      => 'textarea',
        'required'                   => false,
        'sort_order'                 => 3,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'wysiwyg_enabled'            => true,
        'is_html_allowed_on_front'   => true,
        'group'                      => 'Featured Settings',
    )
);

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'featured_product',
    array(
        'type'                       => 'text',
        'label'                      => 'Featured Product',
        'input'                      => 'text',
        'required'                   => false,
        'sort_order'                 => 4,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'                      => 'Featured Settings',
    )
);

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'is_featured',
    array(
        'type'                       => 'int',
        'label'                      => 'Is A Featured Sub Category',
        'input'                      => 'select',
        'required'                   => false,
        'source'                     => 'eav/entity_attribute_source_boolean',
        'sort_order'                 => 5,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'                      => 'Featured Settings',
    )
);

$installer->addAttribute(
    $installer->getEntityTypeId('catalog_category'),
    'show_featured',
    array(
        'type'                       => 'int',
        'label'                      => 'Show Featured Sub Categories',
        'input'                      => 'select',
        'required'                   => false,
        'source'                     => 'eav/entity_attribute_source_boolean',
        'sort_order'                 => 6,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'group'                      => 'Featured Settings',
    )
);

$installer->endSetup();