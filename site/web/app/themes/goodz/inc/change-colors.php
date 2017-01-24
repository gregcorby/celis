<?php
/**
 * Change colors regarding user choices in customizer
 *
 * @package Goodz
 */

/**
 * GENERAL THEME COLORS
 */

$headings_color            = get_theme_mod( 'goodz_heading_color', '#000' );
$paragraph_color           = get_theme_mod( 'goodz_paragraph_color', '#000' );
$link_color                = get_theme_mod( 'goodz_link_color', '#000' );
$link_hover_color          = get_theme_mod( 'goodz_link_hover_color', '#808080' );
$background_color          = get_theme_mod( 'background_color', '#fff' );

/**
 * HEADER COLORS
 */

// Blog Header Colors
$header_transparency       = get_theme_mod( 'blog_header_transparency_enable', 1 );
$header_bg_color           = get_theme_mod( 'goodz_bg_header_color', '#fff' );
$header_bg_ul_color        = $header_bg_color;
$navigation_color          = get_theme_mod( 'goodz_navigation_color', '#000' );
$navigation_tr_color       = get_theme_mod( 'goodz_tr_navigation_color', '#000' );
$navigation_hover_color    = get_theme_mod( 'goodz_navigation_hover_color', '#808080' );
$logo_color                = get_theme_mod( 'goodz_logo_color', '#000' );
$logo_hover_color          = get_theme_mod( 'goodz_logo_hover_color', '#000' );
$logo_description_color    = get_theme_mod( 'goodz_logo_description_color', '#000' );

// Front Page Header colors
$hp_header_transparency    = get_theme_mod( 'hp_header_transparency_enable', 1 );
$hp_header_bg_color        = get_theme_mod( 'goodz_hp_bg_header_color', '#fff' );
$hp_navigation_color       = get_theme_mod( 'goodz_hp_navigation_color', '#000' );
$hp_navigation_tr_color    = get_theme_mod( 'goodz_hp_tr_navigation_color', '#000' );
$hp_navigation_hover_color = get_theme_mod( 'goodz_hp_navigation_hover_color', '#808080' );
$hp_logo_color             = get_theme_mod( 'goodz_hp_logo_color', '#000' );
$hp_logo_hover_color       = get_theme_mod( 'goodz_hp_logo_hover_color', '#000' );
$hp_logo_description_color = get_theme_mod( 'goodz_hp_logo_description_color', '#000' );

/**
 * FOOTER COLORS
 */

// Footer colors
$footer_color              = get_theme_mod( 'goodz_footer_color', '#fff' );
$footer_text_color         = get_theme_mod( 'goodz_footer_text_color', '#000' );
$footer_links_color        = get_theme_mod( 'goodz_footer_links_color', '#000' );
$footer_links_hover_color  = get_theme_mod( 'goodz_footer_links_hover_color', '#000' );

// Front page colors

$product_categories_bg     = get_theme_mod( 'goodz_front_new_color', '#D8D8D8' );
$product_categories_title  = get_theme_mod( 'goodz_front_new_title_color', '#000' );
$product_categories_text   = get_theme_mod( 'goodz_front_new_text_color', '#000' );

