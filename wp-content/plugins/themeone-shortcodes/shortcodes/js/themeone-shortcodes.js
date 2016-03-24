jQuery(document).ready(function($) {

/**********************************************************************************************
CHECK BROWSERS CAPABILITY
***********************************************************************************************/

	var smoothScroll = !!('WebkitOverflowScrolling' in document.documentElement.style);
	var touchDevice = (Modernizr.touch) ? true : false;
	var css3 = (Modernizr.csstransforms3d) ? true : false;

/*************************************************************
GET VENDOR PREFIX
*************************************************************/

	var pre;
	function prefix() {
		var styles = window.getComputedStyle(document.documentElement, '');
		pre = (Array.prototype.slice.call(styles).join('') .match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o']))[1];
	}
	if (css3 === true) {
		prefix();
	}
	var ie = (function() {
		var v = 3,
			div = document.createElement('div'),
			all = div.getElementsByTagName('i');
		do {
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->';
		}
		while (all[0]);
		return v > 4 ? v : document.documentMode; 		
	}());

/*************************************************************
REQUEST ANIMATION FRAME FOR PARALLAX
*************************************************************/

	var scroll = window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				window.msRequestAnimationFrame ||
				window.oRequestAnimationFrame ||
				function(callback){ window.setTimeout(callback, 1000/600); };

/*************************************************************
PARALLAX DIVS
*************************************************************/

	$('.paratrue iframe').each(function() {
		if (ie == 11 && parseInt($(this).parent().height()) > 1000) {
			$(this).closest('.parallax-container').removeClass('paratrue');
		}
	});
	
	var divPosition = -1;
	function parallaxImgDiv(){	
		if (divPosition == $(document).scrollTop()) {
			scroll(parallaxImgDiv);
			return false;
		} else {
			if (touchDevice === false && css3 === true) {
				var wH = $(window).height();
				$('.paratrue').each(function() {
					var $this = $(this);
					var sPos = $(document).scrollTop();
					var pPos = $this.offset().top;
					var pH = $this.outerHeight(true);
					var pTop = pPos - wH;
					var pBot = pPos + wH;
					if (sPos >= pTop && sPos <= pBot) {
						var pF = 50/(wH+pH);
						var pX = Math.abs(sPos-pTop)*pF*-1;
						$this.find('.parallax-container-inner').css('-'+pre+'-transform', 'translate3d(0px, '+pX+'%, 0px)');
					}
				});
			}
		}
		scroll(parallaxImgDiv);
	}
	
	if (touchDevice === false) {
		parallaxImgDiv();
	}

/*************************************************************
NUMBER COUNTER
*************************************************************/
	
	$.fn.countTo = function(options) {
        options = $.extend({}, $.fn.countTo.defaults, options || {});
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;
        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);
            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals)+options.sign);
                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }
                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;
                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,
        to: 100,
        speed: 1000, 
        refreshInterval: 100,
        decimals: 0,
		sign: '',
        onUpdate: null,
        onComplete: null
    };

