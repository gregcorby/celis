<?php
/**
 * Displays product in search page
 *
 * @package  Goodz
 */

global $product, $woocommerce_loop;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php goodz_featured_media(); ?>

	<header class="entry-header">

		<?php goodz_display_product_tags(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php printf( '<span class="price">%s</span>', $product->get_price_html() ); ?>

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

