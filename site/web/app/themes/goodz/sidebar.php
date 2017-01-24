<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goodz
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'shop-sidebar' ) ) {
    return;
}

if ( goodz_is_woocommerce_activated() ) {
    if ( is_cart() || is_checkout() || goodz_is_page( 'woocommerce-account' ) || goodz_is_page( 'woocommerce-wishlist' ) ) {
        return;
    }
}

// Check shop sidebar
if ( goodz_is_woocommerce_activated() && is_shop() ) {

    if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
        <div id="secondary" class="widget-area <?php goodz_sidebar_cols(); ?>" role="complementary">
            <?php dynamic_sidebar( 'shop-sidebar' ); ?>
        </div><!-- #secondary -->
<?php

    } else {
        return;
    }
}
else {

    if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <div id="secondary" class="widget-area <?php goodz_sidebar_cols(); ?>" role="complementary">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->
<?php

    } else {
        return;
    }

}