/*************************************************************
ADD ONE-FOURTH CLASS
*************************************************************/
	
	function colCalc() {	
		$('.col.col-3').each(function(){
			var $currentDiv = $(this);
			var $nextDiv = $(this).next('div, li');
			if ( $nextDiv.hasClass('col-3') && !$currentDiv.hasClass('col1-4')) {
				$currentDiv.addClass('col1-4 clear-both');
				$nextDiv.addClass('col1-4 right-edge');
			}
		});
		
		$('.col.col-2').each(function(){
			var $currentDiv = $(this);
			var $nextDiv = $currentDiv.nextAll('div, li').slice(0,6);
			if ( $nextDiv.hasClass('col-2') && !$currentDiv.hasClass('col1-4')) {
				$currentDiv.addClass('col1-4 clear-both');
				$currentDiv.nextAll('div, li').slice(0,1).addClass('col1-4 right-edge');
				$currentDiv.nextAll('div, li').slice(1,2).addClass('col1-4 clear-both mid-edge');
				$currentDiv.nextAll('div, li').slice(2,3).addClass('col1-4 col1-6 right-edge');
				$currentDiv.nextAll('div, li').slice(3,4).addClass('col1-4 clear-both');
				$currentDiv.nextAll('div, li').slice(4,5).addClass('col1-4 right-edge');
			}
		});
	}
	
	function viewport() {
		var e = window, a = 'inner';
		if (!('innerWidth' in window )) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return { width : e[ a+'Width' ]};
	}
	
	function colCalc2() {
		windowSize = viewport().width;
		var colHP = [];
		var colNb = 1;
		
		$('.to-anim-box').each(function(){
			var height = [];
			var $currentDiv = $(this);
			$currentDiv.add($currentDiv.find('.to-anim-box-icon-inner,.to-anim-box-desc,.to-anim-box-icon')).addClass('notransition').height('auto');
			height.push($currentDiv.find('.to-anim-box-desc').outerHeight());
			height.push($currentDiv.find('.to-anim-box-icon').outerHeight());
			height = Math.max.apply(Math,height);
			$currentDiv.add($currentDiv.find('.to-anim-box-icon-inner,.to-anim-box-desc,.to-anim-box-icon')).css('height',height+'px');
			$currentDiv.add($currentDiv.find('.to-anim-box-icon-inner,.to-anim-box-desc,.to-anim-box-icon')).removeClass('notransition');
		});
		
		$('.col.col-padding').each(function(){
			var $currentDiv = $(this);
			$currentDiv.height('auto');
			if ($currentDiv.find('.to-anim-box').length) {
				$currentDiv.addClass('to-anim-box-border');
			}
			if ($currentDiv.find('.to-member-box').length) {
				var img = $currentDiv.find('.team-member-box-image').css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
				var tmpImg = new Image();
				tmpImg.src = img;
				$(tmpImg).on('load',function(){
					var ratio  = tmpImg.height/tmpImg.width;
					var height = $currentDiv.outerWidth()*ratio;
					$currentDiv.css('height',height);					
				});
			}
			if (windowSize > 999 && !$currentDiv.children('.to-step').length) {
				var $nextDiv = $currentDiv.next('div');
				$currentDiv.addClass('col-H'+colNb);
				colHP.push($currentDiv.outerHeight());
				if ($currentDiv.hasClass('col-last')) {
					var height = Math.max.apply(Math,colHP);
					$('.col-H'+colNb).css('height',height+'px');
					colHP = [];
					colNb++;
				}
			}
		});
		
		$('.equal-height').each(function(){
			var $currentDiv = $(this).find('> [class*=vc_col-], > .section-container > [class*=vc_col-]');//.children('[class*="vc_col-"]');
			$currentDiv.last().addClass('col-last');
			$currentDiv.height('auto');
			$currentDiv.each(function(){
				$currentDiv = $(this);
				if ($currentDiv.find('.to-anim-box').length) {
					$currentDiv.addClass('to-anim-box-border');
				}
				if ($currentDiv.find('.to-member-box').length) {
					$currentDiv.addClass('col-H'+colNb);
					var img = $currentDiv.find('.team-member-box-image').css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
					var tmpImg = new Image();
					tmpImg.src = img;
					$(tmpImg).on('load',function(){
						var ratio  = tmpImg.height/tmpImg.width;
						var height = $currentDiv.outerWidth()*ratio;
						colHP.push(height);	
						if ($currentDiv.hasClass('col-last')) {
							var height = Math.max.apply(Math,colHP);
							$('.col-H'+colNb).css('height',height+'px');
							colHP = [];
							colNb++;
						}		
					});
				} else if (!$currentDiv.children('.to-step').length) {
					var $nextDiv = $currentDiv.next('div');
					$currentDiv.addClass('col-H'+colNb);
					colHP.push($currentDiv.outerHeight());
					if ($currentDiv.hasClass('col-last')) {
						var height = Math.max.apply(Math,colHP);
						$('.col-H'+colNb).css('height',height+'px');
						colHP = [];
						colNb++;
					}
				}
			});
		});
	}

	$(window).resize(function() {
		setTimeout( function(){
			colCalc2();
		},800);
	});

/*************************************************************
COLUMN ANIMATION
*************************************************************/

	function colAnim() {
		$('.no-touch.no-csstransitions .has-anim').appear(function() {	
			var $this = $(this);
				anim = $this.attr('data-anim').replace('from-', '');
				delay = $this.attr('data-delay');
				ease = 'easeOutSine';
				options = {};	
			options[anim] = 0;
			options['opacity'] = 1;
			if(anim !== '' && anim !== 'grow-in' && anim !== 'flip-in'){
				$this.delay(delay).animate(options, 800, ease);
			}
			setTimeout( function(){
				$this.removeClass('has-anim');
			},parseInt(delay)+1200);
		},{accX: 0, accY: -90});
		
		$('.no-touch.csstransitions .has-anim').appear(function() {
			var $this = $(this);
				delay = $this.attr('data-delay');
			setTimeout( function(){
				$this.css({
						'transform': 'perspective(1000px) rotateY(0deg) translate3d(0,0,0)',
						'-webkit-transform': 'perspective(1000px) rotateY(0deg) translate3d(0,0,0)',
						'-o-transform': 'perspective(1000px) rotateY(0deg) translate3d(0,0,0)',
						'-moz-transform': 'perspective(1000px) rotateY(0deg) translate3d(0,0,0)',
						'opacity': 1
				});
			},delay);
			setTimeout( function(){
				$this.removeClass('has-anim');
			},parseInt(delay)+1200);
		},{accX: 0, accY: -90});
	}
	
	$(window).resize(function() {
		$('.no-touch .has-anim .owl-carousel').each(function() {
			$this = $(this);
			$this.closest('.has-anim').addClass('notransition');
        });
		setTimeout(function() {
			$('.no-touch .has-anim .owl-carousel').closest('.has-anim').removeClass('notransition');
		}, 300);
    });

