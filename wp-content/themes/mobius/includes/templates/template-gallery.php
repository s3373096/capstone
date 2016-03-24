<?php 

global $mobius;
$post_id     = $post->ID;
$gallery_ids = themeone_grab_ids_from_gallery(); 
$attr = array( 'class' => "attachment-full wp-post-image" );

if (!empty($gallery_ids)) { 

$gallery_ids = (count($gallery_ids) > 5) ? array_slice($gallery_ids, 0, 5) : $gallery_ids;

?>
 
<ul class="post-gallery-slider"> 
	<?php
	foreach( $gallery_ids as $image_id ) {
		if( is_single() || $mobius['blog-standard-wide'] != 1) {
			echo '<li class ="gallery-slide">' . wp_get_attachment_image($image_id, '', false, $attr) . '</li>';
		} else {
			$post_thumb = wp_get_attachment_url( $image_id );
			if ($post_thumb) {
				$post_alt   = get_post_meta( $image_id, '_wp_attachment_image_alt', true);	
				$post_alt   = ($post_alt != 'alt=""' ? 'alt="'. esc_attr($post_alt) .'"' : '');	
				$image      = esc_url(aq_resize( $post_thumb, 1000, 490, true));
				echo '<li class ="gallery-slide"><img src="'. $image .'" class="attachment-full wp-post-image" '. $post_alt .' /></li>';
			}
		}
	}
	?>
</ul>

<?php

} else {
	echo get_the_post_thumbnail($post_id, 'full', array('class' => 'post-image'));
}
?>
