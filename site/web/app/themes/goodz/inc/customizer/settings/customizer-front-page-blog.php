<?php
/**
 * Customizer Front Page Blog & Instagram Section
 *
 * Here you can define Front Page Blog settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Blog Section
$wp_customize->add_section( 'hp_blog_section', array(
    'title'    => esc_html__( 'Blog & Instagram Section Settings', 'goodz' ),
    'priority' => 4,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Enable Blog Section
$wp_customize->add_setting( 'front_page_blog_enable', array(
    'default'           => 0,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_blog_enable', array(
    'settings' => 'front_page_blog_enable',
    'label'    => esc_html__( 'Check to enable Blog section on front page', 'goodz' ),
    'priority' => 0,
    'section'  => 'hp_blog_section',
    'type'     => 'checkbox',
    'std'      => 1
) );

// Blog Categories
$wp_customize->add_setting( 'front_page_blog_category', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_blog_category', array(
    'label'    => esc_html__( 'Choose blog category to display', 'goodz' ),
    'priority' => 1,
    'section'  => 'hp_blog_section',
    'settings' => 'front_page_blog_category',
    'type'     => 'select',
    'choices'  => goodz_get_categories_select()
) );

// Enable Instagram Section
$wp_customize->add_setting( 'front_page_instagram_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_instagram_enable', array(
    'settings' => 'front_page_instagram_enable',
    'label'    => esc_html__( 'Check to enable Instagram section on front page', 'goodz' ),
    'section'  => 'hp_blog_section',
    'priority' => 2,
    'type'     => 'checkbox',
    'std'      => 1
) );

// Instagram username
$wp_customize->add_setting( 'front_page_instagram_username', array(
    'default'           => '',
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_instagram_username', array(
    'label'    => esc_html__( 'Your Instagram username', 'goodz' ),
    'section'  => 'hp_blog_section',
    'priority' => 3,
    'settings' => 'front_page_instagram_username',
    'type'     => 'text',
) );

// Instagram text
$wp_customize->add_setting( 'front_page_instagram_text', array(
    'default'           => '',
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_instagram_text', array(
    'label'    => esc_html__( 'Your Instagram text', 'goodz' ),
    'section'  => 'hp_blog_section',
    'priority' => 4,
    'settings' => 'front_page_instagram_text',
    'type'     => 'textarea',
) );
