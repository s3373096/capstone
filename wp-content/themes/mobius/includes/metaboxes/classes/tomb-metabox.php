<?php
/**
 * Author:      Themeone
 * Author URI:  https://theme-one.com
 */
 
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

#-----------------------------------------------------------------#
# Create MetaBox
#-----------------------------------------------------------------#

if(!class_exists('themeone_meta_box')) {
	// themeone metabox class
	class themeone_meta_box {
	 
		protected $_meta_box;
		public $saved = false;
		public $fields;
	 	
		public function __construct($meta_box) {
			// Load only in admin area.
			if (!is_admin()) {
				return;
			}
			// Get fields value class name
			$this->_meta_box = $meta_box;
			$this->themeone_default_metabox_args();
		    $this->fields = &$this->_meta_box['fields'];
			$fields = self::get_fields($this->fields);
			foreach ($fields as $field) {
				call_user_func(array(self::get_class_name($field), 'add_actions'));
				
			}
			// Add custom classes to metabox
			$post_type_object = $this->_meta_box['pages'];
			foreach ($post_type_object as $page) {
				add_filter( "postbox_classes_{$page}_{$this->get_id()}", array( $this, 'add_class_to_metabox' ) );
			}
			//register setup and save actions
			add_action( 'add_meta_boxes', array($this, 'themeone_meta_box_add' ));
			add_action( 'save_post', array($this, 'themeone_meta_box_save' ));
			// Enqueue styles and scripts
			add_action( 'admin_head',array($this, 'append_scripts' ));
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
		}
		
		public function append_scripts() {
			if ($this->_meta_box['color'] && $this->_meta_box['background']) {
				$style  = '<style type="text/css">';
				$style .= '#'.$this->_meta_box['id'].' .hndle.ui-sortable-handle{';
				$style .= 'color:'.$this->_meta_box['color'].';';
				$style .= 'background:'.$this->_meta_box['background'].';';
				$style .= '}';
				$style .= '#'.$this->_meta_box['id'].'.tomb-metabox .handlediv:before {';
				$style .= 'color:'.$this->_meta_box['color'].';';
				$style .= '}';
				$style .= '</style>';
				echo $style;
			}			
		}
		
		public function add_class_to_metabox($classes) {
			$className = null;
			if (isset($this->_meta_box['close']) && $this->_meta_box['close'] === true) {
				$className .= ' closed';
			} 
			if (isset($this->_meta_box['menu']) && $this->_meta_box['menu'] === true) {
				$className .= ' tomb-menu-options';
			} 
			if (isset($this->_meta_box['context']) && $this->_meta_box['context'] === 'side') {
				$className .= ' tomb-side';
			}
			array_push($classes, 'tomb-metabox'.$className);
		    return $classes;
		}
		
		public function get_id() {
			return $this->_meta_box['id'];
		}
		
		public function themeone_default_metabox_args() {
    		$this->_meta_box = array_merge( array( 'context' => 'normal', 'priority' => 'high', 'pages' => array( 'post' )), (array)$this->_meta_box );
			$this->_meta_box['fields'] = self::normalize_fields($this->_meta_box['fields']);
		}
		
		public function themeone_meta_box_add($post_type) {
			foreach ($this->_meta_box['pages'] as $page) {
				add_meta_box(
					$this->_meta_box['id'], 
					'<span class="tomb-icon">'.$this->_meta_box['icon'].'</span>'.$this->_meta_box['title'],
					array( $this, 'themeone_meta_box_show' ),
					$page,
					$this->_meta_box['context'],
					$this->_meta_box['priority']
				);
			}
			
		}
		
		static function get_fields( $fields ) {
			$all_fields = array();
			foreach ($fields as $field) {
				$all_fields[] = $field;
				if (isset( $field['fields'])) {
					$all_fields = array_merge($all_fields, self::get_fields($field['fields']));
				}
			}
			return $all_fields;
		}
		
		static function get_class_name( $field ) {
			$type  = str_replace( '_', ' ', $field['type'] );
			$class = 'TOMB_' . ucwords( $type ) . '_Field';
			$class = str_replace( ' ', '_', $class );
			return class_exists( $class ) ? $class : false;
		}
		
		static function normalize_fields( $fields ) {
			foreach ($fields as &$field) {
				$field = wp_parse_args( $field, array(
					'id'            => isset( $field['id'] ) ? $field['id'] : md5(uniqid(rand(), true)),
					'icon'          => '',
					'color'         => '',
					'background'    => '',
					'std'           => '',
					'desc'          => '',
					'sub_desc'      => '',
					'size'          => '',
					'checkbox_title'=> '',
					'disabled'      => '',
					'frame_title'   => '',
					'frame_button'  => '',
					'button_upload' => '',
					'button_remove' => '',
					'name'          => isset( $field['id'] ) ? $field['id'] : '',
					'placeholder'   => '',
					'in_row'        => '',
					'min'           => '',
					'max'           => '',
					'step'          => '',
					'sign'          => '',
					'args'          => '',
					'theme'         => '',
					'mode'          => '',
					'classes'       => 'tomb-field'
				) );
			}
			return $fields;
		}

		static function has_been_saved( $post_id, $fields ) {
			foreach ( $fields as $field ) {
				$value = get_post_meta( $post_id, $field['id'], true );
				if ( '' !== $value ) {
					return true;
				}
			}
			return false;
		}
		
		function themeone_meta_box_show($post) {
			$post_id = $post->ID;
			$fields  = array();
			$icons   = array();
			$saved   = self::has_been_saved($post_id, $this->fields);
			
			wp_nonce_field( "tomb-save-{$this->_meta_box['id']}", "nonce_{$this->_meta_box['id']}" );
			
			foreach ( $this->fields as $field ) {
				// Display content before markup of the single field
				$tabName = isset($field['tab']) ? $field['tab'] : 'general';
				$tabIcon = isset($field['tab_icon']) ? $field['tab_icon'] : '';
				$fieldID = $field['id'];
				$output  = null;
				$output .= Themeone_Metabox_Fields::before_field($field);
				// Output buffering
				ob_start();
				$output .= call_user_func( array( self::get_class_name($field), 'show' ), $field, $saved );
				$output .= ob_get_contents();
				ob_end_clean();
				// Display content after markup of the single field.
				$output .= Themeone_Metabox_Fields::after_field($field);
				$fields[$tabName][$fieldID] = $output;
				$icons[$tabName] = $tabIcon;
			}
			
			// Construct Tabs
			$tabNb    = sizeof($fields);
			$tabs     = array_keys($fields);
			$selected = ' selected';
			
			if ($tabNb > 1) {
				echo '<ul class="tomb-tabs-holder">';
				foreach ($tabs as $tab) {
					echo '<li class="tomb-tab'.$selected.'" data-target="'.$this->themeone_tab_name($tab).'">'.$icons[$tab].$tab.'</li>';
					$selected = null;
				}
				echo '</ul>';
				
				foreach ($tabs as $tab) {
					echo '<div class="tomb-tab-content '.$this->themeone_tab_name($tab).'">';
					foreach ($fields[$tab] as $input) {
						print_r($input);
					}
					echo '</div>';
				}
			} else {
				foreach ($tabs as $tab) {
					foreach ($fields[$tab] as $input) {
						print_r($input);
					}
				}
			}
		}
		
		function themeone_tab_name($string) {
			$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
			$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
			return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
		}
		
		function admin_enqueue_scripts() {
			$screen = get_current_screen();
			// Enqueue scripts and styles for registered pages (post types) only
			if ( 'post' != $screen->base || ! in_array( $screen->post_type, $this->_meta_box['pages'] ) )
				return;
			$fields = self::get_fields( $this->fields );
			foreach ( $fields as $field ) {
				// Enqueue scripts and styles for fields
				call_user_func( array( self::get_class_name( $field ), 'admin_enqueue_scripts' ) );
			}
		}
		
		#-----------------------------------------------------------------#
		# Save MetaBox
		#-----------------------------------------------------------------# 
		
		function themeone_meta_box_save($post_id) {
			
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}
			
			// Check the user's permissions.
			if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return;
				}
			} else {
				if (!current_user_can('edit_post', $post_id)) {
					return;
				}
			}
			$this->saved = true;
			

			// Check whether form is submitted properly
			$id    = $this->_meta_box['id'];
			$nonce = isset( $_POST["nonce_{$id}"] ) ? sanitize_key( $_POST["nonce_{$id}"] ) : '';
			if ( empty( $_POST["nonce_{$id}"] ) || ! wp_verify_nonce( $nonce, "tomb-save-{$id}" ) ) {
				return;
			}

			// Make sure meta is added to the post, not a revision
			if ($the_post = wp_is_post_revision($post_id)) {
				$post_id = $the_post;
			}
			
			// Cycle through each field and save the values.
			foreach ($this->fields as $field) {
				$name = $field['id'];
				$old  = get_post_meta($post_id, $name, true);
				$new  = isset($_POST[$name]) ? $_POST[$name] : '';
				$new = call_user_func(array( self::get_class_name($field), 'value'), $new, $old, $post_id, $field);
				call_user_func(array(self::get_class_name($field), 'save'), $new, $old, $post_id, $field, 'post');
			}
		}
		
	}

}

?>