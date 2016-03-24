<?php 

function themeone_colors() {

	global $mobius;
	
	/* Logo Height */
	$logo_height         = $mobius['header-logo-height'];
	
	/* Accent color */
	$accent_color1       = $mobius['accent-color1'];
	$accent_color1_txt   = $mobius['accent-color1-txt'];
	$accent_color2       = $mobius['accent-color2'];
	$accent_color3       = $mobius['accent-color3'];
	/* text color schemes */
	$body_color_scheme   = $mobius['body-color'];
	$body_text_light     = $mobius['body-text-light'];
	$heading_text_light  = $mobius['heading-text-light'];
	$body_text_dark      = $mobius['body-text-dark'];
	$heading_text_dark   = $mobius['heading-text-dark'];
	
	/* Links color*/
	$link_color     = $mobius['link-color'];
	
	/* Main body text color */
	$body_bgcolor        = $mobius['body-bgcolor'];
	/* Second text color schemes */
	$second_bgcolor      = $mobius['second-bgcolor'];
	/* Header colors */
	$header_bgcolor      = $mobius['header-bgcolor'];
	$header_color        = $mobius['header-color'];
	/* Menu colors */
	$header_menu_bgcolor = $mobius['header-menu-bgcolor'];
	$header_menu_color   = $mobius['header-menu-color'];
	$header_menu_colorh  = $mobius['header-menu-color-hover'];
	/* Footer color */
	$footer_bgcolor      = $mobius['footer-bgcolor'];
	/* Footer bottom colors */
	$footer_bot_bgcolor  = $mobius['footer-bottom-bgcolor'];
	$footer_bot_color    = $mobius['footer-bottom-color'];
	/* Sidebar color */
	$sidebar_bgcolor     = $mobius['sidebar-bgcolor'];
	/* Menu colors */
	$menu_bgcolor_over   = $mobius['menu-bgcolor-over'];
	$menu_bgcolor_over_o = $mobius['menu-bgcolor-over-opacity'];
	$menu_bgcolor        = $mobius['menu-bgcolor'];
	$nav_menu_bgcolor    = $mobius['nav-menu-bgcolor'];	
	
	function HEXLighter($col,$ratio) {
		$col =rgb($col);
		$lighter = Array(
			255-(255-$col[0])/$ratio,
			255-(255-$col[1])/$ratio,
			255-(255-$col[2])/$ratio
		);
		return "#".sprintf("%02X%02X%02X", $lighter[0], $lighter[1], $lighter[2]);
	}
	
	function HEXDarker($col,$ratio) {
		$col = rgb($col);
		$darker = Array(
			$col[0]/$ratio,
			$col[1]/$ratio,
			$col[2]/$ratio
		);
		return '#'.sprintf('%02X%02X%02X', $darker[0], $darker[1], $darker[2]);
	}
	
	function AverageColor($col1,$col2,$fact1,$fact2) {
		$col1 = rgb($col1);
		$col2 = rgb($col2);
		$avCol1 = $col1[0]*$fact1+$col2[0]*$fact2;
		$avCol2 = $col1[1]*$fact1+$col2[1]*$fact2;
		$avCol3 = $col1[2]*$fact1+$col2[2]*$fact2;
		return '#'.sprintf('%02X%02X%02X', $avCol1, $avCol2, $avCol3);
	}
	
	function HexTorgba($col,$alpha) {
		$col = rgb($col);
		return 'rgba('. $col[0] .','. $col[1] .','. $col[2] .','. $alpha .')';
	}
	
	function rgb($col) {
		return Array(hexdec(substr($col, 1, 2)), hexdec(substr($col, 3, 2)), hexdec(substr($col, 5, 2)));
	}
	
	/* To Item Grid Link LightBox */
	$itemLink = HexTorgba($accent_color1_txt,0.75);
	$itemLinkHover = HexTorgba($accent_color1_txt,0);
	
	echo '<style type="text/css">';
	
		echo '
		.to-lb-overlay,
		#search-overlay {
			background: #ffffff;
		}';
		
	/* ============================================================
	   LOGO HEIGHT
	/* ============================================================*/	
	
		echo '
		.website-logo img {
			min-height: '.$logo_height.'%;
			max-height: '.$logo_height.'%;
		}
		@media screen and (max-width: 480px) {	
		.website-logo img {
			min-height: '.$logo_height*0.8.'%;
			max-height: '.$logo_height*0.8.'%;
		}
		}';
	

	/* ============================================================
	   LINKS COLOR
	/* ============================================================*/
	
		echo '
		#single-post-section article a,
		#single-portfolio-section article a {
			color: '. $link_color .';
		}
		#single-post-section article a:hover,
		#single-portfolio-section article a:hover {
			color: initial !important;
		}
		';
	
	/* ============================================================
	   HEADER COLORS
	/* ============================================================*/
	
		echo '
		.headerColor {
			background: '. $header_bgcolor .';
			color: '. $header_color .';
		}
		#header .cart-counter *,
		#header .wishlist-link *,
		#header-container input.search,
		.search-close .fa-times {
			color: '. $header_color .';
		}
		.headerColor2 {
			background: '. $header_color .';
			color: '. $header_bgcolor .';
		}
		.header-mobile .sliding-sidebar-open,
		.search-button.no-nav {
			color: '. $header_color .';
		}
		.trans.dark .sliding-menu-open *,
		.trans.dark .sliding-sidebar-open * {
			fill: '. $body_text_dark .';
		}
		.trans.light .sliding-menu-open *,
		.trans.light .sliding-sidebar-open * {
			fill: '. $body_text_light .';
		}
		';
	
	/* ============================================================
	   FOOTER COLORS
	/* ============================================================*/
	
		echo '
		#to-slider {
			background: '. $footer_bgcolor .';
		}
		/*#footer-bottom,
		#footer-bottom #copyright,
		#footer-bottom #footer-social a {
			color: '. $footer_bot_color .';
		}*/
		
		';
	
	/* ============================================================
	   RIGHT SIDEBAR COLORS
	/* ============================================================*/
	
		echo '
		.sidebarColor {
			background: '. $sidebar_bgcolor .';
		}
		';
	
	/* ============================================================
	   LEFT NAV MENU COLORS
	/* ============================================================*/
	
		echo '
		#sliding-menu {
			background: '. $menu_bgcolor .';
		}
		#sliding-menu-overlay {
			background: '. $menu_bgcolor_over .';
			opacity: '. $menu_bgcolor_over_o .';
		}
		#left-nav {
			background: '. $nav_menu_bgcolor .';
		}
		.dark #left-nav > ul > li > a,
		.dark #left-nav li:hover > a,
		.dark #left-nav li:hover > a i,
		.dark #left-menu-shop li a,
		.dark #left-nav li.back-sub-menu span,
		.dark #left-nav li.back-sub-menu i,
		.dark #left-nav .left-cart-counter:hover *,
		.dark #left-nav .to-wishlist-counter:hover * {
			color: '. $heading_text_dark .';
		}
		.light #left-nav > ul > li > a,
		.light #left-nav li:hover > a,
		.light #left-nav li:hover > a i,
		.light #left-menu-shop li a,
		.light #left-nav li.back-sub-menu span,
		.light #left-nav li.back-sub-menu i,
		.light #left-nav .left-cart-counter:hover *,
		.light #left-nav .to-wishlist-counter:hover * {
			color: '. $heading_text_light .';
		}
		.sliding-menu-open *,
		.sliding-sidebar-open * {
			fill: '. $header_color .';
		}
		#left-nav ul li:before {
			background: #dddddd;
		}
		#left-nav ul li.current-menu-item:before ,
		#left-nav ul li.current_page_ancestor:before {
			background: '. $accent_color1 .';
		}
		
		';
	
	/* ============================================================
	   TEXT COLORS SCHEMES
	/* ============================================================*/
	
		$dark = '
		body.dark, .dark p, .dark div, .dark a,
		#header .buttons a,
		#header .quantity {
			color: '. $body_text_dark .';
		}
		.dark h1, .dark h2, .dark h3 , .dark h4, .dark h5, .dark h6,
		.dark h1 a, .dark h2 a, .dark h3 a, .dark h4 a, .dark h5 a, .dark h6 a,
		.dark.to-slide .to-slide-content-inner *,
		.dark dt,
		.dark .post-title a,
		.dark .summary .posted_in,
		#header .widget_shopping_cart_content .cart_list a,
		.dark table.cart td.product-name a,
		.dark .woocommerce-tabs ul.tabs li,
		.dark .comment-list .comment-author,
		.dark .comment-list .comment-author a,
		.dark .to-pie-chart span,
		.dark .to-progress-bar-title strong,
		.dark .to-counter-number span,
		.dark .to-counter-number-desc,
		.dark .to-sc-twitter-icon,
		.dark li.active-tab {
			color: '. $heading_text_dark .';
		}
		.dark .widget a {
			color: '. $heading_text_dark .';
		}
		.dark .widget a:hover {
			color: '. $accent_color1 .';
		}
		.dark.to-page-heading-img-true * {
			color: '. $heading_text_dark .';
		}
		.dark .to-grid-filters-button svg * {
			fill: '. $body_text_dark .';
		}
		
		.dark .post-info .post-date .date {
			color: '. $heading_text_dark .';
		}
		.dark .post-info .post-date .month {
			color: '. AverageColor($heading_text_dark,$body_text_dark,0.5,0.5) .';
		}
		.dark .post-info .post-date .year {
			color: '. $body_text_dark .';
		}
		.dark .owl-page.active span,
		.dark .owl-page:hover span {
			background: '. $body_text_dark .';
		}
		.dark .isotope-pages li.active,
		.dark .isotope-pages li:hover {
			background: '. $body_text_dark .' !important;
		}';
		
		$light = 'body.light, .light p, .light div, .light a {
			color: '. $body_text_light .';
		}
		.light h1, .light h2, .light h3, .light h4, .light h5, .light h6,
		.light h1 a, .light h2 a, .light h3 a, .light h4 a, .light h5 a, .light h6 a,
		.light.to-slide .to-slide-content-inner *,
		.light dt,
		.light .post-title a,
		.light .summary .posted_in,
		.light table.cart td.product-name a,
		.light .woocommerce-tabs ul.tabs li,
		.light .comment-list .comment-author,
		.light .comment-list .comment-author a,
		.light .to-pie-chart span,
		.light .to-progress-bar-title strong,
		.light .to-counter-number span,
		.light .to-counter-number-desc,
		.light .to-sc-twitter-icon,
		.light li.active-tab {
			color: '. $heading_text_light .';
		}
		.light .widget a {	
			color: '. AverageColor($heading_text_light,$body_text_light,0.9,0.1) .';
		}
		.light .widget a:hover {
			color: '. $accent_color1 .';
		}
		.light.to-page-heading-img-true * {
			color: #fff;
		}
		.light .to-grid-filters-button svg * {
			fill: '. $body_text_light .';
		}
		
		.light .post-info .post-date .date {
			color: '. $heading_text_light .';
		}
		.light .post-info .post-date .month {
			color: '. AverageColor($heading_text_light,$body_text_light,0.5,0.5) .';
		}
		.light .post-info .post-date .year {
			color: '. $body_text_light .';
		}
		.light .owl-page.active span,
		.light .owl-page:hover span {
			background: '. $body_text_light .';
		}
		.light .isotope-pages li.active,
		.light .isotope-pages li:hover {
			background: '. $body_text_light .' !important;
		}
		.light.to-page-heading .subtitle {
			color: #f3f5f8;
		}';

		if ($body_color_scheme == 'light') {
			echo $light.$dark;
		} else {
			echo $dark.$light;
		}

		/* ============================================================
		   MAIN BACKGROUND COLORS
		/* ============================================================*/
		
		echo '
		body,
		#body-overlay,
		#outer-container,
		#inner-container,
		.comment-list li,
		.comment-list li.comment > #respond {
			background: '. $body_bgcolor .';
		}
		';
		
		/* ============================================================
		   SECOND BACKGROUND COLORS
		/* ============================================================*/
		
		echo '
		#preloader,
		#header .widget_shopping_cart .cart_list li:hover,
		#to-crumbs-overlay,
		#to-author-bio-overlay,
		.to-grid-filter-overlay,
		code,
		.wp-caption,
		.to-team-carousel.circle .to-member-social li,
		.to-progress-bar-holder {
			background: '. $second_bgcolor .';
		}
		.grid-home-page .next-container {
			background: '. $second_bgcolor .' !important;
		}
		';
		
		/* ============================================================
		  AUDIO PLAYER COLORS
		/* ============================================================*/
	
		echo '
		.mejs-controls,
		.to-audio-player,
		#current-player-mini {
			background: #2B2D2F;
			color: #ffffff;
		}
		.to-item.blog .to-item-cat:hover {
			background: #2B2D2F !important;
			color: #ffffff !important;
		}
		.to-audio-player i,
		.to-audio-player span,
		.mejs-controls .mejs-playpause-button,
		.mejs-controls .mejs-button button,
		.mejs-controls .mejs-currenttime,
		.mejs-controls .mejs-duration {
			color: #ffffff !important;
		}
		';
		
		/* ============================================================
		   ACCENT COLOR
		/* ============================================================*/
	
		echo '
		.accentBg,
		.accentBgHover:hover,
		.mejs-time-current,
		.mejs-volume-current,
		.mejs-horizontal-volume-current,
		div.wpcf7-response-output,
		.woocommerce-info,
		.woocommerce-info *,
		.woocommerce .single_add_to_cart_button,
		.wishlist_table .add_to_cart,
		.woocommerce .woocommerce-message,
		.woocommerce .woocommerce-message a,
		.woocommerce .woocommerce-error,
		.woocommerce .woocommerce-error a,
		.woocommerce .product-wrap:hover .product_type_simple:hover,
		.woocommerce .product-wrap:hover .add_to_cart_button:hover,
		.woocommerce .widget_layered_nav_filters ul li a:hover,
		.woocommerce-page .widget_layered_nav_filters ul li a:hover,
		.widget_price_filter .ui-slider .ui-slider-range,
		#slider_per_page .ui-slider-range,
		select option:hover,
		.chosen-container ul.chosen-results li.highlighted,
		.active {
			background: '. $accent_color1 .' !important;
			color: '. $accent_color1_txt .' !important;
		}
		::selection {
			background: '. $accent_color1 .' !important;
			color: '. $accent_color1_txt .' !important;
		}
		::-moz-selection {
			background: '. $accent_color1 .' !important;
			color: '. $accent_color1_txt .' !important;
		}
		.woocommerce .single_add_to_cart_button,
		.wishlist_table .add_to_cart {
			border-color: '. $accent_color1 .' !important; 
		}
		.csstransforms .loading {
			border-left: 3px solid '. HexTorgba($accent_color1,.2) .';
			border-right: 3px solid '. HexTorgba($accent_color1,.2) .';
			border-bottom: 3px solid '. HexTorgba($accent_color1,.2) .';
			border-top: 3px solid '. $accent_color1 .';
		}
		.csstransforms .next-container.load {
			border-top: 2px solid '. $accent_color1 .';
		}
		.to-item.active {
			background: none !important;
		}
		
		.button:hover,
		input[type=submit]:hover,
		input[type="button"]:hover,
		input[type=submit]:hover,
		.header-pages li.active,
		#header .buttons a:hover,
		#header .total .amount,
		#header .widget_shopping_cart_content .cart_list a:hover,
		.grid-filter-title:hover, 
		.no-touch .isotopeFilters-title:hover, 
		.grid-home-page .next-container:hover,
		.to-grid-filter-title.actived,
		.to-item-overlay,
		.widget .tagcloud a:hover,
		.light .widget.widget_tag_cloud a:hover,
		.post-tags a:hover,
		.sliding-menu-open:hover > div,
		.widget.widget_tag_cloud a:hover,
		.comment-list .reply a:hover,
		.dark .comment-list .comment-author a:hover,
		input[type=submit]:hover, 
		button[type=submit]:hover,
		.to-page-nav li.active a,
		.to-page-nav li a:hover,
		.page-numbers .current,
		.page-numbers a:hover,
		.accentColor,
		.accentColorHover:hover,
		a.accentColor,
		a:not(.to-button):hover,
		.required,
		input[type=checkbox]:checked:before,
		input[type=radio]:checked:before,
		#header-container.trans.light .search-button:hover .fa-search,
		#header-container.trans.dark .search-button:hover .fa-search,
		.widget.widget_rss cite,
		.widget.widget_calendar #today,
		.required,
		.wpcf7-form .wpcf7-not-valid-tip,
		#comment-status,
		.comment-awaiting-moderation,
		.comment-list .comment-meta a:hover,
		#cancel-comment-reply-link:hover,
		#to-crumbs a:hover,
		#portfolio-all-items:hover i,
		.to-item-meta a:hover *,
		.to-excerpt-more:hover,
		.to-search-item-content h4 a:hover,
		.to-testimonial .to-testimonial-autor-desc,
		.to-team-carousel .to-member-social li a,
		.to-quote .fa-quote-left,
		.post-like:hover i,
		.post-like.liked,
		.post-like.liked i,
		.dark .post-like.liked,
		.dark .widget a.post-like.no-liked:hover i,
		.post-like .icon-to-x,
		.ui-menu-item:hover .title,
		.grid-home-page .to-grid-filter-title:hover,
		.blog-page .to-grid-filter-title:hover,
		.portfolio-page .to-grid-filter-title:hover,
		.no-touch .to-item.blog h2:hover,
		.no-touch .to-item.blog .to-item-author:hover,
		.no-touch .to-item.blog .to-item-comments:hover,
		.to-masonry .to-item.tall .to-excerpt-masonry:hover,
		.to-item-title-hover,
		.to-item-dot:before,
		.to-item-dot .before,
		.single-product-summary .amount,
		#comment-status p,
		.widget .total .amount,
		.woocommerce ul.products li.product h3:hover,
		a.woocommerce-review-link,
		a.woocommerce-review-link .count,
		.woocommerce ul.products li.product .price .amount, 
		.woocommerce-page ul.products li.product .price .amount,
		.woocommerce div.product .stock,
		.woocommerce-page div.product .stock,
		tbody .cart_item .product-name,
		.order-total .amount,
		.lost_password a,
		.posted_in a,
		.post-cat-holder a,
		.post-tag-holder a,
		.actived {
			color:  '. $accent_color1 .';
		}
		.to-item.blog.quote.center h2:hover,
		.to-item.blog.link.center h2:hover,
		.woocommerce-tabs .tabs li.active,
		.woocommerce-tabs .tabs li:hover,
		.no-menu-assigned:hover,
		#current-player.close .mejs-playpause-button:hover,
		.tweet-link-color,
		.stars .active,
		.featured .to-ptable-header h5 {
			color:  '. $accent_color1 .' !important;
		}
		.to-search-item .to-excerpt-more:hover {
			color:  '. $accent_color1 .' !important;
		}
		.sliding-menu-open:hover *,
		.sliding-sidebar-open:hover *,
		#left-menu-button:hover * {
			fill:  '. $accent_color1 .' !important; 
		}
		#call-to-action:hover *,
		#left-menu-button:hover * {
			color: '. $accent_color1_txt .' !important;
		}
		';
		
		/* ============================================================
		   GRID ELEMENT COLORS
		/* ============================================================*/
	
		echo '
		.grid-home-page .to-grid-filter-title:hover,
		.blog-page .to-grid-filter-title:hover,
		.portfolio-page .to-grid-filter-title:hover {
			color:  '. $accent_color1 .' !important;
		}
		.to-item .to-item-overlay,
		.to-item.blog .to-item-wrapper,
		.to-item.blog .to-item-social {
			background: #ffffff;
		}
		
		.to-item.blog .to-item-content h2 {
			color: '. $heading_text_dark .';
		}
		.to-item .excerpt,
		.to-item .to-item-social,
		.to-item.portfolio:not(.portstyle2) .to-item-cats {
			color: '. $body_text_dark .';
		}
		.to-item.blog .to-item-cat {
			background: '. $accent_color1 .';
		}
		.to-item.blog.center:not(.portstyle2) .to-item-information,
		.to-item.blog.center:not(.portstyle2) .to-item-information a {
			color: #e4e4e4;
		}
		.to-item.portfolio:not(.portstyle2) .to-item-wrapper,
		.to-item.portfolio:not(.portstyle2) h2,
		.to-item.portfolio:not(.portstyle2) h2 a {
			color: '. $heading_text_dark .';
		}
		.to-item.center:not(.portstyle2) .to-item-content,	
		.to-item.blog.center h2 a {
			color: #ffffff !important;
		}
		.to-item.blog.quote.center h2,
		.to-item.blog.link.center h2 {
			color: '. $heading_text_dark .' !important;
		}
		.to-item.portfolio h2:hover,
		.to-item.portfolio a:hover {
			color: '. $accent_color1 .' !important;
		}
		.to-item .to-item-lightbox-link,
		.to-item .to-item-lightbox-link i,
		.to-item .to-item-content-link,
		.to-item .to-item-content-link i,
		.to-item .to-item-audio-link,
		.to-item .to-item-audio-link i {
			color: '. $body_text_dark .';
		}
		.to-item.portfolio .to-item-lightbox-link:hover,
		.to-item.portfolio .to-item-lightbox-link:hover i,
		.to-item.portfolio .to-item-content-link:hover,
		.to-item.portfolio .to-item-content-link:hover i,
		.to-item.portfolio .to-item-audio-link:hover,
		.to-item.portfolio .to-item-audio-link:hover i {
			color: '. $accent_color1 .';
		}
		.to-item.blog.quote .to-item-content,
		.to-item.blog.link .to-item-content {
			background: #ffffff;
		}
		.blog-grid-fullwidth .to-item.blog.quote .to-item-content,
		.blog-grid-fullwidth .to-item.blog.link .to-item-content,
		.grid-home-page .to-item.blog.quote .to-item-content,
		.grid-home-page .to-item.blog.link .to-item-content {
			background: #f3f5f8;
		}
		';
	
		/* ============================================================
		   AJAX SEARCH RESULT COLORS
		/* ============================================================*/
	
		echo '
		.ui-autocomplete {
			background: #191919 !important;
		}
		.ui-menu, 
		.ui-menu .ui-menu-item,
		.image-autocomplete {
			background: rgba(31,31,31,0.95); 
			color: #EBEBEB;
		}
		.ui-menu-item .desc {
			color: #C1C1C1;
		}
		.ui-menu-item .ui-corner-all:hover,
		.ui-menu-item .ui-corner-all.ui-state-focus {
			background: rgba(0,0,0,.25) !important;
		}
		.ui-menu-item .fa-pencil {
			background: rgba(0,0,0,0.15);
		}
		';
	
		/* ============================================================
		   TOP NAV MENU COLORS
		/* ============================================================*/
	
		echo '
		#header-container.trans.light #top-nav > ul > li,
		#header-container.trans.light .sliding-sidebar-open,
		#header-container.trans.light .search-button .fa-search,
		#header.trans.light .to-wishlist-counter i,
		#header.trans.light .to-wishlist-counter span,
		#header.trans.light .cart-counter i,
		#header.trans.light .cart-counter span {
			color: #ffffff;
		}
		#header-container.trans.light .sliding-menu-open *,
		#header-container.trans.light .sliding-sidebar-open * {
			fill: #ffffff;
		}
		#header-container.trans.dark #top-nav > ul > li,
		#header-container.trans.dark .sliding-sidebar-open,
		#header-container.trans.dark .search-button .fa-search,
		#header.trans.dark .to-wishlist-counter i,
		#header.trans.dark .to-wishlist-counter span,
		#header.trans.dark .cart-counter i,
		#header.trans.dark .cart-counter span {
			color: #313131;
		}
		#header-container.trans.dark .sliding-menu-open *,
		#header-container.trans.dark .sliding-sidebar-open * {
			fill: #313131;
		}
		#header .widget_shopping_cart,
		.woocommerce .cart-notification,
		#header .wishlist-notification,
		#header .cart-notification,
		#top-nav .sub-menu {
			background: '. $header_menu_bgcolor .';
			color: '. $header_menu_color .';
		}
		#top-nav > ul > .megamenu > .sub-menu > li > a,
		#top-nav .sub-menu li:hover > a {
			color: '. $header_menu_colorh .';
		}
		#top-nav ul ul .current-menu-item > a,
		#top-nav > ul > .megamenu > .sub-menu > li:hover > a,
		#top-nav > ul > .megamenu > .sub-menu > li.current-menu-item:hover > a  {
			color: '. $accent_color1 .' !important;
		}
		#top-nav > ul > .megamenu > .sub-menu > li.current-menu-item > a {
			color: inherit !important;
		}
		#top-nav > ul > li > a.hover {
			border-color: '. $accent_color1 .';
		}
		';
	
		/* ============================================================
		   BORDER COLOR
		/* ============================================================*/
		
		echo '
		.dark *,
		.dark table tbody tr td:first-child,
		.dark .widget.widget_pages li a,
		.dark .widget.widget_nav_menu li a {
			border-color: #dddddd;
		}
		.light *,
		.light table tbody tr td:first-child,
		.light .widget.widget_pages li a,
		.light .widget.widget_nav_menu li a {
			border-color: #dddddd;
		}
		.comment-list .parent:after,
		.comment-list .children:before,
		.comment-list .children:after {
			border-color: #f3f5f8;
		}
		';
		
		/* ============================================================
		   Widget Color
		/* ============================================================*/
		
		echo '
		#sliding-sidebar .widget .no-post-like-image {
			background-color: '. HEXDarker($sidebar_bgcolor,$ratio=1.2) .' !important;
		}
		.button,
		input[type="button"],
		input[type=submit],
		.header-pages li, 
		.grid-filter-title, 
		.no-touch .isotopeFilters-title, 
		.grid-home-page .next-container,
		.to-grid-filter-title,
		.to-item-overlay,
		.widget .tagcloud a,
		.light .widget.widget_tag_cloud a,
		.post-tags a,
		.sliding-menu-open:hover > div,
		.widget.widget_tag_cloud a,
		.comment-list .reply a,
		input[type=submit], 
		button[type=submit],
		.to-page-nav li a,
		.to-page-nav li a {
			color: inherit;
		}
		
		';
		
		/* ============================================================
		   SC Icons Color
		/* ============================================================*/
		
		echo '
		.light .to-icon.full-bg {
			background: '. HEXDarker($body_text_light,$ratio=4) .';
		}
		.dark .to-icon.full-bg {
			background: '. HEXLighter($body_text_dark,$ratio=50) .';
		}
		';
		
		/* ============================================================
		   Woocommerce
		/* ============================================================*/
		
		echo '		
		.woocommerce ul.products li.product h3:hover,
		.woocommerce .product-desc-inner .button,
		.woocommerce .product-desc-inner .button:hover {
			color: '. $heading_text_dark .' !important;
		}
		';
	
	echo '</style>';
	
}

add_action('wp_head', 'themeone_colors');

?>