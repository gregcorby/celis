<?php
/**
 * Customizer Front Page Page Content Section
 *
 * Here you can define Front Page Brands settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Brands Section
$wp_customize->add_section( 'hp_page_section', array(
    'title'    => esc_html__( 'Page Content Section Settings', 'goodz' ),
    'priority' => 5,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Brand Categories
$wp_customize->add_setting( 'front_page_page_content', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_page_content', array(
    'label'    => esc_html__( 'Choose page to display in this section', 'goodz' ),
    'section'  => 'hp_page_section',
    'settings' => 'front_page_page_content',
    'type'     => 'select',
    'choices'  => goodz_get_page_select()
) );

