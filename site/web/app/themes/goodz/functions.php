<?php
/**
 * Goodz functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Goodz
 */

if ( ! function_exists( 'goodz_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function goodz_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on goodz-shop, use a find and replace
	 * to change 'goodz' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'goodz', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Add thumbnail image sizes
	 */
	add_image_size( 'goodz-archive-featured-image', 692, 463, true );
	add_image_size( 'goodz-video-featured-image', 348, 233, true );
	add_image_size( 'goodz-sticky-featured-image', 1084, 725, true );
	add_image_size( 'goodz-single-featured-image', 1620, 999999, false );
	add_image_size( 'goodz-shop-logo', 340, 999999, false );
	add_image_size( 'goodz-brand-logos', 999999, 45, false );
	add_image_size( 'goodz-related-post', 353, 227, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'goodz' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Add Support for WooCommerce
	 */
    add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'goodz_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enables theme styles the visual with editor-style.css
	add_editor_style();

}
endif; // goodz_setup
add_action( 'after_setup_theme', 'goodz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function goodz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'goodz_content_width', 1660 );
}
add_action( 'after_setup_theme', 'goodz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function goodz_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'sidebar-1'        => esc_html__( 'Sidebar', 'goodz' ),
		'shop-sidebar' 	   => esc_html__( 'Shop Sidebar', 'goodz' ),
		'footer-sidebar-1' => esc_html__( 'Footer Sidebar 1', 'goodz' ),
		'footer-sidebar-2' => esc_html__( 'Footer Sidebar 2', 'goodz' ),
		'footer-sidebar-2' => esc_html__( 'Footer Sidebar 3', 'goodz' )
	);

	// Loop through each sidebar and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf ( esc_html__( 'Widget area for %s', 'goodz' ), $sidebar_name ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) );
	}

}
add_action( 'widgets_init', 'goodz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function goodz_scripts() {
	wp_enqueue_style( 'goodz-style', get_stylesheet_uri() );

	// Woocommerce styling
	if ( goodz_is_woocommerce_activated() ) {
		wp_enqueue_style( 'goodz-woocommerce-style', get_template_directory_uri() . '/woo-style.css' );
	}

	// Fancybox style
	wp_enqueue_style( 'goodz-fancybox-style', get_template_directory_uri() . '/js/fancybox/fancybox.css' );

	wp_enqueue_script( 'goodz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'goodz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick/slick.min.js', false, false, true );
	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll/infinite-scroll.min.js', array( 'jquery', 'masonry' ), false, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri()     . '/js/fancybox/fancybox.pack.js', false, false, true );
	wp_enqueue_script( 'fancybox-helper', get_template_directory_uri()     . '/js/fancybox/helpers/jquery.fancybox-media.js', false, false, true );

	$ie9 = strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9.' ) ? true : false;

	if ( $ie9 ) {
		wp_enqueue_script( 'placeholders', get_template_directory_uri()     . '/js/placeholders/jquery.placeholder.min.js', false, false, true );
	}
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	// Main JS files
	wp_enqueue_script( 'goodz-call-scripts', get_template_directory_uri() . '/js/common.js', array( 'jquery', 'masonry' ), false, true );

	if ( goodz_is_woocommerce_activated() ) {
		if ( !is_home() && !is_archive() || is_shop() || is_woocommerce() || goodz_is_front_template() ) {
			wp_enqueue_script( 'goodz-call-woo-scripts', get_template_directory_uri() . '/js/woo-common.js', array( 'jquery' ), false, true );
		}
	}

	$template_file = esc_attr( get_post_meta( get_the_ID(), '_wp_page_template', true ) );

	// Load Google Maps API
	if ( is_page() && 'templates/template-contact.php' == $template_file ) {
		wp_enqueue_script( 'goodz-google-maps-api', '//maps.google.com/maps/api/js?sensor=false', false, false, false );
	}

	// Get and define JS vars
	$infinite_scroll_type = get_theme_mod( 'infinite_scroll_type', 'click' );
	$paging_type          = get_theme_mod( 'paging_setting', 'infinite_scroll' );

	global $wp_query;

    // What page are we on? And what is the pages limit?
    $max   = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

	$js_vars = array(
		'url'                     => get_template_directory_uri(),
		'admin_url'               => admin_url( 'admin-ajax.php' ),
		'nonce'                   => wp_create_nonce( 'ajax-nonce' ),
		'no_more_text'            => esc_html__( 'No more posts to load.', 'goodz' ),
		'startPage'               => $paged,
		'maxPages'                => $max,
		'is_type'                 => $infinite_scroll_type,
		'paging_type'             => $paging_type,
		'captcha'                 => esc_attr( get_theme_mod( 'goodz_contact_captcha_setting' ) ),
		'message_info'            => esc_html__( 'Message Sent!', 'goodz' ),
		'headings_font_variant'   => get_theme_mod( 'headings_font_weight', 'default' ),
		'text_font_variant'       => get_theme_mod( 'paragraphs_font_weight', 'default' ),
		'navigation_font_variant' => get_theme_mod( 'navigation_font_weight', 'default' )
	);

	// WooCommerce JS vars
	$woo_infinite_scroll_type = get_theme_mod( 'shop_infinite_scroll_type', 'click' );
	$woo_paging_type          = get_theme_mod( 'shop_paging_setting', 'infinite_scroll' );
	$woo_add_to_cart_js       = plugins_url() . '/woocommerce/assets/js/frontend/add-to-cart-variation.min.js';
	$woo_js                   = plugins_url() . '/woocommerce/assets/js/frontend/woocommerce.min.js';

	$woo_vars = array(
		'url'               => get_template_directory_uri(),
		'admin_url'         => admin_url( 'admin-ajax.php' ),
		'nonce'             => wp_create_nonce( 'ajax-nonce' ),
		'startPage'         => $paged,
	    'maxPages'          => $max,
		'woo_is_type'		=> $woo_infinite_scroll_type,
		'woo_add_to_cart'   => $woo_add_to_cart_js,
		'woo_paging_type'   => $woo_paging_type,
		'woo_js'            => $woo_js,
		'woo_no_items_cart' => esc_html__( 'No items in cart.', 'goodz' ),
		'no_more_text'      => esc_html__( 'No more products to load.', 'goodz' )
	);

	$yith_wcwl_l10n = array(
		'ajax_url'                               => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
		'redirect_to_cart'                       => get_option( 'yith_wcwl_redirect_cart' ),
		'multi_wishlist'                         => get_option( 'yith_wcwl_multi_wishlist_enable' ) == 'yes' ? true : false,
		'hide_add_button'                        => apply_filters( 'yith_wcwl_hide_add_button', true ),
		'is_user_logged_in'                      => is_user_logged_in(),
		'ajax_loader_url'                        => plugins_url() . '/yith-woocommerce-wishlist/assets/images/ajax-loader.gif',
		'remove_from_wishlist_after_add_to_cart' => get_option( 'yith_wcwl_remove_after_add_to_cart' ),
		'labels'                                 => array(
			'cookie_disabled'       => esc_html__( 'We are sorry, but this feature is available only if cookies are enabled on your browser.', 'goodz' ),
			'added_to_cart_message' => sprintf( '<div class="woocommerce-message">%s</div>', apply_filters( 'yith_wcwl_added_to_cart_message', esc_html__( 'Product correctly added to cart', 'goodz' ) ) )
		),
		'actions' => array(
			'add_to_wishlist_action'                 => 'add_to_wishlist',
			'remove_from_wishlist_action'            => 'remove_from_wishlist',
			'move_to_another_wishlist_action'        => 'move_to_another_wishlsit',
			'reload_wishlist_and_adding_elem_action' => 'reload_wishlist_and_adding_elem'
		)
	);

	// Localize php variables
	wp_localize_script( 'goodz-call-scripts', 'js_vars', $js_vars );
	wp_localize_script( 'goodz-call-woo-scripts', 'woo_vars', $woo_vars );
	wp_localize_script( 'goodz-call-wlst-scripts', 'yith_wcwl_l10n', $yith_wcwl_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'goodz_scripts' );

/* ADMIN SCRIPT AND STYLE */
function goodz_add_admin_scripts() {
	// Admin styles
	wp_register_style( 'goodz-shop-admin-css', get_template_directory_uri() . '/inc/admin/admin.css' );
	wp_enqueue_style( 'goodz-shop-admin-css' );
	wp_enqueue_style( 'wp-color-picker' );

	// Admin scripts
	wp_enqueue_media();
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'goodz-shop-admin-js', get_template_directory_uri() . '/inc/admin/admin.js' );

	// Customizer settings
	wp_enqueue_script( 'goodz-admin-scripts', get_template_directory_uri() . '/inc/customizer/js/customizer-settings.js', array(), false, false );

	$js_vars = array(
        'url'          => get_template_directory_uri(),
        'admin_url'    => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'ajax-nonce' ),
        'default_text' => esc_html__( 'Theme default', 'goodz' )
    );
    wp_localize_script( 'goodz-admin-scripts', 'js_vars', $js_vars );
}
add_action( 'admin_enqueue_scripts', 'goodz_add_admin_scripts' );

/**
 * Change theme color support
 */
function goodz_change_colors_fonts() {
	require get_template_directory() . '/inc/change-colors.php';
	require get_template_directory() . '/inc/change-fonts.php';
}
add_action( 'wp_head', 'goodz_change_colors_fonts', '99' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load WooCommerce theme functions.
 */
if ( goodz_is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woo-functions.php';
}

/**
 * Load Plugin Activation
 */
require get_template_directory() . '/inc/plugin-activation.php';

/**
 * Load Meta Boxes Config
 */
require get_template_directory() . '/inc/metadata/meta-boxes.php';

/**
 * Load One click importer
 */
require_once get_template_directory() . '/inc/importer/init.php';


