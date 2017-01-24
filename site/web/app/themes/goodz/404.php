<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Goodz
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'goodz' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php

						printf( '<p>%s <a href="%s" rel="home">%s</a>.</p>',
							esc_html__( 'Try search or go back to our ', 'goodz' ),
							esc_url( home_url( '/' ) ),
							esc_html__( 'Homepage', 'goodz' )
						);

					?>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
