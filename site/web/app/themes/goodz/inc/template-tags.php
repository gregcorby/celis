<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Goodz
 */

function goodz_is_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation is posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'goodz' ); ?></h2>
		<div id="infinite-handle" class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( esc_html__( 'Load More', 'goodz' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<div id="loading-is"></div>

	<?php
}

/**
 * Displays posts navigation on bottom of single post page
 */
function goodz_posts_navigation() {
	$navigation    = '';

	$previous_links_text = esc_html__( 'Older posts', 'goodz' );
	$next_links_text     = esc_html__( 'Newer posts', 'goodz' );
	$previous_link       = get_next_posts_link( $previous_links_text );
	$next_link           = get_previous_posts_link( $next_links_text  );

	$navigation .= $previous_link . '' . $next_link;

	echo _navigation_markup( $navigation );
}

/**
 * Displays posts navigation on bottom of single post page
 */
function goodz_post_navigation() {
	$navigation    = '';
	$previous_link = get_previous_post();
	$next_link     = get_next_post();

	// Only add markup if there's somewhere to navigate to.
	if ( $previous_link ) {
		$navigation .= '<a href="' . get_permalink( $previous_link ) . '" class="nav-previous"><i class="icon-arrow"></i><span>' . esc_html__( 'Previous post', 'goodz' ) . '</span>' . $previous_link->post_title . '</a>';
	}
	if ( $next_link ) {
		$navigation .= '<a href="' . get_permalink( $next_link ) . '" class="nav-next"><i class="icon-arrow"></i><span>' . esc_html__( 'Next post', 'goodz' ) . '</span>' . $next_link->post_title . '</a>';
	}

	return _navigation_markup( $navigation );
}


if ( ! function_exists( 'goodz_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function goodz_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	if ( goodz_is_front_template() ) {
		the_category( ', ' );
	}
	else {

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'goodz' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'goodz' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Comments', 'goodz' ), esc_html__( '1 Comment', 'goodz' ), esc_html__( '% Comments', 'goodz' ) );
			echo '</span>';
		}
	}

	if ( is_single() ) {
		edit_post_link( esc_html__( 'Edit', 'goodz' ), '<span class="edit-link">', '</span>' );
	}

}
endif;

if ( ! function_exists( 'goodz_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function goodz_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', '&nbsp;' );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'goodz' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

}
endif;

if ( ! function_exists( 'goodz_entry_header' ) ) :
/**
 * Prints Categories above title
 */
function goodz_entry_header() {

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( ', ' );

	if ( 'link' == get_post_format() ) {
		printf( '<span class="cat-links">%1$s%2$s</span>', esc_html__( 'Link', 'goodz' ), edit_post_link( esc_html__( 'Edit', 'goodz' ), '<span class="edit-link">', '</span>' ) );
	}
	elseif ( 'quote' == get_post_format() ) {
		printf( '<span class="cat-links">%1$s%2$s</span>', esc_html__( 'Quote', 'goodz' ), edit_post_link( esc_html__( 'Edit', 'goodz' ), '<span class="edit-link">', '</span>' ) );
	}
	else {
		if ( $categories_list && goodz_categorized_blog() ) {
			printf( '<span class="cat-links">%1$s%2$s</span>', $categories_list, edit_post_link( esc_html__( 'Edit', 'goodz' ), '<span class="edit-link">', '</span>' ) ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function goodz_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span>' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'goodz' ) ) . '</span>' );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span>' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'goodz' ) ) . '</span>' );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), '<span>' . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'goodz' ) ) . '</span>' );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'goodz' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'goodz' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( '%s', 'goodz' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: <span>%2$s</span>', 'goodz' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'goodz' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		printf( $before . $title . $after );  // WPCS: XSS OK.
	}
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function goodz_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'goodz_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'goodz_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so goodz_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so goodz_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in goodz_categorized_blog.
 */
function goodz_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'goodz_categories' );
}
add_action( 'edit_category', 'goodz_category_transient_flusher' );
add_action( 'save_post',     'goodz_category_transient_flusher' );

/**
 * Featured Posts Slider display
 */

function goodz_featured_posts_slider() {

	// Get Featured Slider settings
	$featured_slider       = get_theme_mod( 'featured_slider_enable', 0 );
	$featured_category     = get_theme_mod( 'featured_category_select', 'default' );
	$featured_posts_number = get_theme_mod( 'featured_posts_number', 6 );

	if ( ! $featured_slider ) :
		return;
	else : ?>

		<!-- Featured slider -->
		<div class="featured-slider-wrap">
			<div class="featured-slider">

				<?php

					if ( 'default' != $featured_category ) {
						$args = array(
							'post_type'      => 'post',
							'posts_per_page' => $featured_posts_number,
							'category_name'  => $featured_category
						);
					}
					else {
						$args = array(
							'post_type'      => 'post',
							'posts_per_page' => $featured_posts_number
						);
					}

					$featured_posts = new WP_Query( $args );

					if ( $featured_posts->have_posts() ) :

						while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
							get_template_part( 'templates/contents/content', 'slider' );
						endwhile;

					endif;

					wp_reset_postdata();

				?>

			</div><!-- .featured-slider -->
		</div>
		<div class="slider-preloader">
			<div class="preloader-content">
				<?php

					$logo = get_theme_mod( 'goodz_logo_setting' );

					if ( $logo ) :
						printf( '<img src="%s" alt="website logo" />', esc_url( $logo ) );
					else :
						printf( '<p>%s</p>', esc_html__( 'Loading', 'goodz' ) );
					endif;

				?>
			</div>
		</div>

	<?php

	endif;

}


