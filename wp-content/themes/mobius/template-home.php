<?php

/*template name: Home - FullGrid */

/**** page color ***/
$page_id    = get_queried_object_id();
$page_color = esc_attr(get_post_meta($page_id, 'themeone-page-bgcolor', true));
if (!empty($page_color)) {
	$page_color = 'style="background:'. $page_color .'"';
}
/**** page color ***/

get_header(); 

themeone_page_header($post->ID);

themeone_slider_init();

if(have_posts()) : while(have_posts()) : the_post();

the_content();

endwhile; endif;

echo '<section class="grid-home-page" '. $page_color .'>';

mobius_grid_init(
	'ajax',//Grid system pagination
	'grid',//Grid layout
	'post',//Item post type (both)
	12,//Item Number
	3,//Horizontal grid row number
	5,//Grid col number > 1600px
	4,//Grid col number < 1600px
	3,//Grid col number < 1280px
	2,//Grid col number < 1000px
	2,//Grid col number < 690px
	'',//Item ratio
	'',//Item post type size
	'',//Item portfolio type size
	'true',//Grid horizontal
	'',//Grid toggle horizontal layout/ vertical layout
	'true',//Grid filters
	'0',//Grid gutter width
	'',//Grid control horizontal position
	'',//Grid item order
	''//Portfolio item style
);

echo '</section>';

get_footer();

?>