/*************************************************************
PROGRESS BAR ANIMATION
*************************************************************/
	
	function progressBar() {
		$('.to-progress-bar').appear(function(){	
			var $this = $(this);
			var percent = $this.attr('data-width');	
			$this.animate({'width' : percent + '%'},1500, 'easeOutCirc');	
			$this.find('strong').animate({'opacity' : 1},1000, 'easeOutCirc');	
			$this.find('strong').countTo({
				from: 0,
				to: percent,
				speed: 1000,
				refreshInterval: 30,
				sign: '%'
			});	
		},{accX: 0, accY: -90});
		
		$('#sliding-sidebar .to-progress-bar').each(function(index, element) {
			var $this = $(this);
			var percent = $this.attr('data-width');	
			$this.width(percent + '%');
			$this.find('strong').css('opacity',1);	
			$this.find('strong span').html(percent + '%');
		});
	}

/*************************************************************
PROGRESS PIE ANIMATION
*************************************************************/
	
	function pieChartAnim() {
		$('.to-pie-chart-anim').appear(function(){
			var percent = $(this).attr('data-anim');
			$(this).data('easyPieChart').update(percent);
		},{accX: 0, accY: -90});
	}

/*************************************************************
COUNTER
*************************************************************/

	function counter() {
		$('.to-counter-holder').appear(function(){	
			var $this = $(this);
			var number = $this.attr('data-counter');
			var speed = $this.attr('data-counter-speed');
			if ($this.closest('.no-touch .col.has-anim').length) {
				setTimeout(function() {
					$this.find('.to-counter-number .to-count-number').countTo({
						from: 0,
						to: number,
						speed: speed,
						refreshInterval: 30
					});
				}, 800);
			} else {
			$this.find('.to-counter-number .to-count-number').countTo({
				from: 0,
				to: number,
				speed: speed,
				refreshInterval: 30
			});	
			}
		},{accX: 0, accY: -90});
	}
	
/*************************************************************
BUTTON ANIMATION
*************************************************************/

	function lightOrDark(color){
		var r,b,g,hsp, a = color;
		
		if (a === false) {
			a = '#000000';
		}
		
		if (a.match(/^rgb/)) {
			a = a.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);
			r = a[1];
			b = a[2];
			g = a[3];
		} else {
			a = +("0x" + a.slice(1).replace( a.length < 5 && /./g, '$&$&'));
			r = a >> 16;
			b = a >> 8 & 255;
			g = a & 255;
		}
		hsp = Math.sqrt(0.299*(r*r)+0.587*(g*g)+0.114*(b*b));
		if (hsp>200) {
			color = 'light';
		} else {
			color = 'dark';
		}
		return color;
	}
	
	function buttonColor(){
		$('.to-button.to-button-border.to-button-anim').each(function(index, element) {
			if (!$(this).attr('data-txtcolor')) {
				if ($(this).parents('.parallax-container').length) {
					var txtColor = $(this).parents('.parallax-container').find('.parallax-container-overlay-color').css('background-color');
					if (!txtColor) {
						var txtColor = $(this).parents('.parallax-container').find('.parallax-container-overlay').css('background-color');
					}
				} else {
					var txtColor = svgBg($(this));
				}
				$(this).attr('data-txtcolor',txtColor);
			} else {
				var txtColor = $(this).attr('data-txtcolor');
			}
		
			var color1 = lightOrDark($(this).attr('data-bgcolor'));
			var color2 = lightOrDark(txtColor);
			if (color1 == color2) {
				if (color2 == 'light') {
					txtColor = '#000000';	
				} else {
					txtColor = '#ffffff';
				}
			} 
			$(this).attr('data-txtcolor',txtColor);
        });	
	}
	
	$(document).on('mouseenter', '.to-button.to-button-border.to-button-anim', function() {		
		var txtColor = $(this).attr('data-txtcolor');
		if (txtColor) {
			var bgColor = $(this).data('color');
			$(this).attr('style', 'color:'+txtColor+';background:'+bgColor+' !important;border-color:'+bgColor+'');
			$(this).find('span').attr('style', 'color:'+txtColor);
		}	
	}).on('mouseleave', '.to-button.to-button-border', function() {
		var txtColor = $(this).data('color');
		if (txtColor) {
			$(this).attr('style', 'color:'+txtColor+';background: none !important;border-color:'+txtColor+'');
			$(this).find('span').attr('style', 'color:'+txtColor);
		}
	});
	
	$(document).on('mouseenter', '.to-button.to-button-bg.to-button-anim', function() {
		var txtColor = $(this).data('color');
		if (txtColor) {
			$(this).css('color', txtColor);
			$(this).find('span').attr('style', 'color:'+txtColor);
		}
	}).on('mouseleave', '.to-button.to-button-bg', function() {
		var txtColor = $(this).data('bgcolor');
		if (txtColor) {
			$(this).css('color', txtColor);
			$(this).find('span').attr('style', 'color:'+txtColor);
		}
	});
				
