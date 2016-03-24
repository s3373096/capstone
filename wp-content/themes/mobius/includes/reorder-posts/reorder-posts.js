jQuery(function($) {
	var theOrder;
	$('#sortable-table tbody').sortable({
		axis: 'y',
		handle: '.drag-order td, .column-order, .column-thumbnail, .column-title, .column-type, .column-size, .column-author',
		placeholder: 'ui-state-highlight',
		forcePlaceholderSize: true,
		update: function(event, ui) {
			theOrder = $(this).sortable('toArray');
		}
	}).disableSelection();
	
	
	
	$('#reorder-grid-save').click(function() {
 
		$('body').append('<div id="save-message">Saving data...</div>');
		
		var size_array = {};
		
		$("[name=custom_element_grid_class]").each(function(){	
			var element = $(this);
			var selected = element.find('option:selected'); 
			var size = selected.val(); 
			var id = $(element).attr('id');
			size_array[id] = size;
		});

		var data = {
			action: 'to_update_post_order',
			size_array: size_array,
			order: theOrder
		};
		
		$.post(ajaxurl, data, function(response) {
			$('#save-message').html('Settings Saved');
			$('#save-message').fadeOut(500, function() {
				$('#save-message').remove();
			});
		});
		
	});

});