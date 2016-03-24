if (typeof jQuery != 'undefined') {
	
	jQuery(document).ready(function($){

		var com_stat = $('<div id="comment-status"></div>'),
			com_form  = '#commentform',
			com_wrap  = '#respond',
			textarea  = '#respond textarea',
			errormsg  = '#error-page',
			com_list  = '.comment-list',
			woo_list  = '.commentlist',
			woo_rev   = '.woocommerce-noreviews',
			is_woo    = '#review_form_wrapper',
			success_msg;
		
		$(document).on('submit', com_form, function(e) {
			
			e.preventDefault();
			
			var $this = $(this);
			com_list = ($(is_woo).length) ? woo_list : com_list;
			$(com_stat).remove();
			$(com_form).prepend(com_stat);
			
			$.ajax({
				beforeSend : function(xhr){
					xhr.setRequestHeader('If-Modified-Since','0');
					$(com_stat).html('<p>'+to_comment_msg.processing+'</p>');
				},
				type : 'post',
				url  : $this.attr('action'),
				data : $this.serialize(),
				dataType : 'html',
				error: function(xhr,status){
					$(com_stat).html('<p><strong>'+to_comment_msg.error_string+' : </strong>'+to_comment_msg.error[xhr.status]+'</p>');
				},
				success : function(data){
					
					// find if there is an error in the data response
					var error = data.replace(/(<\/?)html( .+?)?>/gi,'$1NOTHTML$2>',data),
    					error = error.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>',error),
						error = $(error).find(errormsg),
						$newComList = $(data).find(com_list);
						
					if (error.length) {	
					
						$(com_stat).html(error.html());
						
					} else if ($newComList.length) {
						
						if ($(is_woo).length) {
							com_wrap = woo_rev;
							success_msg = to_comment_msg.success.review;
						} else {
							com_wrap = '#respond';
							success_msg = to_comment_msg.success.comment;
							if ($(com_wrap).parents('li.comment').length > 0) {                   
								$(com_wrap).insertAfter(com_list);
								$('#cancel-comment-reply-link').click();
							}
						}
                 
						if ($(com_list).length > 0) {
							$(com_list).replaceWith($newComList);
						} else {
							$(com_wrap).before($newComList);
							$(woo_rev).remove();
						}

						$(com_stat).html(success_msg);
						setTimeout(function(){
							$(com_stat).remove();
							$(textarea).val(''); 
						}, 3000);
						
					} else {
						
						$(com_stat).html('<p><strong>'+to_comment_msg.error_string+' : </strong>'+to_comment_msg.error['408']+'</p>');
						
					}
					
					return false;
				}
			});
			return false;
		});
		
	});
	
}
