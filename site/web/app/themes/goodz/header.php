<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goodz
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'goodz' ); ?></a>

	<?php

		$hp_header_transparency = get_theme_mod( 'hp_header_transparency_enable', 1 );
		$header_transparency    = get_theme_mod( 'blog_header_transparency_enable', 1 );
		$featured_slider        = get_theme_mod( 'featured_slider_enable', 0 );
		$featured_slider_width  = get_theme_mod( 'featured_slider_width', 1 );
		$transparent_header     = '';

		if ( ( goodz_is_front_template() && $hp_header_transparency ) || ( is_home() && $header_transparency && $featured_slider && $featured_slider_width ) ) {
			$transparent_header = 'transparent-header';
		}

	?>

	<header id="masthead" class="site-header mega-menu <?php echo esc_attr( $transparent_header ); ?>" role="banner">
		<div class="container">

			<div class="site-branding">

				<?php

					$is_retina      = false;
					$headline_class = '';

				    if ( isset( $_COOKIE["device_pixel_ratio"] ) ) {

				        $is_retina = ( $_COOKIE["device_pixel_ratio"] >= 2 );

				    } else { ?>

						<script language="javascript">

							(function(){

							  if( document.cookie.indexOf('device_pixel_ratio') == -1
							      && 'devicePixelRatio' in window
							      && window.devicePixelRatio == 2 ){

							    var date = new Date();
							    date.setTime( date.getTime() + 3600000 );

							    document.cookie = 'device_pixel_ratio=' + window.devicePixelRatio + ';' + ' expires=' + date.toUTCString() +'; path=/';
							    //if cookies are not blocked, reload the page
							    if(document.cookie.indexOf('device_pixel_ratio') != -1) {
							        window.location.reload();
							    }
							  }

							})();

					</script>

				<?php }

					if ( $is_retina ) {

						$logo = get_theme_mod( 'goodz_retina_logo_setting' );

						if ( empty ( $logo ) ) {
							$logo = get_theme_mod( 'goodz_logo_setting' );
						}

						$retina_class = 'retina-logo';

					} else {

						$logo = get_theme_mod( 'goodz_logo_setting' );

						$retina_class = 'standard-logo';

					}

					// Display logo
					if ( $logo ) {
						printf( '<a href="%1$s" rel="home" class="%2$s"><img src="%3$s" alt="website logo" /></a>', esc_url( home_url( '/' ) ), $retina_class, esc_url( $logo ) );
						$headline_class = 'screen-reader-text';
					}

				?>

				<!-- Display site title and description -->
				<?php if ( '' != get_bloginfo( 'name' ) ) { ?>

					<?php if ( is_front_page() && is_home() ) : ?>

						<h1 class="site-title <?php echo esc_attr( $headline_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php else : ?>

						<p class="site-title <?php echo esc_attr( $headline_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

					<?php endif; ?>

				<?php } ?>

				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description <?php echo esc_attr( $headline_class ); ?>"><?php bloginfo( 'description' ); ?></p>
				<?php } ?>

			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<?php esc_html_e( 'Primary Menu', 'goodz' ); ?><span>&nbsp;</span>
				</button>
				<div class="main-nav-wrap">
					<div class="verticalize">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

						<?php if ( goodz_is_woocommerce_activated() ) : ?>

							<div class="main-shop-nav">
								<ul>
									<li>
										<?php if ( is_user_logged_in() ) { ?>
											<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_html_e( 'My Account', 'goodz' ); ?>"><?php esc_html_e( 'My Account','goodz' ); ?></a>
										<?php }
										else { ?>
											<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_html_e( 'Login', 'goodz' ); ?>"><?php esc_html_e( 'Login', 'goodz' ); ?></a>
										<?php } ?>
									</li>
									<?php if ( function_exists( 'yith_wishlist_constructor' ) ) { ?>
										<li>
											<?php printf( '<a href="%1$s">%2$s</a>', esc_url( home_url() . '/wishlist' ), esc_html__( 'Saved items', 'goodz' ) ); ?>
										</li>
									<?php } ?>
									<li><?php goodz_woo_header_cart(); ?></li>
								</ul>
							</div>

						<?php endif; ?>
					</div>
				</div>

			</nav><!-- #site-navigation -->
			<!-- Search form -->
			<div class="search-wrap"><?php get_search_form(); ?></div>
			<a href="#" id="big-search-trigger"><i class="icon-search"></i></a>
			<a href="#" id="big-search-close"><i class="icon-close"></i></a>

			<?php if ( goodz_is_woocommerce_activated() ) : ?>
				<!-- Cart icon for touch devices -->
				<div class="cart-touch">
	                <?php goodz_cart_link(); ?>
	            </div>
        	<?php endif; ?>

		</div><!-- container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

	<?php if ( ( goodz_is_woocommerce_activated() && is_woocommerce() ) || goodz_is_front_template() ) : ?>

		<!-- Product Modal -->
		<div class="product-modal-wrapp">
			<div class="product-modal clear">
				<a href="#" class="close">X</a>
			</div>
		</div>

	<?php endif; ?>
