<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

get_header();

$paging_type = get_theme_mod( 'paging_setting', 'standard_paging' );

?>

<div class="container">

	<header class="page-header">
		<?php
			goodz_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<div class="row">

		<div id="primary" class="content-area <?php goodz_content_cols(); ?>">
			<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<div class="row">
						<div class="grid-wrapper clear">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'templates/contents/content', get_post_format() ); ?>

							<?php endwhile; ?>
						</div>
					</div>

					<!-- Infinite load -->
					<?php if ( 'infinite_scroll' == $paging_type ) : ?>

						<?php goodz_is_posts_navigation(); ?>

					<?php endif; ?>

				<?php else : ?>

					<?php get_template_part( 'templates/contents/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .row -->

	<!-- Paging -->
	<?php if ( 'infinite_scroll' != $paging_type ) : ?>

		<?php the_posts_navigation(); ?>

	<?php endif; ?>

</div><!-- .container -->

<?php get_footer(); ?>