/**
 * Get latest posts for slider if no category selected
 * @return array of post ids
 */
function goodz_get_latest_posts() {
	$featured_posts_number = get_theme_mod( 'featured_posts_number', 6 );

	$args = array(
			'posts_per_page' => $featured_posts_number
		);

	$slider_posts      = get_posts( $args );
	$posts_not_display = array();

	foreach ( $slider_posts as $post ) :
		$posts_not_display[] = $post->ID;
	endforeach;

	return $posts_not_display;
}

/**
 * Displays post featured image
 */
function goodz_featured_image( $thumb_size = 'goodz-archive-featured-image' ) {

	if ( has_post_thumbnail() ) :

		if ( is_single() && 'goodz-related-post' != $thumb_size || goodz_is_front_template() ) { ?>

			<figure class="featured-image">
				<?php the_post_thumbnail( 'goodz-single-featured-image' ); ?>
			</figure>

		<?php } else { ?>

			<?php

				if ( is_sticky() ) {
					$thumb_size = 'goodz-sticky-featured-image';
				}

			?>

			<figure class="featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
			</figure>

		<?php }

	else :

		return;

	endif;

}

/**
 * Displays post featured image
 */
function goodz_featured_media() {

	if ( 'gallery' == get_post_format() ) :

		$gallery_images = get_post_meta( get_the_ID(), 'goodz_repeatable', true );

        if ( $gallery_images ) { ?>

            <div class="entry-gallery">

            	<div class="gallery gallery-size-full">
	            	<?php foreach( $gallery_images as $gallery_image ) : ?>
	            		<img src="<?php echo esc_url( $gallery_image ); ?> " alt="Gallery image">
	            	<?php endforeach; ?>
            	</div>

            </div><!-- .entry-gallery -->

			<?php if ( is_single() ) : ?>

	            <div class="slider-preloader">
					<div class="preloader-content">

						<?php

							$logo = get_theme_mod( 'goodz_logo_setting' );

							if ( $logo ) :
								printf( '<img src="%s" alt="website logo" />', esc_url( $logo ) );
							else :
								printf( '<p>%s</p>', esc_html__( 'Loading', 'goodz' ) );
							endif;

						?>

					</div>
				</div>

			<?php endif; ?>

		<?php } else {

			goodz_featured_image();

		}

	elseif ( 'video' == get_post_format() ) :

		$video_link = get_post_meta( get_the_ID(), 'goodz_video_link', true );

        if ( $video_link ) {

			$video_image = goodz_get_video_image( $video_link, get_the_ID(), 2 );

		?>
            <div class="entry-video">

                <?php if ( !is_single() && isset( $video_image ) ) : ?>

					<figure class="featured-image video-image">
						<a href="<?php echo esc_url( $video_link ); ?>" class="fancybox">
							<?php echo sprintf( $video_image ); ?>
						</a>
					</figure>

				<?php else : ?>

					<figure class="featured-image scalable-wrapper">
						<?php echo goodz_video_player( $video_link ); ?>
					</figure>

				<?php endif; ?>

            </div><!-- .entry-video -->

        <?php } else {

            goodz_featured_image();

        }

	else :

		goodz_featured_image();

	endif;

}

/**
 * Generates video player for user content post meta
 */

function goodz_video_player( $url ) {

    if ( !empty( $url ) ) {

		$key_str1    = 'youtube';
		$key_str2    = 'vimeo';
		$pos_youtube = strpos( $url, $key_str1 );
		$pos_vimeo   = strpos( $url, $key_str2 );

        if ( !empty( $pos_youtube ) ) {
            $url = str_replace( 'watch?v=', '', $url );
            $url = explode( '&', $url );
            $url = $url[0];
            $protocol = substr( $url, 0, 5 );

            if ( $protocol == "http:" ) {
                $url = str_replace( 'http://www.youtube.com/', '', $url );
            }
            if ( $protocol == "https" ) {
                $url = str_replace( 'https://www.youtube.com/', '', $url );
            }

        	$iframe_video = '<iframe id="youtube-player" class="scalable-element" src="http://www.youtube.com/embed/' . $url . '?enablejsapi=1&rel=0" frameborder="0" allowfullscreen></iframe>';

        }
        elseif ( ! empty( $pos_vimeo ) ) {
            $urlParts = explode( "/", parse_url( $url, PHP_URL_PATH ) );
            $videoId  = (int) $urlParts[count($urlParts)-1 ];
            $iframe_video = '<iframe class="vimeo-video scalable-element" src="http://player.vimeo.com/video/' . $videoId . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
        }
        else {
            $iframe_video = esc_html__( 'Video only allowes vimeo and youtube!', 'goodz' );
        }

        return $iframe_video;
    }
}

