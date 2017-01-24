<?php
/**
 * TGM PLUGIN ACTIVATION
 *
 * Activates plugins needed by theme
 *
 * @package  Goodz
 */

// Activate TGM Class
require_once get_template_directory() . '/inc/apis/class-tgm-plugin-activation.php';

if ( ! function_exists( 'goodz_register_slider_plugin' ) ) {
    function goodz_register_slider_plugin() {
        $plugins = array(
            array(
                'name'               => 'TK Social Share', // The plugin name
                'slug'               => 'tk-social-share', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/tk-social-share.zip', // The plugin source
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'TK Advertising Widget', // The plugin name
                'slug'               => 'tk-advertising-widget', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/tk-advertising-widget.zip', // The plugin source
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'TK Shortcodes', // The plugin name
                'slug'               => 'tk-shortcodes', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/tk-shortcodes.zip', // The plugin source
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'Goodz Magazine Widgets', // The plugin name
                'slug'               => 'goodz-widgets', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/goodz-widgets.zip', // The plugin source
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'Goodz Magazine Contact Form', // The plugin name
                'slug'               => 'goodz-contact-form', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/goodz-contact-form.zip', // The plugin source
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'Goodz Magazine Custom Post Types', // The plugin name
                'slug'               => 'goodz-custom-post-types', // The plugin slug (typically the folder name)
                'source'             => 'http://www.themeskingdom.com/public/goodz-custom-post-types.zip', // The plugin source
                'required'           => true, // If false, the plugin is onl    y 'recommended' instead of required
                'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => 'http://www.themeskingdom.com', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => 'Flickr Bagdes Widget', // The plugin name
                'slug'               => 'flickr-badges-widget', // The plugin slug (typically the folder name)
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
            ),
            array(
                'name'               => 'WooCommerce', // The plugin name
                'slug'               => 'woocommerce', // The plugin slug (typically the folder name)
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
            ),
            array(
                'name'               => 'YITH WooCommerce Wishlist', // The plugin name
                'slug'               => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
                'required'           => false, // If false, the plugin is onl    y 'recommended' instead of required
            )
        );

        $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );
        tgmpa( $plugins, $config );
    } // function
    add_action( 'tgmpa_register', 'goodz_register_slider_plugin' );
} // if
