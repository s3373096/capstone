<?php
global $mobius;
$search_ID = null;
$search_class = null;
if (!empty($mobius['ajax-search'])) {
	$search_ID = 'id="s"';
}
if (!empty($mobius['ajax-nav'])) {
	$search_class = 'ajaxify-search';
}
?>


<form action="<?php echo home_url(); ?>" method="GET" id="searchform" data-noresult="<?php echo __('No results found','mobius'); ?>">
	<input type="text" class="field search <?php echo $search_class ?>" name="s" <?php echo $search_ID ?> autocomplete="off" placeholder="<?php echo __('Start Typing...','mobius'); ?>" />
    <i class="fa fa-times accentColorHover"></i>
	<?php if (!empty($mobius['ajax-nav'])) {  ?>
		<a class="search_results_ajax" id="search_results_click" href="?s="></a>
	<?php } ?>
</form>