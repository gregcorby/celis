<?php
/**
 * Customizer Layout
 *
 * Here you can define layout settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Layout Section
$wp_customize->add_section( 'layout_section', array(
    'title'    => esc_html__( 'Layout Settings', 'goodz' ),
    'priority' => 121,
    'panel'    => 'blog_page_panel'
) );

/* --- Settings --- */

// Global layout
$wp_customize->add_setting( 'archive_layout_setting', array(
    'default'           => 'boxed',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'archive_layout_setting', array(
    'label'    => esc_html__( 'Choose Archive Pages Layout', 'goodz' ),
    'priority' => 0,
    'section'  => 'layout_section',
    'type'     => 'select',
    'choices'  => array(
        'boxed'     => esc_html__( 'Boxed', 'goodz' ),
        'fullwidth' => esc_html__( 'Full width', 'goodz' )
    ),
) );

// Two Columns Layout
$wp_customize->add_setting( 'two_columns_layout_setting', array(
    'default'           => 0,
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'two_columns_layout_setting', array(
    'settings'    => 'two_columns_layout_setting',
    'description' => esc_html__( 'Choose two columns layout instead of default for archives', 'goodz' ),
    'label'       => esc_html__( 'Display Posts in Two Columns layout', 'goodz' ),
    'priority'    => 0,
    'section'     => 'layout_section',
    'type'        => 'checkbox'
) );

// Single Layout
$wp_customize->add_setting( 'single_layout_setting', array(
    'default'           => 'boxed',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'single_layout_setting', array(
    'label'    => esc_html__( 'Choose Single Page / Post', 'goodz' ),
    'priority' => 0,
    'section'  => 'layout_section',
    'type'     => 'select',
    'choices'  => array(
        'boxed'     => esc_html__( 'Boxed', 'goodz' ),
        'fullwidth' => esc_html__( 'Full width', 'goodz' )
    ),
) );

// Paging Settings
$wp_customize->add_setting( 'paging_setting', array(
    'default'           => 'infinite_scroll',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'paging_setting', array(
    'label'    => esc_html__( 'Choose Archive Paging Type', 'goodz' ),
    'priority' => 0,
    'section'  => 'layout_section',
    'type'     => 'select',
    'choices'  => array(
        'infinite_scroll' => esc_html__( 'Infinite Post Load', 'goodz' ),
        'standard_paging' => esc_html__( 'Standard Paging', 'goodz' )
    ),
) );

// Infinite Scroll Settings
$wp_customize->add_setting( 'infinite_scroll_type', array(
    'default'           => 'click',
    'sanitize_callback' => 'goodz_sanitize_select',
));

$wp_customize->add_control( 'infinite_scroll_type', array(
    'label'    => esc_html__( 'Choose infinite load type', 'goodz' ),
    'priority' => 0,
    'section'  => 'layout_section',
    'type'     => 'select',
    'choices'  => array(
        'scroll' => esc_html__( 'On scroll', 'goodz' ),
        'click'  => esc_html__( 'On click', 'goodz' )
    ),
) );

