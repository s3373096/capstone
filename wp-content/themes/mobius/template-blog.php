<?php 

global $mobius;

$page_id        = get_queried_object_id();
$page_color     = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
$sidebar        = get_post_meta($page_id, 'themeone-sidebar', true);
$sidebar_layout = get_post_meta($page_id, 'themeone-sidebar-position', true);
$sidebar_margin = esc_attr(get_post_meta($page_id, 'themeone-sidebar-margintop', true));

if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .' !important"';
}
if (empty($sidebar_layout)) {
	$sidebar_layout = 'right';
}
if (!empty($sidebar_margin)) {
	$sidebar_margin = 'style="margin-top: '. $sidebar_margin .'px;"';
}

if ($mobius['blog-filters']) {
	$filters = 'true';
} else {
	$filters = '';
}

$ratio = 0.7;

if (!is_front_page()) {
	$page_data    = get_page($page_id); 
	$page_content = do_shortcode($page_data->post_content);
} else {
	$page_content = null;
}

#-----------------------------------------------------------------#
# MASONRY 3 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'masonry 3cols') {
	
	echo '<section class="blog-page" '. $page_color .'><div class="section-container">';
	
	echo $page_content;
	
	global $mobius;
	$page_id = get_queried_object_id();
	$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
	
	if ($sidebar) {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'masonry',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
			2,//Horizontal grid row number
			2,//Grid col number > 1600px
			2,//Grid col number < 1600px
			2,//Grid col number < 1280px
			2,//Grid col number < 1000px
			1,//Grid col number < 690px
			'',//Item ratio
			'',//Item post type size
			'',//Item portfolio type size
			'',//Grid horizontal
			'',//Grid toggle horizontal layout/ vertical layout
			$filters,//Grid filters
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	} else {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'masonry',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
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
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	}

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# MASONRY 4 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'masonry 4cols') {
	
	echo '<section class="blog-page" '. $page_color .'><div class="section-container">';
	
	echo $page_content;
	
	mobius_grid_init(
		$mobius['blog-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'post',//Item post type
		$mobius['blog-item-nb'],//Item Number
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
		$mobius['blog-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		'',//Grid item order
		''//Portfolio item style
	);

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# MASONRY 5 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'masonry 5cols fullwidth') {
	
	echo '<section class="blog-page" '. $page_color .'>';
	
	echo $page_content;

	mobius_grid_init(
		$mobius['blog-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'post',//Item post type
		$mobius['blog-item-nb'],//Item Number
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
		$mobius['blog-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		'',//Grid item order
		''//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# MASONRY 6 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'masonry 6cols fullwidth') {
		
	echo '<section class="blog-page" '. $page_color .'>';
	
	echo $page_content;

	mobius_grid_init(
		$mobius['blog-pagination'],//Grid system pagination
		'masonry',//Grid layout
		'post',//Item post type
		$mobius['blog-item-nb'],//Item Number
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
		$mobius['blog-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		'',//Grid item order
		''//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# GRID 3 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'grid 3cols') {
	
	echo '<section class="blog-page" '. $page_color .'><div class="section-container">';
	
	echo $page_content;
	
	global $mobius;
	$page_id = get_queried_object_id();
	$sidebar = get_post_meta($page_id, 'themeone-sidebar', true);
	
	if ($sidebar) {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'grid',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
			2,//Horizontal grid row number
			2,//Grid col number > 1600px
			2,//Grid col number < 1600px
			2,//Grid col number < 1280px
			2,//Grid col number < 1000px
			1,//Grid col number < 690px
			$ratio,//Item ratio
			$mobius['blog-size'],//Item post type size
			'',//Item portfolio type size
			'',//Grid horizontal
			'',//Grid toggle horizontal layout/ vertical layout
			$filters,//Grid filters
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	} else {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'grid',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
			2,//Horizontal grid row number
			3,//Grid col number > 1600px
			3,//Grid col number < 1600px
			3,//Grid col number < 1280px
			3,//Grid col number < 1000px
			1,//Grid col number < 690px
			$ratio,//Item ratio
			$mobius['blog-size'],//Item post type size
			'',//Item portfolio type size
			'',//Grid horizontal
			'',//Grid toggle horizontal layout/ vertical layout
			$filters,//Grid filters
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	}

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# GRID 4 COLUMNS
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'grid 4cols') {
	
	echo '<section class="blog-page" '. $page_color .'><div class="section-container">';
	
	echo $page_content;
	
	if ($sidebar && (strrpos($mobius['blog-size'], 'wide') !== false || strrpos($mobius['blog-size'], 'square') !== false)) {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'grid',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
			2,//Horizontal grid row number
			2,//Grid col number > 1600px
			2,//Grid col number < 1600px
			2,//Grid col number < 1280px
			2,//Grid col number < 1000px
			2,//Grid col number < 690px
			$ratio,//Item ratio
			$mobius['blog-size'],//Item post type size
			'',//Item portfolio type size
			'',//Grid horizontal
			'',//Grid toggle horizontal layout/ vertical layout
			$filters,//Grid filters
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	} else {
		mobius_grid_init(
			$mobius['blog-pagination'],//Grid system pagination
			'grid',//Grid layout
			'post',//Item post type
			$mobius['blog-item-nb'],//Item Number
			2,//Horizontal grid row number
			4,//Grid col number > 1600px
			4,//Grid col number < 1600px
			4,//Grid col number < 1280px
			3,//Grid col number < 1000px
			2,//Grid col number < 690px
			$ratio,//Item ratio
			$mobius['blog-size'],//Item post type size
			'',//Item portfolio type size
			'',//Grid horizontal
			'',//Grid toggle horizontal layout/ vertical layout
			$filters,//Grid filters
			$mobius['blog-gutter'],//Grid gutter width
			'',//Grid control horizontal position
			'',//Grid item order
			''//Portfolio item style
		);
	}

	echo '</div></section>';
}

#-----------------------------------------------------------------#
# GRID 5 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'grid 5cols fullwidth') {
	
	echo '<section class="blog-page" '. $page_color .'>';
	
	echo $page_content;
	
	mobius_grid_init(
		$mobius['blog-pagination'],//Grid system pagination
		'grid',//Grid layout
		'post',//Item post type
		$mobius['blog-item-nb'],//Item Number
		2,//Horizontal grid row number
		5,//Grid col number > 1600px
		4,//Grid col number < 1600px
		3,//Grid col number < 1280px
		2,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		$mobius['blog-size'],//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['blog-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		'',//Grid item order
		''//Portfolio item style
	);

	echo '</section>';
}

#-----------------------------------------------------------------#
# GRID 6 COLUMNS FULLWIDTH
#-----------------------------------------------------------------#

if ($mobius['blog-layout'] == 'grid 6cols fullwidth') {
	
	echo '<section class="blog-page" '. $page_color .'>';
	
	echo $page_content;
	
	mobius_grid_init(
		$mobius['blog-pagination'],//Grid system pagination
		'grid',//Grid layout
		'post',//Item post type
		$mobius['blog-item-nb'],//Item Number
		2,//Horizontal grid row number
		6,//Grid col number > 1600px
		5,//Grid col number < 1600px
		4,//Grid col number < 1280px
		3,//Grid col number < 1000px
		2,//Grid col number < 690px
		$ratio,//Item ratio
		$mobius['blog-size'],//Item post type size
		'',//Item portfolio type size
		'',//Grid horizontal
		'',//Grid toggle horizontal layout/ vertical layout
		$filters,//Grid filters
		$mobius['blog-gutter'],//Grid gutter width
		'',//Grid control horizontal position
		'',//Grid item order
		''//Portfolio item style
	);

	echo '</section>';
} 

?>