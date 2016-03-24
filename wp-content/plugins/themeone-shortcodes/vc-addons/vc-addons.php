<?php

/*-----------------------------------------------------------------------------------*/
/*	Define template directory
/*-----------------------------------------------------------------------------------*/

$dir    = THEMEONE_VC_DIR . '/vc-templates';
vc_set_shortcodes_templates_dir( $dir );

/*-----------------------------------------------------------------------------------*/
/*	Remove unnecessary Visual Composer elements
/*-----------------------------------------------------------------------------------*/

vc_remove_element("vc_text_separator");
vc_remove_element("vc_gallery");
vc_remove_element("vc_raw_html");
vc_remove_element("vc_raw_js");
vc_remove_element("vc_empty_space");
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_masonry_media_grid");
vc_remove_element("vc_icon");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_facebook");
vc_remove_element("vc_tweetmeme");
vc_remove_element("vc_googleplus");
vc_remove_element("vc_facebook");
vc_remove_element("vc_pinterest");
vc_remove_element("vc_message");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_flickr");
vc_remove_element("vc_tour");
vc_remove_element("vc_separator");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta");
vc_remove_element("vc_tta_tabs");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_accordion");
vc_remove_element("vc_accordion_tab");
vc_remove_element("vc_toggle");
vc_remove_element("vc_tabs");
vc_remove_element("vc_tab");
vc_remove_element("vc_pie");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_text");

/*-----------------------------------------------------------------------------------*/
/*	VC_Row Mods/Additions
/*-----------------------------------------------------------------------------------*/

vc_remove_param("vc_row", "bg_color");
vc_remove_param("vc_row", "font_color");
vc_remove_param("vc_row", "bg_image");
vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "video_bg_parallax");
vc_remove_param("vc_row", "video_bg_url");
vc_remove_param("vc_row", "video_bg");

/*-----------------------------------------------------------------------------------*/
/*	Add news params to vc_Row
/*-----------------------------------------------------------------------------------*/

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Section Layout", 'mobius'),
	"param_name" => "to_section_layout",
	"value" => array(
		__("Boxed", 'mobius') => "boxed",
		__("Full width", 'mobius') => "full-width",
		),
	"description" => __("Choose the type of layout. In most of case you should use boxed layout.",'mobius'),
	"dependency" => array("element" => "to_para_bg", "value" => array("no_bg","image","vimeo","youtube","video"))
));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Section Layout", 'mobius'),
	"param_name" => "to_section_layout",
	"value" => array(
		__("Boxed", 'mobius') => "boxed",
		__("Full width", 'mobius') => "full-width",
		),
	"description" => __("Choose the type of layout. In most of case you should use boxed layout.",'mobius'),
));
vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Equal height columns", 'mobius'),
	"param_name" => "to_equal_column",
	"value" => array("equal_height"=>__("equal_height", 'mobius')),
	"description" => __("Check this option if you want to have all children columns at the same height", 'mobius'),
));
vc_add_param('vc_row_inner',array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Equal height columns", 'mobius'),
	"param_name" => "to_equal_column",
	"value" => array("equal_height"=>__("equal_height", 'mobius')),
	"description" => __("Check this option if you want to have all children columns at the same height", 'mobius'),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text Color Scheme", 'mobius'),
	"param_name" => "txt_section_color",
	"value" => array(
		"" => "",
		__("Dark", 'mobius') => "dark",
		__("Light", 'mobius') => "light"
		),
	"description" => __("You can set a text color scheme for the section. If no color is chosen, the default text color of the theme will be set. If you didn't choose a background color, you will probably don't need to apply a text color",'mobius'),
));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text Color Scheme", 'mobius'),
	"param_name" => "txt_section_color",
	"value" => array(
		"" => "",
		__("Dark", 'mobius') => "dark",
		__("Light", 'mobius') => "light"
		),
	"description" => __("You can set a text color scheme for the section. If no color is chosen, the default text color of the theme will be set. If you didn't choose a background color, you will probably don't need to apply a text color",'mobius'),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text alignment", 'mobius'),
	"param_name" => "txt_section_align",
	"value" => array(
		"" => "",
		__("Left", 'mobius') => "txt-left",
		__("Center", 'mobius') => "txt-center",
		__("Right", 'mobius') => "txt-right"
		),
	"description" => __("Choose the text alignment",'mobius'),
));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text alignment", 'mobius'),
	"param_name" => "txt_section_align",
	"value" => array(
		"" => "",
		__("Left", 'mobius') => "txt-left",
		__("Center", 'mobius') => "txt-center",
		__("Right", 'mobius') => "txt-right"
		),
	"description" => __("Choose the text alignment",'mobius'),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Top Section Decoration", 'mobius'),
	"param_name" => "top_section_deco",
	"value" => array(
		"" => "",
		__("Slope Left", 'mobius') => "slope-left",
		__("Slope Right", 'mobius') => "slope-right",
		__("Rounded Outer", 'mobius') => "rounded-outer",
		__("Rounded Inner", 'mobius') => "rounded-inner",
		__("Triangle Outer", 'mobius') => "triangle-outer",
		__("Triangle Inner", 'mobius') => "triangle-inner",
		__("Arrow", 'mobius') => "arrow",
		__("Circle", 'mobius') => "circle",
		__("Clouds", 'mobius') => "clouds",
		__("circle", 'mobius') => "repeat-triangle",
		__("Triangle Pattern", 'mobius') => "repeat-triangle",
		__("Half Circle Pattern", 'mobius') => "repeat-circle",
		),
	"description" => __("If you want to style the section separator instead of a straight line, choose a decoration for the top section.",'mobius'),
	"dependency" => array("element" => "to_para_bg", "value" => array("no_bg"))
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Bottom Section Decoration", 'mobius'),
	"param_name" => "bot_section_deco",
	"value" => array(
		"" => "",
		__("Slope Left", 'mobius') => "slope-left",
		__("Slope Right", 'mobius') => "slope-right",
		__("Rounded Outer", 'mobius') => "rounded-outer",
		__("Rounded Inner", 'mobius') => "rounded-inner",
		__("Triangle Outer", 'mobius') => "triangle-outer",
		__("Triangle Inner", 'mobius') => "triangle-inner",
		__("Arrow", 'mobius') => "arrow",
		__("Circle", 'mobius') => "circle",
		__("Clouds", 'mobius') => "clouds",
		__("circle", 'mobius') => "repeat-triangle",
		__("Triangle Pattern", 'mobius') => "repeat-triangle",
		__("Half Circle Pattern", 'mobius') => "repeat-circle",
		),
	"description" => __("If you want to style the section separator instead of a straight line, choose a decoration for the bottom section.",'mobius'),
	"dependency" => array("element" => "to_para_bg", "value" => array("no_bg"))
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Background Style", 'mobius'),
	"param_name" => "to_para_bg",
	"value" => array(
		__("None", 'mobius') => "no_bg",
		__("Image", 'mobius') => "image",
		__("Side Image", 'mobius') => "side-image",
		__("Vimeo Video", 'mobius') => "vimeo",
		__("YouTube Video", 'mobius') => "youtube",
		__("Hosted Video", 'mobius') => "video",
		),
	"description" => __("Select what kind of background would you like to set for this row.", 'mobius')
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Parallax", 'mobius'),
	"param_name" => "to_parallax",
	"value" => array(__("parallax", 'mobius') => "parallax"),
	"description" => __("Check this box ",'mobius'),
	"dependency" => array("element" => "to_para_bg", "value" => array("image","vimeo","youtube","video")),
));	
vc_add_param('vc_row',array(
	"type" => "custom_upload",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Background Image", 'mobius'),
	"param_name" => "to_para_img",
	"description" => __("Upload or select background image from media gallery.", 'mobius'),
	"dependency" => array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __('Layout options', 'mobius'),
	"heading" => __("Side Image Position", 'mobius'),
	"param_name" => "to_side_img_position",
	"value" => array(
			__("Left", 'mobius') => "left",
			__("Right", 'mobius') => "right",
		),
	"description" => __("Choose the image position in the row (left or right position)",'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image")),
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Background Image Repeat", 'mobius'),
	"param_name" => "to_para_img_repeat",
	"value" => array(
			__("No Repeat", 'mobius') => "no-repeat",
			__("Repeat", 'mobius') => "repeat",
		),
	"description" => __("Options to control repeatation of the background image.",'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Background Blur", 'mobius'),
	"param_name" => "to_para_blur",
	"value" => array("blur"=>__("blur", 'mobius')),
	"description" => __("Check this option if you want to apply a blur effect on your image.", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "custom_upload",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Placehoder Image for the video", 'mobius'),
	"param_name" => "to_para_poster",
	"value" => "",
	"description" => __("Select the placehoder image that will be display while video is loading.", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("video","youtube","vimeo")),
));
vc_add_param('vc_row',array(
	"type" => "textfield",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Vimeo URL", 'mobius'),
	"param_name" => "to_para_vimeo_url",
	"value" => "",
	"description" => __("Enter your video URL. You can upload a video through <a href='/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("vimeo")),
));
vc_add_param('vc_row',array(
	"type" => "textfield",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Youtube URL", 'mobius'),
	"param_name" => "to_para_youtube_url",
	"value" => "",
	"description" => __("Enter YouTube url. Example - YouTube (https://www.youtube.com/watch?v=tSqJIIcxKZM) ", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("youtube")),
));
vc_add_param('vc_row',array(
	"type" => "custom_upload_file",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("M4V/MP4 video file", 'mobius'),
	"param_name" => "to_para_video_mp4",
	"value" => "",
	"description" => __("Upload or select your hosted video (M4V/MP4 format).", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("video")),
));
vc_add_param('vc_row',array(
	"type" => "custom_upload_file",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("OGV/OGG video file", 'mobius'),
	"param_name" => "to_para_video_ogg",
	"value" => "",
	"description" => __("Upload or select your hosted video (OGV/OGG format).", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("video")),
));
vc_add_param('vc_row',array(
	"type" => "custom_upload_file",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Webm video file", 'mobius'),
	"param_name" => "to_para_video_webm",
	"value" => "",
	"description" => __("Upload or select your hosted video (Webm format).", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("video")),
));
vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Background Overlay", 'mobius'),
	"param_name" => "to_para_over_set",
	"value" => array("overlay"=>__("overlay", 'mobius')),
	"description" => __("Hide or Show overlay on background images.", 'mobius'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("image","video","youtube","vimeo")),
));
vc_add_param('vc_row',array(
	"type" => "custom_upload",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Overlay Background Pattern", 'mobius'),
	"param_name" => "to_para_over_img",
	"value" => "",
	"description" => __("Upload or select background pattern overlay from media gallery.", 'mobius'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));
vc_add_param('vc_row',array(
	"type" => "custom_color",
	"class" => "",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Overlay Color", 'mobius'),
	"param_name" => "to_para_over_color",
	"value" => "",
	"description" => __("Select color for background overlay.", 'mobius'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));
vc_add_param('vc_row',array(
	"type" => "slider",
	"class" => "",
	"slider_min" => "0",
	"slider_max" => "1",
	"slider_step" => "0.01",
	"slider_sign" => "",
	"value" => "0.8",
	'group' => __( 'Layout options', 'mobius'),
	"heading" => __("Overlay Opacity", 'mobius'),
	"param_name" => "to_para_over_opacity",
	"description" => __("Set an opacity to the background overlay.", 'mobius'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));

/*-----------------------------------------------------------------------------------*/
/*	Add news params to vc_Column
/*-----------------------------------------------------------------------------------*/

vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text alignment", 'mobius'),
	"param_name" => "txt_column_align",
	"value" => array(
		"" => "",
		__("Left", 'mobius') => "txt-left",
		__("Center", 'mobius') => "txt-center",
		__("Right", 'mobius') => "txt-right"
		),
	"description" => __("Choose the text alignment",'mobius'),
));
vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Column Animation", 'mobius'),
	"param_name" => "anim",
	"value" => array(
		'' => '',
		'From Left' => __('from-left'),
		'From Right' => __('from-right'),
		'From Top' => __('from-top'),
		'From Bottom' => __('from-bottom'),
		'Grow In' => __('grow-in'),
		'Flip In' => __('flip-in')
	),
	"description" => __("Animation allows to animate a column when user scroll to it",'mobius'),		
));		
vc_add_param("vc_column", array(
	"type" => "slider",
	"slider_min" => "0",
	"slider_max" => "5000",
	"slider_step" => "1",
	"slider_sign" => "ms",
	"value" => "0",
	"heading" => __("Column Animation Delay", 'mobius'),
	"param_name" => "delay",
	"description" => __("It Allows to apply a delay when the column is reach before to display it with an animation", 'mobius'),
));


vc_add_param("vc_column_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text alignment", 'mobius'),
	"param_name" => "txt_column_align",
	"value" => array(
		"" => "",
		__("Left", 'mobius') => "txt-left",
		__("Center", 'mobius') => "txt-center",
		__("Right", 'mobius') => "txt-right"
		),
	"description" => __("Choose the text alignment",'mobius'),
));
vc_add_param("vc_column_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Column Animation", 'mobius'),
	"param_name" => "anim",
	"value" => array(
		'' => '',
		__('from-left') => 'From Left',
		__('from-right') => 'From Right',
		__('from-top') => 'From Top',
		__('from-bottom') => 'From Bottom',
		__('grow-in') => 'Grow In',
		__('flip-in') => 'Flip In'
	),
	"description" => __("Animation allows to animate a column when user scroll to it",'mobius'),		
));	
vc_add_param("vc_column_inner", array(
	"type" => "slider",
	"slider_min" => "0",
	"slider_max" => "5000",
	"slider_step" => "1",
	"slider_sign" => "ms",
	"value" => "0",
	"heading" => __("Column Animation Delay", 'mobius'),
	"param_name" => "delay",
	"description" => __("It Allows to apply a delay when the column is reach before to display it with an animation", 'mobius'),
));

