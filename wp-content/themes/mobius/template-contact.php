<?php 

/*template name: Contact*/

get_header(); 

themeone_page_header($post->ID);

global $mobius;

$map_markers = null;
$map_lats = null;
$map_lngs = null;
$map_infos = null;

for($i = 1; $i <= 10; $i++){
	if(!empty($mobius['latitude-'.$i]) && !empty($mobius['longitude-'.$i]) ) {
		if ( is_array($mobius['marker-'.$i]) ){
			$map_markers .= $mobius['marker-'.$i]['url'].';';
    	}
		$map_lats  .= esc_attr($mobius['latitude-'.$i]).';';
		$map_lngs  .= esc_attr($mobius['longitude-'.$i]).';';
		$map_infos .= esc_attr($mobius['map-info-'.$i]).';';
	}	
}

$map_markers = rtrim($map_markers, ";");
$map_lats    = rtrim($map_lats, ";");
$map_lngs    = rtrim($map_lngs, ";");
$map_infos   = rtrim($map_infos, ";");

$map_type       = esc_attr($mobius['map-type']);
$map_color      = esc_attr($mobius['map-color']);
$map_draggable  = esc_attr($mobius['map-draggable']);
$map_anim       = esc_attr($mobius['enable-animation']);
$map_anim_hover = esc_attr($mobius['enable-hover']);
$map_zoom       = esc_attr($mobius['enable-zoom']);
$map_zoom_level = esc_attr($mobius['zoom-level']);

$google_map = '<div id="google-map" style="height:'. $mobius['map-height'].'px !important;" data-map-type="'. $map_type .'" data-map-color="'. $map_color .'" data-map-draggable="'. $map_draggable .'" data-lats="'. $map_lats .'" data-lngs="'. $map_lngs .'" data-infos="'.$map_infos .'" data-enable-animation="'. $map_anim .'" data-enable-animation-hover="'. $map_anim_hover .'" data-enable-zoom="'. $map_zoom .'" data-zoom-level="'. $map_zoom_level .'" data-markers="'. $map_markers .'"></div>';

$page_id = get_queried_object_id();
$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
$sidebar_margin = esc_attr(get_post_meta($page_id, 'themeone-sidebar-margintop', true));
	
if (empty($sidebar_layout)) {
	$sidebar_layout = 'right';
}
if (empty($sidebar)) {
	$sidebar_layout = null;
}
if (!empty($sidebar_margin)) {
	$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
}

/**** page color ***/
$page_color = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .'"';
	echo '<div  '. $page_color .'>';
}

echo $google_map;
		
switch($sidebar_layout) {
	case 'right':
		echo '<section><div class="section-container">';
		echo '<div class="col col-9">';
			if(have_posts()) : while(have_posts()) : the_post();
			the_content();
			endwhile; endif; 
		echo '</div>';
		echo '<div id="sidebar" class="col col-3 col-last" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
		echo '</div></section>';
		break;
	case 'left':
		echo '<section><div class="section-container">';
		echo '<div id="sidebar" class="col col-3" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
		echo '<div class="col col-9 col-last">';
			if(have_posts()) : while(have_posts()) : the_post();
			the_content();
			endwhile; endif; 
		echo '</div>';
		echo '</div></section>';
		break;
	default: 
		if(have_posts()) : while(have_posts()) : the_post();
		the_content();
		endwhile; endif; ;
		break; 
}

if (!empty($page_color)) {
	echo '</div>';
}

get_footer(); 

?>