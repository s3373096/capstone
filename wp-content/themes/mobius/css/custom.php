<?php 

function themeone_custom_css() {
	
global $mobius;

echo '<style type="text/css">';
if(!empty($mobius['custom-css'])) {
	echo $mobius['custom-css'];
}
echo '</style>';


}
add_action('wp_head', 'themeone_custom_css');

?>