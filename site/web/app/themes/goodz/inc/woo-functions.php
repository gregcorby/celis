<?php
/**
 * WooCommerce Shop specific functions
 *
 * @package Goodz
 */

/**
 * Set number of products to display on shop page
 */
function goodz_number_of_products() {

    if ( isset( $_GET['display'] ) ) {
        if ( $_GET['display'] === 'all' ){
            return '9999';
        }
    } else {
        $number_of_products_per_page = get_theme_mod( 'shop_products_number', 12 );
        return $number_of_products_per_page;
    }

}
add_filter( 'loop_shop_per_page', 'goodz_number_of_products', 20 );

/**
 * Filter post_class() additional classes for WooCommerce Shop
 *
 * @since Goodz 1.0
 */
function goodz_woo_post_classes( $classes, $class, $post_id ) {
    global $product, $woocommerce_loop;

    // Get Customizer settings for shop layout
    $number_of_columns   = get_theme_mod( 'product_columns_setting', 'col-sm-3' );
    $layout_display_type = get_theme_mod( 'layout_type_setting', 'regular' );

    // Classes for related products
    if ( is_product() ) {
        // Check number of columns
        if ( $woocommerce_loop['columns'] == 4 ) {
            $classes[] = 'col-sm-3';
        } else if ( $woocommerce_loop['columns'] == 5 ) {
            $classes[] = 'col-sm-tk-5';
        } else if ( $woocommerce_loop['columns'] == 3 ) {
            $classes[] = 'col-sm-4';
        } else if ( $woocommerce_loop['columns'] == 2 ) {
            $classes[] = 'col-sm-6';
        } else if ( $woocommerce_loop['columns'] == 6 ) {
            $classes[] = 'col-sm-2';
        }
    }

    // Home page product section classes
    if ( goodz_is_front_template() ) {
        global $home_posts_number;

        if ( 'product' == get_post_type() ) :
            if ( $home_posts_number == 4 ) {
                $classes[] = 'col-sm-3';
            } else if ( $home_posts_number == 5 ) {
                $classes[] = 'col-sm-tk-5';
            } else if ( $home_posts_number == 3 ) {
                $classes[] = 'col-sm-4';
            } else if ( $home_posts_number == 2 ) {
                $classes[] = 'col-sm-6';
            } else if ( $home_posts_number == 6 ) {
                $classes[] = 'col-sm-2';
            }
        endif;

        //$classes[] = 'col-sm-tk-5';
    }

    if ( 'masonry' == $layout_display_type ) {
        $number_of_columns = 'col-sm-3';
    }

    if ( is_shop() || is_product_category() || is_product_category() || is_product_tag() ) {
        $classes[] = $number_of_columns;

        if ( $product->is_featured() ) :
            $classes[] = 'featured-product';
        endif;
    }

    if ( goodz_is_front_template() && 'product' == get_post_type() ) {
        $classes[] = $number_of_columns;

        if ( $product->is_featured() ) :
            $classes[] = 'featured-product';
        endif;
    }

    return $classes;

}
add_filter( 'post_class', 'goodz_woo_post_classes', 10, 3 );

/**
 * Filter body_class() additional classes for WooCommerce
 *
 * @since Goodz Shop 1.0
 */
function goodz_woo_body_classes( $classes ) {
    // Get Customizer settings for shop layout
    $shop_layout_type     = get_theme_mod( 'shop_layout_setting', 'boxed' );
    $single_layout_type   = get_theme_mod( 'single_product_layout_setting', 'boxed' );
    $product_display_type = get_theme_mod( 'product_display_setting', 'standard-view' );
    $layout_display_type  = get_theme_mod( 'layout_type_setting', 'regular' );
    $masonry_class        = 'shop-' . $layout_display_type;

    if ( 'masonry' == $layout_display_type ) {
        $product_display_type = 'gallery-view';
    }

    if ( is_woocommerce() || goodz_is_front_template() ) {
        // Single product
        if ( is_single() ) {
            $classes[] = $single_layout_type;
        }

        // Shop layout
        if ( is_archive() || is_shop() || goodz_is_front_template() ) {
            $classes[] = $product_display_type;
            $classes[] = $masonry_class;
            $classes[] = $shop_layout_type;
        }
    }

    return $classes;
}
add_filter( 'body_class', 'goodz_woo_body_classes', 10, 3 );

