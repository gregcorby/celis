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
$wp_customize->add_section( 'hp_slider_section', array(
    'title'    => esc_html__( 'Front Page Slider Settings', 'goodz' ),
    'priority' => 0,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Enable Slider
$wp_customize->add_setting( 'front_page_slider_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_slider_enable', array(
    'settings' => 'front_page_slider_enable',
    'label'    => esc_html__( 'Check to enable Slider on front page', 'goodz' ),
    'section'  => 'hp_slider_section',
    'type'     => 'checkbox',
    'std'      => 1
) );

// Number of slides
$wp_customize->add_setting( 'front_page_slider_slides', array(
    'default'           => 5,
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_slider_slides', array(
    'label'    => esc_html__( 'Number of slides to display', 'goodz' ),
    'section'  => 'hp_slider_section',
    'settings' => 'front_page_slider_slides',
    'type'     => 'number',
) );

// Slides Categories
$wp_customize->add_setting( 'front_page_slider_category', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_slider_category', array(
    'label'    => esc_html__( 'Choose slides category to display', 'goodz' ),
    'section'  => 'hp_slider_section',
    'settings' => 'front_page_slider_category',
    'type'     => 'select',
    'choices'  => goodz_get_slider_categories_select()
) );

