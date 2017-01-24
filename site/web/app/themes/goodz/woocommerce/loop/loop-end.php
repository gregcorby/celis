<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 *
 * @themeskingdom
 */

// Get Customizer settings
$shop_layout = get_theme_mod( 'layout_type_setting', 'regular' );
$paging_type = get_theme_mod( 'shop_paging_setting', 'standard_paging' );

?>
		<?php if ( $shop_layout == 'masonry' ) : ?>
		        </div><!-- .grid-wrapper -->
		<?php endif; ?>
	</div><!-- .row -->

	<?php

		if ( 'infinite_scroll' == $paging_type ) :
			goodz_is_posts_navigation();
		endif;

	?>

</div><!-- .products -->

