jQuery.noConflict();

(function($) {
			
"use strict";

$(window).on('statechangecomplete', function() {
  vc_twitterBehaviour();
  vc_toggleBehaviour();
  vc_tabsBehaviour();
  vc_accordionBehaviour();
  vc_teaserGrid();
  vc_carouselBehaviour();
  vc_slidersBehaviour();
  vc_prettyPhoto();
  vc_googleplus();
  vc_pinterest();
  vc_progress_bar();
  vc_plugin_flexslider();
  vc_google_fonts();
});

$(document).on('click', 'i.icon-option', function() {
	$('i.icon-option').removeClass('active');
	$(this).addClass('active');
	var icon =  $(this).attr('value');
	$(this).closest('.wpb_el_type_icons').find('.icons_field').val(icon).text(icon);
});


$(document).on('click', '.to-accent-color', function() {
	$(this).closest('.to-accent-preset').find('.to-accent-color').removeClass('active');
	$(this).addClass('active');
	var color = $(this).data('accent-color');
	var bgcolor = $(this).css('background-color');
	$(this).closest('.wpb_el_type_custom_color').find('.themeone-color-field, .colorpicker_field, .wpb_vc_param_value').val(color);
	$(this).closest('.wpb_el_type_custom_color').find('.wp-color-result, .wpb_vc_param_value').css('background-color',bgcolor);
});

$(document).on('click','.vc-button-upload-themeone', function() {
	var $formfield = $(this);
	var send_attachment_bkp = wp.media.editor.send.attachment;
	wp.media.editor.send.attachment = function(props, attachment) {
		$formfield.nextAll('img').attr('src', attachment.url);
		$formfield.prev('input').val(attachment.url);
		wp.media.editor.send.attachment = send_attachment_bkp;
	}
	wp.media.editor.open();
	return false;
});

$(document).on('click','.vc-upload-remove-themeone', function(){
	var $formfield = $(this);
	$formfield.prevAll('input').val('');
	$formfield.nextAll('img').attr('src','');
});


$(document).ajaxSuccess( function(evt, request, settings) {
	if ($('.wpb_el_type_textarea_html:not(.tinymce-active)').length > 0) {
		if ($(this).find('.wp-editor-wrap').hasClass('tmce-active')) {
			$(this).find('.themeone-sc-generator').addClass('show');
		} else {
			$(this).find('.themeone-sc-generator').removeClass('show');
		} 
	}
}); 

window.vc_custom_silder = function(){ 
	$('.wpb_el_type_slider .themeone-slider-range').slider({ 
		range: 'max',
		slide: function(e,ui) {
			var sign = $(this).closest('.wpb_el_type_slider').find('input').data('sign');
			$(this).closest('.wpb_el_type_slider').find('input').val(ui.value+sign);
		},
		create: function (event, ui) {
			var sign = $(this).closest('.wpb_el_type_slider').find('input').data('sign');
			var step = $(this).closest('.wpb_el_type_slider').find('input').data('step');
			if (!step) {
				step = 1;
			}
			$(this).slider('option', 'min', $(this).siblings('input').data('min'));
			$(this).slider('option', 'max',  $(this).siblings('input').data('max'));
			$(this).slider('option', 'step',  step);
			$(this).slider('value', parseFloat($(this).siblings('input').val()));
			$(this).closest('.wpb_el_type_slider').find('input').val(parseFloat($(this).siblings('input').val())+sign);
		}
	});
}

window.vc_custom_color = function(){ 
	var thcolorOptions = {
		hide: true,
		palettes: true,
		change:	function( event, ui ) {
			$(this).closest('.wpb_el_type_custom_color').find('.to-accent-color').removeClass('active');
			$(this).closest('.wpb_el_type_custom_color').find('.wpb_vc_param_value').val($(this).wpColorPicker('color'));
		},
		clear: function( event, ui ) {
			$(this).closest('.wpb_el_type_custom_color').find('.custom_color_field').css('background-color','');
			$(this).closest('.wpb_el_type_custom_color').find('.custom_color_field').val('');
		},
	};
	$('.themeone-color-field').wpColorPicker(thcolorOptions);
};

})(jQuery);