/**
 * Dispalys Author Box under single post content
 *
 * @since  goodz-shop 1.0
 */
function goodz_author_box() {

?>

	<section class="author-box">
		<figure class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
		</figure>
		<div class="author-info">
			<h6 class="author-name"><?php the_author(); ?></h6>
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
		</div>
	</section>

<?php
}

if ( ! function_exists( 'goodz_related_posts' ) ) :
	/**
	 * Displays related posts on single post page
	 */
	function goodz_related_posts() {

		$post_id        = get_the_ID();
		$posts_per_page = 3;
		$categories     = get_the_terms( $post_id, 'category' );
		$cats           = array();

		if ( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
				$cats[] = $category->term_id;
			}
			$cats = implode( ',', $cats );

			$args = array(
				'cat'            => $cats,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'post__not_in'   => array( $post_id )
			);

			//Get related posts
			$related_query = new WP_Query( $args );

			// Related posts Loop
			if ( $related_query->have_posts() ) : ?>

				<div id="jp-relatedposts" class="jp-relatedposts">

					<?php printf( '<h3 class="jp-relatedposts-headline">%s</h3>', esc_html__( 'Related Articles', 'goodz' ) ); ?>

					<div class="jp-relatedposts-items jp-relatedposts-items-visual">

						<?php

							while( $related_query->have_posts() ) : $related_query->the_post();

								get_template_part( 'templates/contents/content', 'related' );

							endwhile;

							wp_reset_postdata();

						?>

					</div>
					<!-- .jp-relatedposts-items -->

				</div>
				<!-- .jp-relatedposts -->

				<?php
			endif;

		}
		else {
			return;
		}
	}

endif;

/**
 * Front Page Slider
 *
 * @package Goodz
 */