/*************************************************************
ICON ANIMATIONS
*************************************************************/

	function iconHover() {
		$('.to-icon').bind('webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend', function() {
			var anim = $(this).attr('data-anim-icon');
			$(this).removeClass(anim);
		});
	}
	
	$(document).on('hover', '.col, .to-list, .to-button', function() {
		if ( $(this).find('ul').length === 0 && $(this).find('.to-button').length === 0) {
			var anim = $(this).find('.to-icon').attr('data-anim-icon');  
			$(this).find('.to-icon').addClass(anim);   
		}    
	});
	$(document).on('hover', '.vc_column_container .to-icon', function() {
		var anim = $(this).attr('data-anim-icon');  
		$(this).addClass(anim);    
	});
	
	$(document).on('mouseenter', '.col', function(){
		var $this = $(this);
		if ($this.find('.to-icon.full-bg.color.bg-anim').length > 0) {
			var color = $this.find('.to-icon.full-bg.color').attr('data-bg');
			$this.find('.to-icon.full-bg.color.bg-anim').attr('style', 'color:'+ color +'! important');
			$this.find('.to-icon.full-bg.color.bg-anim').css('background', 'none');
		}
	}).on('mouseleave', '.col, .vc_column_container', function(){
		var $this = $(this);
		if ($this.find('.to-icon.full-bg.color.bg-anim').length > 0) {
			var color = $this.find('.to-icon.full-bg.color.bg-anim').attr('data-bg');
			$this.find('.to-icon.full-bg.color.bg-anim').attr('style', 'color:'+ $this.find('.to-icon.full-bg.color').attr('data-color'));
			$this.find('.to-icon.full-bg.color.bg-anim').css('background', color);
		}
	});
	
	$(document).on('mouseenter', '.vc_column_container .to-icon.full-bg.color.bg-anim', function(){
		var $this = $(this);
		if ($this.length > 0) {
			var color = $this.attr('data-bg');
			$this.attr('style', 'color:'+ color +'! important');
			$this.css('background', 'none');
		}
	}).on('mouseleave', '.vc_column_container .to-icon.full-bg.color.bg-anim', function(){
		var $this = $(this);
		if ($this.length > 0) {
			var color = $this.attr('data-bg');
			$this.attr('style', 'color:'+ $this.attr('data-color'));
			$this.css('background', color);
		}
	});
	
/*************************************************************
TABS
*************************************************************/

	var tabholder = '.to-tabs-holder',
		tab = '.to-tabs li',
		tabLine = '.to-tabs-line',
		activetab = 'active-tab';
	
	$(document).on( 'click',tab, function() {
		var $this = $(this);
		if(!$this.hasClass('active-tab') && $this.index()>1) {
			var i = $this.index()-2;
			$this.closest(tabholder).find('.to-tab').hide().removeClass('active-tab');
			$this.closest(tabholder).find('.to-tab').eq(i).fadeIn(500).addClass('active-tab');
			$this.closest(tabholder).find('li').removeClass(activetab);
			$this.addClass(activetab);
		}
	});
	$(document).on( 'mouseover',tab, function() {
		if (!$(this).is('.to-tabs-overlay, .to-tabs-line')) {
			tabMove($(this));
		}
	}).on( 'mouseleave',tab, function() {
		if (!$(this).is('.to-tabs-overlay, .to-tabs-line')) {
			tabMove($(this).closest(tabholder).find('li.'+activetab));
		}
	});
	
	function activedtab() {
		smartTabs();
		$(tabholder).each(function() {
			var $curtab = $(this).find('li.'+activetab);
			if (!$curtab.length) {
				$curtab = $(this).find('ul li').first();
				$curtab.addClass(activetab);
			}
			tabMove($curtab);
		});
	}
	
	function tabMove(el) {
		var index = el.position().left;
		var width = el.outerWidth();
		movingLine(el.closest('ul').find(tabLine),width,index);
	}
	
	function movingLine(el,w,off) {
		if (Modernizr.csstransitions) {
			el.css({
				'width': w+'px',
				'-webkit-transform':' translate3d('+off+'px,0,0)',
				'-moz-transform':' translate3d('+off+'px,0,0)',
				'-ms-transform':' translate3d('+off+'px,0,0)',
				'-o-transform':' translate3d('+off+'px,0,0)',
				'transform': 'translate3d('+off+'px,0,0)'
			});
		} else  {
			el.stop(true).animate({left:off+'px',width:w+'px'}, 300);
		}
	}
	
	function smartTabs() {
		$(tabholder).each(function() {
			var width = 0;
			$(this).find('.to-tabs li span').each(function() {
                width = width + $(this).outerWidth();
            });
			if (width>$(this).width()) {
				$(this).addClass('block-tabs');
			} else if ($(this).hasClass('block-tabs')) {
				$(this).removeClass('block-tabs');
			}
		});
	}
	
	$(window).resize(function() {
		smartTabs();
		activedtab();
    });
	
