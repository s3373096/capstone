<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TOMB_Url_Field' ) ) {

	class TOMB_Url_Field extends Themeone_Metabox_Fields {

		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 * @return string
		 */
		static function html( $meta, $field ) {

			// Check for std parameter
			if(!$meta && array_key_exists('std', $field)){
				$meta = $field['std'];
			}
			
			return sprintf(
				'<input type="text" class="tomb-text url %s" name="%s" id="%s" value="%s" placeholder="%s" %s>',
				$field['size'],
				$field['id'],
				$field['id'],
				$meta,
				$field['placeholder'],
				$field['disabled']
			);

		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 * @return array
		 */
		static function normalize_field( $field ) {

			$field = wp_parse_args( $field, array(
				'size' => 'large',
				'disabled' => ''
			) );

			return $field;

		}

		/**
		 * Sanitize url
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return string
		 */
		static function value( $new, $old, $post_id, $field ){
			return esc_url( $new );
		}

	}

}
