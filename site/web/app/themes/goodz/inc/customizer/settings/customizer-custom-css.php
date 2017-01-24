<?php
/**
 * Customizer Custom CSS
 *
 * Here you can define your own CSS rules
 *
 * @package  Goodz
 */

/* --- Section --- */

// Custom CSS section
$wp_customize->add_section( 'goodz_custom_css', array(
    'title'    => esc_html__( 'Custom CSS', 'goodz' ),
    'priority' => 210
) );

/* --- Settings --- */

// Custom CSS
$wp_customize->add_setting( 'goodz_custom_css', array(
    'default'           => '',
    'sanitize_callback' => 'goodz_sanitize_text'
) );

$wp_customize->add_control( 'goodz_custom_css', array(
    'type'          => 'textarea',
    'priority'      => 0,
    'section'       => 'goodz_custom_css',
    'label'         => esc_html__( 'Custom CSS', 'goodz' )
) );