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
# Create Taxonomy MetaBox
#-----------------------------------------------------------------#

if ( !class_exists('themeone_Taxonomy_Metabox') ) {
	
	// Pretty metabox class.
	class themeone_Taxonomy_Metabox {
		// Holds meta box object
		protected $_meta_box;
		var $errors;
		public $fields;
		public $saved = false;

		// Holds the form being displayed either add or edit
		protected $_form_type;

		// Constructor - get the class hooked in and ready
		public function __construct( $meta_box ) {
			// Load only in admin area.
		    if (!is_admin()) {
				return;
			}
			// Prepare the metabox values with the class variables.
		    $this->_meta_box = $meta_box;
		    $this->fields = &$this->_meta_box['fields'];
			// Set default values for fields
			$this->_meta_box['fields'] = themeone_meta_box::normalize_fields( $this->_meta_box['fields'] );
			// Run metabox output & save methods
			$page = $this->_meta_box['taxonomy'];
			//add fields to edit form
      		add_action($page.'_edit_form_fields',array( $this, 'show_edit_form' ));
      		//add fields to add new form
      		add_action($page.'_add_form_fields',array( $this, 'show_new_form' ));
      		// this saves the edit fields
      		add_action( 'edited_'.$page, array( $this, 'save' ), 10, 2);
		    // this saves the add fields
		    add_action( 'created_'.$page,array( $this, 'save' ), 10, 2 );
			//delete term meta on term deletion
    		add_action('delete_term', array( $this, 'delete_term_metadata'), 10, 2 );
			// Enqueue styles and scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		}

		// Get the metabox id.
		public function get_id() {
			return $this->_meta_box['id'];
		}

		// Load metabox on term add page.
		public function show_new_form( $term_id ) {
			 $this->_form_type = 'new';
			 $this->show_metabox($term_id);
		}

		// Load metabox on term edit page.
		public function show_edit_form( $term_id ) {
			 $this->_form_type = 'edit';
			 $this->show_metabox($term_id);
		}

		// Show metabox on term edit page.
		public function show_metabox( $term_id ) {
			wp_nonce_field( "wppf-save-{$this->_meta_box['id']}", "nonce_{$this->_meta_box['id']}" );
			$style = null;
			$color = $this->_meta_box['color'];
			$background =  $this->_meta_box['background'];
			if (isset($color) && isset($background)) {
				$style = 'style="color:'.$color.';background:'.$background.';"';
			}
			echo '<table class="form-table tomb-table tomb-taxonomy-table"><tbody>';
			echo '<h2 class="tomb-taxonomy-header" '.$style.'><span><div class="tomb-icon">'.$this->_meta_box['icon'].'</div>'.$this->_meta_box['title'].'</span></h2>';
			foreach ( $this->fields as $field ) {
				// Display content before markup of the single field
				echo self::before_field($field);
				// Get single field markup
				$taxonomy = $this->_meta_box['taxonomy'];
				$saved    = $this->get_tax_meta( $taxonomy, $term_id, $field['id'] );
				$field['std'] = ( $saved !== '' ) ? $saved : (isset($field['std'])? $field['std'] : '');
				call_user_func( array( themeone_meta_box::get_class_name( $field ), 'show_taxonomy' ), $field, $field['std'] );
				// Display content before markup of the single field
				echo self::after_field($field);

			}
			echo '</tbody></table>';
		}
		
		// Show custom markup before the markup of the field.
		static function before_field($field) {
			$output = null;
			$field_class = themeone_meta_box::get_class_name($field);
			$required = null;
			$required_fields = null;
			$output .= '<tr>';
			$output .= '<th>';
			if ($field['name']) {
				$output .= '<label class="tomb-label">'.$field['name'].'</label>';
			}
			if ($field['desc']) {
				$output .= '<p class="tomb-desc">'.$field['desc'].'</p>';
			}
			$output .= '</th>';
			$output .= '<td class="tomb-field">';
			return $output;
		}
		// Show custom markup after the markup of the field.
		static function after_field($field) {
			$output  = null;
			
			$field_class = themeone_meta_box::get_class_name($field);
			if ($field['sub_desc']) {
				$output .= '<p class="tomb-sub-desc">'.$field['sub_desc'].'</p>';
			}
			$output .= '</td>';
			$output .= '</tr>';
			return $output;
		}

		// Save data from meta box
		public function save( $term_id ) {
			// Check if the we are coming from quick edit.
			if (isset($_REQUEST['action'])  &&  $_REQUEST['action'] == 'inline-save-tax') {
				return $term_id;
			}
		    // Check whether form is submitted properly
			$id    = $this->_meta_box['id'];
			$taxo  = $this->_meta_box['taxonomy'];
			$nonce = isset( $_POST["nonce_{$id}"] ) ? sanitize_key( $_POST["nonce_{$id}"] ) : '';
			if ( empty( $_POST["nonce_{$id}"] ) || ! wp_verify_nonce( $nonce, "wppf-save-{$id}" ) )
				return;
			// Cycle through each field and save the values.
			foreach ( $this->fields as $field ) {
				//$taxo = $field['taxonomy'];
				$name = $field['id'];
				$old  = $this->get_tax_meta( '', $term_id, $name );
				$new  = isset( $_POST[$name] ) ? $_POST[$name] : '';
				$cat_meta[$name] = $new;
				update_option($taxo.'_'.$term_id, $cat_meta );
			}
		}		

		// Retrieve data from taxonomy term
		function get_tax_meta( $taxonomy, $term_id, $key ) {
			$t_id = (is_object($term_id))? $term_id->term_id: $term_id;
			$m = get_option($taxonomy.'_'.$t_id);
			if (isset($m[$key]) ){
				return $m[$key];
		    } else{
		    	return '';
		    }
		}
		
		// Delete data from taxonomy term
		static function delete_tax_meta( $taxonomy, $term_id, $key ) {
			$m = get_option( $taxonomy.'_'.$term_id );
			if ( isset($m[$key]) ){
		      unset($m[$key]);
		    }
		    update_option( $taxonomy.'_'.$term_id, $m );
		}
		
		// Delete term meta options on term delete
		static function delete_term_metadata( $term, $term_id ) {
			delete_option( 'tax_meta_'.$term_id );
		}

		// Enqueue common styles
		function admin_enqueue_scripts() {
			$screen = get_current_screen();
			// Enqueue scripts and styles for registered pages (post types) only
			if ( ! in_array( $screen->taxonomy, $this->_meta_box ) )
				return;
			$fields = themeone_meta_box::get_fields( $this->fields );
			foreach ( $fields as $field ) {
				// Enqueue scripts and styles for fields
				call_user_func( array( themeone_meta_box::get_class_name( $field ), 'admin_enqueue_scripts' ) );
			}
		}
	}

}