function goodz_front_slider() {

	$front_slider    = get_theme_mod( 'front_page_slider_enable', 1 );
	$slides_number   = get_theme_mod( 'front_page_slider_slides', 5 );
    $slides_category = get_theme_mod( 'front_page_slider_category', 'default' );

	if ( $front_slider ) :

		if ( 'default' != $slides_category ) {

			$args = array(
				'post_type'      => 'slide',
				'posts_per_page' => $slides_number,
				'tax_query'      => array(
					'relation'   => 'AND',
						array(
							'taxonomy' => 'ct_slider',
							'field'    => 'slug',
							'terms'    => array( $slides_category ),
							'operator' => 'IN'
						),
				)
			);

		}
		else {

			$args = array(
				'post_type'      => 'slide',
				'posts_per_page' => $slides_number,
			);

		}


		$front_slides = new WP_Query( $args );

		if ( $front_slides->have_posts() ) : ?>

			<article class="col-sm-12 home-slider">

				<!-- Slider colors -->
				<style>

				<?php

					while ( $front_slides->have_posts() ) : $front_slides->the_post();

						// Title & Text
						$slide_h_font            	  = get_post_meta( get_the_ID(), 'goodz_slide_headline_size', true );
						$slide_h_font_size 			  = $slide_h_font / 16;
						$slide_desc                   = get_post_meta( get_the_ID(), 'goodz_slide_desc', true );
						$slide_link                   = get_post_meta( get_the_ID(), 'goodz_slide_link', true );
						$slide_h_color                = get_post_meta( get_the_ID(), 'goodz_headline_color', true );
						$slide_txt_color              = get_post_meta( get_the_ID(), 'goodz_text_color', true );
						$slide_txt_align              = get_post_meta( get_the_ID(), 'goodz_slider_text_alignment', true );

						// Button
						$slide_btn_text               = get_post_meta( get_the_ID(), 'goodz_button_text', true );
						$slide_btn_link               = get_post_meta( get_the_ID(), 'goodz_button_link', true );

						// Slider Colors
						$slide_h_color                = get_post_meta( get_the_ID(), 'goodz_headline_color', true );
						$slide_h_hover_color          = get_post_meta( get_the_ID(), 'goodz_headline_hover_color', true );

						// Button
						$slide_btn_bg_color           = get_post_meta( get_the_ID(), 'goodz_button_bg_color', true );
						$slide_btn_bg_hover_color     = get_post_meta( get_the_ID(), 'goodz_button_bg_hover_color', true );
						$slide_btn_txt_color          = get_post_meta( get_the_ID(), 'goodz_button_text_color', true );
						$slide_btn_txt_hover_color    = get_post_meta( get_the_ID(), 'goodz_button_text_hover_color', true );
						$slide_btn_border_color       = get_post_meta( get_the_ID(), 'goodz_button_border_color', true );
						$slide_btn_border_hover_color = get_post_meta( get_the_ID(), 'goodz_button_border_hover_color', true );

					?>

						/* FRONT PAGE TEMPLATE */
					    .fp-slider-headline-<?php echo get_the_ID(); ?> {
					        color: <?php echo esc_attr( $slide_h_color ); ?>;
					        -webkit-transition: color .3s;
						    -moz-transition: color .3s;
						    -ms-transition: color .3s;
						    -o-transition: color .3s;
						    transition: color .3s;
						    font-size: <?php echo esc_attr( $slide_h_font_size ); ?>rem !important;
					    }

					    .fp-slider-headline-<?php echo get_the_ID(); ?>:hover {
					        color: <?php echo esc_attr( $slide_h_hover_color ); ?>;
					    }

						.fp-slider-text-<?php echo get_the_ID(); ?> {
					        color: <?php echo esc_attr( $slide_txt_color ); ?>;
					    }

					    .slider-button-<?php echo get_the_ID(); ?> button {
					        color: <?php echo esc_attr( $slide_btn_txt_color ); ?>;
					        background-color: <?php echo esc_attr( $slide_btn_bg_color ); ?>;
					        border-color: <?php echo esc_attr( $slide_btn_border_color ); ?>;
					    }

					    .slider-button-<?php echo get_the_ID(); ?> button:hover {
					        color: <?php echo esc_attr( $slide_btn_txt_hover_color ); ?>;
					        background-color: <?php echo esc_attr( $slide_btn_bg_hover_color ); ?>;
					        border-color: <?php echo esc_attr( $slide_btn_border_hover_color ); ?>;
					    }

				<?php endwhile; ?>

				</style>

					<ul>

					<?php while ( $front_slides->have_posts() ) : $front_slides->the_post(); ?>

						<li class="<?php echo esc_attr( $slide_txt_align ); ?> verticalize-container" style="background-image: url( <?php the_post_thumbnail_url( 'full' ); ?> )">
							<div class="container verticalize">
								<div class="text-box">

									<?php if ( '' != $slide_link ) { ?>

										<a href="<?php echo esc_url( $slide_link ); ?>">
											<?php the_title( '<h1 class="fp-slider-headline-'. get_the_ID() .'">', '</h1>' ); ?>
										</a>

									<?php } else { ?>

										<?php the_title( '<h1 class="fp-slider-headline-'. get_the_ID() .'">', '</h1>' ); ?>

									<?php } ?>

									<?php

										printf( '<aside class="fp-slider-text-'. get_the_ID() .'">%s</aside>', wpautop( $slide_desc ) );

										if ( '' != $slide_btn_text ) {
											printf( '<a href="%s" class="slider-button slider-button-'. get_the_ID() .'"><button>%s</button></a>', $slide_btn_link, $slide_btn_text );
										}

									?>

								</div>

							</div>
						</li>

					<?php endwhile; ?>

				</ul>

			</article>

		<?php

		else :

			printf( '<div class="no-slides-text"><h3>%s</h3></div>', esc_html__( 'There are no slides to display', 'goodz' ) );

		endif;

		wp_reset_postdata();

	endif; // if slider is enabled

}

/**
 * Call To Action Section
 *
 * @package Goodz
 */
