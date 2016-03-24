/**
 * Themeone MetaBox
 * http://theme-one.com/
 *
 * Copyright (c) 2015 Blascos Loïc
 * All right reserved
 *
 */
 
// ======================================================
// INIT all fields and events only once (work with ajax)
// ======================================================

/*global jQuery:false*/
/*global wp:false*/

jQuery(document).ready(function(){
    TOMB_JS.init();
	// Run ui Slider Plugin button +/- event
	TOMB_RangeSlider.event();
	// Run switch button event
	TOMB_SwitchButton.event();
	// Run image Select radio fields
	TOMB_ImageSelect.event();
	// Run tab open/close event
	TOMB_MetaboxTab.event();
	// Run required fields event
	TOMB_RequiredField.event();
});

// ======================================================
// Init all fields functionnalities (works with ajax)
// ======================================================

var TOMB_JS = {
	init: function() {
		// Run Single Image/Media Editor event
		TOMB_MediaControl.init();
		// Run Gallery Editor
		TOMB_GalleryControl.init();
		// Run ui Slider Plugin
		TOMB_RangeSlider.init();
		// Run required fields
		TOMB_RequiredField.check();
		// Run tab open/close
		TOMB_MetaboxTab.init();
		// Run themeone Slider
		TOMB_TOSlider.init();
		// Load colorpicker if field exists
		TOMB_ColorPicker.init();
		// Load init Select2 plugin
		TOMB_Select2.init();
		// Load textarea count plugin
		TOMB_TextArea.init();
		// Run codemirror
		TOMB_codemirror.init();
	}
};

// ======================================================
// Drop down list - Select2 plugin
// ======================================================

var TOMB_Select2 = {
	init: function() {
		var $selectFields = jQuery('.tomb-select, .tomb-multiselect');
		if ($selectFields.length && jQuery.isFunction(jQuery.fn.select2)) {
			$selectFields.each(function() {
				var val;
				var $this = jQuery(this);
				if (!$this.next().is('.select2')) {
					var clear = $this.data('clear');
					if (clear) {
						$this.prepend(jQuery('<option></option>'));
						val = ($this.data('value')) ? false : true;
					}
					$this.select2({
						allowClear: clear,
						placeholder: $this.data('placeholder'),
						width: jQuery(this).data('width'),
						theme: "classic"
					}).hide();
					if (clear && val) {
						$this.val('').trigger('change');
					}
				}
			});
		}
	}
};

// ======================================================
// Textarea counter
// ======================================================

var TOMB_TextArea = {
	init: function() {
		jQuery('.tomb-textarea').each(function() {
			jQuery(this).textareaCount({'originalStyle': 'originalDisplayInfo'});
		});
	}
};

// ======================================================
// Codemirror highlight syntax
// ======================================================

var TOMB_codeTxt = [];
var TOMB_codemirror = {
	init: function() {
		jQuery('.tomb-code:not(.tomb-code-init)').each(function() {
			var $this = jQuery(this),
				ID    = $this.attr('id'),
				mode  = $this.data('mode'),
				theme = $this.data('theme'),
				codeInstance = CodeMirror.fromTextArea(document.getElementById(ID), {
					mode: (mode) ? mode : 'text/css',
					theme: (theme) ? theme : 'default',
					lineNumbers: true
				});
				$this.addClass('tomb-code-init');
				
			codeInstance.on('change', function () {
				var html = codeInstance.getValue();
				$this.val(html);
			});
			
			codeInstance.setSize(800, 300);
		
			TOMB_codeTxt.push(codeInstance);
		});
	}
};

// ======================================================
// Switch buttons (checkbox)
// ======================================================

var TOMB_SwitchButton = {
	event: function() {
		jQuery(document).on('click', '.tomb-switch label', function(e) {
			e.preventDefault();
			var $this = jQuery(this).closest('.tomb-switch').find('input');
			$this.prop('checked', !$this.prop('checked'));
			if (!$this.val()) {
				$this.val(true);
			} else {
				$this.val('');
			}
			$this.trigger('change');
			e.stopPropagation();
		});
	}
};

// ======================================================
// ColorPicker (Wordpress)
// ======================================================