/*************************************************************
TOGGLES
*************************************************************/

	$(document).on('click', '.to-toggle-title', function(){
		if ($(this).find('.to-toggle-open .icon-to-plus').length) {
			$(this).find('.to-toggle-open').html('<i class="fa fa-minus accentColorHover"></i>');
		} else {
			$(this).find('.to-toggle-open').html('<i class="icon-to-plus accentColorHover"></i>');
		}
		$(this).next('.to-toggle-content').slideToggle(200);
	});
	
/*************************************************************
ACCORDIONS
*************************************************************/
	var accContent = '.to-accordion-content',
		accHolder  = 'to-accordion-holder',
		accOpen    = '.to-accordion-open',
		accPlus    = '.to-accordion-open .icon-to-plus';
		
	$(document).on('click', '.to-accordion-title', function(){
		$this = $(this);
		$prev = $this.parent().prev();
		while ($prev.hasClass(accHolder)) {
			if ($prev.find(accContent).is(':visible')) {
				$prev.find(accContent).slideToggle(300);
				$prev.find(accOpen).html('<i class="icon-to-plus accentColorHover"></i>');
			}
			$prev = $prev.prev();
		}
		$next = $this.parent().next();
		while ($next.hasClass(accHolder)) {
			if ($next.find(accContent).is(':visible')) {
				$next.find(accContent).slideToggle(300);
				$next.find(accOpen).html('<i class="icon-to-plus accentColorHover"></i>');
			}
			$next = $next.next();
		}
		if ($this.find(accPlus).length) {
			$this.next(accContent).slideToggle(300);
			$this.find(accOpen).html('<i class="fa fa-minus accentColorHover"></i>');
		}
	});
	
/*************************************************************
PIE CHARTS
*************************************************************/
	
	var pieChart,
		iconClass,
		speed;
	
	function initPieChart() {
		$('.to-pie-chart').each(function() {
			$pieChart = $(this);
			if ($pieChart.hasClass('to-pie-chart-anim')) {
				speed = 1000;
			} else {
				speed = 1;
			}
			var legendStyle = $pieChart.attr('data-legend-style');
			var lineWidth = $pieChart.attr('data-line-width');
			var barColor = $pieChart.attr('data-bar-color');
			var backgroundColor = $pieChart.attr('data-background-color');
			var chartSize = $pieChart.width();
			$pieChart.easyPieChart({
				animate: speed,
				barColor: barColor,
				trackColor: backgroundColor,
				lineWidth: lineWidth,
				size: chartSize,
				scaleColor: false,
				onStep: function(from, to, percent) {
					if(legendStyle == 'percent') {
						this.el.children[0].innerHTML = Math.round(percent)+'%';
					}
				}
			});
			pieChartSize();
		});
	}
	
	function pieChartSize() {
		var maxSize = $pieChart.parent().parent().width()*0.9;
		var maxWidth = parseInt($pieChart.parent().css('max-width'));
		var pieWidth = parseInt($pieChart.data('width'));
		if (pieWidth > maxSize || maxWidth < maxSize) {
			if (pieWidth <= maxSize) {
				maxSize = pieWidth;
			}
			$pieChart.parent().css({'max-width': maxSize+'px','max-height': maxSize+'px','line-height': maxSize+'px'});
			$pieChart.find('canvas').width(maxSize).height(maxSize);
			pieWidth = maxSize;
		}
		$pieChart.find('span').css('font-size', (pieWidth/5)+'px');
		$pieChart.find('i').css('font-size', (pieWidth/3)+'px');
	}
	
	$(window).resize(function() {
        $('.to-pie-chart').each(function() {
			$pieChart = $(this);
			pieChartSize();
		});
    });

/*************************************************************
TEAM CAROUSEL
*************************************************************/
	
	function teamCarousel() {
		$('.to-team-carousel').owlCarousel({
			theme: '',
			pagination: false,
			navigation: true,
			slideSpeed: 500,
			navigationText: ['<i class="icon-to-left-arrow-thin accentColorHover"></i>','<i class="icon-to-right-arrow-thin accentColorHover"></i>']
		});
	}

/*************************************************************
TESTIMONIAL CAROUSEL
*************************************************************/

	function testiCarousel() {
		$('.to-testimonial').owlCarousel({
			theme: '',
			singleItem: true,
			autoHeight: true,
			stopOnHover: true,
			slideSpeed: 500,
			navigationText: ['<i class="icon-to-left-arrow-thin accentColorHover"></i>','<i class="icon-to-right-arrow-thin accentColorHover"></i>']
		});
	}

/*************************************************************
CLIENTS CAROUSEL
*************************************************************/
	
	function clientCarousel() {
		$('.to-clients-carousel').owlCarousel({
			theme: '',
			stopOnHover: true,
			slideSpeed: 500,
			navigationText: ['<i class="icon-to-left-arrow-thin accentColorHover"></i>','<i class="icon-to-right-arrow-thin accentColorHover"></i>'],
		});
	}

