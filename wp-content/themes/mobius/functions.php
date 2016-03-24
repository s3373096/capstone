<?php 

#-----------------------------------------------------------------#
# Text Domain
#-----------------------------------------------------------------#

add_action('after_setup_theme', 'themeone_lang_setup');
function themeone_lang_setup(){
	load_theme_textdomain('mobius', get_template_directory() . '/lang');
}

#-----------------------------------------------------------------#
# Admin Notice
#-----------------------------------------------------------------#

$version = phpversion();

function themeone_admin_notice() {
	global $current_user ;
	$user_id = $current_user->ID;

	if (!get_user_meta($user_id, 'php_version_ignore')){
		echo '<div class="error">';
		echo '<h3>'. __( 'Important Message for Mobius Theme!', 'mobius' ) .'</h3>';
		echo '<p>'. __('Your php version is', 'mobius' ) .' <strong>'. phpversion() .'</strong><br>';
		echo __('You need at least', 'mobius' ).' <strong>php 5.3.0</strong> '.__('in order to have all Mobius features activated. Please contact your web host company to upgrade your php.', 'mobius' ) .'<br>';
		echo __('With your current php version you not be able to set image in the megamenu', 'mobius' ) .'</p>';
		printf(__('<p><a href="%1$s"><strong>Dismiss this notice</strong></a></p>'), '?themeone_admin_notice_ignore=0');
		echo '</div>';
	}
}

function themeone_admin_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if (isset($_GET['themeone_admin_notice_ignore']) && '0' == $_GET['themeone_admin_notice_ignore']) {
		add_user_meta($user_id, 'php_version_ignore', 'true', true);
	}
}

if (version_compare(PHP_VERSION, '5.3.0') < 0) {
	add_action('admin_notices', 'themeone_admin_notice');
	add_action('admin_init', 'themeone_admin_notice_ignore');
}

#-----------------------------------------------------------------#
# Redux Framework
#-----------------------------------------------------------------#

if (is_admin()) {
	require_once('includes/demo-importer/to-importer.php');
} 
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) .'/includes/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) .'/includes/redux-framework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) .'/includes/options/options.php' ) ) {
    require_once( dirname( __FILE__ ) .'/includes/options/options.php' );    
}

#-----------------------------------------------------------------#
# Disable VC updater for TGMPA
#-----------------------------------------------------------------#

add_action( 'vc_before_init', 'your_prefix_vcSetAsTheme' );
function your_prefix_vcSetAsTheme() {
	vc_set_as_theme( $disable_updater = true );
}

#-----------------------------------------------------------------#
# Register/Enqueue JS
#-----------------------------------------------------------------#


function themeone_register_scripts() {		
	if (!is_admin()) {
	
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', 'jquery', '2.7.1');
		wp_register_script('preloader', get_template_directory_uri() . '/js/preloader.js', 'jquery', '1.0');
		wp_register_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', 'jquery', '1.2.1', TRUE);
		wp_register_script('history', get_template_directory_uri() . '/js/history.js', 'jquery', '1.0', TRUE);
		wp_register_script('ajaxify', get_template_directory_uri() . '/js/ajaxify.js', 'jquery', '1.0.1', TRUE);
		wp_register_script('easing', get_template_directory_uri() . '/js/easing.js', 'jquery', '1.3',TRUE);
		wp_register_script('carousel', get_template_directory_uri() . '/js/owl.carousel.js', 'jquery', '1.3.2', TRUE);
		wp_register_script('hammer', get_template_directory_uri() . '/js/hammer.js', 'jquery', '1.0.7', TRUE);		
		wp_register_script('custom_isotope', get_template_directory_uri() . '/js/isotope.js', 'jquery', '1.5.25', TRUE);
		wp_register_script('sly', get_template_directory_uri() . '/js/sly.js', 'jquery', '1.2.2', TRUE);
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', '1.0', TRUE);	
		wp_register_script('woo', get_template_directory_uri() . '/js/woocommerce.js', 'jquery', '1.0', TRUE);

		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr');
		
		global $mobius;
		
		if ($mobius['preloader'] == 1) {
			wp_enqueue_script('preloader');
		}
		
		if ($mobius['smooth-scroll'] == 1) {
			wp_enqueue_script('smoothscroll');
		}
		
		if ($mobius['ajax-nav'] == 1 && !current_user_can('manage_options')) {
			wp_enqueue_script('history');
			wp_enqueue_script('ajaxify');
		}

		wp_enqueue_script('mediaelement');
		wp_enqueue_script('carousel');
		wp_enqueue_script('easing');
		wp_enqueue_script('hammer');
		wp_enqueue_script('custom_isotope');
		wp_enqueue_script('sly');
		wp_localize_script('custom', 'to_ajaxurl', admin_url( 'admin-ajax.php' ));
		wp_enqueue_script('custom');
		
		if (class_exists('Woocommerce')) {
			wp_enqueue_script('woo');
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-mouse' );
			wp_enqueue_script( 'jquery-ui-slider' );
		}
		
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'themeone_register_scripts');

#-----------------------------------------------------------------#
# Register/Enqueue CSS
#-----------------------------------------------------------------#

function themeone_register_styles() {	 
	wp_register_style('main-styles', get_stylesheet_directory_uri() . '/style.css');
	wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_register_style('icomoon', get_template_directory_uri() . '/css/icomoon.css');
	wp_register_style('steadysets', get_template_directory_uri() . '/css/steadysets.css');
	wp_register_style('linecons', get_template_directory_uri() . '/css/linecons.css');
	wp_register_style('mediaelementplayer', get_stylesheet_directory_uri() . '/css/mediaelementplayer.css');
	wp_register_style('font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.min.css'); 
	wp_register_style('ie7-support', get_template_directory_uri() . '/css/ie7support.css');
	
	wp_enqueue_style('main-styles');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('icomoon');
	wp_enqueue_style('steadysets');
	wp_enqueue_style('linecons');
	wp_enqueue_style('mediaelementplayer');
	wp_enqueue_style('font-awesome-ie7'); 
	wp_enqueue_style('ie7-support'); 

	global $wp_styles;
	$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lte IE 7');
	$wp_styles->add_data('ie7-support', 'conditional', 'lte IE 8');
}
add_action('wp_enqueue_scripts', 'themeone_register_styles');

#-----------------------------------------------------------------#
# Register/Enqueue JS/CSS In Admin Panel
#-----------------------------------------------------------------#

function themeone_register_admin_styles() {
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.min.css'); 
	wp_enqueue_style('options-css', get_template_directory_uri() . '/includes/options/options.css');
	wp_enqueue_style('icomoon', get_template_directory_uri() . '/css/icomoon.css');
	wp_enqueue_style('steadysets', get_template_directory_uri() . '/css/steadysets.css');
	wp_enqueue_style('linecons', get_template_directory_uri() . '/css/linecons.css');
	global $wp_styles;
	$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lte IE 7');
}
add_action( 'admin_enqueue_scripts', 'themeone_register_admin_styles' );

#-----------------------------------------------------------------#
# Includes Processing Files
#-----------------------------------------------------------------#

global $mobius;

require_once('includes/post-like/post-like.php');
require_once('includes/custom-widgets/most-liked-post.php');
require_once('includes/custom-widgets/recent-portfolio.php');
require_once('includes/custom-widgets/related-posts.php');
require_once('includes/aqua-resizer/aq_resizer.php');
require_once('includes/mobius-grid/mobius-grid.php');

if (!empty($mobius['ajax-search'])) {
	require_once('includes/ajax-search/search_autocomplete.php');
}
if (!empty($mobius['ajax-comment'])) {
	require_once('includes/ajax-comments/ajax-comments.php');
}

if (is_admin()) {
	require_once('includes/metaboxes/tomb.php');
	require_once('includes/metaboxes/tomb-config.php' );
	require_once('includes/reorder-posts/reorder-posts.php');
	require_once('includes/tgm-plugin-activation/required-plugins.php');
	if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
		require_once('includes/nav-menu/nav-menu.php');
	}
} 

#-----------------------------------------------------------------#
# Dynamic Styles/Scipts
#-----------------------------------------------------------------#

include('css/custom.php');
include('css/colors.php');

if(!empty($mobius['custom-js'])) {
	include('js/custom-js.php');
}

#-----------------------------------------------------------------#
# YITH Woocommerce WhishList dequeue FontAwsome styles
#-----------------------------------------------------------------#

global $yith_wcwl;

if ($yith_wcwl) {
	add_action( 'wp_enqueue_scripts', 'themeone_manage_whishlist_styles', 99 );
	function themeone_manage_whishlist_styles() {
		wp_dequeue_style( 'yith-wcwl-font-awesome');
		wp_dequeue_style( 'yith-wcwl-font-awesome-ie7');
	}
}

#-----------------------------------------------------------------#
# Custom Header/Background
#-----------------------------------------------------------------#

add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );

#-----------------------------------------------------------------#
# Title-tag Support
#-----------------------------------------------------------------#

function themeone_title_tag() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'themeone_title_tag' );

#-----------------------------------------------------------------#
# Excerpt Setup 
#-----------------------------------------------------------------#

function themeone_excerpt_length( $length ) {
	global $mobius;
	global $gridEx;
	if ( is_search() ) {
		return 50;
	} else if ( $gridEx == 'true') {
		return 500;
	} else if ( is_home() && $mobius['blog-layout'] == 'standard' || $mobius['blog-layout'] == 'standard') {
		return 75;
	}  else {
		return 150;
	}
}
add_filter('excerpt_length', 'themeone_excerpt_length', 999);

