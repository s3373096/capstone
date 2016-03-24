<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TOMB_Code_Field' ) ) {

	class TOMB_Code_Field extends Themeone_Metabox_Fields {
		
		static function admin_enqueue_scripts() {
			wp_register_script('codemirror', TOMB_URL . 'assets/js/codemirror.js');
			wp_register_script('codemirror-js', TOMB_URL . 'assets/js/mode/javascript.js');
			wp_register_script('codemirror-css', TOMB_URL . 'assets/js/mode/css.js');
			wp_enqueue_script('codemirror');
			wp_enqueue_script('codemirror-js');
			wp_enqueue_script('codemirror-css');
			wp_enqueue_style('codemirror', TOMB_URL . 'assets/css/codemirror.css');
		}
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
			
			$output = '<textarea class="tomb-code large-text" data-mode="'.$field['mode'].'" data-theme="'.$field['theme'].'" name="'.$field['id'].'" id="'.$field['id'].'" cols="'.$field['cols'].'" rows="'.$field['rows'].'" placeholder="'.$field['placeholder'].'">'.$meta.'</textarea>';
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
				'cols' => 1,
				'rows' => 5,
			) );

			return $field;

		}

		/**
		 * Sanitize
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return string
		 */
		static function value( $new, $old, $post_id, $field ){
			return wp_filter_nohtml_kses( $new );
		}

	}

}
