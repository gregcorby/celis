<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php goodz_featured_media(); ?>

	<header class="entry-header">

		<?php goodz_entry_header(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			the_excerpt( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( esc_html__( 'Read more. %s', 'goodz' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'goodz' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