/**
 * Reorganize element positions in WooCommerce products archive
 *
 * @since Goodz Shop 1.0
 */
function goodz_add_sidebar_to_content() {
    // Get shop sidebar setting
    $sidebar             = get_theme_mod( 'shop_sidebar_setting', 'sidebar-right' );
    $layout_display_type = get_theme_mod( 'layout_type_setting', 'regular' );

    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
    echo '</div>';

    if ( 'masonry' != $layout_display_type ) {

        if ( 'sidebar-none' != $sidebar && !is_single() ) :
            get_sidebar();
        endif;

    }

    echo '</div><!-- .row -->';
}
add_action( 'woocommerce_after_shop_loop', 'goodz_add_sidebar_to_content' );

function goodz_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'goodz_remove_wc_breadcrumbs' );

/**
 * Add Cart Items Count
 *
 * @since  Goodz 1.0
 */
if ( ! function_exists( 'goodz_cart_link' ) ) {

    function goodz_cart_link() { ?>

        <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_html_e( 'View your order summary', 'goodz' ); ?>">
            <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php echo WC()->cart->get_cart_total(); ?>
            <i class="icon-cart"></i>
        </a>

<?php

    }
}

/**
 * Display Header Mini Cart
 *
 * @since  Goodz 1.0
 * @uses  goodz_is_woocommerce_activated() check if WooCommerce is activated
 */
if ( ! function_exists( 'goodz_woo_header_cart' ) ) {

    function goodz_woo_header_cart() {

        if ( goodz_is_woocommerce_activated() ) {

            if ( is_cart() ) {
                $class = 'current-menu-item';
            } else {
                $class = '';
            }

        ?>

        <ul class="header-cart menu">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php goodz_cart_link(); ?>
            </li>
            <li class="cart-widget__container">
                <div class="cart-widget__wrapper">
                    <div class="cart-widget">
                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                    </div>
                </div>
            </li>
        </ul>

        <?php

        }
    }

}

/**
 * Related products number
 */
function goodz_related_products_args( $args ) {
    $args['posts_per_page'] = 5;
    $args['columns']        = 5;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'goodz_related_products_args' );

function goodz_remove_woo_actions() {

    $paging_type = get_theme_mod( 'shop_paging_setting', 'standard_paging' );

    // Remove related products
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 0 );
    // Remove cross-sells
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

    if ( 'infinite_scroll' == $paging_type ) :
        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
    endif;
}
add_action( 'init', 'goodz_remove_woo_actions' );

/**
 * Add View All option to shop
 */
function goodz_shop_view_all() {
    if ( !isset( $_GET['display'] ) ) {

        if ( is_paged() ) : ?>

            <a href="../../?display=all"><?php esc_html_e( 'View All', 'goodz' ); ?></a>

        <?php else : ?>

            <?php if ( is_search() ) {

                global $wp;
                $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );

            ?>

                <a href="<?php echo esc_url( $current_url ); ?>&amp;display=all"><?php esc_html_e( 'View All', 'goodz' ); ?></a>

            <?php } else { ?>

                <a href="?display=all"><?php esc_html_e( 'View All', 'goodz' ); ?></a>

            <?php } ?>

        <?php endif;

    }
}
add_action( 'woocommerce_before_shop_loop', 'goodz_shop_view_all', 21 );

/**
 * Remove product from cart using AJAX
 */
function goodz_cart_product_remove() {

    global $wpdb, $woocommerce;

    $id           = 0;
    $variation_id = 0;

    if ( ! empty( $_REQUEST['product_id'] ) ) {
        $id = $_REQUEST['product_id'];
    }

    if ( ! empty( $_REQUEST['variation_id'] ) ) {
        $variation_id = $_REQUEST['variation_id'];
    }

    $cart = $woocommerce->cart;

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

        if ( 0 < $variation_id && ( $cart_item['product_id'] == $id && $cart_item['variation_id'] == $variation_id ) ) {
            $cart->set_quantity( $cart_item_key, 0 );
        }
        else if ( $cart_item['product_id'] == $id && 0 == $variation_id ) {
            $cart->set_quantity( $cart_item_key, 0 );
        }

    }

    if ( $woocommerce->tax_display_cart == 'excl' ) {
        $totalamount = wc_price( $woocommerce->cart->get_total() );
    } else {
        $totalamount = wc_price( $woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total );
    }

    printf( $totalamount );

    die();
}
add_action( 'wp_ajax_goodz_cart_product_remove', 'goodz_cart_product_remove' );
add_action( 'wp_ajax_nopriv_goodz_cart_product_remove', 'goodz_cart_product_remove' );

