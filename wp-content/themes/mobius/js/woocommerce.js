(function($) {
			
"use strict";

var to_class_minus = '';
var to_class_plus = '';

$(document).ready(function() {
	$('.woocommerce-pagination ul li .next.page-numbers').html('<i class="fa fa-angle-right"></i>');
	if ($(document).find('[data-wc-version]').length) {
		var wc_version = $(document).find('[data-wc-version]').data('wc-version').split('.');
		if (wc_version[0] >= 2 && wc_version[1] >= 3) {
			to_class_minus = 'themeone-minus';
			to_class_plus = 'themeone-plus';
		}
	}
	if (!$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find('button').lenght) {
		$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus '+ to_class_plus +'" />').prepend('<input type="button" value="-" class="minus '+ to_class_minus +'" />');
	}
});


$(document).on('click', '.themeone-plus',function(){
	var $this = $(this).closest('.quantity.buttons_added');
	var value = parseInt($this.find('.qty').val());
	$this.find('.qty').val(value+1);
});
$(document).on('click', '.themeone-minus',function(){
	var $this = $(this).closest('.quantity.buttons_added');
	var value = parseInt($this.find('.qty').val());
	if (value > 1) {
		$this.find('.qty').val(value-1);
	}
});

$(window).on('statechangecomplete', function() {
	
	$('.woocommerce-ordering').on( 'change', 'select.orderby', function() {
		$(this).closest('form').submit();
	});
	
	$('.woocommerce-pagination ul li .next.page-numbers').html('<i class="fa fa-angle-right"></i>');

	var product_cat_dropdown = document.getElementById("dropdown_product_cat");
	$('#dropdown_product_cat').on( 'change', function() {
		if ( product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value !=='' ) {
			location.href = $('.section-container.woocommerce-container').data('home-url')+"/?product_cat="+product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value;
		}
	});
	
		
	if (!$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find('button').lenght) {
		$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus '+ to_class_plus +'" />').prepend('<input type="button" value="-" class="minus '+ to_class_minus +'" />');
	}
	
	$("input.qty:not(.product-quantity input.qty)").each(function(){
		var b=parseFloat($(this).attr("min"));
		b&&b>0&&parseFloat($(this).val())<b&&$(this).val(b)
	});

	var wc_single_product_params = 'yes';
	$(".woocommerce-tabs .panel").hide(),
	$(".woocommerce-tabs ul.tabs li a").click(function(){
		var b=$(this),
			c=b.closest(".woocommerce-tabs");
		return $("ul.tabs li",c).removeClass("active"),
		$("div.panel",c).hide(),
		$("div"+b.attr("href"),c).show(),
		b.parent().addClass("active"),!1
	}),
	
	$( '.woocommerce-tabs' ).each( function() {
		var hash	= window.location.hash,
			url		= window.location.href,
			tabs	= $( this );
		$('.panel.entry-content').first().show();
		$('ul.tabs li').first().addClass('active');
	});
	
	$("a.woocommerce-review-link").click(function(){
		return $(".reviews_tab a").click(),!0
	});
	
	$("#rating").hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');
	$("body").on("click","#respond p.stars a",function(){
		var b=$(this),
			c=$(this).closest("#respond").find("#rating");
		return c.val(b.text()),
				b.siblings("a").removeClass("active"),
				b.addClass("active"),!1}).on("click","#respond #submit",function(){
					var b=$(this).closest("#respond").find("#rating"),c=b.val();
					return b.size()>0&&!c&&"yes"===wc_single_product_params.review_rating_required?(alert(wc_single_product_params.i18n_required_rating_text),!1):void 0
				});
		void $("form.cart").submit(function(){$(this).find(":submit").attr("disabled","disabled")
	});
	
	
	$("input#min_price, input#max_price").hide(),
	$(".price_slider, .price_label").show();
	var b=$(".price_slider_amount #min_price").data("min"),
		c=$(".price_slider_amount #max_price").data("max"),
		current_min_price=parseInt(b),
		current_max_price=parseInt(c),
		currency;
	if ($('.widget_layered_nav_filters .chosen a').length) {
		$('.widget_layered_nav_filters .chosen a').each(function() {
			if ($(this).text().indexOf('Min') > -1) {	
				current_min_price=parseInt($(this).find('.amount').text().replace(/[^\d\+]/g,''));
			}
			if ($(this).text().indexOf('Max') > -1) {
				current_max_price=parseInt($(this).find('.amount').text().replace(/[^\d\+]/g,''));
			}
		});
	}
	$('.amount').each(function() {
        if ($(this).text().replace(/[0-9]+/, '') != ''){
			currency = $(this).text().split('.').join("").replace(/[0-9]+/, '');
		}
    });
	$(".price_slider_amount .price_label .from").html(currency+current_min_price);
	$(".price_slider_amount .price_label .to").html(currency+current_max_price);
	$(".price_slider").slider({
		range:!0,
		animate:!0,
		min:b,
		max:c,
		values:[current_min_price,current_max_price],
		create:function(){
			$(".price_slider_amount #min_price").val(current_min_price),
			$(".price_slider_amount #max_price").val(current_max_price),
			$("body").trigger("price_slider_create",[current_min_price,current_max_price]
		)},
		slide:function(b,c){
			$("input#min_price").val(c.values[0]),
			$("input#max_price").val(c.values[1]),
			$(".price_slider_amount .price_label .from").html(currency+c.values[0]),
			$(".price_slider_amount .price_label .to").html(currency+c.values[1]),
			$("body").trigger("price_slider_slide",[c.values[0],c.values[1]]
		)},
		change:function(b,c){
			$("body").trigger("price_slider_change",[c.values[0],c.values[1]]
		)}
	});
	
	$.fn.wc_variation_form = function () {
		$.fn.wc_variation_form.find_matching_variations = function( product_variations, settings ) {
			var matching = [];
			for ( var i = 0; i < product_variations.length; i++ ) {
				var variation = product_variations[i];
				var variation_id = variation.variation_id;

				if ( $.fn.wc_variation_form.variations_match( variation.attributes, settings ) ) {
					matching.push( variation );
				}
			}
			return matching;
		};
		$.fn.wc_variation_form.variations_match = function( attrs1, attrs2 ) {
			var match = true;
			for ( var attr_name in attrs1 ) {
				if ( attrs1.hasOwnProperty( attr_name ) ) {
					var val1 = attrs1[ attr_name ];
					var val2 = attrs2[ attr_name ];
					if ( val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2 ) {
						match = false;
					}
				}
			}
			return match;
		};
		// Unbind any existing events
		this.unbind( 'check_variations update_variation_values found_variation' );
		this.find( '.reset_variations' ).unbind( 'click' );
		this.find( '.variations select' ).unbind( 'change focusin' );
		// Bind events
		var $form = this
			// On clicking the reset variation button
			.on( 'click', '.reset_variations', function( event ) {
				$( this ).closest( '.variations_form' ).find( '.variations select' ).val( '' ).change();
				var $sku = $( this ).closest( '.product' ).find( '.sku' ),
					$weight = $( this ).closest( '.product' ).find( '.product_weight' ),
					$dimensions = $( this ).closest( '.product' ).find( '.product_dimensions' );
				if ( $sku.attr( 'data-o_sku' ) )
					$sku.text( $sku.attr( 'data-o_sku' ) );
				if ( $weight.attr( 'data-o_weight' ) )
					$weight.text( $weight.attr( 'data-o_weight' ) );
				if ( $dimensions.attr( 'data-o_dimensions' ) )
					$dimensions.text( $dimensions.attr( 'data-o_dimensions' ) );
				return false;
			} )
			// Upon changing an option
			.on( 'change', '.variations select', function( event ) {
				var $variation_form = $( this ).closest( '.variations_form' );
				$variation_form.find( 'input[name=variation_id]' ).val( '' ).change();
				$variation_form
					.trigger( 'woocommerce_variation_select_change' )
					.trigger( 'check_variations', [ '', false ] );
				$( this ).blur();
				if( $().uniform && $.isFunction( $.uniform.update ) ) {
					$.uniform.update();
				}
			} )

			// Upon gaining focus
			.on( 'focusin touchstart', '.variations select', function( event ) {
				var $variation_form = $( this ).closest( '.variations_form' );
				$variation_form
					.trigger( 'woocommerce_variation_select_focusin' )
					.trigger( 'check_variations', [ $( this ).attr( 'name' ), true ] );
			} )
			// Check variations
			.on( 'check_variations', function( event, exclude, focus ) {
				var all_set = true,
					any_set = false,
					showing_variation = false,
					current_settings = {},
					$variation_form = $( this ),
					$reset_variations = $variation_form.find( '.reset_variations' );
				$variation_form.find( '.variations select' ).each( function() {
					if ( $( this ).val().length === 0 ) {
						all_set = false;
					} else {
						any_set = true;
					}
					if ( exclude && $( this ).attr( 'name' ) === exclude ) {
						all_set = false;
						current_settings[$( this ).attr( 'name' )] = '';
					} else {
						// Encode entities
						var value = $( this ).val();
						// Add to settings array
						current_settings[ $( this ).attr( 'name' ) ] = value;
					}
				});
				var product_id = parseInt( $variation_form.data( 'product_id' ) ),
					all_variations = $variation_form.data( 'product_variations' );
				// Fallback to window property if not set - backwards compat
				if ( ! all_variations )
					all_variations = window.product_variations.product_id;
				if ( ! all_variations )
					all_variations = window.product_variations;
				if ( ! all_variations )
					all_variations = window['product_variations_' + product_id ];
				var matching_variations = $.fn.wc_variation_form.find_matching_variations( all_variations, current_settings );
				if ( all_set ) {
					var variation = matching_variations.shift();
					if ( variation ) {
						// Found - set ID
						$variation_form
							.find( 'input[name=variation_id]' )
							.val( variation.variation_id )
							.change();
						$variation_form.trigger( 'found_variation', [ variation ] );
					} else {
						// Nothing found - reset fields
						$variation_form.find( '.variations select' ).val( '' );
						if ( ! focus )
							$variation_form.trigger( 'reset_image' );
						alert( wc_add_to_cart_variation_params.i18n_no_matching_variations_text );
					}
				} else {
					$variation_form.trigger( 'update_variation_values', [ matching_variations ] );
					if ( ! focus )
						$variation_form.trigger( 'reset_image' );
					if ( ! exclude ) {
						$variation_form.find( '.single_variation_wrap' ).slideUp( 200 );
					}
				}
				if ( any_set ) {
					if ( $reset_variations.css( 'visibility' ) === 'hidden' )
						$reset_variations.css( 'visibility', 'visible' ).hide().fadeIn();
				} else {
					$reset_variations.css( 'visibility', 'hidden' );
				}
			} )
			// Reset product image
			.on( 'reset_image', function( event ) {
				var $product = $(this).closest( '.product' ),
					$product_img = $product.find( 'div.images img:eq(0)' ),
					$product_link = $product.find( 'div.images a.zoom:eq(0)' ),
					o_src = $product_img.attr( 'data-o_src' ),
					o_title = $product_img.attr( 'data-o_title' ),
					o_alt = $product_img.attr( 'data-o_alt' ),
					o_href = $product_link.attr( 'data-o_href' );
				if ( o_src !== undefined ) {
					$product_img.attr( 'src', o_src );
				}
				if ( o_href !== undefined ) {
					$product_link.attr( 'href', o_href );
				}
				if ( o_title !== undefined ) {
					$product_img.attr( 'title', o_title );
				}
				if ( o_alt !== undefined ) {
					$product_img.attr( 'alt', o_alt );
				}
			} )
			// Disable option fields that are unavaiable for current set of attributes
			.on( 'update_variation_values', function( event, variations ) {
				var $variation_form = $( this ).closest( '.variations_form' );
				// Loop through selects and disable/enable options based on selections
				$variation_form.find( '.variations select' ).each( function( index, el ) {
					var current_attr_select = $( el );
					// Reset options
					if ( ! current_attr_select.data( 'attribute_options' ) )
						current_attr_select.data( 'attribute_options', current_attr_select.find( 'option:gt(0)' ).get() );
					current_attr_select.find( 'option:gt(0)' ).remove();
					current_attr_select.append( current_attr_select.data( 'attribute_options' ) );
					current_attr_select.find( 'option:gt(0)' ).removeClass( 'active' );
					// Get name
					var current_attr_name = current_attr_select.attr( 'name' );
					// Loop through variations
					for ( var num in variations ) {
						if ( typeof( variations[ num ] ) != 'undefined' ) {
							var attributes = variations[ num ].attributes;
							for ( var attr_name in attributes ) {
								if ( attributes.hasOwnProperty( attr_name ) ) {
									var attr_val = attributes[ attr_name ];
									if ( attr_name == current_attr_name ) {
										if ( attr_val ) {
											// Decode entities
											attr_val = $( '<div/>' ).html( attr_val ).text();
											// Add slashes
											attr_val = attr_val.replace( /'/g, "\\'" );
											attr_val = attr_val.replace( /"/g, "\\\"" );
											// Compare the meerkat
											current_attr_select.find( 'option[value="' + attr_val + '"]' ).addClass( 'active' );
										} else {
											current_attr_select.find( 'option:gt(0)' ).addClass( 'active' );
										}
									}
								}
							}
						}
					}
					// Detach inactive
					current_attr_select.find( 'option:gt(0):not(.active)' ).remove();
				});
				// Custom event for when variations have been updated
				$variation_form.trigger( 'woocommerce_update_variation_values' );
			} )
			// Show single variation details (price, stock, image)
			.on( 'found_variation', function( event, variation ) {
				var $variation_form = $( this ),
					$product = $( this ).closest( '.product' ),
					$product_img = $product.find( 'div.images img:eq(0)' ),
					$product_link = $product.find( 'div.images a.zoom:eq(0)' ),
					o_src = $product_img.attr( 'data-o_src' ),
					o_title = $product_img.attr( 'data-o_title' ),
					o_alt = $product_img.attr( 'data-o_alt' ),
					o_href = $product_link.attr( 'data-o_href' ),
					variation_image = variation.image_src,
					variation_link  = variation.image_link,
					variation_title = variation.image_title,
					variation_alt = variation.image_alt;
				$variation_form.find( '.variations_button' ).show();
				$variation_form.find( '.single_variation' ).html( variation.price_html + variation.availability_html );
				if ( o_src === undefined ) {
					o_src = ( ! $product_img.attr( 'src' ) ) ? '' : $product_img.attr( 'src' );
					$product_img.attr( 'data-o_src', o_src );
				}
				if ( o_href === undefined ) {
					o_href = ( ! $product_link.attr( 'href' ) ) ? '' : $product_link.attr( 'href' );
					$product_link.attr( 'data-o_href', o_href );
				}
				if ( o_title === undefined ) {
					o_title = ( ! $product_img.attr( 'title' ) ) ? '' : $product_img.attr( 'title' );
					$product_img.attr( 'data-o_title', o_title );
				}
				if ( o_alt === undefined ) {
					o_alt = ( ! $product_img.attr( 'alt' ) ) ? '' : $product_img.attr( 'alt' );
					$product_img.attr( 'data-o_alt', o_alt );
				}
				if ( variation_image && variation_image.length > 1 ) {
					$product_img
						.attr( 'src', variation_image )
						.attr( 'alt', variation_alt )
						.attr( 'title', variation_title );
					$product_link
						.attr( 'href', variation_link )
						.attr( 'title', variation_title );
				} else {
					$product_img
						.attr( 'src', o_src )
						.attr( 'alt', o_alt )
						.attr( 'title', o_title );
					$product_link
						.attr( 'href', o_href )
						.attr( 'title', o_title );
				}
				var $single_variation_wrap = $variation_form.find( '.single_variation_wrap' ),
					$sku = $product.find( '.product_meta' ).find( '.sku' ),
					$weight = $product.find( '.product_weight' ),
					$dimensions = $product.find( '.product_dimensions' );
				if ( ! $sku.attr( 'data-o_sku' ) )
					$sku.attr( 'data-o_sku', $sku.text() );

				if ( ! $weight.attr( 'data-o_weight' ) )
					$weight.attr( 'data-o_weight', $weight.text() );

				if ( ! $dimensions.attr( 'data-o_dimensions' ) )
					$dimensions.attr( 'data-o_dimensions', $dimensions.text() );

				if ( variation.sku ) {
					$sku.text( variation.sku );
				} else {
					$sku.text( $sku.attr( 'data-o_sku' ) );
				}
				if ( variation.weight ) {
					$weight.text( variation.weight );
				} else {
					$weight.text( $weight.attr( 'data-o_weight' ) );
				}
				if ( variation.dimensions ) {
					$dimensions.text( variation.dimensions );
				} else {
					$dimensions.text( $dimensions.attr( 'data-o_dimensions' ) );
				}
				$single_variation_wrap.find( '.quantity' ).show();

				if ( ! variation.is_purchasable || ! variation.is_in_stock || ! variation.variation_is_visible ) {
					$variation_form.find( '.variations_button' ).hide();
				}
				if ( ! variation.variation_is_visible ) {
					$variation_form.find( '.single_variation' ).html( '<p>' + wc_add_to_cart_variation_params.i18n_unavailable_text + '</p>' );
				}
				if ( variation.min_qty )
					$single_variation_wrap.find( 'input[name=quantity]' ).attr( 'min', variation.min_qty ).val( variation.min_qty );
				else
					$single_variation_wrap.find( 'input[name=quantity]' ).removeAttr( 'min' );

				if ( variation.max_qty )
					$single_variation_wrap.find( 'input[name=quantity]' ).attr( 'max', variation.max_qty );
				else
					$single_variation_wrap.find( 'input[name=quantity]' ).removeAttr( 'max' );

				if ( variation.is_sold_individually === 'yes' ) {
					$single_variation_wrap.find( 'input[name=quantity]' ).val( '1' );
					$single_variation_wrap.find( '.quantity' ).hide();
				}
				$single_variation_wrap.slideDown( 200 ).trigger( 'show_variation', [ variation ] );
			});
		$form.trigger( 'wc_variation_form' );
		return $form;
	};
	$( function() {

		$( '.variations_form' ).wc_variation_form();
		$( '.variations_form .variations select' ).change();
	});
});


})(jQuery, window);