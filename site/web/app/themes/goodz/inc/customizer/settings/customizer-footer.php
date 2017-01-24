<?php
/**
 * Customizer Footer
 *
 * Here you can define layout settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Layout Section
$wp_customize->add_section( 'footer_section', array(
    'title'    => esc_html__( 'Footer Settings', 'goodz' ),
    'priority' => 203
) );

/* --- Settings --- */

// Footer Copyright text
$wp_customize->add_setting( 'goodz_footer_copyright', array(
	'default'           => '',
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_footer_copyright', array(
    'label'       => esc_html__( 'Footer Copyright Text', 'goodz' ),
    'section'     => 'footer_section',
    'priority'    => 0,
    'settings'    => 'goodz_footer_copyright',
    'type'        => 'textarea'
) );

