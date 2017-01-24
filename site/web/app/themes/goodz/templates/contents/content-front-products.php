<?php
/**
 * Displays Front Page Template Products
 *
 * @package  Goodz
 */

if ( ! goodz_is_woocommerce_activated() ) {
    return;
}

$top_selling_type        = get_theme_mod( 'front_page_bestsellers_type', 'product-carousel' );
$top_selling_category    = get_theme_mod( 'front_page_bestsellers_category', 'default' );
$top_selling_products_nr = get_theme_mod( 'front_page_bestsellers_number', 5 );

?>

<article class="home-shop-items archive woocommerce col-sm-12">

    <?php


        // Get Title and Suptitle
        $top_selling_title     = get_theme_mod( 'front_page_bestsellers_title', esc_html__( 'Hotest items', 'goodz' ) );
        $top_selling_sub_title = get_theme_mod( 'front_page_bestsellers_subtitle', esc_html__( 'Checkout our', 'goodz' ) );

        // Print Suptitle and Title
        printf( '<h2><span class="secondary-font">%1$s</span>%2$s</h2>', $top_selling_sub_title, $top_selling_title );

        if ( 'default' == $top_selling_category ) {

            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $top_selling_products_nr,
                'meta_key'       => 'total_sales',
                'orderby'        => 'meta_value_num'
            );

        } else if ( 'newest' == $top_selling_category ) {

            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $top_selling_products_nr
            );

        } else {

            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $top_selling_products_nr,
                'tax_query'      => array(
                'relation'       => 'AND',
                    array(
                        'taxonomy'         => 'product_cat',
                        'field'            => 'id',
                        'terms'            => array( $top_selling_category ),
                        'include_children' => true,
                        'operator'         => 'IN'
                    ),
                )
            );

        }

        $woo_home_query = new WP_Query( $args );

    ?>

    <?php if ( 'product-carousel' == $top_selling_type ) { ?>

        <?php if ( $woo_home_query->have_posts() ) : ?>

            <div class="products container">

                <div class="slider">

                    <?php

                        while ( $woo_home_query->have_posts() ) : $woo_home_query->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;

                    ?>

                </div>

            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    <?php } else { ?>

        <?php if ( $woo_home_query->have_posts() ) : ?>

            <div class="products container grid-wrapper clear">

                <div class="row">
                <?php

                    while ( $woo_home_query->have_posts() ) : $woo_home_query->the_post();
                        wc_get_template_part( 'content', 'product' );
                    endwhile;

                ?>
                </div>

            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    <?php } ?>

</article><!-- .home-shop-items -->