var TOMB_ColorPicker = {
	init: function() {
		var $colorPicker = jQuery('.tomb-colorpicker');
		if ($colorPicker.length > 0 ) {
			
			$colorPicker.wpColorPicker();
		
			$colorPicker.each(function() {

				if (jQuery(this).data('alpha') !== 1) return;

				var $control = jQuery(this),
					value    = $control.val().replace(/\s+/g, ''),
					$alpha   = jQuery(
						'<div class="tomb-alpha-container">'+
						'<div class="slider-alpha"></div>'+
						'<div class="transparency"></div>'+
						'</div>'
					),
					new_alpha_val,
					color_picker,
					alpha_val,
					$slider,
					iris;
				
				if ($control.parents('.wp-picker-container').find('.tomb-alpha-container').length === 0) {
					$alpha.appendTo($control.parents('.wp-picker-container'));
				}
				$slider = $control.parents('.wp-picker-container:first').find('.slider-alpha');

				if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
					alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
					alpha_val = parseInt(alpha_val);
				} else {
					alpha_val = 100;
				}

				
				$slider.slider({
					slide: function(event, ui) {
						getAlphaVal(ui.value);
					},
					value: alpha_val,
					range: "max",
					step: 1,
					min: 1,
					max: 100
				});
				
				var get_val = $control.val();

				$control.wpColorPicker({
					color: get_val,
					clear: function() {
						$slider.slider({value: 100});
						$control.val('');	
					},
					change: function(event, ui) {
						var $transparency = $control.parents('.wp-picker-container:first').find('.transparency');
						$transparency.css('backgroundColor', ui.color.toString('no-alpha'));
					},
				});
				
				function getAlphaVal(value) {
					iris = $control.data('a8cIris');
					new_alpha_val = parseFloat(value);
					color_picker = $control.data('wpWpColorPicker');
					iris._color._alpha = new_alpha_val / 100.0;
					$control.val(iris._color.toString());
					jQuery($control).wpColorPicker('color', $control.val());
				}
			
			});
		}
	}
};

// ======================================================
// MetaBox tab
// ======================================================

var TOMB_MetaboxTab = {
	init: function() {
		jQuery('.tomb-tab.selected').each(function() {
			TOMB_MetaboxTab.check(jQuery(this));
		});
	},
	check: function(el) {
		var selected_tab = el.data('target');
		el.closest('.inside').find('li').removeClass('selected');
		el.addClass('selected');
		el.closest('.inside').find('.tomb-tab-content').removeClass('tomb-tab-show').hide();
        el.closest('.inside').find('.tomb-tab-content.'+selected_tab+'').addClass('tomb-tab-show').show();
	},
	event: function() {
		jQuery(document).on('click','.tomb-tab', function() {
			TOMB_MetaboxTab.check(jQuery(this));
			if (jQuery('.tomb-code').length > 0) {
				for (var i = 0, l = TOMB_codeTxt.length; i < l; i++ ) {
					TOMB_codeTxt[i].refresh();
				}
			}
		});
	}
};

// ======================================================
// Requiered field to hide show dependencies
// ======================================================

var TOMB_RequiredField = {
	event: function() {
		jQuery(document).on('change', '.tomb-row input, .tomb-row .tomb-select, .tomb-row .tomb-multiselect', function() {
			TOMB_RequiredField.check(0);
		});
	},
	check: function(delay) {
		jQuery('.tomb-row.required,.tomb-section.required').each(function() {
			var show  = 0,
				hide  = 0,
				count = 0,
				input = null,
				$this = jQuery(this),
				data  = $this.data('required').split(';');
			for (var i = 0; i < data.length; i++) {	
				var field = data[i].split(',');
				input = jQuery('.tomb-row.'+field[0]).find('input').val();
				if (!input) {
					input = jQuery('.tomb-row.'+field[0]+' select').val();
				}
				if (jQuery('.'+field[0]).find('input').is(':radio')) {
					input = jQuery('.tomb-row.'+field[0]).find('input:checked').val();
				}
				var value = field[2];
				var op    = field[1];
				count = 1+count;
				if (op === 'contains') {
					if (input) {
						if (input.toString().indexOf(value.toString()) >= 0 ) {
							show = 1+show;
						} else {
							hide = 1+hide;
						}
					}
				} else {
					if (TOMB_RequiredField.operator(op, input, value)) {
						show = 1+show;
					} else {
						hide = 1+hide;
					}
				}
			}
			if (show == count) {
				$this.show(delay);
			} else {
				$this.hide(delay);
			}
    	});
	},
	operator: function(op, x, y) {
		var validOps = /^([!=<>]=|<|>)$/,
			operators = {};
		if (arguments.length > 1) {
			return TOMB_RequiredField.operator(op)(x, y);
		}
		if (op in operators) {
			return operators[op];
		}
		if (validOps.test(op)) {
			return operators[op] = new Function("a","b","return a "+op+" b;");
		}
		return function(){return false;};
	}
};