function themeone_get_excerpt($limit, $source = null, $post_id){
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	if ( !is_search() && !is_archive()) {
    	$excerpt = $excerpt.' <a class="to-excerpt-masonry" href="'. esc_url(get_permalink($post_id)) .'"><i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i></a>';
	} else {
		if ($excerpt != null) {
			$excerpt = $excerpt.'<a href="'. esc_url(get_permalink($post_id)) . '"><span class="to-excerpt-more">&nbsp;[...]</span></a>';
		} else {
			$excerpt = $excerpt.'<a href="'. esc_url(get_permalink($post_id)) . '"><span class="to-excerpt-more">Read more ...</span></a>';
		}
	}
    return $excerpt;
}

function themeone_excerpt_more($more) {
	if ( is_search()) {
		return '<a href="'. esc_url(get_permalink()) . '"><span class="to-excerpt-more">&nbsp;[...]</span></a>';
	} else {
		return '';
	}
}
add_filter('excerpt_more', 'themeone_excerpt_more');

#-----------------------------------------------------------------#
# Post Formats/Thumbnail Features
#-----------------------------------------------------------------#

function themeone_post_type( $current_screen ) {
	if ( 'post' == $current_screen->post_type && 'post' == $current_screen->base ) {
		add_theme_support( 'post-formats', array( 'quote', 'link', 'video', 'audio', 'gallery' ) );
	}
}
add_action( 'current_screen', 'themeone_post_type' );

add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video') );
add_post_type_support( 'portfolio', 'post-formats' );

add_theme_support( 'post-thumbnails', array( 'post', 'portfolio', 'product' )  );

add_image_size( 'normal', 500, 350, true );
add_image_size( 'wide', 1000, 350, true );  
add_image_size( 'tall', 500, 700, true ); 
add_image_size( 'square', 1000, 700, true );
add_image_size( 'masonry', 500, 9999 );

#-----------------------------------------------------------------#
# Automatic Feed Links
#-----------------------------------------------------------------#

if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}

#-----------------------------------------------------------------#
# Define Max Content Width For Media
#-----------------------------------------------------------------#

if (!isset($content_width)) {
	$content_width = 1180;
}

#-----------------------------------------------------------------#
# Add Theme Support NavMenu/ Add Arrow DropDown Menu (WALKER)
#-----------------------------------------------------------------#

add_theme_support( 'menus' );
if (function_exists('register_nav_menus')) {
	register_nav_menus(
		array(
		  'top-nav' => 'Top Navigation Menu <br /> <small>Will only display if applicable top menu layout in header option is selected.</small>',
		  'left-nav' => 'Left Navigation Menu <br /> <small>Display the menu inside the left sidebar menu. Only visible if left menu layout is activated or if you browser widht is to small.</small>'
		)
	);
}

class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
	
	private $curItem;
	
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent == 0) { 
            $element->title =  $element->title . '<span class="arrow-indicator"><i class="fa fa-angle-down"></i></span>'; 
        }
		if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent != 0) { 
            $element->title =  $element->title . '<span class="arrow-indicator"><i class="fa fa-angle-right"></i></span>'; 
        }
		$classes = $element->classes[0];
		if (empty($classes) || $classes == 'megamenu') {
  			$classes = 'blank';
		} else {
			$classes = 'fa '.$classes;
			$element->title = '<i class="icon-menu '. $classes . '"></i>' . $element->title;
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$this->curItem = $item;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$highlight_txt = get_post_meta($item->ID, '_menu_item_highlight-text', true);
		$highlight_txt = ($highlight_txt) ? '<span class="menu-text-highlight accentColor">'.$highlight_txt.'</span>' : '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= '<span>'. $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $highlight_txt . $args->link_after . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}
	function end_el(&$output, $item, $depth=0, $args=array()) {
		$output .= "</li>\n";
    }
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$menu_img = null;
		$menu_cla = null;
		$ID  = $this->curItem->ID;
		$img = get_post_meta($ID, '_menu_item_image', true);
		$pos = get_post_meta($ID, '_menu_item_image-position', true);
		if ($img) {
			$menu_cla = 'sub-image';
			$menu_img = 'style="background-image: url('. $img .');"';
		}
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu $menu_cla $pos\" $menu_img>\n";
    }
	 function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
		
    }
}

class Left_Walker_Nav_Menu extends Walker_Nav_Menu {	
	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
        	$element->title =  $element->title . '<span class="arrow-indicator"><i class="fa icon-to-right-arrow-thin"></i></span>';
        }
		$classes = $element->classes[0];
		if (empty($classes) || $classes == 'megamenu') {
  			$classes = 'blank';
		} else {
			$classes = 'fa '.$classes;
			$element->title = '<i class="icon-menu '. $classes . '"></i>' . $element->title;
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$this->curItem = $item;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$highlight_txt = get_post_meta($item->ID, '_menu_item_highlight-text', true);
		$highlight_txt = ($highlight_txt) ? '<span class="menu-text-highlight accentColor">'.$highlight_txt.'</span>' : '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		if (in_array('menu-item-has-children',$classes)) {
			$menu_depth  = intval($depth)+1;
      		$attributes .= ' class="menu-link-parent" data-depth="'. $menu_depth .'"';
    	} else {
      		$attributes .= ' class="menu-link-noparent"';
    	}
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $highlight_txt . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
		$menu_depth  = intval($depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
		$output .= "\n$indent<li class=\"back-sub-menu\" data-depth=\"$menu_depth\"><i class='fa icon-to-left-arrow-thin'></i><span>". __('Back', 'mobius') ."</span></li>\n";
    }
	 function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}

#-----------------------------------------------------------------#
# Widget Areas/ Sidebars
#-----------------------------------------------------------------#

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Side Bar Area 1',
		'id'=> 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 1',
		'id'=> 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 2',
		'id'=> 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Menu Area',
		'id'=> 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	$footerColumns = (!empty($mobius['footer-columns'])) ? $mobius['footer-columns'] : '4';
	if($footerColumns == '3' || $footerColumns == '4'){
		register_sidebar(array(
			'name' => 'Footer Area 3',
			'id'=> 'sidebar-5',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
	}
	if($footerColumns == '4'){
		register_sidebar(array(
			'name' => 'Footer Area 4',
			'id'=> 'sidebar-6',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
	}
}

#-----------------------------------------------------------------#
# Unlimited Sidebars
#-----------------------------------------------------------------#

if (!empty($mobius['unlimited_sidebar'])) {	
	if(isset($mobius['unlimited_sidebar']) && sizeof($mobius['unlimited_sidebar']) > 0) {
		foreach($mobius['unlimited_sidebar'] as $sidebar) {
			if (isset($sidebar) && !empty($sidebar)) {
				register_sidebar( array(
					'name' => $sidebar,
					'id' => themeone_generateSlug($sidebar, 45),
					'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget',
					'after_widget'  => '</div>',
					'before_title'  => '<h4>',
					'after_title'   => '</h4>',
				));
			}
		}
	}
}

function themeone_generateSlug($phrase, $maxLength) {
    $result = strtolower($phrase);
    $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
    $result = trim(preg_replace("/[\s-]+/", " ", $result));
    $result = trim(substr($result, 0, $maxLength));
    $result = preg_replace("/\s/", "-", $result);
    return $result;
}

#-----------------------------------------------------------------#
# Enable Shortcode in Text Widget
#-----------------------------------------------------------------#

add_filter('widget_text', 'themeone_php_text', 99);
function themeone_php_text($text) {
	if (strpos($text, '<' . '?') !== false) {
		ob_start();
		themeone_fakeEval('?' . '>' . $text);
		$text = ob_get_contents();
		ob_end_clean();
	}
	return $text;
}
add_filter('widget_text', 'do_shortcode');

#-----------------------------------------------------------------#
# Custom Comment System
#-----------------------------------------------------------------#

function themeone_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			printf( __('%1$s at %2$s', 'mobius' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mobius' ), '  ', '' );
		?>
	</div>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 70); ?>
	<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mobius' ); ?></em>
		<br />
	<?php endif; ?>

	

	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

#-----------------------------------------------------------------#
# Back Button Portfolio Items
#-----------------------------------------------------------------#

function themeone_back_button($post_id) {
    global $wpdb;
	$page_id = null;
    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php'");  
    foreach ($results as $result) {
		$page_id = $result->post_id;
    }
    return get_page_link($page_id);
} 

#-----------------------------------------------------------------#
# BreadCrumbs PageNav
#-----------------------------------------------------------------#

function themeone_breadcrumbs() {
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = '&nbsp;/&nbsp;'; // delimiter between crumbs
	$home        = __('Home', 'mobius'); // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	
	if (class_exists('Woocommerce')) {
		global $woocommerce;
		if($woocommerce && (is_product() || is_shop())) {
			do_action('woo_custom_breadcrumb');
			return;
		}
	}
	
	global $post;
	$homeLink = esc_url(home_url());
	
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) {
		echo '<div id="to-crumbs"><a href="' . $homeLink . '"><i class="steadysets-icon-map-marker"></i>' . $home . '</a></div>';
		}
	} else {
		echo '<div id="to-crumbs"><a href="' . $homeLink . '"><i class="steadysets-icon-map-marker"></i>' . $home . '</a> ' . $delimiter . ' ';
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			}
			echo $before . __('Archive by category "', 'mobius') . single_cat_title('', false) . '"' . $after;
		} elseif ( is_search() ) {
			echo $before . __('Search results for "', 'mobius') . get_search_query() . '"' . $after;
  
		} elseif ( is_day() ) {
			echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if ($showCurrent == 1) {
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}
		} else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) {
				$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			}
			echo $cats;
			if ($showCurrent == 1) {
				echo $before . get_the_title() . $after;
			}
		}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) {
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			}
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) {
				echo $before . get_the_title() . $after;
			}
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo $breadcrumbs[$i];
			if ($i != count($breadcrumbs)-1) {
				echo ' ' . $delimiter . ' ';
			}
		}
		if ($showCurrent == 1) {
			echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		}
		} elseif ( is_tag() ) {
			echo $before . __('Posts tagged "', 'mobius') . single_tag_title('', false) . '"' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . __('Articles posted by ', 'mobius') . $userdata->display_name . $after;
		} elseif ( is_404() ) {
			echo $before . __('Error 404', 'mobius') . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' (';
			}
			echo __(' Page', 'mobius') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ')';
			}
		}
		echo '</div>';
	}
}

