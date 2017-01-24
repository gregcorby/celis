<?php
/**
 * Customizer WooCommerce
 *
 * Here you can define WooCommerce Settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Shop Layout Section
$wp_customize->add_section( 'shop_layout_section', array(
    'title' => esc_html__( 'Shop Layout', 'goodz' ),
    'panel' => 'wc_page_panel'
) );

/* --- Settings --- */

// Global layout
$wp_customize->add_setting( 'shop_layout_setting', array(
    'default'           => 'boxed',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'shop_layout_setting', array(
    'label'    => esc_html__( 'Choose Shop Layout', 'goodz' ),
    'priority' => 0,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'boxed'     => esc_html__( 'Boxed', 'goodz' ),
        'fullwidth' => esc_html__( 'Full width', 'goodz' )
    ),
) );

// Single product layout
$wp_customize->add_setting( 'single_product_layout_setting', array(
    'default'           => 'boxed',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'single_product_layout_setting', array(
    'label'    => esc_html__( 'Choose Single Product Layout', 'goodz' ),
    'priority' => 0,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'boxed'     => esc_html__( 'Boxed', 'goodz' ),
        'fullwidth' => esc_html__( 'Full width', 'goodz' )
    ),
) );

// Layout type
$wp_customize->add_setting( 'layout_type_setting', array(
    'default'           => 'regular',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'layout_type_setting', array(
    'label'    => esc_html__( 'Choose Layout Type', 'goodz' ),
    'priority' => 1,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'regular' => esc_html__( 'Regular grid', 'goodz' ),
        'masonry' => esc_html__( 'Masonry grid', 'goodz' )
    ),
) );

// Shop sidebar
$wp_customize->add_setting( 'shop_sidebar_setting', array(
    'default'           => 'sidebar-right',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'shop_sidebar_setting', array(
    'label'    => esc_html__( 'Choose Shop Sidebar', 'goodz' ),
    'priority' => 2,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'sidebar-none'  => esc_html__( 'No Sidebar', 'goodz' ),
        'sidebar-left'  => esc_html__( 'Left Sidebar', 'goodz' ),
        'sidebar-right' => esc_html__( 'Right Sidebar', 'goodz' )
    ),
) );

// Number of product columns
$wp_customize->add_setting( 'product_columns_setting', array(
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'product_columns_setting', array(
    'label'    => esc_html__( 'Number Of Product Columns', 'goodz' ),
    'priority' => 3,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'col-sm-6'    => '2',
        'col-sm-4'    => '3',
        'col-sm-3'    => '4',
        'col-sm-tk-5' => '5',
        'col-sm-2'    => '6'
    ),
) );

// Number of product columns
$wp_customize->add_setting( 'product_display_setting', array(
    'default'           => 'standard-view',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'product_display_setting', array(
    'label'    => esc_html__( 'Product display type', 'goodz' ),
    'priority' => 4,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'standard-view' => esc_html__( 'Standard view', 'goodz' ),
        'gallery-view'  => esc_html__( 'Gallery view', 'goodz' )
    ),
) );

// Enable Quick View for standard
$wp_customize->add_setting( 'product_display_qv', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_display_qv', array(
    'settings'    => 'product_display_qv',
    'priority'    => 5,
    'label'       => esc_html__( 'Enable "Quick view" for standard view product display type', 'goodz' ),
    'section'     => 'shop_layout_section',
    'type'        => 'checkbox'
) );

// Number of WooCommerce products per page
$wp_customize->add_setting( 'shop_products_number', array(
    'default'           => 12,
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'shop_products_number', array(
    'label'    => esc_html__( 'Enter number of products to display on shop page', 'goodz' ),
    'priority' => 6,
    'section'  => 'shop_layout_section',
    'type'     => 'number'
) );

// Shop Paging Settings
$wp_customize->add_setting( 'shop_paging_setting', array(
    'default'           => 'standard_paging',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'shop_paging_setting', array(
    'label'    => esc_html__( 'Choose Shop Paging Type', 'goodz' ),
    'priority' => 7,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'infinite_scroll' => esc_html__( 'Infinite Product Load', 'goodz' ),
        'standard_paging' => esc_html__( 'Standard Paging', 'goodz' )
    ),
) );

// Shop Infinite Scroll Settings
$wp_customize->add_setting( 'shop_infinite_scroll_type', array(
    'default'           => 'click',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'shop_infinite_scroll_type', array(
    'label'    => esc_html__( 'Choose product infinite load type', 'goodz' ),
    'priority' => 8,
    'section'  => 'shop_layout_section',
    'type'     => 'select',
    'choices'  => array(
        'scroll' => esc_html__( 'On scroll', 'goodz' ),
        'click'  => esc_html__( 'On click', 'goodz' )
    ),
) );


