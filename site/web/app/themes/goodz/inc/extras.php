<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Goodz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function goodz_body_classes( $classes ) {
	// Get global layout setting
	$global_layout = get_theme_mod( 'archive_layout_setting', 'boxed' );
	$single_layout = get_theme_mod( 'single_layout_setting', 'boxed' );
	$sticky_header = get_theme_mod( 'sticky_header_setting', 0 );
	$slider_width  = get_theme_mod( 'featured_slider_width', 0 );
    $slider_enable = get_theme_mod( 'featured_slider_enable', 0 );
    $front_slider  = get_theme_mod( 'front_page_slider_enable', 1 );

    if ( goodz_is_woocommerce_activated() && is_woocommerce() ) {

        return $classes;

    } else {

    	if ( is_single() ) {

        	$classes[] = $single_layout . '-single';

        } else {

        	if ( ! is_page() ) {
    			$classes[] = $global_layout . '-blog';
    		}

        }

    	if ( is_home() ) {

            if ( $slider_enable && 'yes' == $slider_width ) {
    			$classes[] = 'featured-slider-fullwidth';
    		}

    	}

        if ( is_page_template( 'templates/template-front-page.php' ) ) {

            if ( $front_slider ) {
                $classes[] = 'home-slider-enabled';
            }

        }

    	// Adds a class of group-blog to blogs with more than 1 published author.
    	if ( is_multi_author() ) {

    		$classes[] = 'group-blog';

        }

        return $classes;

    }

}
add_filter( 'body_class', 'goodz_body_classes' );

/**
 * Filter content column classes
 *
 * @since goodz magazine 1.0
 */
function goodz_content_cols() {

    if ( goodz_is_woocommerce_activated() ) {
        if ( is_cart() || is_checkout() || goodz_is_page( 'woocommerce-account' ) || goodz_is_page( 'woocommerce-wishlist' ) ) {
            return;
        }
    }

	// Primary container classes
	$cols = 'col-lg-12';

	// Get global layout setting
	$global_layout = get_theme_mod( 'archive_layout_setting', 'boxed' );

	if ( is_active_sidebar( 'sidebar-1' ) ) {

		if ( 'fullwidth' == $global_layout && ( is_archive() || is_home() ) ) {
			$cols = 'col-lg-10 col-md-9 has-sidebar';
		}
		else {
			$cols = 'col-md-9 has-sidebar';
		}
	}
    else {
        $cols = 'col-sm-12';
    }

	if ( is_single() ) {
		// Container classes relevant to sidebar
		$cols = 'no-sidebar';

		if ( is_active_sidebar( 'sidebar-1' ) ) {
		    $cols = 'has-sidebar';
		}
	}

	echo esc_attr( $cols );
}

/**
 * Check if page is WooCommerce my account
 */
function goodz_is_page( $class ) {

    $classes = get_body_class();

    // Check if class exists in body tag
    if ( is_array( $classes ) ) {

        if ( in_array( $class, $classes ) ){
            return true;

        } else {

            return false;

        }

    } else {

        return false;

    }

}

/**
 * Filter sidebar column classes
 *
 * @since goodz magazine 1.0
 */
function goodz_sidebar_cols() {

	// Get global layout setting
	$global_layout = get_theme_mod( 'archive_layout_setting', 'boxed' );

	if ( is_active_sidebar( 'sidebar-1' ) && ( goodz_is_woocommerce_activated() && !is_cart() && !is_checkout() ) && !goodz_is_page( 'woocommerce-account' ) && !goodz_is_page( 'woocommerce-wishlist' ) ) {

        if ( 'fullwidth' == $global_layout && ( is_archive() || is_home() ) ) {
            $cols = 'col-lg-2 col-md-3';
        }
        else {
            $cols = 'col-md-3';
        }

	}
	else {
		$cols = 'col-md-3';
	}

	echo esc_attr( $cols );
}

/**
 * Filter post_class() additional classes
 *
 * @since goodz magazine 1.0
 */
