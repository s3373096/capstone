<?php

function to_accent_color($color) {
	global $mobius;
	if ((strpos($color,'accent-color') !== false || strpos($color,'second-bgcolor') !== false) && class_exists('Themeone_config')) {
		return $color = $mobius[$color];
	} else {
		return $color = $color;
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Section
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_section')) {
	function themeone_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => '',
			'bgcolor' => '',
			'txtcolor' => '',
			'decotop' => '',
			'decobot' => ''
	    ), $atts));
		$color = '';
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		if($bgcolor != '')  { 
			$color = 'style="background:'.$bgcolor.'"';
		}
		if($bgcolor != '') {
			$fillColor = 'fill="'. $bgcolor .'"';
		} else {
			$fillColor = '';
		}
		if($txtcolor != '')  { 
			$txtcolor = 'class="'. esc_attr($txtcolor) .'"';
		}
		$output  = '<section '.$color.' '. $txtcolor .'>';
		if($decotop != '')  { 
			$output .= '<div class="to-separator-top">';
			if ($decotop == 'slope-left') {
				$output .= '<svg class="slope-left" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L100 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'slope-right') {
				$output .= '<svg class="slope-right" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';	
			}
			if ($decotop == 'arrow') {
				$output .= '<svg class="arrow" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'circle') {
				$output .= '<svg class="circle" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<circle cx="50" cy="50" r="50" stroke-width="0" '. $fillColor .'></circle></svg>';
			}
			if ($decotop == 'repeat-triangle') {
				$output .= '<svg class="repeat-triangle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L2 60 L4 100 L6 60 L8 100 L10 60 L12 100 L14 60 L16 100 L18 60 L20 100 L22 60 L24 100 L26 60 L28 100 L30 60 L32 100 L34 60 L36 100 L38 60 L40 100 L42 60 L44 100 L46 60 L48 100 L50 60 L52 100 L54 60 L56 100 L58 60 L60 100 L62 60 L64 100 L66 60 L68 100 L70 60 L72 100 L74 60 L76 100 L78 60 L80 100 L82 60 L84 100 L86 60 L88 100 L90 60 L92 100 L94 60 L96 100 L98 60 L100 100 Z" stroke-width="0" '. $fillColor .'></path>';
				$output .= '</svg>';
				$output .= '<svg class="repeat-triangle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L5 60 L10 100 L5 60 L10 100 L15 60 L20 100 L25 60 L30 100 L35 60 L40 100 L45 60 L50 100 L55 60 L60 100 L65 60 L70 100 L75 60 L80 100 L85 60 L90 100 L95 60 L100 100" '. $fillColor .'></path>';
				$output .= '</svg>';
			}
			if ($decotop == 'repeat-circle') {
				$output .= '<svg class="repeat-circle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 Q 2.5 40 5 100 Q 7.5 40 10 100 Q 12.5 40 15 100 Q 17.5 40 20 100 Q 22.5 40 25 100 Q 27.5 40 30 100 Q 32.5 40 35 100 Q 37.5 40 40 100 Q 42.5 40 45 100 Q 47.5 40 50 100 Q 52.5 40 55 100 Q 57.5 40 60 100 Q 62.5 40 65 100 Q 67.5 40 70 100 Q 72.5 40 75 100 Q 77.5 40 80 100 Q 82.5 40 85 100 Q 87.5 40 90 100 Q 92.5 40 95 100 Q 97.5 40 100 100 " stroke-width="0" '. $fillColor .'></path>';
				$output .= '</svg>';
				$output .= '<svg class="repeat-circle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 Q 5 40 10 100  Q 15 40 20 100  Q 25 40 30 100  Q 35 40 40 100  Q 45 40 50 100  Q 55 40 60 100  Q 65 40 70 100  Q 75 40 80 100  Q 85 40 90 100  Q 95 40 100 100 " '. $fillColor .'></path>';
				$output .= '</svg>';
			}
			if ($decotop == 'clouds') {
				$output .= '<svg class="clouds" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M-5 100 Q 0 20 5 100 Z M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100 M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100 M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100 M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100 M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'rounded-outer') {
				$output .= '<svg class="rounded-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 C50 0 50 0 100 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'rounded-inner') {
				$output .= '<svg class="rounded-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 C50 100 50 100 100 0  L100 100 0 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'triangle-outer') {
				$output .= '<svg class="triangle-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decotop == 'triangle-inner') {
				$output .= '<svg class="triangle-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L50 100 L100 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			$output .= '</div>';
		}
		if($type == 'boxed')  {
			$output .= '<div class="section-container">';
		}
		$output .= do_shortcode($content);
		
		if($type == 'boxed')  {
			$output .= '</div>';
		}
		if($decobot != '')  { 
			$output .= '<div class="to-separator-bottom">';
			if ($decobot == 'slope-right') {
				$output .= '<svg class="slope-right" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'slope-left') {
				$output .= '<svg class="slope-left" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L100 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'arrow') {
				$output .= '<svg class="arrow" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'circle') {
				$output .= '<svg class="circle" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<circle cx="50" cy="50" r="50" stroke-width="0" '. $fillColor .'></circle></svg>';
			}
			if ($decobot == 'repeat-triangle') {
				$output .= '<svg class="repeat-triangle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L2 60 L4 100 L6 60 L8 100 L10 60 L12 100 L14 60 L16 100 L18 60 L20 100 L22 60 L24 100 L26 60 L28 100 L30 60 L32 100 L34 60 L36 100 L38 60 L40 100 L42 60 L44 100 L46 60 L48 100 L50 60 L52 100 L54 60 L56 100 L58 60 L60 100 L62 60 L64 100 L66 60 L68 100 L70 60 L72 100 L74 60 L76 100 L78 60 L80 100 L82 60 L84 100 L86 60 L88 100 L90 60 L92 100 L94 60 L96 100 L98 60 L100 100 Z" stroke-width="0" '. $fillColor .'></path>';
				$output .= '</svg>';
				$output .= '<svg class="repeat-triangle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L5 60 L10 100 L5 60 L10 100 L15 60 L20 100 L25 60 L30 100 L35 60 L40 100 L45 60 L50 100 L55 60 L60 100 L65 60 L70 100 L75 60 L80 100 L85 60 L90 100 L95 60 L100 100" '. $fillColor .'></path>';
				$output .= '</svg>';
			}
			if ($decobot == 'repeat-circle') {
				$output .= '<svg class="repeat-circle-big" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 Q 2.5 40 5 100 Q 7.5 40 10 100 Q 12.5 40 15 100 Q 17.5 40 20 100 Q 22.5 40 25 100 Q 27.5 40 30 100 Q 32.5 40 35 100 Q 37.5 40 40 100 Q 42.5 40 45 100 Q 47.5 40 50 100 Q 52.5 40 55 100 Q 57.5 40 60 100 Q 62.5 40 65 100 Q 67.5 40 70 100 Q 72.5 40 75 100 Q 77.5 40 80 100 Q 82.5 40 85 100 Q 87.5 40 90 100 Q 92.5 40 95 100 Q 97.5 40 100 100 " stroke-width="0" '. $fillColor .'></path>';
				$output .= '</svg>';
				$output .= '<svg class="repeat-circle-small" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 Q 5 40 10 100  Q 15 40 20 100  Q 25 40 30 100  Q 35 40 40 100  Q 45 40 50 100  Q 55 40 60 100  Q 65 40 70 100  Q 75 40 80 100  Q 85 40 90 100  Q 95 40 100 100 " '. $fillColor .'></path>';
				$output .= '</svg>';
			}
			if ($decobot == 'clouds') {
				$output .= '<svg class="clouds" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M-5 100 Q 0 20 5 100 Z M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100 M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100 M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100 M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100 M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'rounded-outer') {
				$output .= '<svg class="rounded-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 C50 0 50 0 100 100 Z" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'rounded-inner') {
				$output .= '<svg class="rounded-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 C50 100 50 100 100 0  L100 100 0 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'triangle-outer') {
				$output .= '<svg class="triangle-outer" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 100 L50 0 L100 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			if ($decobot == 'triangle-inner') {
				$output .= '<svg class="triangle-inner" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
				$output .= '<path d="M0 0 L50 100 L100 0 L100 100 L0 100" stroke-width="0" '. $fillColor .'></path></svg>';
			}
			$output .= '</div>';
		}
		$output .= '</section>';
		
		return $output;
	}
	add_shortcode('themeone_section', 'themeone_section');
}

