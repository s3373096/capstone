<?php

add_action('wp_ajax_display_shortcode_list', 'display_shortcode_list_callback');
function display_shortcode_list_callback() {

	if (isset($_POST['popup'])) {
	
	$title = __('Choose Shortcode', 'mobius');
	$loading = __('Loading', 'mobius');
?>

    
	<div id="themeone-sc-popup-outer">
		<div id="themeone-sc-overlay"></div>
		<div id="themeone-sc-popup">
            <div id="themeone-sc-header">
            	
				<span class="themeone-sc-title" data-loading="<?php echo $loading ?>" data-title="<?php echo $title ?>"><?php echo $title ?></span>
                <div id="themeone-sc-close" class="close-popup"><i class="fa">&times;</i></div>
			</div>
			<div id="themeone-sc-popup-inner" class="close-popup">
				<div id="themeone-sc-home">
					<div id="themeone-sc-home-inner">
                        <?php 
                        require_once( 'shortcodes-config.php' );
                        $shortcode = array();
						$sc_filter = array('All');
						$sc_button = null;
                        if(!empty($themeone_shortcodes)){
                            foreach($themeone_shortcodes as $key=>$val){
                               // $shortcode[] = new theme_sc_data($key,$val);
								$cat   = (isset($val['popup_category']) ? $val['popup_category'] : 'Other');
								$title = (isset($val['popup_title']) ? $val['popup_title'] : 'No Title Assigned!');
								$desc  = (isset($val['popup_desc']) ? $val['popup_desc'] : '');
								$icon  = (isset($val['shortcode_icon']) ? $val['shortcode_icon'] : '');
								
								if(!in_array($cat, $sc_filter, true)){
									array_push($sc_filter, $cat);
								}
								
								$sc_button .= '<span class="to-sc-button '. strtolower($cat) .'" data-name="'. $key .'">';
                                $sc_button .= '<i class="fa '. $icon .'"></i>';
								$sc_button .= '<span class="to-sc-button-title">'. $title .'</span>';
								$sc_button .= '<span class="to-sc-button-desc">'. $desc .'</span>';
                                $sc_button .= '</span>';
                            }
                        }
						echo '<div class="to-sc-filters">';
						echo '<div class="to-sc-current-filter">All</div>';
						foreach($sc_filter as $val){
							echo '<div class="to-sc-filter" data-filter=".'. strtolower($val) .'">'. $val .'</div>';
						}
						echo '</div>';
						echo '<div id="themeone-sc-generator-choices">';
						echo $sc_button;
						

                        ?>
                        </div>
					</div>
				</div>
				<div id="themeone-sc-content"></div>    
            </div>
            <div id="themeone-sc-footer">
            	<i id="themeone-sc-footer-overlay"></i>
                <div id="themeone-sc-footer-buttons">
            		<div id="themeone-sc-prev"><i class="fa fa-angle-left"></i></div>
                	<div id="themeone-sc-insert"><i class="fa steadysets-icon-checkmark"></i><?php echo __('Insert', 'mobius') ?></div>
                </div>
            </div>
        </div>
	</div>
    
<?php
	}
	die();
}

add_action('wp_ajax_load_shortcode', 'load_shortcode_callback');
function load_shortcode_callback() {

	if (isset($_POST['popup'])) {
		require_once( 'shortcodes-class.php' );
		$popup = $_POST['popup'];
		$shortcode = new themeone_shortcodes( $popup );
		
?>

<div id="themeone-popup" class="themeone-sc-content-inner">
	<form method="post" id="themeone-sc-form">
		<table id="themeone-sc-form-table">
			<?php echo $shortcode->output; ?>
			
		</table>
	</form>
</div>

<?php
	}
	die();
}


class theme_sc_data {

    var $conf;
    var $key;
    var $shortcode_icon;
    var $popup_title;
    var $has_child;

    function __construct( $key,$val ) {
        $this->conf = dirname(__FILE__) . '/shortcodes-config.php';
        $this->key = $key;
        $this->formate_shortcode($val);
    }
    function formate_shortcode($val) {
        $this->shortcode = $val['shortcode'];
        $this->popup_title = $val['popup_title'];
        $this->shortcode_icon = $val['shortcode_icon'];
    }
}

?>