function goodz_post_classes( $classes, $class, $post_id ) {
	// Get global layout setting
	$global_layout     = get_theme_mod( 'archive_layout_setting', 'boxed' );
	$two_column_layout = get_theme_mod( 'two_columns_layout_setting', 0 );

	if ( ! is_single() ) :

		// If global layout is set to boxed
		if ( 'boxed' == $global_layout && 'product' != get_post_type() ) {
		    if ( is_sticky() ) {
		    	if ( $two_column_layout ) {
		    		$classes[] = 'col-sm-6';
		    	}
		    	else {
		    		if ( is_active_sidebar( 'sidebar-1' ) ) {
		    			$classes[] = 'col-sm-12';
		    		}
		    		else {
		    			$classes[] = 'col-lg-8 col-sm-12';
		    		}
		    	}
			}
			else {
				if ( $two_column_layout ) {
					$classes[] = 'col-sm-6';
				}
				else {
					if ( is_active_sidebar( 'sidebar-1' ) ) {
						$classes[] = 'col-sm-6';
					}
					else {
						$classes[] = 'col-lg-4 col-sm-6';
					}
				}
			}
		}
		else if ( 'fullwidth' == $global_layout && 'product' != get_post_type() ) {
			if ( is_sticky() ) {
				if ( $two_column_layout ) {
					$classes[] = 'col-sm-6';
				}
				else {
					if ( is_active_sidebar( 'sidebar-1' ) ) {
						$classes[] = 'col-lg-8 col-sm-12';
					}
					else {
						$classes[] = 'col-lg-6 col-sm-12';
					}
				}
			}
			else {
				if ( $two_column_layout ) {
					$classes[] = 'col-sm-6';
				}
				else {
					if ( is_active_sidebar( 'sidebar-1' ) ) {
                        $classes[] = 'col-lg-4 col-sm-6';
					}
					else {
                        $classes[] = 'col-lg-3 col-sm-6';
					}
				}
			}
		}

	endif;

	return $classes;

}
add_filter( 'post_class', 'goodz_post_classes', 10, 3 );

/**
 * Widget tag cloud font size update
 *
 * @since  goodz magazine 1.0
 */
function goodz_widget_tag_cloud_args( $args ) {
	$args['largest']  = 14;
	$args['smallest'] = 14;
	$args['unit']     = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'goodz_widget_tag_cloud_args' );

/**
 * Check for embed content in post and extract
 *
 * @since goodz magazine 1.0
 */
function goodz_get_embed_media() {
    $content = get_the_content();
    $embeds  = get_media_embedded_in_content( $content );

    if ( !empty( $embeds ) ) {
        //check what is the first embed containg video tag, youtube or vimeo
        foreach( $embeds as $embed ) {
            if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
                return $embed;
            }
        }
    } else {
        //No video embedded found
        return false;
    }
}

/**
 * Add Read More to post excerpt
 *
 * @since  Goodz 1.0
 */
function new_excerpt_more( $excerpt ) {
	return $excerpt .' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read more', 'goodz' ) . '</a>';
}
add_filter( 'the_excerpt', 'new_excerpt_more' );

/**
 * Extract image from video
 */
