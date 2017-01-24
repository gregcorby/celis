<?php

class Themes_Kingdom_Theme_Demo_Data_Importer {

	public $theme_options_file;

	public $widgets;

	public $content_demo;

	public $demo_folder;

	public $flag_as_imported = array();

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		add_action( 'admin_menu', array($this, 'add_admin') );

	}

	/**
	 * Add admin page
	 */
	public function add_admin() {

		add_theme_page("Import Sample Data", "Import Sample Data", 'switch_themes', 'tk_demo_installer', array($this, 'demo_installer'));

	}

	/**
	 * Add content to admin page
	 */
	public function demo_installer() {
		?>
			<style type="text/css">

				label.demo-select > input{
				  display:none;
				}

				label.demo-select > input + img{
				  cursor:pointer;
				  border:2px solid transparent;
				  width: 300px;
				  margin: 0 20px 20px 0;
				}

				label.demo-select > input:checked + img {
				  border:2px solid #bfbfbf;
				  opacity: 0.5;
				}

			</style>

			<div class="wrap">
				<h2><span class="dashicons dashicons-update" style="line-height: 29px;"></span><?php esc_html_e( 'Import Sample Data', 'goodz' ); ?></h2>
				<div id="message" class="updated notice notice-success is-dismissible">
					<p><?php esc_html_e( 'You can speed up development of your site by importing our sample site content like posts and images.', 'goodz' ); ?></p>

					<p><?php esc_html_e( 'Each demo site comes with sample posts, pages, some images, some widgets and menus.', 'goodz' ); ?></p>

					<p><?php esc_html_e( 'Pick a demo site, click the import button, and wait. It can take a couple of minutes to import everything we have.', 'goodz' ); ?></p>

					<p><strong><?php esc_html_e( 'Please note:', 'goodz' ); ?></strong><br/>
					<?php esc_html_e( 'The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'goodz' ); ?></p>

					<p><strong><?php esc_html_e( 'Before you begin:', 'goodz' ); ?></strong><br/>
					<?php esc_html_e( 'Make sure all the required plugins are activated.', 'goodz' ); ?></p>
				</div>
				<form method="post" class="js-one-click-import-form">
					<label class="demo-select">
					    <input type="radio" name="demo_content" value="1" />
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-1/screenshot.jpg' ?>">
					  </label>

					  <label class="demo-select">
					    <input type="radio" name="demo_content" value="2"/>
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-2/screenshot.jpg' ?>">
					  </label>

					  <label class="demo-select">
					    <input type="radio" name="demo_content" value="3" />
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-3/screenshot.jpg' ?>">
					  </label>

					  <label class="demo-select">
					    <input type="radio" name="demo_content" value="4" />
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-4/screenshot.jpg' ?>">
					  </label>

					  <label class="demo-select">
					    <input type="radio" name="demo_content" value="5" />
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-5/screenshot.jpg' ?>">
					  </label>

				      <label class="demo-select">
					    <input type="radio" name="demo_content" value="6" />
					    <img src="<?php echo get_template_directory_uri() . '/inc/importer/demo-files/demo-6/screenshot.jpg' ?>">
					  </label>

					  <br/>
					<input type="hidden" name="demononce" value="<?php echo wp_create_nonce('tk-demo-code'); ?>" />
					<input name="reset" class="panel-save button-primary" type="submit" value="Import Demo Data" />
					<input type="hidden" name="action" value="demo-data" />
				</form>

				<script>
					jQuery( function ( $ ) {
						'use strict';
						$( '.js-one-click-import-form' ).on( 'submit', function () {
							$( this ).append( '<p style="font-width: bold; font-size: 1.5em;"><span class="spinner" style="display: inline-block; float: none; visibility: visible;"></span> Importing now, please wait!</p>' );
							$( this ).find( '.panel-save' ).attr( 'disabled', true );
						} );
					} );
				</script>

				<br />
				<br />
			</div>

		<?php

		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

		if( 'demo-data' == $action && check_admin_referer('tk-demo-code' , 'demononce')){

			if (empty($_POST["demo_content"])) {
				$selected_demo_folder = 'demo-1';
			} else {
				$selected_demo_folder = 'demo-'.$_POST["demo_content"];
			}

			// Set content data file url
			$this->content_data_url = $this->demo_files_path . $selected_demo_folder . '/content.xml';

			// Set content data file name
			$this->content_data_file = 'content.xml';

			// Set widgets data file url
			$this->widgets_data_url = $this->demo_files_path . $selected_demo_folder . '/widgets.json';
			// Set widgets data file name
			$this->widgets_data_file = 'widgets.json';

			// Set customizer data file name
			$this->customizer_data_file = $this->demo_files_path . $selected_demo_folder . '/customizer.txt';

			// Import content data
			$this->set_demo_data( $this->content_data_url );

			// Import customizer data
			$this->set_demo_customizer_data( $this->customizer_data_file );

			// Import widgets data
			$this->process_widget_import_file( $this->widgets_data_url );

			// Set reading settings
			$this->set_reading_settings();

			// Set main menu
			$this->set_main_menu();

		}

	}

	/**
	 * Add widgets to available sidebars
	 */
	public function add_widget_to_sidebar($sidebar_slug, $widget_slug, $count_mod, $widget_settings = array()){

		$sidebars_widgets = get_option('sidebars_widgets');

		if(!isset($sidebars_widgets[$sidebar_slug]))
		   $sidebars_widgets[$sidebar_slug] = array('_multiwidget' => 1);

		$newWidget = get_option('widget_'.$widget_slug);

		if(!is_array($newWidget))
			$newWidget = array();

		$count = count($newWidget)+1+$count_mod;
		$sidebars_widgets[$sidebar_slug][] = $widget_slug.'-'.$count;

		$newWidget[$count] = $widget_settings;

		update_option('sidebars_widgets', $sidebars_widgets);
		update_option('widget_'.$widget_slug, $newWidget);

	}

	/**
	 * Import sample data
	 */
	public function set_demo_data( $file ) {

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once ABSPATH . 'wp-admin/includes/import.php';

		$importer_error = false;

		if ( !class_exists( 'WP_Importer' ) ) {

			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

			if ( file_exists( $class_wp_importer ) ){

				require_once($class_wp_importer);

			} else {

				$importer_error = true;

			}

		}

		if ( !class_exists( 'WP_Import' ) ) {

			$class_wp_import = get_template_directory() .'/inc/importer/includes/wordpress-importer.php';

			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importer_error = true;

		}

		if($importer_error){

			die("Error on import");

		} else {

			if(!file_exists( $file )){

				echo "The XML file containing the dummy content is not available or could not be read. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the Wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";

			} else {

			   $wp_import = new WP_Import();
			   $wp_import->fetch_attachments = true;
			   $wp_import->import( $file );

			}

		}

	}

	/**
	 * Set sample reading settings
	 */
	public function set_reading_settings() {

		// Set the front page
		$home = get_page_by_title( $this->home_page_name );
		update_option( 'page_on_front', $home->ID );
		update_option( 'show_on_front', 'page' );

		// Set the blog/posts page
		$blog = get_page_by_title( $this->posts_page_name );
		update_option( 'page_for_posts', $blog->ID );

	}

	/**
	 * Set main menu position
	 */
	public function set_main_menu() {

		// Menus to Import and assign - you can remove or add as many as you want
		$main_menu = get_term_by('name', $this->main_menu_name, 'nav_menu');
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id
			)
		);
	}

	/**
	 * Set sample customizer data
	 */
	public function set_demo_customizer_data( $file ) {

		// File exists?
		if ( ! file_exists( $file ) ) {
			wp_die(
				esc_html__( 'Theme options Import file could not be found. Please try again.', 'goodz' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Get file contents and decode
		global $wp_filesystem;
		$data = $wp_filesystem->get_contents( $file );

		$data = unserialize( trim($data, '###') );

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) ) {
			wp_die(
				esc_html__( 'Theme options import data could not be read. Please try a different file.', 'goodz' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Hook before import
		$data = apply_filters( 'tk_theme_import_theme_options', $data );

		update_option($this->theme_option_name, $data);

	}

	/**
	 * Check for a available widgets
	 */
	function available_widgets() {

		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}

		}

		return apply_filters( 'tk_theme_import_widget_available_widgets', $available_widgets );

	}


	/**
	 * Process imported file
	 */
	function process_widget_import_file( $file ) {

		// File exists?
		if ( ! file_exists( $file ) ) {
			wp_die(
				esc_html__( 'Widget Import file could not be found. Please try again.', 'goodz' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Get file contents and decode
		global $wp_filesystem;
		$data = $wp_filesystem->get_contents( $file );
		$data = json_decode( $data );

		// Delete import file
		//unlink( $file );

		// Import the widget data
		$this->widget_import_results = $this->import_widgets( $data );

	}


	/**
	 * Import sample widgets
	 */
	public function import_widgets( $data ) {

		global $wp_registered_sidebars;

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) || ! is_object( $data ) ) {
			wp_die(
				esc_html__( 'Widget import data could not be read. Please try a different file.', 'goodz' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Hook before import
		$data = apply_filters( 'tk_theme_import_widget_data', $data );

		// Get all available widgets site supports
		$available_widgets = $this->available_widgets();

		// Get all existing widget instances
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Begin results
		$results = array();

		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets
			// (should not be in export file)
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
				$sidebar_message_type = 'success';
				$sidebar_message = '';
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
				$sidebar_message_type = 'error';
				$sidebar_message = esc_html__( 'Sidebar does not exist in theme (using Inactive)', 'goodz' );
			}

			// Result for sidebar
			$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
			$results[$sidebar_id]['message_type'] = $sidebar_message_type;
			$results[$sidebar_id]['message'] = $sidebar_message;
			$results[$sidebar_id]['widgets'] = array();

			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {

				$fail = false;

				// Get id_base (remove -# from end) and instance ID number
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

				// Does site support this widget?
				if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
					$fail = true;
					$widget_message_type = 'error';
					$widget_message = esc_html__( 'Site does not support widget', 'goodz' ); // explain why widget not imported
				}

				// Filter to modify settings before import
				// Do before identical check because changes may make it identical to end result (such as URL replacements)
				$widget = apply_filters( 'tk_theme_import_widget_settings', $widget );

				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {

						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

							$fail = true;
							$widget_message_type = 'warning';
							$widget_message = esc_html__( 'Widget already exists', 'goodz' ); // explain why widget not imported

							break;

						}

					}

				}

				// No failure
				if ( ! $fail ) {

					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
					$single_widget_instances[] = (array) $widget; // add it

						// Get the key it was given
						end( $single_widget_instances );
						$new_instance_id_number = key( $single_widget_instances );

						// If key is 0, make it 1
						// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
						if ( '0' === strval( $new_instance_id_number ) ) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset( $single_widget_instances[0] );
						}

						// Move _multiwidget to end of array for uniformity
						if ( isset( $single_widget_instances['_multiwidget'] ) ) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset( $single_widget_instances['_multiwidget'] );
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}

						// Update option with new widget
						update_option( 'widget_' . $id_base, $single_widget_instances );

					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
					$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

					// Success message
					if ( $sidebar_available ) {
						$widget_message_type = 'success';
						$widget_message = esc_html__( 'Imported', 'goodz' );
					} else {
						$widget_message_type = 'warning';
						$widget_message = esc_html__( 'Imported to Inactive', 'goodz' );
					}

				}

				// Result for widget instance
				$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
				$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget->title ) ? $widget->title : esc_html__( 'No Title', 'goodz' ); // show "No Title" if widget instance is untitled
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

			}

		}

		// Hook after import
		do_action( 'tk_theme_import_widget_after_import' );

		// Return results
		return apply_filters( 'font-weight: 500;_theme_import_widget_results', $results );

	}

}
