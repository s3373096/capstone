<?php get_header(); ?>

<div id="error-404">
	<h1>404</h1>
	<h2><?php echo __('Not Found.', 'mobius'); ?></h2>
    <h3><?php echo __('The page you requested does not exist.', 'mobius'); ?></h3>
    <a target="_self" class="to-button regular standard full-rounded to-button-bg to-icon-anim accentBg" href="<?php echo esc_url(home_url());?>">
	<span><?php echo __('Back to Home Page', 'mobius'); ?></span>
    <i class="to-button-icon fa fa fa-arrow-right"></i>
	</a>
</div>

<?php get_footer(); ?>

