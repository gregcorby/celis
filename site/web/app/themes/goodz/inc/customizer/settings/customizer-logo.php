<?php
/**
 * Customizer Logo Settings
 *
 * Here you can define Logo Settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// LOGO SETTINGS Section
$wp_customize->add_section( 'logo_section', array(
    'title'    => esc_html__( 'Logo Settings', 'goodz' ),
    'priority' => 120,
) );

/* --- Settings --- */

// Register the setting for logo
$wp_customize->add_setting( 'goodz_logo_setting', array(
    'sanitize_callback' => 'goodz_sanitize_image',
) );

// Add the control for logo
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'goodz_logo',
            array(
                'label'    => esc_html__( 'Upload Logo', 'goodz' ),
                'section'  => 'logo_section',
                'settings' => 'goodz_logo_setting',
            )
    )
);

// Register the setting for Retina logo
$wp_customize->add_setting( 'goodz_retina_logo_setting', array(
    'sanitize_callback' => 'goodz_sanitize_image',
) );

// Add the control for Retina logo
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'goodz_retina_logo',
            array(
                'label'       => esc_html__( 'Upload Retina Logo', 'goodz' ),
                'section'     => 'logo_section',
                'description' => esc_html__( 'Upload double size image for retina displays. JPEG, GIF or PNG image, recommended up to 500KB', 'goodz' ),
                'settings'    => 'goodz_retina_logo_setting'
            )
    )
);

