<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 *
 * @themeskingdom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( $order ) : ?>

    <?php if ( $order->has_status( 'failed' ) ) : ?>

        <h3><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></h3>

        <h3><?php
            if ( is_user_logged_in() )
                esc_html_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
            else
                esc_html_e( 'Please attempt your purchase again.', 'woocommerce' );
            ?></h3>

        <p>
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ) ?></a>
            <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'woocommerce' ); ?></a>
            <?php endif; ?>
        </p>

    <?php else : ?>
        <div class="order-overview-wrap">

            <h3>
                <?php
                    echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you for your purchase.', 'woocommerce' ), $order );
                    printf( '<span>%s</span>', esc_html__( 'Below are your Order Details', 'woocommerce' ) );
                ?>
            </h3>

            <ul class="order_details">
                <li class="order">
                    <?php esc_html_e( 'Order Number:', 'woocommerce' ); ?>
                    <strong><?php printf( $order->get_order_number() ); ?></strong>
                </li>
                <li class="date">
                    <?php esc_html_e( 'Date:', 'woocommerce' ); ?>
                    <strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
                </li>
                <li class="total">
                    <?php esc_html_e( 'Total:', 'woocommerce' ); ?>
                    <strong><?php printf( $order->get_formatted_order_total() ); ?></strong>
                </li>
                <?php if ( $order->payment_method_title ) : ?>
                    <li class="method">
                        <?php esc_html_e( 'Payment Method:', 'woocommerce' ); ?>
                        <strong><?php printf( $order->payment_method_title ); ?></strong>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="clear"></div>
        </div>

    <?php endif; ?>

    <?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
    <?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

    <h3><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you for your purchase.', 'woocommerce' ), null ); ?></h3>

<?php endif; ?>
