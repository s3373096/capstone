jQuery(document).ready(function($){
	
	var count = null;
	for (var i = 2; i <= 10; i++) {
		var mapNb = '#section-map-point-'+i;
		$(mapNb).next('.form-table-section-indented').each(function(index, element) {
			var $this = $(this);
			var marker = $this.find('.upload-thumbnail').val();
			var latitude = $this.find('#latitude-'+i).val();
			var longitude = $this.find('#longitude-'+i).val();
			var info = $this.find('#map-info-'+i).val();
            if ( marker == '' && latitude == '' && longitude == '' && info == '') {
				$(mapNb).add($this).hide();
				if (count == null) {
					count = i-1;
					checkRemoveAdd();
				}
			}
        });
	}
   
	$('.add-remove-controls .add').click(function(e){
		e.preventDefault();
		count++;
		if (count <= 10) {
			var mapNb = '#section-map-point-'+count;	
			$(mapNb).add($(mapNb).next('.form-table-section-indented')).fadeIn(300);
			checkRemoveAdd();
		} 
	});
   
	$('.add-remove-controls .remove').click(function(e){
		e.preventDefault();
		if (count > 1) {
			var mapNb = '#section-map-point-'+count;	
			$(mapNb).add($(mapNb).next('.form-table-section-indented')).fadeOut(300);
			$(mapNb).next('.form-table-section-indented').find('.upload-thumbnail').val('');
			$(mapNb).next('.form-table-section-indented').find('#latitude-'+count).val('');
			$(mapNb).next('.form-table-section-indented').find('#longitude-'+count).val('');
			$(mapNb).next('.form-table-section-indented').find('#map-info-'+count).val('');
			count--;
			checkRemoveAdd();
		}
	});
	
	function checkRemoveAdd() {
		if (count == 10) {
			$('.add-remove-controls .add').fadeOut(300);
		} else if (count < 10) {
			$('.add-remove-controls .add').fadeIn(300);
		}
		if (count == 1) {
			$('.add-remove-controls .remove').fadeOut(300);
		} else if (count > 1) {
			$('.add-remove-controls .remove').fadeIn(300);
		}
	}
	
   
});