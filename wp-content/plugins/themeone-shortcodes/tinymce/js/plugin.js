(function($) {

	var popup  = 1,
		title  = null;
		loadSC = false;
		displayShortcodeList();
	
	$(document).on('click', '.themeone-sc-generator', function(e) {
		e.preventDefault();
		if ($('#themeone-sc-popup-outer').length) {
			$('#themeone-sc-overlay, #themeone-sc-popup-outer').fadeIn(300);
			$('body').css('overflow','hidden');
			$('#themeone-sc-generator-choices').isotope({ filter: '*' });
			$('.to-sc-current-filter').text('All');
			$('.to-sc-filter').removeClass('active');
			$('div[data-filter=".all"').addClass('active');
		}
	})
	
	$(document).on('click', '.to-sc-button', function() {
		if ($(this).text() != $('.themeone-sc-name').text() && loadSC === false) {
			loadSC = true;
			popup = $(this).data('name');
			title = $(this).find('.to-sc-button-title').text();
			$('.themeone-sc-title').html('<div class="themeone-sc-loading"></div>loading...');
			loadShortcode();
		}
	})
	
	$(document).on('click', '#themeone-sc-prev', function() {
		if (loadSC === false) {
			$('.themeone-sc-title').text($('.themeone-sc-title').attr('data-title'));
			$('#themeone-sc-popup').removeClass('active-sc');
		}
	})
	
	$(document).on('click', '#themeone-sc-overlay, #themeone-sc-close, #themeone-sc-insert', function(e) {
		$('#themeone-sc-overlay, #themeone-sc-popup-outer').fadeOut(300);
		setTimeout(function() {	
			$('body').css('overflow','visible');
			$('#themeone-popup').html('');
			$('#themeone-sc-popup').removeClass('active-sc');
		}, 300);		
	})
	
	$(window).on('resize', function() {
		centerSC();
	})
	
	function displayShortcodeList(){
		var data = {
			action:'display_shortcode_list',
			popup:popup
		};
		$.post(ajaxurl, data, function(response) {
			$('body').append(response);
			$('#themeone-sc-home-inner').niceScroll({cursorwidth:0,cursorborder:'none'});
			centerSC();
			gridSC();
		});
	}
	function loadShortcode(){
		var data = {
			action:'load_shortcode',
			popup:popup
		};
		$.post(ajaxurl, data, function(response) {
			$('.themeone-sc-title').text(title);
			$('#themeone-sc-popup').addClass('active-sc');
			$('#themeone-popup').remove();
			$('#themeone-sc-content').append(response);
			$('.themeone-sc-content-inner').niceScroll({cursorwidth:0,cursorborder:'none'});
			$('.themeone-icons-holder').niceScroll({cursorwidth:0,cursorborder:'none'});
			loadSC = false;
		});
	}
	
	function centerSC(){
		var toscH = $('#themeone-sc-popup').height();
		var winH  = $(window).height();
		var winW  = $(window).width();
		var admin = 32;
		if (winW <= 782) {
			admin = 46;
		}
		var top = (winH - admin - toscH)/2;
		if (top < 0) {
			top = 0;
		}
		$('#themeone-sc-popup').css('top',top);
	}
	function gridSC(){
		$('#themeone-sc-generator-choices').isotope({
			itemSelector : '.to-sc-button',
		});
	}
	
	$(document).on('click', '.to-sc-filter', function() {
		var filter = $(this).data('filter');
		$('.to-sc-current-filter').text($(this).text());
		if (filter == '.all') {
			filter = '*';
		}
		$('#themeone-sc-generator-choices').isotope({ filter: filter });
		$('#themeone-sc-home-inner').getNiceScroll().resize();
		$('.to-sc-filter').removeClass('active');
		$(this).addClass('active');
	});
	
})(jQuery);


