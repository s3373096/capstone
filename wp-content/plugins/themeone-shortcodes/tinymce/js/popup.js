jQuery(document).ready(function($) {
    var themeone = {
    	loadVals: function() {
    		var shortcode = $('#_themeone_shortcode').html(),
    			uShortcode = shortcode;
    		$('#themeone-sc-content .themeone-input').each(function() {
				if ($(this).is('.themeone-multi-input')){
					var multi = '';
					$('.to-multi-input').each(function() {
						multi = multi+$(this).val()+';';
					});
					$('#themeone-sc-content .themeone-multi-input').attr('value',multi.slice(0,-1)).text(multi.slice(0,-1));
				}
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('themeone_', ''),
    				re = new RegExp('{{'+id+'}}','g'),
					val = input.val();
				if (input.attr('type') == 'checkbox') {
					val = input.prop('checked');
					if (val === false) {
						val= '';
					}
				}
				if (input.attr('type') != 'radio' || input.attr('type') == 'radio' && input.prop('checked') ) {
    				uShortcode = uShortcode.replace(re, val);
				}
    		});
    		$('#_themeone_ushortcode').remove();
    		$('#themeone-sc-form-table').prepend('<div id="_themeone_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function() {
			var ccShortcode = '';
    		var shortcode = $('#_themeone_cshortcode').html(),
    			pShortcode = '';
    			shortcodes = '';
    		$('.child-clone-row').each(function() {
				
				$(this).find('.themeone-input-child').each(function() {
					var value = $(this).val();
					if (value != '') {
						ccShortcode = ccShortcode+'[themeone_li]'+value+'[/themeone_li](/BREAK)';
					}
				})
				$('.child-clone-row input.themeone-multi-input').val(ccShortcode).text(ccShortcode);
				ccShortcode = '';
				
    			var row = $(this),
    				rShortcode = shortcode;
    			$('.themeone-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('themeone_', '')
    					re = new RegExp("{{"+id+"}}","g");
						val = input.val();
    				if (input.attr('type') == 'checkbox') {
						val = input.prop('checked');
						if (val === false) {
							val= '';
						}
					}
					if (input.attr('type') != 'radio' || input.attr('type') == 'radio' && input.prop('checked') ) {
    					rShortcode = rShortcode.replace(re, val);
					}
    			});
    			shortcodes = shortcodes + "\n" + rShortcode + "\n";
    		});
    		$('#_themeone_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_themeone_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_themeone_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		// add updated parent shortcode
    		$('#_themeone_ushortcode').remove();
    		$('#themeone-sc-form-table').prepend('<div id="_themeone_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function() {
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			if( $('.child-clone-row').size() > 1 ) {
    				row.remove();
    			}
    			return false;
    		});
    		// assign jUI sortable
    		$( '.child-clone-rows' ).sortable({
				placeholder: 'sortable-placeholder',
				items: '.child-clone-row'
			});
    	},
    	load: function() {
			// Load google font 
			selectFont();
			// Load wordpress ColorPicker 
			$('.themeone-color-field').wpColorPicker(thcolorOptions);
			// Load wordpress ui Slider range
			
			$('.themeone-sc-content .themeone-slider-range').slider({ 
				range: 'max',
				value: 0,
				slide: function(e,ui) {
					sign = $(this).siblings('input').data('sign');
					$(this).closest('.themeone-sc-content').find('.themeone-slider-input').val(ui.value+sign);
				},
				create: function (event, ui) {
					sign = $(this).siblings('input').data('sign');
					step = $(this).siblings('input').data('step');
					if (!step) {
						step = 1;
					}
					$(this).slider('option', 'min', $(this).siblings('input').data('min'));
					$(this).slider('option', 'max',  $(this).siblings('input').data('max'));
					$(this).slider('option', 'step',  step);
					$(this).slider('value', $(this).siblings('input').val());
					$(this).closest('.themeone-sc-content').find('.themeone-slider-input').val($(this).siblings('input').val()+sign);
				}
			});
			
    		var	themeone = this,
    			popup = $('#themeone-popup'),
    			form = $('#themeone-sc-form', popup),
    			shortcode = $('#_themeone_shortcode', form).text(),
    			popupType = $('#_themeone_popup', form).text(),
    			uShortcode = '';
    		// initialise
    		themeone.children();
			// when icon is clicked
			$('i.icon-option').on('click', function() {
				$('i.icon-option').removeClass('active');
				$(this).addClass('active');
				var icon =  $(this).attr('value');
				$(this).closest('.themeone-sc-content').find('input.themeone-icon-value').val(icon).text(icon);
			});
			$(document).on('click', 'i.icon-option-child', function() {
				$(this).parent().find('i.icon-option-child').removeClass('active');
				$(this).addClass('active');
				var icon =  $(this).attr('value');
				$(this).closest('.child-clone-row-field').find('input.themeone-icon-value').val(icon).text(icon);
			});
			// Wordpress image upload
			$(document).on('click','.button-upload-themeone', function() {
				var $formfield = $(this);
				var send_attachment_bkp = wp.media.editor.send.attachment;
				wp.media.editor.send.attachment = function(props, attachment) {
					$formfield.nextAll('img').attr('src', attachment.url);
					$formfield.prev('input').val(attachment.url);
					$formfield.hide();
					$formfield.closest('div').find('.upload-remove-themeone').show();
					wp.media.editor.send.attachment = send_attachment_bkp;
				}
				wp.media.editor.open();
				return false;
			});
			// Wordpress remove image
			$(document).find('.upload-remove-themeone').on('click', function(){
				var $formfield = $(this);
				$formfield.prevAll('input').val('');
				$formfield.nextAll('img').attr('src','');
				$formfield.hide();
				$formfield.closest('div').find('.button-upload-themeone').show();
			})
			// when icon is clicked
			$(document).on('click', '.to-accent-color', function() {
				$(this).closest('.to-accent-preset').find('.to-accent-color').removeClass('active');
				$(this).addClass('active');
				var color = $(this).data('accent-color');
				var bgcolor = $(this).css('background-color');
				$(this).closest('.themeone-sc-content').find('.themeone-color-field').val(color);
				$(this).closest('.themeone-sc-content').find('.wp-color-result').css('background-color',bgcolor);
			});

    		
    		
    	}
	}
	
	// when insert is clicked
	$(document).on('click','#themeone-sc-insert', function() {				
    	if(window.tinyMCE) {
			themeone.loadVals();
			themeone.cLoadVals();
			var shortcode = $('#_themeone_ushortcode').html().replace(/\(\/BREAK\)/g, '<br>').replace(/\(\PARA\)/g, '<p>').replace(/\(\/PARA\)/g, '</p>');
			if ($('.button.themeone-sc-generator').data('wp-version') < 3.9) { 
				window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.id, 'mceInsertRawHTML', false, shortcode);
			} else {
				window.tinyMCE.execCommand('mceInsertContent', false, shortcode);
			}
		}
    });
    // run
    $('#themeone-popup').livequery( function() { themeone.load(); } );
	// color picker
	var thcolorOptions = {
		defaultColor: true,
		hide: true,
		palettes: true,
		change:	function( event, ui ) {
			$(this).closest('.themeone-sc-content').find('.to-accent-color').removeClass('active');
		}
	};
	
	function selectFont() {	
		if ($('.google-fonts').length) {
			var font_family = $('.google-fonts').find(":selected").text();
			if ($('.google-font-preview').css('font-family') != font_family) {
				$('#themeone_family').html('');
				var font_variants = $('.google-fonts').find(":selected").data('font-variants').split(';');
				var font_weight = String(font_variants[0]).replace(/[a-zA-Z ]/g, '');
				var font_variant = String(font_variants[0]).replace(/[0-9]/g, '');
				var font_urls = $('.google-fonts').find(":selected").data('font-urls').split(';');
				
				for ( var i = 0, l = font_variants.length; i < l; i++ ) {
					//;'+font_urls[i]+'
					$('#themeone_family').append('<option value="'+font_family+';'+font_variants[i]+'" data-font-family="'+font_family+'" data-font-variant="'+font_variants[i]+'" data-font-urls="'+font_urls[i]+'">'+String(font_variants[i]).replace(/[a-zA-Z ]/g, '')+' '+String(font_variants[i]).replace(/[0-9]/g, '')+'</option>');
				}
				
				if (!$('#'+font_family.split(' ')[0]+font_variants[0]).length) {
					$('head').append('<link id="'+font_family.split(' ')[0]+font_variants[0]+'" href="http://fonts.googleapis.com/css?family='+font_family+':'+font_variants[0]+'" rel="stylesheet" type="text/css">');
					$('#'+font_family.split(' ')[0]+font_variants[0]).load(function(){
						$('.google-font-preview').attr('style', 'font-family:'+font_family+';font-weight:'+font_weight+';font-style:'+font_variant);
					}).attr('href', 'http://fonts.googleapis.com/css?family='+font_family+':'+font_variants[0]);
				} else {
					$('.google-font-preview').attr('style', 'font-family:'+font_family+';font-weight:'+font_weight+';font-style:'+font_variant);
				}
			}
		}
	}
	
	$(document).on('click','#themeone_family', function() { 
		var font_family = $(this).find(":selected").data('font-family');
		var font_variants = $(this).find(":selected").data('font-variant');
		var font_weight = String(font_variants).replace(/[a-zA-Z ]/g, '');
		var font_variant = String(font_variants).replace(/[0-9]/g, '');
		
		if (!$('#'+font_family.split(' ')[0]+font_variants).length) {
			$('head').append('<link id="'+font_family.split(' ')[0]+font_variants+'" href="http://fonts.googleapis.com/css?family='+font_family+':'+font_variants+'" rel="stylesheet" type="text/css">');
			$('#'+font_family.split(' ')[0]+font_variants).load(function(){
				$('.google-font-preview').attr('style', 'font-family:'+font_family+';font-weight:'+font_weight+';font-style:'+font_variant);
			}).attr('href', 'http://fonts.googleapis.com/css?family='+font_family+':'+font_variants);
		} else {
			$('.google-font-preview').attr('style', 'font-family:'+font_family+';font-weight:'+font_weight+';font-style:'+font_variant);
		}

	});
	
	$(document).on('click','.google-fonts', function() {  
		selectFont();
	});
	
	$(document).on('click','.th-show-list-button', function() {  
		$(this).next('.child-list-icon-ul').slideToggle();
	});
	$(document).on('click','.child-clone-row-field .add-input, .add-input-holder .add-input',function() { 
		var currentDiv = $(this).parent().prev('input'); 
		var nextID = parseInt(currentDiv.attr('id').replace('themeone_content-', '')) + 1;
		currentDiv.clone().insertAfter(currentDiv);
		currentDiv.next('input').attr('id', 'themeone_content-'+nextID).val('').text('');
	});
	
	$(document).ready(function(e) {
		$('.wp-editor-wrap').each(function(){
			if ($(this).hasClass('tmce-active')) {
				$(this).find('.themeone-sc-generator').addClass('show');
			} else {
				$(this).find('.themeone-sc-generator').removeClass('show');
			} 
		});
    });
	
	$(document).on('click','.switch-tmce, .switch-html',function() {
		if ($(this).hasClass('switch-tmce')) {
			$(this).closest('.wp-editor-wrap').find('.themeone-sc-generator').addClass('show');
		} else {
			$(this).closest('.wp-editor-wrap').find('.themeone-sc-generator').removeClass('show');
		}   
	});
	
	/*$(document).ajaxSend(function(e, xhr, settings) {
		var widget_id_base = 'text';
		if(settings.data && settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
			console.log(settings.data.search('widget-text'));
		}
        
    });*/
	
	$(document).on('keyup', '.to-search-icon', function(){
		var query = $(this).val().toLowerCase();
		$(this).closest('.themeone-sc-content').find('.themeone-icons-holder i').each(function(){
			var $this = $(this);
			var val = $this.attr('class').toString();
			if(val.indexOf(query) != -1) {
				$this.removeClass('icon-hide');
			} else {
				$this.addClass('icon-hide');
			}
		});
	});
	
});


