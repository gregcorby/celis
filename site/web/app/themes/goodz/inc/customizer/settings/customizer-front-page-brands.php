<?php
/**
 * Customizer Front Page Brands Section
 *
 * Here you can define Front Page Brands settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Brands Section
$wp_customize->add_section( 'hp_brands_section', array(
    'title'       => esc_html__( 'Brands Section Settings', 'goodz' ),
    'priority'    => 5,
    'panel'       => 'hp_page_panel'
) );

/* --- Settings --- */

// Brand Categories
$wp_customize->add_setting( 'front_page_brands_category', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_brands_category', array(
    'label'       => esc_html__( 'Choose brands category to display', 'goodz' ),
    'section'     => 'hp_brands_section',
    'settings'    => 'front_page_brands_category',
    'type'        => 'select',
    'choices'     => goodz_get_brand_categories_select()
) );

