<?php
/*
	Plugin Name: Most liked post
	Plugin URI: -
	Description: A simple widget that listed the most liked posts from users
	Version: 1.0
	Author: Themeone
	Author URI: -
*/


class themeone_most_liked_widget extends WP_Widget {

	// constructor
	function themeone_most_liked_widget() {
		parent::__construct(false, $name = __('Most liked post', 'themeone_most_liked_widget'));
	}

	// widget form creation
	function form($instance) {	
	// Check values
	
		if($instance) {
			 $title    = esc_attr($instance['title']);
			 $postType = esc_attr($instance['postType']);
			 $postNb   = esc_attr($instance['postNb']);
			 $postDate = esc_attr($instance['postDate'])? 'true' : 'false';
		} else {
			 $title    = 'Most liked posts';
			 $postType = 'post';
			 $postNb   = '5';
			 $postDate = 'true';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'themeone_most_liked_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id('postType'); ?>"><?php _e('Type of post to display', 'themeone_most_liked_widget'); ?></label>
		<select id="<?php echo $this->get_field_id( 'postType' ); ?>" name="<?php echo $this->get_field_name( 'postType' ); ?>" class="widefat">
			<option <?php if ( 'post' == $postType ) echo 'selected="selected"'; ?> value="post">Blog</option>
			<option <?php if ( 'portfolio' == $postType ) echo 'selected="selected"'; ?> value="portfolio">Portfolio</option>
            <option <?php if ( 'both' == $postType ) echo 'selected="selected"'; ?> value="both">Both</option>
		</select>
        </p>
        <p>
		<label for="<?php echo $this->get_field_id('postNb'); ?>"><?php _e('Number of posts to show:', 'themeone_most_liked_widget'); ?></label>
		<input id="<?php echo $this->get_field_id('postNb'); ?>" name="<?php echo $this->get_field_name('postNb'); ?>" type="text" size="3" value="<?php echo $postNb; ?>" />
		</p>
        <p>
        <input <?php checked( 'true', $postDate ); ?> class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('postDate'); ?>" name="<?php echo $this->get_field_name('postDate'); ?>" /> 
    	<label for="<?php echo $this->get_field_id('postDate'); ?>">Display post date?</label>
        </p>
		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title']    = strip_tags($new_instance['title']);
		$instance['postType'] = strip_tags($new_instance['postType']);
		$instance['postNb']   = strip_tags($new_instance['postNb']);
		$instance['postDate'] = strip_tags($new_instance['postDate']);
		return $instance;
	}

	// widget display
	function widget($args, $instance) {
		$title    = apply_filters('widget_title', $instance['title']);
		$postType = $instance['postType'];
		$postNb   = $instance['postNb'];
		$postDate = $instance['postDate'];
		if ($postType == 'both') {
			$postType = array('post', 'portfolio');
		}
		$args = array(
				 'post_type' => $postType,
				 'meta_key' => '_post_like_count',
				 'orderby' => 'meta_value_num',
				 'order' => 'DESC',
				 'ignore_sticky_posts' => 1,
				 'posts_per_page' => $postNb
			 );
		
		echo '<div class="widget widget-post-like">';	 
		echo '<h4>'. $title .'</h4>';
		echo '<ul>';
		$pop_posts = new WP_Query( $args );
		while ( $pop_posts->have_posts() ) {
			$pop_posts->the_post();
			if (get_post_format( $pop_posts->post->ID ) == 'gallery') {
				$gallery_ids = themeone_grab_ids_from_gallery();
				if (!empty($gallery_ids)) {
					$post_img  = array_slice($gallery_ids, 0, 1);
					$post_img  = array_shift($post_img);
					$post_img  = wp_get_attachment_image($post_img, 'thumbnail');
				}
			} else {
				$post_img = get_the_post_thumbnail($pop_posts->post->ID,'thumbnail');
			}
			if (!$post_img) {
				$post_img = '<div class="no-post-like-image"><i class="fa fa-pencil"></i></div>';
			}
			echo '<li>';
			echo '<a class="post-like-img" href="' . esc_url(get_permalink($pop_posts->post->ID)) . '">'. $post_img .'<div class="post-like-overlay accentBg">+</div></a>';
			echo '<a class="post-like-title" href="' . esc_url(get_permalink($pop_posts->post->ID)) . '">' . get_the_title() . '</a>';
			if ($postDate == 'on') {
				echo '<span class="post-like-date">'. get_the_date('F j, Y') .'</span> - ';
			}
			echo getPostLikeLink($pop_posts->post->ID);
			echo '<div class="clear"></div>';
			echo '</li>';
		}
		wp_reset_postdata();
		echo"</ul>";
		echo '</div>';
	}
	
}
add_action('widgets_init', create_function('', 'return register_widget("themeone_most_liked_widget");'));

?>
