<?php

// load wordpress
require_once('get_wp.php');

class themeone_shortcodes {
	
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var $cparams;
	var $cshortcode;
	var $popup_title;
	var $no_preview;
	var $has_child;
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup ) {
		if( file_exists( dirname(__FILE__) . '/shortcodes-config.php' ) ) {
			$this->conf = dirname(__FILE__) . '/shortcodes-config.php';
			$this->popup = $popup;
			$this->formate_shortcode();
		} else {
			$this->append_error('Config file does not exist');
		}
	}
	
	// --------------------------------------------------------------------------
	
	function formate_shortcode()
	{
		// get config file
		require_once( $this->conf );
		
		if( isset( $themeone_shortcodes[$this->popup]['child_shortcode'] ) ) {
			$this->has_child = true;
		}
		
		if( isset( $themeone_shortcodes ) && is_array( $themeone_shortcodes ) ) {
			// get shortcode config stuff
			$this->params = $themeone_shortcodes[$this->popup]['params'];
			$this->shortcode = $themeone_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $themeone_shortcodes[$this->popup]['popup_title'];
			$this->shortcode_icon = $themeone_shortcodes[$this->popup]['shortcode_icon'];
			
			// adds stuff for js use			
			$this->append_output( "\n" . '<div id="_themeone_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="_themeone_popup" class="hidden">' . $this->popup . '</div>' );
			
			if( isset( $themeone_shortcodes[$this->popup]['no_preview'] ) && $themeone_shortcodes[$this->popup]['no_preview'] ) {
				//$this->append_output( "\n" . '<div id="_themeone_preview" class="hidden">false</div>' );
				$this->no_preview = true;		
			}
			
			// filters and excutes params
			foreach( $this->params as $pkey => $param ) {
				// prefix the fields names and ids with themeone_
				$pkey = 'themeone_' . $pkey;
				
				// popup form row start
				$row_start  = '<div class="themeone-sc-label">' . $param['label'] . ' : </div>';
				$row_start .= '<div class="themeone-sc-content">';
				
				// popup form row end
				$row_end	= '<div class="themeone-sc-description">' . $param['desc'] . '</div>';
				$row_end   .= '</div>';				
				$row_end   .= '<div class="themeone-sc-separator ' . $pkey . '"></div>';
				
				switch( $param['type'] ) {
					case 'text' :
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="themeone-form-text themeone-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					
					case 'textchild' :
							// prepare
						$output  = $row_start;
						$output .= '<input type="text" style="display: none;" class="themeone-form-text themeone-input themeone-multi-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input type="text" class="themeone-form-text themeone-input to-multi-input" name="' . $pkey . '" id="' . $pkey . '-2" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input type="text" class="themeone-form-text themeone-input to-multi-input" name="' . $pkey . '" id="' . $pkey . '-2" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input type="text" class="themeone-form-text themeone-input to-multi-input" name="' . $pkey . '" id="' . $pkey . '-3" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input type="text" class="themeone-form-text themeone-input to-multi-input" name="' . $pkey . '" id="' . $pkey . '-4" value="' . $param['std'] . '" />' . "\n";
						$output .= '<div class="add-input-holder"><div class="add-input button-secondary">+ add item</div></div>';
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					
					case 'textarea' :
						// prepare
						$output  = $row_start;
						$output .= '<textarea rows="10" cols="30" name="' . $pkey . '" id="' . $pkey . '" class="themeone-form-textarea themeone-input">' . $param['std'] . '</textarea>' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					case 'select' :
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="themeone-form-select themeone-input">' . "\n";
						foreach( $param['options'] as $value => $option ) {
							$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
						}
						$output .= '</select>' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					case 'google-font' :
						$output  = $row_start;
						$output .= '<select class="google-fonts themeone-form-select">' . "\n";
						$fonts_file = THEMEONE_TINYMCE_URI . '/googlefonts.json';
						$fonts_file = file_get_contents($fonts_file);
						$json_fonts = json_decode($fonts_file,  true);
						$fonts = $json_fonts['items'];
						foreach ($fonts as $font) {
							$variants = null;
							$files    = null;
							$family = $font['family'];
							foreach ($font['variants'] as $variant) {
								$variants .= $variant .';';
								$files    .= $font['files'][$variant] .';';
							}
							$variants = rtrim($variants, ';');
							$files = rtrim($files, ';');
							$output .= '<option value="' . $family . '" data-font-variants="'. $variants .'" data-font-urls="'. $files .'">' . $family . '</option>' . "\n";
						}
						$output .= '</select>' . "\n";
						
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="themeone-form-select themeone-input">' . "\n";
						$output .= '</select>' . "\n";
						$output .= '<span class="google-font-preview">abcdefghijklmnopqrstuvwxyz<br>ABCDEFGHIJKLMNOPQRSTUVWXYZ</span>';
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					
					case 'widgetList' :
						if ( empty ( $GLOBALS['wp_widget_factory'] ) ) {
        					return;
						}
						$widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="themeone-form-select themeone-input">' . "\n";
						foreach( $widgets as $value ) {
							$replace = array('WP_Widget', 'WC_Widget', 'WP');
							$name    = str_replace($replace, '', $value);
							$name    = str_replace('_', ' ', $name);
							$output .= '<option value="' . $value . '">' . $name . '</option>' . "\n";
						}
						$output .= '</select>' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					
					case 'catList' :
						$args = array(
							'type'                     => 'portfolio',
							'taxonomy'                 => 'portfolio_category',
						); 
						$post_cat = get_categories(); 
						$port_cat = get_categories($args); 
						$categories = array_merge($post_cat, $port_cat);
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="themeone-form-select themeone-input">' . "\n";
						$output .= '<option value=""></option>' . "\n";
    					foreach ($categories as $category) {
							$name  = $category->cat_name;
							$value = $category->slug;
							$output .= '<option value="' . $value . '">' . $name . '</option>' . "\n";
						}
						$output .= '</select>' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
	
					case 'checkbox' :
						// prepare
						$output  = $row_start;
						$output .= '<label for="' . $pkey . '" class="themeone-form-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="themeone-input toggle" name="' . $pkey . '" id="' . $pkey . '"' . ( $param['std'] ? 'checked' : '' ) . ' />' . "\n";
						$output .= '</label>' . "\n";
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					case 'radio' :
						// prepare
						$output  = $row_start;
						$output .= '<div>';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<label style="margin-right: 3px" >' . $option . '</label>';
							$output .= '<input class="themeone-sc-radio themeone-input" type="radio" value="' . $value . '" name="' . $pkey . '" id="' . $pkey . '"'. ( $param['std'] == $value ? ' checked="checked"':'').' />';
						}
						$output .= '</div>';
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					case 'icon':
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="themeone-form-text themeone-icon-value themeone-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<input type="text" class="to-search-icon themeone-form-text" value="Search icon"/>' . "\n";
						$output .= '<i class="to-search-icon-i li_search"></i>';
						$output .= '<div class="themeone-icons-holder">';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<i class="' . $value . ' icon-option" value="' . $value . '"></i>';
						}
						$output .= '</div>';
						$output .= $row_end;
						// append
						$this->append_output( $output );
						break;
					case 'fileimg':
						// prepare
						$output  = $row_start;
						$output .= '<div><input type="text" width="300" class="themeone-form-text themeone-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="button-upload-themeone button-secondary">' . __('Upload') . '</a>';
						$output .= '<a href="javascript:void(0);" style="display:none;" class="upload-remove-themeone button-secondary">' . __('Remove') . '</a>';
						$output .= '<img class="themeone-img" class="screenshot" id="screenshot-' . $pkey . '" src="" /></div>';	
						$output .= $row_end;	
						// append
						$this->append_output( $output );		
						break;
					case 'colorPicker':
						// prepare
						$output  = $row_start;
						$output  .= '<input type="text" value="' . $param['std'] . '" class="themeone-color-field themeone-input" id="' . $pkey . '"/>';
						if (class_exists("Themeone_config")) {
							global $mobius;
							$accentColor1 = $mobius['accent-color1'];
							$accentColor2 = $mobius['accent-color2'];
							$accentColor3 = $mobius['accent-color3'];
							$secondColor  = $mobius['second-bgcolor'];
							$output  .= '<div class="to-accent-preset"><label>Or preset colors</label>';
							$output  .= '<div class="to-accent-color" data-accent-color="accent-color1" style="background:'. $accentColor1 .'"></div>';
							$output  .= '<div class="to-accent-color" data-accent-color="accent-color2" style="background:'. $accentColor2 .'"></div>';
							$output  .= '<div class="to-accent-color" data-accent-color="accent-color3" style="background:'. $accentColor3 .'"></div>';
							$output  .= '<div class="to-accent-color" data-accent-color="second-bgcolor" style="background:'. $secondColor .'"></div></div>';
						}
						$output .= $row_end;	
						// append
						$this->append_output( $output );		
						break;
					case 'sliderRange':
						// prepare
						$output  = $row_start;
						$output .= '<div class="themeone-slider-range"></div>';
						$output .= '<input type="text" value="'.$param['std'].'" disabled="disabled" class="themeone-slider-input themeone-input" data-min="'.$param['min'].'" data-max="'.$param['max'].'" data-step="'.$param['step'].'" data-sign="'.$param['sign'].'" id="' . $pkey . '"/>';
						$output .= $row_end;	
						// append
						$this->append_output( $output );		
						break;
				}
			}
			
			// checks if has a child shortcode
			if( isset( $themeone_shortcodes[$this->popup]['child_shortcode'] ) ) {
				// set child shortcode
				$this->cparams = $themeone_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $themeone_shortcodes[$this->popup]['child_shortcode']['shortcode'];
				// popup parent form row start
				$prow_start  = '<tbody>' . "\n";
				$prow_start .= '<tr class="form-row has-child">' . "\n";
				$prow_start .= '<td>';
				$prow_start .= '<div class="child-clone-rows">' . "\n";
				// for js use
				$prow_start .= '<div id="_themeone_cshortcode" class="hidden">' . $this->cshortcode . '</div>' . "\n";
				// start the default row
				$prow_start .= '<div class="child-clone-row">' . "\n";
				$prow_start .= '<ul class="child-clone-row-form">' . "\n";
				// add $prow_start to output
				$this->append_output( $prow_start );
				foreach( $this->cparams as $cpkey => $cparam ) {
					// prefix the fields names and ids with themeone_
					$cpkey = 'themeone_' . $cpkey;
					// popup form row start
					$crow_start  = '<li class="child-clone-row-form-row">' . "\n";
					$crow_start .= '<div class="child-clone-row-label themeone-sc-label">' . "\n";
					$crow_start .= '<label>' . $cparam['label'] . '</label>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start .= '<div class="child-clone-row-field themeone-sc-content">' . "\n";
					// popup form row end
					$crow_end	  = '<span class="child-clone-row-desc themeone-sc-description">' . $cparam['desc'] . '</span>' . "\n";
					$crow_end   .= '</div>' . "\n";
					$crow_end   .= '</li>' . "\n";
					switch( $cparam['type'] ) {
						case 'text' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="themeone-form-text themeone-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'textchild' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" style="display: none;" class="themeone-form-text themeone-cinput themeone-multi-input" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input type="text" class="themeone-form-text themeone-cinput themeone-input-child" name="' . $cpkey . '" id="' . $cpkey . '-2" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input type="text" class="themeone-form-text themeone-cinput themeone-input-child" name="' . $cpkey . '" id="' . $cpkey . '-2" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input type="text" class="themeone-form-text themeone-cinput themeone-input-child" name="' . $cpkey . '" id="' . $cpkey . '-3" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input type="text" class="themeone-form-text themeone-cinput themeone-input-child" name="' . $cpkey . '" id="' . $cpkey . '-4" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<div class="add-input-holder"><div class="add-input button-secondary">+ add item</div></div>';
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'textarea' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="10" cols="30" name="' . $cpkey . '" id="' . $cpkey . '" class="themeone-form-textarea themeone-cinput">' . $cparam['std'] . '</textarea>' . "\n";
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'select' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<select name="' . $cpkey . '" id="' . $cpkey . '" class="themeone-form-select themeone-cinput">' . "\n";
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
							}
							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'checkbox' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<label for="' . $cpkey . '" class="themeone-form-checkbox">' . "\n";
							$coutput .= '<input type="checkbox" class="themeone-cinput toggle" name="' . $cpkey . '" id="' . $cpkey . '" ' . ( $cparam['std'] ? 'checked' : '' ) . ' />' . "\n";
							$coutput .= '</label>' . "\n";
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'radio' :
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div>';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<label for="' . $cpkey . '" style="margin-right: 3px" >' . $option . '</label>';
								$coutput .= '<input class="themeone-sc-radio themeone-cinput" type="radio" value="' . $value . '" name="' . $cpkey . '" id="' . $cpkey . '"'. ( $cparam['std'] == $value ? ' checked="checked"':'').' />';
							}
							$coutput .= '</div>';
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						case 'icon':
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="themeone-form-text themeone-icon-value themeone-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<input type="text" class="to-search-icon themeone-form-text" value="Search icon"/>' . "\n";
							$coutput .= '<i class="to-search-icon-i li_search"></i>';
							$coutput .= '<div class="themeone-icons-holder">';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<i class="' . $value . ' icon-option-child" value="' . $value . '"></i>';
							}
							$coutput .= '</div>';
							$coutput .= $crow_end;
							// append
							$this->append_output( $coutput );
							break;
						
						case 'fileimg':
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div><input type="text" width="300" class="themeone-form-text themeone-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="button-upload-themeone button-secondary">' . __('Upload') . '</a>';
							$coutput .= '<a href="javascript:void(0);" style="display:none;" class="upload-remove-themeone button-secondary">' . __('Remove') . '</a>';
							$coutput .= '<img class="themeone-img" class="screenshot" id="screenshot-' . $cpkey . '" src="" /></div>';	
							$coutput .= $crow_end;	
							// append
							$this->append_output( $coutput );		
							break;
						case 'colorPicker':
							// prepare
							$coutput  = $crow_start;
							$coutput  .= '<input type="text" value="' . $cparam['std'] . '" class="themeone-color-field themeone-cinput" id="' . $cpkey . '"/>';
							if (class_exists("Themeone_config")) {
								global $mobius;
								$accentColor1 = $mobius['accent-color1'];
								$accentColor2 = $mobius['accent-color2'];
								$accentColor3 = $mobius['accent-color3'];
								$coutput  .= '<div class="to-accent-preset"><label>Or Accent colors</label>';
								$coutput  .= '<div class="to-accent-color" data-accent-color="accent-color1" style="background:'. $accentColor1 .'"></div>';
								$coutput  .= '<div class="to-accent-color" data-accent-color="accent-color2" style="background:'. $accentColor2 .'"></div>';
								$coutput  .= '<div class="to-accent-color" data-accent-color="accent-color3" style="background:'. $accentColor3 .'"></div></div>';
							}
							$coutput .= $crow_end;	
							// append
							$this->append_output( $coutput );		
							break;
						case 'sliderRange':
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="themeone-slider-range"></div>';
							$coutput .= '<input type="text" value="'.$cparam['std'].'" disabled="disabled" class="themeone-slider-input themeone-cinput" data-min="'.$cparam['min'].'" data-max="'.$cparam['max'].'" data-sign="'.$cparam['sign'].'" id="' . $cpkey . '"/>';
							$coutput .= $crow_end;	
							// append
							$this->append_output( $coutput );		
							break;
					}
				}
				
				// popup parent form row end
				$prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
				$prow_end   .= '</div>' . "\n";		// end .child-clone-row
				
				$prow_end   .= '</div>' . "\n";		// end .child-clone-rows
				$prow_end   .= '<a href="#" id="form-child-add" class="button-secondary">' . $themeone_shortcodes[$this->popup]['child_shortcode']['clone_button'] . '</a>' . "\n";
				$prow_end   .= '</td>' . "\n";
				$prow_end   .= '</tr>' . "\n";					
				$prow_end   .= '</tbody>' . "\n";
				
				// add $prow_end to output
				$this->append_output( $prow_end );
			}			
		}
	}
	
	// --------------------------------------------------------------------------
	
	function append_output( $output ) {
		$this->output = $this->output . "\n" . $output;		
	}
	
	// --------------------------------------------------------------------------
	
	function reset_output( $output ) {
		$this->output = '';
	}
	
	// --------------------------------------------------------------------------
	
	function append_error( $error ) {
		$this->errors = $this->errors . "\n" . $error;
	}
}

?>