#-----------------------------------------------------------------#
# Navigation pages
#-----------------------------------------------------------------#

function themeone_page_nav() {

	if(is_singular()) {
		return;
	}
	
	global $wp_query;
	if( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="to-page-nav section-container"><ul>' . "\n";
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-angle-left"></i>') );
	}
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link( 1 )), '1' );
		if ( ! in_array( 2, $links ) ) {
			echo '<li class="to-page-nav-dot">...</li>';
		}
	}
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link );
	}
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li class="to-page-nav-dot">...</li>' . "\n";
		}
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max );
	}
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fa fa-angle-right"></i>') );
	}
	echo '</ul></div>' . "\n";
}

#-----------------------------------------------------------------#
# Navigation pages in single post
#-----------------------------------------------------------------#

function themeone_single_page_nav() {
	$paged_page_nav = wp_link_pages( 
		array( 
			'before' =>'<div class="to-page-nav"><ul>', 
			'after' => '</div></ul>', 
			'link_before' => '<span>', 
			'link_after' => '</span>', 
			'echo' => false 
		) 
	); 
	$paged_page_nav = str_replace( '<a', '<li><a', $paged_page_nav ); 
	$paged_page_nav = str_replace( '</span></a>', '</a></li>', $paged_page_nav );
	$paged_page_nav = str_replace( '"><span>', '">', $paged_page_nav ); 
    
	$paged_page_nav = str_replace( '<span>', '<li class="active"><a>', $paged_page_nav ); 
	$paged_page_nav = str_replace( '</span>', '</a></li>', $paged_page_nav ); 
	echo $paged_page_nav;
}

#-----------------------------------------------------------------#
# Grab Gallery Images
#-----------------------------------------------------------------#

function themeone_grab_ids_from_gallery() {
	global $post;
	if($post != null) {
		$attachment_ids = array();
		$pattern = get_shortcode_regex();
		$ids = array();
				
		if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) { 
			$count=count($matches[3]);
			for ($i = 0; $i < $count; $i++){
				$atts = shortcode_parse_atts( $matches[3][$i] );
				if ( isset( $atts['ids'] ) ){
					$attachment_ids = explode( ',', $atts['ids'] );
					$ids = array_merge($ids, $attachment_ids);
				}
			}
		}
		return $ids;
	}
}
if (!is_admin() && shortcode_exists('gallery')) {
	add_action('wp', 'themeone_grab_ids_from_gallery');
}

#-----------------------------------------------------------------#
# Replace Gallery Images From Content
#-----------------------------------------------------------------#

function parse_gallery_shortcode($output, $attr) {
	global $post;
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }
    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array(
							'include' => $include,
							'post_status' => 'inherit',
							'post_type' => 'attachment',
							'post_mime_type' => 'image',
							'order' => $order,
							'orderby' => $orderby)
						);
        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) {
		return '';
	}
	
	global $mobius;
	if (isset($mobius['grid-gallery']) && $mobius['grid-gallery']) {
		
		if ($columns > 4 || $columns < 2) {
			$col1600 = ($columns-1 > 0) ? $columns-1 : 1;
			$col1280 = ($col1600-1 > 0) ? $col1600-1 : 1;
			$col1000 = ($col1280-1 > 0) ? $col1280-1 : 1;
			$col960 = ($col1000-1 > 0) ? $col1000-1 : 1;
		} else {
			$col1600 = $columns;
			$col1280 = $col1600;
			$col1000 = ($col1280-1 > 0) ? $col1280-1 : 1;
			$col960 = ($col1000-1 > 0) ? $col1000-1 : 1;	
		}
		
		
		$output = '<div class="to-grid-container to-masonry clearfix wordpress-gallery" data-grid-type="masonry" data-type="portfolio" data-orderby="" data-rownb="2" data-colsup="'.$columns.'" data-col1600="'.$col1600.'" data-col1280="'.$col1280.'" data-col1000="'.$col1000.'" data-col960="'.$col960.'" data-ratio="0.7" data-gutter="2" data-postsize="" data-portsize="" data-portstyle="" data-hlayout="">';
			$output .= '<div class="to-grid-scroll vertical" style="min-width:1182px !important">	';
				$output .= '<div class="to-grid-holder vertical clearfix">';
				foreach ($attachments as $id => $attachment) {
					$img = wp_get_attachment_image_src($id, $size);
					$lb  = wp_get_attachment_image_src($id, 'full');
					$alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
					$alt = (empty($alt)) ? get_the_title($id) : $alt;
					$output .= '<div class="to-item portfolio tall">';
						$output .= '<div class="to-item-wrapper" style="margin: 2px;">';
							$output .= '<img src="'. $img[0] .'" width="'. $img[1] .'" height="'. $img[2] .'"/>';
							$output .= '<div class="to-item-lightbox-link" data-img-src="'.$lb[0].'" data-img-title="'.$alt.'" ></div>';
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	
	} else {

		$output = '<ul class="post-gallery-slider">';
		foreach ($attachments as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			$output .= '<li class="gallery-slide">';
			$output .= '<img src="'. $img[0] .'" width="'. $img[1] .'" height="'. $img[2] .'"/>';
			$output .= '</li>';
		}
		$output .= '</ul>';
	}

    
    return $output;
}
add_filter('post_gallery', 'parse_gallery_shortcode', 10, 2);

#-----------------------------------------------------------------#
# Add Author Links
#-----------------------------------------------------------------#

function themeone_add_author_link( $contactmethods ) {
	
	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	$contactmethods['dribbble_profile'] = 'Dribbble Profile URL';
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'themeone_add_author_link', 10, 1);

function themeone_to_author_link() {
	
	$rss_url = get_the_author_meta( 'rss_url' );
	$facebook_profile = get_the_author_meta( 'facebook_profile' );
	$twitter_profile  = get_the_author_meta( 'twitter_profile' );
	$google_profile   = get_the_author_meta( 'google_profile' );
	$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
	$dribbble_profile = get_the_author_meta( 'dribbble_profile' );
	
	if ( $rss_url && $rss_url != '' ||
		 $facebook_profile && $facebook_profile != '' ||
		 $twitter_profile && $twitter_profile != '' ||
		 $google_profile && $google_profile != '' ||
		 $linkedin_profile && $linkedin_profile != '' ||
		 $dribbble_profile && $dribbble_profile != '' ) {
			 
		echo '<ul id="to-author-icons">';
			
			if ( $rss_url && $rss_url != '' ) {
				echo '<li class="rss">';
				echo '<a href="' . esc_url($rss_url) . '" target="_blank">';
				echo '<i class="fa fa-rss"></i>';
				echo '</a>';
				echo '</li>';
			}
			if ( $facebook_profile && $facebook_profile != '' ) {
				echo '<li class="facebook">';
				echo '<a href="' . esc_url($facebook_profile) . '" target="_blank">';
				echo '<i class="fa fa-facebook"></i>';
				echo '</a>';
				echo '</li>';
			}
			if ( $twitter_profile && $twitter_profile != '' ) {
				echo '<li class="twitter">';
				echo '<a href="' . esc_url($twitter_profile) . '" target="_blank">';
				echo '<i class="fa fa-twitter"></i>';
				echo '</a>';
				echo '</li>';
			}
			if ( $google_profile && $google_profile != '' ) {
				echo '<li class="google">';
				echo '<a href="' . esc_url($google_profile) . '" rel="author" target="_blank">';
				echo '<i class="fa fa-google-plus"></i>';
				echo '</a>';
				echo '</li>';
			}
			if ( $linkedin_profile && $linkedin_profile != '' ) {
				echo '<li class="linkedin">';
				echo '<a href="' . esc_url($linkedin_profile) . '" target="_blank">';
				echo '<i class="fa fa-linkedin"></i>';
				echo '</a>';
				echo '</li>';
			}
			if ( $dribbble_profile && $dribbble_profile != '' ) {
				echo '<li class="dribbble">';
				echo '<a href="' . esc_url($dribbble_profile) . '" target="_blank">';
				echo '<i class="fa fa-dribbble"></i>';
				echo '</a>';
				echo '</li>';
			}
		echo '</ul>';
		
	}
}

#-----------------------------------------------------------------#
# Page Header
#-----------------------------------------------------------------# 

