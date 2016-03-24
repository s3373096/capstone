<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="clear"></div>
    
    <?php themeone_share(get_the_ID()); ?>
    
	<div class="to-tabs-holder tab full-width txt-center">
		<ul class="to-tabs">
       		<li class="to-tabs-overlay"></li>
            <li class="to-tabs-line accentBg"></li>
			<?php 
			$active = 'class="active-tab"';
			foreach ( $tabs as $key => $tab ) : 
			?>
				
				<li <?php echo $active; ?>>
					<span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></span>
				</li>

			<?php 
			$active = null;
			endforeach; 
			?>
			
		</ul>
        
        <div class="to-tabs-content clearfix">
		<?php 
		$active = 'active-tab';
		foreach ( $tabs as $key => $tab ) : 
		?>
			<div class="to-tab <?php echo $active; ?>">
            	<div class="col col-8  col-last">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>
			</div>
		<?php 
		$active = null;
		endforeach;
		?>
        </div>
	</div>

<?php endif; ?>