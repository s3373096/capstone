<?php
/*
  Plugin Name: Themeone Portfolio
  Plugin URI: themeone-portfolio
  Description: Themeone portfolio post type with taxonomies.
  Version: 1.0
  Author: ThemeOne
  Author URI: http://www.theme-one.com
 */

if (!defined('THEMEONE_THEME_NAME')) define('THEMEONE_THEME_NAME', 'mobius');

load_theme_textdomain(THEMEONE_THEME_NAME, FALSE, dirname(plugin_basename(__FILE__)).'/lang');

if ( ! class_exists( 'Portfolio_Post_Type' ) ) :

class Portfolio_Post_Type {

	var $version = 1;
	
	function __construct() {
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );
		load_plugin_textdomain( THEMEONE_THEME_NAME, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		add_action( 'init', array( &$this, 'portfolio_init' ) );
		add_theme_support( 'post-thumbnails', array( 'portfolio' ) );
		add_filter( 'manage_edit-portfolio_columns', array( &$this, 'add_thumbnail_column'), 10, 1 );
		add_action( 'manage_posts_custom_column', array( &$this, 'display_thumbnail' ), 10, 1 );
		add_action( 'restrict_manage_posts', array( &$this, 'add_taxonomy_filters' ) );
		add_action( 'right_now_content_table_end', array( &$this, 'add_portfolio_counts' ) );
	}

	function plugin_activation() {
		$this->portfolio_init();
		flush_rewrite_rules();
	}
	
	function portfolio_init() {
	
		$labels = array(
			'name' => __( 'Portfolio', THEMEONE_THEME_NAME ),
			'singular_name' => _x( 'Portfolio Item', 'post type singular name', THEMEONE_THEME_NAME ),
			'add_new' => __( 'Add New Item', THEMEONE_THEME_NAME ),
			'add_new_item' => __( 'Add New Portfolio Item', THEMEONE_THEME_NAME ),
			'edit_item' => __( 'Edit Portfolio Item', THEMEONE_THEME_NAME ),
			'new_item' => __( 'Add New Portfolio Item', THEMEONE_THEME_NAME ),
			'view_item' => __( 'View Item', THEMEONE_THEME_NAME ),
			'search_items' => __( 'Search Portfolio', THEMEONE_THEME_NAME ),
			'not_found' => __( 'No portfolio items found', THEMEONE_THEME_NAME ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', THEMEONE_THEME_NAME )
		);
		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "portfolio"), 
			'menu_position' => 5,
			'menu_icon' => 'dashicons-format-image',
			'has_archive' => true
		);
		
		$args = apply_filters('portfolioposttype_args', $args);
	
		register_post_type( 'portfolio', $args );
		
		$taxonomy_portfolio_tag_labels = array(
			'name' => _x( 'Portfolio Tags', THEMEONE_THEME_NAME ),
			'singular_name' => _x( 'Portfolio Tag', THEMEONE_THEME_NAME ),
			'search_items' => _x( 'Search Portfolio Tags', THEMEONE_THEME_NAME ),
			'popular_items' => _x( 'Popular Portfolio Tags', THEMEONE_THEME_NAME ),
			'all_items' => _x( 'All Portfolio Tags', THEMEONE_THEME_NAME ),
			'parent_item' => _x( 'Parent Portfolio Tag', THEMEONE_THEME_NAME ),
			'parent_item_colon' => _x( 'Parent Portfolio Tag:', THEMEONE_THEME_NAME ),
			'edit_item' => _x( 'Edit Portfolio Tag', THEMEONE_THEME_NAME ),
			'update_item' => _x( 'Update Portfolio Tag', THEMEONE_THEME_NAME ),
			'add_new_item' => _x( 'Add New Portfolio Tag', THEMEONE_THEME_NAME ),
			'new_item_name' => _x( 'New Portfolio Tag Name', THEMEONE_THEME_NAME ),
			'separate_items_with_commas' => _x( 'Separate portfolio tags with commas', THEMEONE_THEME_NAME ),
			'add_or_remove_items' => _x( 'Add or remove portfolio tags', THEMEONE_THEME_NAME ),
			'choose_from_most_used' => _x( 'Choose from the most used portfolio tags', THEMEONE_THEME_NAME ),
			'menu_name' => _x( 'Portfolio Tags', THEMEONE_THEME_NAME )
		);
		
		$taxonomy_portfolio_tag_args = array(
			'labels' => $taxonomy_portfolio_tag_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portfolio_tag' ),
			'show_admin_column' => true,
			'query_var' => true
		);
		
