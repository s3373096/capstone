<?php
/*
	Name:  Nav Menu Custom Field
	Description:  Add custom field and save metadata
	Version:      1.0
	Author:       ThemeOne
	Author URI:   http://theme-one.com/
*/
 
function themeone_nav_menu_scripts() {
    wp_register_script('nav_menu', get_template_directory_uri(). '/includes/nav-menu/nav-menu.js', 'jquery');
	wp_enqueue_script('nav_menu');
	
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}	
}
add_action('admin_enqueue_scripts','themeone_nav_menu_scripts');



class themeone_Nav_Menu_Item_Custom_Fields {
	
	static $options = array(
		'input' => '
			<p class="additional-menu-field-{name} description description-wide">
				<br><label for="edit-menu-item-{name}-{id}">
					{label}<br>
					<input type="{input_type}" id="edit-menu-item-{name}-{id}" class="edit-menu-item-{name}" name="menu-item-{name}[{id}]" value="{value}">
				</label>
			</p>
		',
		'input_image' => '
			<p class="additional-menu-field-{name} description description-wide">
				<br><label for="edit-menu-item-{name}-{id}">
					{label}<br>
					<input type="{input_type}" id="edit-menu-item-{name}-{id}" class="edit-menu-item-{name}" name="menu-item-{name}[{id}]" value="{value}">
					<a class="button-upload-img button-secondary left">Upload image</a><br>
					<img style="width:100%;margin-top:5px" class="to-meta-img" src="{value}"/>
				</label>
			</p>
		',
		'select' => '
			<p class="additional-menu-field-{name} description description-wide" value="{value}">
				<label for="edit-menu-item-{name}-{id}">
					{label}<br>
					<input type="{input_type}" id="edit-menu-item-{name}-{id}" class="edit-menu-item-{name}" name="menu-item-{name}[{id}]" value="{value}">
					<select>
						<option value="top-left">Top left</option>
						<option value="top-right">Top Right</option>
						<option value="bot-left">Bottom left</option>
						<option value="bot-right">Bottom Right</option>
					</select>
				</label>
			</p>
		',
	);

	static function setup() {
		if ( !is_admin() )
			return;

		$new_fields = apply_filters( 'themeone_nav_menu_item_additional_fields', array() );
		if ( empty($new_fields) )
			return;
		self::$options['fields'] = self::get_fields_schema( $new_fields );

		add_filter( 'wp_edit_nav_menu_walker', 'themeone_Nav_Menu_fct');
		function themeone_Nav_Menu_fct() {
			return 'themeone_Walker_Nav_Menu_Edit';
		};
		
		add_action( 'save_post', array( __CLASS__, '_save_post' ), 10, 2 );
	}

	static function get_fields_schema( $new_fields ) {
		$schema = array();
		foreach( $new_fields as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}

	static function get_menu_item_postmeta_key($name) {
		return '_menu_item_' . $name;
	}

	/**
	 * Inject the 
	 * @hook {action} save_post
	 */
	static function get_field( $item, $depth, $args ) {
		$new_fields = '';
		foreach( self::$options['fields'] as $field ) {
			$hasChild = $item->hasChildren;
			if ($hasChild > 0 && $field['has_children'] === true || $hasChild < 1 && $field['has_children'] === false || $field['has_children'] === 'both') {
				$field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
				$field['id'] = $item->ID;
				$new_fields .= str_replace(
					array_map(function($key){ return '{' . $key . '}'; }, array_keys($field)),
					array_values(array_map('esc_attr', $field)),
					self::$options[$field['type']]
				);
			}
		}
		return $new_fields;
	}

	/**
	 * Save the newly submitted fields
	 * @hook {action} save_post
	 */
	static function _save_post($post_id, $post) {
		if ( $post->post_type !== 'nav_menu_item' ) {
			return $post_id; // prevent weird things from happening
		}

		foreach( self::$options['fields'] as $field_schema ) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			// @todo FALSE should always be used as the default $value, otherwise we wouldn't be able to clear checkboxes
			if (isset($_POST[$form_field_name][$post_id])) {
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				$value = stripslashes($_POST[$form_field_name][$post_id]);
				update_post_meta($post_id, $key, $value);
			}
		}
	}

}
add_action( 'init', array( 'themeone_Nav_Menu_Item_Custom_Fields', 'setup' ) );

// @todo This class needs to be in it's own file so we can include id J.I.T.
// requiring the nav-menu.php file on every page load is not so wise
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class themeone_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$hasChild = $item->hasChildren;
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args);
		// Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
		if ($new_fields = themeone_Nav_Menu_Item_Custom_Fields::get_field( $item, $depth, $args )) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}



// Somewhere in config...
add_filter( 'themeone_nav_menu_item_additional_fields', 'themeone_menu_item_additional_fields' );
function themeone_menu_item_additional_fields( $fields ) {
	$fields['text'] = array(
		'type' => 'input',
		'name' => 'highlight-text',
		'label' => __('Menu Highlight Text', 'themeone'),
		'container_class' => 'menu_text',
		'input_type' => 'text',
		'has_children' => 'both'
	);
	$fields['image'] = array(
		'type' => 'input_image',
		'name' => 'image',
		'label' => __('Menu Image', 'themeone'),
		'container_class' => 'link-image',
		'input_type' => 'text',
		'has_children' => true
	);
	
	$fields['position'] = array(
		'type' => 'select',
		'name' => 'image-position',
		'label' => __('Menu Image position', 'themeone'),
		'container_class' => 'position-image',
		'input_type' => 'hidden',
		'has_children' => true
	);
	
	return $fields;
}