if ( !function_exists( 'themeone_page_header' ) ) {
    function themeone_page_header($post_id) {
		global $mobius;
    	$header_title     = get_post_meta($post_id, 'themeone-header-title', true);
    	$header_stitle    = get_post_meta($post_id, 'themeone-header-subtitle', true);
		$header_color     = get_post_meta($post_id, 'themeone-header-color', true);
		$header_bgcolor   = get_post_meta($post_id, 'themeone-header-bgcolor', true);
		$header_txt_align = get_post_meta($post_id, 'themeone-header-txt-align', true);
		$header_height    = get_post_meta($post_id, 'themeone-header-height', true); 
		$header_img       = get_post_meta($post_id, 'themeone-header-image', true);
		$header_align     = get_post_meta($post_id, 'themeone-header-image-alignment', true);		
		$header_trans     = get_post_meta($post_id, 'themeone-header-transparent', true);		
		$header_repeat    = get_post_meta($post_id, 'themeone-header-repeat', true);
		$header_para      = get_post_meta($post_id, 'themeone-header-parallax', true);
		$header_menu      = get_post_meta($post_id, 'themeone-header-menu', true);
		$header_particles = get_post_meta($post_id, 'themeone-header-particle', true);
		$header_type      = null; 
		$meta_cat         = null;
		$header_meta      = null;
		$header           = null;
		$header_noBorder  = null;
		$header_padding   = 40;
		
		if (is_singular('post') && empty($header_img) && empty($header_bgcolor) && !empty($mobius['blog-header-active'])) {
			$header_img     = $mobius['blog-header-image']['url'];
			$header_color   = (!empty($mobius['blog-header-color']) ? $mobius['blog-header-color'] : 'dark');
			$header_bgcolor = (!empty($mobius['blog-header-bgcolor']) ? $mobius['blog-header-bgcolor'] : null);
			$header_align   = (!empty($mobius['blog-header-image-alignment']) ? $mobius['blog-header-image-alignment'] : 'top');
			$header_trans   = (!empty($mobius['blog-header-transparent']) ? 'true' : null);
			$header_repeat  = (!empty($mobius['blog-header-repeat']) ? $mobius['blog-header-repeat'] : null);
			$header_para    = (!empty($mobius['blog-header-parallax']) ? 'true' : null);
		}
		
		if (is_singular('portfolio') && empty($header_img) && empty($header_bgcolor) && !empty($mobius['portfolio-header-active'])) {
			$header_img     = $mobius['portfolio-header-image']['url'];
			$header_color   = (!empty($mobius['portfolio-header-color']) ? $mobius['portfolio-header-color'] : 'dark');
			$header_bgcolor = (!empty($mobius['portfolio-header-bgcolor']) ? $mobius['portfolio-header-bgcolor'] : null);
			$header_align   = (!empty($mobius['portfolio-header-image-alignment']) ? $mobius['portfolio-header-image-alignment'] : 'top');
			$header_trans   = (!empty($mobius['portfolio-header-transparent']) ? 'true' : null);
			$header_repeat  = (!empty($mobius['portfolio-header-repeat']) ? $mobius['portfolio-header-repeat'] : null);
			$header_para    = (!empty($mobius['portfolio-header-parallax']) ? 'true' : null);
		}
		
		if ($header_bgcolor != null) {
			$header_bgcolor = 'background-color:'.$header_bgcolor;
		}
		if ($header_txt_align == null) {
			$header_txt_align = 'left';
		}
		if ($header_para != null) {
			$header_para = 'paratrue';
		}
		if ($header_repeat != null) {
			$header_repeat = 'repeat';
		} else {
			$header_repeat = 'no-repeat';
		}
		if ($header_img != null) {
			$header_noBorder = 'no-border to-page-heading-img-true';
			$header_img = '<div id="header-image" style="background-image:url('. esc_url($header_img) .');background-position: center '. $header_align .';" class="to-header-image '. $header_repeat .'"></div>';
		}
		if ($header_title != null) {
			$header_title = '<h1 class="title">'. html_entity_decode($header_title) .'</h1>';
		}
		if ($header_stitle != null) {
			$header_stitle = '<span class="subtitle '. get_post_type($post_id) .'">'. html_entity_decode($header_stitle) .'</span>';
			$header_padding = $header_padding + 34;
		}
		if ($header_height != null) {
			if ($header_height > $header_padding+80) {
				$header_height = floor(($header_height-$header_padding)/2);
				$header_height = 'style="padding:'. $header_height .'px 0;'. $header_bgcolor .'"';
			} else {
				$header_height = null;
				$header_height = 'style="'. $header_bgcolor .'"';
			}
		}
		
		if ( is_singular('post') || is_singular('portfolio') ) {
			$header_title  = $meta_cat;
			$header_title .= '<h1 class="single-title">'. get_the_title() .'</h1>';
			ob_start();
			$header_meta = themeone_single_meta();
			$output_meta = ob_get_contents();
			ob_end_clean();
			$header_meta = $output_meta;
		} else {
			$header_type = 'standard';
		}
		
		if ( is_singular('post') && $mobius['blog-breadcrumb'] || is_singular('portfolio') && $mobius['portfolio-breadcrumb']) {
			$header_menu = true;
		}
		
		if ($header_img != '' || $header_title != '') {
			$header  = '<div class="to-page-heading '. $header_para .' '. $header_color .' '. $header_txt_align .' '. $header_type .' '. $header_noBorder .'" '. $header_height .' data-header-color="'. esc_attr($header_color) .'" data-transparent="'. esc_attr($header_trans) .'">';	
			$header .= $header_img;
			if ($header_particles) {
				$header .= '<div id="particles"></div>';
			}
			$header .= '<div class="section-container">';
			$header .= '<div class="col col-12 col-last">';
			$header .= '<div class="col col-6 col-last">';
			$header .= $header_title;
			$header .= $header_stitle;
			$header .= $header_meta;
			$header .= '</div>';
			$header .= '</div>';
			$header .= '</div>';
			$header .= '</div>';
		}

		echo $header;
		
		if ($header_menu != null || is_singular('product')) {
			ob_start();
			$breadcrumbs_menu = themeone_breadcrumbs();
			$output_string = ob_get_contents();
			ob_end_clean();
			$header_menu  = '<div class="section-container">';
			$header_menu .= '<div id="to-crumbs-overlay"></div>';
			$header_menu .= $output_string;
			$header_menu .= '</div>';
			echo $header_menu;
		}
	
	}
}

#-----------------------------------------------------------------#
# Single Post Meta Informations
#-----------------------------------------------------------------#

function themeone_prev_next_links($post_id) {
	if (is_singular('portfolio')) {
		$prevtxt   = __('Prev item', 'mobius');
		$nexttxt   = __('Next item', 'mobius');
		$backLink  = esc_url(themeone_back_button($post_id));
		$backLink  = '<div id="post-all-items" class="accentColorHover"><a href="'. $backLink .'"><i class="icon-to-back accentColorHover"></i></a></div>';
	} else {
		$prevtxt   = __('Prev reading', 'mobius');
		$nexttxt   = __('Next reading', 'mobius');
		$backLink  = null;
	}
	$prev      = '<span class="post-nav-prev">'.$prevtxt.'</span>';
	$prevLink  = get_next_post_link('%link',$prev.'<h3>'.'%title'.'</h3>');
	$next      = '<span class="post-nav-next">'.$nexttxt.'</span>';
	$nextLink  = get_previous_post_link('%link',$next.'<h3>'.'%title'.'</h3>');
	$post_nav  = '<div id="post-nav">';   
	$post_nav .= '<div class="section-container">';                           
	$post_nav .= '<div id="post-prev-link" class="accentColorHover">'. $prevLink .'</div>';
	$post_nav .= '<div id="post-next-link" class="accentColorHover">'. $nextLink .'</div> ';
	$post_nav .= $backLink;
	$post_nav .= '</div>';		
	$post_nav .= '</div>';
	echo $post_nav;
}

#-----------------------------------------------------------------#
# Single Post Meta Informations
#-----------------------------------------------------------------#

if ( !function_exists( 'themeone_single_meta' ) ) {
    function themeone_single_meta() {
		global $mobius;
		$comments = null;
		$num_comments = get_comments_number();
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __('No Comments', 'mobius');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments', 'mobius');
			} else {
				$comments = __('1 Comment', 'mobius');
			}
		}
		
		if (is_singular('post')) {
			$meta_info  = '<div id="single-post-information">';
		} else if (is_singular('portfolio')) {
			$meta_info  = '<div id="single-port-information">';
		} else {
			$meta_info  = '<div class="post-information">';
		}
		
		global $post;
    	$author_id= $post->post_author;
		
		$avatar = null;
		if (function_exists('get_avatar') && is_singular('post')) { 
			$avatar = '<span class="meta-author-avatar">'.get_avatar( get_the_author_meta('ID', $author_id), '50' ).'</span>'; 
		}
		
		$meta_info .= $avatar;
		$meta_info .= '<span class="meta-author vcard author">';
		$meta_info .= __('By ', 'mobius');
		$meta_info .= '<a href="'. esc_url(get_author_posts_url( $author_id )) .'">';
		$meta_info .= get_the_author_meta( 'display_name', $author_id );
		$meta_info .= '</a>' ;
		$meta_info .= '</span> ';
		
		if (get_the_category_list() != '' && !is_single()) { 
			$meta_info .= '<span class="meta-category">';
			$meta_info .= '<i class="business-box-open"></i>';
			$meta_info .= get_the_category_list(', ');
			$meta_info .= '</span>';
		}
		if (is_single() ||is_search() || is_archive()) {
			$meta_info .= '<span class="meta-date date updated">';
			$meta_info .= '<i class="fa fa-bookmark-o"></i>';
			$meta_info .= human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago', 'mobius') ;//get_the_time(get_option('date_format'));
			$meta_info .= '</span>';
		}
		if (is_singular('portfolio') && $mobius['portfolio-comment'] && isset($comments) || !is_singular('portfolio') && isset($comments)) {
			$meta_info .= '<span class="meta-comment-count">';
			$meta_info .= '<a href="'. esc_url(get_comments_link()) .'">';
			$meta_info .= '<i class="fa fa-comment-o"></i>';
			$meta_info .= $comments;
			$meta_info .= '</a>' ;
			$meta_info .= '</span>';
		}
		if (!is_single()) {
			$meta_info .= getPostLikeLink(get_the_ID());
		}
		$meta_info .= '</div>';
		
		echo $meta_info;
	}
}

