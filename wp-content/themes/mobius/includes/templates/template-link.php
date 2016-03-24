<?php

global $mobius;
$post_id        = $post->ID;
$post_link_url  = esc_url(get_post_meta($post_id, 'themeone-post-link-url', true));
$post_link_from = get_post_meta($post_id, 'themeone-post-link-from', true);
$post_link      = get_post_meta($post_id, 'themeone-post-link', true);

if ($post_link != '') {
?>

<div class="post-link-inner">
	<h2><a target="_blank" class="no-ajaxy" href="<?php echo $post_link_url; ?>"><?php echo $post_link; ?></a></h2>
    <span class="post-link-from"><?php echo $post_link_from ?></span>
    <svg class="to-item-link" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<g><path d="M78.663,21.338c-7.552-7.552-19.648-7.79-27.486-0.713l-0.019-0.019L41.06,30.703c-1.831,1.831-3.216,3.936-4.187,6.176   c-1.937,0.841-3.775,1.983-5.419,3.468l-0.019-0.019L21.338,50.425c-7.797,7.797-7.797,20.439,0,28.237   c7.797,7.798,20.439,7.798,28.237,0l10.098-10.098l-0.019-0.019c1.484-1.644,2.627-3.482,3.467-5.419   c2.24-0.971,4.345-2.356,6.176-4.187l10.098-10.098l-0.019-0.019C86.452,40.985,86.214,28.889,78.663,21.338z M42.761,71.487   l-0.001,0.001c-3.935,3.935-10.314,3.935-14.248,0c-3.935-3.935-3.935-10.314,0-14.248l0.001-0.001l7.367-7.367   c0.865,3.321,2.579,6.466,5.18,9.068c2.602,2.602,5.747,4.315,9.067,5.181L42.761,71.487z M48.234,51.766   c-1.796-1.796-2.763-4.102-2.919-6.452c2.35,0.156,4.655,1.123,6.452,2.919c1.796,1.796,2.764,4.102,2.919,6.452   C52.336,54.528,50.03,53.562,48.234,51.766z M72.109,42.139l-0.619,0.619l-0.001,0.001l-0.001,0l-7.369,7.369   c-0.865-3.321-2.578-6.466-5.179-9.068c-2.602-2.602-5.748-4.314-9.069-5.18l7.369-7.369c0,0,0,0,0.001-0.001l0.001-0.001   l0.619-0.619l0.029,0.028c3.959-3.329,9.874-3.134,13.6,0.591s3.921,9.642,0.591,13.6L72.109,42.139z" style="color:<?php echo $mobius['body-text-dark'] ?>;fill:<?php echo $mobius['body-text-dark'] ?> !important"/>
</g></svg> 
</div>

<?php 
} 
?>