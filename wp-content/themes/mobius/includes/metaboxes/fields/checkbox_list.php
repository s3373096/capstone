<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TOMB_Checkbox_List_Field' ) ) {

	class TOMB_Checkbox_List_Field extends Themeone_Metabox_Fields {

		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 * @return string
		 *
		 */
		static function html( $meta, $field ) {

			if(!isset($meta) && array_key_exists('std', $field)){
				$meta = $field['std'];	
			}
			$meta = (array) $meta;
			
			$output = null;
			$tpl    = '<label><input type="checkbox" class="tomb-checkbox-list" name="%s" value="%s"%s> %s</label>';
			foreach ( $field['options'] as $value => $label ) {
				$output .= '<input type="checkbox" class="tomb-checkbox-list" name="'.$field['id'].'[]" id="'.$field['id'].'" value="'.$value.'" '.checked( in_array( $value, $meta ), 1, false ).'>';
				$output .= '<label >'.$label.'</label><br>';
			}
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
				'options' => array()
			));

			return $field;

		}

	}

}
