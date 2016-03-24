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
# Managed Display fields
#-----------------------------------------------------------------#

if ( !class_exists('Themeone_Metabox_Fields') ) {
	// themeone metabox fields class
	class Themeone_Metabox_Fields {
		// Enables markup for all fields
		static function display_wrapper() {
			return true;
		}
		// Enables markup for fields who don't require markup.
		static function display_empty_wrapper() {
			return false;
		}
		// Add actions
		static function add_actions() {
		}
		// Enqueue scripts and styles
		static function admin_enqueue_scripts() {
		}
		// Show field HTML
		static function show( $field, $saved ) {
			global $post;
			
			$field_class = themeone_meta_box::get_class_name( $field );
			$meta        = call_user_func( array( $field_class, 'meta' ), $post->ID, $saved, $field );
			// Call separated methods for displaying each type of field
			$field_html = call_user_func( array( $field_class, 'html' ), $meta, $field );
			echo $field_html;
		}
		
		//  Show field HTML For taxonomies
		static function show_taxonomy( $field, $meta ) {
			$field_class = themeone_meta_box::get_class_name( $field );
			// Call separated methods for displaying each type of field
			$field_html = call_user_func( array( $field_class, 'html' ), $meta, $field );
			echo $field_html;
		}
		
		
		// Get field HTML
		static function html( $meta, $field ) {
			return '';
		}
		// Get meta value
		static function meta( $post_id, $saved, $field ) {
			$meta = get_post_meta( $post_id, $field['id'], true );
			// Use $field['std'] only when the meta box hasn't been saved (i.e. the first time we run)
			$meta = ( ! $saved && '' === $meta || array() === $meta ) ? $field['std'] : $meta;
			$meta = is_array( $meta ) ? $meta  :  $meta ;
			return $meta;
		}
		// Set value of meta before saving into database
		static function value( $new, $old, $post_id, $field ) {
			return $new;
		}
		// Save meta value
		static function save( $new, $old, $object_id, $field, $method = 'post' ) {
			$name = $field['id'];
			if ( '' === $new || array() === $new ) {
				delete_post_meta( $object_id, $name );
				return;
			}
			update_post_meta( $object_id, $name, $new );
		}
		// Normalize parameters for field
		static function normalize_field( $field ){
			return $field;
		}
		// Show custom markup before the markup of the field.
		static function before_field($field) {
			$output = null;
			$field_class = themeone_meta_box::get_class_name($field);
			$required = null;
			$required_fields = null;
			if (isset($field['required'])) {
				$required = ' required';
				foreach ($field['required'] as $requireds) {
					$required_fields .= $requireds[0].','.$requireds[1].','.$requireds[2].';';
				}
				$required_fields = rtrim($required_fields, ";");
				$required_fields = ' data-required="'.$required_fields.'"';
			}
			if(call_user_func( array( $field_class, 'display_wrapper' ) )) {
				$output .= '<div class="'.$field['id'].' '.$field['classes'].' tomb-type-'.$field['type'].''.$required.' tomb-row"'.$required_fields.'>';
				if ($field['name']) {
					$output .= '<label class="tomb-label">'.$field['name'].'</label>';
				}
				if ($field['desc']) {
					$output .= '<p class="tomb-desc">'.$field['desc'].'</p>';
				}
			}
			return $output;
		}
		// Show custom markup after the markup of the field.
		static function after_field($field) {
			$output = null;
			$field_class = themeone_meta_box::get_class_name($field);
			if(call_user_func( array( $field_class, 'display_wrapper' ) )) {
				if ($field['sub_desc']) {
					$output .= '<p class="tomb-sub-desc">'.$field['sub_desc'].'</p>';
				}
				$output .= '</div>';
			}
			return $output;
		}
	}
}

?>