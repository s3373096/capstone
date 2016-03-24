<?php

add_action('wp_enqueue_scripts', 'themeone_register_script');
function themeone_register_script(){
	$to_comment_msg = array(
		'processing' => __('Processing...', 'mobius' ),
		'success' => array(
			'comment' => __('Thanks for your comment. We appreciate your response.', 'mobius' ),
			'review'  => __('Thanks for your review. We appreciate your response.', 'mobius' ),
		),
		'error_string' => __('ERROR', 'mobius' ),
		'error' => array(
			'444' => __('No response, please try again.', 'mobius' ),
			'429' => __('Please slow down, you are posting to fast!', 'mobius' ),
			'409' => __('Server time out, please try again.', 'mobius' ),
			'408' => __('Sorry, an error occur, please try again or later.', 'mobius' ),
		),	
	);
    wp_register_script('themeone_ajax_comment', get_template_directory_uri() . '/includes/ajax-comments/ajax-comments.js', 'jquery', '1.0', TRUE);
	wp_enqueue_script('themeone_ajax_comment');
	wp_localize_script('themeone_ajax_comment', 'to_comment_msg', $to_comment_msg);
}

?>