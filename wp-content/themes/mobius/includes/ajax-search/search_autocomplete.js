jQuery(document).ready(function ($){  

	var ie = (function(){
		var undef,v = 3,div = document.createElement('div'),all = div.getElementsByTagName('i');
		while (
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
			all[0]
		);
		return v > 4 ? v : undef;
	}());
	

	var currentSearch = null;
	var term;
	
	$("#search-container #s").on('keyup', function(){
		term = $(this).val();
		if(currentSearch != null) {
			currentSearch.abort();
		}
		if (term.length > 1) {
			ajax_search();
		} else {
			$('.loading-container').removeClass('ajax-load');
			$('#search-inner').find('.search-results').html('');
		}
	});
	
	function ajax_search() {
		currentSearch = $.ajax({
			beforeSend: function(xhr){
				$('#search-msg').html('');
				$('.loading-container').addClass('ajax-load');
			},
			type: 'POST',
			url: ajaxsearch.url,
			data: {
				action : 'search_autocomplete',
				term : term
			},
			error: function(xhr){},
			success: function(data){
				$('.loading-container').removeClass('ajax-load');
				$('#search-inner').find('.search-results').html('');
				if ($(data).find('.to-search-item').length) {
					$('#search-inner .search-results').append(data);
					searchScroll();
					if ((ie > 9 || !ie) && History.enabled) {
						$(document.body).ajaxify();
					}
				} else {
					$('#search-msg').html($('#searchform').data('noresult'));
				}
				$('.search-results .to-search-item').each(function(i) {
					var $this = $(this);
					if (!$this.parent().is('.show-item-result')) {
						$this.parent().addClass('show-item-result');
					}
					setTimeout(function() {
						$this .addClass('show-item-result');
					}, 80*i);
				});
			}
		});
	}
	
	var $searchSly;
	function searchScroll() {
		var $searchSly = $('#search-container');
		$searchSly.sly({
			speed: 800,
			easing: 'easeOutExpo',
			scrollBy: 120,
			syncSpeed: 0.1,
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			elasticBounds: 1
		});
		$searchSly.sly('reload');
		$searchSly.sly('toStart');
	}
	
	$(window).on('smartresize', function() {
		var $searchSly = $('#search-container');
		$searchSly.sly('reload');
		$('.loading-container').removeClass('ajax-load');
	});
	
});  