// ======================================================
// Image select
// ======================================================

var TOMB_ImageSelect = {
	event: function() {
		jQuery(document).on('click', '.tomb-image-holder', function(){
			var $this = jQuery(this);
			$this.closest('.tomb-field').find('.tomb-image-holder, input, img').removeAttr('data-checked checked');
			$this.attr('data-checked',1);
			$this.find('img').attr('data-checked',1);
			$this.find('input').attr('checked',1);
		});
	}
};

// ======================================================
// Range Slider
// ======================================================

var slider_range = '.tomb-slider-range',
	slider_input = '.tomb-slider-input',
	slider_field = '.tomb-field',
	slider_plus  = '.tomb-slider-plus',
	slider_less  = '.tomb-slider-less',
	slider       = '.tomb-slider',
	int;

var TOMB_RangeSlider = {	
	init: function() {
		jQuery(slider_range).each(function() {
        	var $this  = jQuery(this);
			if (!$this.is('.ui-slider')) {
				var $input = $this.closest(slider_field).find(slider);
					$this.slider({ 
						range: 'min',
						min  : $this.data('min'),
						max  : $this.data('max'),
						step : ($this.data('step')) ? $this.data('step') : 1,
						value: $this.data('value'),
						slide: function(e,ui) {
							TOMB_RangeSlider.update($this,ui);
						},
						change: function(e,ui) {
							TOMB_RangeSlider.update($this,ui);
							$this.siblings('input').trigger("change");
						}
				});
				$input.attr('size', String($this.attr('data-max')).length+String($this.attr('data-sign')).length-1);
			}
		});
	},
	event: function() {
		jQuery(document).on('mousedown',slider_plus+','+slider_less,function() {
			var $this = jQuery(this);
			int = setInterval(function() {
				TOMB_RangeSlider.change($this);
			}, 100);
		}).on('mouseup mouseleave',function() {
			clearInterval(int);  
		});
	},
	update: function(el,ui) {
		var sign = el.data('sign');
		el.closest(slider_field).find(slider).val(ui.value+sign);
		el.closest(slider_field).find(slider_input).val(ui.value);
	},
	change: function(el) {
		var $this = el.closest(slider_field).find(slider_range),
			step  = ($this.data('step')) ? $this.data('step') : 1,
			val   = $this.slider("option", "value"),
			min   = $this.slider("option", "min"),
			max   = $this.slider("option", "max");
		if (el.is(slider_less)) {
			step = -step;
		}
		val = val+step;
		if (val <= max && val >= min) {
			$this.slider("option", "value",val);
		}
	}

};

// ======================================================
// Single image/media uploader
// ======================================================

