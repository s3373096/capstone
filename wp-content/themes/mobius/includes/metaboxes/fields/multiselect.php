<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TOMB_Multiselect_Field' ) ) {

	class TOMB_Multiselect_Field extends Themeone_Metabox_Fields {
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts() {
			global $post;
			if ( class_exists( 'woocommerce' ) && $post->post_type != 'product' ) {         
				wp_dequeue_style( 'select2' );
				wp_deregister_style( 'select2' );
				wp_dequeue_script( 'select2');
				wp_deregister_script('select2');
			}  	
			// This function loads in the required scripts.
			if ($post->post_type != 'product') {
				wp_register_script('select2', TOMB_URL.'assets/js/select2.min.js', 'jquery', '1.0', TRUE);
				wp_enqueue_script('select2');
				wp_register_style('select2', TOMB_URL . 'assets/css/select2.min.css');
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
			$meta_holder  = '';
			if (isset($field['meta_holder']) && !empty($field['meta_holder'])) {
				if (is_array($meta)) {
					$value = '';
					foreach($meta as  $key => $val) {
						$value .= $val.',';
					}
					$value = rtrim($value, ",");
				} else {
					$value = $meta;
				}
				$meta_holder = '<div class="tomb-meta-holder" id="'.$field['meta_holder'].'" data-meta="'.$value.'"></div>';
			}
			if (isset($field['width']) && !empty($field['width'])) {
				$width = 'data-width="'.$field['width'].'"';
			}
			if (isset($field['placeholder']) && !empty($field['placeholder'])) {
				$placeholder = $field['placeholder'];
			}
			$output .= '<select class="tomb-multiselect" name="'.$field['id'].'[]" id="'.$field['id'].'" multiple="multiple" '.$width.' data-placeholder="'.$placeholder.'">';
			foreach ( $field['options'] as $value => $label ) {
				$disabled = strpos($value, 'disabled') ? 'disabled="disabled"' : false;
				$output .= '<option value="'.$value.'" '.selected( in_array( $value, (array) $meta ), true, false ).' '. $disabled .'>'.$label.'</option>';
			}
			$output .= '</select>';
			$output .= $meta_holder;
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

	}

}
