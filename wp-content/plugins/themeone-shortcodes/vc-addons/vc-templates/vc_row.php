<?php
/** @var $this WPBakeryShortCode_VC_Row */
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $el_id = $full_width = '';
extract(shortcode_atts(array(
    'el_class' => '',
	'el_id' => '',
	'bg_image' => '',
	'bg_color' => '',
	'full_height' => '',
	'content_placement' => 'middle',
	'bg_image_repeat' => '',
	'font_color' => '',
	'padding' => '',
	'margin_bottom' => '',
	'full_width' => false,
	'css' => '',
	/*** custom parameters ***/
	'to_section_layout' => 'boxed',
	'to_equal_column' => '',
	'txt_section_color' => '',
	'txt_section_align' => '',
	'top_section_deco' => '',
	'bot_section_deco' => '',
	'to_parallax' => '',
	'to_para_bg' => '',
	'to_para_img' => '',
	'to_para_img_repeat' => 'no-repeat',
	'to_side_img_position' => 'left',
	'to_para_blur' => '',
	'to_para_poster' => '',
	'to_para_vimeo_url' => '',
	'to_para_youtube_url' => '',
	'to_para_video_mp4' => '',
	'to_para_video_ogg' => '',
	'to_para_video_webm' => '',
	'to_para_over_set' => '',
	'to_para_over_img' => '',
	'to_para_over_color' => '',
	'to_para_over_opacity' => ''
), $atts));

$top_deco = null;
$bot_deco = null;

$to_section_before = null;
$to_section_after = null;


if (!empty($to_equal_column)) {
	$to_equal_column = ' equal-height';
}

if (empty($to_section_layout) || $to_section_layout == 'boxed') {
	$to_section_layout = 'section-conainer';
	$to_section_before = '<div class="section-container">';
	$to_section_after  = '</div>';
} 
if ($to_para_bg != 'no_bg' &&  !empty($to_para_bg)) {
	$to_para_class = 'parallax-container';
} else {
	$to_para_class  = null;
}
if ($to_para_blur == 'blur') {
	$to_para_blur = ' blur';
} else {
	$to_para_blur = '';
}
if ($to_parallax == 'parallax' && $to_para_bg != 'no_bg') {
	$to_parallax = 'paratrue';
} else {
	$to_parallax = null;
}
if (!empty($to_para_over_color)) {
	$to_para_over_color = esc_attr(to_accent_color($to_para_over_color));
	$to_para_over_color = 'background-color:'. $to_para_over_color .';';
}
if (!empty($to_para_over_img)) {
	$to_para_over_img = 'style="background-image : url('. esc_url($to_para_over_img)  .');"';
}
if (!empty($to_para_over_opacity)) {
	$to_para_over_opacity = 'opacity :'. esc_attr($to_para_over_opacity)  .';filter: Alpha(Opacity='. esc_attr($to_para_over_opacity) *100  .');';
}


if($bg_color != '') {
	$fillColor = 'fill="'. $bg_color .'"';
} else {
	$fillColor = '';
}