#-----------------------------------------------------------------#
# Shorthand Values 
#-----------------------------------------------------------------#

function themeone_val_abbr($n, $p = 1) {
	$n = intval (preg_replace('/[^0-9]/','',$n));
	if ($n < 1000) {
        $n_format = number_format($n);
    } else if ($n < 1000000) {
        $n_format = number_format($n / 1000, $p) . 'K';
    } else if ($n < 1000000000) {
        $n_format = number_format($n / 1000000, $p) . 'M';
    } else {
        $n_format = number_format($n / 1000000000, $p) . 'B';
    }
	return $n_format;
}

#-----------------------------------------------------------------#
# Social Share Button
#-----------------------------------------------------------------#

function themeone_getPlus1($url) {
	libxml_use_internal_errors(true);
    $html  =  file_get_contents( "https://plusone.google.com/_/+1/fastbutton?url=".urlencode($url));
    $doc   = new DOMDocument();
	$doc->loadHTML($html);
    $count = $doc->getElementById('aggregateCount')->nodeValue;
	libxml_use_internal_errors(false);
    return intval (preg_replace('/[^0-9]/','',$count));
}

function themeone_getTweets($url){
    $json  = file_get_contents( "http://urls.api.twitter.com/1/urls/count.json?url=".$url );
    $ajsn  = json_decode($json, true);
    $count = $ajsn['count'];
    return $count;
}

function themeone_getPins($url){
    $json  = file_get_contents( "http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=".$url );
    $json  = substr( $json, 13, -1);
    $ajsn  = json_decode($json, true);
    $count = $ajsn['count'];
    return $count;
}

function themeone_getFacebooks($url) { 
    $xml      = file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($url));
    $xml      = simplexml_load_string($xml);
    $shares   = $xml->link_stat->share_count;
    $likes    = $xml->link_stat->like_count;
    $comments = $xml->link_stat->comment_count; 
	$count    = $likes + $shares + $comments;
    return $count;
}

add_action( 'wp_ajax_share_counter', 'themeone__share_counter' );  
add_action( 'wp_ajax_nopriv_share_counter', 'themeone__share_counter' );
function themeone__share_counter() {
	$url       = $_POST['url'];
	$google1   = themeone_getPlus1($url);
	$twitter   = themeone_getTweets($url);
	$pinterest = themeone_getPins($url);
	$facebook  = themeone_getFacebooks($url);
	$total     = $google1+$twitter+$pinterest+$facebook;
	$count     = array(
					'google'    => themeone_val_abbr($google1),
					'twitter'   => themeone_val_abbr($twitter),
					'pinterest' => themeone_val_abbr($pinterest),
					'facebook'  => themeone_val_abbr($facebook),
					'total'     => themeone_val_abbr($total)
				);
	echo json_encode($count);
	exit;
}

if ( !function_exists( 'themeone_share' ) ) {
	function themeone_share($ID) {
		$toShare  = '<div class="to-social">';
		$toShare .= '<div class="to-social-overlay"></div>';
    	$toShare .= '<div class="to-social-holder">';
		if (is_singular('post')) {
    		$toWhat = __('this post', 'mobius');
			$toLike = getPostLikeLink($ID);
		} else if (is_singular('product')) {
    		$toWhat = __('this product', 'mobius');
			$toLike = null;
		} else if (is_singular('portfolio')) {
			$toWhat = __('this work', 'mobius');
			$toLike = getPostLikeLink($ID);
		}
		$toShare .= '<div class="to-social-msg">';
		$toShare .= '<div class="to-social-share">'. __('Share', 'mobius').' '. $toWhat .'</div>';
		$toShare .= '<div class="to-social-shared">'. $toWhat .' '. __('was shared', 'mobius').' <span class="count">0</span> '. __('times', 'mobius').'</div>';
		$toShare .= '</div>';
    	$toShare .= '<div class="to-social-list">';
    	$toShare .= $toLike;
		$toShare .= '<span class="facebook-share to-social-button" title="Share this"><i class="fa fa-facebook accentColor"></i><span class="count">0</span></span>';
		$toShare .= '<span class="pinterest-share to-social-button" title="Pin this"><i class="fa fa-pinterest accentColor"></i><span class="count">0</span></span>';
		$toShare .= '<span class="google-share to-social-button" title="Share this"><i class="fa fa-google-plus accentColor"></i><span class="count">0</span></span>';
    	$toShare .= '<span class="twitter-share to-social-button" title="Tweet this"><i class="fa fa-twitter accentColor"></i><span class="count">0</span></span>';
    	$toShare .= '</div>';
    	$toShare .= '</div>';
    	$toShare .= '</div>';
		
		echo $toShare;
	}
}

#-----------------------------------------------------------------#
# Themeone Slider Init
#-----------------------------------------------------------------#

