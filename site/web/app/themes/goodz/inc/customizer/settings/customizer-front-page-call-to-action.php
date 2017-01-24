<?php
/**
 * Customizer Front Page Call To Action Section
 *
 * Here you can define Front Page Call To Action settings
 *
 * @package  Goodz
 */

/* --- Section --- */

// Front Page Brands Section
$wp_customize->add_section( 'hp_cta_section', array(
    'title'    => esc_html__( 'Call To Action Section Settings', 'goodz' ),
    'priority' => 1,
    'panel'    => 'hp_page_panel'
) );

/* --- Settings --- */

// Layout Selection
$wp_customize->add_setting( 'cta_layout_setting', array(
    'default'           => 'two-thirds',
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'cta_layout_setting', array(
    'label'    => esc_html__( 'Choose Call To Action Layout', 'goodz' ),
    'priority' => 1,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'one-third'    => esc_html__( '1/3 + 2/3', 'goodz' ),
        'two-thirds'   => esc_html__( '2/3 + 1/3', 'goodz' ),
        'three-thirds' => esc_html__( '1/3 + 1/3 + 1/3', 'goodz' ),
        'one-half'     => esc_html__( '1/2 + 1/2', 'goodz' ),
        'fullwidth'    => esc_html__( 'Fullwidth', 'goodz' )
    ),
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
            'section'  => 'hp_cta_section',
            'priority' => 1
        )
) );

/**
 * ----------------------------------------
 * FIRST BOX
 * ----------------------------------------
 */

// First Box Image
$wp_customize->add_setting( 'goodz_first_cta_image', array(
    'sanitize_callback' => 'goodz_sanitize_image',
) );

// Add the control for logo
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'goodz_first_cta_image',
            array(
                'priority'    => 2,
                'description' => esc_html__( 'Select Background image for this box', 'goodz' ),
                'label'       => esc_html__( 'First Box: Bg Image', 'goodz' ),
                'section'     => 'hp_cta_section',
                'settings'    => 'goodz_first_cta_image',
            )
    )
);

// First Box Title
$wp_customize->add_setting( 'goodz_first_cta_title', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_first_cta_title', array(
    'label'    => esc_html__( 'First Box: Title', 'goodz' ),
    'section'  => 'hp_cta_section',
    'priority' => 3,
    'settings' => 'goodz_first_cta_title',
    'type'     => 'text',
) );



// First Box Sub Title
$wp_customize->add_setting( 'goodz_first_cta_subtitle', array(
    'default'           => '',
    'sanitize_callback' => 'goodz_sanitize_text'
) );

$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'goodz_first_cta_subtitle', array(
        'section'  => 'hp_cta_section',
        'settings' => 'goodz_first_cta_subtitle',
        'priority' => 4,
        'label'    => esc_html__( 'First Box: Subtitle / Description', 'goodz' ),
    ) )
);

// Title & Subtitle Color
$wp_customize->add_setting( 'goodz_first_cta_title_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_first_cta_title_color',
    array(
        'label'    => esc_html__( 'Title & Subtitle Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 5,
        'settings' => 'goodz_first_cta_title_color',
    ) )
);

// First Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_first_cta_title_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_first_cta_title_pos', array(
    'label'    => esc_html__( 'First Box: Title And Subtitle Position', 'goodz' ),
    'priority' => 5,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// First Box Call to action text
$wp_customize->add_setting( 'goodz_first_cta_text', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_first_cta_text', array(
    'label'    => esc_html__( 'Call To Action Link Text', 'goodz' ),
    'priority' => 6,
    'section'  => 'hp_cta_section',
    'type'     => 'text',
) );

// Text Color
$wp_customize->add_setting( 'goodz_first_cta_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_first_cta_text_color',
    array(
        'label'    => esc_html__( 'Text Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 6,
        'settings' => 'goodz_first_cta_text_color'
    ) )
);

// First Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_first_cta_text_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_first_cta_text_pos', array(
    'label'    => esc_html__( 'First Box: Call To Action Text Position', 'goodz' ),
    'priority' => 7,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// First Box Link
