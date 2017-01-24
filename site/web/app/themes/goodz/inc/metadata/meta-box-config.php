<?php
/**
 * Post metaboxes configuration
 *
 * @package  Goodz
 */


$prefix     = 'goodz_';
$meta_boxes = array(
    array(
        'id'       => 'post_format_gallery',
        'title'    => esc_html__( 'Gallery Fields', 'goodz' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'label' => esc_html__( 'Repeatable', 'goodz' ),
                'name'  => esc_html__( 'Gallery images', 'goodz' ),
                'desc'  => '',
                'id'    => $prefix . 'repeatable',
                'type'  => 'repeatable'
            )
        )
    ),
    array(
        'id'       => 'post_format_link',
        'title'    => esc_html__( 'Link', 'goodz' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Link Text', 'goodz' ),
                'desc' => '',
                'id'   => $prefix . 'link_text',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
            array(
                'name' => esc_html__( 'Link Url', 'goodz' ),
                'desc' => '',
                'id'   => $prefix . 'link_url',
                'type' => 'text',
                'std'  => ''
            )
        )
    ),
    array(
        'id'       => 'post_format_quote',
        'title'    => esc_html__( 'Quote Text', 'goodz' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Quote Text', 'goodz' ),
                'desc' => '',
                'id'   => $prefix . 'quote',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
            array(
                'name' => esc_html__( 'Quote Author', 'goodz' ),
                'desc' => '',
                'id'   => $prefix . 'quote_author',
                'type' => 'text',
                'std'  => ''
            )
        )
    ),
    array(
        'id'       => 'post_format_video',
        'title'    => esc_html__( 'Video Link', 'goodz' ),
        'pages'    => array( 'post', 'gallery', 'event' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Video Link', 'goodz' ),
                'desc' => esc_html__( 'Paste your video link (e.g. http://www.youtube.com/watch?v=zMtKfSSGkIY or https://vimeo.com/64814911)', 'goodz' ),
                'id'   => $prefix . 'video_link',
                'type' => 'text',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            )
        )
    ),
    array(
        'id'       => 'post_format_audio',
        'title'    => esc_html__( 'Audio Options', 'goodz' ),
        'pages'    => array( 'post' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Audio Link', 'goodz' ),
                'desc' => esc_html__( 'Paste your audio link or audio embed HTML code', 'goodz' ),
                'id'   => $prefix . 'audio_link',
                'type' => 'textarea',
                'std'  => '',
                'options' => array(
                    'rows' => '4',
                    'cols' => '12'
                )
            ),
        )
    ),

    /* Front Page Meta Boxes */
    array(
        'id'       => 'slide_text',
        'title'    => esc_html__( 'Slide Text And Button', 'goodz' ),
        'pages'    => array( 'slide' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Slide text ( content )', 'goodz' ),
                'desc' => esc_html__( 'This text will be displayed under the slide headline / title', 'goodz' ),
                'id'   => $prefix . 'slide_desc',
                'type' => 'wptextarea',
                'std'  => '',
                'options' => array(
                    'rows' => '6',
                    'cols' => '12'
                )
            ),
            array(
                'name' => esc_html__( 'Headline Font Size', 'goodz' ),
                'desc' => esc_html__( 'Enter headline font size in px', 'goodz' ),
                'id'   => $prefix . 'slide_headline_size',
                'type' => 'number',
                'std'  => '112'
            ),
            array(
                'name' => esc_html__( 'Headline Url', 'goodz' ),
                'desc' => esc_html__( 'Paste your headline url here ( e.g. http://www.mylink.com )', 'goodz' ),
                'id'   => $prefix . 'slide_link',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => esc_html__( 'Headline Color', 'goodz' ),
                'desc' => esc_html__( 'Select Headline color', 'goodz' ),
                'id'   => $prefix . 'headline_color',
                'type' => 'colorpicker',
                'std'  => '#000'
            ),
            array(
                'name' => esc_html__( 'Headline Hover Color', 'goodz' ),
                'desc' => esc_html__( 'Select Headline Hover Color', 'goodz' ),
                'id'   => $prefix . 'headline_hover_color',
                'type' => 'colorpicker',
                'std'  => '#fff'
            ),
            array(
                'name' => esc_html__( 'Text Color', 'goodz' ),
                'desc' => esc_html__( 'Select Text color', 'goodz' ),
                'id'   => $prefix . 'text_color',
                'type' => 'colorpicker',
                'std'  => '#000'
            ),
            array(
                'name' => esc_html__( 'Button Text', 'goodz' ),
                'desc' => esc_html__( 'Enter button text if you want button to appear', 'goodz' ),
                'id'   => $prefix . 'button_text',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => esc_html__( 'Button Bg Color', 'goodz' ),
                'desc' => esc_html__( 'Select button background color', 'goodz' ),
                'id'   => $prefix . 'button_bg_color',
                'type' => 'colorpicker',
                'std'  => '#000'
            ),
            array(
                'name' => esc_html__( 'Button Bg Hover Color', 'goodz' ),
                'desc' => esc_html__( 'Select button background hover color', 'goodz' ),
                'id'   => $prefix . 'button_bg_hover_color',
                'type' => 'colorpicker',
                'std'  => '#fff'
            ),
            array(
                'name' => esc_html__( 'Button Text Color', 'goodz' ),
                'desc' => esc_html__( 'Select button text color', 'goodz' ),
                'id'   => $prefix . 'button_text_color',
                'type' => 'colorpicker',
                'std'  => '#fff'
            ),
            array(
                'name' => esc_html__( 'Button Text Hover Color', 'goodz' ),
                'desc' => esc_html__( 'Select button text hover color', 'goodz' ),
                'id'   => $prefix . 'button_text_hover_color',
                'type' => 'colorpicker',
                'std'  => '#000'
            ),
            array(
                'name' => esc_html__( 'Button Border Color', 'goodz' ),
                'desc' => esc_html__( 'Select button border color', 'goodz' ),
                'id'   => $prefix . 'button_border_color',
                'type' => 'colorpicker',
                'std'  => ''
            ),
            array(
                'name' => esc_html__( 'Button Border Hover Color', 'goodz' ),
                'desc' => esc_html__( 'Select button border hover color', 'goodz' ),
                'id'   => $prefix . 'button_border_hover_color',
                'type' => 'colorpicker',
                'std'  => ''
            ),
            array(
                'name' => esc_html__( 'Button Link', 'goodz' ),
                'desc' => esc_html__( 'Paste your button link here ( e.g. http://www.mylink.com )', 'goodz' ),
                'id'   => $prefix . 'button_link',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name'    => esc_html__( 'Text alignment', 'goodz' ),
                'desc'    => esc_html__( 'Choose where to display slider text', 'goodz' ),
                'id'      => $prefix . 'slider_text_alignment',
                'type'    => 'select',
                'options' => array(
                    'Center' => 'text-center',
                    'Left'   => 'text-left',
                    'Right'  => 'text-right'
                )
            )
        )
    ),
    array(
        'id'       => 'brand_link',
        'title'    => esc_html__( 'Brand fields', 'goodz' ),
        'pages'    => array( 'brand' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Brand link', 'goodz' ),
                'desc' => esc_html__( 'Enter URL for this brand. It will be linked to that URL ( e.g. http://www.myurl.com )', 'goodz' ),
                'id'   => $prefix . 'brand_link',
                'type' => 'text',
                'std'  => ''
            )
        ),
    )

);