if ( !function_exists( 'themeone_slider_init' ) ) {
    function themeone_slider_init() {
	
	/*** get the slider and slides ID ***/
	if(is_home()) {
		$ID = get_queried_object_id();
	} else {
		$ID = get_the_ID();
	}

	if (class_exists('Woocommerce')) {
		if(is_shop() || is_product_category() || is_product_tag()) {
			$ID = woocommerce_get_page_id('shop');
		}
	}
	$slider_id = get_post_meta($ID, 'themeone-get-slider', true);	
	$slides    = get_post_meta($slider_id, 'themeone-slider-slides', true);

	/*** Output revSlider if exist ***/
	if (class_exists('RevSlider')) {
		
		$revSlider = str_replace('-revSlider', '', $slider_id);
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		$title = array();
        $alias = array();
		foreach($arrSliders as $slider){
            $title[] = $slider->getTitle();
            $alias[] = $slider->getAlias();
        }
		if($title && $alias){
            $revSliders = array_combine($alias, $title);
        }

		if (!empty($revSliders) && is_array($revSliders) && in_array($revSlider, $revSliders)) {
			$slider =  array_search($revSlider, $revSliders);
			if (isset($slider) && !empty($slider)) {
				putRevSlider($slider);
			}
		}
	}
	
	if ($slides != null) {
		
		/*** get the slider options ***/
		$slider_full_height = esc_attr(get_post_meta($slider_id, 'themeone-slider-full-height', true));
		$slider_height      = esc_attr(get_post_meta($slider_id, 'themeone-slider-height', true));
		$slider_timer       = esc_attr(get_post_meta($slider_id, 'themeone-slider-timer', true));
		$slider_time_bar    = esc_attr(get_post_meta($slider_id, 'themeone-slider-time-bar', true));
		$slider_time        = esc_attr(get_post_meta($slider_id, 'themeone-slider-time', true));
		$slider_parallax    = esc_attr(get_post_meta($slider_id, 'themeone-slider-parallax', true));
		$slider_transparent = esc_attr(get_post_meta($slider_id, 'themeone-slider-transparent', true));
		$slider_scrollto    = esc_attr(get_post_meta($slider_id, 'themeone-slider-scrollto', true));
		
	
		$to_slider  = '<div id="to-slider" data-min-height="'. $slider_height .'" data-transparent="'. $slider_transparent .'" data-full-height="'. $slider_full_height .'" data-time="'. $slider_time .'" data-timer="'. $slider_timer .'" data-time-bar="'. $slider_time_bar .'" data-parallax="'. $slider_parallax .'" >';
		$to_slider .= '<div id="to-slider-parallax">';
		$to_slider .= '<ul id="to-slider-holder">';
		
		$ids = explode(",", $slides);
		foreach($ids as $id) {
			
			$slide_id = $id;
			
			/*** get slide content ***/
			$to_video          = null;
			$to_button         = null;
			$slide_over        = null;
			$slide_img         = esc_url(get_post_meta($slide_id, 'themeone-slide-image', true));
			$slide_img_align   = esc_attr(get_post_meta($slide_id, 'themeone-slide-image-alignment', true));
			$slide_pattern     = esc_url(get_post_meta($slide_id, 'themeone-slide-pattern', true));
			$slide_over_bg     = esc_attr(get_post_meta($slide_id, 'themeone-slide-overlay-bg', true));
			$slide_over_op     = esc_attr(get_post_meta($slide_id, 'themeone-slide-overlay-opacity', true));
			$slide_title       = get_post_meta($slide_id, 'themeone-slide-title', true);
			$slide_desc        = get_post_meta($slide_id, 'themeone-slide-desc', true);
			$slide_desc_bg     = esc_attr(get_post_meta($slide_id, 'themeone-slide-desc-bg', true));
			$slide_button_text = get_post_meta($slide_id, 'themeone-slide-button-text', true);
			$slide_button_link = esc_url(get_post_meta($slide_id, 'themeone-slide-button-link', true));
			$slide_alignment   = esc_attr(get_post_meta($slide_id, 'themeone-slide-alignment', true));
			$slide_color       = esc_attr(get_post_meta($slide_id, 'themeone-slide-color', true));
			$slide_rotate_txt  = esc_attr(get_post_meta($slide_id, 'themeone-slide-rotate-txt', true));
			$slide_m4v         = esc_url(get_post_meta($slide_id, 'themeone-slide-m4v', true));
			$slide_webm        = esc_url(get_post_meta($slide_id, 'themeone-slide-webm', true));
			$slide_ogv         = esc_url(get_post_meta($slide_id, 'themeone-slide-ogv', true));
			$slide_youtube     = esc_attr(get_post_meta($slide_id, 'themeone-slide-youtube', true));
			$slide_vimeo       = esc_attr(get_post_meta($slide_id, 'themeone-slide-vimeo', true));
			$slide_video_vol   = esc_attr(get_post_meta($slide_id, 'themeone-slide-video-volume', true));
			
			$slide_img = '<div class="to-slide-image" style="background-image: url('. $slide_img .');background-position: center '. $slide_img_align .'"></div>';	

			if ($slide_youtube != null) {
				$to_video = '<div class="to-slide-youtube" data-youtube-url="'. $slide_youtube .'"></div>';
				if(!wp_is_mobile()) {
					$slide_img = null;
				}
			} else if ($slide_vimeo != null) {
				$slide_vimeo = themeone_parse_vimeo($slide_vimeo);
				$hash     = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$slide_vimeo.php"));
				$width    = esc_attr($hash[0]['width']); 
				$height   = esc_attr($hash[0]['height']);
				$to_video = '<iframe data-height="'. $height .'" data-width="'. $width .'" style="width:'. $width .'px;height:'. $height .'px;" class="vimeo-player" src="//player.vimeo.com/video/'. $slide_vimeo .'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;autoplay=1&amp;loop=1"></iframe>';
				if(!wp_is_mobile()) {
					$slide_img = null;
				}
			} else if ($slide_m4v != null || $slide_ogv != null) {
				$to_video  = '<div class="loading-text">loading</div>';
				$to_video .= '<div class="to-slide-video">';
				$to_video .= '<video controls  preload="auto" loop="true" autoplay="true" muted="true">';
				if ($slide_m4v != null) {
					$to_video .= '<source type="video/mp4" src="'. $slide_m4v .'" />';
				}
				if ($slide_webm != null) {
					$to_video .= '<source type="video/webm" src="'. $slide_webm .'" />';
				}
				if ($slide_ogv != null) {
					$to_video .= '<source type="video/ogg" src="'. $slide_ogv .'" />';
				}
				$to_video .= '</video>';
				$to_video .= '</div>';
			}
			
			if ($slide_button_text != null) {
				$to_button = '<a target="_self" class="to-button regular standard full-rounded to-button-border" href="'. $slide_button_link .'">'. $slide_button_text .'</a>';
			}
			
			if ($slide_desc_bg != null) {
				$slide_desc = '<div class="slide-desc-overlay">'. $slide_desc .'</div>';
			}
			
			if ($slide_pattern != null) {
				$slide_pattern = '<div class="to-slide-overlay" style="background-image: url('. $slide_pattern .')"></div>';
			} else {
				$slide_pattern = '<div class="to-slide-overlay"></div>';
			}
			
			if ($slide_over_bg != null && $slide_over_op != null) {
				$slide_over = '<div class="to-slide-overlay" style="background: '. $slide_over_bg.';opacity:'. $slide_over_op .';filter: Alpha(Opacity='. $slide_over_op*100  .')"></div>';
			}
			if ($slide_title != null) {
				$slide_title = '<h1>'. $slide_title .'</h1>';
			}
			
			$to_slider .= '<li data-slide-color="'. $slide_color .'" class="to-slide '. $slide_color .' '. $slide_alignment .'" data-volume="'. $slide_video_vol .'">';
			$to_slider .= $to_video;
			$to_slider .= $slide_img;
			$to_slider .= $slide_over;
			$to_slider .= $slide_pattern;
			$to_slider .= '<div class="to-slide-content section-container">';
			$to_slider .= '<div class="to-slide-content-inner section-container">';
			if ($slide_rotate_txt != null) {
				$to_slider .= '<div class="to-slide-content-move">';
			}
			$to_slider .= $slide_title;
			$to_slider .= do_shortcode($slide_desc);
			$to_slider .= '<div>'. $to_button .'</div>';
			if ($slide_rotate_txt != null) {
				$to_slider .= '</div>';
			}
			$to_slider .= '</div>';
			$to_slider .= '</div>';
			$to_slider .= '</li>';
	
		}
		$to_slider .= '</ul>';
		$to_slider .= '<div id="to-slider-prev">';
		$to_slider .= '<div class="to-slider-page-overlay"></div>';
		$to_slider .= '<i class="icon-to-left-arrow-thin"></i>';
		$to_slider .= '<div class="to-slider-prev-pagenb">';
		$to_slider .= '<div class="to-slider-prevnb">1</div>';
		$to_slider .= '<div class="to-slider-separator">/</div>';
		$to_slider .= '<div class="to-slider-slidenb"></div>';
		$to_slider .= '</div>';
		$to_slider .= '</div>';
				
		$to_slider .= '<div id="to-slider-next">';
		$to_slider .= '<div class="to-slider-page-overlay"></div>';
		$to_slider .= '<i class="icon-to-right-arrow-thin"></i>';
		$to_slider .= '<div class="to-slider-next-pagenb">';
		$to_slider .= '<div class="to-slider-nextnb">3</div>';
		$to_slider .= '<div class="to-slider-separator">/</div>';
		$to_slider .= '<div class="to-slider-slidenb"></div>';
		$to_slider .= '</div>';
		$to_slider .= '</div>';
			
		$to_slider .= '</div>';
		
		if($slider_scrollto != null) {
			$to_slider .= '<div id="to-slider-scrollto"><i class="fa fa-angle-double-down icon-option"></i></div>';
		}
		
		$to_slider .= '<div id="to-slider-pages"></div>';
		$to_slider .= '<div id="to-slider-timer"></div>';
		$to_slider .= '</div>';
		
		echo $to_slider;
		
		}
	}
}

#-----------------------------------------------------------------#
# Fake Eval error correction
#-----------------------------------------------------------------#

function themeone_fakeEval($phpCode) {
    $tmpfname = tempnam("/tmp", "fakeEval");
    $handle = fopen($tmpfname, "w+");
    fwrite($handle, "<?php\n" . $phpCode);
    fclose($handle);
    include $tmpfname;
    unlink($tmpfname);
    return get_defined_vars();
}

#-----------------------------------------------------------------#
# Parse Youtube/Vimeo Video ID And Get Thumbnail From API
#-----------------------------------------------------------------#

