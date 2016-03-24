<!DOCTYPE html>
<!--[if lte IE 7]> <html class="ie7" <?php language_attributes(); ?>> <![endif]-->  
<!--[if IE 8]>     <html class="ie8" <?php language_attributes(); ?>> <![endif]-->  
<!--[if IE 9]>     <html class="ie9" <?php language_attributes(); ?>> <![endif]-->  
<!--[if !IE]><!--> <html <?php language_attributes(); ?>>             <!--<![endif]--> 

<head>

<!-- Meta Tags -->
<!--[if ie]><meta content='IE=edge' http-equiv='X-UA-Compatible'/><![endif]-->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
<meta name="HandheldFriendly" content="true" /> 
<meta name="revisit-after" content="7 DAYS">
<meta name="robots" content="All">
<!--favicicon-->
<?php 

global $woocommerce, $yith_wcwl, $mobius;

$left_menu_but  = '';
$right_side_but = '';
$left_menu_bck  = '';
$data_header    = ''; 
$search_but     = '';
$right_offset   = '';

if($mobius['header-style'] === 'header-left') {
	$data_header = ' data-menu="left-nav"';
	$left_menu_but = '<div id="left-menu-button" class="dark">
					  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="30">
					  <rect x="1" y="9" width="18" height="2.5"></rect>
				      <rect x="1" y="15" width="18" height="2.5"></rect>
					  <rect x="1" y="21" width="18" height="2.5"></rect>
					  </svg></div>';
	if($mobius['right-sidebar'] == 1) {
		$right_side_but = '<div id="right-sidebar-button" class="sliding-sidebar-open accentColorHover dark">
						   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="30">
								<rect x="8" y="6" width="2.5" height="18"></rect>
								<rect x="0" y="14" width="18" height="2.5"></rect>
						   </svg></div>';
		$right_offset = 'right-offset';
	}
	if($mobius['search-button'] == 1) { 
		$search_but = '<div id="right-search-button" class="search-button dark no-nav '.$right_offset.'">
					   		<i class="fa fa-search accentColorHover"></i>
					   </div>';
	}
}

if(!empty($mobius['left-nav-image']['url'])) {	
	$left_menu_bck = 'style="background-image: url('.esc_url($mobius['left-nav-image']['url']).');"';
}

if(!empty($mobius['favicon']['url'])) {
?>
<link rel="shortcut icon" href="<?php echo esc_url($mobius['favicon']['url']); ?>" />
<?php }

if(!empty($mobius['apple-touch-icon']['url'])) {
?>
<link rel="apple-touch-icon" href="<?php echo esc_url($mobius['apple-touch-icon']['url']); ?>" />
<?php } ?>

<!--Website Title-->

<?php wp_head(); ?>

</head>

