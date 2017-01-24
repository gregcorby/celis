<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Goodz
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function goodz_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'post-load',
		'render'    => 'goodz_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );

	/**
	 * Custom render function for Infinite Scroll.
	 */
	function goodz_infinite_scroll_render() {
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/contents/content', get_post_format() );
		endwhile;
	} // end function goodz_infinite_scroll_render

	/**
	 * Add theme support for Responsive videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add theme support for Site Logo
	 */
	add_theme_support( 'site-logo', array(
	    'size' => 'goodz-shop-logo',
	) );

} // end function goodz_jetpack_setup
add_action( 'after_setup_theme', 'goodz_jetpack_setup' );