?>
<style type="text/css">

        /* Headings color */

        h1, h2, h3, h4, h5, h6,
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
        .widget-title,
        .nav-links,
        .format-quote blockquote {
            color: <?php echo esc_attr( $headings_color ); ?>;
        }

        /* Paragraph color */

        .entry-content p {
            color: <?php echo esc_attr( $paragraph_color ); ?>;
        }

        /* Link color */

        a {
            color: <?php echo esc_attr( $link_color ); ?>;
        }

        a:hover {
            color: <?php echo esc_attr( $link_hover_color ); ?>;
        }

        /* Logo color */

        .site-branding a {
            color: <?php echo esc_attr( $logo_color ); ?>;
        }

        .site-branding a:hover {
            color: <?php echo esc_attr( $logo_hover_color ); ?>;
        }

        .site-description {
            color: <?php echo esc_attr( $logo_description_color ); ?>;
        }

        /* Front page logo color */

        .page-template-template-front-page .site-branding a {
            color: <?php echo esc_attr( $hp_logo_color ); ?>;
        }

        .page-template-template-front-page .site-branding a:hover {
            color: <?php echo esc_attr( $hp_logo_hover_color ); ?>;
        }

        .page-template-template-front-page .site-description {
            color: <?php echo esc_attr( $hp_logo_description_color ); ?>;
        }

        /* Content color */

        #content,
        .main-content-wrap {
            background-color: <?php echo esc_attr( $background_color ); ?>;
        }

        /* Footer colors */

        .site-footer,
        .featured-slider-fullwidth .site-footer {
            background-color: <?php echo esc_attr( $footer_color ); ?>;
        }

        .site-footer span {
            color: <?php echo esc_attr( $footer_text_color ); ?>;
            opacity: 0.4;
        }

        .site-footer a {
            color: <?php echo esc_attr( $footer_links_color ); ?>;
            opacity: 0.4;
        }

        .site-footer a:hover {
            color: <?php echo esc_attr( $footer_links_hover_color ); ?>;
            opacity: 1;
        }

        /* Front Page Sections */

        .category-box {
            background-color: <?php echo esc_attr( $product_categories_bg ); ?>
        }

        .new-in-store-title {
            color: <?php echo esc_attr( $product_categories_title ); ?>
        }

        .new-in-store.secondary-font {
            color: <?php echo esc_attr( $product_categories_text ); ?>
        }

        /* Header Colors */

        /* header bg color */

        body:not(.page-template-template-front-page) .site-header {
            background-color: <?php echo esc_attr( $header_bg_color ); ?>;
        }

        /* navigation link colors */

        body:not(.page-template-template-front-page) #site-navigation ul li a,
        body:not(.page-template-template-front-page) a#big-search-trigger,
        body:not(.page-template-template-front-page) .icon-cart
         {
            color: <?php echo esc_attr( $navigation_color ); ?>;
        }

        body:not(.page-template-template-front-page) .transparent-header #site-navigation ul li a,
        body:not(.page-template-template-front-page) .transparent-header a#big-search-trigger,
        body:not(.page-template-template-front-page) .transparent-header .icon-cart {
            color: <?php echo esc_attr( $navigation_tr_color ); ?>;
        }

        body:not(.page-template-template-front-page) #site-navigation ul li a:hover,
        body:not(.page-template-template-front-page) a#big-search-trigger:hover,
        body:not(.page-template-template-front-page) .icon-cart:hover {
            color: <?php echo esc_attr( $navigation_hover_color ); ?>;
        }

        body:not(.page-template-template-front-page) .menu-toggle span,
        body:not(.page-template-template-front-page) .menu-toggle span:before,
        body:not(.page-template-template-front-page) .menu-toggle span:after {
            background-color: <?php echo esc_attr( $navigation_color ); ?>;
        }

        body:not(.page-template-template-front-page) .transparent-header .menu-toggle span,
        body:not(.page-template-template-front-page) .transparent-header .menu-toggle span:before,
        body:not(.page-template-template-front-page) .transparent-header .menu-toggle span:after {
            background-color: <?php echo esc_attr( $navigation_tr_color ); ?>;
        }

        /* Front Page Header */

        .page-template-template-front-page .site-header {
            background-color: <?php echo esc_attr( $hp_header_bg_color ); ?>;
        }

        /* front page navigation link colors */

        .page-template-template-front-page #site-navigation ul li a,
        .page-template-template-front-page a#big-search-trigger,
        .page-template-template-front-page .icon-cart,
        .home-slider .slick-dots button,
        .home-slider .slick-dots .slick-active:after,
        .home-slider .slick-dots span {
            color: <?php echo esc_attr( $hp_navigation_color ); ?>;
        }

        .page-template-template-front-page .transparent-header #site-navigation ul li a,
        .page-template-template-front-page .transparent-header a#big-search-trigger,
        .page-template-template-front-page .transparent-header .icon-cart,
        .transparent-header + .site-content .home-slider .slick-dots button,
        .transparent-header + .site-content .home-slider .slick-dots .slick-active:after,
        .transparent-header + .site-content .home-slider .slick-dots span {
            color: <?php echo esc_attr( $hp_navigation_tr_color ); ?>;
        }


        .page-template-template-front-page #site-navigation ul li a:hover,
        .page-template-template-front-page a#big-search-trigger:hover {
            color: <?php echo esc_attr( $hp_navigation_hover_color ); ?>;
        }

        .page-template-template-front-page .menu-toggle span,
        .page-template-template-front-page .menu-toggle span:before,
        .page-template-template-front-page .menu-toggle span:after {
            background-color: <?php echo esc_attr( $hp_navigation_color ); ?>;
        }

        .page-template-template-front-page .transparent-header .menu-toggle span,
        .page-template-template-front-page .transparent-header .menu-toggle span:before,
        .page-template-template-front-page .transparent-header .menu-toggle span:after {
            background-color: <?php echo esc_attr( $hp_navigation_tr_color ); ?>;
        }

        .home-slider .slick-arrow,
        .home-slider .slick-arrow:hover {
            border-color: <?php echo esc_attr( $hp_navigation_color ); ?>;
        }

        .home-slider .slick-arrow:before,
        .home-slider .slick-arrow:after,
        .home-slider .slick-arrow:hover:before,
        .home-slider .slick-arrow:hover:after,
        .home-slider .slick-dots .slick-active:after {
            background-color: <?php echo esc_attr( $hp_navigation_color ); ?>;
        }

        @media only screen and (min-width: 1025px){

            body:not(.page-template-template-front-page) .main-navigation .nav-menu > li > ul,
            body:not(.page-template-template-front-page) .background-change.transparent-header,
            body:not(.page-template-template-front-page) .background-change .main-navigation .nav-menu .mega-menu-dropdown > ul {
                background-color: <?php echo esc_attr( $header_bg_color ); ?>;
            }

            .page-template-template-front-page .main-navigation .nav-menu > li > ul,
            .page-template-template-front-page .background-change.transparent-header,
            .page-template-template-front-page .background-change .main-navigation .nav-menu .mega-menu-dropdown > ul {
                background-color: <?php echo esc_attr( $hp_header_bg_color ); ?>;
            }

        }


        <?php

            // Custom CSS from Customizer

            if ( '' != get_theme_mod( 'goodz_custom_css', '' ) ) :
                // Custom CSS
                printf( get_theme_mod ( 'goodz_custom_css' ) );
            endif;

        ?>

    </style>