function goodz_call_to_action_section() {

	// Get section settings
	$cta_layout_setting     = get_theme_mod( 'cta_layout_setting', 'two-thirds' );

	// First Box
	$first_bg               = get_theme_mod( 'goodz_first_cta_image' );
	$first_title            = get_theme_mod( 'goodz_first_cta_title' );
	$first_subtitle         = get_theme_mod( 'goodz_first_cta_subtitle' );
	$first_title_pos        = get_theme_mod( 'goodz_first_cta_title_pos' );
	$first_text             = get_theme_mod( 'goodz_first_cta_text' );
	$first_text_pos         = get_theme_mod( 'goodz_first_cta_text_pos' );
	$first_link             = get_theme_mod( 'goodz_first_cta_link' );
	$first_title_sub_color  = get_theme_mod( 'goodz_first_cta_title_color' );
	$first_text_color       = get_theme_mod( 'goodz_first_cta_text_color' );

	// Second Box
	$second_bg              = get_theme_mod( 'goodz_second_cta_image' );
	$second_title           = get_theme_mod( 'goodz_second_cta_title' );
	$second_subtitle        = get_theme_mod( 'goodz_second_cta_subtitle' );
	$second_title_pos       = get_theme_mod( 'goodz_second_cta_title_pos' );
	$second_text            = get_theme_mod( 'goodz_second_cta_text' );
	$second_text_pos        = get_theme_mod( 'goodz_second_cta_text_pos' );
	$second_link            = get_theme_mod( 'goodz_second_cta_link' );
	$second_title_sub_color = get_theme_mod( 'goodz_second_cta_title_color' );
	$second_text_color      = get_theme_mod( 'goodz_second_cta_text_color' );

	// Third Box
	$third_bg              = get_theme_mod( 'goodz_third_cta_image' );
	$third_title           = get_theme_mod( 'goodz_third_cta_title' );
	$third_subtitle        = get_theme_mod( 'goodz_third_cta_subtitle' );
	$third_title_pos       = get_theme_mod( 'goodz_third_cta_title_pos' );
	$third_text            = get_theme_mod( 'goodz_third_cta_text' );
	$third_text_pos        = get_theme_mod( 'goodz_third_cta_text_pos' );
	$third_link            = get_theme_mod( 'goodz_third_cta_link' );
	$third_title_sub_color = get_theme_mod( 'goodz_third_cta_title_color' );
	$third_text_color      = get_theme_mod( 'goodz_third_cta_text_color' );

	$article_class1        = 'col-lg-8 col-md-6 col-sm-12';
	$article_class2        = 'col-lg-4 col-md-6 col-sm-12';


	if ( 'fullwidth' == $cta_layout_setting ) {

		if ( '' != $first_link ) { ?>
			<a href="<?php echo esc_url( $first_link ); ?>">
	<?php

		}

	?>
		<article class="col-sm-12 home-banner" style="background-image: url( <?php echo esc_attr( $first_bg ); ?> );">
			<div class="row">
				<div class="<?php echo esc_attr( $first_title_pos ); ?> col-md-8 col-sm-12">
					<h2 style="color: <?php echo esc_attr( $first_title_sub_color ); ?>"><?php printf( $first_title ); ?></h2>
					<div style="color: <?php echo esc_attr( $first_title_sub_color ); ?>" class="description secondary-font"><?php echo wpautop( $first_subtitle ); ?></div>
				</div>
				<aside style="color: <?php echo esc_attr( $first_text_color ); ?>" class="<?php echo esc_attr( $first_text_pos ); ?> col-md-4"><?php printf( $first_text ); ?><i class="arrow" style="border-left-color: <?php echo esc_attr( $first_text_color ); ?>"></i></aside>
			</div>
		</article>

	<?php

		if ( '' != $first_link ) { ?>
			</a>
	<?php

		}

	}
	else {

		if ( 'two-thirds' == $cta_layout_setting ) {
			$article_class1 = 'col-lg-8 col-md-6 col-sm-12';
			$article_class2 = 'col-lg-4 col-md-6 col-sm-12';
		}
		if ( 'one-third' == $cta_layout_setting ) {
			$article_class1 = 'col-lg-4 col-md-6 col-sm-12';
			$article_class2 = 'col-lg-8 col-md-6 col-sm-12';
		}
		if ( 'one-half' == $cta_layout_setting ) {
			$article_class1 = 'col-md-6 col-sm-12';
			$article_class2 = 'col-md-6 col-sm-12';
		}
		if ( 'three-thirds' == $cta_layout_setting ) {
			$article_class1 = 'col-lg-4 col-md-12 col-sm-12';
			$article_class2 = $article_class3 = 'col-lg-4 col-md-6 col-sm-12';
		}

	?>

		<?php if ( '' != $first_link ) { ?>

			<a href="<?php echo esc_url( $first_link ); ?>">

		<?php } ?>

			<article class="<?php echo esc_attr( $article_class1 ); ?> home-banner" style="background-image: url( <?php echo esc_attr( $first_bg ); ?> );">
				<div class="row">
					<div class="<?php echo esc_attr( $first_title_pos ); ?> col-md-8 col-sm-12">
						<h2 style="color: <?php echo esc_attr( $first_title_sub_color ); ?>"><?php printf( $first_title ); ?></h2>
						<div style="color: <?php echo esc_attr( $first_title_sub_color ); ?>" class="description secondary-font"><?php echo wpautop( $first_subtitle ); ?></div>
					</div>
					<?php if ( '' != $first_text ) { ?>
						<aside style="color: <?php echo esc_attr( $first_text_color ); ?>" class="<?php echo esc_attr( $first_text_pos ); ?> col-md-4"><?php printf( $first_text ); ?><i class="arrow" style="border-left-color: <?php echo esc_attr( $first_text_color ); ?>"></i></aside>
					<?php } ?>
				</div>
			</article>

		<?php if ( '' != $first_link ) { ?>

			</a>

		<?php } ?>


		<?php if ( '' != $second_link ) { ?>

			<a href="<?php echo esc_url( $second_link ); ?>">

		<?php } ?>
			<article class="<?php echo esc_attr( $article_class2 ); ?> home-banner" style="background-image: url( <?php echo esc_attr( $second_bg ); ?> );">
				<div class="row">
					<div class="<?php echo esc_attr( $second_title_pos ); ?> col-md-8 col-sm-12">
						<h2 style="color: <?php echo esc_attr( $second_title_sub_color ); ?>"><?php echo esc_html( $second_title ); ?></h2>
						<div style="color: <?php echo esc_attr( $second_title_sub_color ); ?>" class="description secondary-font"><?php echo wpautop( $second_subtitle ); ?></div>
					</div>
					<?php if ( '' != $second_text ) { ?>
					<aside style="color: <?php echo esc_attr( $second_text_color ); ?>" class="<?php echo esc_attr( $second_text_pos ); ?> col-md-4"><?php printf( $second_text ); ?><i class="arrow" style="border-left-color: <?php echo esc_attr( $second_text_color ); ?>"></i></aside>
					<?php } ?>
				</div>
			</article>

		<?php if ( '' != $second_link ) { ?>

			</a>

		<?php } ?>

		<?php

		// If three columns is selected
		if ( 'three-thirds' == $cta_layout_setting ) { ?>

		<?php if ( '' != $third_link ) { ?>

			<a href="<?php echo esc_url( $third_link ); ?>">

		<?php } ?>

				<article class="<?php echo esc_attr( $article_class3 ); ?> home-banner" style="background-image: url( <?php echo esc_attr( $third_bg ); ?> );">
					<div class="row">
						<div class="<?php echo esc_attr( $third_title_pos ); ?> col-md-8 col-sm-12">
							<h2 style="color: <?php echo esc_attr( $third_title_sub_color ); ?>"><?php printf( $third_title ); ?></h2>
							<div style="color: <?php echo esc_attr( $third_title_sub_color ); ?>" class="description secondary-font"><?php echo wpautop( $third_subtitle ); ?></div>
						</div>
						<?php if ( '' != $third_text ) { ?>
						<aside style="color: <?php echo esc_attr( $third_text_color ); ?>" class="<?php echo esc_attr( $third_text_pos ); ?> col-md-4"><?php printf( $third_text ); ?><i class="arrow" style="border-left-color: <?php echo esc_attr( $third_text_color ); ?>"></i></aside>
						<?php } ?>
					</div>
				</article>

		<?php if ( '' != $third_link ) { ?>

			</a>

		<?php } ?>

	<?php

		}

	}

}

