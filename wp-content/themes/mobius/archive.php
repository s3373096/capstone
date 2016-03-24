<?php get_header(); ?>

	<div class="to-page-heading standard">
		<div class="section-container">
			<div class="col col-12 col-last">
				<div class="col col-6 col-last">
					<h1 class="single-title">	
                    <?php 
					global $wp_query;
					$resultNb = $wp_query->found_posts;
					echo $resultNb;
					
					if ($resultNb > 1) {
						echo __(' archives ', 'mobius');
					} else {
						echo __(' archive ', 'mobius');
					}
					 
					if (is_category()) {
						echo __('found in "', 'mobius');
						single_cat_title();
					} elseif( is_tag() ) {
						echo __('found for "', 'mobius');
						single_tag_title();
					} elseif (is_day()) {
						echo __('found for "', 'mobius');
						echo get_the_time('F jS, Y');
					} elseif (is_month()) {
						echo __('found for "', 'mobius');
						echo get_the_time('F, Y');
					} elseif (is_year()) {
						echo __('found for "', 'mobius');
						echo get_the_time('Y');
					} elseif (is_author()) {
						echo __('posted by "', 'mobius');
						the_author();
					} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
						echo __('found in Blog', 'mobius');
					} 
					echo '"';
					?>
                   </h1>
				</div>
			</div>
		</div>
	</div>
    
	<div class="section-container">
		<div id="to-crumbs-overlay"></div>
		<?php themeone_breadcrumbs(); ?>
	</div>
    
    <section>
    	<div class="section-container container-search">
			
        <?php if(have_posts()) : ?>
			<ul class="to-search-items clearfix">
				<?php 
				while (have_posts()) : the_post();
				global $more;
				$more = -1; 
				$post_id      = $post->ID;
				$post_type    = get_post_type( $post_id );
				$post_thumb   = get_the_post_thumbnail( $post_id ,'thumbnail');
				$post_title   = get_the_title();
				$post_link    = esc_url(get_permalink( $post_id ));
				$post_content = themeone_get_excerpt(300,'',$post_id);
				$post_date    = get_the_time('F j, Y');
				$post_like    = getPostLikeLink( $post_id );
				$post_coms    = '<span class="to-comment-icon"><i class="fa fa-comment-o"></i>'. get_comments_number() .'</span>';

				if ( $post_type == 'post' ) {
					$post_type = __('blog', 'mobius');
				} 
				?>
				<li class="to-search-item to-search-archive">
                	<div class="to-search-item-img">
                        <a href="<?php echo $post_link; ?>">
                        <?php
						if (get_post_format($post_id) == 'gallery') {
							$gallery_ids = themeone_grab_ids_from_gallery();
							if (!empty($gallery_ids)) {
								$post_thumb  = array_slice($gallery_ids, 0, 1);
								$post_thumb  = array_shift($post_thumb);
								$post_thumb  = wp_get_attachment_image($post_thumb, 'thumbnail');
								echo $post_thumb;
							}
						} else {
							if ( $post_thumb != '' ) {
								echo $post_thumb; 
							} else if ( $post_thumb == '' && $post_type == 'page') {
								echo '<i class="fa fa-file-text-o accentBgHover"></i>';
							} else if ( $post_thumb == '' && $post_type == 'blog') {
								echo '<i class="fa fa-pencil accentBgHover"></i>';
							} else if ( $post_thumb == '' && $post_type == 'portfolio') {
								echo '<i class="fa fa-picture-o accentBgHover"></i>';
							} else if ( $post_thumb == '' && $post_type == 'product') {
								echo '<i class="steadysets-icon-bag accentBgHover"></i>';
							}
						}
						?>
                        </a>
					</div>
                    <div class="to-search-item-content">
                        <h3 class="accentColorHover"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></h3>
                        <?php themeone_single_meta() ?>
                        <div class="to-search-item-excerpt"><p><?php echo $post_content; ?></p></div>
                    </div>
				</li>
				<?php 
				endwhile; 
				?>
			</ul>
			<?php else: ?>
			<h6 class="to-search-noresult"><?php echo __('Sorry, there are no posts to display.', 'mobius'); ?><br /><?php echo __('Please try to search again...', 'mobius'); ?></h6>
			<?php endif; ?>

			<?php themeone_page_nav(); ?>

        </div>
    </section>
			

<?php get_footer(); ?>
