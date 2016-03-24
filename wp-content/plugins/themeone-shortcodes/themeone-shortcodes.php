<?php
/*
  Plugin Name: Themeone Shortcodes
  Plugin URI: themeone-shortcodes
  Description: Themeone shorcode generator. Add column, section, button, style, videos, audio and much more.
  Version: 3.2
  Author: ThemeOne
  Author URI: http://www.theme-one.com
 */

class ThemeoneShortcodes {
	
	/* Defined main names, php files and action */
    function __construct() {
		load_plugin_textdomain( 'mobius', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		define( 'THEMEONE_SHORCODES_URI', plugin_dir_url( __FILE__ ) .'shortcodes' );
		define( 'THEMEONE_TINYMCE_URI', plugin_dir_url( __FILE__ ) .'tinymce' );
		define( 'THEMEONE_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'tinymce' );
		require_once( THEMEONE_TINYMCE_DIR .'/shortcodes-processing.php' );
		require_once( THEMEONE_TINYMCE_DIR .'/shortcodes-popup.php' );
        add_action( 'init', array(&$this, 'init') );
		add_action( 'admin_init', array(&$this, 'admin_init') );
		add_action( 'media_buttons', array(&$this, 'themeone_buttons'), 100 );
	}

	/* Init Styles/scripts and registers TinyMCE rich editor buttons */
	function init() {
		if( !is_admin() ) {				
			wp_enqueue_style( 'themeone-shortcodes', THEMEONE_SHORCODES_URI . '/css/shortcodes.css' );
			wp_enqueue_style( 'linecons', THEMEONE_SHORCODES_URI . '/css/linecons.css');
			if ( wp_get_theme() != 'Mobius' ) {
				wp_enqueue_style( 'font-awesome', THEMEONE_SHORCODES_URI . '/css/font-awesome.min.css');
				wp_enqueue_style( 'font-awesome-ie7', THEMEONE_SHORCODES_URI . '/css/font-awesome-ie7.min.css'); 
				wp_enqueue_style( 'steadysets', THEMEONE_SHORCODES_URI . '/css/steadysets.css');
				wp_enqueue_style( 'mediaelementplayer', THEMEONE_SHORCODES_URI . '/css/mediaelementplayer.css');
				
				global $wp_styles;
				$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lte IE 7');
		
				wp_enqueue_script( 'modernizr', THEMEONE_SHORCODES_URI . '/js/modernizr.js', 'jquery', '2.7.1');
				wp_enqueue_script( 'mediaelement' );
				wp_enqueue_script( 'easing', THEMEONE_SHORCODES_URI . '/js/jquery.easing.js', 'jquery', '1.3', TRUE);
				wp_enqueue_script( 'owl-carousel', THEMEONE_SHORCODES_URI . '/js/owl.carousel.js', 'jquery', '1.3.2', TRUE);
				wp_enqueue_script( 'youtube', THEMEONE_SHORCODES_URI . '/js/youtube.js', '1.0', TRUE);
			}
			
			wp_enqueue_style( 'pixelicons', THEMEONE_SHORCODES_URI . '/css/pixelicons.css');	
			wp_enqueue_script( 'jquery');
			wp_enqueue_script( 'excanvas', THEMEONE_SHORCODES_URI . '/js/excanvas.js', 'jquery', '2.0', TRUE);
			wp_enqueue_script( 'easy-pie-chart', THEMEONE_SHORCODES_URI . '/js/easypiechart.js', 'jquery', '2.1.3', TRUE);
			wp_enqueue_script( 'appear', THEMEONE_SHORCODES_URI . '/js/jquery.appear.js', 'jquery', '1.0', TRUE);
			wp_enqueue_script( 'themeone-shortcodes', THEMEONE_SHORCODES_URI . '/js/themeone-shortcodes.js', 'jquery', '1.0', TRUE);
					
			global $wp_scripts;
			$wp_scripts->add_data( 'excanvas', 'conditional', 'lt IE 9' );				
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}
		
		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugin') );
			add_filter( 'mce_buttons', array(&$this, 'register_rich_button') );
		}

	}

	/* TinyMCE rich editor js plugin for shortcode window via ajax */
	function add_rich_plugin( $plugin_array ) {
		if( is_admin() ) {
			$plugin_array['themeoneShortcodes'] = THEMEONE_TINYMCE_URI . '/js/plugin.js';
		}
		return $plugin_array;
	}

	/* TinyMCE rich editor button */
	function register_rich_button( $buttons ) {
		array_push( $buttons, 'themeoneShortcodes' );
		return $buttons;
	}

	/* Enqueue Scripts and Styles */
	function admin_init() {	
			wp_enqueue_style( 'themeone-popup', THEMEONE_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
			wp_enqueue_style( 'font-awesome', THEMEONE_SHORCODES_URI . '/css/font-awesome.min.css');
			wp_enqueue_style( 'font-awesome-ie7', THEMEONE_SHORCODES_URI . '/css/font-awesome-ie7.min.css'); 
			wp_enqueue_style( 'linecons', THEMEONE_SHORCODES_URI . '/css/linecons.css');
			wp_enqueue_style( 'steadysets', THEMEONE_SHORCODES_URI . '/css/steadysets.css');
			wp_enqueue_style( 'pixelicons', THEMEONE_SHORCODES_URI . '/css/pixelicons.css');
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style('jquery-ui-style');
				
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'nicescroll', THEMEONE_TINYMCE_URI . '/js/jquery.nicescroll.js', 'jquery', '2.0', TRUE);
			wp_enqueue_script( 'isotope', THEMEONE_TINYMCE_URI . '/js/jquery.isotope.js', 'jquery', '2.0', TRUE);
			wp_enqueue_script( 'jquery-livequery', THEMEONE_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
			wp_enqueue_script( 'jquery-appendo', THEMEONE_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
			wp_enqueue_script( 'base64', THEMEONE_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
			wp_enqueue_script( 'themeone-popup', THEMEONE_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
			wp_localize_script( 'jquery', 'themeoneShortcodes', array('plugin_folder' => WP_PLUGIN_URL .'/themeone-shortcodes') );
				
			global $wp_styles;
			$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lte IE 7');
	}
	
	function themeone_buttons() {
		echo "<a data-effect='mfp-zoom-in' data-wp-version=". get_bloginfo('version') ." class='button button-primary themeone-sc-generator' href='#themeone-sc-generator'><span class='wp-media-buttons-icon'></span>Themeone Shortcodes</a>";
	}	

}

$Themeone_shortcodes = new ThemeoneShortcodes();

if (class_exists('WPBakeryVisualComposerAbstract')) {
	define( 'THEMEONE_VC_DIR', plugin_dir_path( __FILE__ ) .'vc-addons' );
	define( 'THEMEONE_VC_URI', plugin_dir_url( __FILE__ ) .'vc-addons' );
	require(THEMEONE_VC_DIR . '/vc-addons.php');
	add_action('wp_enqueue_scripts', 'themeone_vc_fontend');
	add_action('admin_enqueue_scripts', 'themeone_vc_styles');
	add_action( 'admin_menu', 'remove_vc_grid_items' );
	function themeone_vc_styles() {
		wp_register_script('vc_addon_js', THEMEONE_VC_URI .'/vc-addons.js', 'jquery', '1.0');
		wp_enqueue_script('vc_addon_js');
		wp_enqueue_style('vc_addon_css', THEMEONE_VC_URI .'/vc-addons.css');
	}
	function themeone_vc_fontend() {
		wp_enqueue_style('js_composer_front');
		wp_enqueue_script('wpb_composer_front_js');
		wp_enqueue_style('js_composer_custom_css');
	}
	
	function remove_vc_grid_items() {
		remove_menu_page( 'edit.php?post_type=vc_grid_item' );
		remove_menu_page( 'edit.php?post_type=essential_grid' );
	}
}

?>