if($top_section_deco != '' /*&& $to_para_bg == 'no_bg'*/)  { 
		$top_deco  = '<div class="to-separator-top">';
	if ($top_section_deco == 'slope-left') {
		$top_deco .= '<svg class="slope-left" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 0 L100 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'slope-right') {
		$top_deco .= '<svg class="slope-right" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';	
	}
	if ($top_section_deco == 'arrow') {
		$top_deco .= '<svg class="arrow" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'circle') {
		$top_deco .= '<svg class="circle" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<circle cx="50" cy="50" r="50" stroke-width="0" '. $fillColor .'></circle></svg>';
	}
	if ($top_section_deco == 'repeat-triangle') {
		$top_deco .= '<svg class="repeat-triangle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 L2 60 L4 100 L6 60 L8 100 L10 60 L12 100 L14 60 L16 100 L18 60 L20 100 L22 60 L24 100 L26 60 L28 100 L30 60 L32 100 L34 60 L36 100 L38 60 L40 100 L42 60 L44 100 L46 60 L48 100 L50 60 L52 100 L54 60 L56 100 L58 60 L60 100 L62 60 L64 100 L66 60 L68 100 L70 60 L72 100 L74 60 L76 100 L78 60 L80 100 L82 60 L84 100 L86 60 L88 100 L90 60 L92 100 L94 60 L96 100 L98 60 L100 100 Z" stroke-width="0" '. $fillColor .'></path>';
		$top_deco .= '</svg>';
		$top_deco .= '<svg class="repeat-triangle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 L5 60 L10 100 L5 60 L10 100 L15 60 L20 100 L25 60 L30 100 L35 60 L40 100 L45 60 L50 100 L55 60 L60 100 L65 60 L70 100 L75 60 L80 100 L85 60 L90 100 L95 60 L100 100" '. $fillColor .'></path>';
		$top_deco .= '</svg>';
	}
	if ($top_section_deco == 'repeat-circle') {
		$top_deco .= '<svg class="repeat-circle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 Q 2.5 40 5 100 Q 7.5 40 10 100 Q 12.5 40 15 100 Q 17.5 40 20 100 Q 22.5 40 25 100 Q 27.5 40 30 100 Q 32.5 40 35 100 Q 37.5 40 40 100 Q 42.5 40 45 100 Q 47.5 40 50 100 Q 52.5 40 55 100 Q 57.5 40 60 100 Q 62.5 40 65 100 Q 67.5 40 70 100 Q 72.5 40 75 100 Q 77.5 40 80 100 Q 82.5 40 85 100 Q 87.5 40 90 100 Q 92.5 40 95 100 Q 97.5 40 100 100 " stroke-width="0" '. $fillColor .'></path>';
		$top_deco .= '</svg>';
		$top_deco .= '<svg class="repeat-circle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 Q 5 40 10 100  Q 15 40 20 100  Q 25 40 30 100  Q 35 40 40 100  Q 45 40 50 100  Q 55 40 60 100  Q 65 40 70 100  Q 75 40 80 100  Q 85 40 90 100  Q 95 40 100 100 " '. $fillColor .'></path>';
		$top_deco .= '</svg>';
	}
	if ($top_section_deco == 'clouds') {
		$top_deco .= '<svg class="clouds" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M-5 100 Q 0 20 5 100 Z M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100 M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100 M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100 M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100 M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'rounded-outer') {
		$top_deco .= '<svg class="rounded-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 C50 0 50 0 100 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'rounded-inner') {
		$top_deco .= '<svg class="rounded-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 0 C50 100 50 100 100 0  L100 100 0 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'triangle-outer') {
		$top_deco .= '<svg class="triangle-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($top_section_deco == 'triangle-inner') {
		$top_deco .= '<svg class="triangle-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$top_deco .= '<path d="M0 0 L50 100 L100 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	$top_deco .= '</div>';
}

if($bot_section_deco != '' /*&& $to_para_bg == 'no_bg'*/)  {
	$bot_deco  = '<div class="to-separator-bottom">';
	if ($bot_section_deco == 'slope-right') {
		$bot_deco .= '<svg class="slope-right" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'slope-left') {
		$bot_deco .= '<svg class="slope-left" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 0 L100 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'arrow') {
		$bot_deco .= '<svg class="arrow" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'circle') {
		$bot_deco .= '<svg class="circle" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<circle cx="50" cy="50" r="50" stroke-width="0" '. $fillColor .'></circle></svg>';
	}
	if ($bot_section_deco == 'repeat-triangle') {
		$bot_deco .= '<svg class="repeat-triangle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 L2 60 L4 100 L6 60 L8 100 L10 60 L12 100 L14 60 L16 100 L18 60 L20 100 L22 60 L24 100 L26 60 L28 100 L30 60 L32 100 L34 60 L36 100 L38 60 L40 100 L42 60 L44 100 L46 60 L48 100 L50 60 L52 100 L54 60 L56 100 L58 60 L60 100 L62 60 L64 100 L66 60 L68 100 L70 60 L72 100 L74 60 L76 100 L78 60 L80 100 L82 60 L84 100 L86 60 L88 100 L90 60 L92 100 L94 60 L96 100 L98 60 L100 100 Z" stroke-width="0" '. $fillColor .'></path>';
		$bot_deco .= '</svg>';
		$bot_deco .= '<svg class="repeat-triangle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 L5 60 L10 100 L5 60 L10 100 L15 60 L20 100 L25 60 L30 100 L35 60 L40 100 L45 60 L50 100 L55 60 L60 100 L65 60 L70 100 L75 60 L80 100 L85 60 L90 100 L95 60 L100 100" '. $fillColor .'></path>';
		$bot_deco .= '</svg>';
	}
	if ($bot_section_deco == 'repeat-circle') {
		$bot_deco .= '<svg class="repeat-circle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 Q 2.5 40 5 100 Q 7.5 40 10 100 Q 12.5 40 15 100 Q 17.5 40 20 100 Q 22.5 40 25 100 Q 27.5 40 30 100 Q 32.5 40 35 100 Q 37.5 40 40 100 Q 42.5 40 45 100 Q 47.5 40 50 100 Q 52.5 40 55 100 Q 57.5 40 60 100 Q 62.5 40 65 100 Q 67.5 40 70 100 Q 72.5 40 75 100 Q 77.5 40 80 100 Q 82.5 40 85 100 Q 87.5 40 90 100 Q 92.5 40 95 100 Q 97.5 40 100 100 " stroke-width="0" '. $fillColor .'></path>';
		$bot_deco .= '</svg>';
		$bot_deco .= '<svg class="repeat-circle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 Q 5 40 10 100  Q 15 40 20 100  Q 25 40 30 100  Q 35 40 40 100  Q 45 40 50 100  Q 55 40 60 100  Q 65 40 70 100  Q 75 40 80 100  Q 85 40 90 100  Q 95 40 100 100 " '. $fillColor .'></path>';
		$bot_deco .= '</svg>';
	}
	if ($bot_section_deco == 'clouds') {
		$bot_deco .= '<svg class="clouds" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M-5 100 Q 0 20 5 100 Z M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100 M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100 M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100 M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100 M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'rounded-outer') {
		$bot_deco .= '<svg class="rounded-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 C50 0 50 0 100 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'rounded-inner') {
		$bot_deco .= '<svg class="rounded-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 0 C50 100 50 100 100 0  L100 100 0 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'triangle-outer') {
		$bot_deco .= '<svg class="triangle-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	if ($bot_section_deco == 'triangle-inner') {
		$bot_deco .= '<svg class="triangle-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
		$bot_deco .= '<path d="M0 0 L50 100 L100 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
	}
	$bot_deco .= '</div>';
}

$para_section = null;
$para_overlay = null;
if (!empty($to_para_over_set)) {
	$para_overlay  = '<div class="parallax-container-overlay" '. $to_para_over_img .'></div>';
	$para_overlay .= '<div class="parallax-container-overlay-color" style="'. $to_para_over_color . $to_para_over_opacity .'"></div>';
}

if ($to_para_bg == 'image') {
	$para_section  = '<div class="parallax-container-inner '. esc_attr($to_para_img_repeat) . esc_attr($to_para_blur) .'" style="background-image:url('. esc_url($to_para_img) .');" ></div>';
	$para_section .= $para_overlay;
} else if ($to_para_bg == 'youtube') {
	$para_section  = '<div class="parallax-container-inner parallax-video">';
	$para_section .= '<div class="parallax-container-poster" '. $to_para_poster  .'></div>';
	$para_section .= '<div class="to-para-youtube" data-youtube-url="'. esc_attr($to_para_youtube_url) .'"></div>';	
	$para_section .= $para_overlay;
	$para_section .= '</div>';
} else if ($to_para_bg == 'vimeo') {
	$para_section  = '<div class="parallax-container-inner parallax-video">';
	$para_section .= '<div class="parallax-container-poster" '. $to_para_poster  .'></div>';
	$vimeo  = esc_attr(parse_vimeourl($to_para_vimeo_url));
	$hash   = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo.php"));
	$width  = esc_attr($hash[0]['width']); 
	$height = esc_attr($hash[0]['height']);
	$para_section .= '<iframe data-height="'. $height .'" data-width="'. $width .'" style="width:'. $width .'px;height:'. $height .'px;" class="vimeo-player-section" src="//player.vimeo.com/video/'. $vimeo .'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;autoplay=1&amp;loop=1"></iframe>';
	$para_section .= $para_overlay;
	$para_section .= '</div>';
} else if ($to_para_bg == 'video') {
	$para_section  = '<div class="parallax-container-inner parallax-video">';
	$para_section .= '<div class="parallax-container-poster" '. $to_para_poster  .'></div>';
	$para_section .= '<video controls  preload="auto">';
	if ($to_para_video_mp4 != '') {
		$para_section .= '<source type="video/mp4" src="'. esc_url($to_para_video_mp4) .'" />';
	}
	if ($to_para_video_webm != '') {
		$para_section .= '<source type="video/webm" src="'. esc_url($to_para_video_webm) .'" />';
		}
	if ($to_para_video_ogg != '') {
		$para_section .= '<source type="video/ogg" src="'. esc_url($to_para_video_ogg) .'" />';
	}
	$para_section .= '</video>';
	$para_section .= $para_overlay;
	$para_section .= '</div>';
}

if ( ! empty( $full_height ) ) {
	$full_height = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$full_height .= ' vc_row-o-content-' . $content_placement;
	}
}

