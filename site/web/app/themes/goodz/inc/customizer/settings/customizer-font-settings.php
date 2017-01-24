<?php
/**
 * Customize Google Fonts
 *
 * @package Goodz
 */

/* --- Section --- */

// Front Page Slider Section
$wp_customize->add_section( 'google_fonts_section', array(
	'title'       => esc_html__( 'Font Settings', 'goodz' ),
	'description' => esc_html__( 'Choose fonts for your content', 'goodz' ),
	'priority'    => 200
) );

/* --- Settings --- */
$wp_customize->add_setting( 'headings_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'headings_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Headings Font Family', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 0,
	'choices'  => goodz_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'headings_font_weight', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'headings_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Headings Font Weight', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 1,
	'choices'  => array(
		'default' => 'Default'
	)
) );

// Divider
$wp_customize->add_setting( 'goodz_second_cta_divider0', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'goodz_second_cta_divider0',
        array(
            'section'  => 'google_fonts_section',
            'priority' => 1
        )
) );

// Paragraphs font family
$wp_customize->add_setting( 'paragraphs_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'paragraphs_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Paragraphs Font Family', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 2,
	'choices'  => goodz_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'paragraphs_font_weight', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'paragraphs_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Paragraph and content Font Weight', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 3,
	'choices'  => array(
		'default' => 'Default'
	)
) );

// Divider
$wp_customize->add_setting( 'goodz_second_cta_divider1', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'goodz_second_cta_divider1',
        array(
            'section'  => 'google_fonts_section',
            'priority' => 4
        )
) );

// Menu font family
$wp_customize->add_setting( 'navigation_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'navigation_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Header Navigation Font Family', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 5,
	'choices'  => goodz_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'navigation_font_weight', array(
	'default'           => 'default',
	'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'navigation_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Navigation Font Weight', 'goodz' ),
	'section'  => 'google_fonts_section',
	'priority' => 6,
	'choices'  => array(
		'default' => 'Default'
	)
) );

