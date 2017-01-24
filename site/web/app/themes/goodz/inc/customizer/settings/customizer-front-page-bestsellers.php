<?php
/**
 * Customizer Front Page Slider
 *
 * Here you can define Front Page Slider settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Slider Section
$wp_customize->add_section( 'hp_bestsellers_section', array(
    'title'    => esc_html__( 'Products Section Settings', 'goodz' ),
    'priority' => 3,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Choose product display type
$wp_customize->add_setting( 'front_page_bestsellers_type', array(
    'default'           => 'product-carousel',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_bestsellers_type', array(
    'label'    => esc_html__( 'Choose type of display', 'goodz' ),
    'priority' => 4,
    'section'  => 'hp_bestsellers_section',
    'settings' => 'front_page_bestsellers_type',
    'type'     => 'select',
    'choices'  => array(
        'product-carousel' => esc_html__( 'Carousel slider', 'goodz' ),
        'product-grid'     => esc_html__( 'Product grid', 'goodz' )
    )
) );

// Section Title
$wp_customize->add_setting( 'front_page_bestsellers_title', array(
    'default'           => esc_html__( 'Hotest Items', 'goodz' ),
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_bestsellers_title', array(
    'label'    => esc_html__( 'Title for section', 'goodz' ),
    'section'  => 'hp_bestsellers_section',
    'priority' => 2,
    'settings' => 'front_page_bestsellers_title',
    'type'     => 'text',
) );

// Section Sup Title
$wp_customize->add_setting( 'front_page_bestsellers_subtitle', array(
    'default'           => esc_html__( 'Checkout our', 'goodz' ),
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_bestsellers_subtitle', array(
    'label'    => esc_html__( 'Subtitle for section', 'goodz' ),
    'section'  => 'hp_bestsellers_section',
    'priority' => 3,
    'settings' => 'front_page_bestsellers_subtitle',
    'type'     => 'text',
) );

// Number of products for carousel
$wp_customize->add_setting( 'front_page_bestsellers_number', array(
    'default'           => 5,
    'sanitize_callback' => 'goodz_sanitize_text'
) );

$wp_customize->add_control( 'front_page_bestsellers_number', array(
    'settings'    => 'front_page_bestsellers_number',
    'label'       => esc_html__( 'Number of products to display', 'goodz' ),
    'description' => esc_html__( 'More than 5 activates carousel slider ( if choosen )', 'goodz' ),
    'section'     => 'hp_bestsellers_section',
    'priority'    => 5,
    'type'        => 'number'
) );

// Choose product category
$wp_customize->add_setting( 'front_page_bestsellers_category', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_bestsellers_category', array(
    'label'    => esc_html__( 'Choose product category', 'goodz' ),
    'priority' => 4,
    'section'  => 'hp_bestsellers_section',
    'settings' => 'front_page_bestsellers_category',
    'type'     => 'select',
    'choices'  => goodz_get_front_product_categories_select()
) );