function themeone_parse_vimeo($url) {
	$pattern = '~(?:<iframe [^>]*src=")?(?:https?:\/\/(?:[\w]+\.)*vimeo\.com(?:[\/\w]*\/videos?)?\/([0-9]+)[^\s]*)"?(?:[^>]*></iframe>)?(?:<p>.*</p>)?~ix';
	preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

function themeone_parse_youtube($url) {
    $pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

function themeone_video_thumbnail($post_id) {
	$thumbnail = get_post_meta($post_id, 'themeone-slide-image', true);
	$vimeo = get_post_meta($post_id, 'themeone-slide-vimeo', true);
	if ($vimeo != null) {
		$slide_vimeo = themeone_parse_vimeo($vimeo);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$slide_vimeo.php"));
		$thumbnail = $hash[0]['thumbnail_medium']; 
		
	}
	$youtube = get_post_meta($post_id, 'themeone-slide-youtube', true);
	if ($youtube != null) {
		$slide_youtube = themeone_parse_youtube($youtube);
		$thumbnail = "http://img.youtube.com/vi/$slide_youtube/sddefault.jpg"; 
	}
	return $thumbnail;
}

#-----------------------------------------------------------------#
# Woocommerce Support
#-----------------------------------------------------------------#

add_theme_support( 'woocommerce' );

#-----------------------------------------------------------------#
# Woocommerce Product per page
#-----------------------------------------------------------------#

function themeone_catalog_page_ordering() {
	$shop_page_url = get_permalink(woocommerce_get_page_id('shop'));
	echo '<div class="itemsorder">';
	echo '<span>'. __('Items Per Page', 'mobius' ) .':</span>';
    echo '<form action="'.esc_url($shop_page_url).'" method="POST" name="results-per-page" class="woocommerce-per-page">';
	if (isset($_POST['woocommerce-sort-by-columns'])) {
		$numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
	} else if (isset($_COOKIE['shop_pageResults'])) {
		$numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
	}
	if(empty($numberOfProductsPerPage)) {
		$numberOfProductsPerPage = 9;
	}
	echo '<div id="slider_per_page"></div>';
	echo '<input name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" value="'.$numberOfProductsPerPage.'" onchange="this.form.submit()">';
	echo '<button class="button" type="submit" >'. __('Show', 'mobius' ) .'</button>';
	echo '</form>';
	
	echo '</div>';
}
 
function themeone_sort_by_page($count) {
	$shop_page_url = get_permalink(woocommerce_get_page_id('shop'));
	if (isset($_COOKIE['shop_pageResults'])) {
		$count = $_COOKIE['shop_pageResults'];
	} 
	if (isset($_POST['woocommerce-sort-by-columns'])) {
		setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, $shop_page_url, false);
		$count = $_POST['woocommerce-sort-by-columns'];
	}
	if(empty($_COOKIE['shop_pageResults']) && empty($_POST['woocommerce-sort-by-columns'])) {
		$count = 9;
	}
	return $count;
}

if (isset($mobius['woo-per-page']) && $mobius['woo-per-page'] == 1 ) {
	add_filter('loop_shop_per_page','themeone_sort_by_page');
	add_action('woocommerce_before_shop_loop', 'themeone_catalog_page_ordering', 20);
} else {
	add_filter('loop_shop_per_page', create_function('$cols', 'return 9;'), 20);
}

#-----------------------------------------------------------------#
# Woocommerce Remove defaults woocommerce  style sheets
#-----------------------------------------------------------------#

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function themeone_enqueue_woocommerce_style(){
	if (class_exists('Woocommerce')) {
		wp_register_style('woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
		wp_enqueue_style('woocommerce');
	}
}
add_action( 'wp_enqueue_scripts', 'themeone_enqueue_woocommerce_style' );

#-----------------------------------------------------------------#
# Woocommerce Remove defaults woocommerce lightbox
#-----------------------------------------------------------------#

add_action( 'wp_enqueue_scripts', 'themeone_manage_woocommerce_styles', 99 );
function themeone_manage_woocommerce_styles() {
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	wp_dequeue_style( 'woocommerce_fancybox_styles' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_script( 'fancybox' );
}

#-----------------------------------------------------------------#
# Woocommerce Unregister/replace default woocommerce cart widget
#-----------------------------------------------------------------#

add_action( 'widgets_init', 'themeone_override_woocommerce_widgets', 15 );
function themeone_override_woocommerce_widgets() { 
  if ( class_exists( 'WC_Widget_Cart' ) ) {
    unregister_widget( 'WC_Widget_Cart' ); 
    include_once( 'includes/custom-widgets/widget-cart.php' );
    register_widget( 'WC_Widget_Cart' );
  } 
}

#-----------------------------------------------------------------#
# Woocommerce Wrap main woocommerce page content
#-----------------------------------------------------------------#

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'themeone_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'themeone_woo_wrapper_end', 10);
function themeone_woo_wrapper_start() {
	$page_id        = get_queried_object_id();
	$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
	$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
	$sidebar_margin = get_post_meta($page_id, 'themeone-sidebar-margintop', true);

	if(is_shop() || is_product_category() || is_product_tag()) {
		$page_id = woocommerce_get_page_id('shop');
		themeone_slider_init();
		$woocommerceClass = 'woocommerce-page';
	} else if (is_product()){
		$page_id = get_queried_object_id();
		$woocommerceClass = 'woocommerce-page single-product';
	} else {
		$page_id = get_queried_object_id();
		$woocommerceClass = null;
	}
	
	themeone_page_header($page_id);
	
	$page_color = get_post_meta($page_id, 'themeone-page-bgcolor', true);
	if (!empty($page_color)) {
		$page_color = 'style="background:'. $page_color .'"';
		echo '<div  '. $page_color .'>';
	}

	$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
	$shop_layout    = get_post_meta($page_id, 'themeone-sidebar-position', true);
	$sidebar_margin = get_post_meta($page_id, 'themeone-sidebar-margintop', true);
	
	if (empty($shop_layout)) {
		$shop_layout = 'right';
	}
	if (empty($sidebar)) {
		$shop_layout = null;
	}
	if (!empty($sidebar_margin)) {
		$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
	}
	
	echo '<div class="section-container woocommerce woocommerce-page">';
	
	switch($shop_layout) {
		case 'right':
			echo '<div id="post-area" class="col col-9">';
			break;
		case 'left':
			echo '<div id="sidebar" class="wooSidebar col col-3" '. $sidebar_margin .'>';
			dynamic_sidebar($sidebar);
			echo '</div>';
			echo '<div id="post-area" class="col col-9 col-last">';
			break;
	}
}
function themeone_woo_wrapper_end() {
	$page_id        = get_queried_object_id();
	$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
	$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
	$sidebar_margin = get_post_meta($page_id, 'themeone-sidebar-margintop', true);

	if(is_shop() || is_product_category() || is_product_tag()) {
		$page_id = woocommerce_get_page_id('shop');
		$woocommerceClass = 'woocommerce-page';
	} else if (is_product()){
		$page_id = get_queried_object_id();
		$woocommerceClass = 'woocommerce-page single-product';
	} else {
		$page_id = get_queried_object_id();
		$woocommerceClass = null;
	}
	
	$page_color     = get_post_meta($page_id, 'themeone-page-bgcolor', true);
	$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
	$shop_layout    = get_post_meta($page_id, 'themeone-sidebar-position', true);
	$sidebar_margin = get_post_meta($page_id, 'themeone-sidebar-margintop', true);
	
	if (empty($shop_layout)) {
		$shop_layout = 'right';
	}
	if (empty($sidebar)) {
		$shop_layout = null;
	}
	if (!empty($sidebar_margin)) {
		$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
	}
	switch($shop_layout) {
		case 'right':
			echo '</div>';
			echo '<div id="sidebar" class="wooSidebar col col-3 col-last" '. $sidebar_margin .'>';
			dynamic_sidebar($sidebar);
			echo '</div>';
			break;
		case 'left':
			echo '</div>';
			break;
	}
	
	echo '</div>';
	
	if (!empty($page_color)) {
		echo '</div>';
	}
}

#-----------------------------------------------------------------#
# Woocommerce Breadcrumb
#-----------------------------------------------------------------#

add_action( 'init', 'themeone_remove_wc_breadcrumbs' );
function themeone_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

function themeone_wc_custom_breadcrumb(){
    woocommerce_breadcrumb();
}
add_action( 'woo_custom_breadcrumb', 'themeone_wc_custom_breadcrumb' );

function themeone_wc_breadcrumbs() {
    return array(
            'delimiter'   => ' &nbsp;/&nbsp; ',
            'wrap_before' => '<div id="to-crumbs">',
            'wrap_after'  => '</div>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Shop', 'breadcrumb', 'woocommerce' ),
        );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'themeone_wc_breadcrumbs' );

add_filter( 'woocommerce_breadcrumb_home_url', 'themeone_wc_custom_breadrumb_home_url' );
function themeone_wc_custom_breadrumb_home_url() {
    return get_permalink(woocommerce_get_page_id('shop'));
}

add_filter( 'woocommerce_breadcrumb_defaults', 'themeone_change_breadcrumb_home_text' );
function themeone_change_breadcrumb_home_text( $defaults ) {
	$home = __('Home', 'mobius');
	$defaults['home'] = $home;
	return $defaults;
}

#-----------------------------------------------------------------#
# Woocommerce rating system
#-----------------------------------------------------------------#

function themeone_woo_star($id) {
	if (get_option('woocommerce_enable_review_rating') === 'no') {
		return;
	}
	global $wpdb;
    global $post;
    $count = $wpdb->get_var("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
		AND meta_value > 0
	");

	$rating = $wpdb->get_var("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
	");

	if ($count > 0) {
		$average = number_format($rating / $count, 2);
		echo '<div class="woocommerce-product-rating woocommerce-page">';
		echo '<div class="star-rating"><span style="width:'.(($average/5)*100 ).'%"></span></div>';
		if ($count > 1) {
			echo '<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><span itemprop="ratingCount" class="count">('. get_comments_number($id) . __("customer reviews", 'mobius' ) .')</span></a>';
		} else {
			echo '<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><span itemprop="ratingCount" class="count">('. get_comments_number($id) . __("customer review", 'mobius' ) .')</span></a>';
		}
		echo '</div>';
	} else {
		echo '<div class="woocommerce-product-rating woocommerce-page">';
		echo '<div class="star-rating"><span style="width:0%"></span></div>';
		echo '<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="ratingCount" class="count">'. __('no reviews yet', 'mobius' ) .'</span>)</a>';
		echo '</div>';
	}
}

#-----------------------------------------------------------------#
# Woocommerce Replace page navigation
#-----------------------------------------------------------------#

remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
add_action( 'woocommerce_pagination', 'themeone_wc_pagination', 10);
function themeone_wc_pagination() {
	themeone_page_nav();     
}

#-----------------------------------------------------------------#
# Woocommerce remove shop title
#-----------------------------------------------------------------#

add_filter( 'woocommerce_show_page_title' , 'themeone_wc_hide_page_title' );
function themeone_wc_hide_page_title() {	
	return false;	
}

#-----------------------------------------------------------------#
# Woocommerce Add Cart in header
#-----------------------------------------------------------------#

if (class_exists('Woocommerce')) {
	global $woocommerce;
	if ($woocommerce) {
		if( version_compare( $woocommerce->version, '2.3', '<' ) ) {
			add_filter('add_to_cart_fragments', 'themeone_wc_header_add_to_cart_fragment');
		} else {
			add_filter('woocommerce_add_to_cart_fragments', 'themeone_wc_header_add_to_cart_fragment');
		}
	}
}

function themeone_wc_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start(); 
	?>
    <a class="cart-link" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
		<i class="cart-icon fa fa-shopping-cart"></i>
		<span class="cart-number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	</a>
	<?php
	$fragments['a.cart-link'] = ob_get_clean();
	return $fragments;
}

#-----------------------------------------------------------------#
# Woocommerce Change add to cart position
#-----------------------------------------------------------------#

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

#-----------------------------------------------------------------#
# Woocommerce number of columns for shop page with sidebar
#-----------------------------------------------------------------#

if (class_exists('Woocommerce')) {
	$page_id = woocommerce_get_page_id('shop');
	$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
	if (!empty($sidebar)) {
		add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
		function wc_loop_shop_columns( $number_columns ) {
			return 3;
		}
	}
}

#-----------------------------------------------------------------#
# Woocommerce Wrap thumbnail product
#-----------------------------------------------------------------#

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action('woocommerce_before_shop_loop_item_title','themeone_product_title_link_open');
function themeone_product_title_link_open(){
	global $product;
	echo '<div class="product-img-wrap">';	
	echo woocommerce_get_product_thumbnail();	
	$attachment_ids = $product->get_gallery_attachment_ids();
	if ($attachment_ids) {
		$secondary_image_id = $attachment_ids['0'];
		echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array('class' => 'secondary-image attachment-shop-catalog'));
	}	
	echo '<div class="product-desc-wrap dark">';	
	echo '<div class="product-desc-overlay"></div>';
	echo '<a class="product-desc-link" href="'. get_the_permalink() .'"></a>';
	echo '<div class="product-desc-inner">';
	echo '<a class="product-desc-link" href="'. get_the_permalink() .'"></a>';
	echo '<a href="'. get_the_permalink() .'"><span class="price">'. $product->get_price_html() .'</span></a>';
}

add_action('woocommerce_after_shop_loop_item_title','themeone_product_title_link_close');
function themeone_product_title_link_close(){
	global $product, $yith_wcwl;
	
	echo '<div class="product-cat">'. $product->get_categories() .'</div>';
	echo woocommerce_template_loop_add_to_cart();
	if ($yith_wcwl) {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
	echo '</div>';
	echo '</div>';
	echo '<div class="loading"></div>';
	echo '</div>';
}

#-----------------------------------------------------------------#
# Woocommerce Wrap summary html markup (responsive column)
#-----------------------------------------------------------------#

add_action( 'woocommerce_before_single_product_summary', 'themeone_summary_div', 35);
add_action( 'woocommerce_after_single_product_summary',  'themeone_close_div', 4);
function themeone_summary_div() {
	echo "<div class='col-7 col col-last single-product-summary'>";
}
function themeone_close_div() {
	echo "</div>";
}

#-----------------------------------------------------------------#
# Woocommerce remove tab description header
#-----------------------------------------------------------------#

add_filter( 'woocommerce_product_description_heading', 'themeone_wc_change_product_description_tab_heading', 10, 1 );
add_filter( 'woocommerce_product_review_heading', 'themeone_wc_change_product_description_tab_heading', 10, 1 );
function themeone_wc_change_product_description_tab_heading( $title ) {
	return;
}	

#-----------------------------------------------------------------#
# Woocommerce Wrap single product image in div
#-----------------------------------------------------------------#

add_action( 'woocommerce_before_single_product_summary', 'themeone_images_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'themeone_close_div', 20);
function themeone_images_div() {
	echo "<div class='col-5 col single-product-main-image'>";
}

#-----------------------------------------------------------------#
# Woocommerce Add 8 related products on single product
#-----------------------------------------------------------------#

add_filter( 'woocommerce_related_products_args', 'themeone_wc_related_products_limit' );
function themeone_wc_related_products_limit() {
	global $product;
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> 6,
		'columns'               => 1,
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> 'rand',
	);
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'themeone_wc_related_products_args' );
function themeone_wc_related_products_args( $args ) {
	$args['posts_per_page'] = 8; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}

#-----------------------------------------------------------------#
# Woocommerce Image sizes
#-----------------------------------------------------------------#

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	add_action( 'init', 'themeone_wc_image_dimensions', 1 );
}
function themeone_wc_image_dimensions() {
	$catalog   = array('width' => '285', 'height'	=> '364', 'crop' => 1 ); 
	$single    = array('width' => '500', 'height' => '640', 'crop' => 1 );
	$thumbnail = array('width' => '100', 'height' => '100', 'crop' => 1 );
	update_option( 'shop_catalog_image_size', $catalog ); 
	update_option( 'shop_single_image_size', $single ); 
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

#-----------------------------------------------------------------#
# Woocommerce single featured product image
#-----------------------------------------------------------------#

add_filter('woocommerce_single_product_image_html', 'themeone_single_product_image_html', 10, 2);
function themeone_single_product_image_html( $html, $post_id ) {$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
	global $mobius;
	$image_title = esc_attr(get_the_title(get_post_thumbnail_id($post_id)));
	$image_link  = esc_url(wp_get_attachment_url(get_post_thumbnail_id($post_id)));
	$image       = get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('title' => $image_title, 'class' => 'small'));
	$magnify     = null;
	if ($mobius['woo-zoom']) {
		$magnify = 'magnify';
	}
	echo '<div class="'. $magnify .' inner-product-image">';
	echo '<div class="large" style="background: url('. esc_url(wp_get_attachment_url( get_post_thumbnail_id($post_id),'large')) .') no-repeat;"></div>';
	echo $image;
	echo '<div class="loading"></div>';
	echo '<div class="to-item-lightbox-link" data-img-src="'. esc_url(wp_get_attachment_url( get_post_thumbnail_id($post_id),'large')) .'" data-img-title="'. $image_title .'"></div>';
	echo '</div>';
}

#-----------------------------------------------------------------#
# Wrap gallery single product for slider
#-----------------------------------------------------------------#

add_filter( 'woocommerce_single_product_image_thumbnail_html', 'themeone_single_prod_thumbnail', 15, 4 );
function themeone_single_prod_thumbnail( $html, $attachment_id, $post_ID, $image_class ) {
	
	global $first;
	
	if (empty($image_first) && isset($attachment_id) && $first != true) {
		$image_thumb       = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), 'shop_thumbnail');
		$image_thumb       = esc_url($image_thumb[0]);
		$image_first       = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), 'shop_single');
		$image_first       = esc_url($image_first[0]);
		$image_full        = esc_url(wp_get_attachment_url( get_post_thumbnail_id($post_ID), 'large'));
		$image_first_full  = esc_url(wp_get_attachment_url(get_post_thumbnail_id($post_ID)));
		$image_first_title = esc_attr(get_the_title(get_post_thumbnail_id($post_ID)));
		$image_first = '<div class="product-gallery first" data-gallery-full="'.$image_full.'" data-gallery-img="'.$image_first.'" data-img-title="'.$image_first_title.'"><img width="100" height="100" src="'.$image_thumb.'" class="attachment-shop_thumbnail" alt="'.$image_first_title.'"></div>';
		$first = true;
		echo $image_first;
	}
		
	$image_link  = wp_get_attachment_image_src( $attachment_id, 'shop_single');
	$image_link  = esc_url($image_link[0]);
	$image_full  = esc_url(wp_get_attachment_url($attachment_id));
	$image_title = esc_attr(get_the_title(get_post_thumbnail_id($attachment_id)));
    $content = '<div class="product-gallery" data-gallery-img="'.$image_link.'" data-gallery-full="'.$image_full.'" data-img-title="'.$image_title.'">'.preg_replace('#(<[/]?a.*>)#U', '', $html).'</div>';
    echo $content;
}