/**
 * Product Categories Section
 *
 * @package Goodz
 */
function goodz_product_categories_section() {

	if ( !goodz_is_woocommerce_activated() ) {
		return;
	}

	// Get section settings
	$product_categories         = get_theme_mod( 'front_page_product_categories_enable', 1 );
	$product_categories_cats    = get_theme_mod( 'product_categories_cat_setting' );
	$product_categories_title   = get_theme_mod( 'front_page_new_section_title', esc_html__( 'Product Categories', 'goodz' ) );
	$product_categories_text    = get_theme_mod( 'front_page_new_section_text', esc_html__( 'Fresh goodz in our store', 'goodz' ) );
	$product_categories_columns = get_theme_mod( 'front_page_product_categories_columns', 0 );

	$columns = 'col-lg-4 col-sm-6';

	if ( $product_categories_columns ) {
		$columns = 'col-sm-6';
	}

	if ( $product_categories ) :

		?>

			<article class="category-box col-sm-12">
				<div class="container">
					<?php if ( $product_categories_title || $product_categories_text ) { ?>
					    <section class="category-info">
				        	<?php if ( $product_categories_title ) { ?>
				            	<?php printf( '<h2 class="new-in-store-title">%s</h2>', $product_categories_title ); ?>
				            <?php } ?>
				            <?php if ( $product_categories_text ) { ?>
				            	<?php printf( '<p class="new-in-store secondary-font">%s</p>', $product_categories_text ); ?>
				        	<?php } ?>
					    </section>
					    <?php } ?><!--
					    --><section class="grid-wrapper">

						<div class="row">
							<div class="grid-sizer <?php echo esc_attr( $columns ); ?>"></div>
							<?php

								if ( !empty( $product_categories_cats ) ) {

									$args = array(
										'include' => $product_categories_cats
									);

									$new_product_cats = get_terms( 'product_cat', $args );

									foreach ( $new_product_cats as $new_cats ) {

										$thumbnail_id = get_woocommerce_term_meta( $new_cats->term_id, 'thumbnail_id', true );
										$image        = wp_get_attachment_url( $thumbnail_id );
								?>
									<figure class="<?php echo esc_attr( $columns ); ?> verticalize-container">
								    	<a href="<?php echo get_term_link( $new_cats, 'product_cat' ); ?>">
									    	<?php if ( '' != $image ) { ?> <img src="<?php echo esc_url( $image ); ?>" ><?php } ?>
								    	 	<h3><?php echo esc_html( $new_cats->name ); ?></h3>
								    	</a>
							    	</figure>
								<?php

									}
								}

							?>
						</div>

				    </section>
				</div>
			</article>

		<?php

	endif;

}

