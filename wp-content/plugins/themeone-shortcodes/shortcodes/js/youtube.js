/*************************************************************
YOUTUBE VIDEO
*************************************************************/

(function($) {
	
	if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
	var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);	
	}	
	
	$(document).ready(function() {	
	
		var playerYT = {},
		canPlayHTML5,
		vi;
	
		function getVideoID(el) {
			var videoIframe = el;
			var videoURL = videoIframe.attr('data-youtube-url');
			var reg =  /(\?v=|\&v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/;
			var id = videoURL.match(reg)[2];
			el.attr('id','player'+vi);
			return (id);
		}
		
		var v = document.createElement('video');
		if (v.canPlayType ) { 
			canPlayHTML5 = 1;
		} else {
			canPlayHTML5 = 0;
		}
			
		window.onYouTubeIframeAPIReady = function() {
			vi = 1;
			$('.to-para-youtube').each(function(event) {
				var $thisYT = $(this);
				var videoID = getVideoID($thisYT);
				var ID = $(this).attr('id');
				playerYT[vi] = new YT.Player('player'+vi, {
					videoId: videoID,
					playerVars: {
						autoplay: 1, 
						modestbranding: 1, 
						controls: 0, 
						showinfo: 0, 
						rel: 0, 
						enablejsapi: 1, 
						version: 3, 
						origin: '*', 
						allowfullscreen: true, 
						wmode: 'transparent', 
						iv_load_policy: 3,
						html5: canPlayHTML5
					},
					events: {
						'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
					}
				});
				vi++;
			});
		};
		
		if (window.YT) {
			onYouTubePlayerAPIReady();
		}
		
		function onPlayerReady(event) {
			youtubeSizes();
			event.target.mute();
			event.target.playVideo();
		}
		
		function onPlayerStateChange(event) {
			var state = event.target.getPlayerState();
			if (state === 0) {
				event.target.playVideo();
			}
		}
		
		function youtubeSizes() {
			var $YTVideos = $('.parallax-container-inner iframe.to-para-youtube');
			$YTVideos.each(function() {
				var $el = $(this);
				var pYTW = $el.parent().width();
				var pYTH = $el.parent().height();
				var ratio;
				if (!$el.data('youtube-ratio')) {
					ratio = this.height / this.width;
					$el.attr('data-youtube-ratio', ratio);
				} else {
					ratio = $el.attr('data-youtube-ratio');
				}
				$el.removeAttr('height width');
				if (pYTW*ratio >= pYTH) {
					$el.height(pYTW*ratio).width('100%').css('margin-top', -(pYTW*ratio-pYTH)/2).css('margin-left', 0);
				} else {
					var left = -(pYTH/ratio-pYTW)/2;
					$el.height(pYTH).width(pYTH/ratio).css('margin-left', left).css('margin-top', 0);
				}
			});
		}
			
		$(window).on('resize', function() {
			youtubeSizes();
		});
	
	});
	
})(jQuery, window);