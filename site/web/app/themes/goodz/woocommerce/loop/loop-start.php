<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 *
 * @themeskingdom
 */

// Get Customizer settings
$shop_layout = get_theme_mod( 'layout_type_setting', 'regular' );

?>


<div class="products">
	<div class="row">
		<?php if ( $shop_layout == 'masonry' ) : ?>
		        <div class="grid-wrapper clear">
		<?php endif; ?>