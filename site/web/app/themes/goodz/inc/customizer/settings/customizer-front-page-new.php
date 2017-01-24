<?php
/**
 * Customizer Front Page "Product Categories" Section
 *
 * Here you can define Front Page "Product Categories" settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Slider Section
$wp_customize->add_section( 'hp_new_section', array(
    'title'    => esc_html__( 'Product Categories Section Settings', 'goodz' ),
    'priority' => 2,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Product Categories Categories
$wp_customize->add_setting( 'product_categories_cat_setting', array(
    'sanitize_callback' => 'goodz_sanitize_multiple_checkbox'
) );

$wp_customize->add_control(
    new JT_Customize_Control_Checkbox_Multiple(
        $wp_customize,
        'product_categories_cat_setting',
        array(
            'section'  => 'hp_new_section',
            'priority' => 0,
            'label'    => esc_html__( 'Choose categories to display in this section', 'goodz' ),
            'choices'  => goodz_get_product_categories_select()
        )
    )
);

// Section Title
$wp_customize->add_setting( 'front_page_new_section_title', array(
    'default'           => esc_html__( 'Product Categories', 'goodz' ),
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_new_section_title', array(
    'label'    => esc_html__( 'Title for "Product Categories" section', 'goodz' ),
    'section'  => 'hp_new_section',
    'priority' => 1,
    'settings' => 'front_page_new_section_title',
    'type'     => 'text',
) );

// Title Color
$wp_customize->add_setting( 'goodz_front_new_title_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_front_new_title_color',
    array(
        'label'    => esc_html__( 'Title color', 'goodz' ),
        'section'  => 'hp_new_section',
        'priority' => 2,
        'settings' => 'goodz_front_new_title_color',
    ) )
);

// Section Description text
$wp_customize->add_setting( 'front_page_new_section_text', array(
    'default'           => esc_html__( 'Fresh goodz in our store', 'goodz' ),
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'front_page_new_section_text', array(
    'label'    => esc_html__( 'Text for this ection that goes under section title', 'goodz' ),
    'priority' => 3,
    'section'  => 'hp_new_section',
    'type'     => 'textarea',
) );

// Title Color
$wp_customize->add_setting( 'goodz_front_new_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_front_new_text_color',
    array(
        'label'    => esc_html__( 'Text color', 'goodz' ),
        'section'  => 'hp_new_section',
        'priority' => 2,
        'settings' => 'goodz_front_new_text_color',
    ) )
);

// Background color
$wp_customize->add_setting( 'goodz_front_new_color', array(
    'default'           => '#D8D8D8',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_front_new_color',
    array(
        'label'    => esc_html__( 'Section background color', 'goodz' ),
        'section'  => 'hp_new_section',
        'priority' => 4,
        'settings' => 'goodz_front_new_color',
    ) )
);

// Category columns
$wp_customize->add_setting( 'front_page_product_categories_columns', array(
    'default'           => 0,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'front_page_product_categories_columns', array(
    'settings' => 'front_page_product_categories_columns',
    'label'    => esc_html__( 'Enable two column category display ( default is three )', 'goodz' ),
    'section'  => 'hp_new_section',
    'priority' => 5,
    'type'     => 'checkbox'
) );