/*-----------------------------------------------------------------------------------*/
/*	Image Section
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_img_section')) {
	function themeone_img_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'para' => '',
			'img' => '',
			'bgrepeat' => '',
			'blur' => '',
			'bgcolor' => '',
			'opacity' => '',
			'pattern' => '',
			'paddingtop' => '',
			'paddingbot' => '',
			'type' => '',
			'txtcolor' => ''
	    ), $atts));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		$paraStyle = 'style="padding-top:'. esc_attr($paddingtop) .'px;padding-bottom:'. esc_attr($paddingbot) .'px;"';
		if ($blur == 'true') {
			$blur = ' blur';
		} else {
			$blur = '';
		}
		if ($para == 'true') {
			$para = 'paratrue';
		}
		if ($bgcolor != '') {
			$bgcolor = 'background-color:'. $bgcolor .';';
		}
		if ($pattern != '') {
			$pattern = 'background-image : url('. esc_url($pattern)  .');';
		}
		if ($opacity != '') {
			$opacity = 'opacity :'. esc_attr($opacity)  .';filter: Alpha(Opacity='. esc_attr($opacity) *100  .');';
		}
		$style = 'style="'. $pattern .'"';
		$style2 = 'style="'. $bgcolor . $opacity .'"';
		$output  = '<div class="parallax-container '. esc_attr($para) .' '. esc_attr($txtcolor) .'" '. $paraStyle .'>';
		$output .= '<div class="parallax-container-inner '. esc_attr($bgrepeat) . esc_attr($blur) .'" style="background-image:url('. esc_url($img) .');" ></div>';
		$output .= '<div class="parallax-container-overlay" '. $style  .'></div>';
		$output .= '<div class="parallax-container-overlay-color" '. $style2  .'></div>';
		if ($type == 'boxed') {
			$output .= '<section><div class="section-container">' . do_shortcode($content) . '</div></section>';
		} else {
			$output .= do_shortcode($content);
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_img_section', 'themeone_img_section');
}

/*-----------------------------------------------------------------------------------*/
/*	Image Side Section
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_side_section')) {
	function themeone_side_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'img' => '',
			'position' => '',
			'bgcolor' => '',
			'bgrepeat' => '',
			'txtcolor' => '',
			'paddingtop' => '',
			'paddingbot' => '',
	    ), $atts));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		if ($bgcolor == '') {
			$bgcolor = '#ffffff';
		}
		$bgcolor = 'style="background-color:'. $bgcolor .';"';
		if ($img != '') {
			$img = 'style="background-image : url('. esc_url($img)  .');"';
		}
		$padding = 'style="padding-top:'. esc_attr($paddingtop) .'px;padding-bottom:'. esc_attr($paddingbot) .'px;"';
		$output  = '<section class="side-section '. esc_attr($position) .'" '. $bgcolor .'>';
		$output .= '<div class="side-section-image '. esc_attr($bgrepeat) .'" '. $img .'></div>';
		$output .= '<div class="section-container '. esc_attr($txtcolor) .'" '. $padding .'>';
		$output .= '<div class="col col-6 side-col">' . do_shortcode($content) . '</div>';
		$output .= '</div>';
		$output .= '</section>';
		return $output;
	}
	add_shortcode('themeone_side_section', 'themeone_side_section');
}

/*-----------------------------------------------------------------------------------*/
/*	Video Section
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_video_section')) {
	function themeone_video_section( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => '',
			'para' => '',
			'mp4' => '',
			'ogg' => '',
			'webm' => '',
			'youtube' => '',
			'vimeo' => '',
			'poster' => '',
			'paddingtop' => '',
			'paddingbot' => '',
			'bgcolor' => '',
			'opacity' => '',
			'pattern' => '',
			'txtcolor' => ''
	    ), $atts));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		if ($para == 'true') {
			$para = 'paratrue';
		}
		$paraStyle = 'style="padding-top:'.esc_attr($paddingtop).'px;padding-bottom:'.esc_attr($paddingbot).'px;"';
		if ($bgcolor != '') {
			$bgcolor = 'background-color:'. esc_attr($bgcolor) .';';
		}
		if ($pattern != '') {
			$pattern = 'background-image : url('. esc_url($pattern)  .');';
		}
		if ($opacity != '') {
			$opacity = 'opacity :'. esc_attr($opacity)  .';filter: Alpha(Opacity='. esc_attr($opacity) *100  .');';
		}
		if ($poster != '') {
			$poster = 'style="background-image : url('. esc_url($poster)  .');"';
		}
		$style = 'style="'. $bgcolor . $pattern . $opacity .'"';
		$output  = '<div class="parallax-container '. esc_attr($para) .' '. esc_attr($txtcolor) .'" '.$paraStyle.'>';
		$output .= '<div class="parallax-container-inner parallax-video">';
		$output .= '<div class="parallax-container-poster" '. $poster  .'></div>';
		if ($youtube != '') {
			$output .= '<div class="to-para-youtube" data-youtube-url="'. esc_attr($youtube) .'"></div>';
		} else if ($vimeo != '') {
			$vimeo = esc_attr(parse_vimeourl($vimeo));
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo.php"));
			$width = esc_attr($hash[0]['width']); 
			$height = esc_attr($hash[0]['height']);
			$output .= '<iframe data-height="'. $height .'" data-width="'. $width .'" style="width:'. $width .'px;height:'. $height .'px;" class="vimeo-player-section" src="//player.vimeo.com/video/'. $vimeo .'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;autoplay=1&amp;loop=1"></iframe>';
		} else if ($mp4 != '' || $ogg != '' || $webm != ''){
			$output .= '<video controls  preload="auto">';
			if ($mp4 != '') {
				$output .= '<source type="video/mp4" src="'. esc_url($mp4) .'" />';
			}
			if ($webm != '') {
				$output .= '<source type="video/webm" src="'. esc_url($webm) .'" />';
			}
			if ($ogg != '') {
				$output .= '<source type="video/ogg" src="'. esc_url($ogg) .'" />';
			}
			$output .= '</video>';
		}			
		$output .= '</div>';
		$output .= '<div class="parallax-container-overlay" '. $style  .'></div>';
		if ($type == 'boxed') {
			$output .= '<section><div class="section-container">' . do_shortcode($content) . '</div></section>';
		} else {
			$output .= do_shortcode($content);
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_video_section', 'themeone_video_section');
}

/*-----------------------------------------------------------------------------------*/
/*	Spacer
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_spacer')) {
	function themeone_spacer( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'height' => '100',
			'class' => ''
	    ), $atts));
		return '<div class="to-spacer '. esc_attr($class) . '" style="height:'. esc_attr($height) .'"></div>';
	}
	add_shortcode('themeone_spacer', 'themeone_spacer');
}

/*-----------------------------------------------------------------------------------*/
/*	Divider
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_divider')) {
	function themeone_divider( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style' => 'solid',
			'position' => 'center',
			'width' => '50%',
			'height' => '1px',
			'color' => '#f5f6fa'
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		if ($position != 'center') {
			$position = 'float:'. esc_attr($position);
		} else {
			$position = '';
		}
		return '<div class="to-divider-holder"><div class="to-divider" style="width:'. esc_attr($width) .';border-top:'. esc_attr($height) .' '. esc_attr($style) .' '. esc_attr($color) .';'. $position .'"></div></div>';
	}
	add_shortcode('themeone_divider', 'themeone_divider');
}

/*-----------------------------------------------------------------------------------*/
/*	Quote
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_quote')) {
	function themeone_quote( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style' => '',
			'color' => ''
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		if ($color != '') {
			$color = 'style="color:'. $color .'"';
		}
		return '<div class="to-quote" '. $color .'>'.do_shortcode($content).'</div>';
	}
	add_shortcode('themeone_quote', 'themeone_quote');
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Font
/*-----------------------------------------------------------------------------------*/


if (!function_exists('themeone_custom_font')) {
	function themeone_custom_font( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'family' => '',
			'decoration' => '',
			'style' => '',
			'txtalign' => '',
			'size' => '',
			'line' => '',
			'padding' => '',
			'bold' => '',
			'uppercase' => '',
			'color' => ''
	    ), $atts));
		$color = esc_attr(to_accent_color($color));

		if (!empty($family)) {
			$font         = explode(';',$family);
			$font_family  = ' font-family:'. $font[0] .';';
			if (isset($font[1])) {
				$font_style   = ' font-style:'. preg_replace("/[^a-zA-Z]+/", "", $font[1]) .';';
				$font_weight  = ' font-weight:'. preg_replace("/[^0-9]+/", "", $font[1]) .';';
				$font_attr    = ' data-font="'. esc_attr($font[0]) .':'. esc_attr($font[1]) .'"';
			} else {
				$font_style   = null;
				$font_weight  = null;
				$font_attr    = ' data-font="'. esc_attr($font[0]) .'"';
			}
		} else {
			$font_family = null;
			$font_style  = null;
			$font_weight = null;
			$font_attr   = null;		
		}
		
		if ($decoration != '') {
			$decoration = 'text-decoration: '. esc_attr($decoration) .'; ';
		}
		$style = 'font-style: '. esc_attr($style) .'; ';
		if ($txtalign != '') {
			$txtalign = 'class="'. esc_attr($txtalign) .'"';
		}
		$size = 'font-size: '. esc_attr($size) .'; ';
		if ($line != '0px') {
			$line = 'line-height: '. esc_attr($line) .'; ';
		} else {
			$line = '';
		}
		if ($padding != '0px') {
			$padding = 'padding: '. esc_attr($padding) .'; ';
		} else {
			$padding = '';
		}
		if ($bold == true) {
			$bold = 'font-weight: bold; ';
		}
		if ($uppercase == true) {
			$uppercase = 'text-transform: uppercase; ';
		}
		if ($color != '') {
			$color = 'color: '. $color .';';
		}
		$inStyle = 'style="'. $decoration . $style . $size . $line . $padding . $bold . $uppercase . $color . $font_family . $font_style . $font_weight .'"';
		
		return '<span '. $txtalign .' '. $inStyle . $font_attr .'>'. do_shortcode($content) .'</span>';
	}
	add_shortcode('themeone_custom_font', 'themeone_custom_font');
}

