// Ajaxify
// v1.0.1 - 30 September, 2012
// https://github.com/browserstate/ajaxify
(function(window,undefined){

	// Prepare our Variables
	var xhr      = null,
		History  = window.History,
		$        = window.jQuery,
		document = window.document;

	// Check to see if History.js is enabled for our Browser
	if ( !History.enabled ) {
		return false;
	}

	// Wait for Document
	$(function(){
		// Prepare Variables
		
		/* Application Specific Variables */
		var contentSelector = '#inner-container',
			$content        = $(contentSelector).filter(':first'),
			contentNode     = $content.get(0),
			$menu           = $('.top-menu,.left-menu'),
			activeClass     = 'current-menu-item',
			activeSelector  = '.current-menu-item',
			childSelector   = 'li,a',
			completedName   = 'statechangecomplete',
			/* For comment click hashtag */
			comment  = false,
			comments = false,
			commentNb,
			headerHeight = parseInt($('#header').attr('data-header-height')),
			/* Application Generic Variables */
			$window = $(window),
			$body   = $(document.body),
			rootUrl = History.getRootUrl();
		
		// Ensure Content
		if ( $content.length === 0 ) {
			$content = $body;
		}
		
		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack){
			// Prepare
			var $this = $(obj),
				url = $this.attr('href')||'',
				isInternalLink;
			
			// Check link
			isInternalLink = url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;
			
			// Ignore or Keep
			return isInternalLink;
		};
		
		// HTML Helper
		var documentHtml = function(html){
			// Prepare
			var result = String(html)
				.replace(/<\!DOCTYPE[^>]*>/i, '')
				.replace(/<(html|head|body|title|meta|script)([\s\>])/gi,'<div class="document-$1"$2')
				.replace(/<\/(html|head|body|title|meta|script)\>/gi,'</div>')
			;
			
			// Return
			return $.trim(result);
		};
		
		// Ajaxify Helper
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this);
			// Ajaxify
			$this.find('a:internal:not(:contains(checkout),:contains(Checkout),:contains(Cart),:contains(cart),:contains(Account),:contains(account), .no-ajaxy, #left-nav .menu-link-parent,.widget_icl_lang_sel_widget a, #lang_sel_footer a, .menu-item-language a, .stars a, .chosen-single, .widget_shopping_cart .buttons a, .product-img-wrap .add_to_cart_button.product_type_simple, .product-remove a, .yith-wcwl-add-to-wishlist a, .wishlist_table a, .cart-collaterals .wc-proceed-to-checkout a, a.showlogin, a.showcoupon, .no-ajaxy.menu-item a)').click(function(event){
				// Prepare
				var $this = $(this),
					url   = $this.attr('href')||null,
					title = $this.attr('title')||null;
				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) { 
					return true; 
				}
				// Redirect wordpress comments
				if (url.indexOf('#comment-') != -1) {
					commentNb = url.split('#comment-').pop();
					url = url.replace('#comment-'+commentNb,'');
					if ($(location).attr('href').replace('#comment-'+commentNb,'') != url) {
						comment = true;
					} else {
						if ($('.comment-list').length) {
							var commentPos = $('#div-comment-'+commentNb).offset().top;
							$('html, body').animate({scrollTop: commentPos - headerHeight - 20 +'px'}, 500);
						}
					}
				} else if (url.indexOf('#comments') != -1) {
					url = url.replace('#comments','');
					if ($(location).attr('href') != url) {
						comments = true;
					} else if ($('.comment-list').length) {
						var commentPos = $('#comments').offset().top;
						$('html, body').animate({scrollTop: commentPos - headerHeight - 30 +'px'}, 500);	
					}
				}
				// Ajaxify this link
				History.pushState(null,title,url);
				event.preventDefault();
				return false;
			});
			
			// Chain
			return $this;
		};
		
		// Ajaxify our Internal Links
		$body.ajaxify();

		// Hook into State Changes
		$window.bind('statechange',function(){
			
			// Prepare Variables
			var State = History.getState(),
				url = State.url,
				relativeUrl = url.replace(rootUrl,'');

			// Abort previous ajax requests
			if (xhr) {
                xhr.abort();
            }
			
			// Ajax Request the Traditional Page
			xhr = $.ajax({
				url: url,
				beforeSend: function() {
					$('#header-container, #header').removeClass('light dark trans');
					$('body').addClass('ajax-load');
					setTimeout(function() {
				 		$('html, body').animate({scrollTop: 0}, 200); 
					}, 300);
				},
				success: function(data, textStatus, jqXHR){

					$('html, body').animate({scrollTop: 0}, 0);
					// Prepare
					var $data = $(documentHtml(data)),
						$dataBody = $data.find('.document-body:first'),
						$dataContent = $dataBody.find(contentSelector).filter(':first'),
						$menuChildren, contentHtml;
					//$dataContent = $dataContent.find('script').remove();
					
					// Fetch the content
					contentHtml = $dataContent.html()||$data.html();
					if ( !contentHtml ) {
						document.location.href = url;
						return false;
					}
					
					// Update the menu
					$menuChildren = $menu.find(childSelector);
					$menuChildren.filter(activeSelector).removeClass(activeClass);
					$menuChildren.removeClass('current-menu-item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor');
					$menu.find('a[href="'+ url +'"],a[href="'+ url +'/"]').parents('li').addClass(activeClass);
	
					// Update the content
					$content.html(contentHtml).ajaxify();
					$('body').removeClass('ajax-load');
	
					// Update the title
					document.title = $data.find('.document-title:first').text();
					try {
						document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;').replace('>','&gt;').replace(' & ',' &amp; ');
					}
					catch ( Exception ) { }
	
					// Complete the change
					$('.loading-container').removeClass('ajax-load');
					$window.trigger(completedName);
						
					//Prevent header to disappear on scroll long page
					$('#header').attr('style','');
						
					//check if comment link was clicked and find it if true
					if (comments === true) {
						if ($('.comment-list li').length) {
							setTimeout(function() {
								var commentPos = $('#comments').offset().top;
								$('html, body').animate({scrollTop: commentPos - headerHeight - 30 +'px'}, 1000);
							}, 500);
						}
						comments = false;
					} else if (comment === true) {
						setTimeout(function() {
							if ($('.comment-list').length) {
								var commentPos = $('#div-comment-'+commentNb).offset().top;
								$('html, body').animate({scrollTop: commentPos - headerHeight - 20 +'px'}, 1000);
							}
						}, 500);
						comment = false;
					}
		
					// Inform Google Analytics of the change
					if ( typeof window._gaq !== 'undefined' ) {
						window._gaq.push(['_trackPageview', relativeUrl]);
					}
	
					// Inform ReInvigorate of a state change
					if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
						reinvigorate.ajax_track(url);
						// ^ we use the full url here as that is what reinvigorate supports
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					// aborting actually triggers error with textstatus=abort 
					if (textStatus != "abort") { 
					   document.location.href = url;
					   return false;
					}
				}
			}); // end ajax

		}); // end onStateChange

	}); // end onDomLoad

})(window); // end closure