/*************************************************************
SLIDER
*************************************************************/

	function toscSlider() {
		$('.to-sc-slider').owlCarousel({
			theme: '',
			singleItem: true,
			autoHeight: true,
			stopOnHover: true,
			slideSpeed: 500,
			navigationText: ['<div class="to-sc-button-over"></div><i class="icon-to-left-arrow-thin accentColorHover"></i>','<div class="to-sc-button-over"></div><i class="icon-to-right-arrow-thin accentColorHover"></i>']
		});
	}
	
/*************************************************************
Twitter Carousel
*************************************************************/

	function toscTwitter() {
		$('.to-sc-twitter').owlCarousel({
			theme: '',
			singleItem: true,
			autoHeight: true,
			stopOnHover: true,
			slideSpeed: 500,
			navigationText: ['<i class="icon-to-left-arrow-thin accentColorHover"></i>','<i class="icon-to-right-arrow-thin accentColorHover"></i>']
		});
	}
	
/*************************************************************
SVG AUTOMATED FILL COLOR IF NO EXIST
*************************************************************/

	function svgBg(svgEl) {
		var color = svgEl.css('background-color');   
		if ((color !== 'rgba(0, 0, 0, 0)') && (color !== 'transparent')) {
			return color;
		}
		if (svgEl.is('body')) {
			return false;
		} else {
			return svgBg(svgEl.parent());
		}
	}
	
	function svgFill() {
		$('.to-separator-top svg path, .to-separator-bottom svg path, .to-separator-top svg circle, .to-separator-bottom svg circle').each(function() {
			var fill = $(this).attr('fill');
			if (typeof val === 'undefined') {
				var fillColor = svgBg($(this));
				$(this).css('fill', fillColor);
			}
		});
	}

/*************************************************************
VIDEO SECTION
*************************************************************/

var videosSection = [];
var videoSDiv = '.parallax-container video';
var videoVimeoS= 'iframe.vimeo-player-section';

function videoSection() {	
	videosSection = [];
	$(videoSDiv).mediaelementplayer({
		features: ['volume'],
		pauseOtherPlayers: false,
		loop: true,
		startVolume: 0.0,
		success: function(mediaElement, domObject) {
			mediaElement.addEventListener('play', function(e) {
				$(mediaElement).closest('.parallax-container').find('.parallax-container-poster').remove();
			});
			videosSection.push(mediaElement);
			mediaElement.pause();
			mediaElement.load();	
			mediaElement.addEventListener('loadeddata', function(e) {
				videoSectionSize(mediaElement);
				mediaElement.play();
			});
		},
		error:  function(domObject) {
			$(domObject).closest('.mejs-container').remove();
		}
	});
	
}

function videoSectionSize(mediaElement) {
	var $this = $(mediaElement);
	$this.attr('style','');
	var wW = $this.width();
	var wH = $this.height();
	var pW = $this.closest('.parallax-container-inner').width();
	var pH = $this.closest('.parallax-container-inner').height();
	var wR = wW/pW;
	var hR = wH/pH;
	var scale = Math.min(wR,hR);
	var rW = (wW/scale);
	var rH = (wH/scale);
	var leftI = -Math.abs((rW-pW)/2);
	var topI = (rH-rW)/2;
	$this.attr('style', 'height: auto !important; width: '+rW+'px !important; left: '+leftI+'px !important; top: 0px !important;');
}

function videoSectionVimeo() {
	$('iframe.vimeo-player-section').each(function() {
		var $el = $(this);
		var pYTW = $el.parent().width();
		var pYTH = $el.parent().height();
		var ratio;
		if (!$el.data('vimeo-ratio')) {
			ratio = $el.data('height') / $el.data('width');
			$el.attr('data-vimeo-ratio', ratio);
		} else {
			ratio = $el.attr('data-vimeo-ratio');
		}
		$el.removeAttr('height width');
		if (pYTW*ratio >= pYTH) {
			$el.height(pYTW*ratio).width('100%').css('margin-top', -(pYTW*ratio-pYTH)/2).css('margin-left', 0);
		} else {
			var left = -(pYTH/ratio-pYTW)/2;
			$el.height(pYTH).width(pYTH/ratio).css('margin-left', left).css('margin-top', 0);
		}
	});
	
	if (window.addEventListener) {
		window.addEventListener('message', onMessageReceived, false);
	} else {
		window.attachEvent('onmessage', onMessageReceived, false);
	}
	
	function onMessageReceived(e) {
		var data = JSON.parse(e.data);
		switch (data.event) {
			case 'ready':
				$('iframe.vimeo-player-section').each(function(index, element) {
                    var $f = $(this),
					url = 'http:'+$f.attr('src').split('?')[0];
					var data = { method: 'setVolume', value: '0' };
					$f[0].contentWindow.postMessage(JSON.stringify(data), url);
                });
				break;
		}
	}
}

