<?php
/**
 * Customizer Front Page Sections
 *
 * Here you can define Front Page Sections settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Slider Section
$wp_customize->add_section( 'hp_sections_section', array(
    'title'    => esc_html__( 'Front Page Sections Order', 'goodz' ),
    'priority' => 5,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

$wp_customize->add_setting( 'front_page_sections_order', array(
    'default'           => 'default',
    'sanitize_callback' => 'goodz_sanitize_select',
    'transport'         => 'refresh'
) );

$wp_customize->add_control(
    new Customize_Sections_Sorting(
        $wp_customize,
        'front_page_sections_order',
        array(
            'section'     => 'hp_sections_section',
            'label'       => esc_html__( 'Front Page Sections Management', 'goodz' ),
            'description' => esc_html__( 'Reorder sections appearance on Front Page Template using drag and drop and enable / disable sections using checkboxes', 'goodz' ),
            'choices'     => array(
                'call-to-action'     => esc_html__( 'Call to action section', 'goodz' ),
                'product-categories' => esc_html__( 'Product categories section', 'goodz' ),
                'products-section'   => esc_html__( 'Products section', 'goodz' ),
                'page-content'       => esc_html__( 'Page content', 'goodz' ),
                'blog-instagram'     => esc_html__( 'Blog & Instagram section', 'goodz' ),
                'brands-section'     => esc_html__( 'Brands section', 'goodz' )
            )
        )
    )
);

