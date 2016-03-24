<?php 

get_header();

themeone_page_header(get_queried_object_id());

themeone_slider_init();

global $mobius, $wp_registered_sidebars;

/**** page color ***/
$page_id = get_queried_object_id();
$page_color = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .';position:relative;display:inline-block;width:100%"';
	echo '<div  '. $page_color .'>';
}

if ($mobius['blog-layout'] == 'standard') {


?>

<div class="section-container index-container">

	<?php
	
	
	$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
	$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
	$sidebar_margin = esc_attr(get_post_meta($page_id, 'themeone-sidebar-margintop', true));
	$sidebar_exist  = null;
	
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
	if (!is_active_sidebar($sidebar) || !$sidebar_exist) {
		$sidebar_layout = null;
	}
	
	if ($sidebar && $sidebar_layout == 'left') {
		echo '<div id="sidebar" class="index col col-3" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
		echo '<div class="articles-holder col-9 col col-last">';
	} else if ($sidebar && $sidebar_layout == 'right') {
		echo '<div class="articles-holder col-9 col">';
	} else if (empty($sidebar)) {
		echo '<div class="articles-holder col-12 col col-last">';
	}

	if ( have_posts() ): 
		while ( have_posts() ): the_post();
	?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <div class="post-content-holder">
        
            <?php get_template_part( 'includes/templates/template', get_post_format() );?>
            
            <div class="post-info">
				
				<div class="post-date">
					<span class="date"><?php echo get_the_time('d'); ?></span>
					<span class="month"><?php echo get_the_time('M'); ?></span>
				</div>
            
                <div class="post-info-inner">
                    <h2 class="post-title"><a href="<?php esc_url(the_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>
                    <?php themeone_single_meta() ?>
                </div>
                
            </div>
            
            <?php if (get_post_format() != 'quote' && get_post_format() != 'link') { ?>
            
            <?php 
            $ismore = @strpos( $post->post_content, '<!--more-->');
            if($ismore) { 
				the_content('');
			} else { 
				the_excerpt();
			}
            ?>

            <a class=" button" href="<?php esc_url(the_permalink()); ?>"><?php echo __('Read More', 'mobius'); ?></a>
            <?php } ?>
            
        </div>
        
        </article>
        
        <?php
        endwhile;
        endif;
		themeone_page_nav();
        ?>
    
	</div>
	
	<?php
	if ($sidebar && $sidebar_layout == 'right') {
		echo '<div id="sidebar" class="index col col-3 col-last" '. $sidebar_margin .'>';
		dynamic_sidebar($sidebar);
		echo '</div>';
	}
	?>
    
</div>

<?php 

} else {	

	get_template_part( 'template', 'blog' );
	
}

if (!empty($page_color)) {
	echo '</div>';
}

get_footer();

?>