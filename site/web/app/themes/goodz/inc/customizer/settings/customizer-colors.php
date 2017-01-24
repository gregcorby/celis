<?php
/**
 * Customizer Colors
 *
 * Here you can define Customizer Color settings
 *
 * @package Goodz
 */

/*---- Section ----*/
$wp_customize->add_section( 'goodz_colors_section', array(
    'title'    => esc_html__( 'General Theme Colors', 'goodz' ),
    'priority' => 0,
    'panel'    => 'goodz_colors_panel'
) );

$wp_customize->add_section( 'goodz_header_colors_section', array(
    'title'    => esc_html__( 'Header Colors', 'goodz' ),
    'priority' => 1,
    'panel'    => 'goodz_colors_panel'
) );

$wp_customize->add_section( 'goodz_hp_colors_section', array(
    'title'    => esc_html__( 'Front Page Header Colors', 'goodz' ),
    'priority' => 2,
    'panel'    => 'goodz_colors_panel'
) );

$wp_customize->add_section( 'goodz_footer_colors_section', array(
    'title'    => esc_html__( 'Footer Colors', 'goodz' ),
    'priority' => 3,
    'panel'    => 'goodz_colors_panel'
) );

/*---- Settings ----*/

// Transparency
$wp_customize->add_setting( 'blog_header_transparency_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'blog_header_transparency_enable', array(
    'settings' => 'blog_header_transparency_enable',
    'priority' => 0,
    'label'    => esc_html__( 'Check to enable header transparency', 'goodz' ),
    'section'  => 'goodz_header_colors_section',
    'type'     => 'checkbox'
) );

// Headings color
$wp_customize->add_setting( 'goodz_heading_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_heading_color',
    array(
        'label'    => esc_html__( 'Headings Color', 'goodz' ),
        'section'  => 'goodz_colors_section',
        'priority' => 1,
        'settings' => 'goodz_heading_color',
    ) )
);

// Header BG color
$wp_customize->add_setting( 'goodz_bg_header_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_bg_header_color',
    array(
        'label'    => esc_html__( 'Header Bg Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 2,
        'settings' => 'goodz_bg_header_color',
    ) )
);

// Transparent Header Navigation color
$wp_customize->add_setting( 'goodz_tr_navigation_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_tr_navigation_color',
    array(
        'label'    => esc_html__( 'Transparent Header - Navigation Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 3,
        'settings' => 'goodz_tr_navigation_color',
    ) )
);

// Navigation color
$wp_customize->add_setting( 'goodz_navigation_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_navigation_color',
    array(
        'label'    => esc_html__( 'Navigation Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 3,
        'settings' => 'goodz_navigation_color',
    ) )
);

// Navigation hover color
$wp_customize->add_setting( 'goodz_navigation_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_navigation_hover_color',
    array(
        'label'    => esc_html__( 'Navigation Hover Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 4,
        'settings' => 'goodz_navigation_hover_color',
    ) )
);

// Paragraph color
$wp_customize->add_setting( 'goodz_paragraph_color', array(
    'default'           => '#838383',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_paragraph_color',
    array(
        'label'    => esc_html__( 'Paragraph / Text Color', 'goodz' ),
        'section'  => 'goodz_colors_section',
        'priority' => 10,
        'settings' => 'goodz_paragraph_color',
    ) )
);

// Link color
$wp_customize->add_setting( 'goodz_link_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_link_color',
    array(
        'label'    => esc_html__( 'Link Color', 'goodz' ),
        'section'  => 'goodz_colors_section',
        'priority' => 11,
        'settings' => 'goodz_link_color',
    ) )
);

// Link Hover color
$wp_customize->add_setting( 'goodz_link_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_link_hover_color',
    array(
        'label'    => esc_html__( 'Link Hover Color', 'goodz' ),
        'section'  => 'goodz_colors_section',
        'priority' => 12,
        'settings' => 'goodz_link_hover_color',
    ) )
);

// Logo color
$wp_customize->add_setting( 'goodz_logo_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_logo_color',
    array(
        'label'    => esc_html__( 'Logo Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 13,
        'settings' => 'goodz_logo_color',
    ) )
);

// Logo hover color
$wp_customize->add_setting( 'goodz_logo_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_logo_hover_color',
    array(
        'label'    => esc_html__( 'Logo Hover Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 14,
        'settings' => 'goodz_logo_hover_color',
    ) )
);

