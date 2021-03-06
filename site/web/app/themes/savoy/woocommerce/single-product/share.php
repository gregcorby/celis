<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $nm_theme_options, $nm_globals, $post;

if ( $nm_theme_options['product_share_buttons'] ) {
    $wrapper_class = ' has-share-buttons';
    
    $esc_permalink = esc_url( get_permalink() );
    $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );

    $share_links = apply_filters( 'nm_product_share_links', array(
        '<a href="//www.facebook.com/sharer.php?u=' . $esc_permalink . '" target="_blank" title="' . esc_html__( 'Share on Facebook', 'nm-framework' ) . '"><i class="nm-font nm-font-facebook"></i></a>',
        '<a href="//twitter.com/share?url=' . $esc_permalink . '" target="_blank" title="' . esc_html__( 'Share on Twitter', 'nm-framework' ) . '"><i class="nm-font nm-font-twitter"></i></a>',
        '<a href="//pinterest.com/pin/create/button/?url=' . $esc_permalink . '&amp;media=' . esc_url( $product_image[0] ) . '&amp;description=' . urlencode( get_the_title() ) . '" target="_blank" title="' . esc_html__( 'Pin on Pinterest', 'nm-framework' ) . '"><i class="nm-font nm-font-pinterest"></i></a>'
    ) );
} else {
    $wrapper_class = '';
}
?>

<div class="nm-product-share-wrap<?php echo $wrapper_class; ?>">
	<?php if ( $nm_globals['wishlist_enabled'] ) : ?>
    <div class="nm-product-wishlist-button-wrap">
		<?php nm_wishlist_button(); ?>
    </div>
    <?php endif; ?>
    
    <?php if ( $nm_theme_options['product_share_buttons'] ) : ?>
    <div class="nm-product-share">
        <?php
            foreach ( $share_links as $link ) {
                echo $link;
            }
        ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_share' ); // Sharing plugins can hook into here ?>
