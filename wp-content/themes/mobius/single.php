<?php 

get_header();

themeone_slider_init();

$ID         = get_the_ID();
$slider_id  = get_post_meta($ID, 'themeone-get-slider', true);	
$slides     = get_post_meta($slider_id, 'themeone-slider-slides', true);
$hideHeader = get_post_meta($ID, 'themeone-header-hide', true);
if ($slides == null && empty($hideHeader)) {
	themeone_page_header($post->ID);
}

global $mobius, $wp_registered_sidebars;

$page_id             = get_queried_object_id();
$extended_content    = get_post_meta($page_id, 'themeone-extended-page', true);
$sidebar_content     = get_post_meta($page_id, 'themeone-sidebar', true);
$sidebar_position    = get_post_meta($page_id, 'themeone-sidebar-position', true);
$sidebar_margin      = esc_attr(get_post_meta($page_id, 'themeone-sidebar-margintop', true));
$sidebar_exist       = null;
$sidebar_right       = null;
$sidebar_left        = null;

if (empty($sidebar_content) && isset($mobius['sidebar-post'])) {
	$sidebar_content  = $mobius['sidebar-post'];
	$sidebar_position = $mobius['sidebar-post-position'];
}

foreach ($wp_registered_sidebars as $name ) {
	if ($name['name'] == $sidebar_content) {
		$sidebar_exist = 'true';
		break;
	}
}

if (!is_active_sidebar($sidebar_content) || !$sidebar_exist) {
	$sidebar_content  = null;
	$sidebar_position = null;
} else {
	ob_start();
	$sidebar_content  = dynamic_sidebar($sidebar_content);
	$sidebar_content  = ob_get_contents();
	ob_end_clean();
	if (empty($sidebar_position)) {
		$sidebar_position = 'right';
	}
	if (!empty($sidebar_margin)) {
		$sidebar_margin   = 'style="margin-top: '. $sidebar_margin .'px;"';
	}
}

switch ($sidebar_position) {
    case 'left':
        $sidebar_left   = '<div id="sidebar" class="col col-3" '. $sidebar_margin .'>';
		$sidebar_left  .= $sidebar_content;
		$sidebar_left  .= '</div>';
		$content_before = '<div class="article-holder col-9 col col-last" sidebar="'.$sidebar_exist.'">';
		$content_after  = '</div>';
        break;
    case 'right':
        $sidebar_right  = '<div id="sidebar" class="col col-3 col-last" '. $sidebar_margin .'>';
		$sidebar_right .= $sidebar_content;
		$sidebar_right .= '</div>';
		$content_before = '<div class="article-holder col-9 col">';
		$content_after  = '</div>';
        break;
	default :
		$content_before = '<div class="article-holder col-12 col col-last">';
		$content_after  = '</div>';
		break;
}

echo '<section id="single-post-section">';
echo '<div class="section-container">';
echo $sidebar_left;
echo $content_before;

	if (empty($extended_content)) {
		if(have_posts()) : while(have_posts()) : the_post(); 
			echo '<article id="post-'. get_the_ID() .'" class="'. implode(' ',get_post_class()) .'">';
			if (get_post_format() != 'gallery' && !empty($mobius['blog-feature-image'])) {
				get_template_part( 'includes/templates/template', get_post_format() );
			}
			the_content();
			/*post categories*/
			$count      = 0;
			$meta_cat   = null;
			$cat_label  = __('Category', 'mobius');
			if (get_the_category_list() != '') { 
				$cat_nb = count(get_the_category());
				foreach(get_the_category() as $category) {
					$count++;
					$sep = ($count < $cat_nb) ? ', ' : null;
					if($category->cat_name != 'Uncategorized') {
						$cat = $category->name;
						$cat_title = esc_attr( sprintf( __( "View all posts in %s", 'mobius' ), $cat));
						$meta_cat .= '<a href="'. esc_url(get_category_link( $category->term_id )) .'" title="' . $cat_title . '">'.$cat.'</a>'.$sep;
					}
				}
				if ($count > 1) {
					 $cat_label = __('Categories', 'mobius');
				}
				echo '<div class="post-cat-holder">';
				echo '<h5>'. $cat_label .':</h5>&nbsp;&nbsp;';
				echo $meta_cat;
				echo '</div>';
			}
			
			/*post tags*/
			if ($mobius['blog-tag']) {
				the_tags('<div class="post-tag-holder"><h5>'. __('Tags', 'mobius') .':</h5>&nbsp;&nbsp;',', ','</div>');
			}
			themeone_single_page_nav();
			echo '</article>';        
		endwhile; endif;     					
	} else {
		if(have_posts()) : while(have_posts()) : the_post();
			the_content();
		endwhile; endif;
		/*post categories*/
		$count      = 0;
		$meta_cat   = null;
		$cat_label  = __('Category', 'mobius');
		if (get_the_category_list() != '') {
			$cat_nb = count(get_the_category());
			foreach(get_the_category() as $category) {
				$count++;
				$sep = ($count < $cat_nb) ? ', ' : null;
				if($category->cat_name != 'Uncategorized') {
					$cat = $category->name;
					$cat_title = esc_attr( sprintf( __( "View all posts in %s", 'mobius' ), $cat));
					$meta_cat .= '<a href="'. esc_url(get_category_link( $category->term_id )) .'" title="' . $cat_title . '">'.$cat.'</a>'.$sep;
				}
			}
			if ($count > 1) {
				 $cat_label = __('Categories', 'mobius');
			}
			echo '<div class="post-cat-holder">';
			echo '<h5>'. $cat_label .':</h5>&nbsp;&nbsp;';
			echo $meta_cat;
			echo '</div>';
		}
		/*post tags*/
		if ($mobius['blog-tag']) {
			the_tags('<div class="post-tag-holder"><h5>'. __('Tags', 'mobius') .':</h5>&nbsp;&nbsp;',', ','</div>');
		}
		themeone_single_page_nav();
	}

echo $content_after;
echo $sidebar_right;

echo '<div class="clear"></div>';

if ($mobius['blog-next-prev-post']) {
	themeone_prev_next_links($post->ID);
}

if ($mobius['blog-related-post']) {
	themeone_related_post($post);
}

if ($mobius['blog-social']) {
	themeone_share(get_the_ID());
}

if ($mobius['blog-author']) {
	echo '<div id="to-author-bio">';
	echo '<div id="to-author-bio-overlay"></div>';
	if (function_exists('get_avatar')) { 
		echo get_avatar( get_the_author_meta('ID'), '140' ); 
	}
	echo '<div id="to-author-info">';
	echo '<span id="to-author-about">'. __('About', 'mobius') .'</span>';
	echo '<h3 id="to-author-name">&nbsp;';
	the_author();
	echo '</h3>';
	echo '<a id="to-author-count" href="'. esc_url(get_author_posts_url(get_the_author_meta('ID'))) .'">&nbsp;&nbsp;(';
	the_author_posts();
	echo ' '.__('articles', 'mobius');
	echo ')</a>'; 
	echo '</div>';	
	echo '<p id="to-author-desc">'; 
	the_author_meta('description');
	echo '</p>';
	themeone_to_author_link();
	echo '</div>';
	echo '<div class="clear"></div>	';
} 

comments_template();
echo '<div class="clear"></div>	';

echo '</div>';
echo '</section>';

get_footer(); 

?>