// Logo description color
$wp_customize->add_setting( 'goodz_logo_description_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_logo_description_color',
    array(
        'label'    => esc_html__( 'Logo Description Color', 'goodz' ),
        'section'  => 'goodz_header_colors_section',
        'priority' => 14,
        'settings' => 'goodz_logo_description_color',
    ) )
);

// Footer color
$wp_customize->add_setting( 'goodz_footer_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_footer_color',
    array(
        'label'    => esc_html__( 'Footer Bg Color', 'goodz' ),
        'section'  => 'goodz_footer_colors_section',
        'priority' => 15,
        'settings' => 'goodz_footer_color',
    ) )
);

// Footer Text color
$wp_customize->add_setting( 'goodz_footer_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_footer_text_color',
    array(
        'label'    => esc_html__( 'Footer Text Color', 'goodz' ),
        'section'  => 'goodz_footer_colors_section',
        'priority' => 16,
        'settings' => 'goodz_footer_text_color',
    ) )
);

// Footer links color
$wp_customize->add_setting( 'goodz_footer_links_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_footer_links_color',
    array(
        'label'    => esc_html__( 'Footer Links Color', 'goodz' ),
        'section'  => 'goodz_footer_colors_section',
        'priority' => 17,
        'settings' => 'goodz_footer_links_color',
    ) )
);

// Footer links hover color
$wp_customize->add_setting( 'goodz_footer_links_hover_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_footer_links_hover_color',
    array(
        'label'    => esc_html__( 'Footer Links Hover Color', 'goodz' ),
        'section'  => 'goodz_footer_colors_section',
        'priority' => 18,
        'settings' => 'goodz_footer_links_hover_color',
    ) )
);

/**
 * FRONT PAGE HEADER COLORS
 */

// Transparency
$wp_customize->add_setting( 'hp_header_transparency_enable', array(
    'default'           => 1,
    'sanitize_callback' => 'goodz_sanitize_select'
) );

$wp_customize->add_control( 'hp_header_transparency_enable', array(
    'settings' => 'hp_header_transparency_enable',
    'label'    => esc_html__( 'Check to enable Front Page header transparency', 'goodz' ),
    'priority' => 19,
    'section'  => 'goodz_hp_colors_section',
    'type'     => 'checkbox'
) );

// Header BG color
$wp_customize->add_setting( 'goodz_hp_bg_header_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_bg_header_color',
    array(
        'label'    => esc_html__( 'Front Page Header Bg Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 20,
        'settings' => 'goodz_hp_bg_header_color',
    ) )
);

// Transparent Header Navigation color
$wp_customize->add_setting( 'goodz_hp_tr_navigation_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_tr_navigation_color',
    array(
        'label'    => esc_html__( 'Front Page Transparent Header - Navigation Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 20,
        'settings' => 'goodz_hp_tr_navigation_color',
    ) )
);

// Navigation color
$wp_customize->add_setting( 'goodz_hp_navigation_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_navigation_color',
    array(
        'label'    => esc_html__( 'Front Page Navigation Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 21,
        'settings' => 'goodz_hp_navigation_color',
    ) )
);

// Navigation hover color
$wp_customize->add_setting( 'goodz_hp_navigation_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_navigation_hover_color',
    array(
        'label'    => esc_html__( 'Front Page Navigation Hover Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 22,
        'settings' => 'goodz_hp_navigation_hover_color',
    ) )
);

// Logo color
$wp_customize->add_setting( 'goodz_hp_logo_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_logo_color',
    array(
        'label'    => esc_html__( 'Front Page Logo Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 28,
        'settings' => 'goodz_hp_logo_color',
    ) )
);

// Logo hover color
$wp_customize->add_setting( 'goodz_hp_logo_hover_color', array(
    'default'           => '#808080',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,

    'goodz_hp_logo_hover_color',
    array(
        'label'    => esc_html__( 'Front Page Logo Hover Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 28,
        'settings' => 'goodz_hp_logo_hover_color',
    ) )
);

// Logo description color
$wp_customize->add_setting( 'goodz_hp_logo_description_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_hp_logo_description_color',
    array(
        'label'    => esc_html__( 'Front Page Logo Description Color', 'goodz' ),
        'section'  => 'goodz_hp_colors_section',
        'priority' => 29,
        'settings' => 'goodz_hp_logo_description_color',
    ) )
);

