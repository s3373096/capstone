<?php 

$post_id       = $post->ID;
$video_poster  = esc_url(get_post_meta($post_id, 'themeone-video-poster', true));
$video_m4v     = esc_url(get_post_meta($post_id, 'themeone-video-m4v', true));
$video_ogv     = esc_url(get_post_meta($post_id, 'themeone-video-ogv', true));
$video_embed   = str_replace('"',"'",get_post_meta($post_id, 'themeone-video-embed', true));

if ($video_embed != '' || $video_m4v != '' || $video_ogv != '') { 
?>

<div class="to-article-video-wrapper">
<?php if ($video_embed != '') { ?>
	<?php echo html_entity_decode($video_embed) ?>
<?php } else if ($video_m4v != '' || $video_ogv != '') { ?>
	<video controls style="width: 100%; height: 100%;" preload="none" poster="<?php echo $video_poster ?>">
<?php if ($video_m4v != '') { ?>
	<source type="video/mp4" src="<?php echo $video_m4v ?>" />
<?php } else if ($video_ogv != '') { ?>
	<source type="video/ogg" src="<?php echo $video_ogv ?>" />
<?php } ?>
	</video>
<?php } ?>
</div>

<?php 
} 
?>