#-----------------------------------------------------------------#
# WishList Counter
#-----------------------------------------------------------------#

if ($yith_wcwl) {
	add_action( 'wp_ajax_wishlist_counter', 'themeone_wishlist_counter' );  
	add_action( 'wp_ajax_nopriv_wishlist_counter', 'themeone_wishlist_counter' );
}
function themeone_wishlist_counter(){ 
	global $wpdb;
	echo yith_wcwl_count_products();
	exit;
}

#-----------------------------------------------------------------#
# Cart Counter
#-----------------------------------------------------------------#

add_action( 'wp_ajax_themeone_woocommerce_cart_counter', 'themeone_woocommerce_cart_counter' );  
add_action( 'wp_ajax_nopriv_themeone_woocommerce_cart_counter', 'themeone_woocommerce_cart_counter' );
function themeone_woocommerce_cart_counter() {
	global $woocommerce;
	$cart_counter = $woocommerce->cart->cart_contents_count;
	echo $cart_counter;
	die();
}

#-----------------------------------------------------------------#
# Related Posts for single post page
#-----------------------------------------------------------------#

function themeone_related_post($post){ 
	echo '<div class="to-related-posts">';
	echo '<div class="to-grid-container grid clearfix" data-grid-type="post" data-type="" data-orderby="" data-rowNb="1" data-colsup="4" data-col1600="4" data-col1280="3" data-col1000="3" data-col960="2" data-ratio="0.7" data-gutter="10" data-postSize="center" data-portSize="" data-portStyle="" data-Hlayout="true" data-postNb="" data-ttposts="" data-pageNb="1" data-category="">';
	echo '<div class="to-grid-scroll horizontal">';
	echo '<div class="to-grid-holder horizontal clearfix">';
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>4,
			'ignore_sticky_posts'=>1
		);
		$related_query = new wp_query( $args );
		while($related_query->have_posts() ) {
			$related_query->the_post();
			$post_img_id = get_post_thumbnail_id();	
			$post_img    = wp_get_attachment_image_src($post_img_id,'normal');
			$post_thumb  = $post_img[0];
			echo '<div class="to-item blog center normal" data-cat="">';
			echo '<div class="to-item-wrapper" style="margin: 2px">';
			echo '<div class="to-item-image">';
			echo '<div class="to-item-img" style="background-image: url('. esc_url($post_thumb) .')" ></div>';
			echo '</div>';
			echo '<div class="to-item-content">';
			echo '<div class="to-item-content-inner">';
			$post_cats_span = null;
			foreach(get_the_category() as $category) {
				if($category->cat_name != 'Uncategorized') {
					$cat_bg    = null;
					$post_cats = $category->name . ';';
					$cat_id    = $category->term_id;
					$cat_data  = get_option('category_'.$cat_id);
					$cat_txt_color = 'color:'.themeone_smart_color($cat_data['catBG']);
					$cat_bg        = 'style="background:'. $cat_data['catBG'] .';'.$cat_txt_color.'"';
					$post_cats_span .= '<a href="'. esc_url(get_category_link( $category->term_id )) .'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'mobius' ), $category->name ) ) . '"><span '. $cat_bg .' class="to-item-cat '. $cat_id .'">'.$category->cat_name.'</span></a> ';
				}
			}
			echo $post_cats_span;
			echo '<h2><a href="';
			the_permalink();
			echo '">';
			the_title();
			echo  '</a></h2>';
			echo '<span class="to-item-date">';
			the_time(get_option('date_format'));
			echo '</span>';
			echo getPostLikeLink(get_the_ID());
			echo '</div>';
			echo '</div>';
			echo '<div class="relatedthumb">';
			echo '<a rel="external" href="';
			the_permalink();
			echo '">';
			echo '</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	$post = $orig_post;
	wp_reset_query();
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}

  add_action( 'woocommerce_after_shop_loop_item_title', 'my_stock', 15);
  function my_stock() {
    global $product;
    echo "Stock: ".$product->stock;
  }