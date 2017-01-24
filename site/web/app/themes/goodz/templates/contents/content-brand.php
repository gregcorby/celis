<?php
/**
 * Template part for displaying brand posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

$brand_link = '#';

if ( '' != $brand_link ) {
	$brand_link = get_post_meta( get_the_ID(), 'goodz_brand_link', true );
}

?>

<a href="<?php echo esc_url( $brand_link ); ?>">
	<?php the_post_thumbnail( 'goodz-brand-logos' ); ?>
</a>
