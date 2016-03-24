<?php 

$post_id       = $post->ID;
$audio_name    = esc_attr(get_post_meta($post_id, 'themeone-song-name', true));
$audio_artiste = esc_attr(get_post_meta($post_id, 'themeone-artiste-name', true));
$audio_cover   = esc_url(get_post_meta($post_id, 'themeone-album-image', true));
$audio_mp3     = esc_url(get_post_meta($post_id, 'themeone-audio-mp3', true));
$audio_ogg     = esc_url(get_post_meta($post_id, 'themeone-audio-ogg', true));

if ($audio_mp3 != '' || $audio_ogg != '') { 
?>

<div class="to-audio-player post-audio">
	<span class="to-audio-player-duration">00:00</span>
	<span class="to-audio-player-curtime">00:00</span>
	<div class="to-item-audio-link" data-mp3="<?php echo $audio_mp3  ?>" data-ogg="<?php echo $audio_ogg ?>" data-song-name="<?php echo $audio_name ?>" data-artist="<?php echo $audio_artiste ?>" data-cover="<?php echo $audio_cover ?>">
		<i class="fa fa-play"></i>
		<i class="fa fa-pause"></i>
	</div>
	<i class="fa fa-volume-up"></i>
	<i class="fa fa-volume-off"></i>
	<span class="time-float">
		<span class="time-float-current"></span>
		<span class="time-float-corner"></span>
	</span>
	<div class="to-item-time">
		<div class="to-item-currenttime accentBg"></div>
	</div>
</div>

<?php 
} 
?>