		register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );
	
	    $taxonomy_portfolio_category_labels = array(
			'name' => _x( 'Portfolio Categories', THEMEONE_THEME_NAME ),
			'singular_name' => _x( 'Portfolio Category', THEMEONE_THEME_NAME ),
			'search_items' => _x( 'Search Portfolio Categories', THEMEONE_THEME_NAME ),
			'popular_items' => _x( 'Popular Portfolio Categories', THEMEONE_THEME_NAME ),
			'all_items' => _x( 'All Portfolio Categories', THEMEONE_THEME_NAME ),
			'parent_item' => _x( 'Parent Portfolio Category', THEMEONE_THEME_NAME ),
			'parent_item_colon' => _x( 'Parent Portfolio Category:', THEMEONE_THEME_NAME ),
			'edit_item' => _x( 'Edit Portfolio Category', THEMEONE_THEME_NAME ),
			'update_item' => _x( 'Update Portfolio Category', THEMEONE_THEME_NAME ),
			'add_new_item' => _x( 'Add New Portfolio Category', THEMEONE_THEME_NAME ),
			'new_item_name' => _x( 'New Portfolio Category Name', THEMEONE_THEME_NAME ),
			'separate_items_with_commas' => _x( 'Separate portfolio categories with commas', THEMEONE_THEME_NAME ),
			'add_or_remove_items' => _x( 'Add or remove portfolio categories', THEMEONE_THEME_NAME ),
			'choose_from_most_used' => _x( 'Choose from the most used portfolio categories', THEMEONE_THEME_NAME ),
			'menu_name' => _x( 'Portfolio Categories', THEMEONE_THEME_NAME ),
	    );
		
	    $taxonomy_portfolio_category_args = array(
			'labels' => $taxonomy_portfolio_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'portfolio_category' ),
			'query_var' => true
	    );
		
	    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );
		
		$taxonomy_portfolio_attributes_labels = array(
			'name' => _x( 'Portfolio Attributes', THEMEONE_THEME_NAME),
			'singular_name' => _x( 'Portfolio Attribute', THEMEONE_THEME_NAME),
			'search_items' =>  _x( 'Search Portfolio Attributes', THEMEONE_THEME_NAME),
			'all_items' => _x( 'All Portfolio Attributes', THEMEONE_THEME_NAME),
			'parent_item' => _x( 'Parent Portfolio Attribute', THEMEONE_THEME_NAME),
			'edit_item' => _x( 'Edit Portfolio Attribute', THEMEONE_THEME_NAME),
			'update_item' => _x( 'Update Portfolio Attribute', THEMEONE_THEME_NAME),
			'add_new_item' => _x( 'Add New Portfolio Attribute', THEMEONE_THEME_NAME),
			'new_item_name' => _x( 'New Portfolio Attribute', THEMEONE_THEME_NAME),
			'menu_name' => _x( 'Portfolio Attributes', THEMEONE_THEME_NAME)
		); 	
		
		$taxonomy_portfolio_attributes_args = array(
			'labels' => $taxonomy_portfolio_attributes_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'portfolio_attributes' ),
			'query_var' => true
	    );
		
		register_taxonomy( 'portfolio_attributes', array( 'portfolio' ), $taxonomy_portfolio_attributes_args );
		
	}

	function add_thumbnail_column( $columns ) {
	
		$column_thumbnail = array( 'thumbnail' => __('Thumbnail',THEMEONE_THEME_NAME ) );
		$columns = array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
		return $columns;
	}
	
	function display_thumbnail( $column ) {
		global $post;
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post->ID, array(60, 60) );
				break;
		}
	}
	 
	function add_taxonomy_filters() {
		global $typenow;
		$taxonomies = array( 'portfolio_category', 'portfolio_tag' );
		
		if ( $typenow == 'portfolio' ) {
			foreach ( $taxonomies as $tax_slug ) {
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}
	
	function add_portfolio_counts() {
		
	        if ( ! post_type_exists( 'portfolio' ) ) {
	             return;
	        }
	
	        $num_posts = wp_count_posts( 'portfolio' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
	            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
	        }
	        echo '<td class="first b b-portfolio">' . $num . '</td>';
	        echo '<td class="t portfolio">' . $text . '</td>';
	        echo '</tr>';
	
	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
	            }
	            echo '<td class="first b b-portfolio">' . $num . '</td>';
	            echo '<td class="t portfolio">' . $text . '</td>';
	
	            echo '</tr>';
	        }
	}
	
}

new Portfolio_Post_Type;

endif;

?>