<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 *
 * @themeskingdom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<section class="account-details-wrap">
	<article class="account-details">
		<div class="account-buttons"><?php
			printf(
				__( '<a href="%2$s" class="user-sign-out">Sign out</a>', 'woocommerce' ) . ' ',
				$current_user->display_name,
				wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
			);

			printf( __( '<a href="%s" class="button edit">edit</a>', 'woocommerce' ),
				wc_customer_edit_account_url()
			);
			?>
		</div>
		<h2>Account Details</h2>
		<ul>
			<li>
				<span>First name:</span>
				<span><?php echo esc_attr( $current_user->first_name ); ?></span>
			</li>
			<li>
				<span>Last name:</span>
				<span><?php echo esc_attr( $current_user->last_name ); ?></span>
			</li>
			<li>
				<span>Email:</span>
				<span><?php echo esc_attr( $current_user->user_email ); ?></span>
			</li>
		</ul>
	</article>


	<article class="product-downloads">
		<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
	</article>

	<article class="recent-orders">
		<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
	</article>
</section>

<section class="addresses-wrap">
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
</section>

<?php do_action( 'woocommerce_after_my_account' ); ?>