var TOMB_MediaControl = {
    // Initializes a new media manager or returns an existing frame.
    init: function() {
        // Handle media manager
		jQuery('.tomb-open-media:not(is-init)').each(function() {
			
			var $this = jQuery(this);
			
			$this.add($this.next('.tomb-image-remove')).addClass('is-init');
			
			var frame,
				tomb_image_id     = ($this.is('.tomb-image-id')) ? true : false,
				tomb_image_holder = $this.prevAll('.tomb-img-field'),
				tomb_image_remove = $this.nextAll('.tomb-image-remove'),
				tomb_image_input  = $this.prevAll('input'),
				tomb_frame_title  = $this.data('frame-title'),
				tomb_frame_button = $this.data('frame-button'),
				tomb_frame_type   = ($this.data('media-type')) ? $this.data('media-type') : 'image';
			
			if (frame) { return frame; }
			
			frame = wp.media({
				id: 'tomb-media-popup',
				title: tomb_frame_title,
				frame: 'select',
				library: { 
					type: tomb_frame_type
				},
				button: {
					text: tomb_frame_button
				},
				multiple: false
			});

			$this.on('click', function(e) {
				e.preventDefault();
				frame.open();
			});
			
			frame.on( 'select', function() {
				var media = frame.state().get('selection').first().toJSON();
				var id    = media.id;
				var thumb = media.url;		 
				var value = (tomb_image_id === true) ? id : thumb;
				jQuery(tomb_image_input).val(value);
				jQuery(tomb_image_holder).attr('style','background-image: url('+thumb+')').addClass('show');
				jQuery(tomb_image_remove).addClass('show');
				jQuery(tomb_image_input).trigger('change');
			});
			
			$this.next('.tomb-image-remove:not(is-init)').on('click', function(){
				var $formfield = jQuery(this);
				$formfield.removeClass('show');
				$formfield.prevAll('input').val('');
				$formfield.prevAll('.tomb-img-field').attr('style','');
				$formfield.prevAll('.tomb-img-field').removeClass('show');
				$formfield.prevAll('input').trigger("change");
			});
			
		});
		
    }
};

// ======================================================
// Gallery image uploader
// ======================================================

var TOMB_GalleryControl = {
    // Initializes a new media manager or returns an existing frame.	
    init: function() {
        // Handle media manager
		jQuery('.tomb-open-gallery:not(is-init)').each(function() {
			
			var $this = jQuery(this);

			var frame,
				tomb_gallery_list  = $this.closest('.tomb-gallery-container').find('.tomb-gallery-holder'),
				tomb_gallery_remove= $this.closest('.tomb-gallery-container').find('.tomb-delete-gallery:not(is-init)'),
				tomb_gallery_ids   = $this.prevAll('input'),
				tomb_window_title  = $this.data('title'),
				tomb_window_button = $this.data('button');
				
			jQuery('.tomb-gallery-holder:not(is-init)').sortable({
				placeholder: 'tomb-gallery-item-highlight',
				update: function() {
					var $this = jQuery(this);
					TOMB_GalleryControl.update($this);
				},
			});
			jQuery('.tomb-gallery-item:not(is-init)').draggable({
				connectToSortable: '.tomb-gallery-holder',
				revert: 'invalid',
			});
			
			jQuery(document).on('click', '.tomb-gallery-item-remove', function(){
				var $this = jQuery(this).closest('.tomb-gallery-holder');
				jQuery(this).closest('li').remove();
				TOMB_GalleryControl.update($this);
			});
			
			jQuery('.tomb-gallery-holder').addClass('is-init');
			jQuery('.tomb-gallery-item').addClass('is-init');
			$this.add(jQuery(tomb_gallery_remove)).addClass('is-init');
			
			if (frame) { return frame; }		
			
			frame = wp.media({
				id: 'tomb-media-popup',
				title: tomb_window_title,
				library: {
					type: 'image'
				},
				button: {
					text: tomb_window_button
				},
				multiple: 'toggle',
			});

			$this.on('click', function(e) {
				e.preventDefault();
				frame.open();
			});
			
			frame.on( 'select', function() {
				var selection = frame.state().get("selection").toJSON();
				var ids = '';
				jQuery(tomb_gallery_list).empty();
				jQuery(selection).each(function() {
					var id  = this.id;
					ids += id+',';
					var img = (this.sizes.thumbnail !== undefined) ? this.sizes.thumbnail.url : this.sizes.full.url;
					img = 'style="background-image:url(\'' + img + '\')"';
					jQuery(tomb_gallery_list).append('<li data-id="'+id+'"><div class="tomb-gallery-item-remove">x</div><div class="tomb-gallery-item-image" '+img+'></div></li>'); 
				});
				// Remove last comma
				ids = ids.slice(0,-1);
				jQuery(tomb_gallery_ids).val(ids);
			});
			
			frame.on( 'open', function() {
				var ids = (tomb_gallery_ids.val()) ? tomb_gallery_ids.val().split(',') : null;
				var selection = frame.state().get('selection');
				selection.reset();
				// Add to selection
				if (ids) {
					jQuery.each(ids, function(index, value) {
						var attachment = wp.media.attachment(value);
						attachment.fetch();
						selection.add(attachment ? [attachment] : []);
					});
				}
			});
			
			jQuery(tomb_gallery_remove).on('click', function(e) {
				e.preventDefault();
				var tomb_delete_message = jQuery(this).data('del');
				var tomb_confirm_delete = confirm(tomb_delete_message);
				if (tomb_confirm_delete === true) {
					var $this  = jQuery(this).closest('.tomb-row');
					$this.find('.tomb-gallery-holder').empty();
					$this.find('input').val('');
				}
			});

		});
		
    },
	
	update: function(el) {
		// update gallery ids on drag and remove
		var ids = '';
		var $holder = el;
		var $input  = el.closest('.tomb-row').find('input');
		$holder.find('li').each(function() {
			ids += jQuery(this).data('id')+',';
		});
		ids = ids.slice(0,-1);
		$input.val(ids);
	}	
};