/*-----------------------------------------------------------------------------------*/
/*	HighLight Font
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_highlight')) {
	function themeone_highlight( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtcolor' => '',
			'bgcolor' => ''
	    ), $atts));
		$txtcolor = esc_attr(to_accent_color($txtcolor));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		$inStyle = 'style="color:'. $txtcolor .'; background:'. $bgcolor .'; padding: 3px;"';
		return '<span '. $inStyle .'>'.do_shortcode($content).'</span>';
	}
	add_shortcode('themeone_highlight', 'themeone_highlight');
}

/*-----------------------------------------------------------------------------------*/
/*	Header
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_header')) {
	function themeone_header( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => 'h1',
			'txtalign' => 'txt-left',
			'txtcolor' => '',
			'decor' => '',
			'decorcolor' => '',
			'decorheight' => '',
			'subtitle' => '',
	    ), $atts));
		
		$txtcolor = esc_attr(to_accent_color($txtcolor));
		
		$decor_color_before = '';
		$decor_color_after  = '';
		$color = '';
		
		if($txtcolor != '')  { 
			$color = 'style="color:'.$txtcolor.'"';
		}
		
		if($subtitle)  {
			$subtitle = '<span class="subtitle '.esc_attr($txtalign).' '.esc_attr($type).'" '.$color.'>'.$subtitle.'</span>';
		}
		
		if ($decor) {
			$decor_colorIE = esc_attr(to_accent_color($decorcolor));  
			if (strlen($decor_colorIE) == 4) {
				$decor_colorIE = '#'.$decor_colorIE[1].$decor_colorIE[1].$decor_colorIE[2].$decor_colorIE[2].$decor_colorIE[3].$decor_colorIE[3];
			}
			$decor_color   = to_hex2rgb(esc_attr(to_accent_color($decorcolor)));
			$decor_margin  = -esc_attr($decorheight)/2;
			$decor_height  = esc_attr($decorheight);
			$decor         = 'class="header-wrapper-inner"';
			if ($txtalign == 'txt-right' || $txtalign == 'txt-center') {
				$decor_color_before  = '<span class="decor-before-holder">';
				$decor_color_before .= '<span class="decor-before" style="';
				$decor_color_before .= 'background: -moz-linear-gradient(right, rgba('. $decor_color .',0.65) 0%, rgba('. $decor_color .',0) 100%);';
				$decor_color_before .= 'background: -webkit-gradient(linear, right top, left top, color-stop(0%,rgba('. $decor_color .',0.65)), color-stop(100%,rgba('. $decor_color .',0)));';
				$decor_color_before .= 'background: -webkit-linear-gradient(right, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_before .= 'background: -o-linear-gradient(right, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_before .= 'background: -ms-linear-gradient(right, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_before .= 'background: linear-gradient(to left, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_before .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#00'.ltrim ($decor_colorIE, '#').'\', endColorstr=\''.$decor_colorIE.'\',GradientType=1)';
				$decor_color_before .= 'margin-top:'. $decor_margin .'px;';
				$decor_color_before .= 'border-radius:'. $decor_height .';';
				$decor_color_before .= 'height:'. $decor_height .';';
				$decor_color_before .= '"></span></span>';
			}
			if ($txtalign == 'txt-left' || $txtalign == 'txt-center') {
				$decor_color_after   = '<span class="decor-after-holder">';
				$decor_color_after  .= '<span class="decor-after" style="';
				$decor_color_after  .= 'background: -moz-linear-gradient(left, rgba('. $decor_color .',0.65) 0%, rgba('. $decor_color .',0) 100%);';
				$decor_color_after  .= 'background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba('. $decor_color .',0.65)), color-stop(100%,rgba(0,0,0,0)));';
				$decor_color_after  .= 'background: -webkit-linear-gradient(left, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_after  .= 'background: -o-linear-gradient(left, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_after  .= 'background: -ms-linear-gradient(left, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_after  .= 'background: linear-gradient(to right, rgba('. $decor_color .',0.65) 0%,rgba('. $decor_color .',0) 100%);';
				$decor_color_after  .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$decor_colorIE.'\', endColorstr=\'#00'.ltrim ($decor_colorIE, '#').'\',GradientType=1)';
				$decor_color_after  .= 'margin-top:'. $decor_margin .'px;';
				$decor_color_after  .= 'border-radius:'. $decor_height .';';
				$decor_color_after  .= 'height:'. $decor_height .';';
				$decor_color_after  .= '"></span></span>';
			}
			$output  = '<div class="header-wrapper '. $txtalign .'">'.$decor_color_before;
			$output .= '<'.$type.' '. $decor .' '.$color.'>'.  do_shortcode($content) .'</'.$type.'>';
			$output .= $decor_color_after.'</div>';
		} else {
			$decor_color_before = null;
			$decor_color_after  = null;
			$output = '<'.$type.' class="'. $txtalign .'" '.$color.'>'. do_shortcode($content) .'</'.$type.'>';
		}
		
		$output .= $subtitle;
		
		return preg_replace('~</?p[^>]*>~', '', $output);
	}
	add_shortcode('themeone_header', 'themeone_header');
}

function to_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = $r.','.$g.','.$b;
   return $rgb;
}

/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_button')) {
	function themeone_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'text' => 'Button',
			'url' => '#',
			'size' => 'regular',
			'type' => 'standard',
			'border' => 'full-rounded',
			'style' => 'to-button-bg',
			'bgcolor' => 'accent-color1',
			'bganim' => '',
			'txtcolor' => '#ffffff',
			'target' => '_self',
			'iconanim' => '',
			'icon'  => ''
	    ), $atts));
		$class = null;
		$txtcolor = esc_attr(to_accent_color($txtcolor));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		
		if ($style == 'to-button-border') {
			$color = $txtcolor;
		} else {
			$color = $bgcolor;
		}
		
		if (!empty($bganim) && !empty($color)) {
			$bganim = 'to-button-anim';
		}
		
		if (!empty($iconanim) && !empty($icon)) {
			$iconanim = 'to-icon-anim';
		} else {
			$iconanim =  null;
		}
		
		if (!empty($txtcolor)) {
			$inline = 'style="color:'. $txtcolor .';background:'. $bgcolor .';border-color:'. $color .'"';
		} else {
			$inline = null;
		}
		if ($target == '_blank') {
			$class = '.no-ajaxy';
		}
		$output  = '<a target="'.esc_attr($target).'" class="to-button '.esc_attr($size).' '.esc_attr($type).' '. esc_attr($border) .' '. esc_attr($style) .' '. $iconanim .' '. $bganim .' '. $class .'" data-bgcolor="'. $txtcolor .'" data-color="'. $color .'" ' . $inline .' href="'.esc_attr($url).'">';
		$output .= '<span style="color:'. $txtcolor .';">'. $text .'</span>';
		if (!empty($icon)) {
			$output .= '<i class="to-button-icon fa '. esc_attr($icon) .'"></i>';
		}
		$output .= '</a>';
		
		return $output;
	}
	add_shortcode('themeone_button', 'themeone_button');
}

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/


//one half columns 
if (!function_exists('themeone_one_half')) {
	function themeone_one_half( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-6 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_one_half', 'themeone_one_half');
}
if (!function_exists('cthemeone_one_half')) {
	function cthemeone_one_half( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-6 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('cthemeone_one_half', 'cthemeone_one_half');
}
//one third columns
if (!function_exists('themeone_one_third')) {
	function themeone_one_third( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-4 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_one_third', 'themeone_one_third');
}
//two third columns
if (!function_exists('themeone_two_thirds')) {
	function themeone_two_thirds( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-8 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_two_thirds', 'themeone_two_thirds');
}
//one fourth columns
if (!function_exists('themeone_one_fourth')) {
	function themeone_one_fourth( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-3 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_one_fourth', 'themeone_one_fourth');
}
//three fourths columns
if (!function_exists('themeone_three_fourths')) {
	function themeone_three_fourths( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-9 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_three_fourths', 'themeone_three_fourths');
}
//one sixth columns
if (!function_exists('themeone_one_sixth')) {
	function themeone_one_sixth( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-2 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_one_sixth', 'themeone_one_sixth');
}
//five sixths columns
if (!function_exists('themeone_five_sixths')) {
	function themeone_five_sixths( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		if($last_column == true && $padding == 'col-padding')  { 
			$last_column = ' col-last ';
			$clear_column = '<div class="clear-padding"></div>';
		} else if ($last_column == true) {
			$last_column = ' col-last ';
			$clear_column = '<div class="clear"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-10 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) . '</div>' . $clear_column;
	}
	add_shortcode('themeone_five_sixths', 'themeone_five_sixths');
}
//one whole columns
if (!function_exists('themeone_one_whole')) {
	function themeone_one_whole( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => '',
			'color' => '',
			'boxed' => '',
			'padding' => '',
			'last_column' => '',
			'anim' => '',
			'delay' => ''
		), $atts));
		$animClass = '';
		$clear_column = '';
		$color = esc_attr(to_accent_color($color));
		if($color != null)  { 
			$color = 'style="background: '. $color .'"';
		}
		if($boxed == true)  { 
			$boxed = ' boxed ';
		}
		if($padding == true)  { 
			$padding = 'col-padding';
		}
		$last_column = ' col-last ';
		$clear_column = '<div class="clear"></div>';
		if($padding == 'col-padding')  { 
			$clear_column = '<div class="clear-padding"></div>';
		}
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', $delay);
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. esc_attr($delay) .'"';
			$animClass = ' has-anim ';
		}
		return '<div class="col col-12 ' . $animClass . $last_column . $boxed . esc_attr($txtalign) .' '. $padding .'" '. $anim .' '. $color .'>'. do_shortcode($content) .'</div>' . $clear_column;
	}
	add_shortcode('themeone_one_whole', 'themeone_one_whole');
}

/*-----------------------------------------------------------------------------------*/
/*	Icons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_icon')) {
	function themeone_icon( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'size' => 'fa-3x',
			'inline' => '',
			'spinning' => '',
			'anim' => '',
			'bgcolor' => '',
			'bganim' => '',
			'iconbg' => '',
			'color' => '',
			'icon' => 'general-origami'
	    ), $atts));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		$color = esc_attr(to_accent_color($color));
		$over_bg = null;
		$data_color = null;
		$data_bg = null;
		if($inline != '')  {
			$inline = ' pull-left ';
			$iconbg = null;
			$bgcolor = null;
		}
		if ($spinning != '') {
			$spinning = ' fa-spin ';
		}
		if ($anim != '') {
			$anim = 'data-anim-icon="'. esc_attr($anim) .'"';
		}
		if($color != '')  { 
			$data_color = 'data-color="'. $color .'"';
			$color = 'style="color:'. $color .';"';
		}
		if($bgcolor != '')  {
			$data_bg = 'data-bg="'. $bgcolor .'"';
			$bgcolor = 'style="background:'. $bgcolor .';"';
		}
		if ($iconbg == 'true' && $bgcolor == '') {
			$iconbg = 'full-bg';
		} else if ($iconbg == 'true' && $bgcolor != '') {
			$iconbg = 'full-bg color';
		} else {
			$iconbg = null;
		}
		if($bganim != '')  {
			$bganim = 'bg-anim';
		}
		$output = '<i class="to-icon '. esc_attr($icon) .' '. esc_attr($size) .' '. $spinning .' '. $iconbg .' '. $bganim .' '. $inline .'" '. $anim .' '. $color .' '. $data_bg .' '. $data_color .'><i class="to-icon-overlay"  '. $bgcolor .'></i></i>';
		
		return $output;
	}
	add_shortcode('themeone_icon', 'themeone_icon');
}

/*-----------------------------------------------------------------------------------*/
/*	Icon & text
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_icon_txt')) {
	function themeone_icon_txt( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Your title',
			'size' => 'fa-4x',
			'position' => 'top',
			'spinning' => '',
			'anim' => '',
			'bgcolor' => '',
			'bganim' => '',
			'iconbg' => '',
			'color' => '',
			'icon' => 'general-origami'
	    ), $atts));
		
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		$color = esc_attr(to_accent_color($color));
		$over_bg = null;
		$data_color = null;
		$data_bg = null;
		
		if ($spinning != '') {
			$spinning = ' fa-spin ';
		}
		if ($anim != '') {
			$anim = 'data-anim-icon="'. esc_attr($anim) .'"';
		}
		if($color != '')  { 
			$data_color = 'data-color="'. $color .'"';
			$color = 'style="color:'. $color .';"';
		}
		if($bgcolor != '')  {
			$data_bg = 'data-bg="'. $bgcolor .'"';
			$bgcolor = 'style="background:'. $bgcolor .';"';
		}
		if ($iconbg == 'true' && $bgcolor == '') {
			$iconbg = 'full-bg';
			$icontxtbg = 'icon-txt-bg';
		} else if ($iconbg == 'true' && $bgcolor != '') {
			$iconbg = 'full-bg color';
			$icontxtbg = 'icon-txt-bg';
		} else {
			$iconbg = null;
			$icontxtbg = null;
		}
		if($bganim != '')  {
			$bganim = 'bg-anim';
		}
		
		if ($position != 'top') {
			$output  = '<div  class="to-icon-box  '. esc_attr($position) .' txt-'. esc_attr($position) .'">';
			$output .= '<i class="to-icon '. esc_attr($icon) .' '. esc_attr($size) .' '. $spinning .' '. $iconbg .' '. $bganim .'" '. $anim .' '. $color .' '. $data_bg .' '. $data_color .'><i class="to-icon-overlay"  '. $bgcolor .'></i></i>';
			$output .= '<div class="to-icon-txt '. esc_attr($size) .'-txt '. $icontxtbg .'">';
			$output .= '<h3>'. preg_replace('~</?p[^>]*>~', '', $title) .'</h3>';
			$output .= '<p>'. preg_replace('~</?p[^>]*>~', '', $content) .'</p>';
			$output .= '</div>';
			$output .= '</div>';
		} else {
			$output  = '<i class="to-icon '. esc_attr($icon) .' '. esc_attr($size) .' '. $spinning .' '. $iconbg .' '. $bganim .'" '. $anim .' '. $color .' '. $data_bg .' '. $data_color .'><i class="to-icon-overlay"  '. $bgcolor .'></i></i>';
			$output .= '<h3>'. preg_replace('~</?p[^>]*>~', '', $title) .'</h3>';
			$output .= '<p>'. preg_replace('~</?p[^>]*>~', '', $content) .'</p>';
		}
		
		return $output;
	}
	add_shortcode('themeone_icon_txt', 'themeone_icon_txt');
}

/*-----------------------------------------------------------------------------------*/
/*	Box text/icon anim
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_box_anim')) {
	function themeone_box_anim( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Your title',
			'color' => '',
			'icon' => 'general-origami',
	    ), $atts));		
		$color = esc_attr(to_accent_color($color));
		if($color != '')  { 
			$data_color = 'data-color="'. $color .'"';
			$color = 'style="color:'. $color .';"';
		}
		$output  = '<div class="to-anim-box">';
		$output .= '<div class="to-anim-box-inner">';      
		$output .= '<div class="to-anim-box-icon">';
		$output .= '<div class="to-anim-box-icon-inner">';
		$output .= '<i class="to-icon fa-5x '. esc_attr($icon) .'" '. $color .'></i>';
		$output .= '<h3>'. $title .'</h3>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="to-anim-box-desc"> ';
		$output .= '<h3 '. $color .'>'. $title .'</h3>';
		$output .= '<p>'. do_shortcode(preg_replace('~</?p[^>]*>~', '', $content)) .'</p>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_box_anim', 'themeone_box_anim');
}

/*-----------------------------------------------------------------------------------*/
/*	Social Icon
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_social_icon')) {
	function themeone_social_icon( $atts, $content = null ) {	
		extract(shortcode_atts(array(
			'type' => 'facebook',
			'url' => ''
	    ), $atts));	
		$output = null;
		if ($type != '' && $url != '') {
        	$output = '<span class="to-social-icon"><a target="_blank" href="'. esc_url($url) .'"><i class="fa fa-'. esc_attr($type) .'"></i></a></span>';
		}
		return $output;
	}
	add_shortcode('themeone_social_icon', 'themeone_social_icon');
}

/*-----------------------------------------------------------------------------------*/
/*	List
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_ul')) {
	function themeone_ul( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txtalign' => 'txt-left',
			'boxed' => '',
			'txtcolor' => ''
		), $atts));
		$txtcolor = esc_attr(to_accent_color($txtcolor));
		if ($txtcolor) {
			$txtcolor = 'style="color:'. $txtcolor .'"';
		}
		return '<ul class="to-list-holder '.esc_attr($txtalign).' '.esc_attr($boxed).'" '. $txtcolor .'>'. do_shortcode($content) . '</ul>';
	}
	add_shortcode('themeone_ul', 'themeone_ul');
}

if (!function_exists('themeone_li')) {
	function themeone_li( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'licolor' => '',
			'anim' => '',
			'bullet' => '',
			'icon' => ''
		), $atts));
		$licolor = esc_attr(to_accent_color($licolor));
		if ( $bullet != '') {
			$icon = '';
		}
		if ($anim != '') {
			$anim = 'data-anim-icon="'. esc_attr($anim) .'"';
		}
		
		if ($icon != '' || $bullet != '') {
			$output  = '<li class="to-list with-icon" >';
			$output .= '<i class="to-icon '. esc_attr($icon) .' pull-left" '. $anim .' style="color:'. $licolor .'">' . $bullet . '</i>';
		} else {
			$output  = '<li class="to-list" >';
		}
		$output .= '<span>'. do_shortcode(preg_replace('~</?p[^>]*>~', '', $content)) .'</span>';
		$output .= '</li>';
		return $output;
	}
	add_shortcode('themeone_li', 'themeone_li');
}

/*-----------------------------------------------------------------------------------*/
/*	Princing Container
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_pricing')) {
	function themeone_pricing( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'tablenb' => '',
		), $atts));
		if ($tablenb == '1') {
			$tablenb = '';
		}
		if ($tablenb == '2') {
			$tablenb = 'two-cols';
		}
		if ($tablenb == '3') {
			$tablenb = 'three-cols';
		}
		if ($tablenb == '4') {
			$tablenb = 'four-cols';
		}
		if ($tablenb == '5') {
			$tablenb = 'five-cols';
		}
		$GLOBALS['tablenbG'] = esc_attr($tablenb);
		return '<div class="to-pricing-holder clearfix">'. do_shortcode($content) . '</div>';
	}
	add_shortcode('themeone_pricing', 'themeone_pricing');
}

/*-----------------------------------------------------------------------------------*/
/*	Princing Table
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_ptable')) {
	function themeone_ptable( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'featured' => '',
			'title' => 'Your Title',
			'price' => '30',
			'value' => '$',
			'per' => '/mo',
			'link' => 'http://theme-one.com/mobius/',
			'target' => '_self',
			'button' => ''
		), $atts));
		
		$header       = null;
		$accent_color = null;
		$button_color = null;
		$button_anim  = null;
		
		if ($featured == 'true') {
			$featured = ' featured';
			$accent_color = 'accentColor';
			$button_color = esc_attr(to_accent_color('accent-color1'));
			$button_anim  = 'to-button-anim';
		}
		
		if ($button == '') {
			$button = 'Purchase';
		}
		
		if (!isset($GLOBALS['tablenbG'])) {
			$GLOBALS['tablenbG'] = '';
		}
		
		$output  = '<div class="to-ptable col '. $GLOBALS['tablenbG'] . esc_attr($featured) .'">';
		$output .= '<div class="to-ptable-header">';
		$output .= '<sup class="to-ptable-value '. $accent_color .'">'. $value .'</sup>';
		$output .= '<span class="to-ptable-cost '. $accent_color .'">'. $price .'</span>';
		$output .= '<sub class="to-ptable-per '. $accent_color .'">'. $per .'</sub>';
		$output .= '<h5 class="'. $accent_color .'">'. $title .'</h5>';
		$output .= '</div>';
		$output .= '<div class="to-ptable-content">';
		$output .= '<ul>';
		$output .= do_shortcode($content);
		$output .= '</ul>';
		$output .= '</div>';
		if ($link != '') {
			$output .= '<div class="to-ptable-button">';
			$output .= '<a href="'. esc_attr($link) .'" class="to-button small full-rounded to-button-border '. $button_anim .' '. $button_color .'" target="'. esc_attr($target) .'" rel="nofollow" style="color:'. $button_color .'" data-bgcolor="'. $button_color .'" data-color="'. $button_color .'">';
			$output .= '<span class="to-button-inner">'. $button .'</span>';
			$output .= '</a>';
			$output .= '</div>';
		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_ptable', 'themeone_ptable');
}

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_tabs')) {
	function themeone_tabs( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'full' => '',
			'alignment' => 'txt-left'
		), $atts));
		if ($full) {
			$full = 'full-width';
		}
		$GLOBALS['tabContent'] = '';
		$output  = '<div class="to-tabs-holder tab '. $full .' '. esc_attr($alignment) .'">';
		$output .= '<ul class="to-tabs">';
		$output .= '<li class="to-tabs-overlay"></li>';
		$output .= '<li class="to-tabs-line accentBg"></li>';
		$output .= do_shortcode($content);
		$output .= '</ul>';
		$output .= '<div class="to-tabs-content clearfix">';
		$output .= $GLOBALS['tabContent'];
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_tabs', 'themeone_tabs');
}

/*-----------------------------------------------------------------------------------*/
/*	Tab
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_tab')) {
	function themeone_tab( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'active' => '',
			'title' => ''
		), $atts));
		if ($active == 'true') {
			$active = 'active-tab';
		}
		$output = '<li class="'. $active .'"><span>'. $title .'</span></li>';	
		$GLOBALS['tabContent'] .= '<div class="to-tab '. $active .'">'. do_shortcode($content) .'</div>';
		return $output;
	}
	add_shortcode('themeone_tab', 'themeone_tab');
}

/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_toggle')) {
	function themeone_toggle( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'active' => '',
			'title' => 'Your toggle title'
		), $atts));
		if ($active == 'true') {
			$active = 'style="display: block;"';
			$toggleOpen = '<i class="fa fa-minus accentColorHover"></i>';
		} else {
			$toggleOpen = '<i class="icon-to-plus accentColorHover"></i>';
		}
		$output  = '<div class="to-toggle-holder clearfix">';
    	$output .= '<h5 class="to-toggle-title"><span class="to-toggle-open">'. $toggleOpen .'</span>'. $title .'</h5>';
        $output .= '<div class="to-toggle-content" '. $active .'>';
        $output .= do_shortcode($content);
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode('themeone_toggle', 'themeone_toggle');
}

/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_accordion')) {
	function themeone_accordion( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'active' => '',
			'title' => 'Your accordion title',
			'icon' => '',
			'color' => ''
		), $atts));
		$color = esc_attr(to_accent_color($color));
		if ($active == 'true') {
			$active = 'style="display: block;"';
			$accordionOpen = '<i class="fa fa-minus accentColorHover"></i>';
		} else {
			$accordionOpen = '<i class="icon-to-plus accentColorHover"></i>';
		}
		if ($icon != '') {
			if ($color != '') {
				$color = 'style="color:'. $color .'"';
			}
			$icon = '<i class="'. esc_attr($icon) .' to-accordion-icon" '. $color .'></i>';
		}
		$output  = '<div class="to-accordion-holder clearfix">';
    	$output .= '<h5 class="to-accordion-title">'. $icon . $title .'<span class="to-accordion-open">'. $accordionOpen .'</span></h5>';
        $output .= '<div class="to-accordion-content" '. $active .'>';
        $output .= do_shortcode($content);
		$output .= '</div></div>';
		return $output;
	}
	add_shortcode('themeone_accordion', 'themeone_accordion');
}

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_progress_bar')) {
	function themeone_progress_bar( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'percent' => '80',
			'height' => '10',
			'title' => 'Your skill',
			'color' => 'accent-color1'
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		if ($color != '') {
			$color = ';background-color:'. $color;
		}
		$percent = preg_replace('/[^\d-]+/', '', esc_attr($percent));
		$output  = '<div class="to-progress-bar-container">';
        $output .= '<div class="to-progress-bar-holder">';
		$output .= '<span class="to-progress-bar" data-width="'. $percent .'" style="height:'. esc_attr($height) . $color .'"></span>';
		$output .= '</div>';
		$output .= '<span class="to-progress-bar-title">'. $title .'<strong>'. $percent .'%</strong></span>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_progress_bar', 'themeone_progress_bar');
}

/*-----------------------------------------------------------------------------------*/
/*	Progress Pie
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_pie_chart')) {
	function themeone_pie_chart( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'anim' => '',
			'percent' => '80%',
			'size' => '200px',
			'width' => '5px',
			'barcolor' => 'accent-color1',
			'bgcolor' => '#F5F6fA',
			'icon' => '',
			'icolor' => ''
	    ), $atts));
		$animClass = '';
		$barcolor = esc_attr(to_accent_color($barcolor));
		$bgcolor = esc_attr(to_accent_color($bgcolor));
		$icolor = esc_attr(to_accent_color($icolor));
		$percent = preg_replace('/[^\d-]+/', '', esc_attr($percent));
		$width = preg_replace('/[^\d-]+/', '', esc_attr($width));
		$icon;
		if ($icon != '') {
			$legend = 'icon';
			if ($icolor != '') {
				$icolor = 'style="color:'. $icolor .'"';
			}
			$icon = '<i class="'. esc_attr($icon) .'" '. $icolor .'></i>';
		} else {
			$legend = 'percent';
		}
		if ($anim == true) {
			$anim = 'data-anim="'. esc_attr($percent) .'"';
			$animClass = ' to-pie-chart-anim';
			$percent = 0;
		}
		$output  = '<div class="to-pie-chart-holder" style="width:'. esc_attr($size) .'; height:'. esc_attr($size) .';line-height:'. esc_attr($size) .'">';
    	$output .= '<div class="to-pie-chart'. $animClass .'" '. $anim .' data-percent="'. $percent .'" data-legend-style="'. esc_attr($legend) .'" data-line-width="'. $width .'" data-bar-color="'. $barcolor .'" data-background-color="'. $bgcolor .'" data-width="'. esc_attr($size) .'">';
		if ($icon == '') {
    		$output .= '<span></span>';
		}
		$output .= $icon;
    	$output .= '</div></div>';
		return $output;
	}
	add_shortcode('themeone_pie_chart', 'themeone_pie_chart');
}

/*-----------------------------------------------------------------------------------*/
/*	Counter
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_counter')) {
	function themeone_counter( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'align' => 'txt-left',
			'number' => '3261',
			'subject' => 'Cups of coffe',
			'icon' => 'eating-tea-cup',
			'icolor' => '',
			'iposition' => 'left',
			'speed' => '1300',
			'color' => 'accent-color1',
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		$icolor = esc_attr(to_accent_color($icolor));
		$speed = preg_replace('/[^\d-]+/', '', $speed);
		if ($color != '') {
			$color = 'style="color:'. $color .'"';
		}
		if ($icolor != '') {
			$icolor = 'style="color:'. $icolor .'"';
		}
		$output  = '<span class="to-counter-holder '. esc_attr($align) .'" data-counter="'. esc_attr($number) .'" data-counter-speed="'. esc_attr($speed) .'">';
    	$output .= '<span class="to-counter-number '. esc_attr($iposition) .'">';
		if ($icon && $iposition == 'left') {
			$output .= '<i class="'. esc_attr($icon) .'" '. $icolor .'></i>';
		}
    	$output .= '<span class="to-count-number" '. $color .'>0</span>';
		if ($icon && $iposition != 'left') {
			$output .= '<i class="'. esc_attr($icon) .'" '. $icolor .'></i>';
		}
		if ($subject) {
			$output .= '<span class="to-counter-number-desc">'. $subject .'</span> ';
		}
    	$output .= '</span> ';
    	$output .= '</span>';
		return $output;
	}
	add_shortcode('themeone_counter', 'themeone_counter');
}

/*-----------------------------------------------------------------------------------*/
/*	Team member carousel
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_team_member')) {
	function themeone_team_member( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => 'square',
			'rows' => '4'
	    ), $atts));
		if ($rows == 2) {
			$items = 3;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($rows == 3) {
			$items = 3;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($rows == 4) {
			$items = 4;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($rows == 5) {
			$items = 5;
			$itemsDesktop = 4;
			$itemsDesktopSmall = 3;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		$GLOBALS['typeG'] = $type;
        $output  = '<ul class="to-team-carousel '. esc_attr($type) .'" data-items="'. $items .'" data-items-desktop="[1300,'. $itemsDesktop .']" data-items-desktop-small="[1000,'. $itemsDesktopSmall .']" data-items-tablet="[690,'. $itemsTablet .']" data-items-mobile="[480,'. $itemsMobile .']">';
		$output .= do_shortcode($content);
		$output .= '</ul>';
		return $output;
	}
	add_shortcode('themeone_team_member', 'themeone_team_member');
}

/*-----------------------------------------------------------------------------------*/
/*	Team member
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_member')) {
	function themeone_member( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name' => 'Member Name',
			'position' => 'Member position',
			'img' => '',
			'email' => '',
			'facebook' => '',
			'twitter' => '',
			'google' => '',
	    ), $atts));
		$output  = '<li class="to-member-item">';
        $output .= '<div class="to-member-photo">';
		$output .= '<div class="to-member-overlay"></div>';
        $output .= (!empty($img)) ? '<img alt="'. esc_attr($name) .'" src="'. esc_attr($img) .'" title="'. esc_attr($name) .'">' : null;
        $output .= '</div>';
        $output .= '<h4 class="to-member-name">'. $name .'</h4>';
        $output .= '<div class="to-member-position">'. $position .'</div>';
		if ($content != null) {
			$output .= '<div class="to-member-separator"></div>';
        	$output .= '<p class="to-member-description">'. preg_replace('~</?p[^>]*>~', '', $content) .'</p>';
		}
		if ($facebook != '' || $twitter != '' || $google != '' || $email!='') {
			$output .= '<ul class="to-member-social">';
			if ($email != '') {
				if ($GLOBALS['typeG'] == 'circle') {
					$output .= '<li class="to-social-icon"><a target="_blank" href="'. esc_attr($email) .'"><i class="fa fa-envelope"></i></a></li>';
				} else {
					$output .= '<li class="to-social-icon square"><a target="_blank" href="'. esc_attr($email) .'">'. __('Email', 'mobius') .'</a></li>';
				}
			}
			if ($facebook != '') {
				if ($GLOBALS['typeG'] == 'circle') {
					$output .= '<li class="to-social-icon"><a target="_blank" href="'. esc_attr($facebook) .'"><i class="fa fa-facebook"></i></a></li>';
				} else {
					$output .= '<li class="to-social-icon square"><a target="_blank" href="'. esc_attr($facebook) .'">Facebook</a></li>';
				}
			}
			if ($google != '') {
				if ($GLOBALS['typeG'] == 'circle') {
					$output .= '<li class="to-social-icon"><a target="_blank" href="'. esc_attr($google) .'"><i class="fa fa-google-plus"></i></a></li>';
				} else {
					$output .= '<li class="to-social-icon square"><a target="_blank" href="'. esc_attr($google) .'">Goolge+</a></li>';
				}
			}
			if ($twitter != '') {
				if ($GLOBALS['typeG'] == 'circle') {
					$output .= '<li class="to-social-icon"><a target="_blank" href="'. esc_attr($twitter) .'"><i class="fa fa-twitter"></i></a></li>';
				} else {
					$output .= '<li class="to-social-icon square"><a target="_blank" href="'. esc_attr($twitter) .'">Twitter</a></li>';
				}
			}
			$output .= '</ul>';
		}
        $output .= '</li>';
		return $output;
	}
	add_shortcode('themeone_member', 'themeone_member');
}

/*-----------------------------------------------------------------------------------*/
/*	Testimonial carousel
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_testimonial_carousel')) {
	function themeone_testimonial_carousel( $atts, $content = null ) {	
		extract(shortcode_atts(array(
			'autoplay' => '',
			'speed' => '10000',
			'page' => '',
			'nav' => ''
	    ), $atts));	
		$speed = preg_replace('/[^\d-]+/', '', $speed);
		if ($autoplay != 'true') {
			$speed = 'false';
		}
		if ($page != 'true') {
			$page = 'false';
		}
		if ($nav != 'true') {
			$nav = 'false';
		}
        $output  = '<div class="to-testimonial" data-auto-play="'. esc_attr($speed) .'" data-pagination="'. esc_attr($page) .'" data-navigation="'. esc_attr($nav) .'">';
		$output .= do_shortcode(preg_replace('~</?p[^>]*>~', '', $content));
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_testimonial_carousel', 'themeone_testimonial_carousel');
}

/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_testimonial')) {
	function themeone_testimonial( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'author' => 'Author name',
			'description' => 'Author description',
			'img' => '',
			'color' => '',
			'colordsc' => 'accent-color1'
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		$colordsc = esc_attr(to_accent_color($colordsc));
		if ($color != '') {
			$color = 'style="color:'. $color .'"';
		}
		if ($colordsc != '') {
			$colordsc = 'style="color:'. $colordsc .'"';
		}
		$output  = '<blockquote class="to-testimonial-item">';
        $output .= '<p '. $color .'>'. do_shortcode($content) .'</p>';
		if ($img != '') {
			$output .= '<div class="to-testimonial-img">';
			$output .= '<img alt="'. esc_attr($author) .'" src="'. esc_url($img) .'" title="'. esc_attr($author) .'" height="50" width="50">';
			$output .= '</div>';
			$img = 'testimonial-img';
		} else {
			$img = '';
		}
        $output .= '<span class="to-testimonial-author '. $img .'">'. $author .', </span>';
		if ($description != '') {
        	$output .= '<span class="to-testimonial-autor-desc '. $img .'" '. $colordsc .'>'. $description .'</span>';
		}
        $output .= '</blockquote>';
		return $output;
	}
	add_shortcode('themeone_testimonial', 'themeone_testimonial');
}

/*-----------------------------------------------------------------------------------*/
/*	Clients carousel
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_clients_carousel')) {
	function themeone_clients_carousel( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'autoplay' => '',
			'speed' => '10000',
			'page' => '',
			'grey' => '',
			'nav' => '',
			'rows' => '4'
	    ), $atts));	
		$speed = preg_replace('/[^\d-]+/', '', $speed);
		if ($autoplay != 'true') {
			$speed = 'false';
		}
		if ($page != 'true') {
			$page = 'false';
		}
		if ($nav != 'true') {
			$nav = 'false';
		}
		
		if ($rows == 3) {
			$items = 3;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 3;
			$itemsTablet = 2;
			$itemsMobile = 2;
		}
		if ($rows == 4) {
			$items = 4;
			$itemsDesktop = 4;
			$itemsDesktopSmall = 3;
			$itemsTablet = 2;
			$itemsMobile = 2;
		}
		if ($rows == 5) {
			$items = 5;
			$itemsDesktop = 5;
			$itemsDesktopSmall = 4;
			$itemsTablet = 2;
			$itemsMobile = 2;
		}
		if ($rows == 6) {
			$items = 6;
			$itemsDesktop = 6;
			$itemsDesktopSmall = 4;
			$itemsTablet = 3;
			$itemsMobile = 2;
		}
		if ($rows == 7) {
			$items = 7;
			$itemsDesktop = 7;
			$itemsDesktopSmall = 5;
			$itemsTablet = 3;
			$itemsMobile = 2;
		}
		if ($grey == 'true') {
			$grey = 'grey';
		}
        $output  = '<div class="to-clients-carousel '. $grey .'" data-auto-play="'. $speed .'" data-items="'. $rows .'" data-items-desktop="[1300,'. $itemsDesktop .']" data-items-desktop-small="[1000,'. $itemsDesktopSmall .']" data-items-tablet="[690,'. $itemsTablet .']" data-items-mobile="[480,'. $itemsMobile .']" data-pagination="'. $page .'" data-navigation="'. $nav .'">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_clients_carousel', 'themeone_clients_carousel');
}

/*-----------------------------------------------------------------------------------*/
/*	Client
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_client')) {
	function themeone_client( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'img' => '',
			'url' => ''
	    ), $atts));
		$alt_text = esc_attr(get_alt_from_url($img));
		$alt_text = 'alt="'. $alt_text .'"';
        $output  = '<div class="to-client">';
		if ($url != '') {
			$output .= '<a target="_blank" href="'. esc_url($url) .'">';
		}
        $output .= '<img src="'. esc_url($img) .'" '. $alt_text .'>';
		if ($url != '') {
			$output .= '</a>';
		}
        $output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_client', 'themeone_client');
}

/*-----------------------------------------------------------------------------------*/
/*	Image
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_image')) {
	function themeone_image( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '',
			'background' => '',
			'anim' => '',
			'delay' => ''
	    ), $atts));
		$animClass = null;
		if ($anim != '') {
			$delay = preg_replace('/[^\d-]+/', '', esc_attr($delay));
			$anim = 'data-anim="'. esc_attr($anim) .'" data-delay="'. $delay .'"';
			$animClass = ' has-anim';
		}
		$alt_text = get_alt_from_url(esc_attr($url));
		if ($background) {
			$output = '<div class="to-sc-image-bg" style="background-image: url('. esc_url($url) .')"></div>';
		} else {
        	$output = '<img class="to-sc-image'. $animClass .'" '. $anim .' src="'. esc_url($url) .'" alt="'. $alt_text .'" />';
		}
		return $output;
	}
	add_shortcode('themeone_image', 'themeone_image');
}

/*-----------------------------------------------------------------------------------*/
/*	Video
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_video')) {
	function themeone_video( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'mp4' => '',
			'webm' => '',
			'ogg' => '',
			'youtube' => '',
			'vimeo' => '',
			'poster' => '',
	    ), $atts));
		$output = '<div class="to-sc-video-holder">';
		if ($youtube != '') {
			$YTID = esc_attr(parse_yturl($youtube));
			$output .= '<iframe width="640" height="360" src="//www.youtube.com/embed/'. $YTID .'" allowfullscreen></iframe>';
		} else if ($vimeo != '') {
			$VOID = esc_attr(parse_vimeourl($vimeo));
			$output .= '<iframe src="//player.vimeo.com/video/'. $VOID .'?title=0&amp;byline=0&amp;portrait=0" width="500" height="281"></iframe>';
		} else if ($mp4 != '' || $ogg != ''){
			$output .= '<video controls  style="width: 100%; height: 100%;" preload="none" poster="'. esc_url($poster) .'">';
			if ($mp4 != '') {
				$output .= '<source type="video/mp4" src="'. esc_url($mp4) .'" />';
			}
			if ($webm != '') {
				$output .= '<source type="video/webm" src="'. esc_url($webm) .'" />';
			}
			if ($ogg != '') {
				$output .= '<source type="video/ogg" src="'. esc_url($ogg) .'" />';
			}
			$output .= '</video>';
		}			
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_video', 'themeone_video');
}

function parse_yturl($url) {
    $pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}
function parse_vimeourl($url) {
	$pattern = '~(?:<iframe [^>]*src=")?(?:https?:\/\/(?:[\w]+\.)*vimeo\.com(?:[\/\w]*\/videos?)?\/([0-9]+)[^\s]*)"?(?:[^>]*></iframe>)?(?:<p>.*</p>)?~ix';
	preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

/*-----------------------------------------------------------------------------------*/
/*	Audio
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_audio')) {
	function themeone_audio( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'mp3' => '',
			'oga' => '',
			'artist' => '',
			'song' => '',
			'img' => '',
	    ), $atts));
		if ( wp_get_theme() == 'Mobius' || get_template() == 'mobius') {
			$output  = '<div class="to-audio-player">';
			$output .= '<span class="to-audio-player-duration">00:00</span>';
			$output .= '<span class="to-audio-player-curtime">00:00</span>';
			$output .= '<div class="to-item-audio-link" data-mp3="'. esc_attr($mp3) .'" data-ogg="'. esc_attr($oga) .'" data-song-name="'. esc_attr($song) .'" data-artist="'. esc_attr($artist) .'" data-cover="'. esc_attr($img) .'">';
			$output .= '<i class="fa fa-play"></i><i class="fa fa-pause"></i></div>';
			$output .= '<i class="fa fa-volume-up"></i><i class="fa fa-volume-off"></i>';
			$output .= '<span class="time-float">';
			$output .= '<span class="time-float-current"></span>';
			$output .= '<span class="time-float-corner"></span>';
			$output .= '</span>';
			$output .= '<div class="to-item-time"><div class="to-item-currenttime accentBg"></div></div>';
			$output .= '</div>';
			return $output;
		} else {
			return;
		}
	}
	add_shortcode('themeone_audio', 'themeone_audio');
}

/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_slider')) {
	function themeone_slider( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'autoplay' => '10000',
			'speed' => '',
			'page' => '',
			'nav' => ''
	    ), $atts));	
		$speed = preg_replace('/[^\d-]+/', '', $speed);
		if ($autoplay != 'true') {
			$speed = 'false';
		}
		if ($page != 'true') {
			$page = 'false';
		}
		if ($nav != 'true') {
			$nav = 'false';
		}
        $output = '<ul class="to-sc-slider" data-auto-play="'. $speed .'" data-pagination="'. $page .'" data-navigation="'. $nav .'">';
		$output .= do_shortcode($content);
		$output .= '</ul>';
		return $output;
	}
	add_shortcode('themeone_slider', 'themeone_slider');
}

/*-----------------------------------------------------------------------------------*/
/*	Slide
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_slide')) {
	function themeone_slide( $atts, $content = null ) {
		extract(shortcode_atts(array(), $atts));
        $output  = '<li class="to-sc-slide">';
        $output .= do_shortcode($content);
        $output .= '</li>';
		return $output;
	}
	add_shortcode('themeone_slide', 'themeone_slide');
}

/*-----------------------------------------------------------------------------------*/
/*	Twitter
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_twitter')) {
	function themeone_twitter( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'autoplay' => '10000ms',
			'speed' => '',
			'page' => '',
			'nav' => '',
			'name' => '',
			'c_key' => '',
			'c_secret' => '',
			'a_token' => '',
			'a_secret' => '',
			'no_tweets' => '4',
	    ), $atts));
		$latestTweet = null;
		$output = null;
		$speed = preg_replace('/[^\d-]+/', '', $speed);
		if ($autoplay != 'true') {
			$speed = 'false';
		}
		if ($page != 'true') {
			$page = 'false';
		}
		if ($nav != 'true') {
			$nav = 'false';
		}
		
		@require_once( THEMEONE_TINYMCE_DIR .'/twitteroauth/twitteroauth.php' );
		
		$twitterConnection = new TwitterOAuth(
			''. $c_key .'', // Consumer Key
			''. $c_secret .'', // Consumer secret
			''. $a_token .'', // Access token
			''. $a_secret .'' // Access token secret
        );
		
		$twitterData = $twitterConnection->get(
			'statuses/user_timeline',
			array(
				'screen_name'     => ''. $name .'',
				'count'           => $no_tweets,
				'exclude_replies' => true
			)
        );
		
		$output  = '<div class="section-container to-sc-twitter-section">';
		$output .= '<div class="to-sc-twitter-icon fa fa-twitter"></div>';
		$output .= '<div class="to-sc-twitter" data-auto-play="'. $speed .'" data-pagination="'. $page .'" data-navigation="'. $nav .'">';
		if($twitterData && is_array($twitterData)) {
			foreach($twitterData as $tweet):
				$output .= '<div class="tweet-slide">';
				$output .= '<span>';
				$output .= parseTweet($tweet->text);
				$output .= $latestTweet;
				$output .= '</span>';
				$twitterTime = strtotime($tweet->created_at);
				$timeAgo = ago($twitterTime);
				$output .= '<div class="to-sc-tweet-meta"><a target="_blank" href="http://twitter.com/'. $tweet->user->screen_name .'/statuses/'. $tweet->id_str .'" class="jtwt_date">'. $timeAgo .'</a></div>';
				$output .= '</div>';
			endforeach;
		} else {
			$output .= '<div class="tweet-slide">';
			$output .= '<span>';
			$output .= 'Please set your Twitter account and your Twitter API Key!<br>Thank You For Purchasing Mobius!';
			$output .= '</span>';
			$output .= '<div class="to-sc-tweet-meta"><a target="_blank" href="http://twitter.com/theme_one/" class="jtwt_date"><strong>Themeone Team</strong></a></div>';
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_twitter', 'themeone_twitter');
}

function parseTweet($text) {
    $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a target="_blank" class="tweet-link-color" href="$0">$0</a>', $text); //Link
    $text = preg_replace('#@([a-z0-9_]+)#i', '<a target="_blank" class="tweet-link-color" href="http://twitter.com/$1">@$1</a>', $text); //usernames
    $text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a target="_blank" class="tweet-link-color" href="http://search.twitter.com/search?q=%23$1">$1</a>', $text); //Hashtags
    $text = preg_replace('#https://[a-z0-9._/-]+#i', '<a target="_blank" class="tweet-link-color" href="$0">$0</a>', $text); //Links
    return $text;
}

function ago($time){
   $periods = array("second", "minute", "hour", "day", "week", "month", "year");
   $lengths = array("60","60","24","7","4.35","12","10");
   $now = time();
   $difference = $now - $time;
   $tense = "ago";
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }
   $difference = round($difference);
   if($difference != 1) {
       $periods[$j].= "s";
   }
   return "$difference $periods[$j] ago ";
}

/*-----------------------------------------------------------------------------------*/
/*	Grid Blog/Portfolio
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_grid')) {
	function themeone_grid( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'pagination' => '',
			'gridtype' => 'grid',
			'type' => 'portfolio',
			'postsize' => '',
			'portsize' => '',
			'portstyle' => 'style1',
			'orderby' => 'none',
			'category' => '',
			'postnb' => '4',
			'hlayout' => '',
			'rownb' => '2',
			'toggle' => '',
			'filters' => '',
			'ratio' => '0.8',
			'gutter' => '',
			'controls' => '',
			'colsup' => '6',
			'col1600' => '5',
			'col1280' => '4',
			'col1000' => '3'
		), $atts));
		if ($orderby == 'none') {
			$orderby = '';
		}
		if ( wp_get_theme() == 'Mobius' || get_template() == 'mobius') {
			ob_start();
			mobius_grid_init(esc_attr($pagination),esc_attr($gridtype),esc_attr($type),esc_attr($postnb),esc_attr($rownb),esc_attr($colsup),esc_attr($col1600),esc_attr($col1280),esc_attr($col1000),'',esc_attr($ratio),esc_attr($postsize),esc_attr($portsize),esc_attr($hlayout),esc_attr($toggle),esc_attr($filters),esc_attr($gutter),esc_attr($controls),esc_attr($orderby),esc_attr($portstyle),esc_attr($category));
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
		} else {
			return;
		}
			
	}
	add_shortcode('themeone_grid', 'themeone_grid');
}

/*-----------------------------------------------------------------------------------*/
/*	Process Step
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_process')) {
	function themeone_process( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'slide' => '3',
			'color' => ''
		), $atts));
		
		if ($slide == 2) {
			$items = 2;
			$itemsDesktop = 2;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($slide == 3) {
			$items = 3;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($slide == 4) {
			$items = 4;
			$itemsDesktop = 3;
			$itemsDesktopSmall = 2;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		if ($slide == 5) {
			$items = 5;
			$itemsDesktop = 4;
			$itemsDesktopSmall = 3;
			$itemsTablet = 1;
			$itemsMobile = 1;
		}
		
		return '<ul class="to-process '. esc_attr($color) .'" data-items="'. $items .'" data-items-desktop="[1300,'. $itemsDesktop .']" data-items-desktop-small="[1000,'. $itemsDesktopSmall .']" data-items-tablet="[690,'. $itemsTablet .']" data-items-mobile="[480,'. $itemsMobile .']">'. do_shortcode($content) . '</ul>';
	}
	add_shortcode('themeone_process', 'themeone_process');
}

if (!function_exists('themeone_step')) {
	function themeone_step( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Your title',
			'color' => '',
			'icon' => 'eating-tea-cup',
			'iconc' => 'accent-color1',
			'image' => ''		
	    ), $atts));
		$iconc = esc_attr(to_accent_color($iconc));
		if ($iconc) {
			$iconc = 'style="color:'. $iconc .'"';
		}
		$output  = '<li class="to-process-step '. esc_attr($color) .'">';
		if ($image) {
			$output .= '<div class="to-process-step-image" style="background-image: url('. esc_attr($image) .')"></div>';
		}
		$output .= '<i class="to-process-step-icon '. esc_attr($icon) .'" '. $iconc .'></i>';
		$output .= '<h3 class="to-process-step-title">'. $title;
		$output .= '<span class="to-process-dot"></span>';
		$output .= '</h3>';
		$output .= '<p class="to-process-step-content">'. do_shortcode(preg_replace('~</?p[^>]*>~', '', $content)) .'</p>';
		return $output;
	}
	add_shortcode('themeone_step', 'themeone_step');
}

/*-----------------------------------------------------------------------------------*/
/*	Tooltip
/*-----------------------------------------------------------------------------------*/