$(window).resize(function() {
	$(videoSDiv).each(function(){
		videoSectionSize($(this));
	});
	videoSectionVimeo();
});

/*************************************************************
VIDEO
*************************************************************/

var toSCvideo = '.to-sc-video-holder video';

function to_sc_video() {	
	$(toSCvideo).mediaelementplayer({
		features: ['fullscreen','playpause', 'current', 'progress', 'duration', 'volume'],
		videoVolume: 'vertical',
		pauseOtherPlayers: false,
		startVolume: 0.8,
		success: function(mediaElement, domObject) {	
			mediaElement.addEventListener("ended", function(e){ 
				$(e.target).closest('.to-sc-video-holder').find(' .mejs-poster').show();
			});
		},
		error:  function(domObject) {
			$(domObject).closest('.mejs-container').remove();
		}
	});
}

/*************************************************************
GOOGLE FONT LOADER ASYNC*
*************************************************************/

var fontArr = [];

function google_font_loader() {
	$('span[data-font]').each(function() {
		var font = $(this).data('font');
		var family = font.replace(':','');
		if ($.inArray(family, fontArr) == -1) {
			fontArr.push(family);
			$.ajax({
				beforeSend: function ( xhr ) {
					xhr.overrideMimeType("application/octet-stream");
				},
				success: function() {
					$("<link />", {
						'id': family,
						'rel': 'stylesheet',
						'href': 'http://fonts.googleapis.com/css?family='+font
					}).appendTo('head');
				}
			});
		}
	});
}

/*************************************************************
PROCESS STEP CAROUSEL
*************************************************************/
	
function processStep() {
	var owlClick = false;
	var owlDrag  = false;
	$('.to-process').owlCarousel({
		theme: '',
		pagination: false,
		navigation: false,
		slideSpeed: 500,
		afterInit: function(elem){
			var page  = '';
			var nb    = $(elem).find('.owl-item').length;
			var first = ' active';
			if (nb > 1) {
				for (var i=1; i<=nb; i++) {
					page  = page+'<span class="to-step-nb'+first+'">'+0+String(i)+'</span>';
					first = '';
				}
				$(elem).append('<span class="to-step-pages">'+page+'</span>');
			}
			$(elem).find('.owl-item').first().addClass('active');
		},
		startDragging : function (elem) {
			owlDrag = true;
		},
		afterMove : function (elem) {
			if (owlClick !== true) {
				var $current = $(elem).closest('.to-process');
				var x = this.owl.currentItem;
				$current.find('.to-step-nb').add($current.find('.owl-item')).removeClass('active');
				$current.find('.to-step-nb').eq(x).add($current.find('.owl-item').eq(x)).addClass('active');
			}
			owlClick = false;
			owlDrag  = false;
		}
	});
	$(document).on('click', '.to-process .to-step-nb', function(e){
		owlClick = true;
		var $current = $(this).closest('.to-process');
		var owl = $current.data('owlCarousel');
		var x   = parseInt($(this).text())-1;
		$current.find('.to-step-nb').add($current.find('.owl-item')).removeClass('active');
		$(this).add($current.find('.owl-item').eq(x)).addClass('active');
		owl.goTo(x);
	});
	$(document).on('click', '.to-process .owl-item', function(e){
		owlClick = true;
		var $current = $(this).closest('.to-process');
		var owl = $current.data('owlCarousel');
		var x   = parseInt($(this).index());
		$current.find('.to-step-nb').add($current.find('.owl-item')).removeClass('active');
		$(this).add($current.find('.to-step-nb').eq(x)).addClass('active');
		owl.goTo(x);
	});
}

/*************************************************************
TOOLTIP HOVER
*************************************************************/

var chrW = 0;
$.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()); 

if($.browser.chrome){
	chrW = 2;
}

$(document).ready(function() {
	if ($('#wpadminbar').length) {
		adminBarH = parseInt($('html').css('top'));
	} else {
		adminBarH = 0;
	}
});

$(window).resize(function() {
	if ($('#wpadminbar').length) {
		adminBarH = parseInt($('html').css('top'));
	} else {
		adminBarH = 0;
	}
});

var targets = '[rel~=tooltip]',
	target  = false,
	tooltip = false,
	title   = false,
	pos_left,
	pos_top;

function to_tooltip_size() {	
	var docW = $(window).width();
	if (docW < 340 * 1.5) {
		tooltip.css('width',docW/2);
	} else {
		tooltip.css('width',340);
	}	
	pos_left = target.offset().left - (tooltip.outerWidth()/2) + 15 - chrW;
	pos_top  = target.offset().top  - tooltip.outerHeight();

	if (pos_left < 0) {
		pos_left = target.offset().left + target.outerWidth() / 2;
		tooltip.addClass('left');
	} else {
		tooltip.removeClass('left');
	}
	if (pos_left + tooltip.outerWidth() > docW) {
		pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2;
		tooltip.addClass('right');
	} else {
		tooltip.removeClass('right');
	}		
	if (pos_top - $(window).scrollTop() - $('header').height() - 45 < 0) {
		pos_top  = target.offset().top + target.outerHeight();
		tooltip.addClass('top');
		pos_top = pos_top + 25 - adminBarH;
	} else {
		tooltip.removeClass('top');
		pos_top = pos_top - 25 - adminBarH;
	}
	chrW = 10;
}
 
