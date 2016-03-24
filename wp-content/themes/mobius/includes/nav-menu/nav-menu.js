jQuery.noConflict();

(function($) {


	jQuery(document).ready(function($) {
		
		$('.additional-menu-field-image-position select').change(function () {
			var $this = $(this);
			var str = $this.find('option:selected').val();
			$this.closest('label').find('input').attr('value',str).text(str);
		});
		
		$('.additional-menu-field-image-position input').each(function () {
			var $this = $(this);
			var str = $this.val();
			$this.closest('label').find('select').val(str);
		});
		
		$('.additional-menu-field-image .button-upload-img').click(function(e) {
			var $formfield = $(this);
			var send_attachment_bkp = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment) {
				$formfield.nextAll('img').attr('src', attachment.url);
				$formfield.prev('input').val(attachment.url);
				$formfield.hide();
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			wp.media.editor.open();
			return false;
		});
	
	});
	
	


})(jQuery);