function goodz_get_video_image( $url, $post_ID, $img_quality ) {

    require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

    if ( !empty( $url ) ) {
        $key_str1    = 'youtube';
        $key_str2    = 'vimeo';
        $pos_youtube = strpos( $url, $key_str1 );
        $pos_vimeo   = strpos( $url, $key_str2 );

        if ( !empty( $pos_youtube ) ) {
            $url      = str_replace( 'watch?v=', '', $url );
            $url      = explode( '&', $url );
            $url      = $url[0];
            $protocol = substr( $url, 0, 5 );

            if ( $protocol == "http:" ) {
                $url      = str_replace( 'http://www.youtube.com/', '', $url );
                $protocol_new = "http://";
            }
            if ( $protocol == "https" ) {
                $url      = str_replace( 'https://www.youtube.com/', '', $url );
                $protocol_new = "https://";
            }

            if ( empty( $img_quality ) ) {
                $img_quality = 2;
            }

            $video_image_url = $protocol_new . 'img.youtube.com/vi/'. $url . '/hqdefault.jpg';

            if ( !has_post_thumbnail( $post_ID ) ) {
                $url = $video_image_url;
                $tmp = download_url( $url );

                if( is_wp_error( $tmp ) ){
                    // download failed, handle error
                }

                $post_id    = $post_ID;
                $desc       = get_the_title();
                $file_array = array();

                // Set variables for storage
                // fix file filename for query strings
                preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
                $file_array['name']     = basename( $matches[0] );
                $file_array['tmp_name'] = $tmp;

                // If error storing temporarily, unlink
                if ( is_wp_error( $tmp ) ) {
                    @unlink( $file_array['tmp_name'] );
                    $file_array['tmp_name'] = '';
                }

                // do the validation and storage stuff
                $id = media_handle_sideload( $file_array, $post_id, $desc );

                // If error storing permanently, unlink
                if ( is_wp_error( $id ) ) {
                    @unlink( $file_array['tmp_name'] );
                    return $id;
                }

                set_post_thumbnail( $post_ID, $id );

            }

            $video_image = get_the_post_thumbnail( $post_ID, 'goodz-video-featured-image' );

        }
        elseif ( !empty( $pos_vimeo ) ) {

            $urlParts = explode( "/", parse_url( $url, PHP_URL_PATH ) );
            $videoId  = (int) $urlParts[count($urlParts)-1 ];
            $data     = wp_remote_get( "http://vimeo.com/api/v2/video/" . $videoId . ".json" );

            if ( !is_wp_error( $data ) && is_array( $data ) ) {
                $data  = wp_remote_get( "http://vimeo.com/api/v2/video/" . $videoId . ".json" );
                $data  = json_decode( wp_remote_retrieve_body( $data ), true );
                $image = $data[0]['thumbnail_large'];

                if ( !has_post_thumbnail( $post_ID ) ) {
                    $url = $image;
                    $tmp = download_url( $url );

                    if( is_wp_error( $tmp ) ){
                        // download failed, handle error
                    }

                    $post_id    = $post_ID;
                    $desc       = get_the_title();
                    $file_array = array();

                    // Set variables for storage
                    // fix file filename for query strings
                    preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
                    $file_array['name']     = basename( $matches[0] );
                    $file_array['tmp_name'] = $tmp;

                    // If error storing temporarily, unlink
                    if ( is_wp_error( $tmp ) ) {
                        @unlink( $file_array['tmp_name'] );
                        $file_array['tmp_name'] = '';
                    }

                    // do the validation and storage stuff
                    $id = media_handle_sideload( $file_array, $post_id, $desc );

                    // If error storing permanently, unlink
                    if ( is_wp_error( $id ) ) {
                        @unlink( $file_array['tmp_name'] );
                        return $id;
                    }

                    set_post_thumbnail( $post_ID, $id );

                }

                $video_image = get_the_post_thumbnail( $post_ID, 'goodz-video-featured-image' );

            }
        }
        else {

            $video_image = esc_html__( 'Video only allowes vimeo and youtube!', 'goodz' );
        }

        return $video_image;
    }
}

/**
 * Get Instagram Images Feed
 *
 * @since Goodz 1.0
 */
