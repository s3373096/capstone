jQuery.noConflict();

var global = {};

(function($) {
				
	"use strict";
	
	$(document).ready(function() {
 
		
		$('.to-import-demo-log').on('click', function() {
			$('.to-import-demo-log-holder').fadeIn(400);
		});
		
		$('.to-import-demo-log-holder .close, .to-import-demo-log-holder').on('click', function(e) {
			e.preventDefault();
			$('.to-import-demo-log-holder').fadeOut(400);
		});
		
		
		var $current_demo,
			demo_content,
			demo_file,
			demo_type,
			demo_post,
			demo_error,
			demo_img = {},
			file_length,
			file_nb;
		
		$('.to-import-demo-import, .to-import-demo-reimport').on('click', function() {
			
			if(confirm($(this).closest('.to-import-demos-holder').data('sure-string'))){

				file_nb = 0;
				
				$current_demo = $(this).closest('.to-import-demo-holder');
				$current_demo.addClass('to-demo-importing');
				$current_demo.removeClass('to-demo-imported to-demo-imported-error');
				$('.to-import-demos-holder').addClass('to-demo-is-importing');
				$('.to-import-demo-log-content').html('');
				
				var demo  = $current_demo.data('name');
				
				var fetch_demo = $.ajax({
					type: 'POST',
					url: ajaxurl,
					beforeSend: function(){
						$('.to-import-demo-install-inner').append($('<h3>Retrieving data...</h3>'));
					},
					error: function(xhr, status, error) {
						demo_error = true;
						$current_demo.removeClass('to-demo-importing');
						$current_demo.addClass('to-demo-imported-error');
					},
					data: {
						action : 'themeone_fetch_demo_data',
						demo   : demo
					},
				});
	
				fetch_demo.done(function(data) {
					demo_content = JSON.parse(data);
					
					var order = ['post_type','menu','widget','options'];
						
					// reorder data to correctly import demo
					demo_content = _.sortBy(demo_content, function(obj){ 
						return _.indexOf(order, obj.type);
					});
					
					var attachment = {};
					attachment['file'] = 'none';
					attachment['type'] = 'attachments';
					attachment['post'] = '';
					
					demo_content.unshift(attachment);
					file_length  = demo_content.length;
					
					demo_file = demo_content[file_nb]['file'];
					demo_type = demo_content[file_nb]['type'];
					demo_post = demo_content[file_nb]['post'];
	
					to_import_demo_ajax(
						demo_file,
						demo_type,
						demo_post,
						demo_img
					);
					
				});
			
			}

		});

		
		function to_import_demo_ajax(file,type,post,demo_img) {
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action   : 'themeone_import_demo',
					file     : file,
					type     : type,
					post     : post,
					demo_img : demo_img
				},
				beforeSend: function(){
					var content = (post) ? ': '+post : '';
					$('.to-import-demo-install-inner h3').remove();
					$('.to-import-demo-install-inner').prepend($('<h3>'+'Importing '+type.replace('_type','')+content+'...</h3>'));
					$('.to-import-demo-log-content').append($('<h3>'+type.replace('_type','')+content+'</h3>'));
					file_nb++;
				},
				error: function(xhr, status, error) {
					demo_error = true;
					to_import_demo_ajax(
						demo_content[file_nb]['file'],
						demo_content[file_nb]['type'],
						demo_content[file_nb]['post'],
						demo_img
					);
				},
				success: function(data){
					$('.to-import-demo-install-inner').html('');
					if (data) {
						data = JSON.parse(data);
						$.each(data, function (i, obj) {
							demo_error = (obj.color === 'red') ? true : false;
							var info = $(
								'<span><strong>- '+obj.title+
								':</strong> <span style="color:'+obj.color
								+'">'+obj.statut+'</span></span><br>'
							)
							if (type == 'attachments') {
								demo_img[obj.id] = obj.url;							
							}
							$('.to-import-demo-log-content').append(info);
						});
					}
					
					if (file_nb < file_length) {
						to_import_demo_ajax(
							demo_content[file_nb]['file'],
							demo_content[file_nb]['type'],
							demo_content[file_nb]['post'],
							demo_img
						);
					} else {
						$current_demo.removeClass('to-demo-importing');
						$('.to-import-demos-holder').removeClass('to-demo-is-importing');
						if (demo_error === false) {
							$current_demo.addClass('to-demo-imported');
						} else {
							$current_demo.addClass('to-demo-imported-error');
						}
					}
					
				}
			});
		}
	
	});


})(jQuery);