// ======================================================
// Themeone Slider
// ======================================================

var copyHelper;

var TOMB_TOSlider = {
	init: function() {
		jQuery('.themeone-slider-slides ul').sortable({
			cancel: '.to-slide-empty',
			helper: 'clone',
			forcePlaceholderSize: true,
			receive: function() {
				copyHelper = null;
			},
			update: function() {
				if (!jQuery(this).find('li').length) {
					jQuery('.themeone-slider-slides .to-slide-empty').fadeIn(300);
				} else {
					jQuery('.themeone-slider-slides .to-slide-empty').fadeOut(300);
				}
				var $this = jQuery('.themeone-slider-slides');
				var id = [];
				$this.find('li').each(function() {
					id.push(jQuery(this).attr('id'));
				});
				$this.closest('.tomb-field').find('input').val(id);
			},
		}).disableSelection();
		
		jQuery('.themeone-slides-drag ul').sortable({
			connectWith: '.themeone-slider-slides ul',
			forcePlaceholderSize: false,
			forceHelperSize: false,
			helper: function(e,li) {
				copyHelper = li.clone().insertAfter(li);
				return li.clone();
			},
			stop: function() {
				var func;
				func = copyHelper && copyHelper.remove();
			},
		});
		
		jQuery(document).on('click', '.to-slide-item-remove', function(){
			jQuery('.themeone-slider-slides ul').trigger('update');
			var $this = jQuery(this).closest('li');
			var $holder = jQuery(this).closest('.themeone-slider-slides');
			$this.closest('li').remove();
			var id = [];
			$holder.find('li').each(function() {
				id.push(jQuery(this).attr('id'));	
			});
			$holder.closest('.tomb-field').find('input').val(id);
	
			if ($holder.find('li').length < 1) {
				jQuery('.themeone-slider-slides .to-slide-empty').fadeIn(0);
				jQuery('.themeone-slider-slides .to-slide-empty').css('display', 'table-cell');
			} else {
				jQuery('.themeone-slider-slides .to-slide-empty').fadeOut(300);
			}
		});
	}
};

 // ======================================================
// jQuery Textarea Characters Counter
// ======================================================