function goodz_get_instagram_feed() {

    $username     = get_theme_mod( 'front_page_instagram_username' );
    $blog_section = get_theme_mod( 'front_page_blog_enable' );

    if ( $blog_section ) {
        $limit       = 3;
        $first_class = 'col-sm-4';
    }
    else {
        $limit = 6;
        $first_class = 'col-sm-2';
    }

    $target = '_blank';
    $link   = '@' . $username;

    if ( $username != '' ) {

        $media_array = goodz_scrape_instagram( $username, $limit );

        if ( is_wp_error( $media_array ) ) {

            echo esc_html( $media_array->get_error_message() );

        } else {

            // filter for images only?
            if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
                $media_array = array_filter( $media_array, 'images_only' );

            $ulclass  = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-large row' );
            $liclass  = apply_filters( 'wpiw_item_class', '' );
            $aclass   = apply_filters( 'wpiw_a_class', '' );
            $imgclass = apply_filters( 'wpiw_img_class', '' );

            ?>

            <ul class="<?php echo esc_attr( $ulclass ); ?>">
                <?php
                    foreach ( $media_array as $item ) {
                        echo '<li class="' . $first_class . ' '. $liclass .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. $aclass .'"><img src="'. esc_url( $item['large'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. $imgclass .'"/></a></li>';
                    }
                ?>
            </ul>
            <?php
        }
    }

    else {
        return esc_html_e( 'Please enter Instagram username to display feed.', 'goodz' );
    }

    if ( $link != '' ) {

?>

        <p class="clear">
            <a href="//instagram.com/<?php echo esc_attr( trim( $username ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>">
                <?php echo esc_html( $link ); ?>
            </a>
            <span class="secondary-font"><?php esc_html_e( 'Instagram', 'goodz' ); ?></span>
        </p>

<?php

    }
}

function goodz_scrape_instagram( $username, $slice = 9 ) {

    $username = strtolower( $username );

    if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {

        $remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

        if ( is_wp_error( $remote ) )
            return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'goodz' ) );

        if ( 200 != wp_remote_retrieve_response_code( $remote ) )
            return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'goodz' ) );

        $shards      = explode( 'window._sharedData = ', $remote['body'] );
        $insta_json  = explode( ';</script>', $shards[1] );
        $insta_array = json_decode( $insta_json[0], TRUE );

        if ( !$insta_array )
            return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'goodz' ) );

        // old style
        if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
            $images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
            $type = 'old';
        // new style
        } else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
            $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            $type = 'new';
        } else {
            return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'goodz' ) );
        }

        if ( !is_array( $images ) )
            return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'goodz' ) );

        $instagram = array();

        foreach ( $images as $image ) {

            $image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
            $image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

            // handle both types of CDN url
            if ( (strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
                $image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
                $image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
            } else {
                $urlparts = wp_parse_url( $image['thumbnail_src'] );
                $pathparts = explode( '/', $urlparts['path'] );
                $pathparts[3] = 's160x160';
                $image['thumbnail'] = '//' . $urlparts['host'] . implode('/', $pathparts);
                $pathparts[3] = 's320x320';
                $image['small'] = '//' . $urlparts['host'] . implode('/', $pathparts);
            }

            $image['large'] = $image['thumbnail_src'];

            if ( $image['is_video'] == true ) {
                $type = 'video';
            } else {
                $type = 'image';
            }

            $caption = esc_html__( 'Instagram Image', 'goodz' );
            if ( ! empty( $image['caption'] ) ) {
                $caption = $image['caption'];
            }

            $instagram[] = array(
                'description'   => $caption,
                'link'          => '//instagram.com/p/' . $image['code'],
                'time'          => $image['date'],
                'comments'      => $image['comments']['count'],
                'likes'         => $image['likes']['count'],
                'thumbnail'     => $image['thumbnail'],
                'small'         => $image['small'],
                'large'         => $image['large'],
                'original'      => $image['display_src'],
                'type'          => $type
            );
        }

        // do not set an empty transient - should help catch private or empty accounts
        if ( ! empty( $instagram ) ) {

            $instagram = utf8_encode( serialize( $instagram ) );
            set_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );

        }
    }

    if ( ! empty( $instagram ) ) {

        $instagram = unserialize( utf8_decode( $instagram ) );
        return array_slice( $instagram, 0, $slice );

    } else {

        return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'goodz' ) );

    }
}

/**
 * Remove website vrom comment form
 *
 * @since Goodz 1.0
 */
function goodz_disable_comment_url( $fields ) {
    unset( $fields['url'] );
    return $fields;
}
add_filter( 'comment_form_default_fields', 'goodz_disable_comment_url' );

/**
 * Set maximum width of images for responsive images feature
 *
 * @since Goodz 1.0
 */
function goodz_m_max_srcset_image_width( $max_width, $size_array ) {
    $width = $size_array[0];

    if ( $width > 600 ) {
        $max_width = 2048;
    }

    return $max_width;
}
add_filter( 'max_srcset_image_width', 'goodz_m_max_srcset_image_width', 10, 2 );

/**
 * If is Front Page Template
 *
 * @since  Goodz 1.0
 */