/**
 * Displays Top Selling products section on front page template
 *
 * @return Goodz
 */
function goodz_top_selling_products() {

	if ( !goodz_is_woocommerce_activated() ) {
		return;
	}

	// Get variables
	$top_selling             = get_theme_mod( 'front_page_bestsellers_enable', 1 );
	$top_selling_products_nr = get_theme_mod( 'front_page_bestsellers_number', 5 );

?>

	<?php if ( $top_selling ) : ?>

	    <article class="home-shop-items archive woocommerce standard-view col-sm-12">

	    	<?php

	    		// Get Title and Suptitle
				$top_selling_title     = get_theme_mod( 'front_page_bestsellers_title' );
				$top_selling_sub_title = get_theme_mod( 'front_page_bestsellers_subtitle' );

				// Print Suptitle and Title
				printf( '<h2><span class="secondary-font">%1$s</span>%2$s</h2>', $top_selling_sub_title, $top_selling_title );

		        $args = array(
		            'post_type'      => 'product',
		            'posts_per_page' => $top_selling_products_nr,
		            'meta_key'       => 'total_sales',
		            'orderby'        => 'meta_value_num'
		        );

		        $woo_products = new WP_Query( $args );

		    ?>

		    <?php if ( $woo_products->have_posts() ) : ?>

		        <?php $home_posts_number = $woo_products->post_count; ?>

		        <div class="products container">
		            <div class="slider">
		                <?php
		                    while ( $woo_products->have_posts() ) : $woo_products->the_post();
		                        wc_get_template_part( 'content', 'product' );
		                    endwhile;
		                ?>
		            </div>
		        </div>

		    <?php endif; ?>

		    <?php wp_reset_postdata(); ?>

		</article><!-- .home-shop-items -->

	<?php endif; ?>

<?php

}

/**
 * Front Page Blog Instagram Section
 *
 * @since  Goodz 1.0
 */
function goodz_blog_instagram_section() {

// Get settings
$blog_section      = get_theme_mod( 'front_page_blog_enable', 0 );
$instagram_section = get_theme_mod( 'front_page_instagram_enable', 1 );


	if ( $blog_section || $instagram_section ) : ?>

		<div class="container blog-instagram-feed clear">

			<!-- Blog Section -->

			<?php

				if ( $blog_section ) {

					$blog_category = get_theme_mod( 'front_page_blog_category', 'default' );

					// Set classes
					$blog_class = 'col-md-4 col-sm-6';

					if ( !$instagram_section ) {
						$blog_class = 'col-sm-12';
					}

			?>

					<div class="home-blog-feed <?php echo esc_attr( $blog_class ); ?> clear">

					    <?php

					    	if ( 'default' == $blog_category ) {
						        $args = array(
						            'posts_per_page'      => 6,
						            'ignore_sticky_posts' => 1
						        );
						    }
						    else {
						    	$args = array(
						            'posts_per_page'      => 6,
						            'ignore_sticky_posts' => 1,
						            'category_name'       => $blog_category
						        );
						    }

					        $blog_posts_feed = new WP_Query( $args );

					        if ( $blog_posts_feed->have_posts() ) :

					            while ( $blog_posts_feed->have_posts() ) : $blog_posts_feed->the_post();
					                get_template_part( 'templates/contents/content', get_post_format() );
					            endwhile;

					        endif;

					        wp_reset_postdata();

					    ?>

					</div><!-- .home-blog-feed -->

			<?php } // blog section ?>

			<!-- Instagram Section -->

			<?php

				if ( $instagram_section ) {

					// Set classes
					$insta_class = 'col-md-8 col-sm-6';

					if ( !$blog_section ) {
						$insta_class = 'col-sm-12';
					}

					// Get Instagram Text
					$instagram_text = get_theme_mod( 'front_page_instagram_text' );

			?>

					<article class="home-instagram-feed <?php echo esc_attr( $insta_class ); ?>">

					    <?php goodz_get_instagram_feed(); ?>
					    <?php printf( '<p class="secondary-font">%s</p>', esc_html( $instagram_text ) ); ?>

					</article><!-- .home-instagram-feed -->

			<?php } // instagram section ?>

		</div>

	<?php endif;

}

/**
 * Front Page Brands Section
 *
 * @since  Goodz 1.0
 */
function goodz_brands_section() {

	$brands_category = get_theme_mod( 'front_page_brands_category', 'default' );

	if ( 'default' != $brands_category ) {

		$args = array(
			'post_type'      => 'brand',
			'tax_query'      => array(
				'relation'   => 'AND',
					array(
						'taxonomy' => 'ct_brands',
						'field'    => 'slug',
						'terms'    => array( $slides_category ),
						'operator' => 'IN'
					),
			)
		);

	}
	else {

		$args = array(
			'post_type'      => 'brand',
		    'posts_per_page' => 16
		);

	}

	$brands = new WP_Query( $args );

    if ( $brands->have_posts() ) : ?>

        <div class="brand-banners container clear">
            <div class="brands-wrapp">
            	<?php
            	    while ( $brands->have_posts() ) : $brands->the_post();
            	        get_template_part( '/templates/contents/content', 'brand' );
            	    endwhile;
            	?>
        	</div>
        </div>

    <?php

    endif;

    wp_reset_postdata();
}

