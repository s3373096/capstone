<?php
/**
 * @package   Themeone_Importer
 * @author    ThemeOne <themeone.master@gmail.com>
 * @copyright 2015 ThemeOne
 *
 * @wordpress-plugin
 * Plugin Name:       Themeone Importer
 * Plugin URI:        http://www.theme-one.com/
 * Description:       Themeone Importer
 * Version:           1.0.0
 * Author:            ThemeOne
 * Author URI:        http://www.theme-one.com/
 * Text Domain:       themeone_importor
 * Domain Path:       /languages
 */
 

// Exit if accessed directly
if (!defined( 'ABSPATH')) { 
	exit;
}


if(class_exists('Themeone_Import_Plugin')) {
	die();
}

$base_path = plugin_dir_path( __FILE__ );


define('TO_IMPORTER_PATH', trailingslashit(str_replace('\\', '/', dirname(__FILE__))));
define('TO_IMPORTER_URL', site_url(str_replace(trailingslashit(str_replace('\\', '/',ABSPATH)), '', TO_IMPORTER_PATH)));

if(!class_exists('Themeone_Import_Demo')) {

	class Themeone_Import_Demo {
		
		public function __construct() {
			
			if(!is_admin()) {
				return;
			}
			$this->localize_importer();
			// fetch demo data
			add_action('wp_ajax_themeone_fetch_demo_data', array($this, 'themeone_fetch_demo_data'));
			// import demo with ajax
			add_action('wp_ajax_themeone_import_demo', array($this, 'themeone_import_demo'));
			// Enqueue styles & scripts
			add_action('admin_enqueue_scripts', array($this, 'themeone_import_admin_styles'));
			add_action('admin_enqueue_scripts', array($this, 'themeone_import_admin_scripts'));	
			
		}
		
		public function localize_importer() {
			
			load_plugin_textdomain(
				'to-importer-text-domain',
				FALSE,
				TO_IMPORTER_PATH . '/langs'
			);
			
		}
		
		public function themeone_build_demo_importer() {
			
			$dir = TO_IMPORTER_PATH . 'demos';
			$ffs = scandir($dir);
			
			$str_sure  = ' data-sure-string="'.__('Are you sure you want to import demo?', 'to-importer-text-domain' ).'"';
			$str_type  = ' data-post-string="'.__('Available Post type(s)', 'to-importer-text-domain' ).'"';
			$str_menu  = ' data-menu-string="'.__('Available Menu(s)', 'to-importer-text-domain' ).'"';
			$str_item  = ' data-item-string="'.__('items', 'to-importer-text-domain' ).'"';
			$data_attr = $str_type.$str_menu.$str_item.$str_sure;
			
			echo '<div class="to-import-demos-info">';
				echo __('We advise to import demo content only on fresh installation in order to avoid any conflict with your current blog content.', 'to-importer-text-domain');
				echo '<br>';
				echo __('Images are not included in demo content. Images will be replaced by a placeholder.', 'to-importer-text-domain');
				echo '<br>';
				echo __('Importing demo can take several minutes to complete. Please, do not refresh your browser during the operation.', 'to-importer-text-domain');
				echo '<br>';
				echo __('Your current max execution time is', 'to-importer-text-domain');
				echo ' <u>'. ini_get("max_execution_time") .'s</u>.  ';
				echo __('Under 60 seconds, demo installation can fail. (Please contact your host provider to increase this value)', 'to-importer-text-domain');
			echo '</div>';
			
			echo '<div class="to-import-demos-holder"'.$data_attr.'>';
			
			foreach($ffs as $ff){
				if($ff != '.' && $ff != '..'){
					if (file_exists($dir.'/'.$ff.'/demo.php')) { 
						$path = TO_IMPORTER_URL.'demos/'.$ff.'/demo-image.jpg';
						include($dir.'/'.$ff.'/demo.php');
					}
				}
			}
			
				echo '<div class="to-import-demo-log-holder">';
					echo '<div class="to-import-demo-log-inner">';
					echo '<div class="to-import-demo-log-header">';
						echo '<h3>'.__('Import Report', 'to-importer-text-domain' ).'</h3>';
						echo '<button class="close dashicons dashicons-no"></button>';
					echo '</div>';
					echo '<div class="to-import-demo-log-content"></div>';
					echo '</div>';
				echo '</div>';
			
			echo '</div>';
				
		}
		
		public function themeone_fetch_demo_data() {
			
			$dir   = TO_IMPORTER_PATH . 'demos';
			$ff    = $_POST['demo'];
			$files = array_filter(glob($dir.'/'.$ff.'/*.json'), 'is_file');
			
			$datas = array();
			
			foreach($files as $file){
				
				$name = basename($file, ".json");
				$data = array();
				if ($name !== 'settings') {
					if (strpos($name,'post_type_') !== false) {
						$name = str_replace('post_type_', '', $name);
						$data['type'] = 'post_type';
						$data['post'] = $name;
					} else {
						$data['type'] = $name;
						
					}
					$data['file'] = $file;
					array_push($datas,$data);
				}
				
			}
			
			$json = json_encode($datas);
			echo $json;
			
			die();
			
		}
		
		public function themeone_import_demo() {
					
			$file = $_POST['file'];
			$type = $_POST['type'];
			
			switch ($type) {
				case 'attachments':
					$this->themeone_import_attachments($file);
					break;
				case 'menu':
					$imgs = $_POST['demo_img'];
					$this->themeone_import_menu($file,$imgs);
					break;
				case 'widget':
					$imgs = $_POST['demo_img'];
					$this->themeone_import_widget($file,$imgs);
					break;
				case 'post_type':
					$imgs = $_POST['demo_img'];
					$this->themeone_import_post($file,$imgs);
					break;
				case 'options':
					$this->themeone_import_options($file);
					break;
			}
	
			die();
			
		}
		
		function themeone_import_attachments() {
			
			$dir    = TO_IMPORTER_PATH . 'includes/assets/images';
			$path   = wp_upload_dir();
			$images = glob($dir.'/*.{jpg,png,gif}', GLOB_BRACE);
			
			$json_data = array();
			
			foreach ($images as $image) {
				
				$filename     = basename($image);
				$media_exists = get_page_by_title($filename, 'OBJECT', 'Attachment');
				
				if ($media_exists == null) {
					
					if(wp_mkdir_p($path['path'])) {
						$file = $path['path'] . '/' . $filename;
					} else {
						$file = $path['basedir'] . '/' . $filename;
					}
					
					$image_data   = file_get_contents($image);
					file_put_contents($file, $image_data);
					
					$wp_filetype = wp_check_filetype($filename, null);
					
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name($filename),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);
					
					$attach_id    = wp_insert_attachment($attachment, $file);
					$attach_data  = wp_generate_attachment_metadata($attach_id, $file);
	
					wp_update_attachment_metadata($attach_id, $attach_data);
					
					$json_data[] = array(
						'id'     => $attach_id,
						'title'  => sanitize_file_name($filename),
						'url'    => wp_get_attachment_url($attach_id),//$file,
						'statut' => __('Image imported!', 'to-importer-text-domain' ),
						'color'  => 'green'
					);	
					
				} else {
					
					$query_images_args = array(
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'post_status'    => 'inherit',
						'posts_per_page' => -1,
					);
					
					$query_images = new WP_Query($query_images_args);
					
					foreach ($query_images->posts as $image) {
						$image_url = wp_get_attachment_url($image->ID);
						if (strpos($image_url,'mobius-placeholder-') !== false) {
							$json_data[] = array(
								'id'     => $image->ID,
								'title'  => $image->post_title,
								'url'    => $image_url,
								'statut' => __('Image already exist!', 'to-importer-text-domain' ),
								'color'  => 'green'
							);
						}
					}
					
					wp_reset_query();
					
				}
				
			}
			
			$json_data = array_map('unserialize', array_unique(array_map('serialize', $json_data))); // prevent duplicate
			echo json_encode($json_data);
			die();
			
		}
		
		public function themeone_import_options($file){
			
			if (!file_exists($file)) {
				wp_die();
			}
			
			$json  = file_get_contents($file);
			$options = json_decode($json, true);		
			
			// store import infos
			$json_data  = array();
			
			foreach($options['options'] as $option => $value) {
				//update_option($option, $value);
				$post_color = 'green';
				$json_data[] = array(
					'title'  => $option,
					'statut' => __('Option imported', 'to-importer-text-domain' ),
					'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
				);
				
			}
			
			$redux = ReduxFrameworkInstances::get_instance('mobius');
			$redux->set_options($options['options']);
			
			// front/static wordpress settings
			$type  = $options['blog-settings']['show_on_front'];
			$json_data[] = array(
				'title'  => 'show_on_front',
				'statut' => __('Option imported', 'to-importer-text-domain' ),
				'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
			);
			update_option('show_on_front', $type);		
			if (isset($type) && $type == 'page') {
				$front = $options['blog-settings']['page_on_front'];
				$index = $options['blog-settings']['page_for_posts'];
				$front = get_page_by_title($front,'','page');
				$index = get_page_by_title($index,'','page');
				update_option('page_on_front', $front->ID);
				update_option('page_for_posts', $index->ID);
				$post_color = 'green';
				$json_data[] = array(
					'title'  => 'show_on_front',
					'statut' => __('Option imported', 'to-importer-text-domain' ),
					'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
				);
				$json_data[] = array(
					'title'  => 'page_on_front',
					'statut' => __('Option imported', 'to-importer-text-domain' ),
					'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
				);
			}		
			
			echo json_encode($json_data);
			
		}
		
		public function themeone_import_post($file,$imgs){
			
			if (!file_exists($file)) {
				wp_die();
			}
			
			
			if (isset($imgs) && !empty($imgs)) {
				$img_ids  = array_keys($imgs);
				$img_id   = $img_ids[array_rand($img_ids)];
				$img_urls = array_values($imgs);
				$img_url  = $img_urls[array_rand($img_urls)];
			} else {
				$img_id  = '';
				$img_url = 'http://dummyimage.com/600x400/999/999';
			}
			
			$json  = file_get_contents($file);	
			
			// replace old images urls and ids for shortcodes and Visual Composer single images
			$json = str_replace('placeholder-image-id', $img_id, $json);
			$json = str_replace('placeholder-image.jpg', $img_url, $json);
	
			$posts = json_decode($json, true);
			
			// store import infos
			$json_data  = array();
			
			foreach($posts as $post) {
				
				$new_post = array(
					'import_id'      => $post['post_id'],
					'post_content'   => $post['post_content'],
					'post_name'      => $post['post_name'],
					'post_title'     => $post['post_title'],
					'post_type'      => $post['post_type'],
					'post_status'    => $post['post_status'],
					'post_author'    => '',//$post['post_author'],
					'ping_status'    => $post['ping_status'],
					'post_parent'    => $post['post_parent'],
					'menu_order'     => $post['menu_order'],
					'to_ping'        => $post['to_ping'],
					'pinged'         => $post['pinged'],
					'post_password'  => $post['post_password'],
					'guid'           => $post['guid'],
					'post_excerpt'   => $post['post_excerpt'],
					'post_date'      => $post['post_date'],
					'post_date_gmt'  => $post['post_date_gmt'],
					'comment_status' => $post['comment_status'],
					'page_template'  => $post['page_template']
				);
	
				
				$post_exists = post_exists($post['post_title'], '', $post['post_date']);
				
				if (!$post_exists && post_type_exists($post['post_type'])) {	
					
					$post_id = wp_insert_post($new_post, true);
					
					if (isset($post['post_format']) && !empty($post['post_format'])) {
						set_post_format($post_id, $post['post_format']);
					}
					
					if (isset($post['is_sticky']) && $post['is_sticky'] == 1) {
						stick_post($post_id);
					}
					
					if (isset($post['meta_data']) && !empty($post['meta_data'])) {
						$this->themeone_import_add_meta($post,$post_id);
					}
					
					if (isset($post['terms']) && !empty($post['terms'])) {
						$this->themeone_import_add_terms($post,$post_id);
					}
					
					// insert attachment from previous attachment upload
					if (isset($post['thumbnail']) && !empty($post['thumbnail'])) {
						$attach_id = $img_ids[array_rand($img_ids)];
						set_post_thumbnail($post_id, $attach_id);
					}
					
					if (is_wp_error($post_id)) {
						$post_color  = 'red';
						$post_import = __('An error occurs!', 'to-importer-text-domain' );
						continue;
					}
					
					$post_color  = 'green';
					$post_import = __('Post imported', 'to-importer-text-domain' );
					
				} else {
					
					$post_color  = 'green';
					$post_import = __('Post already exists!', 'to-importer-text-domain' );
					
					if (!post_type_exists($post['post_type'])) {
						$post_color  = 'red';
						$post_import = __('Post type do not exist!', 'to-importer-text-domain' );
					}
					
				}
				
				$json_data[] = array(
					'title'  => $post['post_title'],
					'statut' => (isset($post_import) && !empty($post_import)) ? $post_import : __('An error occurs', 'to-importer-text-domain' ),
					'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red',
					'old_id' => $post['post_id'],
					'new_id' => (isset($post_id)) ? $post_id : false
				);
	
			}
			
			echo json_encode($json_data);
	
		}
		
		public function themeone_import_add_meta($post,$post_id){	
	
			$post['meta_data'] = apply_filters( 'wp_import_post_meta', $post['meta_data'], $post_id, $post );
			
			if (!empty($post['meta_data'])) {
				
				foreach ($post['meta_data'] as $meta) {
					
					$key = apply_filters('import_post_meta_key', $meta['key'], $post_id, $post);
					$value = false;	
					if ($key) {
						if (!$value) {
							$value = maybe_unserialize( $meta['value'] );
						}
						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );
					}
					
				}
				
			}
		
		}
		
		public function themeone_import_add_terms($post,$post_id){	
	
			if (!empty($post['terms'])) {
				
				$terms_to_set = array();
				
				foreach ( $post['terms'] as $term ) {
					
					$taxonomy = ('tag' == $term['taxonomy'] ) ? 'post_tag' : $term['taxonomy'];
					$term_exists = term_exists($term['slug'], $taxonomy);
					$term_id = is_array($term_exists ) ? $term_exists['term_id'] : $term_exists;
					if (!$term_id) {
						$t = wp_insert_term($term['name'], $taxonomy, array( 'slug' => $term['slug']));
						if (!is_wp_error($t)) {
							$term_id = $t['term_id'];
							do_action( 'wp_import_insert_term', $t, $term, $post_id, $post);
						} else {
							if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
								do_action('wp_import_insert_term_failed', $t, $term, $post_id, $post);
								continue;
						}
					}
					$terms_to_set[$taxonomy][] = intval( $term_id );
					
				}
				
				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
					do_action('wp_import_set_post_terms', $tt_ids, $ids, $tax, $post_id, $post);
				}
				
				unset($post['terms'], $terms_to_set);
				
			}
			
		}
		
		public function themeone_import_menu($file,$imgs){
			
			if (!file_exists($file)) {
				wp_die();
			}
			
			if (isset($imgs) && !empty($imgs)) {
				$img_ids  = array_keys($imgs);
				$img_id   = $img_ids[array_rand($img_ids)];
				$img_urls = array_values($imgs);
				$img_url  = $img_urls[array_rand($img_urls)];
			} else {
				$img_id  = '';
				$img_url = 'http://dummyimage.com/600x400/999/999';
			}
	
			$json  = file_get_contents($file);
			
			// replace old images urls and ids for shortcodes and Visual Composer single images
			$json = str_replace('placeholder-image-id', $img_id, $json);
			$json = str_replace('placeholder-image.jpg', $img_url, $json);
			
			$menus = json_decode($json, true);	
			$menu_item_ID = array();
			
			// store import infos
			$json_data  = array();
			
			foreach ($menus as $menu => $menu_items) {
				
				$menu_exists = wp_get_nav_menu_object($menu);
				
				if(!$menu_exists) {
					
					$menu_item_ID = array();
					$menu_id      = wp_create_nav_menu(ucfirst(str_replace('-',' ',$menu)));
					
					foreach ($menu_items['items'] as $menu_item) {
						
						if ($menu_item['status'] == 'draft') {
							return;
						}
						
						$menu_item_classes = maybe_unserialize(($menu_item['classes']));
						if (is_array($menu_item_classes)) {
							$menu_item_classes = implode(' ', $menu_item_classes);
						}
						
						$menu_item_object_id = get_page_by_title(html_entity_decode($menu_item['object_id']));
						if ($menu_item_object_id) {
							$menu_item_url       = get_permalink($menu_item_object_id);
							$menu_item_object_id = $menu_item_object_id->ID;
						} else {
							$menu_item_url       = $menu_item['url'];
							$menu_item_object_id = $menu_item['object_id'];
						}
						
						$item_data =  array(
							'menu-item-object-id'   => $menu_item_object_id,
							'menu-item-object'      => $menu_item['object'],
							'menu-item-parent-id'   => $menu_item['parent_id'],
							'menu-item-position'    => $menu_item['position'],
							'menu-item-type'        => $menu_item['type'],
							'menu-item-title'       => $menu_item['title'],
							'menu-item-url'         => $menu_item_url, 
							'menu-item-description' => $menu_item['description'],
							'menu-item-attr-title'  => $menu_item['attr_title'],
							'menu-item-target'      => $menu_item['target'],
							'menu-item-classes'     => $menu_item_classes,
							'menu-item-xfn'         => $menu_item['xfn'],
							'menu-item-status'      => $menu_item['status']
						);
						
						$menu_item_new_ID = wp_update_nav_menu_item($menu_id, 0, $item_data);
						
						if ($menu_item_new_ID && !is_wp_error($menu_item_new_ID)) {
							
							$menu_item_ID[$menu_item_new_ID] = $menu_item['ID'];
						
							$meta_data = $menu_item['meta_data'];
							foreach ($meta_data as $meta_key => $meta_value) {
								add_post_meta($menu_item_new_ID, $meta_key,$meta_value);
							}
							
						}
						
						if ($menu_item_new_ID && is_wp_error($menu_item_new_ID)) {
							$post_color  = 'red';
							$post_import = __('An error occurs!', 'to-importer-text-domain' );
							continue;
						}
						
					}
					
					foreach ($menu_items['items'] as $menu_item) {
						
						$menu_item_old_ID = $menu_item['ID'];
						$menu_item_new_ID = array_search($menu_item_old_ID, $menu_item_ID);
						$menu_parent_old_ID = $menu_item['parent_id'];
						$menu_parent_new_ID = array_search($menu_parent_old_ID, $menu_item_ID);
						update_post_meta($menu_item_new_ID, '_menu_item_menu_item_parent', (int) $menu_parent_new_ID);
						
					}
					
					if (isset($menu_items['locations']) && !empty($menu_items['locations'])) {
						$locations = get_theme_mod('nav_menu_locations');
						foreach($menu_items['locations'] as $location) {
							$locations[$location] = $menu_id;
						}
						if (isset($locations) && !empty($locations)) {
							set_theme_mod('nav_menu_locations', $locations);
						}
					}
					
					$post_color  = 'green';
					$post_import = __('Menu imported', 'to-importer-text-domain' );
					
				} else {
					
					$post_color  = 'green';
					$post_import = __('Menu already exists!', 'to-importer-text-domain' );
					
				}
				
				$json_data[] = array(
					'title'  => $menu,
					'statut' => (isset($post_import) && !empty($post_import)) ? $post_import : __('An error occurs', 'to-importer-text-domain' ),
					'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
				);
			}
			
			echo json_encode($json_data);
			die();
		}
		
		public function themeone_import_widget($file,$imgs) {
		
			if (!file_exists($file)) {
				wp_die();
			}
			
			global $wp_registered_sidebars, $wp_registered_widget_controls;
			
			$widget_controls   = $wp_registered_widget_controls;
			$available_widgets = array();
			$widget_instances  = array();
			$results           = array();
			
			if (isset($imgs) && !empty($imgs)) {
				$img_ids  = array_keys($imgs);
				$img_id   = $img_ids[0];
				$img_urls = array_values($imgs);
				$img_url  = $img_urls[0];
			} else {
				$img_id  = '';
				$img_url = 'http://dummyimage.com/600x400/999/999';
			}
			
			$file  = file_get_contents($file);	
			
			// replace old images urls and ids for shortcodes and Visual Composer single images
			$file = str_replace('placeholder-image-id', $img_id, $file);
			$file = str_replace('placeholder-image.jpg', $img_url, $file);
			
			$file = json_decode($file);
			
			foreach ($widget_controls as $widget) {
				if (!empty($widget['id_base']) && ! isset( $available_widgets[$widget['id_base']])) {
					$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
					$available_widgets[$widget['id_base']]['name'] = $widget['name'];
				}
			}
			
			foreach ($available_widgets as $widget_data) {
				$widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
			}
		
			foreach ($file as $sidebar_id => $widgets) {
				if ('wp_inactive_widgets' == $sidebar_id) {
					continue;
				}
				if (isset($wp_registered_sidebars[$sidebar_id])) {
					$sidebar_available = true;
					$use_sidebar_id = $sidebar_id;
					$sidebar_message_type = 'success';
					$sidebar_message = '';
				} else {
					$sidebar_available = false;
					$use_sidebar_id = 'wp_inactive_widgets';
					$sidebar_message_type = 'error';
					$sidebar_message = __('Sidebar does not exist in theme (using Inactive)', 'to-importer-text-domain');
					$post_color  = 'red';
				}
		
				$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
				$results[$sidebar_id]['message_type'] = $sidebar_message_type;
				$results[$sidebar_id]['message'] = $sidebar_message;
				$results[$sidebar_id]['widgets'] = array();
		
				foreach ($widgets as $widget_instance_id => $widget) {
					$fail = false;
					$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
					$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
		
					if (!$fail && !isset( $available_widgets[$id_base])) {
						$fail = true;
						$widget_message_type = 'error';
						$widget_message = __('Site does not support widget', 'to-importer-text-domain');
						$post_color  = 'red';
					}
		
					$widget = apply_filters('themeone_theme_import_widget_settings', $widget);
		
					if (!$fail && isset($widget_instances[$id_base])) {
						$sidebars_widgets = get_option( 'sidebars_widgets' );
						$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array();
						$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
						foreach ( $single_widget_instances as $check_id => $check_widget ) {
							if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
								$fail = true;
								$widget_message_type = 'warning';
								$widget_message = __('Widget already exists', 'to-importer-text-domain');	
								$post_color  = 'green';						
								break;
							}
						}
					}
		
					if (!$fail) {
						$single_widget_instances = get_option( 'widget_' . $id_base );
						$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 );
						$single_widget_instances[] = (array) $widget;
						end($single_widget_instances);
						$new_instance_id_number = key( $single_widget_instances );
						
						if ( '0' === strval( $new_instance_id_number ) ) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset( $single_widget_instances[0] );
						}
		
						if ( isset( $single_widget_instances['_multiwidget'] ) ) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset( $single_widget_instances['_multiwidget'] );
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}
		
						update_option( 'widget_' . $id_base, $single_widget_instances );
						$sidebars_widgets = get_option( 'sidebars_widgets' );
						$new_instance_id = $id_base . '-' . $new_instance_id_number;
						$sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
						update_option( 'sidebars_widgets', $sidebars_widgets );
		
						if ( $sidebar_available ) {
							$widget_message_type = 'success';
							$widget_message = __('Imported', 'to-importer-text-domain');
							$post_color  = 'green';
						} else {
							$widget_message_type = 'warning';
							$widget_message = __('Imported to Inactive', 'to-importer-text-domain');
							$post_color  = 'green';
						}					
					}
					$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base;
					$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : __( 'No Title', 'to-importer-text-domain');
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
					
					$json_data[] = array(
						'title'  => $results[$sidebar_id]['widgets'][$widget_instance_id]['name'],
						'statut' => $widget_message,
						'color'  => (isset($post_color) && !empty($post_color)) ? $post_color : 'red'
					);
					
				}
			}
			
			echo json_encode($json_data);
			die();
		}
		
		// Enqueue admin styles
		public function themeone_import_admin_styles() {		
			wp_enqueue_style('themeone-import-css', TO_IMPORTER_URL . 'includes/assets/css/to-import.css', array(), 1.0);
		}
			
		// Enqueue admin scripts
		public function themeone_import_admin_scripts() {
			wp_enqueue_script('themeone-import-css', TO_IMPORTER_URL . 'includes/assets/js/to-import.js', array(), 1.0);
		}
		
	}
	
	new Themeone_Import_Demo();

}