function goodz_is_front_template() {
    return is_page_template( 'templates/template-front-page.php' );
}

/**
 * Check if WooCommerce is activated
 *
 * @since Goodz 1.0
 */
if ( ! function_exists( 'goodz_is_woocommerce_activated' ) ) {
    function goodz_is_woocommerce_activated() {
        return class_exists( 'woocommerce' ) ? true : false;
    }
}

/**
 * Send Mail Contact Form
 */

function goodz_magazine_send_contact_email() {

    $nonce   = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
        die ( esc_html__( 'You are not alowed to do this!', 'goodz' ) );
    }

    // Get our variables and data
    $captcha_option   = get_theme_mod( 'goodz_contact_contact_captcha_setting' );
    $name             = $_POST['sender_name'];
    $email            = $_POST['sender_email'];
    $message          = $_POST['sender_message'];
    $message_info     = $_POST['message_info'];
    $validation_error = false;

    // Validation
    if ( strlen( $name ) < 2 ) {
        esc_html_e( 'Please enter your name!', 'goodz' );
        $validation_error = true;
        die();
    }
    elseif ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        esc_html_e( 'Please enter your email!', 'goodz' );
        $validation_error = true;
        die();
    }
    elseif ( strlen( $message ) < 2  ) {
        esc_html_e( 'Please enter your message!', 'goodz' );
        $validation_error = true;
        die();
    }
    elseif ( $captcha_option ) {
        // Start our session
        session_start();

        $captcha = $_POST['sender_captcha'];
        if ( empty( $_SESSION['captcha'] ) || strtolower( trim( $captcha ) ) != $_SESSION['captcha'] ) {
            esc_html_e( 'Invalid text from image!', 'goodz' );
            $validation_error = true;
            die();
        }
    }
    else {
        $validation_error = false;
    }

    if ( ! $validation_error ) {

        $to = get_theme_mod( 'goodz_contact_contact_mail_address', get_option( 'admin_email' ) );

        if ( '' == $to ) {
            $to = get_option( 'admin_email' );
        }

        $subject = esc_html__( 'Message from ', 'goodz' ) . get_bloginfo( 'name' );

        $headers = 'From: ' . $email . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";

        $sitename = get_bloginfo( 'name' );

        $body = esc_html__( 'You received e-mail from ', 'goodz' ) . $name . '  [' . $email . '] ' . esc_html__( ' using ', 'goodz' ) . $sitename . "\n\n\n";
        $body .= esc_html__( 'The message:', 'goodz' ) . "\n\n" . $message;

        $send = wp_mail( $to, $subject, $body, $headers );

        if ( $send ) {
            echo esc_html( $message_info );
        }
        else {

            esc_html_e( 'Message not sent!', 'goodz' );

        }
    }

    die();
}
add_action( 'wp_ajax_nopriv_send_contact_email', 'goodz_magazine_send_contact_email' );
add_action( 'wp_ajax_send_contact_email', 'goodz_magazine_send_contact_email' );

/**
 * Exclude Category from Blog if slider and category enabled
 *
 * Alters main query to get wanted results
 */
function goodz_exclude_category_from_blog( $query ) {

    // Get Featured Slider settings
    $featured_slider     = get_theme_mod( 'featured_slider_enable', 0 );
    $featured_category   = get_theme_mod( 'featured_category_select', 'default' );
    $featured_slider_cat = get_theme_mod( 'featured_slider_cat_exclude', 0 );

    if ( $featured_slider && $featured_slider_cat ) :

        if ( $query->is_main_query() && $query->is_home() ) {

            if ( 'default' != $featured_category ) {

                $category_exclude    = get_category_by_slug( $featured_category );
                $category_exclude_id = $category_exclude->term_id;

                $query->set( 'category__not_in', array( $category_exclude_id ) );
            }

        }

    endif;

    if ( $query->is_main_query() && $query->is_home() ) {
        if ( $query->is_paged() ) {
            $query->set( 'ignore_sticky_posts', 1 );
        }
    }

}
add_action( 'pre_get_posts', 'goodz_exclude_category_from_blog' );
