<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

?>

<article id="post-<?php the_ID(); ?>" class="post">

	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php } ?>

	<header class="entry-header">

		<?php if ( is_single() ) : ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( !is_home() ) { ?>
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
	<?php } ?>

</article><!-- #post-## -->

