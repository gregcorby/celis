<?php
/**
 * Customizer Slider
 *
 * Here you can define slider settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Featured Slider Section
$wp_customize->add_section( 'featured_slider_settings', array(
    'title'    => esc_html__( 'Blog Featured Slider', 'goodz' ),
    'priority' => 123,
    'panel'    => 'blog_page_panel'
) );

/* --- Settings --- */

// Enable Featured Slider
$wp_customize->add_setting( 'featured_slider_enable', array(
    'default'           => 0,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'featured_slider_enable', array(
    'settings'    => 'featured_slider_enable',
    'label'       => esc_html__( 'Check to enable Featured Slider', 'goodz' ),
    'section'     => 'featured_slider_settings',
    'type'        => 'checkbox',
    'std'         => 0
) );

// Select Featured Slider Category
$wp_customize->add_setting( 'featured_category_select', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'featured_category_select', array(
    'settings'    => 'featured_category_select',
    'description' => esc_html__( 'Select featured slider posts category', 'goodz' ),
    'label'       => esc_html__( 'Select Category', 'goodz' ),
    'section'     => 'featured_slider_settings',
    'type'        => 'select',
    'choices'     => goodz_get_categories_select()
) );

// Exclude Category from archive
$wp_customize->add_setting( 'featured_slider_cat_exclude', array(
    'default'           => 0,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'featured_slider_cat_exclude', array(
    'settings'    => 'featured_slider_cat_exclude',
    'label'       => esc_html__( 'Exclude posts from this category to display in post listings', 'goodz' ),
    'section'     => 'featured_slider_settings',
    'type'        => 'checkbox'
) );

// Featured slider width
$wp_customize->add_setting( 'featured_slider_width', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'featured_slider_width', array(
    'settings'    => 'featured_slider_width',
    'description' => esc_html__( 'Display fullwidth slider display', 'goodz' ),
    'label'       => esc_html__( 'Enable fullwidth', 'goodz' ),
    'section'     => 'featured_slider_settings',
    'type'        => 'checkbox'
) );

// Select Number of posts to display in slider
$wp_customize->add_setting( 'featured_posts_number', array(
    'default'           => 6,
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'featured_posts_number', array(
    'settings'    => 'featured_posts_number',
    'description' => esc_html__( 'Select number of posts to display in slider', 'goodz' ),
    'label'       => esc_html__( 'Select Posts Number', 'goodz' ),
    'section'     => 'featured_slider_settings',
    'type'        => 'select',
    'choices'     => goodz_number_of_slides()
) );

