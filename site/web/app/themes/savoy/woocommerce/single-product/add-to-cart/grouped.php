<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post, $nm_theme_options;

$nm_quantity_arrows_class = ( $nm_theme_options['grouped_products_qty_arrows'] ) ? ' qty-show' : '';

$parent_product_post = $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="group_table <?php echo esc_attr( $nm_quantity_arrows_class ); ?>">
		<tbody>
			<?php
				foreach ( $grouped_products as $product_id ) :
					if ( ! $product = wc_get_product( $product_id ) ) {
						continue;
					}

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) {
						continue;
					}

					$post    = $product->post;
					setup_postdata( $post );
					?>
					<tr>
                        <td class="label">
                            <label for="product-<?php echo $product_id; ?>">
                                <?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '" class="invert-color">' . esc_html( get_the_title() ) . '</a>' : esc_html( get_the_title() ); ?>
                            </label>
                        </td>

                        <?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

                        <td class="price">
                            <?php echo $product->get_price_html(); ?>

                            <?php if ( $availability = $product->get_availability() ) {
                                    $availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
                                    echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
                                }
                            ?>
                        </td>
                        
                        <td>
							<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
								<?php 
									printf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s button" title="%s"><i class="nm-font-plus"></i></a>',
										esc_url( $product->add_to_cart_url() ),
										esc_attr( $product->id ),
										esc_attr( $product->get_sku() ),
										esc_attr( isset( $quantity ) ? $quantity : 1 ),
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										esc_attr( $product->product_type ),
										esc_html( $product->add_to_cart_text() )
									);
								?>
							<?php else : ?>
								<?php
									$nm_qty = apply_filters( 'nm_product_grouped_default_qty', 1 );
                                    $quantites_required = true;
									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $product_id . ']',
										'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : $nm_qty ),
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
									) );
								?>
							<?php endif; ?>
						</td>
					</tr>
					<?php
				endforeach;

				// Reset to parent grouped product
				$post    = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
