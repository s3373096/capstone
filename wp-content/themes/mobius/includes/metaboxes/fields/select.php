<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TOMB_Select_Field' ) ) {

	class TOMB_Select_Field extends Themeone_Metabox_Fields {		
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts() {
			global $post;
			if ( class_exists( 'woocommerce' ) && $post->post_type != 'product') {         
				wp_dequeue_style( 'select2' );
				wp_deregister_style( 'select2' );
				wp_dequeue_script( 'select2');
				wp_deregister_script('select2');
			}  	
			// This function loads in the required scripts.
			if ($post->post_type != 'product') {
				wp_register_script('select2', TOMB_URL.'assets/js/select2.min.js', 'jquery', '1.0', TRUE);
				wp_enqueue_script('select2');
				wp_register_style('select2', TOMB_URL. 'assets/css/select2.min.css');
				wp_enqueue_style('select2');
			}
		}
		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 * @return string
		 *
		 * @todo add support for std
		 */
		static function html( $meta, $field ) {

			$output = null;
			$width = null;
			$placeholder = '';
			// Check for std parameter
			if(!$meta && array_key_exists('std', $field)){
				$meta = $field['std'];
			}
			if (isset($field['width']) && !empty($field['width'])) {
				$width = 'data-width="'.$field['width'].'"';
			}
			if (isset($field['placeholder']) && !empty($field['placeholder'])) {
				$placeholder = $field['placeholder'];
			}
			if (!isset($field['clear']) && empty($field['clear'])) {
				$field['clear'] = '';
			}
			
			$output .= '<select class="tomb-select" name="'.$field['id'].'" data-placeholder="'.$placeholder.'"  data-value="'.$meta.'" data-clear="'.$field['clear'].'" '.$width.'>';
			foreach ( $field['options'] as $value => $label ) {
				$disabled = strpos($value, 'disabled') ? 'disabled="disabled"' : false;
				$output .= '<option value="'.$value.'" '.selected( $value, $meta, false ).' '. $disabled .'>'.$label.'</option>';
			}
			$output .= '</select>';

			return $output;

		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 * @return array
		 */
		static function normalize_field( $field ) {

			$field = wp_parse_args( $field, array(
				'options' => array(),
			) );

			return $field;

		}

		/**
		 * Sanitize select
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return string
		 */
		static function value( $new, $old, $post_id, $field ){
			return sanitize_text_field( $new );
		}

	}

}
