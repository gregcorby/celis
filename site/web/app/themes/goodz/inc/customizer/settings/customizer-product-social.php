<?php
/**
 * Customizer Product Social Share
 *
 * Here you can define Product Social Share Settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Shop Layout Section
$wp_customize->add_section( 'product_social_section', array(
    'title' => esc_html__( 'Product Social Share', 'goodz' ),
    'panel' => 'wc_page_panel'
) );

/* --- Settings --- */

// Enable Brands Section
$wp_customize->add_setting( 'product_social_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_enable', array(
    'settings' => 'product_social_enable',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable social sharing icons for products', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );

// Facebook
$wp_customize->add_setting( 'product_social_facebook', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_facebook', array(
    'settings' => 'product_social_facebook',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable Facebook sharing', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );

// Twitter
$wp_customize->add_setting( 'product_social_twitter', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_twitter', array(
    'settings' => 'product_social_twitter',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable Twitter sharing', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );

// Tumblr
$wp_customize->add_setting( 'product_social_tumblr', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_tumblr', array(
    'settings' => 'product_social_tumblr',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable Tumblr sharing', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );

// Pinterest
$wp_customize->add_setting( 'product_social_pinterest', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_pinterest', array(
    'settings' => 'product_social_pinterest',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable Pinterest sharing', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );

// Email
$wp_customize->add_setting( 'product_social_email', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'product_social_email', array(
    'settings' => 'product_social_email',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable Email sharing', 'goodz' ),
    'section'  => 'product_social_section',
    'type'     => 'checkbox'
) );