$el_class = $this->getExtraClass($el_class);
$css_classes = array(
	'vc_row',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) ) . $to_equal_column;

if (preg_match("/\{(.*?)\}/s", $css, $match)) {
	$inline_style = 'style="'.$match[1].'"';
} else {
	$inline_style = '';
}

if (!empty($el_id)) {
	$el_id = ' id="' . esc_attr( $el_id ) . '"';
}

if ($to_para_bg == 'side-image') {
	$output  = '<section class="side-section '. esc_attr($to_side_img_position) .' '. $css_class .'"'.$el_id.' '.$inline_style.' >';
	$output .= '<div class="side-section-image '. esc_attr($to_para_img_repeat) . esc_attr($to_para_blur) .'" style="background-image:url('. esc_url($to_para_img) .');"></div>';
	$output .= '<div class="section-container '. esc_attr($txt_section_color) .'">';
	$output .= '<div class="col col-6 side-col">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</section>';
} else {
	$output .= '<div class="'. $to_para_class .' '. esc_attr($to_parallax) .' '. esc_attr($txt_section_color) .' '. $css_class .'"'.$el_id.' '.$inline_style.' >';
	$output .= $top_deco;
	$output .= $para_section;
	$output .= $to_section_before;
	$output .= wpb_js_remove_wpautop($content);
	$output .= $to_section_after;
	$output .= $bot_deco;
	$output .= '</div>'.$this->endBlockComment('row');	
}

echo $output;
	
?>