<?php

add_action( 'admin_enqueue_scripts', 'themeone_reorder_posts_scripts' );
function themeone_reorder_posts_scripts() {
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'reorder-posts', get_template_directory_uri() . '/includes/reorder-posts/reorder-posts.js' );
	wp_register_style( 'reorder-posts-css', get_template_directory_uri() . '/includes/reorder-posts/reorder-posts.css', false, '1.0' );
    wp_enqueue_style( 'reorder-posts-css' );
}

add_action( 'admin_menu', 'themeone_reorder_posts_menu' );
function themeone_reorder_posts_menu() {
	add_menu_page(
		'Reorder Grid',
		'Reorder Grid',
		'manage_options',
		'reorder-Grid',
		'themeone_reorder_post_type',
		'dashicons-list-view',
		'21.111'
	);
}

function themeone_reorder_post_type() {
?>
	<div class="wrap">
    	
		<h2><?php echo __('Reorder Themeone Grid','mobius'); ?></h2>
        <?php submit_button( 'Save Changes', 'primary', 'reorder-grid-save', true, array( 'id' => 'reorder-grid-save' ) ); ?>
		<p><strong><?php echo __('Simply drag the post up or down.','mobius'); ?><br><?php echo __('You also can change the size of each post in the grid thanks to the select list.','mobius'); ?></strong></p><br>
	<?php 
	$posts = new WP_Query( array( 'post_type' => array('post','portfolio'), 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) );
	if( $posts->have_posts() ) : 
	?>

		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order">Order</th>
					<th class="column-thumbnail">Thumbnail</th>
					<th class="column-title">Title</th>
                    <th class="column-type">Type</th>
                    <th class="column-author">Author</th>
                    <th class="column-size">Element Size</th>
				</tr>
			</thead>
			<tbody data-post-type="post">
			<?php 
			while( $posts->have_posts() ) : $posts->the_post(); 
			$meta_element_class = get_post_meta($posts->post->ID, 'themeone-element-class', true);
			if (get_post_type($posts->post->ID) == 'post') {
				$type = 'Blog';
			} else {
				$type = 'Portfolio';
			}
			?>
				<tr class="drag-order" id="post-<?php the_ID(); ?>">
					<td class="column-order"><i class="fa fa-arrows-alt"></i></td>
					<td class="column-thumbnail"><?php the_post_thumbnail( array(80,80) ); ?></td>
					<td class="column-title"><strong><?php the_title(); ?></strong></td>
                    <td class="column-type"><strong><?php echo $type; ?></strong></td>
                    <td class="column-author"><strong><?php the_author(); ?></strong></td>
                    <td class="column-size">
                    <?php if ($type == 'Blog') { ?>
                    <label class="label-arrow">
                        <select name="custom_element_grid_class" id="<?php the_ID(); ?>" class="select-size">
                            <option value="tall" <?php selected( $meta_element_class, 'tall' ) ?> >tall</option>
                            <option value="wide" <?php selected( $meta_element_class, 'wide' ) ?> >wide</option>
                            <option value="square left" <?php selected( $meta_element_class, 'square left' ) ?> >square left</option>
                            <option value="square top" <?php selected( $meta_element_class, 'square top' ) ?> >square top</option>
							<option value="normal center" <?php selected( $meta_element_class, 'normal center' ) ?> >normal center</option>
                            <option value="tall center" <?php selected( $meta_element_class, 'tall center' ) ?> >tall center</option>
                            <option value="wide center" <?php selected( $meta_element_class, 'wide center' ) ?> >wide center</option>
                            <option value="square center" <?php selected( $meta_element_class, 'square center' ) ?> >square center</option>
                        </select>
                    </label>
                    <?php } else { ?>
                    <label class="label-arrow">
                        <select name="custom_element_grid_class" id="<?php the_ID(); ?>" class="select-size">
                            <option value="normal" <?php selected( $meta_element_class, 'normal' ) ?> >normal</option>
                            <option value="tall" <?php selected( $meta_element_class, 'tall' ) ?> >tall</option>
                            <option value="wide" <?php selected( $meta_element_class, 'wide' ) ?> >wide</option>
                            <option value="square" <?php selected( $meta_element_class, 'square' ) ?> >square</option>
                        </select>
                    </label>
                    <?php } ?>
                    </td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="column-order">Order</th>
					<th class="column-thumbnail">Thumbnail</th>
					<th class="column-title">Title</th>
                    <th class="column-type">Type</th>
                    <th class="column-author">Author</th>
                    <th class="column-size">Element Size</th>
				</tr>
			</tfoot>

		</table>

	<?php else: ?>

		<p><?php echo __('No post found, why not','mobius'); ?></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</div>

<?php

}


add_action( 'wp_ajax_to_update_post_order', 'themeone_reorder_posts_update' );
function themeone_reorder_posts_update() {
	global $wpdb;
	
	$sizearray = $_POST['size_array'];
	foreach($sizearray as $key => $value) {
    	update_post_meta($key, 'themeone-element-class', $value);
	}
	
	$order = $_POST['order'];
	foreach( $order as $menu_order => $post_id ) {
		$post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
		$menu_order     = intval($menu_order);
		wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
	}
	
	die( '1' );
}


?>