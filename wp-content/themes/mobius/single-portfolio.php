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

$side_bar_content = get_post_meta($post->ID, 'themeone-portfolio-sidebar', true);
$extended_content = get_post_meta($post->ID, 'themeone-extended-page', true);
global $mobius;
?>
	
    <div id="single-portfolio-section">
    
    	<?php if (empty($extended_content)) { ?>
        
    	<div class="section-container">
        
   			<div class="portfolio-page-pp col col-12">
			<?php 
			if(have_posts()) : while(have_posts()) : the_post(); 
			
				echo '<article id="post-'. get_the_ID() .'" class="'. implode(' ',get_post_class()) .'">';
				if (!empty($side_bar_content)) {
					echo '<div class="col col-8">';
				} else {
					echo '<div class="col col-12">';
				}
				
				if (get_post_format() != 'gallery' && !empty($mobius['portfolio-feature-image'])) {
					get_template_part( 'includes/templates/template', get_post_format() );
				}
				
				the_content();
				
				themeone_single_page_nav();

				//echo get_the_term_list($post->ID, 'portfolio_tag','<div class="post-tag-holder"><h5>'. __('Tags', 'mobius') .':</h5>&nbsp;&nbsp;',', ','</div>');

                echo '</div>';
				
				if (!empty($side_bar_content)) {
            ?>
                <?php 
					if ($mobius['portfolio-sidebar']) {
						$sidebar_scroll = 'data-sidebar-follow="true"';
					} else {
						$sidebar_scroll = null;
					}
                ?>
                <div class="col col-4 col-last portfolio-sidebar" <?php echo $sidebar_scroll; ?> >

                    <?php 
					echo apply_filters( 'the_content', $side_bar_content);
					
					$portfolio_attrs = get_the_terms( $post->ID, 'portfolio_attributes' );
					if (!empty($portfolio_attrs)) {
						echo '<ul class="to-portfolio-attrs">';
						foreach($portfolio_attrs as $attr){
							echo '<li><i class="fa fa-check accentColor"></i>' . $attr->name . '</li>';
						}	 
						echo '</ul>';
					}
						
					echo '</div>';
				}
                     
					?>
                    
				</article>
            </div>
			<div class="clear portfolio"></div>
			<?php 
			endwhile; 
			endif; 
			
			if ($mobius['portfolio-next-prev-post']) {
				themeone_prev_next_links($post->ID);
			}
			
			if ($mobius['portfolio-social']) {
				themeone_share(get_the_ID());
			}
			
			if ($mobius['portfolio-author']) {
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
				echo '<a id="to-author-count" href="'. get_author_posts_url(get_the_author_meta('ID')) .'">&nbsp;&nbsp;(';
				the_author_posts();
				echo ' '.__('articles', 'mobius');
				echo ')</a>'; 
				echo '</div>';	
				echo '<p id="to-author-desc">'; 
				the_author_meta('description');
				echo '</p>';
				themeone_to_author_link();
				echo '</div>';
			} 					

			if ($mobius['portfolio-comment']) {
				echo '<div class="clear"></div>';
				comments_template(); 
			}
			?>
            
		</div>
        
        <?php 
		} else {
			if(have_posts()) : while(have_posts()) : the_post();
				the_content();
			endwhile; endif;
			echo '<div class="section-container">';
			themeone_single_page_nav();
			comments_template();
			echo '</div>';
		}
		?>
        
	</div> 
    
<?php get_footer(); ?>