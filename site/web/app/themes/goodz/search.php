<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Goodz
 */

get_header();

$paging_type = get_theme_mod( 'paging_setting', 'standard_paging' );

?>

<div class="container">
	<header class="page-header">
		<?php
			printf( '<h1 class="page-title">%s<span>%s</span></h1>', esc_html__( 'Search results:', 'goodz' ), esc_html( get_search_query() ) );
		?>
	</header><!-- .page-header -->
	<div class="row">

		<section id="primary" class="content-area col-lg-12">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="row">
					<div class="grid-wrapper clear">

						<?php

							while ( have_posts() ) : the_post();

								if ( 'product' == get_post_type() ) {
									get_template_part( 'templates/contents/content-product', 'search' );
								}
								else {
									get_template_part( 'templates/contents/content', get_post_format() );
								}

							endwhile;

						?>

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
		</section><!-- #primary -->

	</div><!-- .row -->

	<!-- Paging -->
	<?php if ( 'infinite_scroll' != $paging_type ) : ?>

		<?php the_posts_navigation(); ?>

	<?php endif; ?>

</div><!-- .container -->

<?php get_footer(); ?>