if (!function_exists('tooltip')) {
	function themeone_tooltip( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'text' => '',
			'content' => '',
			'color' => 'accent-color1',
			'top' => '',
			'left' => ''
		), $atts));
		
		$color   = esc_attr(to_accent_color($color));
		$output  = '<span class="to-pulse-holder" style="top:'. esc_attr($top) .';left:'. esc_attr($left) .'">';
    	$output .= '<span class="to-pulse-marker" style="background:'. $color .'">';
		$output .= '<span class="to-pulse-rays" style="border-color:'. $color .'"></span>';
		$output .= '<abbr class="to-pulse-content" data-content="'. esc_attr($text) . esc_attr($content) .'" rel="tooltip"></abbr>';
    	$output .= '</span>';
  		$output .= '</span>';
		
		return $output;	
	}
	add_shortcode('themeone_tooltip', 'themeone_tooltip');
}

/*-----------------------------------------------------------------------------------*/
/*	Team member box
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_box_member')) {
	function themeone_box_member( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'img' => '',
			'name' => 'Member Name',
			'position' => 'Member position',
			'url' => '',
			'email' => '',
			'twitter' => '',
			'facebook' => '',
			'google' => '',
			'linkedin' => '',
			'pinterest' => '',
			'dribbble' => '',
			'youtube' => '',
			'vine' => ''
	    ), $atts));
		
		$url_before = null;
		$url_after  = null;
		if ($url) {
			$url_before = '<a href="'. $url .'" class="accentColorHover">';
			$url_after  = '</a>';
		}
		
		$output  = '<div class="to-member-box">';
		$output .= '<div class="to-member-box-holder">';
		$output .= '<div style="background-image:url('. esc_url($img) .')" class="team-member-box-image"></div>';
		$output .= '<div class="to-member-box-overlay"></div>';
		$output .= '<div class="to-member-box-content">';
		$output .= '<h3 class="to-member-box-name">'. $url_before . $name . $url_after .'</h3>';
		$output .= '<p class="to-member-box-position">'. $position .'</p>';
		$output .= '</div>';
		$output .= '<ul class="to-member-box-social">';
		if ($email) {
			$output .= '<li><a href="'. esc_attr($email) .'" title="Send a Mail"><i class="fa fa-envelope"></i></a></li>';
		}
		if ($twitter) {
			$output .= '<li><a href="'. esc_attr($twitter) .'" title="View Twitter Profile"><i class="fa fa-twitter"></i></a></li>';
		}
		if ($facebook) {
			$output .= '<li><a href="'. esc_attr($facebook) .'" title="View FaceBook Profile"><i class="fa fa-facebook"></i></a></li>';
		}
		if ($google) {
			$output .= '<li><a href="'. esc_attr($google) .'" title="View Google Plus Profile"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ($linkedin) {
			$output .= '<li><a href="'. esc_attr($linkedin) .'" title="View Linkedin Profile"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ($pinterest) {
			$output .= '<li><a href="'. esc_attr($pinterest) .'" title="View Pinterest Profile"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ($dribbble) {
			$output .= '<li><a href="'. esc_attr($dribbble) .'" title="View Dribbble Profile"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ($youtube) {
			$output .= '<li><a href="'. esc_attr($youtube) .'" title="View YouTube Profile"><i class="fa fa-youtube-play"></i></a></li>';
		}
		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		

		return $output;
	}
	add_shortcode('themeone_box_member', 'themeone_box_member');
}

/*-----------------------------------------------------------------------------------*/
/*	TYPE WRITER
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_typewriter')) {
	function themeone_typewriter( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'txt' => 'Professional;Creative;Passionate',
			'color' => '',
			'pause' => '2000',
	    ), $atts));
		$pause = preg_replace('/[^\d-]+/', '', esc_attr($pause));
		$color = esc_attr(to_accent_color($color));
		if ($color) {
			$color = 'style="color:'. $color .'"';
		}
		$output  = '<span class="to-type-writer" data-text="'. esc_attr($txt) .'" data-pause="'. $pause .'" '. $color .'></span>';
		$output .= '<span class="to-type-writer-cursor" '. $color .'></span>';
		return $output;
	}
	add_shortcode('themeone_typewriter', 'themeone_typewriter');
}

/*-----------------------------------------------------------------------------------*/
/*	Pull quote
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_pull_quote')) {
	function themeone_pull_quote( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'width' => '40',
			'align' => 'left',
			'border' => '',
	    ), $atts));
		if ($width) {
			$width =  'style="width:'. esc_attr($width) .'%;"';
		}
		if ($border) {
			$border =  'border';
		}
		$output  = '<div class="to-pull-quote '. esc_attr($align) .' '. $border .'" '. $width .'>';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('themeone_pull_quote', 'themeone_pull_quote');
}

/*-----------------------------------------------------------------------------------*/
/*	Drop Cap
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_drop_cap')) {
	function themeone_drop_cap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'letter' => '',
			'color' => ''
	    ), $atts));
		$color = esc_attr(to_accent_color($color));
		if ($color) {
			$color = 'style="color:'. $color .'"';
		}
		$output  = '<span class="to-dropcap" '. $color .'>'.$letter.'</span>';
		return $output;
	}
	add_shortcode('themeone_drop_cap', 'themeone_drop_cap');
}

/*-----------------------------------------------------------------------------------*/
/*	Widget
/*-----------------------------------------------------------------------------------*/

