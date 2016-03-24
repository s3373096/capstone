jQuery.noConflict();

(function($) {
			
"use strict";
	
var $iframe;
var doc;

$('#vc_inline-frame').load(function(e){
	$iframe = $(this).contents();
	$(document).ajaxSuccess( function(evt, request, settings) {
		if ($iframe.find('.to-grid-container').length) {
			$iframe.find('.to-grid-container').each(function(){
				countFilter($(this));
			});
		}
		var width = $iframe.width();
		$iframe.width(width-1);
		$iframe.width(width);
	}); 	
});

function countFilter(el) {
	var catArray = [];
	el.each(function() {
		el.find('.to-item').each(function() {
			var cat = $(this).data('cat').split(';');
			for ( var i = 0; i < cat.length; i++ ) {
				var found = jQuery.inArray(cat[i], catArray);
				if (!catArray[cat[i]]) {
					catArray[cat[i]] = 0;
				}
				catArray[cat[i]] = catArray[cat[i]] + 1;
			}
		});	
	});
	el.find('.option-set .to-grid-filter-title').each(function() {
		var catName = $(this).data('filter');
		if (jQuery.inArray(catName,catArray)) {
			$(this).find('.to-grid-tooltip').html(catArray[catName]);
			if (catArray[catName] > 0) {
				$(this).show();
			} else {
				$(this).hide();
			}
		}
    });
	var countAll = parseInt(el.find('.to-item').length);
	if (countAll !== 0) {
		el.find('.option-set .to-grid-filter-title.all .to-grid-tooltip').html(el.find('.to-item').length);
		el.find('.option-set .to-grid-filter-title.all').show();
		el.find('.to-grid-filters ').show();
	} else {
		el.find('.to-grid-filters ').hide();
	}	
}


})(jQuery);