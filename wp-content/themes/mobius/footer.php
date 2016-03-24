	<?php 
	
	global $mobius;
	
	$is_shop = false;
	$callToClass = null;
	$page_ID = get_queried_object_id();
	if (class_exists('Woocommerce')) {
		if (is_woocommerce() && !is_product()) {
			$is_shop = true;
			$page_ID = woocommerce_get_page_id('shop');
		}
	}
	if (!empty($mobius['callTo-pages'])) {
		if (!empty($mobius['callTo-text']) && in_array($page_ID, $mobius['callTo-pages'])) { 
		?>
			<?php if (!empty($mobius['callTo-text'])) { ?>
			<a class="call-to-action-link" href="<?php echo esc_url($mobius['callTo-button-url']); ?>">
			<?php $callToClass = 'class="accentBgHover"'; ?>
			<div id="call-to-action" <?php echo $callToClass; ?> style="background:<?php echo esc_attr($mobius['callTo-bg']); ?>; color:<?php echo esc_attr($mobius['callTo-color']); ?>;">
				<div class="section-container">
					<span style="color:<?php echo esc_attr($mobius['callTo-color']); ?>;"><?php echo esc_attr($mobius['callTo-text']); ?></span>
				</div>
			</div>
			</a>
            <?php } ?>
		<?php 
		}
	}

	/*** footer background ***/
	$footerImg     = null;
	$fooTopOpc     = null;
	$fooBotOpc     = null;
	$fooTopCol     = null;
	$fooBotCol     = null;
	$fooTopBg      = null;
	$fooBotBg      = null;
	$footerBg      = null;
	$footerTopOver = null;
	$footerBotOver = null;
	
	/*** footer background main option ***/
	$footerBckm = $mobius['footer-background'];
	/*** footer background page option ***/
	$footerBckp = get_post_meta($page_ID, 'themeone-footerBg', true);
	/*** footer top/bottom page option ***/
	$footerTop = get_post_meta($page_ID, 'themeone-top-footer', true);
	$footerBot = get_post_meta($page_ID, 'themeone-bot-footer', true);
	
	if(is_archive() && $is_shop == false) {
		$footerBckp = null;
		$footerTop  = null;
		$footerBot  = null;
	}
	
	if ($footerBckm || $footerBckp ) {	
		if ($footerBckp) {
			$footerImg = esc_url(get_post_meta($page_ID, 'themeone-footerBg-image', true));
			$fooTopOpc = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-top-opacity', true));
			$fooBotOpc = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-bot-opacity', true));
			$fooTopCol = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-top-color', true));
			$fooBotCol = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-bot-color', true));
			$fooTopTxt = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-bot-txt', true));
			$fooBotTxt = esc_attr(get_post_meta($page_ID, 'themeone-footerBg-top-txt', true));
		} else {
			if(isset($mobius['footer-img']['url'])) { $footerImg = $mobius['footer-img']['url'];}
			$fooTopOpc = esc_attr($mobius['footerBg-top-opacity']);
			$fooBotOpc = esc_attr($mobius['footerBg-bot-opacity']);
			$fooTopCol = esc_attr($mobius['footerBg-top-color']);
			$fooBotCol = esc_attr($mobius['footerBg-bot-color']);
			$fooTopTxt = esc_attr($mobius['footerBg-top-txt']);
			$fooBotTxt = esc_attr($mobius['footerBg-bot-txt']);	
		}
		$footerBg = '<div id="footer-background" style="background-image: url('. $footerImg .')"></div>';
		$footerTopOver    = '<div id="footer-top-overlay" style="background:'. $fooTopCol .';opacity:'. $fooTopOpc .'"></div>';
		$footerBotOver    = '<div id="footer-bot-overlay" style="background:'. $fooBotCol .';opacity:'. $fooBotOpc .'"></div>';
	} else {
		$fooTopBg = 'style="background: '. $mobius['footer-bgcolor'] .'"';
		$fooBotBg = 'style="background: '. $mobius['footer-bottom-bgcolor'] .'"';	
		$fooTopTxt = $mobius['footer-color'];
		$fooBotTxt = $mobius['footer-bottom-color'];	
	}
	
	$fooBotTxt = 'style="color:'. $fooBotTxt .'"';	
	
	?>
        
	<footer id="footer">

    	<?php echo $footerBg;  ?>
        
        <?php if ($mobius['footer-widget'] && $footerTop == null) {  ?>


		<div id="footer-top" <?php echo $fooTopBg; ?>>
        
        	<?php echo $footerTopOver;  ?>

			<div id="footer-inner-top" class="section-container <?php echo $fooTopTxt; ?>">
                
				<?php 
                $footerColumns = (!empty($mobius['footer-columns'])) ? $mobius['footer-columns'] : '4'; 
				
				if($footerColumns == '2'){
					$footerColumnClass = 'col col-6';
				} else if($footerColumns == '3'){
					$footerColumnClass = 'col col-4';
				} else {
					$footerColumnClass = 'col col-3';
				}
				?>
                
                <div class="marg <?php echo $footerColumnClass;?>">
		              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 1') ) : else : ?>	
		              	  <div class="widget">		
						  	 <h4 class="widgettitle"><?php echo __('Widget Area 1','mobius'); ?></h4>
						 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>"><?php echo __('Click here to assign a widget to this area.','mobius'); ?></a></p>
				     	  </div>
				     <?php endif; ?>
				</div>
				
				<div class="marg <?php echo $footerColumnClass;?>">
		             <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 2') ) : else : ?>	
		                  <div class="widget">			
						 	 <h4 class="widgettitle"><?php echo __('Widget Area 2','mobius'); ?></h4>
						 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>"><?php echo __('Click here to assign a widget to this area.','mobius'); ?></a></p>
				     	  </div>
				     <?php endif; ?>
				</div>
				
				<?php if($footerColumns == '3' || $footerColumns == '4') { ?>
				<div class="marg <?php echo $footerColumnClass;?>">
					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 3') ) : else : ?>		
                        <div class="widget">			
                            <h4 class="widgettitle"><?php echo __('Widget Area 3','mobius'); ?></h4>
                            <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>"><?php echo __('Click here to assign a widget to this area.','mobius'); ?></a></p>
                        </div>		   
				<?php endif; ?> 
				</div>
				<?php } ?>
				
				<?php if($footerColumns == '4') { ?>
				<div class="marg <?php echo $footerColumnClass;?>">
					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 4') ) : else : ?>	
                        <div class="widget">		
                            <h4 class="widgettitle"><?php echo __('Widget Area 4','mobius'); ?></h4>
                            <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>"><?php echo __('Click here to assign a widget to this area.','mobius'); ?></a></p>
                        </div>
					<?php endif; ?>    
				</div>
				<?php } ?> 
                
			</div>
		</div>
		
        <?php } ?>
        
		<?php
		if ($mobius['footer-bottom'] && $footerBot == null) {
			$copyright = $mobius['footer-copyright'];
			$icons     = (isset($mobius['footer-social-icon']['Footer icons'])) ? $mobius['footer-social-icon']['Footer icons'] : 0;
			if(!empty($copyright) || isset($mobius['footer-social']) && count($icons) > 1 ) {
				echo '<div id="footer-bottom" '. $fooBotBg .'>';
				echo $footerBotOver;
				echo '<div id="footer-inner-bottom" class="section-container">';
				if(!empty($copyright)) {
					$copyright = $mobius['footer-copyright'];
					if(isset($mobius['footer-social']) && count($icons) > 1) {
						echo '<div class="col col-5">'; 
					} else {
						echo '<div class="col col-12 col-last">';
					}
					echo '<div id="copyright" '. $fooBotTxt .'>'. $copyright .'</div>';
					echo '</div>';
				}
				if(isset($mobius['footer-social']) && count($icons) > 1) {
					if($mobius['footer-social'] && count($icons) > 1) {
						echo '<div class="col col-7 col-last">'; 
					} else {
						echo '<div class="col col-12 col-last">';
					}
					echo '<div id="footer-social">';
					foreach($icons as $icon => $name) {
						if ($icon !== reset($icons)) {
							$url = 'url-'. $icon;
							if ($icon == 'email') {
								$icon = 'envelope';
								echo '<a target="_self" href="'. esc_url($mobius[$url]) .'" '. $fooBotTxt .'><i class="fa fa-'. $icon .'"></i></a>';
							} else {
								echo '<a target="_blank" href="'. esc_url($mobius[$url]) .'" '. $fooBotTxt .'><i class="fa fa-'. $icon .'"></i></a>';
							}
						}
					}
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
				echo '</div>';
			}
		}
		?>

	</footer>
    
    </div><!-- #inner-container -->
</div> <!-- #outer-container -->  
<?php 

global $mobius;
if(!empty($mobius['google-analytics'])) {
	echo $mobius['google-analytics']; 
}

wp_footer(); 

?>

</body>
</html>