(function($){  
	$.fn.textareaCount = function(options, fn) {   
		var defaults = {  
			maxCharacterSize: -1,  
			originalStyle: 'originalTextareaInfo',
			warningStyle: 'warningTextareaInfo',  
			warningNumber: 20,
			displayFormat: '#input characters | #words words'
		};  
		options = $.extend(defaults, options);
		
		var container = $(this);
		
		$("<div class='charleft'>&nbsp;</div>").insertAfter(container);
		
		//create charleft css
		var charLeftCss = {
			'width' : container.width()
		};
		
		var charLeftInfo = getNextCharLeftInformation(container);
		charLeftInfo.addClass(options.originalStyle);
		charLeftInfo.css(charLeftCss);
		
		var numInput = 0;
		var maxCharacters = options.maxCharacterSize;
		var numLeft = 0;
		var numWords = 0;
				
		container.bind('keyup', function(){limitTextAreaByCharacterCount();})
				 .bind('mouseover', function(){setTimeout(function(){limitTextAreaByCharacterCount();}, 10);})
				 .bind('paste', function(){setTimeout(function(){limitTextAreaByCharacterCount();}, 10);});
		
		
		function limitTextAreaByCharacterCount(){
			charLeftInfo.html(countByCharacters());
			//function call back
			if(typeof fn != 'undefined'){
				fn.call(this, getInfo());
			}
			return true;
		}
		
		function countByCharacters(){
			var content = container.val();
			var contentLength = content.length;
			var newlineCount;
			
			//Start Cut
			if(options.maxCharacterSize > 0){
				//If copied content is already more than maxCharacterSize, chop it to maxCharacterSize.
				if(contentLength >= options.maxCharacterSize) {
					content = content.substring(0, options.maxCharacterSize); 				
				}
				
				newlineCount = getNewlineCount(content);
				
				// newlineCount new line character. For windows, it occupies 2 characters
				var systemmaxCharacterSize = options.maxCharacterSize - newlineCount;
				if (!isWin()){
					 systemmaxCharacterSize = options.maxCharacterSize;
				}
				if(contentLength > systemmaxCharacterSize){
					//avoid scroll bar moving
					var originalScrollTopPosition = this.scrollTop;
					container.val(content.substring(0, systemmaxCharacterSize));
					this.scrollTop = originalScrollTopPosition;
				}
				charLeftInfo.removeClass(options.warningStyle);
				if(systemmaxCharacterSize - contentLength <= options.warningNumber){
					charLeftInfo.addClass(options.warningStyle);
				}
				
				numInput = container.val().length + newlineCount;
				if(!isWin()){
					numInput = container.val().length;
				}
			
				numWords = countWord(getCleanedWordString(container.val()));
				
				numLeft = maxCharacters - numInput;
			} else {
				//normal count, no cut
				newlineCount = getNewlineCount(content);
				numInput = container.val().length + newlineCount;
				if(!isWin()){
					numInput = container.val().length;
				}
				numWords = countWord(getCleanedWordString(container.val()));
			}
			
			return formatDisplayInfo();
		}
		
		function formatDisplayInfo(){
			var format = options.displayFormat;
			format = format.replace('#input', numInput);
			format = format.replace('#words', numWords);
			//When maxCharacters <= 0, #max, #left cannot be substituted.
			if(maxCharacters > 0){
				format = format.replace('#max', maxCharacters);
				format = format.replace('#left', numLeft);
			}
			return format;
		}
		
		function getInfo(){
			var info = {
				input: numInput,
				max: maxCharacters,
				left: numLeft,
				words: numWords
			};
			return info;
		}
		
		function getNextCharLeftInformation(container){
				return container.next('.charleft');
		}
		
		function isWin(){
			var strOS = navigator.appVersion;
			if (strOS.toLowerCase().indexOf('win') != -1){
				return true;
			}
			return false;
		}
		
		function getNewlineCount(content){
			var newlineCount = 0;
			for(var i=0; i<content.length;i++){
				if(content.charAt(i) == '\n'){
					newlineCount++;
				}
			}
			return newlineCount;
		}
		
		function getCleanedWordString(content){
			var fullStr = content + " ";
			var initial_whitespace_rExp = /^[^A-Za-z0-9]+/gi;
			var left_trimmedStr = fullStr.replace(initial_whitespace_rExp, "");
			var non_alphanumerics_rExp = /[^A-Za-z0-9]+/gi;
			var cleanedStr = left_trimmedStr.replace(non_alphanumerics_rExp, " ");
			var splitString = cleanedStr.split(" ");
			return splitString;
		}
		
		function countWord(cleanedWordString){
			var word_count = cleanedWordString.length-1;
			return word_count;
		}
	};  
})(jQuery); 

 // ======================================================
// Remove alpha canal color
// ======================================================

jQuery(document).ready(function() {
 
	Color.prototype.toString = function(remove_alpha) {
		if (remove_alpha == 'no-alpha') {
			return this.toCSS('rgba', '1').replace(/\s+/g, '');
		}
		if (this._alpha < 1) {
			return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
		}
		var hex = parseInt(this._color, 10).toString(16);
		if (this.error) return '';
		if (hex.length < 6) {
			for (var i = 6 - hex.length - 1; i >= 0; i--) {
				hex = '0' + hex;
			}
		}
		return '#' + hex;
	};

});