/*-----------------------------------------------------------------------------------*/
/*	Add slider field param
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'slider', 'slider_settings_field' );
function slider_settings_field( $settings, $value ) {
	$output  = '<script type="text/javascript">vc_custom_silder();</script>';
	$output .= '<div class="slider_block">';
	$output .= '<div class="themeone-slider-range vc_btn-primary"></div>';
	$output .= '<input type="text" disabled="disabled" name="'.esc_attr($settings['param_name']).'" class="themeone-slider-input themeone-input wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']). '_field" value="'.esc_attr($value).'" data-min="'.esc_attr($settings['slider_min']).'" data-max="'.esc_attr($settings['slider_max']).'" data-step="'.esc_attr($settings['slider_step']).'" data-sign="'.esc_attr($settings['slider_sign']).'" />' . "\n";
	$output .= '</div>';
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Add custom color (auto accent color!!) field param
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'custom_color', 'custom_color_settings_field' );
function custom_color_settings_field( $settings, $value ) {
	$output  = '<script type="text/javascript">vc_custom_color();</script>';
	$output .= '<div class="custom_color_block">';
	$color   = $value;
	if (class_exists("Themeone_config")) {
		global $mobius;
		$color1active = null;
		$color2active = null;
		$color3active = null;
		$color4active = null;
		$accentColor1 = $mobius['accent-color1'];
		$accentColor2 = $mobius['accent-color2'];
		$accentColor3 = $mobius['accent-color3'];
		$secondColor  = $mobius['second-bgcolor'];
		if      ($value == 'accent-color1') {$color = $accentColor1; $color1active= ' active';}
		else if ($value == 'accent-color2')  {$color = $accentColor2; $color2active= ' active';}
		else if ($value == 'accent-color3')  {$color = $accentColor3; $color3active= ' active';}
		else if ($value == 'second-bgcolor') {$color = $secondColor;  $color4active= ' active';}
	}
	$output .= '<input type="text" value="'.esc_attr($color).'" class="themeone-color-field themeone-input"/>';
	$output .= '<input type="hidden" disabled="disabled" data-color="'.$color.'" name="'.esc_attr($settings['param_name']).'" value="'.esc_attr($value).'" class="wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']). '_field"/>';
	if (class_exists("Themeone_config")) {	
		$output .= '<div class="to-accent-preset"><label>Or preset colors</label>';
		$output .= '<div class="to-accent-color '.$color1active.'" data-accent-color="accent-color1" style="background:'. $accentColor1 .'"></div>';
		$output .= '<div class="to-accent-color '.$color2active.'" data-accent-color="accent-color2" style="background:'. $accentColor2 .'"></div>';
		$output .= '<div class="to-accent-color '.$color3active.'" data-accent-color="accent-color3" style="background:'. $accentColor3 .'"></div>';
		$output .= '<div class="to-accent-color '.$color4active.'" data-accent-color="second-bgcolor" style="background:'. $secondColor .'"></div></div>';
	}
	$output .= '</div>';
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Add custom upload image field param
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'custom_upload', 'custom_upload_settings_field' );
function custom_upload_settings_field( $settings, $value ) {
	$default_content = __( $value, "js_composer" );
	$output = '<div class="custom_upload_block">';
	$output .= '<input type="html" name="'.$settings['param_name'].'"  class="vc_textarea_html_content wpb_vc_param_value ' . $settings['param_name'] . '" value="' . htmlspecialchars( $default_content ) . '"/>';
	$output .= '<a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="vc-button-upload-themeone vc_btn vc_btn-primary">' . __('Upload', 'mobius') . '</a>';
	$output .= '<a href="javascript:void(0);" class="vc-upload-remove-themeone vc_btn vc_btn-default">' . __('Remove', 'mobius') . '</a>';
	$output .= '<img class="themeone-img" class="screenshot" src="' . esc_attr($value) . '" />';	
	$output .= '</div>';
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Add custom upload file field param
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'custom_upload_file', 'custom_upload_file_settings_field' );
function custom_upload_file_settings_field( $settings, $value ) {
	$default_content = __( $value, "js_composer" );
	$output = '<div class="custom_upload_file_block">';
	$output .= '<input type="html" name="'.$settings['param_name'].'"  class="vc_textarea_html_content wpb_vc_param_value ' . $settings['param_name'] . '" value="' . htmlspecialchars( $default_content ) . '"/>';
	$output .= '<a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="vc-button-upload-themeone vc_btn vc_btn-primary">' . __('Upload', 'mobius') . '</a>';
	$output .= '<a href="javascript:void(0);" class="vc-upload-remove-themeone vc_btn vc_btn-default">' . __('Remove', 'mobius') . '</a>';
	$output .= '</div>';
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Add category dropdown list field param
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'category', 'category_settings_field' );
function category_settings_field( $settings, $value ) {
	$args = array('type' => 'portfolio','taxonomy' => 'portfolio_category',); 
	$post_cat = get_categories(); 
	$port_cat = get_categories($args); 
	$categories = array_merge($post_cat, $port_cat);
	$current_value = $value;
	$output = '<div class="category_block">';
	$output .= '<select name="'. $settings['param_name']. '" class="wpb_vc_param_value wpb-input wpb-select '. $settings['param_name']. ' ' . $settings['type']. '">' . "\n";
	$output .= '<option value=""></option>' . "\n";
    foreach ($categories as $category) {
		$name  = $category->cat_name;
		$value = $category->slug;
		if ($current_value !== '' && (string) $value === (string) $current_value ) {
			$selected = ' selected="selected"';
		} else {
			$selected = null;
		}
		$output .= '<option value="' . $value . '"' . $selected . '>' . $name . '</option>' . "\n";
	}
	$output .= '</select>' . "\n";
	$output .= '</div>';
	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	REGISTER THEMEONE SHORTCODE FOR VISUAL COMPOSER
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Spacer
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'spacer_integrateWithVC' );
function spacer_integrateWithVC() {
vc_map( array(
	"name" => __( "Spacer", 'mobius'),
	"base" => __("themeone_spacer", 'mobius'),
	"icon" => "fa fa-2x fa-arrows-v themeone-icon",
	"description" => __("Add vertical space between elements",  "Add vertical space between elements", 'mobius'),
	"class" => "",
	"category" => __("Separator", 'mobius'),
	"params" => array(
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "1000",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "100",
			"heading" => __("Height", 'mobius'),
			"param_name" => "height",
			"description" => __("Choose a spacer height in px.", 'mobius'),
		),
		array(
			"type" => "textfield",
            "heading" => __( "Class", 'mobius'),
            "param_name" => "class",
            "value" => '',
            "description" => __( "Add a spacer class if you want to customize it", 'mobius')
		)
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Divider
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'divider_integrateWithVC' );
function divider_integrateWithVC() {
vc_map( array(
	"name" => __( "Divider", 'mobius'),
	"base" => __("themeone_divider", 'mobius'),
	"icon" => "fa fa-2x fa-ellipsis-h themeone-icon",
	"description" => __("Add horizontal line separator", 'mobius'),
	"class" => "",
	"category" => __( "Separator", 'mobius'),
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Solid", 'mobius') => "solid",
				__("Dashed", 'mobius') => "dashed",
				__("Dotted", 'mobius') => "dotted"
			),
			"std" => "Solid",
			"heading" => __("Style", 'mobius'),
			"param_name" => "style",
			"description" => __("Choose a style for the divider", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "left",
				__("Center", 'mobius') => "center",
				__("Right", 'mobius') => "right",
			),
			"std" => "center",
			"heading" => __("Position", 'mobius'),
			"param_name" => "position",
			"description" => __("Choose a position for the divider", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "1",
			"slider_max" => "100",
			"slider_step" => "1",
			"slider_sign" => "%",
			"value" => "50%",
			"heading" => __("Width", 'mobius'),
			"param_name" => "width",
			"description" => __("Choose a divider width in %", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "1",
			"slider_max" => "20",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "1px",
			"heading" => __("Height", 'mobius'),
			"param_name" => "height",
			"description" => __("Choose a divider height in px", 'mobius'),
		),
		array(
			"type" => "custom_color",
			'admin_label' => true,
			"value" => "#f5f6fa",
			"heading" => __("Color", 'mobius'),
			"param_name" => "color",
			"description" => __("Choose a color for the divider border", 'mobius'),
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Header
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'header_integrateWithVC' );
function header_integrateWithVC() {
vc_map( array(
	"name" => __( "Header", 'mobius'),
	"base" => __("themeone_header", 'mobius'),
	"icon" => "fa fa-2x  fa-text-height themeone-icon",
	"description" => __( "Add header to section or important sentence (SEO)", 'mobius'),
	"class" => "",
	"category" => __( "Typography", 'mobius'),
	"params" => array(
		array(
			"type" => "textarea_html",
			'holder' => 'h3',
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "content",
			"value" => __( "Your header title", 'mobius'),
			"description" => __( "Write your title header.", 'mobius')
		),
		array(
			"type" => "textfield",
			'holder' => 'p',
			"class" => "",
			"heading" => __( "Subtitle", 'mobius'),
			"param_name" => "subtitle",
			"value" => "",
			"description" => __( "Write your subtitle header. The subtilte is added at the bottom of the header title.", 'mobius')
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				'H1' => 'h1',
				'H2' => 'h2',
				'H3' => 'h3',
				'H4' => 'h4',
				'H5' => 'h5',
				'H6' => 'h6'
			),
			"heading" => __("Type", 'mobius'),
			"param_name" => "type",
			"description" => __("Choose the header type.<br>From order of SEO priority H1(most important) to H6.<br>H1 for website title/website page tile (only one per page).<br>H2 for blog entry title inside main page<br>H2, H3, H4, H5, H6, for your preferred key phrases", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "txt-left",
				__("Center", 'mobius') => "txt-center",
				__("Right", 'mobius') => "txt-right"
			),
			"heading" => __("Alignment", 'mobius'),
			"param_name" => "txtalign",
			"description" => __("Choose the header alignment text", 'mobius'),
		),
		array(
			"type" => "custom_color",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Color", 'mobius'),
            "param_name" => "txtcolor",
            "value" => '',
            "description" => __( "You can set a text color for the header.<br> If no color is chosen, the default text color of the theme will be set", 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Title Decoration", 'mobius'),
			"param_name" => "decor",
			"value" => array("decor"=>__("decor", 'mobius')),
			"description" => __("Add a decoration before and after the title. (an horizontal gradient bar color)", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Decoration Color", 'mobius'),
            "param_name" => "decorcolor",
            "value" => '',
            "description" => __( "Set decoration color", 'mobius'),
			"dependency" => array("element" => "decor", "value" => array("decor")),
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "10",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "2",
			"heading" => __("Decoration height", 'mobius'),
			"param_name" => "decorheight",
			"description" => __("Set an height to the decoration", 'mobius'),
			"dependency" => array("element" => "decor", "value" => array("decor")),
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Quote
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'quote_integrateWithVC' );
function quote_integrateWithVC() {
vc_map( array(
	"name" => __( "Quote", 'mobius'),
	"base" => __("themeone_quote", 'mobius'),
	"icon" => "fa fa-2x icon-et-quote themeone-icon",
	"description" => __("Add a formatted quote/citation", 'mobius'),
	"class" => "",
	"category" => __( "Typography", 'mobius'),
	"params" => array(
		array(
			"type" => "custom_color",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Quote Text Color", 'mobius'),
            "param_name" => "color",
            "value" => '',
            "description" => __( "Choose a color for quote text.<br> If no color is chosen, the default text color of the theme will be set", 'mobius')
		),
		array(
			"type" => "textarea",
			'holder' => 'p',
            "class" => "",
            "heading" => __( "Quote Content", 'mobius'),
            "param_name" => "content",
            "value" => '',
            "description" => __( "Type the quote content", 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Pull quote
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'pull_quote_integrateWithVC' );
function pull_quote_integrateWithVC() {
vc_map( array(
	"name" => __( "Pull Quote", 'mobius'),
	"base" => __("themeone_pull_quote", 'mobius'),
	"icon" => "fa fa-2x icon-et-focus themeone-icon",
	"description" => __("Add a pull quote floated inside text", 'mobius'),
	"class" => "",
	"category" => __( "Typography", 'mobius'),
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "left",
				__("Center", 'mobius') => "center",
				__("Right", 'mobius') => "right"
			),
			"heading" => __("Alignment", 'mobius'),
			"param_name" => "align",
			"description" => __("Select a pull quote alignment", 'mobius'),
		),
		array(
			"type" => "checkbox",
			'admin_label' => true,
			"class" => "",
			"heading" => __("Border", 'mobius'),
			"param_name" => "border",
			"value" => array("decor"=>__("decor", 'mobius')),
			"description" => __("check this option to add a top and bottom border to the pull quote", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "100",
			"slider_step" => "1",
			"slider_sign" => "%",
			"value" => "40",
			"heading" => __("Width", 'mobius'),
			"param_name" => "width",
			"description" => __("Choose a width of the pull quote in %", 'mobius'),
		),
		array(
			"type" => "textarea_html",
			'holder' => 'p',
            "class" => "",
            "heading" => __( "Content", 'mobius'),
            "param_name" => "content",
            "value" => '',
			"row_nb" => 20,
            "description" => __( "Type the pull quote content", 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Type Writer
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'type_writer_integrateWithVC' );
function type_writer_integrateWithVC() {
vc_map( array(
	"name" => __( "Type Writer", 'mobius'),
	"base" => "themeone_typewriter",
	"icon" => "fa-2x icon-et-printer themeone-icon",
	"description" => __("Animated text sentences like a type writer", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "10000",
			"slider_step" => "200",
			"slider_sign" => "ms",
			"value" => "2000",
			"heading" => __("Pause time between each word/sentence", 'mobius'),
			"param_name" => "pause",
			"description" => __("Choose the pause time in ms", 'mobius'),
		),	
		array(
			"type" => "custom_color",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Text color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "Choose a color for text", 'mobius')
		),
		array(
			"type" => "textarea",
			'holder' => 'p',
			"class" => "",
			"heading" => __( "Text", 'mobius'),
			"param_name" => "txt",
			"value" => __( "Professional;Creative;Passionate", 'mobius'),
			"description" => __( "Enter your word/sentences. Each word/sentence need to be separated by a semicolon (e.g: Professional;Creative;Passionate )", 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'themeone_button_integrateWithVC' );
function themeone_button_integrateWithVC() {
vc_map( array(
	"name" => __( "Button", 'mobius'),
	"base" => "themeone_button",
	"icon" => "fa-2x general-paperclip themeone-icon",
	"description" => __("Eye catching link button", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"front_enqueue_js" =>  THEMEONE_VC_URI .'/vc-sc.js',
	"params" => array(
		array(
			"type" => "textfield",
			'holder' => 'h5',
			"class" => "",
			"heading" => __( "Button Text", 'mobius'),
			"param_name" => "text",
			"value" => "Button",
			"description" => __( "Add the button's text.", 'mobius'),
			'group' => __( 'General', 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "URL", 'mobius'),
			"param_name" => "url",
			"value" => "",
			"description" => __( "Add the button's url (e.g http://example.com)", 'mobius'),
			'group' => __( 'General', 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("_self", 'mobius') => "_self",
				__("_blank", 'mobius') => "_blank"
			),
			"heading" => __("Target", 'mobius'),
			"param_name" => "target",
			"description" => __("_self = open in same window. _blank = open in new window", 'mobius'),
			'group' => __( 'General', 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Tiny", 'mobius') => "tiny",
				__("Small", 'mobius') => "small",
				__("Regular", 'mobius') => "regular",
				__("Large", 'mobius') => "large"
			),
			"std"     => 'regular',
			"heading" => __("Size", 'mobius'),
			"param_name" => "size",
			"description" => __("Select the button's size", 'mobius'),
			'group' => __( 'Styles', 'mobius'),
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("Standard", 'mobius') => "standard",
				__("Full width", 'mobius') => "full-width"
			),
			"heading" => __("Button Type", 'mobius'),
			"param_name" => "type",
			"description" => __("Select the button's type", 'mobius'),
			'group' => __( 'Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("Fully rounded", 'mobius') => "full-rounded",
				__("Rounded", 'mobius') => "rounded",
				__("Square", 'mobius') => "square",
			),
			"heading" => __("Button Border", 'mobius'),
			"param_name" => "border",
			"description" => __("Select the button's border radius aspect", 'mobius'),
			'group' => __( 'Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("Full background", 'mobius') => "to-button-bg",
				__("Border", 'mobius') => "to-button-border"
			),
			"heading" => __("Button style", 'mobius'),
			"param_name" => "style",
			"description" => __("Select the button's style.<br>The border color correspond to the text color.", 'mobius'),
			'group' => __( 'Styles', 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Button text color", 'mobius'),
            "param_name" => "txtcolor",
            "value" => "#ffffff",
            "description" => __( "Choose the button text/border color", 'mobius'),
			'group' => __( 'Colors', 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Button background color", 'mobius'),
            "param_name" => "bgcolor",
            "value" => "accent-color1",
            "description" => __( "Choose the button background color", 'mobius'),
			'group' => __( 'Colors', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Button background Animation", 'mobius'),
			"param_name" => "bganim",
			"value" => array("animate"=>__("animate", 'mobius')),
			"description" => __("Active this option if you want to add a background color animation on mouse over.", 'mobius'),
			'group' => __( 'Animations', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Button Icon Animation", 'mobius'),
			"param_name" => "iconanim",
			"value" => array("animate"=>__("animate", 'mobius')),
			"description" => __("Active this option if you want to show icon on mouse over.", 'mobius'),
			'group' => __( 'Animations', 'mobius')
		),
		array(
			"type" => "icons",
			'admin_label' => true,
			"class" => "",
			"heading" => "",
			"param_name" => "icon",
			"value" => "",
			"description" => __( "Select an icon", 'mobius'),
			'group' => __( 'Icons', 'mobius')
		)
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Mobius grid
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'mobius_grid_integrateWithVC' );
function mobius_grid_integrateWithVC() {
vc_map( array(
	"name" => __( "Mobius Grid", 'mobius'),
	"base" => "themeone_grid",
	"icon" => "fa-2x icon-et-grid themeone-icon",
	"description" => __("Show blog/works in a vertical or horizontal grid", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "slider",
			"slider_min" => "4",
			"slider_max" => "25",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "4",
			"heading" => __("Number of elements in the grid", 'mobius'),
			"param_name" => "postnb",
			"description" => __("Set the number of post to display inside the grid on load", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("grid", 'mobius') => "grid",
				__("Masonry", 'mobius') => "masonry"
			),
			"heading" => __("Layout", 'mobius'),
			"param_name" => "gridtype",
			"description" => __("Choose the type of grid (masonry or grid style", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Portfolio", 'mobius') => "portfolio",
				__("Blog", 'mobius') => "post",
				__("Blog & Portfolio", 'mobius') => "both"
			),
			"heading" => __("Content Type", 'mobius'),
			"param_name" => "type",
			"description" => __("Choose the content type to display inside the grid)", 'mobius'),
		),
		array(
			"type" => "category",
			"value" => "",
			"heading" => __("Filter by category", 'mobius'),
			"param_name" => "category",
			"description" => __("Choose a category", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("None", 'mobius') => "none",
				__("Custom Order", 'mobius') => "menu_order",
				__("Title", 'mobius') => "title",
				__("Name Slug", 'mobius') => "name",
				__("Date", 'mobius') => "date",
				__("Random", 'mobius') => "rand",
			),
			"heading" => __("Order By", 'mobius'),
			"param_name" => "orderby",
			"description" => __("Select the order of items in the grid.", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Grid Filters", 'mobius'),
			"param_name" => "filters",
			"value" => array("filters"=>__("filters", 'mobius')),
			"description" => __("Check this option if you want to displays grid filters (filters correspond to blog/portfolio category.", 'mobius'),
			'group' => __( 'Grid Styles', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Horizontal Layout", 'mobius'),
			"param_name" => "hlayout",
			"value" => array("horizontal"=>__("true", 'mobius')),
			"description" => __("Check this option if you want to have an horizontal grid slider layout.", 'mobius'),
			'group' => __( 'Grid Styles', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "1",
			"slider_max" => "6",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "2",
			"heading" => __("Row Number", 'mobius'),
			"param_name" => "rownb",
			"description" => __("Set the number of row for the horizontal layout", 'mobius'),
			'group' => __( 'Grid Styles', 'mobius'),
			"dependency" => array("element" => "hlayout", "value" => array("true"))
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Grid Toggle Layout", 'mobius'),
			"param_name" => "toggle",
			"value" => array(__("toggle", 'mobius')=> "true"),
			"description" => __("Check this option if you want to have the toggle button to switch between horizontal and vertical layout.", 'mobius'),
			'group' => __( 'Grid Styles', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Grid Controls", 'mobius'),
			"param_name" => "controls",
			"value" => array(__("controls", 'mobius')=> "true"),
			"description" => __("Check this option if you want to display the arrows control button and the bullet navigation.", 'mobius'),
			'group' => __( 'Grid Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("None", 'mobius') => "",
				__("Load More ajax", 'mobius') => "ajax",
				__("Pagination number", 'mobius') => "page",

			),
			"heading" => __("Grid pagination/load more", 'mobius'),
			"param_name" => "pagination",
			"description" => __("Select the type of pagination.<br>Pagination must be only use on portfolio or blog template page. Load more allows to load next set of post with ajax.", 'mobius'),
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "50",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "0",
			"heading" => __("Grid Gutter Width", 'mobius'),
			"param_name" => "gutter",
			"description" => __("Set the gutter width of the grid (gutter = distance between each elemet in the grid", 'mobius'),
			'group' => __( 'Element Styles', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "1",
			"slider_step" => "0.01",
			"slider_sign" => "",
			"value" => "0.8",
			"heading" => __("Grid Element Ratio", 'mobius'),
			"param_name" => "ratio",
			"description" => __("Set the aspect ratio of the element in the grid (Ratio=Height/Width)", 'mobius'),
			'group' => __( 'Element Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Wide", 'mobius') => "wide",
				__("Wide center", 'mobius') => "wide center",
				__("Tall", 'mobius') => "tall",
				__("Tall center", 'mobius') => "tall center",
				__("Square left", 'mobius') => "square left",
				__("Square top", 'mobius') => "square top",
				__("Square center", 'mobius') => "square center"
			),
			"heading" => __("Force Post Element Size", 'mobius'),
			"param_name" => "postsize",
			"description" => __("If you want to force an unique size to every post element in the grid, select a size in the list", 'mobius'),
			'group' => __( 'Element Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Normal", 'mobius') => "normal",
				__("Wide", 'mobius') => "wide",
				__("Tall", 'mobius') => "tall",
				__("Square", 'mobius') => "square",
			),
			"heading" => __("Force Portfolio Element Size", 'mobius'),
			"param_name" => "portsize",
			"description" => __("If you want to force an unique size to every portfolio element in the grid, select a size in the list", 'mobius'),
			'group' => __( 'Element Styles', 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("Standard Style", 'mobius') => "style1",
				__("Bottom Title Style", 'mobius') => "style2",
				__("Centered title & category", 'mobius') => "style3",
			),
			"heading" => __("Portfolio Style", 'mobius'),
			"param_name" => "portstyle",
			"description" => __("Select a thumbnail style for the portfolio items", 'mobius'),
			'group' => __( 'Element Styles', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "2",
			"slider_max" => "8",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "6",
			"heading" => __("Grid Column Number (width > 1600px)", 'mobius'),
			"param_name" => "colsup",
			"description" => __("Set the number of column in the grid for a window width > 1600px", 'mobius'),
			'group' => __( 'Columns Settings', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "2",
			"slider_max" => "7",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "5",
			"heading" => __("Grid Column Number (width < 1600px)", 'mobius'),
			"param_name" => "col1600",
			"description" => __("Set the number of column in the grid for a window width < 1600px", 'mobius'),
			'group' => __( 'Columns Settings', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "1",
			"slider_max" => "6",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "4",
			"heading" => __("Grid Column Number (width < 1280px)", 'mobius'),
			"param_name" => "col1280",
			"description" => __("Set the number of column in the grid for a window width < 1280px", 'mobius'),
			'group' => __( 'Columns Settings', 'mobius')
		),
		array(
			"type" => "slider",
			"slider_min" => "1",
			"slider_max" => "5",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "3",
			"heading" => __("Grid Column Number (width < 1000px)", 'mobius'),
			"param_name" => "col1000",
			"description" => __("Set the number of column in the grid for a window width < 1000px", 'mobius'),
			'group' => __( 'Columns Settings', 'mobius')
		),

	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Tooltip
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'tooltip_integrateWithVC' );
function tooltip_integrateWithVC() {
vc_map( array(
	"name" => __( "Tooltip", 'mobius'),
	"base" => "themeone_tooltip",
	"icon" => "fa-2x general-target themeone-icon",
	"description" => __("Add a popup information on tooltip hover", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "textarea",
			'holder' => 'p',
			"class" => "",
			"heading" => __( "Content", 'mobius'),
			"param_name" => "text",
			"value" => __( "Your tooltip content", 'mobius'),
			"description" => __( "Enter the tooltip content", 'mobius')
		),
		array(
			"type" => "custom_color",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Color", 'mobius'),
            "param_name" => "color",
            "value" => "accent-color1",
            "description" => __( "Choose the button tooltip color", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Left position", 'mobius'),
			"param_name" => "left",
			"value" => "0",
			"description" => __( "Enter the top position in percent. The position is absolute to the parent container of the tooltip.<br><strong>(Value can be in % or px)</strong>", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Top position", 'mobius'),
			"param_name" => "top",
			"value" => "0",
			"description" => __( "Enter the top position in percent. The position is absolute to the parent container of the tooltip.<br><strong>(Value can be in % or px)</strong>", 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'progress_bar_integrateWithVC' );
function progress_bar_integrateWithVC() {
vc_map( array(
	"name" => __( "Progress Bar", 'mobius'),
	"base" => "themeone_progress_bar",
	"icon" => "fa-2x media-sliders-side themeone-icon",
	"description" => __("Animated progress bar to show off your skills", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your skill",
			"description" => __( "Enter a title for the progress bar", 'mobius')
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "100",
			"slider_step" => "1",
			"slider_sign" => "%",
			"value" => "80",
			"heading" => __("Percent", 'mobius'),
			"param_name" => "percent",
			"description" => __("Choose the percent of the progess bar", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "100",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "10",
			"heading" => __("Height", 'mobius'),
			"param_name" => "height",
			"description" => __("Choose an height for the progess bar", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Progress Bar Color", 'mobius'),
            "param_name" => "color",
            "value" => "accent-color1",
            "description" => __( "Choose a color for the progess bar", 'mobius')
		),
		
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Icons
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'icon_integrateWithVC' );
function icon_integrateWithVC() {
vc_map( array(
	"name" => __( "Icon", 'mobius'),
	"base" => "themeone_icon",
	"icon" => "fa-2x general-pinwheel themeone-icon",
	"description" => __("900+ amazing web font icons", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Small", 'mobius') => "fa-lg",
				__("Regular", 'mobius') => "fa-2x",
				__("Large", 'mobius') => "fa-3x",
				__("Big", 'mobius') => "fa-4x",
				__("Huge", 'mobius') => "fa-5x",
			),
			"std"     => 'fa-3x',
			"heading" => __("Size", 'mobius'),
			"param_name" => "size",
			"description" => __("Choose an icon size.<br> Tiny = current font size.<br> Small = current font size x 1.33.<br> Regular = current font size x 2.<br> Large = current font size x 3.<br> Big = current font size x 4.<br> Huge = current font size x 5", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Inline Icon", 'mobius'),
			"param_name" => "inline",
			"value" => array(__("inline", 'mobius')=> "true"),
			"description" => __("Active this option if you want to put an inline icon at the beginning of a paragraph or a header.", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Icon Color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "If no color is chosen, the default text color of the theme will be set.", 'mobius'),
			'group' => __( 'Colors', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Background", 'mobius'),
			"param_name" => "iconbg",
			"value" => array(__("iconbg", 'mobius')=> "true"),
			"description" => __("Add a full background under the icon.", 'mobius'),
			'group' => __( 'Colors', 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Background Color", 'mobius'),
            "param_name" => "bgcolor",
            "value" => "",
            "description" => __( "Choose a background color.<br>(If no background color is added, the default background color of the theme will be set)", 'mobius'),
			'group' => __( 'Colors', 'mobius'),
			"dependency" => array("element" => "iconbg", "value" => array("true"))
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Spinning Animation", 'mobius'),
			"param_name" => "spinning",
			"value" => array(__("rotate", 'mobius')=> "true"),
			"description" => __("This option allows to get any icon to rotate infinitely.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Background Animation", 'mobius'),
			"param_name" => "bganim",
			"value" => array(__("iconbg", 'mobius')=> "true"),
			"description" => __("Check this option if you want to animate the background color on icon over.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
			"dependency" => array("element" => "iconbg", "value" => array("true"))
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Flash", 'mobius') => "flash",
				__("Shake", 'mobius') => "shake",
				__("Bounce", 'mobius') => "bounce",
				__("Tada", 'mobius') => "tada",
				__("Swing", 'mobius') => "swing",
				__("Wobble", 'mobius') => "wobble",
				__("Pulse", 'mobius') => "pulse",
				__("rotate", 'mobius') => "rotate",
			),
			"heading" => __("Hover Animation", 'mobius'),
			"param_name" => "anim",
			"description" => __("Select the type of animation on icon over.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
		),
		
		array(
			"type" => "icons",
			'admin_label' => true,
            "heading" => "",
            "param_name" => "icon",
            "value" => "general-origami",
            "description" => __( "Select an icon", 'mobius'),
			'group' => __( 'Icons', 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Icon & text Config
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'icon_text_integrateWithVC' );
function icon_text_integrateWithVC() {
vc_map( array(
	"name" => __( "Icon & Text", 'mobius'),
	"base" => "themeone_icon_txt",
	"icon" => "fa-2x general-picture-list-2 themeone-icon",
	"description" => __("Content & icon layout (top, left, right)", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => 
		array(array(
			"type" => "textfield",
			"holder" => "h3",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => __( "Your title", 'mobius'),
			"description" => __( "Enter the content", 'mobius')
		),
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "Content", 'mobius'),
			"param_name" => "content",
			"value" => __( "Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et. Quisque euismod orci ut et lobortis aliquam.", 'mobius'),
			"description" => __( "Enter the tooltip content", 'mobius')
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "left",
				__("Top", 'mobius') => "top",
				__("Right", 'mobius') => "right",
			),
			"std"     => 'top',
			"heading" => __("Position", 'mobius'),
			"param_name" => "position",
			"description" => __("Choose the icon position", 'mobius'),
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(	
				__("Small", 'mobius') => "fa-lg",
				__("Regular", 'mobius') => "fa-2x",
				__("Large", 'mobius') => "fa-3x",
				__("Big", 'mobius') => "fa-4x",
				__("Huge", 'mobius') => "fa-5x",
			),
			"std"     => 'fa-4x',
			"heading" => __("Size", 'mobius'),
			"param_name" => "size",
			"description" => __("Choose an icon size.<br> Tiny = current font size.<br> Small = current font size x 1.33.<br> Regular = current font size x 2.<br> Large = current font size x 3.<br> Big = current font size x 4.<br> Huge = current font size x 5", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Icon Color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "If no color is chosen, the default text color of the theme will be set.", 'mobius'),
			'group' => __( 'Colors', 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Background", 'mobius'),
			"param_name" => "iconbg",
			"value" => array(__("iconbg", 'mobius')=> "true"),
			"description" => __("Add a full background under the icon.", 'mobius'),
			'group' => __( 'Colors', 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Background Color", 'mobius'),
            "param_name" => "bgcolor",
            "value" => "",
            "description" => __( "Choose a background color.<br>(If no background color is added, the default background color of the theme will be set)", 'mobius'),
			'group' => __( 'Colors', 'mobius'),
			"dependency" => array("element" => "iconbg", "value" => array("true"))
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Spinning Animation", 'mobius'),
			"param_name" => "spinning",
			"value" => array(__("rotate", 'mobius')=> "true"),
			"description" => __("This option allows to get any icon to rotate infinitely.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Background Animation", 'mobius'),
			"param_name" => "bganim",
			"value" => array(__("iconbg", 'mobius')=> "true"),
			"description" => __("Check this option if you want to animate the background color on icon over.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
			"dependency" => array("element" => "iconbg", "value" => array("true"))
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Flash", 'mobius') => "flash",
				__("Shake", 'mobius') => "shake",
				__("Bounce", 'mobius') => "bounce",
				__("Tada", 'mobius') => "tada",
				__("Swing", 'mobius') => "swing",
				__("Wobble", 'mobius') => "wobble",
				__("Pulse", 'mobius') => "pulse",
				__("rotate", 'mobius') => "rotate",
			),
			"heading" => __("Hover Animation", 'mobius'),
			"param_name" => "anim",
			"description" => __("Select the type of animation on icon over.", 'mobius'),
			'group' => __( 'Animations', 'mobius'),
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => "",
            "param_name" => "icon",
            "value" => "general-origami",
            "description" => __( "Select an icon", 'mobius'),
			'group' => __( 'Icons', 'mobius')
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Box anim
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'box_anim_integrateWithVC' );
function box_anim_integrateWithVC() {
vc_map( array(
	"name" => __( "Box anim icon/text", 'mobius'),
	"base" => "themeone_box_anim",
	"icon" => "fa-2x general-cube themeone-icon",
	"description" => __("Animzted content & icon on mouse over", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h3",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your title",
			"description" => __( "Enter the title", 'mobius')
		),
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "Content", 'mobius'),
			"param_name" => "content",
			"value" => "Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et. Quisque euismod orci ut et lobortis aliquam.",
			"description" => __( "Enter the content", 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Icon Color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "If no color is chosen, the default text color of the theme will be set.", 'mobius')
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => "",
            "param_name" => "icon",
            "value" => "general-origami",
            "description" => __( "Select an icon", 'mobius'),
		),
		
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Social Icon Config
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'social_icon_integrateWithVC' );
function social_icon_integrateWithVC() {
vc_map( array(
	"name" => __( "Social Icon", 'mobius'),
	"base" => "themeone_social_icon",
	"icon" => "fa-2x general-heart themeone-icon",
	"description" => __("Add link to your favorite social network", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Facebook", 'mobius') => "facebook",
				__("Twitter", 'mobius') => "twitter",
				__("Google+", 'mobius') => "google-plus",
				__("Linkedin", 'mobius') => "linkedin",
				__("Dribbble", 'mobius') => "dribbble",
				__("Pinterest", 'mobius') => "pinterest",
				__("Instagram", 'mobius') => "instagram",
				__("Youtube", 'mobius') => "youtube",
				__("Vimeo", 'mobius') => "vimeo",
				__("Flickr", 'mobius') => "flickr",
				__("Github", 'mobius') => "github",
				__("Stackoverflow", 'mobius') => "stack-overflow",
				__("Stackexchange", 'mobius') => "stack-exchange",
			),
			"heading" => __("Type", 'mobius'),
			"param_name" => "type",
			"description" => __("Choose your social type", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "URL", 'mobius'),
			"param_name" => "url",
			"value" => "",
			"description" => __( "Enter the social url", 'mobius')
		),	
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	List Config ul
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'list_ul_integrateWithVC' );
function list_ul_integrateWithVC() {
vc_map( array(
	"name" => __( "List", 'mobius'),
	"base" => "themeone_ul",
	"icon" => "fa-2x general-bullet-list themeone-icon",
	"description" => __("Organise & style your bullet lists", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"as_parent" => array('only' => 'themeone_li'),
	"content_element" => true,
	"is_container" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "txt-left",
				__("Center", 'mobius') => "txt-center",
				__("Right", 'mobius') => "txt-right",
			),
			"heading" => __("Text alignment", 'mobius'),
			"param_name" => "txtalign",
			"description" => __("Choose the text alignment of the list", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Boxed List", 'mobius'),
			"param_name" => "boxed",
			"value" => array(__("boxed", 'mobius')=> "true"),
			"description" => "",
		),	
		array(
			"type" => "custom_color",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "List text color", 'mobius'),
            "param_name" => "txtcolor",
            "value" => "",
            "description" => __( "You can set a text color for the list.<br> If no color is chosen, the default text color of the theme will be set", 'mobius')
		),
	),
	"default_content" => '
			[themeone_li  licolor="accent-color1" anim="swing" bullet="" icon="steadysets-icon-checkmark"]Your list item content[/themeone_li]
			[themeone_li  licolor="accent-color1" anim="swing" bullet="" icon="steadysets-icon-checkmark"]Your list item content[/themeone_li]
			[themeone_li  licolor="accent-color1" anim="swing" bullet="" icon="steadysets-icon-checkmark"]Your list item content[/themeone_li]
			[themeone_li  licolor="accent-color1" anim="swing" bullet="" icon="steadysets-icon-checkmark"]Your list item content[/themeone_li]
  ',
));
}

/*-----------------------------------------------------------------------------------*/
/*	List Config li
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'list_li_integrateWithVC' );
function list_li_integrateWithVC() {
vc_map( array(
	"name" => __( "List item", 'mobius'),
	"base" => "themeone_li",
	"icon" => "fa-2x general-bullet-list themeone-icon",
	"description" => __("Item for list element only", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"as_child" => array('only' => 'themeone_ul,themeone_ptable'),
	"params" => array(
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "List item content", 'mobius'),
			"param_name" => "content",
			"value" => "Your list item content",
			"description" => __( "Type the content of the list item.", 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Bullet item color", 'mobius'),
            "param_name" => "licolor",
            "value" => "",
            "description" => __( "You can set a color for each item bullet in the list.<br> If no color is chosen, the default text color of the theme will be set", 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Flash", 'mobius') => "flash",
				__("Shake", 'mobius') => "shake",
				__("Bounce", 'mobius') => "bounce",
				__("Tada", 'mobius') => "tada",
				__("Swing", 'mobius') => "swing",
				__("Wobble", 'mobius') => "wobble",
				__("Pulse", 'mobius') => "pulse",
				__("rotate", 'mobius') => "rotate",
			),
			"heading" => __("Bullet item animation", 'mobius'),
			"param_name" => "anim",
			"description" => __("Select the type of animation of the bullet on hover.", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Item custom bullet", 'mobius'),
			"param_name" => "bullet",
			"value" => "",
			"description" => __( "Enter your list item bullet.<br>It can be a number, a special characters in HTML or everything you want.", 'mobius')
		),
		array(
			"type" => "icons",
            "class" => "",
            "heading" => "",
            "param_name" => "icon",
            "value" => "",
            "description" => __( "Select an icon", 'mobius'),
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'ptable_integrateWithVC' );
function ptable_integrateWithVC() {
vc_map( array(
	"name" => __( "Princing Table", 'mobius'),
	"base" => "themeone_ptable",
	"icon" => "fa-2x business-note-dollar themeone-icon",
	"description" => __("Add table column to current pricing holder", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"as_parent" => array('only' => 'themeone_li'),
	"content_element" => true,
	'js_view' => 'VcColumnView',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h3",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your Title",
			"description" => __( "Enter the title of the table.", 'mobius')
		),
		array(
			"type" => "checkbox",
			'admin_label' => true,
			"class" => "",
			"heading" => __("Featured", 'mobius'),
			"param_name" => "featured",
			"value" => array(__("type", 'mobius')=> "true"),
			"description" => __("Enable this allows to highlight the featured pricing table", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Price", 'mobius'),
			"param_name" => "price",
			"value" => "30",
			"description" => __( "Enter the price of the table.", 'mobius')
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Table Value", 'mobius'),
			"param_name" => "value",
			"value" => "$",
			"description" => __( "Enter the value (dollar, euro, ...) of the table.", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Table Per", 'mobius'),
			"param_name" => "per",
			"value" => "/mo",
			"description" => __( "Enter the per value (/mo, /years, ...) of the table.", 'mobius')
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Link", 'mobius'),
			"param_name" => "link",
			"value" => "http://theme-one.com/mobius/",
			"description" => __( "Enter the url link for the button table. If no url is set, no button will appear.", 'mobius')
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("_self", 'mobius') => "_self",
				__("_blank", 'mobius') => "_blank"
			),
			"heading" => __("Button Target", 'mobius'),
			"param_name" => "target",
			"description" => __("_self = open in same window. _blank = open in new window", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Button Text", 'mobius'),
			"param_name" => "button",
			"value" => "",
			"description" => __( "Enter the button text of the table.", 'mobius')
		),
	),
	"default_content" => '
			[themeone_li licolor="accent-color3" anim="swing" bullet="" icon="steadysets-icon-checkmark"]Business[/themeone_li]
			[themeone_li licolor="accent-color3" anim="swing" bullet="" icon="steadysets-icon-checkmark"]All features[/themeone_li]
			[themeone_li licolor="accent-color3" anim="swing" bullet="" icon="steadysets-icon-checkmark"]This is included[/themeone_li]
			[themeone_li licolor="accent-color1" anim="swing" bullet="" icon="fa fa-times"]Unlimited data[/themeone_li]
			[themeone_li licolor="accent-color1" anim="swing" bullet="" icon="fa fa-times"]High speed[/themeone_li]
  ',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'tabs_integrateWithVC' );
function tabs_integrateWithVC() {
vc_map( array(
	"name" => __( "Tab", 'mobius'),
	"base" => "themeone_tabs",
	"icon" => "fa-2x icon-et-browser themeone-icon",
	"description" => __("Organise your content with tabs", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"as_parent" => array('only' => 'themeone_tab'),
	"content_element" => true,
	"is_container" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "txt-left",
				__("Center", 'mobius') => "txt-center",
				__("Right", 'mobius') => "txt-right",
			),
			"heading" => __("Alignment", 'mobius'),
			"param_name" => "alignment",
			"description" => __("Choose the tabs alignment. Only works for horizontal layout tabs", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Tabs overlay background color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "You can set a background color to the overlay tabs element", 'mobius')
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Tabs full width", 'mobius'),
			"param_name" => "full",
			"value" => array(__("full", 'mobius')=> "true"),
			"description" => "Strech tabs element to full width screen",
		),	
	),
	"default_content" => '
			[themeone_tab active="true" title="Wordpress"][/themeone_tab]
			[themeone_tab active="" title="Design/Graphics"][/themeone_tab]
			[themeone_tab active="" title="Updates &amp; Support"][/themeone_tab]
	',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Tab
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'tab_integrateWithVC' );
function tab_integrateWithVC() {
vc_map( array(
	"name" => __( "Tab", 'mobius'),
	"base" => "themeone_tab",
	"icon" => "fa-2x icon-et-browser themeone-icon",
	"description" => __("Organise your content with tab", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"as_child" => array('only' => 'themeone_tabs'),
	'allowed_container_element' => 'vc_row',
	"content_element" => true,
	'is_container' => true,
	'js_view' => 'VcColumnView',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "",
			"description" => __( "Enter the title of the tab", 'mobius')
		),
		array(
			"type" => "checkbox",
			'admin_label' => true,
			"class" => "",
			"heading" => __("Active", 'mobius'),
			"param_name" => "active",
			"value" => array(__("active", 'mobius')=> "true"),
			"description" => "Active tab on page load. (ONLY ONE TAB PER TABS)",
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'toggle_integrateWithVC' );
function toggle_integrateWithVC() {
vc_map( array(
	"name" => __( "Toggle", 'mobius'),
	"base" => "themeone_toggle",
	"icon" => "fa fa-2x icon-et-scope themeone-icon",
	"description" => __("Organise your content with tab", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"content_element" => true,
	'is_container' => true,
	'js_view' => 'VcColumnView',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your toggle title",
			"description" => __( "Enter the title of the toggle", 'mobius')
		),
		array(
			"type" => "checkbox",
			'admin_label' => true,
			"class" => "",
			"heading" => __("Activated", 'mobius'),
			"param_name" => "active",
			"value" => array(__("type", 'mobius')=> "true"),
			"description" => "Allows to active and display this toggle on page load",
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'accordion_integrateWithVC' );
function accordion_integrateWithVC() {
vc_map( array(
	"name" => __( "Accordion", 'mobius'),
	"base" => "themeone_accordion",
	"icon" => "fa fa-2x icon-et-scope themeone-icon",
	"description" => __("Organise your content with tab", 'mobius'),
	"class" => "",
	"category" => __( "Element", 'mobius'),
	"content_element" => true,
	'is_container' => true,
	'js_view' => 'VcColumnView',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your accordion title",
			"description" => __( "Enter the title of the accordion", 'mobius')
		),
		array(
			"type" => "checkbox",
			'admin_label' => true,
			"class" => "",
			"heading" => __("Active", 'mobius'),
			"param_name" => "active",
			"value" => array(__("active", 'mobius')=> "true"),
			"description" => "Allows to active and display a accordion on page load",
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Icon color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "You can set a color to the title icon of the accordion.<br> If no color is chosen, the default text color of the theme will be set to the icon", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => "",
            "param_name" => "icon",
            "value" => "",
            "description" => __( "Choose an icon if you want to display it before the accordion title.", 'mobius'),
			'group' => __( 'Icon', 'mobius')
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Pie Chart
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'pie_chart_integrateWithVC' );
function pie_chart_integrateWithVC() {
vc_map( array(
	"name" => __( "Pie Chart", 'mobius'),
	"base" => "themeone_pie_chart",
	"icon" => "fa-2x business-pie-chart themeone-icon",
	"description" => __("Animated pie bar with percent or icon", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Pie Chart Animation", 'mobius'),
			"param_name" => "anim",
			"value" => array(__("anim", 'mobius')=> "true"),
			"description" => "Allows to animate pie chart when it becomes visible on screen",
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "100",
			"slider_step" => "1",
			"slider_sign" => "%",
			"value" => "80%",
			"heading" => __("Percent", 'mobius'),
			"param_name" => "percent",
			"description" => __("Choose the percent of the pie chart", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "320",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "200px",
			"heading" => __("Size", 'mobius'),
			"param_name" => "size",
			"description" => __("Choose a size for the pie chart", 'mobius'),
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "50",
			"slider_step" => "1",
			"slider_sign" => "px",
			"value" => "5px",
			"heading" => __("Width", 'mobius'),
			"param_name" => "width",
			"description" => __("Choose the line width pie chart", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Pie Chart Bar Color", 'mobius'),
            "param_name" => "barcolor",
            "value" => "accent-color1",
            "description" => __( "Choose a color for the pie chart bar", 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Pie Chart Background Bar Color", 'mobius'),
            "param_name" => "bgcolor",
            "value" => "#F5F6fA",
            "description" => __( "Choose a color for the pie chart bar background", 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Pie Chart Icon Color", 'mobius'),
            "param_name" => "icolor",
            "value" => "",
            "description" => __( "Choose a color for the icon", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => "",
            "param_name" => "icon",
            "value" => "",
            "description" => __( "If you want to add an icon at the center of the pie chart instead of the percentage value, choose an icon.", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Counter
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'counter_integrateWithVC' );
function counter_integrateWithVC() {
vc_map( array(
	"name" => __( "Counter", 'mobius'),
	"base" => "themeone_counter",
	"icon" => "fa-2x general-speedometer themeone-icon",
	"description" => __("Animated numerical counter", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"holder" => "h5",
			"heading" => __( "Subject", 'mobius'),
			"param_name" => "subject",
			"value" => "Cups of coffe",
			"description" => __( "Enter the subject/title of the counter (e.g 'Cups of coffe')", 'mobius')
		),
		array(
			"type" => "dropdown",
			'admin_label' => true,
			"value" => array(
				__("Left", 'mobius') => "txt-left",
				__("Center", 'mobius') => "txt-center",
				__("Right", 'mobius') => "txt-right",
			),
			"heading" => __("Alignment", 'mobius'),
			"param_name" => "align",
			"description" => __("Choose the counter alignment.", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Number", 'mobius'),
			"param_name" => "number",
			"value" => "3261",
			"description" => __( "Enter the number to count.", 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Number Color", 'mobius'),
            "param_name" => "color",
            "value" => "accent-color1",
            "description" => __( "You can set a color to the counter number.<br> If no color is chosen, the default text color of the theme will be set", 'mobius')
		),
		array(
			"type" => "slider",
			'admin_label' => true,
			"slider_min" => "0",
			"slider_max" => "5000",
			"slider_step" => "1",
			"slider_sign" => "ms",
			"value" => "1300",
			"heading" => __("Speed", 'mobius'),
			"param_name" => "speed",
			"description" => __("Set the time taken to count until your chosen number.", 'mobius'),
		),
		array(
			"type" => "dropdown",
			"value" => array(
				__("Before content", 'mobius') => "left",
				__("After content", 'mobius') => "right",
			),
			"heading" => __("Icon position", 'mobius'),
			"param_name" => "iposition",
			"description" => __("Choose the icon position", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Icon  Color", 'mobius'),
            "param_name" => "icolor",
            "value" => "",
            "description" => __( "You can set a color to the icon. If no color is chosen, the default text color of the theme will be set", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Icon", 'mobius'),
            "param_name" => "icon",
            "value" => "eating-tea-cup",
            "description" => __( "If you want to add an icon next to the counter choose an icon.", 'mobius'),
			'group' => __( 'Icon', 'mobius'),
		),
		
		
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Process Steps Holder
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'process_integrateWithVC' );
function process_integrateWithVC() {
vc_map( array(
	"name" => __( "Process Steps", 'mobius'),
	"base" => "themeone_process",
	"icon" => "fa-2x general-spanner themeone-icon",
	"description" => __("Display your process step with infography", 'mobius'),
	"category" => __( "Infography", 'mobius'),
	"as_parent" => array('only' => 'themeone_step'),
	"content_element" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "slider",
			"slider_min" => "2",
			"slider_max" => "5",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "3",
			"heading" => __("Process step Number", 'mobius'),
			"param_name" => "slide",
			"description" => __("Set the number of step per slide", 'mobius'),
		),
		array(
			"type" => "dropdown",
			"value" => array(
				"" => "",
				__("Light Text", 'mobius') => "light",
				__("Dark Text", 'mobius') => "dark",
			),
			"heading" => __("Process step color scheme", 'mobius'),
			"param_name" => "color",
			"description" => __("You can set the text color of the process step carousel", 'mobius'),
		),
	),
	"default_content" => '
			[themeone_step title="Brain Storming" icon="general-light-bulb" iconc="accent-color1" image="" ]Accusantium am, ultri eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper ullamcorper[/themeone_step]
			[themeone_step title="Planning" icon="general-calendar" iconc="accent-color1" image="" ]Accusantium am, ultri eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper ullamcorper[/themeone_step]
			[themeone_step title="Development" icon="devices-monitor" iconc="accent-color1" image="" ]Accusantium am, ultri eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper ullamcorper[/themeone_step]
			[themeone_step title="launch" icon="icon-et-flag" iconc="accent-color1" image="" ]Accusantium am, ultri eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper ullamcorper[/themeone_step]
',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Process Steps Config
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'step_integrateWithVC' );
function step_integrateWithVC() {
vc_map( array(
	"name" => __( "Process Step", 'mobius'),
	"base" => "themeone_step",
	"icon" => "fa-2x general-spanner themeone-icon",
	"description" => __("Display your process step with infography", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"as_child" => array('only' => 'themeone_process'),
	"content_element" => true,
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Title", 'mobius'),
			"param_name" => "title",
			"value" => "Your title",
			"description" => __( "Type the title of the step.", 'mobius')
		),
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "Step content", 'mobius'),
			"param_name" => "content",
			"value" => "Accusantium am, ultri eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper ullamcorper",
			"description" => __( "Type the content of the step.)", 'mobius')
		),
		array(
			"type" => "icons",
			'admin_label' => true,
            "class" => "",
            "heading" => __( "Icon", 'mobius'),
            "param_name" => "icon",
            "value" => "eating-tea-cup",
            "description" => __( "Choose an icon for step.", 'mobius'),
			'group' => __( 'Icon', 'mobius')
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Step icon color", 'mobius'),
            "param_name" => "iconc",
            "value" => "accent-color1",
            "description" => __( "You can set a color to the icon.", 'mobius'),
			'group' => __( 'Icon', 'mobius')
		),
		array(
			"type" => "custom_upload",
			"class" => "",
			"heading" => __("Step Background image", 'mobius'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Choose a background image of the current step (optional).", 'mobius')
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Team Member Carousel
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'team_member_integrateWithVC' );
function team_member_integrateWithVC() {
vc_map( array(
	"name" => __( "Team Members", 'mobius'),
	"base" => "themeone_team_member",
	"icon" => "fa-2x icon-et-profile-male themeone-icon",
	"description" => __("Display your process step with infography", 'mobius'),
	"category" => __( "Infography", 'mobius'),
	"as_parent" => array('only' => 'themeone_member'),
	"content_element" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "dropdown",
			"value" => array(
				__("Square", 'mobius') => "square",
				__("Circle", 'mobius') => "circle",
			),
			"heading" => __("Team Member layout", 'mobius'),
			"param_name" => "type",
			"description" => __("Choose the type of layout.<br> Circle displays a team member image in a circle and with centered text.<br> CIRCLE LAYOUT MUST HAVE A TEAM MEMBER IMAGE WITH SQUARE RATIO (eg : 300px x 300px)", 'mobius'),
		),
		array(
			"type" => "slider",
			"slider_min" => "2",
			"slider_max" => "5",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "4",
			"heading" => __("Member max row number", 'mobius'),
			"param_name" => "rows",
			"description" => __("The maximum number of rows member corrrespond to the number of member display on the screen for a windwos size of 1280px minimum.", 'mobius'),
		),
	),
	"default_content" => '
			[themeone_member name="John Doe" position="Founder / Project Lead" img="'. THEMEONE_VC_URI . '/img/no_image.png" facebook="https://www.facebook.com/" twitter="https://twitter.com/" google="http://www.google.com/intl/fr_FR/+/learnmore/"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis.[/themeone_member]
[themeone_member name="Nathalie Spark" position="Graphic Designer" img="'. THEMEONE_VC_URI . '/img/no_image.png" facebook="https://www.facebook.com/" twitter="https://twitter.com/" google="http://www.google.com/intl/fr_FR/+/learnmore/"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis.[/themeone_member]
[themeone_member name="Chris Hans" position="Designer" img="'. THEMEONE_VC_URI . '/img/no_image.png" facebook="https://www.facebook.com/" twitter="https://twitter.com/" google="http://www.google.com/intl/fr_FR/+/learnmore/"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis.[/themeone_member]
[themeone_member name="Betty Jones" position="Designer" img="'. THEMEONE_VC_URI . '/img/no_image.png" facebook="https://www.facebook.com/" twitter="https://twitter.com/" google="http://www.google.com/intl/fr_FR/+/learnmore/"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis.[/themeone_member]
',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Member Carousel
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'member_integrateWithVC' );
function member_integrateWithVC() {
vc_map( array(
	"name" => __( "Team Member", 'mobius'),
	"base" => "themeone_member",
	"icon" => "fa-2x icon-et-profile-female themeone-icon",
	"description" => __("Display your process step with infography", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"as_child" => array('only' => 'themeone_team_member'),
	"content_element" => true,
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Team member name", 'mobius'),
			"param_name" => "name",
			"value" => "Member Name",
			"description" => __( "Enter the team member name.", 'mobius')
		),
		array(
			"type" => "textfield",
			"holder" => "H6",
			"class" => "",
			"heading" => __( "Team member position", 'mobius'),
			"param_name" => "position",
			"value" => "Member position",
			"description" => __( "Enter the team member position.", 'mobius')
		),
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "Team member description", 'mobius'),
			"param_name" => "content",
			"value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis.",
			"description" => __( "Enter the team member description.", 'mobius')
		),
		array(
			"type" => "custom_upload",
			"class" => "",
			"heading" => __("Team member photo", 'mobius'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Choose a team member photo (upload a photo or enter an image url).", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member email", 'mobius'),
			"param_name" => "email",
			"value" => "",
			"description" => __( "Enter the team member email.", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Facebook link", 'mobius'),
			"param_name" => "facebook",
			"value" => "",
			"description" => __( "Enter the team member facebook page.", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Twitter link", 'mobius'),
			"param_name" => "twitter",
			"value" => "",
			"description" => __( "Enter the team member twitter page.", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Google+ link", 'mobius'),
			"param_name" => "google",
			"value" => "",
			"description" => __( "Enter the team member Google+ page.", 'mobius')
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Box Team Member
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'box_member_integrateWithVC' );
function box_member_integrateWithVC() {
vc_map( array(
	"name" => __( "Box team Member", 'mobius'),
	"base" => "themeone_box_member",
	"icon" => "fa-2x icon-et-profile-female themeone-icon",
	"description" => __("Team member in a box (place it alone in a column)", 'mobius'),
	"class" => "",
	"category" => __( "Infography", 'mobius'),
	"params" => array(
		array(
			"type" => "custom_upload",
			"class" => "",
			"heading" => __("Team member photo", 'mobius'),
			"param_name" => "img",
			"value" => THEMEONE_VC_URI . '/img/no_image.png',
			"description" => __("Choose a team member photo (upload a photo or enter an image url).", 'mobius')
		),
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Team member name", 'mobius'),
			"param_name" => "name",
			"value" => "Member Name",
			"description" => __( "Enter the team member name.", 'mobius')
		),
		array(
			"type" => "textfield",
			"holder" => "h6",
			"class" => "",
			"heading" => __( "Team member position", 'mobius'),
			"param_name" => "position",
			"value" => "Member position",
			"description" => __( "Enter the team member position.", 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member URL", 'mobius'),
			"param_name" => "url",
			"value" => "",
			"description" => __( "Enter the url to link to a page.", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Email", 'mobius'),
			"param_name" => "email",
			"value" => "",
			"description" => __( "Enter the team member email.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Facebook link", 'mobius'),
			"param_name" => "facebook",
			"value" => "",
			"description" => __( "Enter the team member facebook page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Twitter link", 'mobius'),
			"param_name" => "twitter",
			"value" => "",
			"description" => __( "Enter the team member twitter page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Google+ link", 'mobius'),
			"param_name" => "google",
			"value" => "",
			"description" => __( "Enter the team member Google+ page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Linkedin link", 'mobius'),
			"param_name" => "linkedin",
			"value" => "",
			"description" => __( "Enter the team member Linkedin page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Pinterest link", 'mobius'),
			"param_name" => "pinterest",
			"value" => "",
			"description" => __( "Enter the team member Pinterest page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Dribbble link", 'mobius'),
			"param_name" => "dribbble",
			"value" => "",
			"description" => __( "Enter the team member Dribbble page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Team member Youtube link", 'mobius'),
			"param_name" => "youtube",
			"value" => "",
			"description" => __( "Enter the team member Youtube page.", 'mobius'),
			'group' => __( 'Social Links', 'mobius')
		),	
	)
));
}

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Carousel
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'testimonial_carousel_integrateWithVC' );
function testimonial_carousel_integrateWithVC() {
vc_map( array(
	"name" => __( "Testimonial Carousel", 'mobius'),
	"base" => "themeone_testimonial_carousel",
	"icon" => "fa-2x general-chat-reply themeone-icon",
	"description" => __("Testimonial carousel", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_parent" => array('only' => 'themeone_testimonial'),
	"content_element" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("AutoPlay Carousel", 'mobius'),
			"param_name" => "autoplay",
			"value" => array(__("autoplay", 'mobius')=> "true"),
			"description" => "Check this option if you want that the carousel testimonial autoPlay.",
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "50000",
			"slider_step" => "1",
			"slider_sign" => "ms",
			"value" => "10000",
			"heading" => __("Carousel AutoPlay Speed", 'mobius'),
			"param_name" => "speed",
			"description" => __("Choose a speed for the autoplay carousel testimonial. <br> Only works if autoplay option is activated.", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel Pagination", 'mobius'),
			"param_name" => "page",
			"value" => array(__("page", 'mobius')=> "true"),
			"description" => "Check this option if you want to display the bullet pagination of the carousel.",
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel Navigation", 'mobius'),
			"param_name" => "nav",
			"value" => array(__("nav", 'mobius')=> "true"),
			"description" => "Check this option if you want to display arrows prev next navigation.",
		),
	),
	"default_content" => '
			[themeone_testimonial author="Betty Jones" description="Developper" img="'. THEMEONE_VC_URI . '/img/no_image.png" color="" colorDSC="accent-color1"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus erat ac massa placerat, ac aliquam Aenean consectetur laoreet massa non interdum. Lorem ipsum dolor sit amet, consectetur[/themeone_testimonial]
[themeone_testimonial author="John Doe" description="Web developper" img="'. THEMEONE_VC_URI . '/img/no_image.png" color="" colorDSC="accent-color1"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus erat ac massa placerat, ac aliquam Aenean consectetur laoreet massa non interdum. Lorem ipsum dolor sit amet, consectetur[/themeone_testimonial]
',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'testimonial_integrateWithVC' );
function testimonial_integrateWithVC() {
vc_map( array(
	"name" => __( "Testimonial", 'mobius'),
	"base" => "themeone_testimonial",
	"icon" => "fa-2x general-chat-reply themeone-icon",
	"description" => __("Testimonial carousel", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_child" => array('only' => 'themeone_testimonial_carousel'),
	"content_element" => true,
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Author Name", 'mobius'),
			"param_name" => "author",
			"value" => "Author name",
			"description" => __( "Enter the testimonial author name.", 'mobius'),
		),
		array(
			"type" => "textfield",
			"holder" => "h6",
			"class" => "",
			"heading" => __( "Author Description", 'mobius'),
			"param_name" => "description",
			"value" => "Author description",
			"description" => __( "Enter the testimonial author description (like the position, website, activity,...).", 'mobius'),
		),
		array(
			"type" => "custom_upload",
			"class" => "",
			"heading" => __("Author Photo", 'mobius'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Choose a testimonial author photo (upload a photo or enter an image url.", 'mobius')
		),
		array(
			"type" => "textarea",
			"holder" => "p",
			"class" => "",
			"heading" => __( "Testimonial content", 'mobius'),
			"param_name" => "content",
			"value" => "
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus erat ac massa placerat, ac aliquam Aenean consectetur laoreet massa non interdum. Lorem ipsum dolor sit amet, consectetur",
			"description" => __( "Enter the testimonial content.", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Testimonial content Color", 'mobius'),
            "param_name" => "color",
            "value" => "",
            "description" => __( "Choose a color for the testimonial content", 'mobius'),
		),
		array(
			"type" => "custom_color",
            "class" => "",
            "heading" => __( "Author Description Color", 'mobius'),
            "param_name" => "colordsc",
            "value" => "accent-color1",
            "description" => __( "Choose a color for the testimonial author description (By default, the hover color of the theme is activated)", 'mobius'),
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Clients Carousel
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'clients_carousel_integrateWithVC' );
function clients_carousel_integrateWithVC() {
vc_map( array(
	"name" => __( "Client Carousel", 'mobius'),
	"base" => "themeone_clients_carousel",
	"icon" => "fa-2x general-jewel themeone-icon",
	"description" => __("Show your client logos in a carousel", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_parent" => array('only' => 'themeone_client'),
	"content_element" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel AutoPlay", 'mobius'),
			"param_name" => "autoplay",
			"value" => array(__("autoplay", 'mobius')=> "true"),
			"description" => "Check this option if you want that the carousel client autoPlay.",
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "50000",
			"slider_step" => "1",
			"slider_sign" => "ms",
			"value" => "10000",
			"heading" => __("Carousel AutoPlay Speed", 'mobius'),
			"param_name" => "speed",
			"description" => __("Choose a speed for the autoplay carousel client. <br> Only works if autoplay option is activated.", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel Pagination", 'mobius'),
			"param_name" => "page",
			"value" => array(__("page", 'mobius')=> "true"),
			"description" => "Check this option if you want to display the bullet pagination of the carousel.",
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel Navigation", 'mobius'),
			"param_name" => "nav",
			"value" => array(__("nav", 'mobius')=> "true"),
			"description" => "Check this option if you want to display arrows prev next navigation.",
		),
		array(
			"type" => "slider",
			"slider_min" => "3",
			"slider_max" => "7",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "4",
			"heading" => __("Client max row number", 'mobius'),
			"param_name" => "rows",
			"description" => __("The maximum number of rows client corrrespond to the number of client image display on the screen for a windwos size of 1280px minimum. <br> Lower this number is, bigger the image is", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Client Carousel grey image", 'mobius'),
			"param_name" => "grey",
			"value" => array(__("grey", 'mobius')=> "true"),
			"description" => "Check this option if you want that the image client appear in grey and become in color on hover.",
		),
	),
	"default_content" => '
			[themeone_client img="'. THEMEONE_VC_URI . '/img/no_image.png" url=""]
			[themeone_client img="'. THEMEONE_VC_URI . '/img/no_image.png" url=""]
			[themeone_client img="'. THEMEONE_VC_URI . '/img/no_image.png" url=""]
			[themeone_client img="'. THEMEONE_VC_URI . '/img/no_image.png" url=""]
	',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Client
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'client_integrateWithVC' );
function client_integrateWithVC() {
vc_map( array(
	"name" => __( "Client", 'mobius'),
	"base" => "themeone_client",
	"icon" => "fa-2x general-jewel themeone-icon",
	"description" => __("Client image and url", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_child" => array('only' => 'themeone_clients_carousel'),
	"content_element" => true,
	"params" => array(
		array(
			"type" => "custom_upload",
			"class" => "",
			"heading" => __("Client Image", 'mobius'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Choose an image for of the client.<br> For a better render: client image must have the same size in height and width.", 'mobius')
		),
		array(
			"type" => "textfield",
			"holder" => "h5",
			"class" => "",
			"heading" => __( "Client URL", 'mobius'),
			"param_name" => "url",
			"value" => "",
			"description" => __( "Enter the client URL (optional).", 'mobius'),
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Audio
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'audio_integrateWithVC' );
function audio_integrateWithVC() {
vc_map( array(
	"name" => __( "Audio", 'mobius'),
	"base" => "themeone_audio",
	"icon" => "fa-2x media-music-note themeone-icon",
	"description" => __("Add a media song (mp3 or oga file)", 'mobius'),
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "custom_upload_file",
			"class" => "",
			"heading" => __("MP3 File URL", 'mobius'),
			"param_name" => "mp3",
			"value" => "",
			"description" => __("Please enter an URL or upload your .mp3 audio file", 'mobius')
		),
		array(
			"type" => "custom_upload_file",
			"class" => "",
			"heading" => __("OGA/OGG File URL", 'mobius'),
			"param_name" => "oga",
			"value" => "",
			"description" => __("Please enter an URL or upload your .oga/.ogg audio file", 'mobius')
		),
		array(
			"type" => "custom_upload_file",
			"class" => "",
			"heading" => __("Audio Image", 'mobius'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Audio Image Please enter an URL or upload the album image", 'mobius')
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Artist Name", 'mobius'),
			"param_name" => "artist",
			"value" => "",
			"description" => __( "Please enter the artist name here.", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Song Name", 'mobius'),
			"param_name" => "song",
			"value" => "",
			"description" => __( "Please enter the song name here.", 'mobius'),
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'slider_integrateWithVC' );
function slider_integrateWithVC() {
vc_map( array(
	"name" => __( "Slider", 'mobius'),
	"base" => "themeone_slider",
	"icon" => "fa-2x media-pic-ios-album themeone-icon",
	"description" => __("Place content inside horizontal slider", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_parent" => array('only' => 'themeone_slide'),
	"content_element" => true,
	'js_view' => 'VcColumnView',	
	'show_settings_on_create' => false,
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("AutoPlay", 'mobius'),
			"param_name" => "autoplay",
			"value" => array(__("autoplay", 'mobius')=> "true"),
			"description" => "Check this option if you want that the slider autoPlay.",
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "50000",
			"slider_step" => "1",
			"slider_sign" => "ms",
			"value" => "10000",
			"heading" => __("AutoPlay Speed", 'mobius'),
			"param_name" => "speed",
			"description" => __("Choose a speed for the autoplay slider. <br> Only works if autoplay option is activated.", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Slider Pagination", 'mobius'),
			"param_name" => "page",
			"value" => array(__("page", 'mobius')=> "true"),
			"description" => "Check this option if you want to display the bullet pagination of the slider.",
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Slider Navigation", 'mobius'),
			"param_name" => "nav",
			"value" => array(__("nav", 'mobius')=> "true"),
			"description" => "Check this option if you want to display arrows prev next navigation.",
		),
	),
	"default_content" => '
			[themeone_slide][/themeone_slide]
			[themeone_slide][/themeone_slide]
	',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Slide
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'slide_integrateWithVC' );
function slide_integrateWithVC() {
vc_map( array(
	"name" => __( "Slide", 'mobius'),
	"base" => "themeone_slide",
	"icon" => "fa-2x media-pic-ios-album themeone-icon",
	"description" => __("Place content inside horizontal slider", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"as_child" => array('only' => 'themeone_slider'),
	"content_element" => true,
	'is_container' => true,
	'js_view' => 'VcColumnView',
));
}

/*-----------------------------------------------------------------------------------*/
/*	Video
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'video_integrateWithVC' );
function video_integrateWithVC() {
vc_map( array(
	"name" => __( "Video", 'mobius'),
	"base" => "themeone_video",
	"icon" => "fa-2x media-controls-play themeone-icon",
	"description" => __("Display an hosted or embed video", 'mobius'),
	"category" => __( "Element", 'mobius'),
	"params" => array(
		array(
			"type" => "custom_upload_file",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "M4V/MP4 File URL", 'mobius'),
			"param_name" => "mp4",
			"value" => "",
			"description" => __( "Add any content you want. It Works with all shortcodes", 'mobius'),
		),
		array(
			"type" => "custom_upload_file",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "WEBM File URL", 'mobius'),
			"param_name" => "webm",
			"value" => "",
			"description" => __( "Please enter an URL or upload your .webm video file", 'mobius'),
		),
		array(
			"type" => "custom_upload_file",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "OGV/OGG File URL", 'mobius'),
			"param_name" => "ogg",
			"value" => "",
			"description" => __( "Please enter an URL or upload your .ogv/.ogg video file", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Youtube Embed URL", 'mobius'),
			"param_name" => "youtube",
			"value" => "",
			"description" => __( "Paste the youtube link here if you want a youtube video (not he embed code iframe)", 'mobius'),
		),
		array(
			"type" => "textfield",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Vimeo Embed URL", 'mobius'),
			"param_name" => "vimeo",
			"value" => "",
			"description" => __( "Paste the vimeo link here if you want a vimeo video (not he embed code iframe)", 'mobius'),
		),
		array(
			"type" => "custom_upload",
			'admin_label' => true,
			"class" => "",
			"heading" => __( "Video Poster", 'mobius'),
			"param_name" => "poster",
			"value" => "",
			"description" => __( "Set a poster for the video for m4v/ogv file (Nedeed! It\'s displayed when the video format is not supported by the client browser)", 'mobius'),
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Twitter feed
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'twitter_integrateWithVC' );
function twitter_integrateWithVC() {
vc_map( array(
	"name" => __( "Twitter", 'mobius'),
	"base" => "themeone_twitter",
	"icon" => "fa-2x fa fa-twitter themeone-icon",
	"description" => __("Display your last tweets in a carousel)", 'mobius'),
	"category" => __( "Slider", 'mobius'),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Carousel AutoPlay", 'mobius'),
			"param_name" => "autoplay",
			"value" => array(__("autoplay", 'mobius')=> "true"),
			"description" => "Check this option if you want that the carousel Twitter autoPlay.",
		),
		array(
			"type" => "slider",
			"slider_min" => "0",
			"slider_max" => "50000",
			"slider_step" => "1",
			"slider_sign" => "ms",
			"value" => "10000ms",
			"heading" => __("AutoPlay Speed", 'mobius'),
			"param_name" => "speed",
			"description" => __("Choose a speed for the autoplay carousel Twitter. <br> Only works if autoplay option is activated.", 'mobius'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Twitter Pagination", 'mobius'),
			"param_name" => "page",
			"value" => array(__("page", 'mobius')=> "true"),
			"description" => "Check this option if you want to display the bullet pagination.",
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Twitter Navigation", 'mobius'),
			"param_name" => "nav",
			"value" => array(__("nav", 'mobius')=> "true"),
			"description" => "Check this option if you want to display arrows prev next navigation.",
		),
		array(
			"type" => "textfield",
			"class" => "",
			'admin_label' => true,
			"heading" => __( "Twitter Name", 'mobius'),
			"param_name" => "name",
			"value" => "",
			"description" => __( "Enter your twitter username", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Comsumer Key", 'mobius'),
			"param_name" => "c_key",
			"value" => "",
			"description" => __( "Enter your consumer key", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Comsumer Secret", 'mobius'),
			"param_name" => "c_secret",
			"value" => "",
			"description" => __( "Enter your consumer secret", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Access Token", 'mobius'),
			"param_name" => "a_token",
			"value" => "",
			"description" => __( "Enter your access token", 'mobius'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Access Secret", 'mobius'),
			"param_name" => "a_secret",
			"value" => "",
			"description" => __( "Enter your access secret", 'mobius'),
		),
		array(
			"type" => "slider",
			"slider_min" => "1",
			"slider_max" => "20",
			"slider_step" => "1",
			"slider_sign" => "",
			"value" => "4",
			"heading" => __("Twitter Feed Number", 'mobius'),
			"param_name" => "no_tweets",
			"description" => __("Choose the number of tweet to display", 'mobius'),
		),
	),
));
}

/*-----------------------------------------------------------------------------------*/
/*	Elements extended
/*-----------------------------------------------------------------------------------*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_themeone_ul extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_pricing extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_ptable extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_tab extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_tabs extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_toggle extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_accordion extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_process extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_team_member extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_testimonial_carousel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_clients_carousel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_slider extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_themeone_slide extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_themeone_li extends WPBakeryShortCode {}
	class WPBakeryShortCode_themeone_step extends WPBakeryShortCode {}
	class WPBakeryShortCode_themeone_member extends WPBakeryShortCode {}
	
}

/*-----------------------------------------------------------------------------------*/
/*	Icons List
/*-----------------------------------------------------------------------------------*/