$wp_customize->add_setting( 'goodz_first_cta_link', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_first_cta_link', array(
    'label'       => esc_html__( 'First Box: Call To Action Link', 'goodz' ),
    'description' => esc_html__( 'Enter URL for this box to go to', 'goodz' ),
    'section'     => 'hp_cta_section',
    'priority'    => 8,
    'settings'    => 'goodz_first_cta_link',
    'type'        => 'url',
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
            'section'  => 'hp_cta_section',
            'priority' => 8
        )
) );

/**
 * ----------------------------------------
 * SECOND BOX
 * ----------------------------------------
 */

// Second Box Image
$wp_customize->add_setting( 'goodz_second_cta_image', array(
    'sanitize_callback' => 'goodz_sanitize_image',
) );

// Add the control for logo
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'goodz_second_cta_image',
            array(
                'priority'    => 9,
                'description' => esc_html__( 'Select Background image for this box', 'goodz' ),
                'label'       => esc_html__( 'Second Box: Bg Image', 'goodz' ),
                'section'     => 'hp_cta_section',
                'settings'    => 'goodz_second_cta_image',
            )
    )
);

// Second Box Title
$wp_customize->add_setting( 'goodz_second_cta_title', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_second_cta_title', array(
    'label'    => esc_html__( 'Second Box: Title', 'goodz' ),
    'section'  => 'hp_cta_section',
    'priority' => 10,
    'settings' => 'goodz_second_cta_title',
    'type'     => 'text',
) );

// Second Box Sub Title
$wp_customize->add_setting( 'goodz_second_cta_subtitle', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'goodz_second_cta_subtitle', array(
        'section'  => 'hp_cta_section',
        'settings' => 'goodz_second_cta_subtitle',
        'priority' => 11,
        'label'    => esc_html__( 'Third Box: Subtitle / Description', 'goodz' ),
    ) )
);

// Title & Subtitle Color
$wp_customize->add_setting( 'goodz_second_cta_title_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_second_cta_title_color',
    array(
        'label'    => esc_html__( 'Title & Subtitle Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 11,
        'settings' => 'goodz_second_cta_title_color',
    ) )
);

// Second Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_second_cta_title_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_second_cta_title_pos', array(
    'label'    => esc_html__( 'Second Box: Title And Subtitle Position', 'goodz' ),
    'priority' => 12,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// Second Box Call to action text
$wp_customize->add_setting( 'goodz_second_cta_text', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_second_cta_text', array(
    'label'    => esc_html__( 'Call To Action Link Text', 'goodz' ),
    'priority' => 13,
    'section'  => 'hp_cta_section',
    'type'     => 'text',
) );

// Text Color
$wp_customize->add_setting( 'goodz_second_cta_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_second_cta_text_color',
    array(
        'label'    => esc_html__( 'Text Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 13,
        'settings' => 'goodz_second_cta_text_color',
    ) )
);

// Second Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_second_cta_text_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_second_cta_text_pos', array(
    'label'    => esc_html__( 'Second Box: Call To Action Text Position', 'goodz' ),
    'priority' => 14,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// Second Box Link
$wp_customize->add_setting( 'goodz_second_cta_link', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_second_cta_link', array(
    'label'       => esc_html__( 'Second Box: Call To Action Link', 'goodz' ),
    'description' => esc_html__( 'Enter URL for this box to go to', 'goodz' ),
    'section'     => 'hp_cta_section',
    'priority'    => 15,
    'settings'    => 'goodz_second_cta_link',
    'type'        => 'url',
) );

// Divider
$wp_customize->add_setting( 'goodz_second_cta_divider', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'goodz_second_cta_divider',
        array(
            'section'  => 'hp_cta_section',
            'priority' => 15
        )
) );

/**
 * ----------------------------------------
 * THIRD BOX
 * ----------------------------------------
 */

// Third Box Image
$wp_customize->add_setting( 'goodz_third_cta_image', array(
    'sanitize_callback' => 'goodz_sanitize_image',
) );

