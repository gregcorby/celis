<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Goodz
 */

get_header();

$paging_type = get_theme_mod( 'paging_setting', 'infinite_scroll' );

?>

<!-- Display Featured Posts slider if enabled -->
<?php goodz_featured_posts_slider(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area <?php goodz_content_cols(); ?>">
			<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

					<div class="row">
						<div class="grid-wrapper clear" id="post-load">
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

</div><!-- .conatiner -->

<?php get_footer(); ?>