global $iconList;
$iconList = array(
	'business-bar-chart'	=>	'business-bar-chart',
	'business-box-closed'	=>	'business-box-closed',
	'business-box-open'	=>	'business-box-open',
	'business-briefcase'	=>	'business-briefcase',
	'business-calculator'	=>	'business-calculator',
	'business-chart-down'	=>	'business-chart-down',
	'business-chart-up'	=>	'business-chart-up',
	'business-coin-dollar'	=>	'business-coin-dollar',
	'business-coin-euro'	=>	'business-coin-euro',
	'business-coin-rupee'	=>	'business-coin-rupee',
	'business-coin-sterling'	=>	'business-coin-sterling',
	'business-coin-yen-yuan'	=>	'business-coin-yen-yuan',
	'business-combination-lock'	=>	'business-combination-lock',
	'business-combination-lock-open'	=>	'business-combination-lock-open',
	'business-dollar'	=>	'business-dollar',
	'business-euro'	=>	'business-euro',
	'business-gift'	=>	'business-gift',
	'business-id'	=>	'business-id',
	'business-note-dollar'	=>	'business-note-dollar',
	'business-note-euro'	=>	'business-note-euro',
	'business-note-rupee'	=>	'business-note-rupee',
	'business-note-sterling'	=>	'business-note-sterling',
	'business-note-yen-yuan'	=>	'business-note-yen-yuan',
	'business-padlock-closed'	=>	'business-padlock-closed',
	'business-padlock-closed-2'	=>	'business-padlock-closed-2',
	'business-padlock-open'	=>	'business-padlock-open',
	'business-padlock-open-2'	=>	'business-padlock-open-2',
	'business-pie-chart'	=>	'business-pie-chart',
	'business-piggy-bank'	=>	'business-piggy-bank',
	'business-piggy-bank-coin'	=>	'business-piggy-bank-coin',
	'business-presentation'	=>	'business-presentation',
	'business-rupee'	=>	'business-rupee',
	'business-safe'	=>	'business-safe',
	'business-satchel'	=>	'business-satchel',
	'business-shield'	=>	'business-shield',
	'business-shield-cross'	=>	'business-shield-cross',
	'business-shop-bag'	=>	'business-shop-bag',
	'business-shop-basket'	=>	'business-shop-basket',
	'business-shop-basket-add'	=>	'business-shop-basket-add',
	'business-shop-basket-love'	=>	'business-shop-basket-love',
	'business-shop-basket-multiply'	=>	'business-shop-basket-multiply',
	'business-shop-basket-remove'	=>	'business-shop-basket-remove',
	'business-shop-basket-search'	=>	'business-shop-basket-search',
	'business-shop-basket-tick'	=>	'business-shop-basket-tick',
	'business-shop-basket-warning'	=>	'business-shop-basket-warning',
	'business-shop-cart'	=>	'business-shop-cart',
	'business-shop-cart-add'	=>	'business-shop-cart-add',
	'business-shop-cart-remove'	=>	'business-shop-cart-remove',
	'business-sterling'	=>	'business-sterling',
	'business-tag'	=>	'business-tag',
	'business-tag-dollar'	=>	'business-tag-dollar',
	'business-tag-euro'	=>	'business-tag-euro',
	'business-tag-rupee'	=>	'business-tag-rupee',
	'business-tag-sterling'	=>	'business-tag-sterling',
	'business-tag-yen-yuan'	=>	'business-tag-yen-yuan',
	'business-tags'	=>	'business-tags',
	'business-venn-diagram'	=>	'business-venn-diagram',
	'business-yen-yuan'	=>	'business-yen-yuan',
	'devices-camera'	=>	'devices-camera',
	'devices-camera-rotate'	=>	'devices-camera-rotate',
	'devices-headphones'	=>	'devices-headphones',
	'devices-headset'	=>	'devices-headset',
	'devices-iphone'	=>	'devices-iphone',
	'devices-iphone-calibrate'	=>	'devices-iphone-calibrate',
	'devices-iphone-chat'	=>	'devices-iphone-chat',
	'devices-iphone-edit'	=>	'devices-iphone-edit',
	'devices-iphone-flip'	=>	'devices-iphone-flip',
	'devices-iphone-iphone'	=>	'devices-iphone-iphone',
	'devices-iphone-location'	=>	'devices-iphone-location',
	'devices-iphone-locked'	=>	'devices-iphone-locked',
	'devices-iphone-mac'	=>	'devices-iphone-mac',
	'devices-iphone-minus'	=>	'devices-iphone-minus',
	'devices-iphone-multiply'	=>	'devices-iphone-multiply',
	'devices-iphone-plus'	=>	'devices-iphone-plus',
	'devices-iphone-receive'	=>	'devices-iphone-receive',
	'devices-iphone-rotate'	=>	'devices-iphone-rotate',
	'devices-iphone-search'	=>	'devices-iphone-search',
	'devices-iphone-send'	=>	'devices-iphone-send',
	'devices-iphone-settings'	=>	'devices-iphone-settings',
	'devices-iphone-shake'	=>	'devices-iphone-shake',
	'devices-iphone-signal'	=>	'devices-iphone-signal',
	'devices-iphone-signal-2'	=>	'devices-iphone-signal-2',
	'devices-iphone-tick'	=>	'devices-iphone-tick',
	'devices-iphone-tv'	=>	'devices-iphone-tv',
	'devices-iphone-warning'	=>	'devices-iphone-warning',
	'devices-ipod'	=>	'devices-ipod',
	'devices-ipod-buds'	=>	'devices-ipod-buds',
	'devices-ipod-headphones'	=>	'devices-ipod-headphones',
	'devices-ipod-nano'	=>	'devices-ipod-nano',
	'devices-laptop'	=>	'devices-laptop',
	'devices-mac'	=>	'devices-mac',
	'devices-mobile'	=>	'devices-mobile',
	'devices-mobile-monitor'	=>	'devices-mobile-monitor',
	'devices-monitor'	=>	'devices-monitor',
	'devices-printer'	=>	'devices-printer',
	'devices-shredder'	=>	'devices-shredder',
	'devices-tablet'	=>	'devices-tablet',
	'devices-tv'	=>	'devices-tv',
	'devices-tv-demand'	=>	'devices-tv-demand',
	'general-aim-target'	=>	'general-aim-target',
	'general-alarm'	=>	'general-alarm',
	'general-alarm-off'	=>	'general-alarm-off',
	'general-broken-heart'	=>	'general-broken-heart',
	'general-bullet-list'	=>	'general-bullet-list',
	'general-calendar'	=>	'general-calendar',
	'general-chat'	=>	'general-chat',
	'general-chat-ios'	=>	'general-chat-ios',
	'general-chat-reply'	=>	'general-chat-reply',
	'general-chats'	=>	'general-chats',
	'general-checkbox'	=>	'general-checkbox',
	'general-clock'	=>	'general-clock',
	'general-coathanger'	=>	'general-coathanger',
	'general-cog'	=>	'general-cog',
	'general-cogs'	=>	'general-cogs',
	'general-cube'	=>	'general-cube',
	'general-divider'	=>	'general-divider',
	'general-dress'	=>	'general-dress',
	'general-electronic-megaphone'	=>	'general-electronic-megaphone',
	'general-female-symbol'	=>	'general-female-symbol',
	'general-filter'	=>	'general-filter',
	'general-flag-fanion'	=>	'general-flag-fanion',
	'general-flag-rectangle'	=>	'general-flag-rectangle',
	'general-flag-swallowtail'	=>	'general-flag-swallowtail',
	'general-games-ios'	=>	'general-games-ios',
	'general-happy-face'	=>	'general-happy-face',
	'general-heart'	=>	'general-heart',
	'general-heart-rate'	=>	'general-heart-rate',
	'general-heart-rate-2'	=>	'general-heart-rate-2',
	'general-infinity'	=>	'general-infinity',
	'general-information'	=>	'general-information',
	'general-jewel'	=>	'general-jewel',
	'general-jigsaw'	=>	'general-jigsaw',
	'general-joystick'	=>	'general-joystick',
	'general-lifebelt'	=>	'general-lifebelt',
	'general-light'	=>	'general-light',
	'general-light-bulb'	=>	'general-light-bulb',
	'general-light-bulb-on'	=>	'general-light-bulb-on',
	'general-lightening'	=>	'general-lightening',
	'general-male-female-symbol'	=>	'general-male-female-symbol',
	'general-male-female-symbol-2'	=>	'general-male-female-symbol-2',
	'general-male-symbol'	=>	'general-male-symbol',
	'general-medical-kit'	=>	'general-medical-kit',
	'general-megaphone'	=>	'general-megaphone',
	'general-moon'	=>	'general-moon',
	'general-mortar-board'	=>	'general-mortar-board',
	'general-origami'	=>	'general-origami',
	'general-paint-roller'	=>	'general-paint-roller',
	'general-paint-tin'	=>	'general-paint-tin',
	'general-palette'	=>	'general-palette',
	'general-paperclip'	=>	'general-paperclip',
	'general-paperclip-2'	=>	'general-paperclip-2',
	'general-past'	=>	'general-past',
	'general-paw-print'	=>	'general-paw-print',
	'general-pencil'	=>	'general-pencil',
	'general-picture-list'	=>	'general-picture-list',
	'general-picture-list-2'	=>	'general-picture-list-2',
	'general-pill'	=>	'general-pill',
	'general-pinwheel'	=>	'general-pinwheel',
	'general-rainbow'	=>	'general-rainbow',
	'general-rocket'	=>	'general-rocket',
	'general-ruler'	=>	'general-ruler',
	'general-ruler-pencil'	=>	'general-ruler-pencil',
	'general-sad-face'	=>	'general-sad-face',
	'general-snow'	=>	'general-snow',
	'general-spanner'	=>	'general-spanner',
	'general-spanner-2'	=>	'general-spanner-2',
	'general-speedometer'	=>	'general-speedometer',
	'general-steering-wheel'	=>	'general-steering-wheel',
	'general-stroller'	=>	'general-stroller',
	'general-sun-cloud'	=>	'general-sun-cloud',
	'general-target'	=>	'general-target',
	'general-umbrella'	=>	'general-umbrella',
	'general-warning'	=>	'general-warning',
	'media-controls-eject'	=>	'media-controls-eject',
	'media-controls-end'	=>	'media-controls-end',
	'media-controls-forward'	=>	'media-controls-forward',
	'media-controls-next'	=>	'media-controls-next',
	'media-controls-pause'	=>	'media-controls-pause',
	'media-controls-play'	=>	'media-controls-play',
	'media-controls-previous'	=>	'media-controls-previous',
	'media-controls-reverse'	=>	'media-controls-reverse',
	'media-controls-rewind'	=>	'media-controls-rewind',
	'media-controls-start'	=>	'media-controls-start',
	'media-controls-stop'	=>	'media-controls-stop',
	'media-microphone'	=>	'media-microphone',
	'media-movies'	=>	'media-movies',
	'media-music-note'	=>	'media-music-note',
	'media-pic-fields'	=>	'media-pic-fields',
	'media-pic-fields-albums'	=>	'media-pic-fields-albums',
	'media-pic-ios'	=>	'media-pic-ios',
	'media-pic-ios-2'	=>	'media-pic-ios-2',
	'media-pic-ios-album'	=>	'media-pic-ios-album',
	'media-pic-mountains'	=>	'media-pic-mountains',
	'media-pic-mountains-albums'	=>	'media-pic-mountains-albums',
	'media-sliders-side'	=>	'media-sliders-side',
	'media-sliders-side-2'	=>	'media-sliders-side-2',
	'media-sliders-up'	=>	'media-sliders-up',
	'media-sliders-up-2'	=>	'media-sliders-up-2',
	'media-vol-loud'	=>	'media-vol-loud',
	'media-vol-medium'	=>	'media-vol-medium',
	'media-vol-mute'	=>	'media-vol-mute',
	'media-vol-quiet'	=>	'media-vol-quiet',
	'eating-baby-knife-fork-spoon'	=>	'eating-baby-knife-fork-spoon',	
	'eating-candy-cane'	=>	'eating-candy-cane',	
	'eating-cheeseburger'	=>	'eating-cheeseburger',	
	'eating-chupa-chups'	=>	'eating-chupa-chups',	
	'eating-coffee-cup'	=>	'eating-coffee-cup',	
	'eating-hamburger'	=>	'eating-hamburger',	
	'eating-ice-cream-flake'	=>	'eating-ice-cream-flake',	
	'eating-ice-cream-sprinkles'	=>	'eating-ice-cream-sprinkles',	
	'eating-ice-lolly'	=>	'eating-ice-lolly',	
	'eating-ice-lolly-square'	=>	'eating-ice-lolly-square',	
	'eating-ice-lolly-stripey'	=>	'eating-ice-lolly-stripey',	
	'eating-knife-fork-plate'	=>	'eating-knife-fork-plate',	
	'eating-knife-fork-spoon'	=>	'eating-knife-fork-spoon',	
	'eating-lollipop'	=>	'eating-lollipop',	
	'eating-orange-half'	=>	'eating-orange-half',	
	'eating-pint-glass'	=>	'eating-pint-glass',	
	'eating-tea-cup'	=>	'eating-tea-cup',	
	'eating-wine-bottle-glass'	=>	'eating-wine-bottle-glass',	
	'eating-wine-glass'	=>	'eating-wine-glass',	
	'eating-wine-glass-angle'	=>	'eating-wine-glass-angle',	
	'icon-et-newspaper'	=>	'icon-et-newspaper',
	'icon-et-notebook'	=>	'icon-et-notebook',
	'icon-et-book-open'	=>	'icon-et-book-open',
	'icon-et-browser'	=>	'icon-et-browser',
	'icon-et-calendar'	=>	'icon-et-calendar',
	'icon-et-presentation'	=>	'icon-et-presentation',
	'icon-et-picture'	=>	'icon-et-picture',
	'icon-et-pictures'	=>	'icon-et-pictures',
	'icon-et-video'	=>	'icon-et-video',
	'icon-et-camera'	=>	'icon-et-camera',
	'icon-et-printer'	=>	'icon-et-printer',
	'icon-et-toolbox'	=>	'icon-et-toolbox',
	'icon-et-briefcase'	=>	'icon-et-briefcase',
	'icon-et-wallet'	=>	'icon-et-wallet',
	'icon-et-gift'	=>	'icon-et-gift',
	'icon-et-bargraph'	=>	'icon-et-bargraph',
	'icon-et-grid'	=>	'icon-et-grid',
	'icon-et-expand'	=>	'icon-et-expand',
	'icon-et-focus'	=>	'icon-et-focus',
	'icon-et-edit'	=>	'icon-et-edit',
	'icon-et-adjustments'	=>	'icon-et-adjustments',
	'icon-et-ribbon'	=>	'icon-et-ribbon',
	'icon-et-hourglass'	=>	'icon-et-hourglass',
	'icon-et-lock'	=>	'icon-et-lock',
	'icon-et-megaphone'	=>	'icon-et-megaphone',
	'icon-et-shield'	=>	'icon-et-shield',
	'icon-et-trophy'	=>	'icon-et-trophy',
	'icon-et-flag'	=>	'icon-et-flag',
	'icon-et-map'	=>	'icon-et-map',
	'icon-et-puzzle'	=>	'icon-et-puzzle',
	'icon-et-basket'	=>	'icon-et-basket',
	'icon-et-envelope'	=>	'icon-et-envelope',
	'icon-et-streetsign'	=>	'icon-et-streetsign',
	'icon-et-telescope'	=>	'icon-et-telescope',
	'icon-et-gears'	=>	'icon-et-gears',
	'icon-et-key'	=>	'icon-et-key',
	'icon-et-paperclip'	=>	'icon-et-paperclip',
	'icon-et-attachment'	=>	'icon-et-attachment',
	'icon-et-pricetags'	=>	'icon-et-pricetags',
	'icon-et-lightbulb'	=>	'icon-et-lightbulb',
	'icon-et-layers'	=>	'icon-et-layers',
	'icon-et-pencil'	=>	'icon-et-pencil',
	'icon-et-tools'	=>	'icon-et-tools',
	'icon-et-tools-2'	=>	'icon-et-tools-2',
	'icon-et-scissors'	=>	'icon-et-scissors',
	'icon-et-paintbrush'	=>	'icon-et-paintbrush',
	'icon-et-magnifying-glass'	=>	'icon-et-magnifying-glass',
	'icon-et-circle-compass'	=>	'icon-et-circle-compass',
	'icon-et-linegraph'	=>	'icon-et-linegraph',
	'icon-et-mic'	=>	'icon-et-mic',
	'icon-et-strategy'	=>	'icon-et-strategy',
	'icon-et-beaker'	=>	'icon-et-beaker',
	'icon-et-caution'	=>	'icon-et-caution',
	'icon-et-recycle'	=>	'icon-et-recycle',
	'icon-et-anchor'	=>	'icon-et-anchor',
	'icon-et-profile-male'	=>	'icon-et-profile-male',
	'icon-et-profile-female'	=>	'icon-et-profile-female',
	'icon-et-bike'	=>	'icon-et-bike',
	'icon-et-wine'	=>	'icon-et-wine',
	'icon-et-hotairballoon'	=>	'icon-et-hotairballoon',
	'icon-et-globe'	=>	'icon-et-globe',
	'icon-et-genius'	=>	'icon-et-genius',
	'icon-et-map-pin'	=>	'icon-et-map-pin',
	'icon-et-dial'	=>	'icon-et-dial',
	'icon-et-chat'	=>	'icon-et-chat',
	'icon-et-heart'	=>	'icon-et-heart',
	'icon-et-cloud'	=>	'icon-et-cloud',
	'icon-et-upload'	=>	'icon-et-upload',
	'icon-et-download'	=>	'icon-et-download',
	'icon-et-target'	=>	'icon-et-target',
	'icon-et-hazardous'	=>	'icon-et-hazardous',
	'icon-et-piechart'	=>	'icon-et-piechart',
	'icon-et-speedometer'	=>	'icon-et-speedometer',
	'icon-et-global'	=>	'icon-et-global',
	'icon-et-compass'	=>	'icon-et-compass',
	'icon-et-lifesaver'	=>	'icon-et-lifesaver',
	'icon-et-clock'	=>	'icon-et-clock',
	'icon-et-aperture'	=>	'icon-et-aperture',
	'icon-et-quote'	=>	'icon-et-quote',
	'icon-et-scope'	=>	'icon-et-scope',
	'icon-et-alarmclock'	=>	'icon-et-alarmclock',
	'icon-et-refresh'	=>	'icon-et-refresh',
	'icon-et-happy'	=>	'icon-et-happy',
	'icon-et-sad'	=>	'icon-et-sad',
	'icon-et-facebook'	=>	'icon-et-facebook',
	'icon-et-twitter'	=>	'icon-et-twitter',
	'icon-et-googleplus'	=>	'icon-et-googleplus',
	'icon-et-rss'	=>	'icon-et-rss',
	'icon-et-tumblr'	=>	'icon-et-tumblr',
	'icon-et-linkedin'	=>	'icon-et-linkedin',
	'icon-et-dribbble'	=>	'icon-et-dribbble',
	'li_heart' => 'li_heart',
	'li_cloud' => 'li_cloud',
	'li_star' => 'li_star',
	'li_tv' => 'li_tv',
	'li_sound' => 'li_sound',
	'li_video' => 'li_video',
	'li_trash' => 'li_trash',
	'li_user' => 'li_user',
	'li_key' => 'li_key',
	'li_search' => 'li_search',
	'li_settings' => 'li_settings',
	'li_camera' => 'li_camera',
	'li_tag' => 'li_tag',
	'li_lock' => 'li_lock',
	'li_bulb' => 'li_bulb',
	'li_pen' => 'li_pen',
	'li_diamond' => 'li_diamond',
	'li_display' => 'li_display',
	'li_location' => 'li_location',
	'li_eye' => 'li_eye',
	'li_bubble' => 'li_bubble',
	'li_stack' => 'li_stack',
	'li_cup' => 'li_cup',
	'li_phone' => 'li_phone',
	'li_news' => 'li_news',
	'li_mail' => 'li_mail',
	'li_like' => 'li_like',
	'li_photo' => 'li_photo',
	'li_note' => 'li_note',
	'li_clock' => 'li_clock',
	'li_paperplane' => 'li_paperplane',
	'li_params' => 'li_params',
	'li_banknote' => 'li_banknote',
	'li_data' => 'li_data',
	'li_music' => 'li_music',
	'li_megaphone' => 'li_megaphone',
	'li_study' => 'li_study',
	'li_lab' => 'li_lab',
	'li_food' => 'li_food',
	'li_t-shirt' => 'li_t-shirt',
	'li_fire' => 'li_fire',
	'li_clip' => 'li_clip',
	'li_shop' => 'li_shop',
	'li_calendar' => 'li_calendar',
	'li_vallet' => 'li_vallet',
	'li_vynil' => 'li_vynil',
	'li_truck' => 'li_truck',
	'li_world' => 'li_world',
	'steadysets-icon-type' => 'steadysets-icon-type',
	'steadysets-icon-box' => 'steadysets-icon-box',
	'steadysets-icon-archive' => 'steadysets-icon-archive',
	'steadysets-icon-envelope' => 'steadysets-icon-envelope',
	'steadysets-icon-email' => 'steadysets-icon-email',
	'steadysets-icon-files' => 'steadysets-icon-files',
	'steadysets-icon-uniE606' => 'steadysets-icon-uniE606',
	'steadysets-icon-connection-empty' => 'steadysets-icon-connection-empty',
	'steadysets-icon-connection-25' => 'steadysets-icon-connection-25',
	'steadysets-icon-connection-50' => 'steadysets-icon-connection-50',
	'steadysets-icon-connection-75' => 'steadysets-icon-connection-75',
	'steadysets-icon-connection-full' => 'steadysets-icon-connection-full',
	'steadysets-icon-microphone' => 'steadysets-icon-microphone',
	'steadysets-icon-microphone-off' => 'steadysets-icon-microphone-off',
	'steadysets-icon-book' => 'steadysets-icon-book',
	'steadysets-icon-cloud' => 'steadysets-icon-cloud',
	'steadysets-icon-book2' => 'steadysets-icon-book2',
	'steadysets-icon-star' => 'steadysets-icon-star',
	'steadysets-icon-phone-portrait' => 'steadysets-icon-phone-portrait',
	'steadysets-icon-phone-landscape' => 'steadysets-icon-phone-landscape',
	'steadysets-icon-tablet' => 'steadysets-icon-tablet',
	'steadysets-icon-tablet-landscape' => 'steadysets-icon-tablet-landscape',
	'steadysets-icon-laptop' => 'steadysets-icon-laptop',
	'steadysets-icon-uniE617' => 'steadysets-icon-uniE617',
	'steadysets-icon-barbell' => 'steadysets-icon-barbell',
	'steadysets-icon-stopwatch' => 'steadysets-icon-stopwatch',
	'steadysets-icon-atom' => 'steadysets-icon-atom',
	'steadysets-icon-syringe' => 'steadysets-icon-syringe',
	'steadysets-icon-pencil' => 'steadysets-icon-pencil',
	'steadysets-icon-chart' => 'steadysets-icon-chart',
	'steadysets-icon-bars' => 'steadysets-icon-bars',
	'steadysets-icon-cube' => 'steadysets-icon-cube',
	'steadysets-icon-image' => 'steadysets-icon-image',
	'steadysets-icon-crop' => 'steadysets-icon-crop',
	'steadysets-icon-graph' => 'steadysets-icon-graph',
	'steadysets-icon-select' => 'steadysets-icon-select',
	'steadysets-icon-bucket' => 'steadysets-icon-bucket',
	'steadysets-icon-mug' => 'steadysets-icon-mug',
	'steadysets-icon-clipboard' => 'steadysets-icon-clipboard',
	'steadysets-icon-lab' => 'steadysets-icon-lab',
	'steadysets-icon-bones' => 'steadysets-icon-bones',
	'steadysets-icon-pill' => 'steadysets-icon-pill',
	'steadysets-icon-bolt' => 'steadysets-icon-bolt',
	'steadysets-icon-health' => 'steadysets-icon-health',
	'steadysets-icon-map-marker' => 'steadysets-icon-map-marker',
	'steadysets-icon-stack' => 'steadysets-icon-stack',
	'steadysets-icon-newspaper' => 'steadysets-icon-newspaper',
	'steadysets-icon-uniE62F' => 'steadysets-icon-uniE62F',
	'steadysets-icon-coffee' => 'steadysets-icon-coffee',
	'steadysets-icon-bill' => 'steadysets-icon-bill',
	'steadysets-icon-sun' => 'steadysets-icon-sun',
	'steadysets-icon-vcard' => 'steadysets-icon-vcard',
	'steadysets-icon-shorts' => 'steadysets-icon-shorts',
	'steadysets-icon-drink' => 'steadysets-icon-drink',
	'steadysets-icon-diamond' => 'steadysets-icon-diamond',
	'steadysets-icon-bag' => 'steadysets-icon-bag',
	'steadysets-icon-calculator' => 'steadysets-icon-calculator',
	'steadysets-icon-credit-cards' => 'steadysets-icon-credit-cards',
	'steadysets-icon-microwave-oven' => 'steadysets-icon-microwave-oven',
	'steadysets-icon-camera' => 'steadysets-icon-camera',
	'steadysets-icon-share' => 'steadysets-icon-share',
	'steadysets-icon-bullhorn' => 'steadysets-icon-bullhorn',
	'steadysets-icon-user' => 'steadysets-icon-user',
	'steadysets-icon-users' => 'steadysets-icon-users',
	'steadysets-icon-user2' => 'steadysets-icon-user2',
	'steadysets-icon-users2' => 'steadysets-icon-users2',
	'steadysets-icon-unlocked' => 'steadysets-icon-unlocked',
	'steadysets-icon-unlocked2' => 'steadysets-icon-unlocked2',
	'steadysets-icon-lock' => 'steadysets-icon-lock',
	'steadysets-icon-forbidden' => 'steadysets-icon-forbidden',
	'steadysets-icon-switch' => 'steadysets-icon-switch',
	'steadysets-icon-meter' => 'steadysets-icon-meter',
	'steadysets-icon-flag' => 'steadysets-icon-flag',
	'steadysets-icon-home' => 'steadysets-icon-home',
	'steadysets-icon-printer' => 'steadysets-icon-printer',
	'steadysets-icon-clock' => 'steadysets-icon-clock',
	'steadysets-icon-calendar' => 'steadysets-icon-calendar',
	'steadysets-icon-comment' => 'steadysets-icon-comment',
	'steadysets-icon-chat-3' => 'steadysets-icon-chat-3',
	'steadysets-icon-chat-2' => 'steadysets-icon-chat-2',
	'steadysets-icon-chat-1' => 'steadysets-icon-chat-1',
	'steadysets-icon-chat' => 'steadysets-icon-chat',
	'steadysets-icon-zoom-out' => 'steadysets-icon-zoom-out',
	'steadysets-icon-zoom-in' => 'steadysets-icon-zoom-in',
	'steadysets-icon-search' => 'steadysets-icon-search',
	'steadysets-icon-trashcan' => 'steadysets-icon-trashcan',
	'steadysets-icon-tag' => 'steadysets-icon-tag',
	'steadysets-icon-download' => 'steadysets-icon-download',
	'steadysets-icon-paperclip' => 'steadysets-icon-paperclip',
	'steadysets-icon-checkbox' => 'steadysets-icon-checkbox',
	'steadysets-icon-checkbox-checked' => 'steadysets-icon-checkbox-checked',
	'steadysets-icon-checkmark' => 'steadysets-icon-checkmark',
	'steadysets-icon-refresh' => 'steadysets-icon-refresh',
	'steadysets-icon-reload' => 'steadysets-icon-reload',
	'steadysets-icon-arrow-right' => 'steadysets-icon-arrow-right',
	'steadysets-icon-arrow-down' => 'steadysets-icon-arrow-down',
	'steadysets-icon-arrow-up' => 'steadysets-icon-arrow-up',
	'steadysets-icon-arrow-left' => 'steadysets-icon-arrow-left',
	'steadysets-icon-settings' => 'steadysets-icon-settings',
	'steadysets-icon-battery-full' => 'steadysets-icon-battery-full',
	'steadysets-icon-battery-75' => 'steadysets-icon-battery-75',
	'steadysets-icon-battery-50' => 'steadysets-icon-battery-50',
	'steadysets-icon-battery-25' => 'steadysets-icon-battery-25',
	'steadysets-icon-battery-empty' => 'steadysets-icon-battery-empty',
	'steadysets-icon-battery-charging' => 'steadysets-icon-battery-charging',
	'steadysets-icon-uniE669' => 'steadysets-icon-uniE669',
	'steadysets-icon-grid' => 'steadysets-icon-grid',
	'steadysets-icon-list' => 'steadysets-icon-list',
	'steadysets-icon-wifi-low' => 'steadysets-icon-wifi-low',
	'steadysets-icon-folder-check' => 'steadysets-icon-folder-check',
	'steadysets-icon-folder-settings' => 'steadysets-icon-folder-settings',
	'steadysets-icon-folder-add' => 'steadysets-icon-folder-add',
	'steadysets-icon-folder' => 'steadysets-icon-folder',
	'steadysets-icon-window' => 'steadysets-icon-window',
	'steadysets-icon-windows' => 'steadysets-icon-windows',
	'steadysets-icon-browser' => 'steadysets-icon-browser',
	'steadysets-icon-file-broken' => 'steadysets-icon-file-broken',
	'steadysets-icon-align-justify' => 'steadysets-icon-align-justify',
	'steadysets-icon-align-center' => 'steadysets-icon-align-center',
	'steadysets-icon-align-right' => 'steadysets-icon-align-right',
	'steadysets-icon-align-left' => 'steadysets-icon-align-left',
	'steadysets-icon-file' => 'steadysets-icon-file',
	'steadysets-icon-file-add' => 'steadysets-icon-file-add',
	'steadysets-icon-file-settings' => 'steadysets-icon-file-settings',
	'steadysets-icon-mute' => 'steadysets-icon-mute',
	'steadysets-icon-heart' => 'steadysets-icon-heart',
	'steadysets-icon-enter' => 'steadysets-icon-enter',
	'steadysets-icon-volume-decrease' => 'steadysets-icon-volume-decrease',
	'steadysets-icon-wifi-mid' => 'steadysets-icon-wifi-mid',
	'steadysets-icon-volume' => 'steadysets-icon-volume',
	'steadysets-icon-bookmark' => 'steadysets-icon-bookmark',
	'steadysets-icon-screen' => 'steadysets-icon-screen',
	'steadysets-icon-map' => 'steadysets-icon-map',
	'steadysets-icon-measure' => 'steadysets-icon-measure',
	'steadysets-icon-eyedropper' => 'steadysets-icon-eyedropper',
	'steadysets-icon-support' => 'steadysets-icon-support',
	'steadysets-icon-phone' => 'steadysets-icon-phone',
	'steadysets-icon-email2' => 'steadysets-icon-email2',
	'steadysets-icon-volume-increase' => 'steadysets-icon-volume-increase',
	'steadysets-icon-wifi-full' => 'steadysets-icon-wifi-full',
		'fa fa-glass' => 'fa fa-glass',
	'fa fa-music' => 'fa fa-music',
	'fa fa-search' => 'fa fa-search',
	'fa fa-envelope-o' => 'fa fa-envelope-o',
	'fa fa-heart' => 'fa fa-heart',
	'fa fa-star' => 'fa fa-star',
	'fa fa-star-o' => 'fa fa-star-o',
	'fa fa-user' => 'fa fa-user',
	'fa fa-film' => 'fa fa-film',
	'fa fa-th-large' => 'fa fa-th-large',
	'fa fa-th' => 'fa fa-th',
	'fa fa-th-list' => 'fa fa-th-list',
	'fa fa-check' => 'fa fa-check',
	'fa fa-times' => 'fa fa-times',
	'fa fa-search-plus' => 'fa fa-search-plus',
	'fa fa-search-minus' => 'fa fa-search-minus',
	'fa fa-power-off' => 'fa fa-power-off',
	'fa fa-signal' => 'fa fa-signal',
	'fa fa-cog' => 'fa fa-cog',
	'fa fa-trash-o' => 'fa fa-trash-o',
	'fa fa-home' => 'fa fa-home',
	'fa fa-file-o' => 'fa fa-file-o',
	'fa fa-clock-o' => 'fa fa-clock-o',
	'fa fa-road' => 'fa fa-road',
	'fa fa-download' => 'fa fa-download',
	'fa fa-arrow-circle-o-down' => 'fa fa-arrow-circle-o-down',
	'fa fa-arrow-circle-o-up' => 'fa fa-arrow-circle-o-up',
	'fa fa-inbox' => 'fa fa-inbox',
	'fa fa-play-circle-o' => 'fa fa-play-circle-o',
	'fa fa-repeat' => 'fa fa-repeat',
	'fa fa-refresh' => 'fa fa-refresh',
	'fa fa-list-alt' => 'fa fa-list-alt',
	'fa fa-lock' => 'fa fa-lock',
	'fa fa-flag' => 'fa fa-flag',
	'fa fa-headphones' => 'fa fa-headphones',
	'fa fa-volume-off' => 'fa fa-volume-off',
	'fa fa-volume-down' => 'fa fa-volume-down',
	'fa fa-volume-up' => 'fa fa-volume-up',
	'fa fa-qrcode' => 'fa fa-qrcode',
	'fa fa-barcode' => 'fa fa-barcode',
	'fa fa-tag' => 'fa fa-tag',
	'fa fa-tags' => 'fa fa-tags',
	'fa fa-book' => 'fa fa-book',
	'fa fa-bookmark' => 'fa fa-bookmark',
	'fa fa-print' => 'fa fa-print',
	'fa fa-camera' => 'fa fa-camera',
	'fa fa-font' => 'fa fa-font',
	'fa fa-bold' => 'fa fa-bold',
	'fa fa-italic' => 'fa fa-italic',
	'fa fa-text-height' => 'fa fa-text-height',
	'fa fa-text-width' => 'fa fa-text-width',
	'fa fa-align-left' => 'fa fa-align-left',
	'fa fa-align-center' => 'fa fa-align-center',
	'fa fa-align-right' => 'fa fa-align-right',
	'fa fa-align-justify' => 'fa fa-align-justify',
	'fa fa-list' => 'fa fa-list',
	'fa fa-outdent' => 'fa fa-outdent',
	'fa fa-indent' => 'fa fa-indent',
	'fa fa-video-camera' => 'fa fa-video-camera',
	'fa fa-picture-o' => 'fa fa-picture-o',
	'fa fa-pencil' => 'fa fa-pencil',
	'fa fa-map-marker' => 'fa fa-map-marker',
	'fa fa-adjust' => 'fa fa-adjust',
	'fa fa-tint' => 'fa fa-tint',
	'fa fa-pencil-square-o' => 'fa fa-pencil-square-o',
	'fa fa-share-square-o' => 'fa fa-share-square-o',
	'fa fa-check-square-o' => 'fa fa-check-square-o',
	'fa fa-arrows' => 'fa fa-arrows',
	'fa fa-step-backward' => 'fa fa-step-backward',
	'fa fa-fast-backward' => 'fa fa-fast-backward',
	'fa fa-backward' => 'fa fa-backward',
	'fa fa-play' => 'fa fa-play',
	'fa fa-pause' => 'fa fa-pause',
	'fa fa-stop' => 'fa fa-stop',
	'fa fa-forward' => 'fa fa-forward',
	'fa fa-fast-forward' => 'fa fa-fast-forward',
	'fa fa-step-forward' => 'fa fa-step-forward',
	'fa fa-eject' => 'fa fa-eject',
	'fa fa-chevron-left' => 'fa fa-chevron-left',
	'fa fa-chevron-right' => 'fa fa-chevron-right',
	'fa fa-plus-circle' => 'fa fa-plus-circle',
	'fa fa-minus-circle' => 'fa fa-minus-circle',
	'fa fa-times-circle' => 'fa fa-times-circle',
	'fa fa-check-circle' => 'fa fa-check-circle',
	'fa fa-question-circle' => 'fa fa-question-circle',
	'fa fa-info-circle' => 'fa fa-info-circle',
	'fa fa-crosshairs' => 'fa fa-crosshairs',
	'fa fa-times-circle-o' => 'fa fa-times-circle-o',
	'fa fa-check-circle-o' => 'fa fa-check-circle-o',
	'fa fa-ban' => 'fa fa-ban',
	'fa fa-arrow-left' => 'fa fa-arrow-left',
	'fa fa-arrow-right' => 'fa fa-arrow-right',
	'fa fa-arrow-up' => 'fa fa-arrow-up',
	'fa fa-arrow-down' => 'fa fa-arrow-down',
	'fa fa-share' => 'fa fa-share',
	'fa fa-expand' => 'fa fa-expand',
	'fa fa-compress' => 'fa fa-compress',
	'fa fa-plus' => 'fa fa-plus',
	'fa fa-minus' => 'fa fa-minus',
	'fa fa-asterisk' => 'fa fa-asterisk',
	'fa fa-exclamation-circle' => 'fa fa-exclamation-circle',
	'fa fa-gift' => 'fa fa-gift',
	'fa fa-leaf' => 'fa fa-leaf',
	'fa fa-fire' => 'fa fa-fire',
	'fa fa-eye' => 'fa fa-eye',
	'fa fa-eye-slash' => 'fa fa-eye-slash',
	'fa fa-exclamation-triangle' => 'fa fa-exclamation-triangle',
	'fa fa-plane' => 'fa fa-plane',
	'fa fa-calendar' => 'fa fa-calendar',
	'fa fa-random' => 'fa fa-random',
	'fa fa-comment' => 'fa fa-comment',
	'fa fa-magnet' => 'fa fa-magnet',
	'fa fa-chevron-up' => 'fa fa-chevron-up',
	'fa fa-chevron-down' => 'fa fa-chevron-down',
	'fa fa-retweet' => 'fa fa-retweet',
	'fa fa-shopping-cart' => 'fa fa-shopping-cart',
	'fa fa-folder' => 'fa fa-folder',
	'fa fa-folder-open' => 'fa fa-folder-open',
	'fa fa-arrows-v' => 'fa fa-arrows-v',
	'fa fa-arrows-h' => 'fa fa-arrows-h',
	'fa fa-bar-chart-o' => 'fa fa-bar-chart-o',
	'fa fa-twitter-square' => 'fa fa-twitter-square',
	'fa fa-facebook-square' => 'fa fa-facebook-square',
	'fa fa-camera-retro' => 'fa fa-camera-retro',
	'fa fa-key' => 'fa fa-key',
	'fa fa-cogs' => 'fa fa-cogs',
	'fa fa-comments' => 'fa fa-comments',
	'fa fa-thumbs-o-up' => 'fa fa-thumbs-o-up',
	'fa fa-thumbs-o-down' => 'fa fa-thumbs-o-down',
	'fa fa-star-half' => 'fa fa-star-half',
	'fa fa-heart-o' => 'fa fa-heart-o',
	'fa fa-sign-out' => 'fa fa-sign-out',
	'fa fa-linkedin-square' => 'fa fa-linkedin-square',
	'fa fa-thumb-tack' => 'fa fa-thumb-tack',
	'fa fa-external-link' => 'fa fa-external-link',
	'fa fa-sign-in' => 'fa fa-sign-in',
	'fa fa-trophy' => 'fa fa-trophy',
	'fa fa-github-square' => 'fa fa-github-square',
	'fa fa-upload' => 'fa fa-upload',
	'fa fa-lemon-o' => 'fa fa-lemon-o',
	'fa fa-phone' => 'fa fa-phone',
	'fa fa-square-o' => 'fa fa-square-o',
	'fa fa-bookmark-o' => 'fa fa-bookmark-o',
	'fa fa-phone-square' => 'fa fa-phone-square',
	'fa fa-twitter' => 'fa fa-twitter',
	'fa fa-facebook' => 'fa fa-facebook',
	'fa fa-github' => 'fa fa-github',
	'fa fa-unlock' => 'fa fa-unlock',
	'fa fa-credit-card' => 'fa fa-credit-card',
	'fa fa-rss' => 'fa fa-rss',
	'fa fa-hdd-o' => 'fa fa-hdd-o',
	'fa fa-bullhorn' => 'fa fa-bullhorn',
	'fa fa-bell' => 'fa fa-bell',
	'fa fa-certificate' => 'fa fa-certificate',
	'fa fa-hand-o-right' => 'fa fa-hand-o-right',
	'fa fa-hand-o-left' => 'fa fa-hand-o-left',
	'fa fa-hand-o-up' => 'fa fa-hand-o-up',
	'fa fa-hand-o-down' => 'fa fa-hand-o-down',
	'fa fa-arrow-circle-left' => 'fa fa-arrow-circle-left',
	'fa fa-arrow-circle-right' => 'fa fa-arrow-circle-right',
	'fa fa-arrow-circle-up' => 'fa fa-arrow-circle-up',
	'fa fa-arrow-circle-down' => 'fa fa-arrow-circle-down',
	'fa fa-globe' => 'fa fa-globe',
	'fa fa-wrench' => 'fa fa-wrench',
	'fa fa-tasks' => 'fa fa-tasks',
	'fa fa-filter' => 'fa fa-filter',
	'fa fa-briefcase' => 'fa fa-briefcase',
	'fa fa-arrows-alt' => 'fa fa-arrows-alt',
	'fa fa-users' => 'fa fa-users',
	'fa fa-link' => 'fa fa-link',
	'fa fa-cloud' => 'fa fa-cloud',
	'fa fa-flask' => 'fa fa-flask',
	'fa fa-scissors' => 'fa fa-scissors',
	'fa fa-files-o' => 'fa fa-files-o',
	'fa fa-paperclip' => 'fa fa-paperclip',
	'fa fa-floppy-o' => 'fa fa-floppy-o',
	'fa fa-square' => 'fa fa-square',
	'fa fa-bars' => 'fa fa-bars',
	'fa fa-list-ul' => 'fa fa-list-ul',
	'fa fa-list-ol' => 'fa fa-list-ol',
	'fa fa-strikethrough' => 'fa fa-strikethrough',
	'fa fa-underline' => 'fa fa-underline',
	'fa fa-table' => 'fa fa-table',
	'fa fa-magic' => 'fa fa-magic',
	'fa fa-truck' => 'fa fa-truck',
	'fa fa-pinterest' => 'fa fa-pinterest',
	'fa fa-pinterest-square' => 'fa fa-pinterest-square',
	'fa fa-google-plus-square' => 'fa fa-google-plus-square',
	'fa fa-google-plus' => 'fa fa-google-plus',
	'fa fa-money' => 'fa fa-money',
	'fa fa-caret-down' => 'fa fa-caret-down',
	'fa fa-caret-up' => 'fa fa-caret-up',
	'fa fa-caret-left' => 'fa fa-caret-left',
	'fa fa-caret-right' => 'fa fa-caret-right',
	'fa fa-columns' => 'fa fa-columns',
	'fa fa-sort' => 'fa fa-sort',
	'fa fa-sort-asc' => 'fa fa-sort-asc',
	'fa fa-sort-desc' => 'fa fa-sort-desc',
	'fa fa-envelope' => 'fa fa-envelope',
	'fa fa-linkedin' => 'fa fa-linkedin',
	'fa fa-undo' => 'fa fa-undo',
	'fa fa-gavel' => 'fa fa-gavel',
	'fa fa-tachometer' => 'fa fa-tachometer',
	'fa fa-comment-o' => 'fa fa-comment-o',
	'fa fa-comments-o' => 'fa fa-comments-o',
	'fa fa-bolt' => 'fa fa-bolt',
	'fa fa-sitemap' => 'fa fa-sitemap',
	'fa fa-umbrella' => 'fa fa-umbrella',
	'fa fa-clipboard' => 'fa fa-clipboard',
	'fa fa-lightbulb-o' => 'fa fa-lightbulb-o',
	'fa fa-exchange' => 'fa fa-exchange',
	'fa fa-cloud-download' => 'fa fa-cloud-download',
	'fa fa-cloud-upload' => 'fa fa-cloud-upload',
	'fa fa-user-md' => 'fa fa-user-md',
	'fa fa-stethoscope' => 'fa fa-stethoscope',
	'fa fa-suitcase' => 'fa fa-suitcase',
	'fa fa-bell-o' => 'fa fa-bell-o',
	'fa fa-coffee' => 'fa fa-coffee',
	'fa fa-cutlery' => 'fa fa-cutlery',
	'fa fa-file-text-o' => 'fa fa-file-text-o',
	'fa fa-building-o' => 'fa fa-building-o',
	'fa fa-hospital-o' => 'fa fa-hospital-o',
	'fa fa-ambulance' => 'fa fa-ambulance',
	'fa fa-medkit' => 'fa fa-medkit',
	'fa fa-fighter-jet' => 'fa fa-fighter-jet',
	'fa fa-beer' => 'fa fa-beer',
	'fa fa-h-square' => 'fa fa-h-square',
	'fa fa-plus-square' => 'fa fa-plus-square',
	'fa fa-angle-double-left' => 'fa fa-angle-double-left',
	'fa fa-angle-double-right' => 'fa fa-angle-double-right',
	'fa fa-angle-double-up' => 'fa fa-angle-double-up',
	'fa fa-angle-double-down' => 'fa fa-angle-double-down',
	'fa fa-angle-left' => 'fa fa-angle-left',
	'fa fa-angle-right' => 'fa fa-angle-right',
	'fa fa-angle-up' => 'fa fa-angle-up',
	'fa fa-angle-down' => 'fa fa-angle-down',
	'fa fa-desktop' => 'fa fa-desktop',
	'fa fa-laptop' => 'fa fa-laptop',
	'fa fa-tablet' => 'fa fa-tablet',
	'fa fa-mobile' => 'fa fa-mobile',
	'fa fa-circle-o' => 'fa fa-circle-o',
	'fa fa-quote-left' => 'fa fa-quote-left',
	'fa fa-quote-right' => 'fa fa-quote-right',
	'fa fa-spinner' => 'fa fa-spinner',
	'fa fa-circle' => 'fa fa-circle',
	'fa fa-reply' => 'fa fa-reply',
	'fa fa-github-alt' => 'fa fa-github-alt',
	'fa fa-folder-o' => 'fa fa-folder-o',
	'fa fa-folder-open-o' => 'fa fa-folder-open-o',
	'fa fa-smile-o' => 'fa fa-smile-o',
	'fa fa-frown-o' => 'fa fa-frown-o',
	'fa fa-meh-o' => 'fa fa-meh-o',
	'fa fa-gamepad' => 'fa fa-gamepad',
	'fa fa-keyboard-o' => 'fa fa-keyboard-o',
	'fa fa-flag-o' => 'fa fa-flag-o',
	'fa fa-flag-checkered' => 'fa fa-flag-checkered',
	'fa fa-terminal' => 'fa fa-terminal',
	'fa fa-code' => 'fa fa-code',
	'fa fa-reply-all' => 'fa fa-reply-all',
	'fa fa-mail-reply-all' => 'fa fa-mail-reply-all',
	'fa fa-star-half-o' => 'fa fa-star-half-o',
	'fa fa-location-arrow' => 'fa fa-location-arrow',
	'fa fa-crop' => 'fa fa-crop',
	'fa fa-code-fork' => 'fa fa-code-fork',
	'fa fa-chain-broken' => 'fa fa-chain-broken',
	'fa fa-question' => 'fa fa-question',
	'fa fa-info' => 'fa fa-info',
	'fa fa-exclamation' => 'fa fa-exclamation',
	'fa fa-superscript' => 'fa fa-superscript',
	'fa fa-subscript' => 'fa fa-subscript',
	'fa fa-eraser' => 'fa fa-eraser',
	'fa fa-puzzle-piece' => 'fa fa-puzzle-piece',
	'fa fa-microphone' => 'fa fa-microphone',
	'fa fa-microphone-slash' => 'fa fa-microphone-slash',
	'fa fa-shield' => 'fa fa-shield',
	'fa fa-calendar-o' => 'fa fa-calendar-o',
	'fa fa-fire-extinguisher' => 'fa fa-fire-extinguisher',
	'fa fa-rocket' => 'fa fa-rocket',
	'fa fa-maxcdn' => 'fa fa-maxcdn',
	'fa fa-chevron-circle-left' => 'fa fa-chevron-circle-left',
	'fa fa-chevron-circle-right' => 'fa fa-chevron-circle-right',
	'fa fa-chevron-circle-up' => 'fa fa-chevron-circle-up',
	'fa fa-chevron-circle-down' => 'fa fa-chevron-circle-down',
	'fa fa-html5' => 'fa fa-html5',
	'fa fa-css3' => 'fa fa-css3',
	'fa fa-anchor' => 'fa fa-anchor',
	'fa fa-unlock-alt' => 'fa fa-unlock-alt',
	'fa fa-bullseye' => 'fa fa-bullseye',
	'fa fa-ellipsis-h' => 'fa fa-ellipsis-h',
	'fa fa-ellipsis-v' => 'fa fa-ellipsis-v',
	'fa fa-rss-square' => 'fa fa-rss-square',
	'fa fa-play-circle' => 'fa fa-play-circle',
	'fa fa-ticket' => 'fa fa-ticket',
	'fa fa-minus-square' => 'fa fa-minus-square',
	'fa fa-minus-square-o' => 'fa fa-minus-square-o',
	'fa fa-level-up' => 'fa fa-level-up',
	'fa fa-level-down' => 'fa fa-level-down',
	'fa fa-check-square' => 'fa fa-check-square',
	'fa fa-pencil-square' => 'fa fa-pencil-square',
	'fa fa-external-link-square' => 'fa fa-external-link-square',
	'fa fa-share-square' => 'fa fa-share-square',
	'fa fa-compass' => 'fa fa-compass',
	'fa fa-caret-square-o-down' => 'fa fa-caret-square-o-down',
	'fa fa-caret-square-o-up' => 'fa fa-caret-square-o-up',
	'fa fa-caret-square-o-right' => 'fa fa-caret-square-o-right',
	'fa fa-eur' => 'fa fa-eur',
	'fa fa-gbp' => 'fa fa-gbp',
	'fa fa-usd' => 'fa fa-usd',
	'fa fa-inr' => 'fa fa-inr',
	'fa fa-jpy' => 'fa fa-jpy',
	'fa fa-rub' => 'fa fa-rub',
	'fa fa-krw' => 'fa fa-krw',
	'fa fa-btc' => 'fa fa-btc',
	'fa fa-file' => 'fa fa-file',
	'fa fa-file-text' => 'fa fa-file-text',
	'fa fa-sort-alpha-asc' => 'fa fa-sort-alpha-asc',
	'fa fa-sort-alpha-desc' => 'fa fa-sort-alpha-desc',
	'fa fa-sort-amount-asc' => 'fa fa-sort-amount-asc',
	'fa fa-sort-amount-desc' => 'fa fa-sort-amount-desc',
	'fa fa-sort-numeric-asc' => 'fa fa-sort-numeric-asc',
	'fa fa-sort-numeric-desc' => 'fa fa-sort-numeric-desc',
	'fa fa-thumbs-up' => 'fa fa-thumbs-up',
	'fa fa-thumbs-down' => 'fa fa-thumbs-down',
	'fa fa-youtube-square' => 'fa fa-youtube-square',
	'fa fa-youtube' => 'fa fa-youtube',
	'fa fa-xing' => 'fa fa-xing',
	'fa fa-xing-square' => 'fa fa-xing-square',
	'fa fa-youtube-play' => 'fa fa-youtube-play',
	'fa fa-dropbox' => 'fa fa-dropbox',
	'fa fa-stack-overflow' => 'fa fa-stack-overflow',
	'fa fa-instagram' => 'fa fa-instagram',
	'fa fa-flickr' => 'fa fa-flickr',
	'fa fa-adn' => 'fa fa-adn',
	'fa fa-bitbucket' => 'fa fa-bitbucket',
	'fa fa-bitbucket-square' => 'fa fa-bitbucket-square',
	'fa fa-tumblr' => 'fa fa-tumblr',
	'fa fa-tumblr-square' => 'fa fa-tumblr-square',
	'fa fa-long-arrow-down' => 'fa fa-long-arrow-down',
	'fa fa-long-arrow-up' => 'fa fa-long-arrow-up',
	'fa fa-long-arrow-left' => 'fa fa-long-arrow-left',
	'fa fa-long-arrow-right' => 'fa fa-long-arrow-right',
	'fa fa-apple' => 'fa fa-apple',
	'fa fa-windows' => 'fa fa-windows',
	'fa fa-android' => 'fa fa-android',
	'fa fa-linux' => 'fa fa-linux',
	'fa fa-dribbble' => 'fa fa-dribbble',
	'fa fa-skype' => 'fa fa-skype',
	'fa fa-foursquare' => 'fa fa-foursquare',
	'fa fa-trello' => 'fa fa-trello',
	'fa fa-female' => 'fa fa-female',
	'fa fa-male' => 'fa fa-male',
	'fa fa-gittip' => 'fa fa-gittip',
	'fa fa-sun-o' => 'fa fa-sun-o',
	'fa fa-moon-o' => 'fa fa-moon-o',
	'fa fa-archive' => 'fa fa-archive',
	'fa fa-bug' => 'fa fa-bug',
	'fa fa-vk' => 'fa fa-vk',
	'fa fa-weibo' => 'fa fa-weibo',
	'fa fa-renren' => 'fa fa-renren',
	'fa fa-pagelines' => 'fa fa-pagelines',
	'fa fa-stack-exchange' => 'fa fa-stack-exchange',
	'fa fa-arrow-circle-o-right' => 'fa fa-arrow-circle-o-right',
	'fa fa-arrow-circle-o-left' => 'fa fa-arrow-circle-o-left',
	'fa fa-caret-square-o-left' => 'fa fa-caret-square-o-left',
	'fa fa-dot-circle-o' => 'fa fa-dot-circle-o',
	'fa fa-wheelchair' => 'fa fa-wheelchair',
	'fa fa-vimeo-square' => 'fa fa-vimeo-square',
	'fa fa-try' => 'fa fa-try',
	'fa fa-plus-square-o' => 'fa fa-plus-square-o',
);

/*-----------------------------------------------------------------------------------*/
/*	Icons param Field
/*-----------------------------------------------------------------------------------*/

vc_add_shortcode_param( 'icons', 'icons_settings_field' );
function icons_settings_field( $settings, $value ) {
	global $iconList;
	$output  = '<div class="icons_block">';
	$output .= '<input type="hidden" disabled="disabled" type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="text" value="' . $value . '"/>' . "\n";
	$output .= '<div class="themeone-icons-holder">';
	foreach( $iconList as $icon) {
		$class = null;
		if ($value == $icon) { $class = 'active'; }
		$output .= '<i class="' . $icon . ' '. $class .' icon-option" value="' . $icon . '"></i>';
	}
	$output .= '</div>';
	return $output;
}

?>