if (!function_exists('themeone_widget')) {
	function themeone_widget( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'widget' => '',
			'instance' => ''
	    ), $atts));
		$output  = null;
		$instance = str_replace('&amp;', '&', esc_attr($instance));
		ob_start();
		the_widget($widget, $instance, array(
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		));
		$output = ob_get_contents();
		ob_end_clean();		
		return $output;
	}
	add_shortcode('themeone_widget', 'themeone_widget');
}


/*-----------------------------------------------------------------------------------*/
/*	Clean empty p tag from shortcode
/*-----------------------------------------------------------------------------------*/

/* BitFade Method To clean shortcode accepted by Themeforest Review Team (http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848)*/

add_filter('the_content', 'the_content_filter');
function the_content_filter($content) {
	
	$block = array(
		'themeone_section',
		'themeone_img_section',
		'themeone_side_section',
		'themeone_video_section',
		'themeone_one_half',
		'themeone_one_third',
		'themeone_two_thirds',
		'themeone_one_fourth',
		'themeone_three_fourths',
		'themeone_one_sixth',
		'themeone_five_sixths',
		'themeone_one_whole',
		'themeone_spacer',
		'themeone_divider',
		'themeone_header',
		'themeone_quote',
		'themeone_custom_font',
		'themeone_highlight',
		'themeone_button',
		'themeone_icon',
		'themeone_icon_txt',
		'themeone_social',
		'themeone_ul',
		'themeone_li',
		'themeone_pricing',
		'themeone_ptable',
		'themeone_tabs',
		'themeone_tab',
		'themeone_toggle',
		'themeone_accordion',
		'themeone_progress',
		'themeone_pie_chart',
		'themeone_counter',
		'themeone_team_member',
		'themeone_member',
		'themeone_testimonial_carousel',
		'themeone_testimonial',
		'themeone_clients_carousel',
		'themeone_client',
		'themeone_image',
		'themeone_video',
		'themeone_audio',
		'themeone_slider',
		'themeone_slide',
		'themeone_twitter',
		'themeone_grid',
		'themeone_process',
		'themeone_step',
		'themeone_tooltip',
		'themeone_box_member',
		'themeone_typewriter',
		'themeone_pull_quote',
		'themeone_drop_cap',
		'themeone_widget'
	);
	
	if (count($block) === 0) {
		return $content;
	}

	$block = join("|",$block);
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	
	return $rep;
}

/*-----------------------------------------------------------------------------------*/
/*	Get Alternative text image from url
/*-----------------------------------------------------------------------------------*/

function get_alt_from_url( $attachment_url = '' ) {
	global $wpdb;
	$attachment_id = false;
	if ( '' == $attachment_url ) {
		return;
	}
	$upload_dir_paths = wp_upload_dir();
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}
	$alt_img_url = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	return $alt_img_url;
}


?>