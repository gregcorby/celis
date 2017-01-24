<?php
/**
 * Goodz Shop Theme Customizer.
 *
 * @package Goodz
 */

/**
 * Load Customizer Specific functions
 */
get_template_part( 'inc/customizer/functions/customizer', 'functions' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function goodz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Custom Customizer Controls
    require_once trailingslashit( get_template_directory() ) . 'inc/customizer/functions/customizer-multiple-checkbox.php';
    require_once trailingslashit( get_template_directory() ) . 'inc/customizer/functions/customizer-sections-sorting.php';
    require_once trailingslashit( get_template_directory() ) . 'inc/customizer/functions/customizer-text-editor.php';

    // Remove default Colors section
    $wp_customize->remove_section( 'colors' );

    /*----------------------------------- PANELS ----------------------------------*/

    // Shop Settings Panel
    $wp_customize->add_panel( 'goodz_colors_panel', array(
        'title'       => esc_html__( 'Color Settings', 'goodz' ),
        'description' => esc_html__( 'For customizing theme colors', 'goodz' ),
        'priority'    => 190
    ) );

    // Shop Settings Panel
    $wp_customize->add_panel( 'wc_page_panel', array(
        'title'       => esc_html__( 'Shop Settings', 'goodz' ),
        'description' => esc_html__( 'For customizing Shop', 'goodz' ),
        'priority'    => 201
    ) );

    // Blog Settings Panel
    $wp_customize->add_panel( 'blog_page_panel', array(
        'title'       => esc_html__( 'Blog Settings', 'goodz' ),
        'description' => esc_html__( 'For customizing Blog', 'goodz' ),
        'priority'    => 202
    ) );

    // Front Page Settings Panel
    $wp_customize->add_panel( 'hp_page_panel', array(
        'title'       => esc_html__( 'Front Page Settings', 'goodz' ),
        'description' => esc_html__( 'For customizing Front Page Template', 'goodz' ),
        'priority'    => 203
    ) );

    /*----------------------------------- SETTINGS ----------------------------------*/

    // Colors
    require get_template_directory() . '/inc/customizer/settings/customizer-colors.php';

    // Logo Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-logo.php';

    // Home Page Slider
    require get_template_directory() . '/inc/customizer/settings/customizer-slider.php';

    // Front Page Slider
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-slider.php';

    // Front Page Call To Action
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-call-to-action.php';

    // Front Page Product Categories
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-new.php';

    // Front Page Page Content
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-page.php';

    // Front Page Brands Section
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-brands.php';

    // Front Page Bestsellers Section
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-bestsellers.php';

    // Front Page Blog Section
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-blog.php';

    // Front Page Sections Order
    require get_template_directory() . '/inc/customizer/settings/customizer-front-page-sections.php';

    // Layout Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-layout.php';

    // WooCommerce Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-woocommerce.php';

    // WooCommerce Product Social Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-product-social.php';

    // Footer Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-footer.php';

    // Font Settings
    require get_template_directory() . '/inc/customizer/settings/customizer-font-settings.php';

    // Custom CSS
    require get_template_directory() . '/inc/customizer/settings/customizer-custom-css.php';

}
add_action( 'customize_register', 'goodz_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function goodz_customize_preview_js() {
	wp_enqueue_script( 'goodz-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'goodz_customize_preview_js' );

/**
 * Load Customizer Sanitization functions
 */
require get_template_directory() . '/inc/customizer/functions/customizer-sanitize.php';