/**
 * Front Page page content display
 *
 * @since Goodz 1.0
 */
function goodz_page_content_section() {
	$page_id = esc_html( get_theme_mod( 'front_page_page_content' ) );

?>

    <div class="container clear">

    	<div class="front-page-content">
			<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $page_id ) ); ?>
		</div>

    </div><!-- container -->

<?php wp_reset_postdata();

}

/**
 * Product Quick View Modal
 *
 * @since Goodz 1.0
 */
function goodz_woo_quickview_modal() {

    $nonce = $_POST['nonce'];
    $pid   = $_POST['productid'];

    global $post, $product;

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
        die ( esc_html__( 'You are not alowed to do this!', 'goodz' ) );
    }

	$shop_product = get_product( $pid );
	$product      = $shop_product;

	// Get product thumbnails
	$attachments = $shop_product->get_gallery_attachment_ids();
	$price_html  = $shop_product->get_price_html();

    // Create product presentation output
    $product_output = '<div class="modal-container woocommerce">';

    	$product_output .= '<div itemscope itemtype="' . woocommerce_get_product_schema() . '" id="product-' . $pid . '" class="'. join( ' ', get_post_class() ) .'">';

        // On sale ribbon
        if ( $product->is_on_sale() ) :
            $product_output .= apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale', 'goodz' ) . '</span>', $post, $product );
        endif;

            $product_output .= '<div class="images">';

            // Display main product image
            $product_output .= '<figure>';
                $product_output .= get_the_post_thumbnail( $pid );
            $product_output .= '</figure>';

            if ( $attachments ) {

                foreach ( $attachments as $attachment ) {
                    $product_output .= '<figure>';
                        $product_output .= '<img src="' . wp_get_attachment_url( $attachment ) . '" />';
                    $product_output .= '</figure>';
                }

           	}

            $product_output .= '</div>';

            $product_output .= '<div class="summary entry-summary">';

                $product_output .= '<h1 itemprop="name" class="product_title entry-title">' . $shop_product->post->post_title . '</h1>';

                    $product_output .= '<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">

                            <p class="price">
                                ' . $price_html . '
                            </p>

                            </div>
                            <div itemprop="description">
                                <p style="outline: none;">' . $shop_product->post->post_excerpt . '</p>
                            </div>';

                    $product_output .= '<div class="view-details"><a href="' . get_permalink( $pid ) . '">' . esc_html__( 'View Details', 'goodz' ) . '</a></div>';

                    // Add to cart button
                    if ( !is_single() ) {
                    	$product_output .= woocommerce_template_single_add_to_cart();
                	}

                	// Add to wishlist
                	if ( function_exists( 'yith_wishlist_constructor' ) ) {
                    	$product_output .= do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                    }

                $product_output .= '</div>';

            $product_output .= '</div>';

        $product_output .= '</div>';

    // Return product summary html
    printf( $product_output );

    die();
}
add_action( 'wp_ajax_nopriv_woo_quickview_modal', 'goodz_woo_quickview_modal' );
add_action( 'wp_ajax_woo_quickview_modal', 'goodz_woo_quickview_modal' );

/**
 * Goodz display section
 */
function goodz_display_section( $output ) {

	switch ( $output ) {

		case 'call-to-action' : ?>

			<!-- Call To Action Section -->
            <div class="home-banner-wrapp clear">
                <?php goodz_call_to_action_section(); ?>
            </div>

		<?php

			break;

		case 'products-section' :

                get_template_part( '/templates/contents/content', 'front-products' );

			break;

		case 'product-categories' :

				goodz_product_categories_section();

			break;

		case 'blog-instagram' :

				goodz_blog_instagram_section();

			break;

		case 'brands-section' :

				goodz_brands_section();

			break;

		case 'page-content' :

				goodz_page_content_section();

			break;

		default :
				return;
			break;
	}

}

/**
 * Goodz Front Page sections
 */
function goodz_front_page_sections() {

	$hp_sections = get_theme_mod( 'front_page_sections_order', 'call-to-action;0,product-categories;1,products-section;1,page-content;0,blog-instagram;1,brands-section;0' );

	if ( !empty( $hp_sections ) ) {

	    $hp_sections = explode( ',', $hp_sections );
	    $outputs     = array();

	    foreach( $hp_sections as $hp_section ) {

	        $hp_section = explode( ';', $hp_section );

	        if ( '1' == $hp_section[1] ) {
	            $outputs[] = $hp_section[0];
	        }
	    }

	    foreach( $outputs as $output ) {
	    	goodz_display_section( $output );
	    }

	}

}

