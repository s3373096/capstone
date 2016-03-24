<?php
/*
  Plugin Name: Themeone Slider
  Plugin URI: themeone-slider
  Description: Themeone Slider post type with taxonomies.
  Version: 1.1
  Author: ThemeOne
  Author URI: http://www.theme-one.com
 */

if (!defined('THEMEONE_THEME_NAME')) define('THEMEONE_THEME_NAME', 'mobius');

if ( ! class_exists( 'Themeone_Slider_Post_Type' ) ) :

class Themeone_Slider_Post_Type {

	var $version = 1;
	
	function __construct() {
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );
		load_plugin_textdomain( THEMEONE_THEME_NAME, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		add_action( 'init', array( &$this, 'to_slider_init' ) );
	}

	function plugin_activation() {
		$this->to_slider_init();
		flush_rewrite_rules();
	}
	
	function to_slider_init() {  
  
		$labels = array(
			'name' => __( 'Slides', 'taxonomy general name', THEMEONE_THEME_NAME),
			'singular_name' => __( 'Slide', THEMEONE_THEME_NAME),
			'search_items' =>  __( 'Search Slides', THEMEONE_THEME_NAME),
			'all_items' => __( 'All Slides', THEMEONE_THEME_NAME),
			'parent_item' => __( 'Parent Slide', THEMEONE_THEME_NAME),
			'edit_item' => __( 'Edit Slide', THEMEONE_THEME_NAME),
			'update_item' => __( 'Update Slide', THEMEONE_THEME_NAME),
			'add_new_item' => __( 'Add New Slide', THEMEONE_THEME_NAME),
			'menu_name' => __( 'Themeone Slider', THEMEONE_THEME_NAME)
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __('Themeone Slider', THEMEONE_THEME_NAME),
				'public' => true,
				'capability_type' => 'post',
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'menu_position' => 10,
				'menu_icon' => 'dashicons-slides',
				'supports' => array('title'),
				'rewrite' => array('slug' => 'slides', 'with_front' => FALSE),
		);
		register_post_type( 'to_slide' , $args );  
		
		function slide_remove_new_menu() {
			global $submenu;
			unset($submenu['edit.php?post_type=to_slide'][10]);
		}
		add_action('admin_menu', 'slide_remove_new_menu');
		
		$slider_labels = array(
			'name' => __( 'Sliders', THEMEONE_THEME_NAME ),
			'singular_name' => __( 'Slider', THEMEONE_THEME_NAME ),
			'search_items' => __( 'Search Sliders', THEMEONE_THEME_NAME ),
			'all_items' => __( 'All Sliders', THEMEONE_THEME_NAME ),
			'parent_item' => __( 'Parent Slider', THEMEONE_THEME_NAME ),
			'edit_item' => __( 'Edit Slider', THEMEONE_THEME_NAME ),
			'update_item' => __( 'Update Slider', THEMEONE_THEME_NAME),
			'add_new_item' => __( 'Add Slider', THEMEONE_THEME_NAME ),
			'menu_name' => __( 'Slider', THEMEONE_THEME_NAME ),
		);
			
		$slider_args = array(
			'labels' => $slider_labels,
			'singular_label' => __('Slider', THEMEONE_THEME_NAME),
			'public' => true,
			'capability_type' => 'post',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'supports' => array('title'),
			'show_in_menu' => 'edit.php?post_type=to_slide'
		);
		
		register_post_type( 'to_slider', $slider_args);
		
		add_filter('manage_edit-to_slide_columns', 'edit_columns_to_slide');
		function edit_columns_to_slide($columns) {	
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'thumbnail' => __( 'Slide Image', THEMEONE_THEME_NAME  ),
				'title' => __( 'Name', THEMEONE_THEME_NAME  ),
				'alignment' => __( 'Alignment', THEMEONE_THEME_NAME  ),
				'video' => __( 'Video', THEMEONE_THEME_NAME  ),
				'date' => __( 'Date', THEMEONE_THEME_NAME  )
			);
			return $columns;
		}
	
		add_action('manage_to_slide_posts_custom_column',  'slide_show_columns', 10, 2);
		function slide_show_columns($name, $post_id) {
			switch ($name) {
				case 'thumbnail':
					$thumbnail = themeone_video_thumbnail($post_id);
					echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id .'&action=edit"><img class="slider-image-column" src="'. $thumbnail .'" /></a>';
					break;
				case 'alignment':
					$alignment = get_post_meta($post_id, 'themeone-slide-alignment', true);
					echo '<strong>'. $alignment .'</strong>';
					break;
				case 'video':
					$m4v = get_post_meta($post_id, 'themeone-slide-m4v', true);
					$ogv = get_post_meta($post_id, 'themeone-slide-ogv', true);
					$youtube = get_post_meta($post_id, 'themeone-slide-youtube', true);
					$vimeo = get_post_meta($post_id, 'themeone-slide-vimeo', true);
					if ($m4v != '' || $ogv != '' || $youtube != '' || $vimeo != '') {
						echo '<strong>true</strong>';
					} else {
						echo '<strong>false</strong>';
					}
					break;
					
			}
		}
		
		add_filter('manage_edit-to_slider_columns', 'edit_columns_to_slider');
		function edit_columns_to_slider($columns) {	
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => __( 'Slider', THEMEONE_THEME_NAME  ),
				'thumbnail' => __( 'Slides', THEMEONE_THEME_NAME  ),
				'date' => __( 'Date', THEMEONE_THEME_NAME  )
			);
			return $columns;
		}
	
		add_action('manage_to_slider_posts_custom_column',  'slider_show_columns', 10, 2);
		function slider_show_columns($name, $post_id) {
			switch ($name) {
				case 'thumbnail':
					$slides = get_post_meta($post_id, 'themeone-slider-slides', true);
					if ($slides != '') {
						$ids = explode(",", $slides);
						foreach($ids as $id) {
							$post_id = $id;
							$thumbnail = themeone_video_thumbnail($post_id);
							echo '<li class="to-slide-metabox" id="'. $post_id .'" style="background-image: url('. $thumbnail .');">';
							echo '<div class="to-slide-title">'. get_the_title($post_id) .'</div>';
							echo '</li>';
						}
					} else {
						echo 'No slide assigned to this slider';
					}
					break;	
			}
		}
	
	}  

}

new Themeone_Slider_Post_Type;

endif;

?>