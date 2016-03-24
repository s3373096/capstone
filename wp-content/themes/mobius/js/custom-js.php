<?php 

function themeone_custom_js() {
	
global $mobius;
echo '<script type="text/javascript">
	 (function($) {
	 "use strict";';
echo $mobius['custom-js'];
echo '})(jQuery);
	  </script>';

}
add_action('wp_footer', 'themeone_custom_js', 100);

?>