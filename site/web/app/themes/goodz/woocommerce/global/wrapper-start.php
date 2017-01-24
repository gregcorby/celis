<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 *
 * @themeskingdom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$template = get_option( 'template' );

// Get Customizer setting for sidebar
$sidebar             = get_theme_mod( 'shop_sidebar_setting', 'sidebar-right' );
$layout_display_type = get_theme_mod( 'layout_type_setting', 'regular' );

if ( 'sidebar-none' == $sidebar || 'masonry' == $layout_display_type || is_single() || ! is_active_sidebar( 'shop-sidebar' ) ) :

	$column_class = 'col-sm-12';

else :

	$column_class = 'col-md-9 has-sidebar ' . $sidebar;

endif;

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	case 'twentyfifteen' :
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;
	default :
		echo '<div id="container"><div class="row"><div id="primary" class="' . $column_class . '" role="main">';
		break;
}
