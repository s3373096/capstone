<?php

global $mobius;
$post_id      = $post->ID;
$post_img_id  = get_post_thumbnail_id();
$post_thumb   = esc_url(wp_get_attachment_url( $post_img_id ));	
$post_alt     = get_post_meta( $post_img_id, '_wp_attachment_image_alt', true);	
$post_alt     = ($post_alt != 'alt=""' ? 'alt="'. esc_attr($post_alt) .'"' : '');	

if( !is_single() ) { ?>

<a href="<?php echo get_permalink(); ?>">
	<?php 
	if ($mobius['blog-standard-wide']) { 
		$image = aq_resize( $post_thumb, 1000, 490, true);
		if ($image) {
			echo '<img src="'. $image .'" class="post-image wp-post-image" '. $post_alt .' />';
		}
	} else {
		echo get_the_post_thumbnail($post_id, 'full', array('class' => 'post-image'));
	}
	
	?>
</a>
<?php } else { 
	echo get_the_post_thumbnail($post_id, 'full', array('class' => 'post-image'));
} ?>

