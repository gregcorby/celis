<?php
	
	/* Helper Functions
	=============================================================== */
	
	global $nm_woocommerce_enabled;
	$nm_woocommerce_enabled = ( class_exists( 'WooCommerce' ) ) ? true : false;
	
	
	/* Check if WooCommerce is activated */
	function nm_woocommerce_activated() {
		/*if ( class_exists( 'WooCommerce' ) ) { return true; }
		return false;*/
		global $nm_woocommerce_enabled;
		return $nm_woocommerce_enabled;
	}
	
	
	/* Check if current request is made via AJAX */
	function nm_is_ajax_request() {
		if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
			return true;
		}
			
		return false;
	}
	
	
	/* Check if the current page is a WooCommmerce page */
	function nm_is_woocommerce_page() {
		// Alt. methhod:
		/*if ( is_woocommerce() ) {
			return true;
		}
		
		$page_id = get_the_ID();
		$woocommerce_keys = array ( 
			'woocommerce_shop_page_id',
			'woocommerce_terms_page_id',
			'woocommerce_cart_page_id',
			'woocommerce_checkout_page_id',
			'woocommerce_pay_page_id',
			'woocommerce_thanks_page_id',
			'woocommerce_myaccount_page_id',
			'woocommerce_edit_address_page_id',
			'woocommerce_view_order_page_id',
			'woocommerce_change_password_page_id',
			'woocommerce_logout_page_id',
			'woocommerce_lost_password_page_id'
		) ;
		
		foreach( $woocommerce_keys as $woocommerce_page_id ) {
			if ( $page_id == get_option( $woocommerce_page_id, 0 ) ) {
				return true;
			}
		}*/
		// Get the current body class
		$body_classes = get_body_class();
		
		foreach( $body_classes as $body_class ) {
			// Check if the class contains the word "woocommrce"
			if ( strpos( $body_class, 'woocommerce' ) !== false ) {
				return true;
			}
		}
		
		return false;
	}
	
	
	/* Add page include slug */
	function nm_add_page_include( $slug ) {
		global $nm_page_includes;
		$nm_page_includes[$slug] = true;
	}
	
	
	/* Get post categories */
	function nm_get_post_categories() {
		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);
		
		$categories = get_categories( $args );
		
		$return = array( 'All' => '' );
		
		foreach( $categories as $category ) { 
			$return[htmlspecialchars_decode( $category->name )] = $category->slug;
		}
		
		return $return;
	};
	
	
	/* Get social media profiles list */
	if ( ! function_exists( 'nm_get_social_profiles' ) ) {
		function nm_get_social_profiles( $wrapper_class = 'nm-social-profiles-list' ) {
			global $nm_theme_options;
			
			$social_profiles = apply_filters( 'nm_social_profiles', array(
				'facebook'		=> array( 'title' => 'Facebook', 'url' => $nm_theme_options['social_media_facebook'], 'icon' => 'nm-font nm-font-facebook' ),
				'instagram'		=> array( 'title' => 'Instagram', 'url' => $nm_theme_options['social_media_instagram'], 'icon' => 'nm-font nm-font-instagram' ),
				'twitter'		=> array( 'title' => 'Twitter', 'url' => $nm_theme_options['social_media_twitter'], 'icon' => 'nm-font nm-font-twitter' ),
				'google-plus'   => array( 'title' => 'Google+', 'url' => $nm_theme_options['social_media_googleplus'], 'icon' => 'nm-font nm-font-google-plus' ),
                'flickr'		=> array( 'title' => 'Flickr', 'url' => $nm_theme_options['social_media_flickr'], 'icon' => 'nm-font nm-font-flickr' ),
				'linkedin'		=> array( 'title' => 'LinkedIn', 'url' => $nm_theme_options['social_media_linkedin'], 'icon' => 'nm-font nm-font-linkedin' ),
				'pinterest'		=> array( 'title' => 'Pinterest', 'url' => $nm_theme_options['social_media_pinterest'], 'icon' => 'nm-font nm-font-pinterest' ),
                'rss'	        => array( 'title' => 'RSS', 'url' => $nm_theme_options['social_media_rss'], 'icon' => 'nm-font nm-font-rss-square' ),
                'snapchat'      => array( 'title' => 'Snapchat', 'url' => $nm_theme_options['social_media_snapchat'], 'icon' => 'nm-font nm-font-snapchat-ghost' ),
                'behance'		=> array( 'title' => 'Behance', 'url' => $nm_theme_options['social_media_behance'], 'icon' => 'nm-font nm-font-behance' ),
				'tumblr'	    => array( 'title' => 'Tumblr', 'url' => $nm_theme_options['social_media_tumblr'], 'icon' => 'nm-font nm-font-tumblr' ),
				'vimeo'	        => array( 'title' => 'Vimeo', 'url' => $nm_theme_options['social_media_vimeo'], 'icon' => 'nm-font nm-font-vimeo-square' ),
				'vk'			=> array( 'title' => 'VK', 'url' => $nm_theme_options['social_media_vk'], 'icon' => 'nm-font nm-font-vk' ),
				'weibo'			=> array( 'title' => 'Weibo', 'url' => $nm_theme_options['social_media_weibo'], 'icon' => 'nm-font nm-font-weibo' ),
				'youtube'		=> array( 'title' => 'YouTube', 'url' => $nm_theme_options['social_media_youtube'], 'icon' => 'nm-font nm-font-youtube' )
			) );
			
			$output = '';
			foreach ( $social_profiles as $service => $details ) {
				if ( $details['url'] !== '' ) {
					$output .= '<li><a href="' . esc_url( $details['url'] ) . '" target="_blank" title="' . esc_attr( $details['title'] ) . '"><i class="' . esc_attr( $details['icon'] ) . '"></i></a></li>';
				}
			}
			
			return '<ul class="' . $wrapper_class . '">' . $output . '</ul>';
		}
	}
	