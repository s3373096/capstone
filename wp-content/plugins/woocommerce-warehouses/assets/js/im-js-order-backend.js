/**
 * Hellodev Inventory Manager - Order page warehouse destination
 */

jQuery(document).ready(function($) {

	if ($("#IM_Warehouse_destination").length) {

		if ($("#IM_Warehouse_destination").val() != "") {
			$(".edit_address").hide();
		}

		$("#IM_Warehouse_destination").change(function() {
			if ($(this).val() != "") {
				$(".edit_address").hide();
			} else {
				$(".edit_address").show();
			}
		});

		// select warehouse to all lines
		$("#IM_Warehouse_all_lines").change(function() {
			if ($(this).val() != "") {
				var all_lines = $(this).val();
				$('select[name^=warehouse]').each(function() {
					$(this).val(all_lines).change();
				});
			}
		});
	}

	// Hide save button
	if ($("button.save-action").length) {
		$("button.save-action").hide();
	}

});
