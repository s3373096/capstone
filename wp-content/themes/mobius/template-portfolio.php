<?php 

/*template name: Portfolio */

get_header();

themeone_page_header($post->ID);

themeone_slider_init();

global $mobius;
$page_id = get_queried_object_id();

if ($mobius['portfolio-filters']) {
	$filters = 'true';
} else {
	$filters = '';
}
if ($mobius['portfolio-size']) {
	$size = 'normal';
} else {
	$size = '';	
}
if ($mobius['portfolio-style'] == 'style2') {
	$ratio = 0.85;
} else {
	$ratio = 0.7;
}

/**** page color ***/
$page_color = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .'"';
}
/**** page color ***/

#-----------------------------------------------------------------#
# MASONRY 3 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'masonry 3cols') {
	
	echo '<section class="portfolio-page" '. $page_color .'><div class="section-container">';
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		3,//Grid col number > 1600px
		3,//Grid col number < 1600px
		3,//Grid col number < 1280px
		3,//Grid col number < 1000px
		1,//Grid col number < 690px
		'',//Item ratio
		'',//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# MASONRY 4 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'masonry 4cols') {
	
	echo '<section class="portfolio-page" '. $page_color .'><div class="section-container">';
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		4,//Grid col number > 1600px
		4,//Grid col number < 1600px
		4,//Grid col number < 1280px
		3,//Grid col number < 1000px
		2,//Grid col number < 690px
		'',//Item ratio
		'',//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# MASONRY 4 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'masonry 4cols fullwidth') {	
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';

	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		4,//Grid col number > 1600px
		4,//Grid col number < 1600px
		3,//Grid col number < 1280px
		2,//Grid col number < 1000px
		2,//Grid col number < 690px
		'',//Item ratio
		'',//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# MASONRY 5 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'masonry 5cols fullwidth') {	
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';

	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		5,//Grid col number > 1600px
		4,//Grid col number < 1600px
		3,//Grid col number < 1280px
		2,//Grid col number < 1000px
		2,//Grid col number < 690px
		'',//Item ratio
		'',//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# MASONRY 6 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'masonry 6cols fullwidth') {	
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';

	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		6,//Grid col number > 1600px
		5,//Grid col number < 1600px
		4,//Grid col number < 1280px
		3,//Grid col number < 1000px
		2,//Grid col number < 690px
		'',//Item ratio
		'',//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# GRID 3 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'grid 3cols') {
	
	echo '<section class="portfolio-page" '. $page_color .'><div class="section-container">';
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'grid',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		3,//Grid col number > 1600px
		3,//Grid col number < 1600px
		3,//Grid col number < 1280px
		3,//Grid col number < 1000px
		1,//Grid col number < 690px
		$ratio,//Item ratio
		'',//Item post type size
		$size,//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# GRID 4 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'grid 4cols') {
	
	echo '<section class="portfolio-page" '. $page_color .'><div class="section-container">';
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'grid',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		4,//Grid col number > 1600px
		4,//Grid col number < 1600px
		4,//Grid col number < 1280px
		3,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		'',//Item post type size
		$size,//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# GRID 4 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'grid 4cols fullwidth') {
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'grid',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		4,//Grid col number > 1600px
		4,//Grid col number < 1600px
		3,//Grid col number < 1280px
		2,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		'',//Item post type size
		$size,//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# GRID 5 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'grid 5cols fullwidth') {
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'grid',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		5,//Grid col number > 1600px
		4,//Grid col number < 1600px
		3,//Grid col number < 1280px
		2,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		'',//Item post type size
		$size,//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# GRID 6 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['portfolio-layout'] == 'grid 6cols fullwidth') {
	
	if(have_posts()) : while(have_posts()) : the_post();
		the_content();
	endwhile; endif;
	
	echo '<section class="portfolio-page" '. $page_color .'>';
	
	mobius_grid_init(
		$mobius['portfolio-pagination'],//Grid system pagination
		'grid',//Grid layout
		'portfolio',//Item post type
		$mobius['portfolio-item-nb'],//Item Number
		2,//Horizontal grid row number
		6,//Grid col number > 1600px
		5,//Grid col number < 1600px
		4,//Grid col number < 1280px
		3,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		'',//Item post type size
		$size,//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['portfolio-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		$mobius['portfolio-order'],//Grid item order
		$mobius['portfolio-style']//Portfolio item style
	);

	echo '</section>';
}

get_footer(); 

?>