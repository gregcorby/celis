<?php
/**
 * Template part for displaying link posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

$link_text    = get_post_meta( get_the_ID(), 'goodz_link_text', true );
$link_address = get_post_meta( get_the_ID(), 'goodz_link_url', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="highlighted">
		<header class="entry-header">

			<?php goodz_entry_header(); ?>

			<?php printf( '<h2 class="entry-title">%s</h2>', esc_html( $link_text ) ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php printf( '<a href="%s">%s</a>', esc_url( $link_address ), esc_html( $link_address ) );  ?>

		</div><!-- .entry-content -->
	</div>

</article><!-- #post-## -->
