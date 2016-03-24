<?php

function themeone_search_autocomplete_script() { 
	wp_register_script( 'ajax_search', get_template_directory_uri() . '/includes/ajax-search/search_autocomplete.js', array('jquery'), '1.0', 1);  
	wp_localize_script( 'ajax_search', 'ajaxsearch', array('url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax_nonce' ))); 
	wp_enqueue_script( 'ajax_search' );  
	  	
}  
add_action( 'wp_enqueue_scripts', 'themeone_search_autocomplete_script' ); 


add_action( 'wp_ajax_search_autocomplete', 'themeone_search_autocomplete_suggestions' );  
add_action( 'wp_ajax_nopriv_search_autocomplete', 'themeone_search_autocomplete_suggestions' );	
function themeone_search_autocomplete_suggestions(){  

	$search_term = $_POST['term'];
	$search_term = apply_filters('get_search_query', $search_term);	
	$search_array = array(
		's'=> $search_term, 
		'showposts'   => 6,
		'post_type' => array('post','page','portfolio','product'), 
		'post_status' => 'publish', 
		'post_password' => '',
		'suppress_filters' => false
	);
		
	$query = http_build_query($search_array);
	$posts = get_posts( $query );

	$result_post = null;
	$result_port = null;
	$result_page = null;
	$result_prod = null;
	$count       = 0;
	
	global $post;
	
	foreach ($posts as $post) {   
		
		setup_postdata($post);
		
		$post_id   = $post->ID;
		$post_type = get_post_type($post_id);
		$title     = strip_tags($post->post_title);
		$link      = esc_url(get_permalink());
		
		if (get_post_format($post_id) == 'gallery') {
			$gallery_ids = themeone_grab_ids_from_gallery();
			if (!empty($gallery_ids)) {
				$post_thumb = array_slice($gallery_ids, 0, 1);
				$post_thumb = array_shift($post_thumb);
				$image      = wp_get_attachment_image($post_thumb, 'thumbnail');
			}
		} else {
			$image = get_the_post_thumbnail($post_id, 'thumbnail', array('title' => ''));
		}
		
		if ($image == null) {
			$image = '<i class="fa fa-pencil"></i>' ; 
		}
		
		$suggestion  = '<li class="to-search-item">';
		$suggestion .= '<div class="to-search-item-img">';
		$suggestion .= $image;
		$suggestion .= '</div>';
		$suggestion .= '<div class="to-search-item-content">';
		$suggestion .= '<h4 class="accentColorHover"><a href="'. $link .'">'. $title .'</a></h4>';
		$endSearch   = '</div></li>';
		
		if($post_type == 'post'){
			$excerpt      = esc_html(wp_trim_words(strip_shortcodes($post->post_content), 25,'')); 
			$suggestion  .= '<div class="to-search-item-excerpt">'. $excerpt;
			$suggestion  .= '<a class="to-excerpt-more accentColorHover" href="'. $link .'"> [...]</a>';
			$suggestion  .= '</div>';
			$suggestion  .= $endSearch;
			$result_post .= $suggestion;
		} else if($post_type == 'page'){
			$suggestion  .= '<a class="to-excerpt-more accentColorHover" href="'. $link .'"> [...]</a>';
			$suggestion  .= $endSearch;
			$result_page .= $suggestion; 
		} else if($post_type == 'portfolio'){
			$suggestion  .= '<span>'. __('By','mobius') .' '. get_the_author() .'</span>';
			$suggestion  .= $endSearch;
			$result_port .= $suggestion; 
		} else if($post_type == 'product'){
			global $product;
			if ($price_html = $product->get_price_html())
			$suggestion  .= '<span class="price accentColor">'. $price_html .'</span>';
			$suggestion  .= $endSearch;
			$result_prod .= $suggestion; 
		}
		$count++;
	}
	
	if ($count > 1) {
		$nb_result = __('Results found','mobius');
	} else {
		$nb_result = __('Result found','mobius');
	}
	
	$suggestions  = '<div class="items-results">';
	$suggestions .= '<h3 class="items-results-count">'. $count .' '. $nb_result .'</h3>';
	
	if($result_post){
		$suggestions .= '<div class="items-result-from">';
		$suggestions .= '<h3 class="items-from">'. __('From Blog','mobius') .'</h3>';
		$suggestions .= $result_post;
		$suggestions .= '</div>';
	}
	if($result_page){
		$suggestions .= '<div class="items-result-from">';
		$suggestions .= '<h3 class="items-from">'. __('From Page','mobius') .'</h3>';
		$suggestions .= $result_page;
		$suggestions .= '</div>';
	}
	if($result_port){
		$suggestions .= '<div class="items-result-from">';
		$suggestions .= '<h3 class="items-from">'. __('From Portfolio','mobius') .'</h3>';
		$suggestions .= $result_port;
		$suggestions .= '</div>';
	}
	if($result_prod){
		$suggestions .= '<div class="items-result-from">';
		$suggestions .= '<h3 class="items-from">'. __('From Shop','mobius') .'</h3>';
		$suggestions .= $result_prod;
		$suggestions .= '</div>';
	}
	
	$suggestions .= '</div>';
	echo $suggestions; 
	exit;  
}

	
?>