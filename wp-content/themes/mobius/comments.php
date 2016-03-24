<?php
/**********************************
 * WORDPRESS COMMENT FORM SYSTEM
 *********************************/


if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');
}

if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(__('No Comments', 'mobius'), __('One Comment', 'mobius'), __('% Comments', 'mobius') );?></h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ul class="comment-list">
		<?php //wp_list_comments(array('avatar_size' => 60)); ?>
        <?php wp_list_comments( 'type=comment&callback=themeone_comment' ); ?>
	</ul>

 <?php else : ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->
	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : 

$required_text = null;

$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply', 'mobius'),
  'title_reply_to'    => __( 'Leave a Reply to %s', 'mobius'),
  'cancel_reply_link' => __( 'Cancel Reply', 'mobius'),
  'label_submit'      => __( 'Submit Comment', 'mobius'),

  'comment_field' =>  '<div class="row"><div class="col col-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.', 'mobius'),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mobius'),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.', 'mobius') . ( $req ? $required_text : '' ) .
    '</p>',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row"> <div class="col col-4">' .
      '<label for="author">' . __( 'Name', 'mobius') .
      ' <span class="required">*</span></label> ' .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" /></div>',

    'email' =>
      '<div class="col col-4"><label for="email">' . __( 'Email', 'mobius') .
      ' <span class="required">*</span></label>' .
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" /></div>',

    'url' =>
      '<div class="col col-4 col-last"><label for="url">' .
      __( 'Website', 'mobius') . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div></div>'
    )
  ),
);

comment_form($args);

endif; 
?>