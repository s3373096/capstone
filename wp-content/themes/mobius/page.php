<?php 

get_header(); 

themeone_page_header(get_queried_object_id());

themeone_slider_init();

if (class_exists('Woocommerce')) {
	if (is_cart() || is_checkout() || is_account_page()) {
		do_action('woocommerce_before_main_content');
	}
}

global $wp_registered_sidebars;

$page_id        = get_queried_object_id();
$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
$sidebar_layout = esc_attr(get_post_meta($page_id, 'themeone-sidebar-position', true));
$sidebar_margin = esc_attr(get_post_meta($page_id, 'themeone-sidebar-margintop', true));
$sidebar_exist  = null;

/**** page color ***/
$page_color = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .'"';
	echo '<div  '. $page_color .'>';
}
/**** page color ***/

if (empty($sidebar_layout)) {
	$sidebar_layout = 'right';
}
if (!empty($sidebar_margin)) {
	$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
}
foreach ($wp_registered_sidebars as $name ) {
	if ($name['name'] == $sidebar) {
		$sidebar_exist = 'true';
		break;
	}
}
if (!is_active_sidebar($sidebar) || $sidebar_exist != true) {
	$sidebar_layout = null;
}

switch($sidebar_layout) {
	case 'right':
		echo '<div class="section-container">';
		echo '<div class="col col-9">';
			if(have_posts()) : while(have_posts()) : the_post();
			the_content();
			/*if (comments_open() || get_comments_number()) {
				echo '<div class="clear"></div>	';
				comments_template();
				echo '<div class="clear"></div>	';
			}*/
			endwhile; endif; 
		echo '</div>';
		echo '<div id="sidebar" class="col col-3 col-last" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
		echo '</div>';
		break;
	case 'left':
		echo '<div class="section-container">';
		echo '<div id="sidebar" class="col col-3" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
		echo '<div class="col col-9 col-last">';
			if(have_posts()) : while(have_posts()) : the_post();
			the_content();
			/*if (comments_open() || get_comments_number()) {
				echo '<div class="clear"></div>	';
				comments_template();
				echo '<div class="clear"></div>	';
			}*/
			endwhile; endif; 
		echo '</div>';
		echo '</div>';
		break;
	default: 
		if(have_posts()) : while(have_posts()) : the_post();
		the_content();
		/*if (comments_open() || get_comments_number()) {
			echo '<div class="clear"></div>	';
			comments_template();
			echo '<div class="clear"></div>	';
		}*/
		endwhile; endif; ;
		break; 
}

if (!empty($page_color)) {
	echo '</div>';
}

if (class_exists('Woocommerce')) {
	if (is_cart() || is_checkout() || is_account_page()) {
		do_action('woocommerce_after_main_content');
	}
}
			
get_footer(); 

?>