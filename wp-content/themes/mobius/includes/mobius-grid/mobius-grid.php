<?php

function mobius_grid_script() {
    wp_register_script( 'mobius-grid', get_template_directory_uri(). '/includes/mobius-grid/mobius-grid.js', array('jquery'), '1.0', 1 );
	wp_localize_script( 'mobius-grid', 'wp_ajax', array('url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajax_nonce' )));
	wp_enqueue_script( 'mobius-grid' );
}
add_action( 'wp_enqueue_scripts', 'mobius_grid_script' );

function mobius_grid_styles() {	 
	wp_register_style('mobius-grid-css',  get_template_directory_uri() . '/includes/mobius-grid/mobius-grid.css');
	wp_enqueue_style('mobius-grid-css');
}
add_action('wp_enqueue_scripts', 'mobius_grid_styles');

#-----------------------------------------------------------------#
# Load Next Mobius Grid ELEMENT
#-----------------------------------------------------------------#

function mobius_grid_ajax() {
	
	$nonce = $_POST['ajax_nonce']; 
	
	if ( !wp_verify_nonce( $nonce, 'ajax_nonce' ) ) {
		die ();
	} else {
		$type = (isset($_POST['type'])) ? $_POST['type'] : 'post';
		$grid = (isset($_POST['gridType'])) ? $_POST['gridType'] : 'grid';
		$postNb = (isset($_POST['postNb'])) ? $_POST['postNb'] : 0;
		$pageNb = (isset($_POST['pageNb'])) ? $_POST['pageNb'] : 0;
		$postSize = (isset($_POST['postSize'])) ? $_POST['postSize'] : '';
		$portSize = (isset($_POST['portSize'])) ? $_POST['portSize'] : '';
		$gutter = (isset($_POST['gutter'])) ? $_POST['gutter'] : '';
		$orderBy = (isset($_POST['orderby'])) ? $_POST['orderby'] : '';
		$portStyle = (isset($_POST['portStyle'])) ? $_POST['portStyle'] : '';
		$category_name = (isset($_POST['category'])) ? $_POST['category'] : '';
		
		mobius_grid_element($pagination='',$grid,$type,$postNb,$pageNb,$postSize,$portSize,$gutter,$orderBy,$portStyle,$category_name);
	}
}
add_action('wp_ajax_mobius_grid', 'mobius_grid_ajax');
add_action('wp_ajax_nopriv_mobius_grid', 'mobius_grid_ajax');	

#-----------------------------------------------------------------#
# Init Mobius Grid
#-----------------------------------------------------------------#