<body <?php body_class($mobius['body-color']);  echo $data_header;?>>

    <div id="wrapper-scroll">
        <div id="textarea-scroll"></div>
    </div>
	
    <?php if ($mobius['preloader'] == 1) {?>
	<div id="preloader">
		<?php  if(!empty($mobius['header-logo']['url'])) { ?>
			<img class="to-loader-logo" src="<?php echo esc_url($mobius['header-logo']['url']); ?>" alt=""/>
		<?php } ?>
        <div class="to-loader">
        <svg width="60px" height="60px" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
			<path class="to-loader-circlebg"
				fill="none"
				stroke="#dddddd"
				stroke-width="4"
				stroke-linecap="round"
				d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
            <path id='to-loader-circle'
				fill="none"
				stroke="<?php if (isset($mobius['accent-color1'])) { echo esc_attr($mobius['accent-color1']); }?>"
				stroke-width="4"
				stroke-linecap="round"
				stroke-dashoffset="192.61"
				stroke-dasharray="192.61 192.61"
				d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"
			/>
        </svg>
        </div>
    </div>
    <?php } ?>
    
    <?php if($mobius['right-sidebar'] == 1) { ?>
    
    <div id="sliding-sidebar" class="sidebarColor <?php echo $mobius['sidebar-color'];?>">
    	<div id="sliding-sidebar-inner">
    		<?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Side Bar Area 1')) ?> 
        </div>
    </div>
    
    <?php } ?>
   
	<div id="sliding-menu" class="<?php echo $mobius['menu-color']; ?>" <?php echo $left_menu_bck; ?>>	
    	<div id="sliding-menu-overlay"></div>
    	<div id="sliding-menu-inner">	
        	<?php  if(!empty($mobius['left-nav-logo']['url'])) { ?>
        	<div id="sliding-menu-logo"><a href="<?php echo home_url(); ?>"><img class="to-loader-logo" src="<?php echo esc_url($mobius['left-nav-logo']['url']) ; ?>" alt=""/></a></div>
            <?php } ?>
        	<nav id="left-nav">
                <ul class="left-menu">
                	<?php if(has_nav_menu('left-nav')) {
                    	wp_nav_menu(array('theme_location' => 'left-nav', 'walker' => new Left_Walker_Nav_Menu, 'container' => '', 'items_wrap' => '%3$s')); 
					} ?>
                </ul>
        	</nav>
            <?php if ($woocommerce) { ?>
            <ul id="left-menu-shop">
            <?php if ($woocommerce && $mobius['woo-cart']) { ?>
                <li class="left-cart-counter">
                    <a class="left-cart-link" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
						<i class="left-cart-icon fa fa-shopping-cart"></i>
                        <?php echo __('My Cart', 'mobius') ?>
						<span class="left-cart-number accentBg"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
					</a>
                </li>
            <?php } ?>
            <?php if ($yith_wcwl) { ?>
                <li class="to-wishlist-counter">
                    <a class="wishlist-link" href="<?php  echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                        <i class="fa fa-heart-o"></i>
                        <?php echo __('My Whilist', 'mobius') ?>
                        <span class="to-wishlist-number accentBg"></span>
                    </a>
                </li>
            <?php } ?>
            </ul>
            <?php } ?>
			<?php 
			ob_start();
			dynamic_sidebar('Menu Area');
			$menu_sidebar = ob_get_clean();
			if ($menu_sidebar) { ?>
            <div id="menu-widget">
            <?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Menu Area')) ?>
            </div>
			<?php } ?>
        	<div id="overflow-player"></div>
        	<div id="current-player">
        		<div id="current-cover"></div>
        		<div id="current-player-overlay">
            		<div id="current-title"></div>
            		<div id="current-artist"></div>
            	</div>
                <i class="current-player-close icon-to-x accentColorHover"></i>
                <div id="current-player-mini">
                    <i class="current-player-open icon-to-right-arrow-thin accentColorHover"></i>
                </div>
                <audio class="menu-player">
                    <source type="audio/mp3" src="<?php echo esc_url(get_template_directory_uri() .'/audio/blank.mp3'); ?>" />
                    <source type="audio/ogg" src="<?php echo esc_url(get_template_directory_uri() .'/audio/blank.ogg'); ?>" />
                    <source type="audio/aac" src="<?php echo esc_url(get_template_directory_uri() .'/audio/blank.aac'); ?>" />
                </audio>
			</div>
        </div>
	</div>
    
	<?php 
	echo $left_menu_but;
	echo $right_side_but; 
	echo $search_but;
	?>
    
    <div id="body-overlay"></div>
    
    <?php  
	if($mobius['header-fixed'] == 1) { 
		$header_fixed = 'fixed';
	} else {
		$header_fixed = null;
	}
	if($mobius['header-resize'] == 1 && $header_fixed == 'fixed') {
		$header_resize     = 'true';
		$header_size       = esc_attr($mobius['header-max-height']);
		$header_height     = esc_attr($mobius['header-height']);
		$header_max_height = esc_attr($mobius['header-max-height']);
	} else {
		$header_resize = '';
		$header_size       = esc_attr($mobius['header-height']);
		$header_height     = esc_attr($mobius['header-height']);
		$header_max_height = esc_attr($mobius['header-height']);
	}
	$header_style = $mobius['header-style'];
	$header_link  = $mobius['header-link'];
	?>
    
    <?php if($mobius['header-style'] !== 'header-left') { ?>
    
    <header id="header" class="<?php echo $header_style; ?> <?php echo $header_fixed; ?> clearfix" data-header-type="<?php echo $header_style; ?>" data-header-rezise="<?php echo $header_resize;?>" data-header-height="<?php echo $header_height;?>" data-header-max-height="<?php echo $header_max_height;?>" data-menu-link="<?php echo $header_link; ?>">
            <div id="header-overlay-slider" style="opacity:<?php echo $mobius['header-slider-opacity']; ?>;"></div>
            <div id="header-overlay" class="headerColor"  style="opacity:<?php echo $mobius['header-opacity']; ?>;"></div>
            <div id="header-container" style="height:<?php echo $header_size; ?>px;" class="section-container">
				<div class="sliding-menu-open">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="30">
						<rect x="1" y="9" width="18" height="2.5"></rect>
						<rect x="1" y="15" width="18" height="2.5"></rect>
						<rect x="1" y="21" width="18" height="2.5"></rect>
					</svg>
				</div> 
            	<div class="website-logo">
                	<a href="<?php echo home_url(); ?>">
                   		<?php  if(!empty($mobius['header-logo']['url'])) { ?>
                			<img class="logo-dark" src="<?php echo esc_url($mobius['header-logo']['url']); ?>" alt=""/>
                        <?php } ?>
                        <?php  if(!empty($mobius['header-logo-light']['url'])) { ?>
                        <img class="logo-light" src="<?php echo esc_url($mobius['header-logo-light']['url']); ?>" alt=""/>
                        <?php } ?>
					</a>
                </div>
				<nav id="top-nav" class="headerColor">
                    <ul class="top-menu">
						<?php if(has_nav_menu('top-nav')) {
							wp_nav_menu(array('theme_location' => 'primary', 'walker' => new Arrow_Walker_Nav_Menu, 'theme_location' => 'top-nav', 'container' => '', 'items_wrap' => '%3$s')); 
						}
						else {
                            echo '<li><a class="no-menu-assigned" href="'. esc_url(admin_url('nav-menus.php')) .'">'. __('No menu assigned!','mobius') .'</a></li>';
                        } ?> 
                        <?php if($mobius['search-button'] == 1) { ?> 
						<li class="search-button no-nav clearfix">
							<i class="fa fa-search accentColorHover"></i>
						</li>
                		<?php } ?>
						<?php if($mobius['right-sidebar'] == 1) { ?>
						<li class="sliding-sidebar-open accentColorHover">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="30">
								<rect x="8" y="6" width="2.5" height="18"></rect>
								<rect x="0" y="14" width="18" height="2.5"></rect>
							</svg>
						</li>
                		<?php } ?>
					</ul>   
				</nav>
                <?php if($mobius['search-button'] == 1) { ?> 
				<div class="search-button no-nav clearfix">
					<i class="fa fa-search accentColorHover"></i>
				</div>
				<?php } ?>
				<?php if($mobius['right-sidebar'] == 1) { ?>
				<div class="sliding-sidebar-open no-nav accentColorHover">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="30">
						<rect x="8" y="6" width="2.5" height="18"></rect>
						<rect x="0" y="14" width="18" height="2.5"></rect>
					</svg>
				</div>

				<?php } ?>
            </div>
            
            <div id="to-woo-icons-menu">
            <?php if ($yith_wcwl) { ?>
                <div class="to-wishlist-counter">
                	<div class="to-wishlist-inner">
                    <a class="wishlist-link" href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                        <i class="fa fa-heart-o"></i>
                        <span class="to-wishlist-number"></span>
                    </a>
                    </div>
                </div>
                <div class="wishlist-notification">
                    <span class="item-product"></span>
                    <?php echo __('was successfully added to your wishlist.','mobius'); ?>
                </div>
            <?php } ?>
            <?php if ($woocommerce && $mobius['woo-cart']) { ?>
                <div class="cart-counter">
                	<div class="cart-counter-inner">
                    <a class="cart-link" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
						<i class="cart-icon fa fa-shopping-cart"></i>
						<span class="cart-number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
					</a>
					</div>
                </div>
                <div class="cart-notification">
                    <span class="item-product"></span>
                    <?php echo __('was successfully added to your cart.','mobius'); ?>
                </div>
                <?php
                if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
                    the_widget( 'Custom_WC_Widget_Cart', 'title=' );
                } else {
                    the_widget( 'WooCommerce_Widget_Cart', 'title=' );
                }
			}
			?>
            </div>
            <div id="cantPlay" class="accentBg"><i class="fa fa-times"></i><?php echo __('  It can\'t be played in your browser. Download ','mobius'); ?><a class="dlSong no-ajaxy" href=""><i class="fa fa-download"></i></a></div>
    </header>
    
     <?php } ?>
    
    <?php  if( get_header_image() != '' ) { ?>
	<img id="custom_header" src="<?php esc_url(header_image()); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="" />
    <?php  } ?>
    
    <div id="search-container" class="dark">
    	<div id="search-inner" class="section-container">
			<?php get_search_form(); ?>
        	<div class="search-results"></div>
        </div>
        <div id="search-overlay"></div>
        <div id="search-msg"></div>
    </div>
    
    <?php if ($mobius['scroll-to-top'] == 1 ) { ?>
	<div id="scrollToTop">
    	<div id="scrollToTop-inner">
            <div id="scrollToTop-overlay" class="accentBgHover">
                <i class="fa fa-angle-up"></i>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <div class="loading-container">
        <div class="loading"></div>
	</div>
    
    <?php
	$woo_version = null;
    if ($woocommerce) {
		$woo_version = 'data-wc-version="'. $woocommerce->version .'"';
	}
	?>
	   
    <div id="outer-container" <?php echo $woo_version ?>>
        <div id="push-anim-overlay"></div>
        <div id="vc-spacer" style="height:<?php echo esc_attr($header_size); ?>px;"></div>
           <div id="inner-container" class="<?php echo esc_attr($mobius['body-color']); ?>">
            	<?php
				$page_id    = get_queried_object_id();
                $page_color = get_post_meta($page_id, 'themeone-page-bgcolor', true);
                if (!empty($page_color)) {
                    $page_color = 'background:'. esc_attr($page_color);
                }
				?>
        		<div id="header-spacer" style="height:<?php echo esc_attr($header_size); ?>px;<?php echo esc_attr($page_color); ?>"></div>
        
        