$(document).on('mouseenter', targets, function() {
	tip     = $(this).data('content');
	target  = $(this).closest('.to-pulse-holder');
	tooltip = $('#to-tooltip');
	if(!tip || tip == '') {
		return false;
	}
	if (tooltip.length == 0) {
		$('body').append('<div id="to-tooltip"></div>');
		tooltip = $('#to-tooltip');
	}
	tooltip.css('z-index', 10);
	tooltip.html(tip);
	to_tooltip_size();
	tooltip.css({left: pos_left,top: pos_top}).addClass('show');
		
}).on('mouseleave', targets, function() {
	remove_tooltip();
});

function remove_tooltip() {
	tooltip.removeClass('show');
	setTimeout( function(){
		if (tooltip.css('opacity') == 0) {
			tooltip.css('z-index', -1);
		}
	},500);
}

$(window).resize(function(){
	if (tooltip.length == 0) {
		to_tooltip_size();
		tooltip.css('z-index', -1);
	}
});

/*************************************************************
SIMPLE TYPE WRITER
*************************************************************/


function typeString($target, str, cursor, delay, cb) {

	$target.html(function (_, html) {
		return html + str[cursor];
	});

	if (cursor < str.length - 1) {
		delay = Math.round(Math.random() * (300 - 30)) + 30;

		setTimeout(function () {
			typeString($target, str, cursor + 1, delay, cb);
		}, delay);
	} else {
		cb();
	}
}

function deleteString($target, delay, cb) {
	var length;

	$target.html(function (_, html) {
		length = $target.text().length;
		return html.substr(0, length - 1);
	});
	delay = 100;
	if (length > 1) {
		setTimeout(function () {
			deleteString($target, delay, cb);
		}, delay);
	} else {
		cb();
	}
}

$.fn.extend({
	teletype: function (opts) {
		var settings = $.extend({}, $.teletype.defaults, opts);
		return $(this).each(function () {
			(function loop($tar, idx) {
				typeString($tar, settings.text[idx], 0, settings.delay, function () {
					setTimeout(function () {
						deleteString($tar, settings.delay, function () {
							loop($tar, (idx + 1) % settings.text.length);
						});
					}, settings.pause);
				});
			}($(this), 0));
		});
    }
});
 
$.extend({
	teletype: {
		defaults: {
			delay: 100,
			pause: 2500,
			text: []
		}
	}
});

function typeWriter () {
	$('.to-type-writer').each(function() {
		var $this = $(this);
		if (!$this.hasClass('typing')) {
			$this.teletype({
				text : $this.data('text').split(";"),
				pause: $this.data('pause')
			});
			$this.addClass('typing');
		}
		
	});
	
	$('.to-type-writer-cursor').teletype({
		text: ['|', ' '],
		delay: 0,
		pause: 500
	});
}


/*************************************************************
INIT SHORTCODE
*************************************************************/
 
	function initShortcode() {
		processStep();
		google_font_loader();
		buttonColor();
		colCalc();	
		activedtab();
		smartTabs();
		iconHover();
		initPieChart();
		pieChartAnim();
		progressBar();
		counter();
		teamCarousel();	
		testiCarousel();
		clientCarousel();
		toscSlider();
		toscTwitter();
		svgFill();
		to_sc_video();
		videoSection();
		videoSectionVimeo();
		colCalc2();	
		typeWriter();
	}
	
	colAnim();
	$(document).ready(function() {
		initShortcode();
	});
	
	$(window).on('statechangecomplete', function() {
		colAnim();
		initShortcode();
		ajaxVCscripts();
	});
	
	/*** keep stadard Visual Composer Functionnality with ajax ***/
	function ajaxVCscripts() {
		if ($('html').hasClass('vc_desktop')) {
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
			vc_gridBehaviour();
			vc_rowBehaviour();
			jQuery(document).trigger('vc_js');
			window.setTimeout(vc_waypoints, 500);
		}
	}
	
	/*** Little trick to make work all elements in Front-End mode of Visual Composer !! ***/
	var isInIframe = (window.location != window.parent.location) ? true : false;
	if (isInIframe === true) {
		$(window).resize(function(e) {
			google_font_loader();
			buttonColor();
			colCalc();	
			activedtab();
			smartTabs();
			iconHover();
			initPieChart();
			pieChartAnim();
			progressBar();
			counter();
			svgFill();
			to_sc_video();
			videoSection();
			videoSectionVimeo();
			colCalc2();	
			typeWriter();
		});
	}

});