function mobius_grid_init($pagination='page',$grid='grid',$type='both',$postNb=10,$rowNb=2,$colsup=6,$col1600=5,$col1280=4,$col1000=3,$col690=2,$ratio=0.7,$postSize='',$portSize='',$Hlayout='true',$toggle='true',$filters='true',$gutter='1px',$controls='true',$orderBy='none',$portStyle,$category_name='') {	

	$pageNb        = 1;
	$gridType      = null;
	$catSelect     = null;
	$mobileFilters = null;
	$tt_ports      = null;
	$conLayout     = null;
	$tt_posts      = wp_count_posts('post')->publish;
	$exists        = post_type_exists('portfolio');
	
	if ($exists) {
		$tt_ports = wp_count_posts('portfolio')->publish;
	}
	
	if ($type == 'portfolio' && $exists) {
		$tt_posts = $tt_ports;
	} 
	if ($type == 'both') {
		$tt_posts = $tt_posts + $tt_ports;
	}
	if ($grid == 'masonry') {
		$gridType = 'to-masonry';
		$Hlayout = false;
	}
	if ($controls != null || $toggle != null) { 
		$conLayout = 'to-grid-control';
	}
	
?>

    <div class="to-grid-container <?php echo $gridType; ?> clearfix" data-grid-type="<?php echo esc_attr($grid); ?>" data-type="<?php echo esc_attr($type); ?>" data-orderby="<?php echo esc_attr($orderBy); ?>" data-rowNb="<?php echo esc_attr($rowNb); ?>" data-colsup="<?php echo esc_attr($colsup); ?>" data-col1600="<?php echo esc_attr($col1600); ?>" data-col1280="<?php echo esc_attr($col1280); ?>" data-col1000="<?php echo esc_attr($col1000); ?>" data-col960="<?php echo esc_attr($col690); ?>" data-ratio="<?php echo esc_attr($ratio); ?>" data-gutter="<?php echo esc_attr($gutter); ?>" data-postSize="<?php echo esc_attr($postSize); ?>" data-portSize="<?php echo esc_attr($portSize); ?>" data-portStyle="<?php echo esc_attr($portStyle); ?>" data-Hlayout="<?php echo esc_attr($Hlayout); ?>" data-postNb="<?php echo esc_attr($postNb); ?>" data-ttposts="<?php echo esc_attr($tt_posts); ?>" data-pageNb="1" data-category="<?php echo esc_attr($category_name); ?>">
        
        <?php if (!empty($filters)) { 
		
			if ($type == 'post' || !$exists) {
				$typecat = 'category';
			} else if ($type == 'portfolio') {
				$typecat = 'portfolio_category';
			} else if ($type == 'both') { 
				$type = array('post', 'portfolio');
				$typecat = array('category', 'portfolio_category');
			}
			
			$cat = array();
			$html  = "<div class='to-grid-filters ". $conLayout ."'>";
			$html .= "<div class='to-grid-filter-overlay'></div>";
			$html .= "<div class='option-set'>";
				$html .= "<div class='to-grid-filters-button'>";
					$html .= "<div class='to-grid-filter-overlay'></div>";
					$html .= "<svg class='filter-svg-button' width='20' height='42' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve'>";
					$html .= "<g>";
					$html .= "<circle cx='2.1'  cy='8'  r='2.2' ></circle>";
					$html .= "<circle cx='10.1' cy='8'  r='2.2' ></circle>";
					$html .= "<circle cx='17.9' cy='8'  r='2.2' ></circle>";
					$html .= "<circle cx='2.1'  cy='15' r='2.2' ></circle>";
					$html .= "<circle cx='10.1' cy='15' r='2.2' ></circle>";
					$html .= "<circle cx='17.9' cy='15' r='2.2' ></circle>";
					$html .= "<circle cx='2.1'  cy='22' r='2.2' ></circle>";
					$html .= "<circle cx='10.1' cy='22' r='2.2' ></circle>";
					$html .= "</g>";
					$html .= "</svg>";
			$html .= "</div>";
			
			$html .= "<div class='to-filters-line accentBg'></div>";
			$html .= "<div class='to-grid-filter-title actived no-ajaxy all' data-filter='*'>". __('All', 'mobius') ."<div class='to-grid-tooltip'>0</div></div>";
			$categories = get_categories(array('type' => $type, 'taxonomy' => $typecat));	   
			foreach ( $categories as $category ) {
				if ( isset($category->count) && $category->count > 0) {
					$html .= "<div class='to-grid-filter-title no-ajaxy' data-filter='". esc_attr($category->term_id) ."'>";
					$html .= ucfirst($category->name);
					$html .= "<div class='to-grid-tooltip'>0</div>";
					$html .= "</div>";
					$catSelect .= '<option value=".'. esc_attr($category->term_id) .'">'. ucfirst($category->name) .'</option>';
				}
			}
			$html .= "</div>";
			$html .= "</div>";	
			$mobileFilters = '<select class="option-set-mobile"><option value="*">'. __('All', 'mobius') .'</option>'. $catSelect .'</select>';
			echo $html;
		}?>
        
        <?php if ($grid != 'masonry' && ($controls != null || $toggle != null)) { ?>
        <div class="controls">
        	<?php echo $mobileFilters; ?>
            <div class="controls-inner">
            	<?php if ($toggle != null) { ?>
                <div class="toggle-view accentColorHover" title="Toggle layout"><i class="steadysets-icon-grid"></i></div>
                <?php } ?>
				<?php if ($controls != null) { ?>
                <div class="next-scroll accentColorHover" title="Scroll left"><i class="icon-to-right-arrow"></i></div>
                <div class="prev-scroll accentColorHover" title="Scroll right"><i class="icon-to-left-arrow"></i></div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
         
        <?php
		global $mobius;
		if (($mobius['blog-layout'] == 'masonry 3cols' || $mobius['blog-layout'] == 'masonry 4cols' || $mobius['blog-layout'] == 'grid 3cols' || $mobius['blog-layout'] == 'grid 4cols') && is_home()) {
			$page_id = get_queried_object_id();
			$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
			$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
			$sidebar_margin = get_post_meta($page_id, 'themeone-sidebar-margintop', true);
			if (empty($sidebar_layout)) {
				$sidebar_layout = 'left';
			}
			if (!empty($sidebar_margin)) {
				$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
			}
			if ($sidebar && $sidebar_layout == 'left') {
				echo '<div id="sidebar" class="col col-3" '. $sidebar_margin .'>';
				dynamic_sidebar($sidebar);
				echo '</div>';
				echo '<div class="col-9 col col-last">';
			} else if ($sidebar && $sidebar_layout == 'right') {
				echo '<div class="col-9 col">';
			}
		}
		?>
           
        <div class="to-grid-scroll <?php if ($Hlayout == 'true') { echo 'horizontal'; } else { echo 'vertical'; } ?>">	
            <div class="to-grid-holder <?php if ($Hlayout == 'true') { echo 'horizontal'; } else { echo 'vertical'; } ?> clearfix">
            <?php mobius_grid_element($pagination,$grid,$type,$postNb,$pageNb,$postSize,$portSize,$gutter,$orderBy,$portStyle,$category_name); ?>         
            </div>
        </div>
        
        
        
        <?php if ($Hlayout == 'true' && $controls == 'true') { ?>
        <div class="isotope-pages"></div>
        <?php } ?>
        
        <?php 
		if ($pagination == 'ajax' && $tt_posts > $postNb) { 
		?>
        <div class="next-container to-button to-button-border regular accentColorHover"><span><?php echo __('Load more', 'mobius'); ?></span></div>
        <?php } ?>

		<?php 
		$portfolio_name = null;
		if ($type == 'portfolio') {
			$portfolio_name = $category_name;
			$category_name  = null;
		}
		
		if ($pagination == 'page') {
			$paged = (get_query_var('paged')) ? max(1, get_query_var('paged')) : max(1, get_query_var('page'));
			query_posts(array(
				'post_type' => $type,
				'posts_per_page' => $postNb,
				'paged' => $paged,
				'category_name' => $category_name,
				'portfolio_category' => $portfolio_name
			));
			themeone_page_nav($paged);
			wp_reset_query();
		}
		?>
        
        <?php
		if (($mobius['blog-layout'] == 'masonry 3cols' || $mobius['blog-layout'] == 'masonry 4cols' || $mobius['blog-layout'] == 'grid 3cols' || $mobius['blog-layout'] == 'grid 4cols') && is_home()) {
			if ($sidebar && $sidebar_layout == 'right') {
				echo '</div>';
				echo '<div id="sidebar" class="col col-3 col-last" '. $sidebar_margin .'>';
				dynamic_sidebar($sidebar);
				echo '</div>';
			} else if ($sidebar && $sidebar_layout == 'left') {
				echo '</div>';
			}
		}
		?>
        
    </div>

<?php
}



#-----------------------------------------------------------------#
# LOAD MOBIUS GRID ELEMENT
#-----------------------------------------------------------------#

function mobius_grid_element($pagination,$grid,$type,$postNb,$pageNb,$postSize,$portSize,$gutter,$orderBy,$portStyle,$category_name) {
	
	$portfolio_name = null;
	
	if ($type == 'both') { 
		$type = array('post', 'portfolio');
	}
	
	if ($gutter != '') {
		if ($gutter == '0px' || $gutter == '1px') {
			if ($grid == 'masonry') {
				$guttercss  = 'style="';
				$guttercss .= 'margin-top: '. $gutter .' !important;';
				$guttercss .= 'margin-left: '. $gutter .' !important;"';
			} else {
				$guttercss  = 'style="';
				$guttercss .= 'top: '. $gutter .' !important;';
				$guttercss .= 'left: '. $gutter .' !important;"';
			} 
		} else {
			if ($grid == 'masonry') {
				$guttercss  = 'style="';
				$guttercss .= 'margin: '. $gutter/2 .'px !important;"';
			} else {
				$guttercss  = 'style="';
				$guttercss .= 'top: '. $gutter/2 .'px !important;';
				$guttercss .= 'bottom: '. $gutter/2 .'px !important;';
				$guttercss .= 'left: '. $gutter/2 .'px !important;';
				$guttercss .= 'right: '. $gutter/2 .'px !important;"';
			} 
		}
	} else {
		$guttercss = null;
	}
			
	/*** GLOBAL $WP QUERY; ***/

	global $wp_query;
	global $_wp_additional_image_sizes;
	$paged = (get_query_var('paged')) ? max(1, get_query_var('paged')) : max(1, get_query_var('page'));
	
	if ($orderBy == 'menu_order' || $orderBy == 'title') {
		$order = 'ASC';
	} else {
		$order = 'DESC';
	}
	
	if ($type == 'portfolio') {
		$portfolio_name = $category_name;
		$category_name  = null;
	}
	
	if ($pagination == 'page') {
		$args = array(
			'post_type' => $type,
			'posts_per_page' => $postNb,
			'paged' => $paged,
			'order' => $order,
			'orderby' => $orderBy,
			'category_name' => $category_name,
			'portfolio_category' => $portfolio_name
		);
	} else {
		$args = (array(
			'post_type' => $type,
			'posts_per_page' => $postNb,
			'paged' => $pageNb,
			'order' => $order,
			'orderby' => $orderBy,
			'category_name' => $category_name,
			'portfolio_category' => $portfolio_name
		));
	}
	
	$grid_query = new WP_Query($args);
	
	if ($grid_query->have_posts())
	
		while ($grid_query->have_posts()) : $grid_query->the_post();
		
		/*** POST VARS NEEDED FOR ALL ELEMENT TYPE***/		
		
		$post_img_title = null;		
		$post_id        = get_the_ID();
		$post_type      = get_post_type( $post_id );
		$post_format    = get_post_format( $post_id );
		$post_size      = get_post_meta( $post_id, 'themeone-element-class', true);
		$post_img_id    = get_post_thumbnail_id();	
		$post_img_lb    = esc_url(wp_get_attachment_url( $post_img_id ));
		$post_img_title = get_the_title( $post_img_id );
		$post_alt       = get_post_meta( $post_img_id, '_wp_attachment_image_alt', true);	
		$post_alt       = 'alt="'. esc_attr($post_alt) .'"';			
		$post_title     = get_the_title();
		$post_link      = esc_url(get_permalink( $post_id ));
		$post_cats      = null;
		$post_cats_span = null;
		$port_cats      = null;
		$port_cats_name = null;
		$post_image     = null;
		$post_audio     = null;	
		
		/*** FORCE ELEMENT SIZE IF IT S ENABLE ***/
		
		if ($postSize != '') {
			$post_size = $postSize;
		}
		if ($portSize != '') {
			$post_size = $portSize;
		}
		
		/*** IF NO ELEMENT SIZE IN POST ARE SET ***/
		
		if ($post_size == '' && $post_type == 'post' || $grid == 'masonry') {
			$post_size = 'tall';
		}
		
		/*** Get Featured Image Size ***/
		
		if ($grid == 'masonry') {
			$img_size = 'masonry';
		} else if (get_post_type($post_id) == 'portfolio') {
			$img_size = strtok($post_size, ' ');
		} else if (get_post_type($post_id) == 'post') {
			if ($post_size == 'tall' || $post_size == 'wide') {
				$img_size = 'normal';
			} else if ($post_size == 'square top') {
				$img_size = 'wide';
			} else if ($post_size == 'square left') {
				$img_size = 'tall';
			} else {
				$img_size = strtok($post_size, ' ');
			}
		}
		$size = $_wp_additional_image_sizes[$img_size];
		$img_attr = 'height="'. $size['height'] .'" width="'. $size['width'] .'"';
		$post_img   = wp_get_attachment_image_src($post_img_id, $img_size);
		$post_thumb = $post_img[0];
		
		/*** SET POST TYPE ***/	
		
		if (strpos($post_size,'center')) {
			$post_type = 'post-center';
		}
		if ($post_format == 'quote') {
			$post_type = 'post-quote';
		}
		if ($post_format == 'link') {
			$post_type = 'post-link';
		}
		if ($post_thumb == '' && $post_type == 'post' && $post_format != 'gallery' && $post_format != 'video') {
			$post_type = 'post-no-image';
		}
		if ($post_type == 'portfolio' && $portStyle == 'style2') {
			$post_type = 'portfolio2';
		}
		if ($post_type == 'portfolio' && $portStyle == 'style3') {
			$post_type = 'portfolio3';
		}
		
		/*** GET CATEGORIES IN POST AND PORTFOLIO ***/	

		if (strrpos($post_type, 'post') !== false) {
			foreach(get_the_category() as $category) {
				if($category->cat_name != 'Uncategorized') {
					$cat_bg = null;
					$post_cats = $category->term_id . ';';
					$cat_id    = $category->term_id;
					$cat_data  = get_option('category_'.$cat_id);
					if (isset($cat_data['catBG']) && !empty($cat_data['catBG'])) {
						$cat_txt_color = 'color:'.themeone_smart_color($cat_data['catBG']);
						$cat_bg = 'style="background:'. $cat_data['catBG'] .';'.$cat_txt_color.'"';
					} else {
						$cat_bg = null;	
					}
					$post_cats_span .= '<a href="'. esc_url(get_category_link( $category->term_id )) .'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'mobius' ), $category->name ) ) . '"><span '. $cat_bg .' class="to-item-cat '. $cat_id .'">'.$category->cat_name.'</span></a> ';
				}
			}
		} else {
			$terms = get_the_terms( $post_id, 'portfolio_category');
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach( $terms as $term ) {
					if($term->name != 'Uncategorized') {
						$port_cats = $port_cats.$term->term_id . ';';
						if (!empty($port_cats_name)) {
							$port_cats_name = $port_cats_name.'sep;tor'.$term->name;
						} else {
							$port_cats_name = $port_cats_name.$term->name;
						}
						
					}
				}
			}
		}
		
		$post_cats = trim($post_cats,';');
		$port_cats = trim($port_cats,';');
		//$port_cats_name = trim($port_cats_name,'sep;tor');
		/*** SET POST FORMAT INFORMATIONS ***/
		
		$post_video = null;
		$post_audio = null;
		
		$post_content  = '<div class="to-item-content-link"><a href="'. $post_link .'"><i class="li_clip"></i></a></div>';
		$post_title    = '<h2><a href="'. $post_link .'">'. $post_title .'</a></h2>';
		if ($post_type == 'portfolio3') {
			$post_lightbox = '<div class="to-item-lightbox-link" data-img-src="'. $post_img_lb .'" data-img-title="'. $post_img_title .'"><i class="fa fa-expand"></i></div>';
		} else {
			$post_lightbox = '<div class="to-item-lightbox-link" data-img-src="'. $post_img_lb .'" data-img-title="'. $post_img_title .'">+</div>';
		}
		
		/*** AUDIO/VIDEO FORMAT ***/
		
		if ($post_format == 'audio') {	
			$audio_name    = get_post_meta($post_id, 'themeone-song-name', true);
			$audio_artiste = get_post_meta($post_id, 'themeone-artiste-name', true);
			$audio_cover   = get_post_meta($post_id, 'themeone-album-image', true);
			$audio_mp3     = get_post_meta($post_id, 'themeone-audio-mp3', true);
			$audio_ogg     = get_post_meta($post_id, 'themeone-audio-ogg', true);	
			$format_icon   = '<i class="fa fa-headphones element-format"></i>';	
			$post_lightbox = null;
			
			if ($post_thumb != '' || $post_type == 'post-center') {
				$post_audio  = '<div class="to-item-audio-link" data-mp3="'. esc_attr($audio_mp3) .'" data-ogg="'. esc_attr($audio_ogg) .'" data-song-name="'. $audio_name .'" data-artist="'. esc_attr($audio_artiste) .'" data-cover="'. esc_attr($audio_cover) .'">';
				$post_audio .= '<i class="li_sound"></i><i class="fa fa-pause"></i></div>';
				$post_audio .= '<span class="time-float">';
				$post_audio .= '<span class="time-float-current"></span>';
				$post_audio .= '<span class="time-float-corner"></span>';
				$post_audio .= '</span>';
				$post_audio .= '<div class="to-item-time"><div class="to-item-currenttime accentBg"></div></div>';
			} else {
				$post_audio  = '<div class="to-audio-player post-audio">';
				$post_audio .= '<span class="to-audio-player-duration">00:00</span>';
				$post_audio .= '<span class="to-audio-player-curtime">00:00</span>';
				$post_audio .= '<div class="to-item-audio-link" data-mp3="'. esc_url($audio_mp3) .'" data-ogg="'. esc_url($audio_ogg) .'" data-song-name="'. esc_attr($audio_name) .'" data-artist="'. esc_attr($audio_artiste) .'" data-cover="'. esc_url($audio_cover) .'">';
				$post_audio .= '<i class="fa fa-play"></i>';
				$post_audio .= '<i class="fa fa-pause"></i>';
				$post_audio .= '</div>';
				$post_audio .= '<i class="fa fa-volume-up"></i>';
				$post_audio .= '<i class="fa fa-volume-off"></i>';
				$post_audio .= '<span class="time-float">';
				$post_audio .= '<span class="time-float-current"></span>';
				$post_audio .= '<span class="time-float-corner"></span>';
				$post_audio .= '</span>';
				$post_audio .= '<div class="to-item-time">';
				$post_audio .= '<div class="to-item-currenttime accentBg"></div>';
				$post_audio .= '</div>';
				$post_audio .= '</div>';
			}
		} else if ($post_format == 'video') {	
			$video_poster  = get_post_meta($post_id, 'themeone-video-poster', true);
			$video_m4v     = get_post_meta($post_id, 'themeone-video-m4v', true);
			$video_ogv     = get_post_meta($post_id, 'themeone-video-ogv', true);
			$video_embed   = str_replace('"',"'",get_post_meta($post_id, 'themeone-video-embed', true));
			$format_icon   = '<i class="fa fa-video-camera element-format"></i>';
			$post_lightbox = '<div class="to-item-lightbox-link"><i class="li_video"></i></div>';
			$post_video   .= '<div class="video-link" data-video-poster="'. esc_url($video_poster) .'" data-video-m4v="'. esc_url($video_m4v) .'" data-video-ogv="'. esc_url($video_ogv).'" data-video-embed="'. esc_attr($video_embed) .'"></div>';
		}
		
		if ($post_thumb != '' || $post_format == 'gallery') {
			if ($post_format == 'gallery') {
				$gallery_ids = themeone_grab_ids_from_gallery(); 
				$attr = array( 'class' => 'to-item-img to-img-gallery' );
				if (!empty($gallery_ids)) {
					$post_img_lb = null;
					foreach( $gallery_ids as $image_id ) {
						$post_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
						$post_alt        = 'alt="'. $post_alt  .'"';
						$image_src       = wp_get_attachment_image_src($image_id, $img_size);
						$post_image     .= '<div class="to-item-img to-img-gallery" style="background-image: url('. $image_src[0].')" ></div>';
						$post_img_lb    .= wp_get_attachment_url($image_id).';';
						$post_img_title .= get_the_title($image_id).';';	
					}
					$post_img_lb  = rtrim($post_img_lb,';');
					if ($post_type == 'portfolio3') {
						$post_lightbox = '<div class="to-item-lightbox-link" data-img-src="'. $post_img_lb .'" data-img-title="'. esc_attr($post_img_title) .'"><i class="fa fa-expand"></i></div>';
					} else {
						$post_lightbox = '<div class="to-item-lightbox-link" data-img-src="'. $post_img_lb .'" data-img-title="'. esc_attr($post_img_title) .'">+</div>';
					}
				} else {
					$post_image = '<div class="to-item-img" style="background-image: url('. get_template_directory_uri() . '/images/no-image.jpg)" ></div>';
				}
			}  else {
				if ($grid == 'masonry') {
					$post_image = '<img class="to-item-img" src="'. esc_url($post_thumb) .'" '. $post_alt .' '. $img_attr .'>';
				} else {
					$post_image = '<div class="to-item-img" style="background-image: url('. esc_url($post_thumb) .')" ></div>';
				}
			}
		} else if ($post_thumb == '' && $post_format == 'video') {
			if ( $video_poster != '') {
				$post_image = '<div class="to-item-img" style="background-image: url('. esc_url($video_poster) .')" ></div>';
			} else {
				$post_image  = '<div class="no-video-image-overlay"></div>';
				$post_image .= '<i class="fa fa-video-camera no-video-image"></i>';
			}
		} else if ($post_thumb == '' && $post_format == 'quote' && $post_format == 'link') {
			$post_image = '<div class="to-item-img" style="background-image: url('. get_template_directory_uri() . '/images/no-image.jpg)" ></div>';
		}
		
		if (!strpos($post_type,'post')) {	
			global $more;	
			if ($grid == 'masonry') {
				$more = 0;
				$post_excerpt = themeone_get_excerpt(300,'',$post_id);
			} else {
				$more = -1;
				global $gridEx;
				$gridEx = 'true';
				$post_excerpt = get_the_excerpt();
			}
			$post_date     = get_the_time(get_option('date_format'));
			$post_author   = get_the_author();
			$post_aut_url  = esc_url(get_author_posts_url( get_the_author_meta('ID') ));
			$post_like     = getPostLikeLink( $post_id );
			$post_coms     = get_comments_number();
			$post_coms_url = esc_url(get_comments_link());
			global $mobius;
			if ($mobius['blog-author-photo']) {
				$post_avatar = get_avatar( get_the_author_meta('ID'), '40' );
			} else {
				$post_avatar = null;
				$post_author = __('By ', 'mobius'). $post_author;
			}
			$post_social  = '<div class="to-item-social clearfix">';
			$post_social .= '<div class="to-item-author"><a href="'. $post_aut_url .'">'. $post_avatar  .''. $post_author .'</a></div>';
			$post_social .= $post_like;
			$post_social .= '<div class="to-item-comments"><a href="'. $post_coms_url .'"><i class="fa fa-comment-o"></i>'. $post_coms .'</a></div>';
			$post_social .= '</div>';
		}
		
		/*** CONSTRUCT ELEMENT STRUCTURE DEPEND ON TYPE AND POSSIBILITIES ***/
		
		switch ($post_type) {
			
			case 'post':
				$output  = '<div class="to-item blog '. $post_size .' '. $post_cats .' '. $post_format .'" >';
				$output .= '<div class="to-item-wrapper" '. $guttercss .'>';
				$output .= '<div class="to-item-image">';
				if ($post_format != 'gallery' && !$post_video && !$post_audio) {
					$output .= '<a href="'. $post_link .'">';
				}
				$output .= $post_image;
				if ($post_format != 'gallery' && ($post_video || $post_audio)) {
					$output .= '<div class="to-item-overlay"></div>';
					$output .= $post_lightbox;
					$output .= $post_video;
					$output .= $post_audio;
				}
				if ($post_format != 'gallery' && !$post_video && !$post_audio) {
					$output .= '</a>';
				}
				$output .= '<div class="to-item-cat-holder">'. $post_cats_span .'</div>';
				$output .= '</div>';
				$output .= '<div class="to-item-content">';
				$output .= '<div class="to-item-content-inner">';
				$output .= $post_title;
				$output .= '<div class="to-item-date">'. $post_date .'</div>';
				$output .= '<div class="to-item-separator"></div>';
				$output .= '<div class="excerpt">'. $post_excerpt .'</div>';
				$output .= '</div>';
				$output .= $post_social;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
			
			case 'post-center':
				$output  = '<div class="to-item blog '. $post_size .' '. $post_cats .' '. $post_format .'" >';
				$output .= '<div class="to-item-wrapper" '. $guttercss .'>';
				$output .= '<div class="to-item-image">';
				if ($post_format != 'gallery') {
					$output .= '<a href="'. $post_link .'">';
				}
				$output .= $post_image;
				if ($post_format != 'gallery') {
					$output .= '</a>';
				}
				$output .= '</div>';
				//$output .= getPostLikeLink( $post_id );
				$output .= '<div class="to-item-content">';
				$output .= '<div class="to-item-content-inner">';
				$output .= $post_cats_span;
				$output .= $post_title;
				$output .= '<span class="to-item-date">'. $post_date .'</span>';
				$output .= getPostLikeLink( $post_id );
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
				
			case 'post-no-image':
				$output  = '<div class="to-item blog no-image '. $post_size .' '. $post_cats .' '. $post_format .'" >';
				$output .= '<div class="to-item-wrapper" '. $guttercss .'>';
				$output .= '<div class="to-item-content">';
				$output .= '<div class="to-item-content-inner">';
				$output .= $post_audio;
				$output .= $post_cats_span;
				$output .= $post_title;
				$output .= '<span class="to-item-date">'. $post_date .'</span>';
				$output .= '<div class="to-item-separator"></div>';
				$output .= '<div class="excerpt">'. $post_excerpt .'</div>';
				$output .= '<div class="to-item-dot"></div>';
				$output .= '</div>';
				$output .= $post_social;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
			
			case 'post-quote':
				$post_quote = get_post_meta($post_id, 'themeone-post-quote', true);
				$post_quote_author = get_post_meta($post_id, 'themeone-post-quote-author', true);
				$output  = '<div class="to-item blog quote '. $post_size .' '. $post_cats .' '. $post_format .'" >';
                $output .= '<div class="to-item-wrapper"  '. $guttercss .'>';
				if ($grid != 'masonry' && $post_image != null) {
					$output .= '<div class="to-item-image">';
					$output .= $post_image;
					$output .= '</div>';
				}
				$output .= '<div class="to-item-content">';
				$output .= '<div class="to-item-content-inner">';
				$output .= '<a href="'. $post_link .'">';
				$output .= '<h2>'. $post_quote .'</h2>';	
				$output .= '<div class="to-item-quote-author">'. $post_quote_author .'</div>';
				$output .= '<svg class="to-item-quote" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="80px" height="80px" x="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<g><path d="M62.994,41.041c-4.342,0-7.978,3.634-7.978,7.977c0,4.341,3.028,7.269,6.865,7.269c0.809,0,1.617-0.101,2.02-0.303   c-0.899,3.602-4.307,7.642-7.513,9.387c-0.007,0.003-0.012,0.008-0.018,0.011c-0.024,0.013-0.048,0.031-0.071,0.044l0.003,0.002   c-0.355,0.19-0.605,0.552-0.605,0.983c0,0.388,0.208,0.713,0.505,0.916l-0.025,0.024l4.196,2.65l0.013-0.011   c0.189,0.143,0.413,0.242,0.668,0.242c0.184,0,0.35-0.054,0.504-0.132l0.021,0.019c6.26-4.443,10.401-11.206,10.401-18.78   C71.979,44.776,67.738,41.041,62.994,41.041z" style="color:'. $mobius['body-text-dark'] .';fill:'. $mobius['body-text-dark'] .' !important"/><path d="M83.541,41.041c-4.342,0-7.978,3.634-7.978,7.977c0,4.341,3.028,7.269,6.865,7.269c0.809,0,1.617-0.101,2.02-0.303   c-0.899,3.602-4.307,7.642-7.513,9.387c-0.007,0.003-0.012,0.008-0.018,0.011c-0.024,0.013-0.048,0.031-0.071,0.044l0.003,0.002   c-0.355,0.19-0.605,0.552-0.605,0.983c0,0.388,0.208,0.713,0.505,0.916l-0.025,0.024l4.196,2.65l0.013-0.011   c0.189,0.143,0.413,0.242,0.668,0.242c0.184,0,0.35-0.054,0.504-0.132l0.021,0.019c6.26-4.443,10.401-11.206,10.401-18.78   C92.526,44.776,88.285,41.041,83.541,41.041z" style="color:'. $mobius['body-text-dark'] .';fill:'. $mobius['body-text-dark'] .' !important"/></g></svg>';
				$output .= '</a>';	
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
			
			case 'post-link':
				$post_link_from = get_post_meta($post_id, 'themeone-post-link-from', true);
				$post_link_url = get_post_meta($post_id, 'themeone-post-link-url', true);
				$post_link = get_post_meta($post_id, 'themeone-post-link', true);
				$output  = '<div class="to-item blog link '. $post_size .' '. $post_cats .' '. $post_format .'" >';
                $output .= '<div class="to-item-wrapper"  '. $guttercss .'>';
				if ($grid != 'masonry' && $post_image != null) {
					$output .= '<div class="to-item-image">';
					$output .= $post_image;
					$output .= '</div>';
				}
				$output .= '<div class="to-item-content">';
				$output .= '<div class="to-item-content-inner">';
				$output .= '<a target="_blank" class="no-ajaxy" href="'. $post_link_url .'">';
				$output .= '<h2>'. $post_link .'</h2>';
				$output .= '<div class="to-item-link-from">'. $post_link_from .'</div>';
				$output .= '<svg class="to-item-link" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<g><path d="M78.663,21.338c-7.552-7.552-19.648-7.79-27.486-0.713l-0.019-0.019L41.06,30.703c-1.831,1.831-3.216,3.936-4.187,6.176   c-1.937,0.841-3.775,1.983-5.419,3.468l-0.019-0.019L21.338,50.425c-7.797,7.797-7.797,20.439,0,28.237   c7.797,7.798,20.439,7.798,28.237,0l10.098-10.098l-0.019-0.019c1.484-1.644,2.627-3.482,3.467-5.419   c2.24-0.971,4.345-2.356,6.176-4.187l10.098-10.098l-0.019-0.019C86.452,40.985,86.214,28.889,78.663,21.338z M42.761,71.487   l-0.001,0.001c-3.935,3.935-10.314,3.935-14.248,0c-3.935-3.935-3.935-10.314,0-14.248l0.001-0.001l7.367-7.367   c0.865,3.321,2.579,6.466,5.18,9.068c2.602,2.602,5.747,4.315,9.067,5.181L42.761,71.487z M48.234,51.766   c-1.796-1.796-2.763-4.102-2.919-6.452c2.35,0.156,4.655,1.123,6.452,2.919c1.796,1.796,2.764,4.102,2.919,6.452   C52.336,54.528,50.03,53.562,48.234,51.766z M72.109,42.139l-0.619,0.619l-0.001,0.001l-0.001,0l-7.369,7.369   c-0.865-3.321-2.578-6.466-5.179-9.068c-2.602-2.602-5.748-4.314-9.069-5.18l7.369-7.369c0,0,0,0,0.001-0.001l0.001-0.001   l0.619-0.619l0.029,0.028c3.959-3.329,9.874-3.134,13.6,0.591s3.921,9.642,0.591,13.6L72.109,42.139z" style="color:'. $mobius['body-text-dark'] .';fill:'. $mobius['body-text-dark'] .' !important"/>
</g></svg>';
				$output .= '</a>';
				$output .= '</div>';	
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
				
			case 'portfolio':
                $output  = '<div class="to-item portfolio '. $post_size .' '. str_replace(';', ' ', $port_cats) .' '. $post_format .'" >';
                $output .= '<div class="to-item-wrapper"  '. $guttercss .'>';
				$output .= '<div class="to-item-image" >';
				$output .= $post_image;
				$output .= '<div class="to-item-overlay"></div>';		
				$output .= $post_title;				
				$output .= $post_lightbox;
				$output .= $post_video;
				$output .= $post_audio;
				$output .= $post_content;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
			
			case 'portfolio2':
                $output  = '<div class="to-item portfolio portstyle2 '. $post_size .' '. str_replace(';', ' ', $port_cats) .' '. $post_format .'" >';
                $output .= '<div class="to-item-wrapper"  '. $guttercss .'>';
				$output .= '<div class="to-item-image" >';
				$output .= $post_image;
				$output .= '<div class="to-item-overlay"></div>';								
				$output .= $post_lightbox;
				$output .= $post_video;
				$output .= $post_audio;
				$output .= $post_content;
				$output .= '</div>';
				$output .= '<div class="to-item-meta">';
				$output .= $post_title;	
				$output .= '<p>'. get_the_time(get_option('date_format')) .'</p>';
				$output .= getPostLikeLink( $post_id );
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
			
			case 'portfolio3':
                $output  = '<div class="to-item portfolio portstyle3 '. $post_size .' '. str_replace(';', ' ', $port_cats) .' '. $post_format .'" >';
                $output .= '<div class="to-item-wrapper"  '. $guttercss .'>';
				$output .= '<div class="to-item-image" >';
				$output .= $post_image;
				$output .= '<div class="to-item-overlay"></div>';			
				$output .= $post_title;
				$output .= '<div class="to-item-cats">'. str_replace('sep;tor', ' / ',$port_cats_name) .'</div>';
				$output .= getPostLikeLink( $post_id );	
				$output .= $post_lightbox;
				$output .= $post_video;
				$output .= $post_audio;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				break;
				
		}

		/*** OUTPUT ELEMENT ***/
		echo $output;	
		
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
}

function themeone_smart_color($htmlCode){
	if($htmlCode[0] == '#') {
		$htmlCode = substr($htmlCode, 1);
	}
	if (strlen($htmlCode) == 3) {
		$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
	}
	$r = hexdec($htmlCode[0] . $htmlCode[1]);
	$g = hexdec($htmlCode[2] . $htmlCode[3]);
	$b = hexdec($htmlCode[4] . $htmlCode[5]);
	$RGB = $b + ($g << 0x8) + ($r << 0x10);
	$r = 0xFF & ($RGB >> 0x10);
	$g = 0xFF & ($RGB >> 0x8);
	$b = 0xFF & $RGB;
	$r = ((float)$r) / 255.0;
	$g = ((float)$g) / 255.0;
	$b = ((float)$b) / 255.0;
	$maxC = max($r, $g, $b);
	$minC = min($r, $g, $b);
	$l = ($maxC + $minC) / 2.0;
    if($maxC == $minC) {
		$s = 0;
		$h = 0;
	}
	else {
		if($l < .5) {
			$s = ($maxC - $minC) / ($maxC + $minC);
		} else {
			$s = ($maxC - $minC) / (2.0 - $maxC - $minC);
		}
		if($r == $maxC) {
			$h = ($g - $b) / ($maxC - $minC);
		}
		if($g == $maxC) {
			$h = 2.0 + ($b - $r) / ($maxC - $minC);
		}
		if($b == $maxC) {
			$h = 4.0 + ($r - $g) / ($maxC - $minC);
		}
		$h = $h / 6.0; 
    }
	$h = (int)round(255.0 * $h);
	$s = (int)round(255.0 * $s);
	$l = (int)round(255.0 * $l);
	$hsl = (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
	if($hsl->lightness > 200) {
		return '#000000';
	} else {
		return '#ffffff';
	}
}

?>