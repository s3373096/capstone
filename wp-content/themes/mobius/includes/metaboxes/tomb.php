<?php
/**
 * Author:      Themeone
 * Author URI:  https://theme-one.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { 
	exit;
}

if(!class_exists('Tomb_Base')) {
	
	class Tomb_Base {
		
		// Constructor - get the plugin hooked in and ready
		public function __construct() {
			$this->setup_constants();
			$this->localize_framework();
			$this->load();
			// load framework assets css and scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
		}

		// Setup plugin constants
		private function setup_constants() {
			// Plugin version
			if ( ! defined( 'TOMB_VERSION' ) ) {
				define('TOMB_VERSION_VERSION', '1.0');
			}
			// Plugin Folder Path
			if ( ! defined( 'TOMB_DIR' ) ) {
				define('TOMB_DIR', trailingslashit(str_replace('\\', '/', dirname(__FILE__))));
			}
			// Plugin Folder URL
			if ( ! defined( 'TOMB_URL' ) ) {
				define('TOMB_URL', site_url(str_replace(trailingslashit(str_replace('\\', '/',ABSPATH)), '', TOMB_DIR)));
			}
		}
		
		// localize framework function
		public function localize_framework() {
			
			load_plugin_textdomain(
				'tomb-text-domain',
				FALSE,
				TOMB_DIR . '/langs'
			);
			
		}

		// Load framework classes.
		public function load() {
			// Load fields and processing functions
			require_once( TOMB_DIR . 'classes/tomb-taxonomy.php' );
			require_once( TOMB_DIR . 'classes/tomb-metabox.php' );
			require_once( TOMB_DIR . 'classes/tomb-fields.php' );
			// Load all fields files into the "fields" folder
			foreach (glob(TOMB_DIR . 'fields/*.php') as $file) {
				require_once $file;
			}
		}

		// Load framework assets css and scripts.
		public function assets() {
			
			// paths/url
			$screen    = get_current_screen();
			$page_name = esc_html(get_admin_page_title());
			$js_dir    = TOMB_URL . 'assets/js/';
			$css_dir   = TOMB_URL . 'assets/css/';
			
			// Main Script
			wp_register_script('tomb-js', $js_dir .'tomb.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('tomb-js');
			
			// jQuery UI (Wordpress core)
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			// Color Picker (Wordpress core)
			wp_enqueue_script('wp-color-picker');
			
			// Styles
			wp_enqueue_style('tomb-css', $css_dir .'tomb.css');
			// Enqueue styles
			wp_enqueue_style('tomb-css');
			wp_enqueue_style('wp-color-picker');
		}
		
	}
	new Tomb_Base;

}