// Add the control for logo
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'goodz_third_cta_image',
            array(
                'priority'    => 16,
                'description' => esc_html__( 'Select Background image for this box', 'goodz' ),
                'label'       => esc_html__( 'Third Box: Bg Image', 'goodz' ),
                'section'     => 'hp_cta_section',
                'settings'    => 'goodz_third_cta_image',
            )
    )
);

// Third Box Title
$wp_customize->add_setting( 'goodz_third_cta_title', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_third_cta_title', array(
    'label'    => esc_html__( 'Third Box: Title', 'goodz' ),
    'section'  => 'hp_cta_section',
    'priority' => 17,
    'settings' => 'goodz_third_cta_title',
    'type'     => 'text',
) );

// Third Box Sub Title
$wp_customize->add_setting( 'goodz_third_cta_subtitle', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'goodz_third_cta_subtitle', array(
        'section'  => 'hp_cta_section',
        'settings' => 'goodz_third_cta_subtitle',
        'priority' => 18,
        'label'    => esc_html__( 'Third Box: Subtitle / Description', 'goodz' ),
    ) )
);

// Title & Subtitle Color
$wp_customize->add_setting( 'goodz_third_cta_title_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_third_cta_title_color',
    array(
        'label'    => esc_html__( 'Title & Subtitle Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 18,
        'settings' => 'goodz_third_cta_title_color',
    ) )
);

// Third Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_third_cta_title_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_third_cta_title_pos', array(
    'label'    => esc_html__( 'Third Box: Title And Subtitle Position', 'goodz' ),
    'priority' => 19,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// Third Box Call to action text
$wp_customize->add_setting( 'goodz_third_cta_text', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_third_cta_text', array(
    'label'    => esc_html__( 'Call To Action Link Text', 'goodz' ),
    'priority' => 20,
    'section'  => 'hp_cta_section',
    'type'     => 'text',
) );

// Text Color
$wp_customize->add_setting( 'goodz_third_cta_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'goodz_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'goodz_third_cta_text_color',
    array(
        'label'    => esc_html__( 'Text Color', 'goodz' ),
        'section'  => 'hp_cta_section',
        'priority' => 20,
        'settings' => 'goodz_third_cta_text_color',
    ) )
);

// Third Box Title and Subtitle  position
$wp_customize->add_setting( 'goodz_third_cta_text_pos', array(
    'sanitize_callback' => 'goodz_sanitize_select',
) );

$wp_customize->add_control( 'goodz_third_cta_text_pos', array(
    'label'    => esc_html__( 'Third Box: Call To Action Text Position', 'goodz' ),
    'priority' => 21,
    'section'  => 'hp_cta_section',
    'type'     => 'select',
    'choices'  => array(
        'box-top-left'      => esc_html__( 'Top Left', 'goodz' ),
        'box-top-center'    => esc_html__( 'Top Center', 'goodz' ),
        'box-top-right'     => esc_html__( 'Top Right', 'goodz' ),
        'box-center-left'   => esc_html__( 'Center Left', 'goodz' ),
        'box-center-center' => esc_html__( 'Center Center', 'goodz' ),
        'box-center-right'  => esc_html__( 'Center Right', 'goodz' ),
        'box-bottom-left'   => esc_html__( 'Bottom Left', 'goodz' ),
        'box-bottom-center' => esc_html__( 'Bottom Center', 'goodz' ),
        'box-bottom-right'  => esc_html__( 'Bottom Right', 'goodz' ),
    ),
) );

// Third Box Link
$wp_customize->add_setting( 'goodz_third_cta_link', array(
    'sanitize_callback' => 'goodz_sanitize_text',
) );

$wp_customize->add_control( 'goodz_third_cta_link', array(
    'label'       => esc_html__( 'Third Box: Call To Action Link', 'goodz' ),
    'description' => esc_html__( 'Enter URL for this box to go to', 'goodz' ),
    'section'     => 'hp_cta_section',
    'priority'    => 22,
    'settings'    => 'goodz_third_cta_link',
    'type'        => 'url',
) );