/**
 * Display sharing icons on single product page
 */
function woo_social_share() {

    // Get Customizer settings
    $product_social_share    = get_theme_mod( 'product_social_enable', 1 );
    $product_facebook_share  = get_theme_mod( 'product_social_facebook', 1 );
    $product_twitter_share   = get_theme_mod( 'product_social_twitter', 1 );
    $product_tumblr_share    = get_theme_mod( 'product_social_tumblr', 1 );
    $product_pinterest_share = get_theme_mod( 'product_social_pinterest', 1 );
    $product_email_share     = get_theme_mod( 'product_social_email', 1 );
    $pin_image               = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    $link                    = get_permalink();
    $title                   = get_the_title();

    // Display product social share
    if ( $product_social_share ) :

        if ( is_single() ) {

            echo '<div class="product-share-wrap">';

            // Display share link
            printf( '<span>%s</span>', esc_html__( 'Share', 'goodz' ) );

                echo '<div class="product-share-box">';

                    // Facebook
                    if ( $product_pinterest_share ) {
                        $furl = 'https://www.facebook.com/sharer/sharer.php?u=' . $link;
                        printf( '<a href="%s"><i class="icon-facebook"></i></a>', esc_url( $furl ) );
                    }

                    // Twitter
                    if ( $product_twitter_share ) {
                        $turl = 'https://twitter.com/home?status=Check%20out%20this%20article:%20' . $title . '%20-%20' . $link;
                        printf( '<a href="%s"><i class="icon-twitter"></i></a>', esc_url( $turl ) );
                    }

                    // Tumblr
                    if ( $product_twitter_share ) {
                        $tburl = 'http://www.tumblr.com/share/link?url='. $link .'&description=' . get_the_excerpt();
                        printf( '<a href="%s"><i class="icon-tumblr"></i></a>', esc_url( $tburl ) );
                    }

                    // Pinterest
                    if ( $product_pinterest_share ) {
                        $purl = 'https://pinterest.com/pin/create/button/?url=' . $link . '&media=' . $pin_image . '&description=' . $title;
                        printf( '<a href="%s"><i class="icon-pinterest"></i></a>', esc_url( $purl ) );
                    }

                    // Email
                    if ( $product_email_share ) {
                        $eurl = 'mailto:?Subject=' . $title . '&Body=I%20saw%20this%20and%20thought%20of%20you!%20' . $link;
                        printf( '<a href="%s"><i class="icon-mail"></i></a>', esc_url( $eurl ) );
                    }

                echo '</div>'; // end product-share-box

            echo '</div>'; // end product-share-wrap

        }

    endif;

}
add_action( 'woocommerce_before_add_to_cart_form', 'woo_social_share' );

/**
 * Display product tags
 */
function goodz_display_product_tags() {
    global $post;

    $terms = get_the_terms( $post->id, 'product_tag' );

    if ( $terms ) :

        $product_tags = wp_list_pluck( $terms, 'name' );

        $ptags = implode( ', ', $product_tags );

        printf( '<span class="product-tag">%s</span>', $ptags );

    endif;
}
add_action( 'woocommerce_single_product_summary', 'goodz_display_product_tags', 4 );

/**
 * Define image sizes
 */
function goodz_woocommerce_image_dimensions() {
    global $pagenow;

    if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
        return;
    }

    $catalog = array(
        'width'  => '730',    // px
        'height' => '730',    // px
        'crop'   => 1         // true
    );

    $single = array(
        'width'  => '1014',   // px
        'height' => '999999', // px
        'crop'   => 1         // true
    );

    $thumbnail = array(
        'width'  => '730',    // px
        'height' => '730',    // px
        'crop'   => 0         // false
    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}

add_action( 'init', 'goodz_woocommerce_image_dimensions', 1 );

