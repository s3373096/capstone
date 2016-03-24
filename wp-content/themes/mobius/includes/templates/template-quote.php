<?php

global $mobius;
$post_id           = $post->ID;
$post_quote        = get_post_meta($post_id, 'themeone-post-quote', true);
$post_quote_author = get_post_meta($post_id, 'themeone-post-quote-author', true);

$img_id  = get_post_thumbnail_id();	
$img_url = esc_url(wp_get_attachment_url($img_id));

if ($post_quote != '') { 
?>

<div class="post-quote-inner">
	<div class="post-quote-img" style="background: url(<?php echo  $img_url ?>)"></div>
	<h2 class="accentColorHover"><a href="<?php esc_url(the_permalink()); ?>"><?php echo $post_quote ?></a></h2>
    <span class="post-quote-author"><?php echo  $post_quote_author ?></span>
    <svg class="to-item-quote" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="80px" height="80px" x="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<g><path d="M62.994,41.041c-4.342,0-7.978,3.634-7.978,7.977c0,4.341,3.028,7.269,6.865,7.269c0.809,0,1.617-0.101,2.02-0.303   c-0.899,3.602-4.307,7.642-7.513,9.387c-0.007,0.003-0.012,0.008-0.018,0.011c-0.024,0.013-0.048,0.031-0.071,0.044l0.003,0.002   c-0.355,0.19-0.605,0.552-0.605,0.983c0,0.388,0.208,0.713,0.505,0.916l-0.025,0.024l4.196,2.65l0.013-0.011   c0.189,0.143,0.413,0.242,0.668,0.242c0.184,0,0.35-0.054,0.504-0.132l0.021,0.019c6.26-4.443,10.401-11.206,10.401-18.78   C71.979,44.776,67.738,41.041,62.994,41.041z" style="color:<?php echo $mobius['body-text-dark'] ?>;fill:<?php echo $mobius['body-text-dark'] ?> !important"/><path d="M83.541,41.041c-4.342,0-7.978,3.634-7.978,7.977c0,4.341,3.028,7.269,6.865,7.269c0.809,0,1.617-0.101,2.02-0.303   c-0.899,3.602-4.307,7.642-7.513,9.387c-0.007,0.003-0.012,0.008-0.018,0.011c-0.024,0.013-0.048,0.031-0.071,0.044l0.003,0.002   c-0.355,0.19-0.605,0.552-0.605,0.983c0,0.388,0.208,0.713,0.505,0.916l-0.025,0.024l4.196,2.65l0.013-0.011   c0.189,0.143,0.413,0.242,0.668,0.242c0.184,0,0.35-0.054,0.504-0.132l0.021,0.019c6.26-4.443,10.401-11.206,10.401-18.78   C92.526,44.776,88.285,41.041,83.541,41.041z" style="color:<?php echo $mobius['body-text-dark'] ?>;fill:<?php echo $mobius['body-text-dark'] ?> !important"/></g></svg>
    
    
</div>

<?php 
} 
?>