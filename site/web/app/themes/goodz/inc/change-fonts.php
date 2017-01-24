<?php
/**
 * Change default theme fonts
 *
 * @package Goodz
 */

// Get all customizer font settings
$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
$paragraph_font_family  = get_theme_mod( 'paragraphs_font_family', 'default' );
$navigation_font_family = get_theme_mod( 'navigation_font_family', 'default' );

// Headings and body
if ( 'default' != $headings_font_family ) {

	$headings_font_weight = get_theme_mod( 'headings_font_weight', 'default' );

	if ( 'regular' == $headings_font_weight ) {
		$headings_font_weight = '';
	}

?>

	<link href="http://fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $headings_font_family ) . ':' . $headings_font_weight; ?>" rel='stylesheet' type='text/css'>

	<style type="text/css">

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		body,
		blockquote cite,
		blockquote + cite,
		blockquote + p cite,
		.post .entry-content strong,
		.page .entry-content strong,
		.home-blog-feed .posted-on .day,
		.grid-wrapper .format-quote blockquote,
		.grid-wrapper .format-quote blockquote p,
		.widget-title,
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.home-blog-feed .posted-on .day,
		.widget_calendar caption,
		body #jp-relatedposts,
		.main-shop-nav .mini_cart_item a,
		.main-shop-nav .cart-widget__wrapper .button,
		.actions .coupon p,
		.account-details li {
			font-family: <?php echo esc_html( $headings_font_family ); ?>, Helvetica, Arial, sans-serif;
			font-weight: <?php echo esc_html( $headings_font_weight == '' ? 'normal' : $headings_font_weight ); ?>;
		}

	</style>

<?php
}

// Paragraph
if ( 'default' != $paragraph_font_family ) {

	$paragraph_font_weight = get_theme_mod( 'paragraphs_font_weight', 'default' );

	if ( 'regular' == $paragraph_font_weight ) {
		$paragraph_font_weight = '';
	}

?>

	<link href="http://fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $paragraph_font_family ) . ':' . $paragraph_font_weight; ?>" rel='stylesheet' type='text/css'>

	<style type="text/css">

		.secondary-font,
		blockquote,
		.contact-form label,
		.post .entry-content p,
		.page .entry-content p,
		.post .entry-content li,
		.page .entry-content li,
		.post .entry-content blockquote,
		.page .entry-content blockquote,
		.post .entry-content blockquote p,
		.page .entry-content blockquote p,
		.post .entry-meta,
		.cat-links,
		.grid-wrapper .product-tag,
		.wp-caption-text,
		.widget,
		.price,
		div[itemprop="description"],
		.comment-content,
		.pingback .comment-body > a,
		.slick-dots,
		.images .slick-dots button,
		.home-slider .slick-dots button,
		.site-header .search-form:after,
		.author-info p,
		.post .tkss-post-share > h6,
		.woocommerce label,
		.woocommerce .woocommerce-error,
		.woocommerce .woocommerce-info,
		.woocommerce .woocommerce-message,
		.woocommerce-tabs .panel p,
		.coupon input[type="text"],
		.select2-drop,
		div.pp_woocommerce .pp_nav .currentTextHolder {
			font-family: <?php echo esc_html( $paragraph_font_family ); ?>, Helvetica, Arial, sans-serif;
			font-weight: <?php echo esc_html( $paragraph_font_weight == '' ? 'normal' : $paragraph_font_weight ); ?>;
		}

	</style>

<?php
}

// Header Navigation
if ( 'default' != $navigation_font_family ) {

	$navigation_font_weight = get_theme_mod( 'navigation_font_weight', 'default' );

	if ( 'regular' == $navigation_font_weight ) {
		$navigation_font_weight = '';
	}

?>

	<link href="http://fonts.googleapis.com/css?family=<?php echo str_replace( ' ', '+', $navigation_font_family ) . ':' . $navigation_font_weight; ?>" rel='stylesheet' type='text/css'>

	<style type="text/css">

		.main-nav-wrap ul li a {
			font-family: <?php echo esc_html( $navigation_font_family ); ?>, Helvetica, Arial, sans-serif;
			font-weight: <?php echo esc_html( $navigation_font_weight == '' ? 'normal' : $navigation_font_weight ); ?>;
		}

	</style>

<?php
}

