<?php
/**
 * Customizer specific functions
 *
 * @package Goodz
 */

// Update Google Fonts list
function goodz_list_google_fonts() {

    $api_key = 'AIzaSyAbxRzjvB6WVfk0OLWAgOAKXcxp8sNF9A4';

    if ( false === get_transient( 'google_fonts_json' ) ) {
        $google_font_url  = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $api_key;
        $google_font_list = wp_remote_get( $google_font_url );
        $google_font_list = $google_font_list['body'];

        $expiration = 60 * 60 * 24; // 24 Hours

        set_transient( 'google_fonts_json', $google_font_list, $expiration );

        $webfonts_array = $google_font_list;
    } else {
        $webfonts_array = get_transient( 'google_fonts_json' );
    }

    $list_fonts            = array(); // 1
    $list_fonts_decoded    = json_decode( $webfonts_array, true );
    $list_fonts['default'] = esc_html__( 'Theme default', 'goodz' );

    foreach ( $list_fonts_decoded['items'] as $key => $value ) {
        $item_family              = $list_fonts_decoded['items'][$key]['family'];
        $list_fonts[$item_family] = $item_family;
    }

    return $list_fonts;

}

// Generate font weight for selected font family
function goodz_generate_font_weight() {

    $font_familly                 = $_POST['selected_font'];
    $list_font_weights            = array(); // 2
    $webfonts                     = get_transient( 'google_fonts_json' );
    $list_fonts_decode            = json_decode( $webfonts, true );
    $list_font_weights['default'] = esc_html__( 'Theme default', 'goodz' );

    foreach ( $list_fonts_decode['items'] as $key => $value ) {
        $item_family                     = $list_fonts_decode['items'][$key]['family'];
        $list_font_weights[$item_family] = $list_fonts_decode['items'][$key]['variants'];
    }

    if ( array_key_exists( $font_familly, $list_font_weights ) ) {
        echo json_encode( $list_font_weights[$font_familly] );
    }

    die();

}
add_action( 'wp_ajax_nopriv_goodz_generate_font_weight', 'goodz_generate_font_weight' );
add_action( 'wp_ajax_goodz_generate_font_weight', 'goodz_generate_font_weight' );

// List all categories in dropdown
function goodz_get_categories_select() {

    $teh_cats = get_categories();
    $results = "";

    $count = count( $teh_cats );
    $results['default'] = esc_html__( '-- Select --', 'goodz' );

    if ( !empty( $teh_cats ) ) {
        for ( $i=0; $i < $count; $i++ ) {
            if ( isset( $teh_cats[$i] ) )
                $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
            else
                $count++;
        }
        return $results;
    }

}

// Get All Pages and create select box for Customizer
function goodz_get_page_select(){

    $pages = get_pages();

    if ( ! empty ( $pages ) ) {
        $results['default'] = esc_html__( '-- Select --', 'goodz' );

        foreach ( $pages as $page ) {
            $results[$page->ID] = $page->post_title;
        }
        return $results;
    }

}

// List all product categories in dropdown
function goodz_get_product_categories_select() {

    if ( taxonomy_exists( 'product_cat' ) ) {

        $teh_cats = get_terms( 'product_cat' );
        $results  = '';

        $count = count( $teh_cats );

        if ( !empty( $teh_cats ) ) {
            for ( $i=0; $i < $count; $i++ ) {
                if ( isset( $teh_cats[$i] ) )
                    $results[$teh_cats[$i]->term_id] = $teh_cats[$i]->name;
                else
                    $count++;
            }
            return $results;
        }

    }

}

// List all product categories in dropdown
function goodz_get_front_product_categories_select() {

    if ( taxonomy_exists( 'product_cat' ) ) {

        $teh_cats = get_terms( 'product_cat' );
        $results = "";

        $count = count( $teh_cats );
        $results['default'] = esc_html__( 'Top selling', 'goodz' );
        $results['newest']  = esc_html__( 'Newest', 'goodz' );

        if ( !empty( $teh_cats ) ) {
            for ( $i=0; $i < $count; $i++ ) {
                if ( isset( $teh_cats[$i] ) )
                    $results[$teh_cats[$i]->term_id] = $teh_cats[$i]->name;
                else
                    $count++;
            }
            return $results;
        }

    }

}

// List all product categories in dropdown
function goodz_get_brand_categories_select() {

    $results            = '';
    $results['default'] = esc_html__( '-- All --', 'goodz' );

    if ( taxonomy_exists( 'ct_brands' ) ) {

        $teh_cats = get_terms( 'ct_brands' );

        $count = count( $teh_cats );

        if ( !empty( $teh_cats ) ) {
            for ( $i=0; $i < $count; $i++ ) {
                if ( isset( $teh_cats[$i] ) )
                    $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
                else
                    $count++;
            }

        }

    }

    return $results;

}

// List all categories in dropdown
function goodz_get_slider_categories_select() {

    if ( taxonomy_exists( 'ct_slider' ) ) {
        $teh_cats           = get_terms( 'ct_slider' );
        $results            = '';
        $count              = count( $teh_cats );
        $results['default'] = esc_html__( '-- Select --', 'goodz' );

        if ( !empty( $teh_cats ) ) {
            for ( $i=0; $i < $count; $i++ ) {
                if ( isset( $teh_cats[$i] ) )
                    $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
                else
                    $count++;
            }
            return $results;
        }
    }

}

// List 1 - 10
function goodz_number_of_slides() {

    $results = '';

    for ( $i=1; $i <= 10; $i++ ) {
        $results[ $i ] = $i;
    }

    return $results;

}

/**
 * Populate select box for Map Zoom Factor in Customizer
 */
function goodz_map_zoom_select() {

    for ( $i = 1; $i <= 21; $i++ ) {
        $results[$i] = $i;
    }

    return $results;

}

/**
 * Generate divider to use in Customizer page
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

    class WP_Customize_Divider_Control extends WP_Customize_Control {
        public $type = 'divider';

        public function render_content() {
        ?>
            <div class="customizer-divider"></div>
        <?php
        }
    }

endif;

/**
 * Disable Visual Editor for Customizer
 */
if ( is_customize_preview() ) {
    add_filter( 'user_can_richedit' , '__return_false', 50 );
}


