<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

$contact_form = esc_attr( get_theme_mod( 'goodz_contact_form_setting' ) );

?>

<header class="page-header">
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<?php edit_post_link( esc_html__( 'Edit', 'goodz' ), '<span class="edit-link">', '</span>' ); ?>
</header><!-- .entry-header -->

<article class="page-content">

	<div class="row">
		<div class="<?php goodz_content_cols(); ?>">

			<div class="entry-content">
				<?php

					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'goodz' ),
						'after'  => '</div>',
					) );

				?>
			</div><!-- .entry-content -->

			<!-- Contact Form -->
			<?php if ( is_page_template( 'templates/template-contact.php' ) ) : ?>

				<?php if ( $contact_form ) { ?>
					<!-- Display Contact form -->
					<?php get_template_part( '/templates/contents/contact', 'form' ); ?>
				<?php } ?>

			<?php endif; ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		</div><!-- .columns -->
		<?php get_sidebar(); ?>
	</div><!-- .row -->

</article><!-- .page-content -->
