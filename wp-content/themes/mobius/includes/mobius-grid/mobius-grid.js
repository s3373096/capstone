jQuery.noConflict();

(function($) {
			
"use strict";

/**********************************************************************************************
CHECK BROWSERS CAPABILITY
***********************************************************************************************/

var smoothScroll = !!('WebkitOverflowScrolling' in document.documentElement.style);
var touchDevice = (Modernizr.touch) ? true : false;
var css3 = (Modernizr.csstransforms3d) ? true : false;
var ua = navigator.userAgent;
if( ua.indexOf("Android") >= 0 ) {
	var androidversion = parseFloat(ua.slice(ua.indexOf("Android")+8)); 
	var android = (androidversion >= 4.0) ? true : false;
	smoothScroll = android;
}
var pre;
function prefix() {
	var styles = window.getComputedStyle(document.documentElement, '');
	pre = '-'+(Array.prototype.slice.call(styles).join('') .match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o']))[1]+'-';
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

smoothScroll = false;

/**********************************************************************************************
SET COMMUN USED VAR
***********************************************************************************************/

var defaults = {
		wrapper : '.to-grid-container',
		slider : '.to-grid-scroll',
		grid : '.to-grid-holder',
		filter : '.option-set',
		filterC : '.option-set .to-grid-filter-title',
		element : '.to-item',
		blog : '.to-item.blog',
		noImage : '.to-item.no-image',
		square : '.to-item.square',
		wide : '.to-item.wide',
		tall : '.to-item.tall',
		pages : '.isotope-pages',
		pageLi : '.isotope-pages li',
		controls : '.controls',
		toggle : '.toggle-view',
		next : '.next-scroll',
		prev : '.prev-scroll',
		load : '.next-container',
		horizontal : 'horizontal',
		vertical : 'vertical',
		Hlayout : true,
		gridType : 'grid',
		colsup: 6,
		col1600 : 5,
		col1280 : 4,
		col1000 : 3,
		col690 : 2,
		rownb : 2,
		ratio : 0.8
	};

var $this,	
	windowSize,	
	sliderSize,	
	sliderBoxed,	
	desktop,	
	colNb,	
	colW,	
	ElementWidth,	
	ElementHeight,	
	gridWidth,	
	itemWidth,	
	items,	
	colsup,	
	col1600,	
	col1280,	
	col1000,	
	col690,	
	rownb,	
	ratio,	
	gridType,
	toItemNav,
	toItemSpeed,
	toswingSpeed,
	trans_isotope = true,
	initSly = false,	
	dragging = false,	
	orientationChange = false,	
	loadNext = false;

if (touchDevice === true) {		
	trans_isotope = false;
}
/**********************************************************************************************
BUILD GRID FUNCTIONS
***********************************************************************************************/

function initializeSly(el) {	
	if (smoothScroll !== true) {
		el.find(defaults.slider).sly({
			horizontal: 1,
			itemNav: 0,
			itemSelector: null,
			smart: 0,
			activateOn: null,
			activateMiddle: 0,
			easing: 'swing',
			swingSpeed: 0.05,
			releaseSwing: 1,
			mouseDragging: 1,
			touchDragging: 1,
			elasticBounds: 1,
			startAt: 0,
			scrollSource: null,
			scrollBy: 0,
			moveBy: colW,
			speed: 1000,
			dragHandle: 1,
			dynamicHandle: 0,
			clickBar: 1,
			syncSpeed: 0.8, 
			keyboardNavBy: 'pages',
			pagesBar: el.find(defaults.pages),
			activatePageOn: 'click',	
			prevPage: el.find(defaults.prev),
			nextPage: el.find(defaults.next)
		});
		initSly = true;	
	}
}

function viewport() {
	var e = window, a = 'inner';
	if (!('innerWidth' in window )) {
		a = 'client';
		e = document.documentElement || document.body;
	}
	return { width : e[ a+'Width' ]};
}
	
function checkWidth(el) {
	
	el.find(defaults.slider).attr('style', 'min-width: auto !important; width: 100%');
	
	windowSize = viewport().width;
	sliderSize = el.find(defaults.slider).width();
	sliderBoxed = el.find(defaults.slider).closest('.section-container').length;
	if (windowSize <= 480) {	
		colNb = 1;
		checkColumnWidth(el);	
		checkElementSize(el);
	}
	if (windowSize > 480 && windowSize <= 690 && sliderBoxed || windowSize > 480 && windowSize <= 690 && gridType === 'masonry') {	
		colNb = 1;
		checkColumnWidth(el);	
		checkElementSize(el);
	} else if (windowSize > 480 && windowSize <= 690 && !sliderBoxed) {
		colNb = 2;
		checkColumnWidth(el);	
		checkElementSize(el);
	}
	if (windowSize > 690 && windowSize <= 1000) {
		colNb = col1000;	
		checkColumnWidth(el);	
		checkElementSize(el);
	}	
	else if (windowSize > 1000 && windowSize <= 1300 ) {
		colNb = col1280;
		checkColumnWidth(el);	
		checkElementSize(el);
	}
	else if (windowSize > 1300 && windowSize <= 1600 ) {
		colNb = col1600;
		checkColumnWidth(el);
		checkElementSize(el);
	}
	else if (windowSize > 1600 ) {
		colNb = colsup;
		checkColumnWidth(el);
		checkElementSize(el);
	}
}
	
function checkColumnWidth(el) {	
	colW = (el.find(defaults.slider).parent().width()/colNb);
	if ((colW <= 235 && sliderBoxed || colW <= 235 && !sliderBoxed && windowSize > 480) && el.data('postsize') != 'square center') {
		colNb = colNb-1;
		colW = Math.floor(sliderSize/colNb);
	}
	if (colW % 1 !== 0) {
		colW = Math.ceil(colW);
	}
	
	if ($('.grid-home-page').length && windowSize > 480) {
		rownb = 3;
		colW = Math.floor(($(window).height()-$('#header-spacer').height()-$('#wpadminbar').height())/(3*ratio));
		if (colW <= 300) {
			rownb = 2;
			colW = Math.floor(($(window).height()-$('#header-spacer').height()-$('#wpadminbar').height())/(2*ratio));
			if (colW <= 300) {
				colW = 300;
			}
		}
		colNb = Math.floor($(window).width()/colW);
	}
	el.find(defaults.slider).attr('style', 'min-width:'+ colW*colNb +'px !important');
}
	
function checkElementSize(el) {
	ElementWidth = colW;
	ElementHeight = Math.floor(colW*ratio);
	if (gridType !== 'masonry') {
		if (windowSize <= 690 && sliderBoxed || windowSize <= 480 && !sliderBoxed) {
			el.find(defaults.grid).find(defaults.blog).addClass('to-item-mobile');
			el.find(defaults.grid).find(defaults.element).height(ElementHeight).width(ElementWidth);
			el.find(defaults.grid).find(defaults.square).height(ElementHeight*2).width(ElementWidth);
			el.find(defaults.grid).find(defaults.square).not('.blog').height(ElementHeight).width(ElementWidth);	
			el.find(defaults.grid).find(defaults.wide).height(ElementHeight).width(ElementWidth);
			el.find(defaults.grid).find(defaults.wide).not('.center, .quote, .portfolio').height(ElementHeight*2).width(ElementWidth);	
			el.find(defaults.grid).find(defaults.tall).height(ElementHeight*2).width(ElementWidth);
			el.find(defaults.grid).find(defaults.noImage).height(ElementHeight).width(ElementWidth);
		} else {
			el.find(defaults.grid).find(defaults.blog).removeClass('to-item-mobile');
			el.find(defaults.grid).find(defaults.element).height(ElementHeight).width(ElementWidth);	
			el.find(defaults.grid).find(defaults.square).height(ElementHeight*2).width(ElementWidth*2);	
			el.find(defaults.grid).find(defaults.wide).height(ElementHeight).width(ElementWidth*2);	
			el.find(defaults.grid).find(defaults.tall).height(ElementHeight*2).width(ElementWidth);
		}
	} else {
		el.find(defaults.grid).find(defaults.element).width(ElementWidth);
	}
	imgslideresize();
}
	
function checkContainerHeight(el) {
	if (el.find(defaults.slider).hasClass(defaults.horizontal)) {
		var gridHeight = ElementHeight*rownb;
		el.find(defaults.slider).add(el.find(defaults.grid)).css({ height: gridHeight, maxHeight: gridHeight});
	}
	if (el.find(defaults.slider).hasClass(defaults.vertical)) {
		el.find(defaults.grid).attr('style', '');
	}
}
	
function checkIsotope(el) {
	if (gridType === 'masonry') {
		el.find(defaults.grid).isotope({
			itemSelector : defaults.element,
			transformsEnabled: false,
			itemPositionDataEnabled: true,
			resizesContainer: true,
			resizable: true,
			masonry: {
				columnWidth: colW
			}
		});
	} else {
		if (el.find(defaults.slider).hasClass(defaults.horizontal)) {
			el.find(defaults.grid).isotope({ 
				layoutMode : 'packery', 
				itemSelector : defaults.element,
				transitionDuration: '0.7s',
				packery: {
					isHorizontal: true,
					columnWidth: colW,
				},
			});
		}
		if (el.find(defaults.slider).hasClass(defaults.vertical)) {
			el.find(defaults.grid).isotope({ 
				layoutMode : 'packery', 
				itemSelector : defaults.element,
				transitionDuration: '0.7s',
				packery: {
					columnWidth: colW
				}
			});
		}
	}
}
	
function checkSly(el) {
	if (el.find(defaults.slider).hasClass(defaults.horizontal)) {
		gridWidth = el.find(defaults.grid).attr('data-isotope-cols')*colW;
		if (gridWidth <= el.find(defaults.slider).width()) {
			gridWidth = el.find(defaults.slider).width();
			el.find(defaults.next).add(el.find(defaults.prev)).css('opacity',0).hide();
		} else {
			el.find(defaults.next).add(el.find(defaults.prev)).css('opacity',1).show();
		}
		el.find(defaults.grid).css({width: gridWidth, minWidth: gridWidth, maxWidth: gridWidth});
		el.find(defaults.slider).sly('reload');
		el.find(defaults.pages).attr('style', 'opacity: 1 !important; max-height: auto');
		slyPages(el);	
	}
}
	
function slyPages(el) {			
	if (smoothScroll === true) {
		el.find(defaults.pages).children().remove();
		var isotopePages = Math.ceil(gridWidth/el.find(defaults.slider).width());
		if (isotopePages > 1) {		
			for (var i=0; i<isotopePages; i++){
				el.find(defaults.pages).append('<li></li>');
			}
			el.find(defaults.pages).children().first().addClass('active');
			el.find(defaults.pages).children().show();
		}
	} else {
		if (el.find(defaults.pages).children().length == 1) {
			el.find(defaults.pages).children().hide();
		} else {
			el.find(defaults.pages).children().show();
		}
	}
}
	
function smartToggle(el) {
	if (gridType !== 'masonry') {
		if (windowSize <= 690 && sliderBoxed || windowSize <= 480 && !sliderBoxed) {
			el.find(defaults.slider).add(el.find(defaults.grid)).removeClass(defaults.horizontal).addClass(defaults.vertical);	
			switchLayout(el);
		} else {
			if (el.find(defaults.slider).hasClass(defaults.vertical) && el.find(defaults.slider).hasClass('toggle') && el.attr('data-hlayout') == 'false' || el.find(defaults.slider).hasClass(defaults.vertical) && !el.find(defaults.slider).hasClass('toggle') && el.attr('data-hlayout') == 'true') {
				el.find(defaults.slider).add(el.find(defaults.grid)).removeClass(defaults.vertical).addClass(defaults.horizontal);
			} 
			switchLayout(el);
		}
	}
}
	
function switchLayout(el) {
	if (el.find(defaults.slider).hasClass(defaults.vertical)) {
		el.find(defaults.prevScroll).add(el.find(defaults.nextScroll)).hide();
		if (smoothScroll !== true && initSly === true) {
			el.find(defaults.slider).sly('toStart', true);
			el.find(defaults.slider).sly(false);		
		}
		if (smoothScroll === true) {
			el.find(defaults.slider).scrollLeft(0);
		}
		checkContainerHeight(el);	
		el.find(defaults.pages).children().remove();
		el.find(defaults.next).add(el.find(defaults.prev)).css('opacity',0).hide();
	}
	if (el.find(defaults.slider).hasClass(defaults.horizontal)) {
		el.find(defaults.prevScroll).add(el.find(defaults.nextScroll)).show();
		checkContainerHeight(el);	
		smoothGrid();
		initializeSly(el);
	}
}
	
function smoothGrid() {	
	if (smoothScroll === true) {
		$(defaults.slider).css('overflow-y', 'scroll');
		if (android !== true) {
			$(defaults.slider).css(pre+'-overflow-scrolling', 'touch');
		}
	}
}

// Add hidden class if item hidden
var itemReveal = Isotope.Item.prototype.reveal;
Isotope.Item.prototype.reveal = function() {
	itemReveal.apply( this, arguments );
	$( this.element ).removeClass('isotope-hidden');
};
var itemHide = Isotope.Item.prototype.hide;
Isotope.Item.prototype.hide = function() {
	itemHide.apply( this, arguments );
	$( this.element ).addClass('isotope-hidden');
}; 
	
function checkLineClamp() {	
	if (gridType !== 'masonry') {
		var clh = parseInt($('.to-item.blog .excerpt').css('line-height'));
		var hlh = parseInt($('.to-item.blog h2').not('.to-item.blog.center h2').css('line-height'));
		$('.to-item.blog').not('.isotope-hidden, .to-item.portfolio, .to-item.blog.quote, .to-item.blog.link, .to-item.blog.center').each( function(){
			var $this = $(this);
			$this.find('h2, .excerpt').attr('style', '');
			$this.find('.to-item-separator, .excerpt').show();
			var hh = $this.find('.to-item-social').position().top - $this.find('.to-item-separator').position().top;
			hh = Math.floor(hh/hlh)*(hlh)-hlh;
			if (hh <= 0) {
				hh = -Math.ceil(hh/hlh);
				hh = $this.find('h2').height()-hh*hlh;
				$this.find('h2').attr('style', 'height: '+hh+'px');
				$this.find('.to-item-separator, .excerpt').hide();
			} else {
				var ch = $this.find('.to-item-social').position().top - $this.find('.excerpt').position().top;
				ch = Math.floor(ch/clh)*(clh)-clh;
				if (ch == 0) {
					$this.find('.to-item-separator, .excerpt').hide();	
				} else {
					$this.find('.excerpt').attr('style', 'height: '+ch+'px');
				}
			}
		});
		$('.to-item.blog.center:visible').not('.isotope-hidden, .to-item.blog.quote, .to-item.blog.link').each( function(){
			var $this = $(this);
			$this.find('h2').attr('style', '');
			var ct = $this.find('.to-item-content').position().top;
			if (ct < 0) {
				var hlh = parseInt($this.find('h2').css('line-height'));
				var h = Math.floor(($this.find('h2').height()+ct)/hlh)*hlh-hlh;
				$this.find('h2').attr('style', 'height: '+h+'px; -webkit-line-clamp: '+h/hlh+'; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical;');
			}
		});
		$('.to-item.blog.quote:visible, .to-item.blog.link:visible').not('.isotope-hidden').each( function(){
			var $this = $(this);
			$this.find('h2').attr('style', '');
			var top;
			var hp = $this.find('h2').position().top;
			var hh = $this.find('h2').height();
			var eb = $this.find('.to-item-quote-author,.to-item-link-from').position().top;
			var et = $this.find('.to-item-content-inner').position().top;
			var hlh = parseInt($this.find('h2').css('line-height'));
			if (hp+hh > eb) {	
				hh = eb - et;
				var h2 = Math.floor(hh/hlh)*(hlh)-hlh;
				top = (hh-h2)/2;
				$this.find('h2').attr('style', 'height:'+h2+'px;top: '+top+'px;-webkit-line-clamp: '+(h2/hlh)+'; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical;');
			} else {
				top = parseInt((eb-et-hh)/2);
				$this.find('h2').attr('style', 'top: '+top+'px');
			}
		});
	}
}

function gridQueries(el) {
	if (windowSize > 690 && sliderBoxed || windowSize > 480 && !sliderBoxed) {
		desktop = true;
	} else if (windowSize <= 690 && sliderBoxed || windowSize <= 480 && !sliderBoxed) {
		desktop = false;
	}
	if (desktop === false && el.attr('data-desktop') === 'true') {
		el.attr('data-desktop', false);
	} else if (desktop === true && el.attr('data-desktop') === 'false') {
		el.attr('data-desktop', true);
	}	
}
	
function resizeGrid(){	
	var curWidth = $(defaults.slider).width();
	$(defaults.wrapper).each( function(){
		$this = $(this);
		iniOptions($this);
		checkWidth($this);	
		smartToggle($this);
		checkIsotope($this);
		checkSly($this);
		gridQueries($this);
		imgslideresize();
	});
}

function ajaxGrid(el){	
	$this = el;	
	iniOptions($this);
	checkWidth($this);
	checkIsotope($this);	
	checkSly($this);	
	imgslide();
}

function countFilter(el) {
	var catArray = [];
	el.each(function() {
		var $this = $(this);
		$this.find(defaults.filterC).each(function() {
            var cat = $(this).data('filter');
			if (cat !== '*') {
				var count = $this.find(defaults.element+'.'+cat).length;
				$(this).find('.to-grid-tooltip').html(count);
				if (count !== 0) {
					$this.find(defaults.filterC+'.all').show();
					$(this).show();
				} else {
					$this.find(defaults.filterC+'.all').hide();
					$(this).hide();
				}
			} else {
				var count = $this.find(defaults.element).length;
				$(this).find('.to-grid-tooltip').html(count);
			}
        });	
    });
}

function iniOptions(el) {
	colsup = el.data('colsup') ? el.data('colsup') : defaults.colsup;
	col1600 = el.data('col1600') ? el.data('col1600') : defaults.col1600;
	col1280 = el.data('col1280') ? el.data('col1280') : defaults.col1280;
	col1000 = el.data('col1000') ? el.data('col1000') : defaults.col1000;
	col690 = el.data('col690') ? el.data('col690') : defaults.col690;
	rownb = el.data('rownb') ? el.data('rownb') : defaults.rownb;
	ratio = el.data('ratio') ? el.data('ratio') : defaults.ratio;
	gridType = el.data('grid-type') ? el.data('grid-type') : defaults.gridType;
}

$.fn.toGrid = function(options) {
	
	options = $.extend(defaults, options);
		
	this.each( function(){	
		$this = $(this);
		if ($this.find(defaults.element).length > 0) {
			iniOptions($this);
			checkWidth($this);	
			smartToggle($this);
			if ($('html').width() != $this.find(defaults.slider).width()) { // inverse (build grid with scrollbar then check if there isn't, will reduce the number of case and reduce the number of calculs.
				checkWidth($this); //recalculate width because of scrollbar appears after sizing the grid!! Avoid layout problem on isotope filter!
				smartToggle($this); //re check toggle in case that affect a lot the size on small screen!
			}
			if (gridType === 'masonry') {
				$this.find('img').imagesLoaded(function (el) {
					$(el.elements).closest(defaults.grid).isotope();
				});
			} else {
				checkIsotope($this);
			}
			checkSly($this);
			if (windowSize > 690 && sliderBoxed || windowSize > 480 && !sliderBoxed) {
				$this.attr('data-desktop', true);
			} else if (windowSize <= 690 && sliderBoxed || windowSize <= 480 && !sliderBoxed) {
				$this.attr('data-desktop', false);
			}
			if ($('.grid-home-page').length) {
				var ajaxButton = $this.find('.next-container').clone();
				$this.find('.next-container').remove();
				$this.find('.to-grid-scroll').append(ajaxButton);
			}
			imgslide();
			countFilter($this);
		} else {
			$this.remove();
		}
	});
	checkLineClamp();
	if (gridType !== 'masonry') {
		$(defaults.grid).isotope( 'on', 'layoutComplete', function() {checkLineClamp();})
	}
	$(defaults.slider).on('scroll', function(){
		if (smoothScroll === true) {
			$this = $(this).closest(defaults.wrapper);
			var myPos = $(this).scrollLeft();
			var isotopePageActive = Math.ceil(myPos/$this.width());
			$this.find(defaults.pages).children().removeClass('active');
			$this.find(defaults.pages).children().eq(isotopePageActive).addClass('active');
		}
	});

	return this;
};

function gridMarginAuto() {
	var top   = parseInt($('.to-item-wrapper').css('top'));
	var right = parseInt($('.to-item-wrapper').css('margin-right'));
	var marg  = Math.max(top,right);
	
	if ($('.blog-page, .portfolio-page').length && marg != 0) {
		$('.to-page-nav').css('padding-left', marg);
	}
	
	if ($('.blog-page .next-container').length) {
		$('.next-container').css('margin-bottom', 70);
	}
	
	if ($('.blog-page > .section-container').length) {
		$('.blog-page').css('padding', '70px 0');
	} else if ($('.blog-page').length) {
		if (!$('.to-grid-filters').length) {
			$('.blog-page').css('padding', marg);
		}
	} 

	if ($('.blog-page > .section-container').length && $('.to-grid-filters').length) {
		$('.blog-page').css('padding', '0 0 70px 0');
		$('.to-grid-filters').css('margin-bottom', 70);
	} else if ($('.blog-page').length && $('.to-grid-filters').length && (marg > 0)) {
		$('.blog-page').css('padding', '0');
		$('.to-grid-filters').css('margin-bottom', marg);
	} 

	if ($('.blog-page > .section-container').length && $('.to-page-nav').length) {
		$('.blog-page').css('padding-bottom', '0');
	}

	if ($('.portfolio-page').length && !$('.to-page-nav').length && $('.to-grid-filters').length && marg != 0) {
		$('.to-grid-filters').css('margin-bottom', 40);
		$('.portfolio-page').css('margin-bottom', 70);
	} else if ($('.portfolio-page').length && $('.to-page-nav').length && $('.to-grid-filters').length && marg != 0) {
		$('.to-grid-filters').css('margin-bottom', 40);
	} else if ($('.portfolio-page').length && !$('.to-page-nav').length && !$('.to-grid-filters').length && marg != 0) {
		$('.portfolio-page').css('padding', '70px 0 70px 0');
	}	
}

function preventSlyLink() {
	var dragSly = false;
	var startMousePosX = -1;
	var currentMousePosX = -1;
	$('.to-grid-holder').on('mousedown', function(e) {
		dragSly = true;
		startMousePosX = Math.abs(e.pageX);	
	});
	$('.to-grid-holder').on('mousemove', function(e) {
		currentMousePosX = Math.abs(e.pageX);
		if (dragSly === true && Math.abs(startMousePosX - currentMousePosX) >  5) {
			$(this).addClass('ondrag');
			e.preventDefault();
			
		}
	});
	$('.to-grid-holder').on('mouseup', function() {
		$(this).removeClass('ondrag');
		dragSly = false;
	});
}

$(document).ready(function(e) {
	gridMarginAuto();
	preventSlyLink();
});

$(window).on('statechangecomplete', function() {
	gridMarginAuto();
	preventSlyLink();
});

$(document).on('mouseenter', '.grid-home-page .to-grid-filters-button', function(e) {
	$(this).closest('.to-grid-filters').css('margin-top',-$(this).closest('.to-grid-filters').outerHeight());
});
$(document).on('mouseleave', '.grid-home-page .to-grid-filters', function(e) {
	$(this).css('margin-top',0);
});


/**********************************************************************************************
FILTER BUTTONS ANIMATIONS
***********************************************************************************************/

var filters = '.to-grid-filters',
	filter = '.to-grid-filter-title',
	filterLine = '.to-filters-line';

function activefilter() {
	$(filters).each(function() {
		var $curfilter = $(this).find(filter+'.actived');
		filterMove($curfilter);
	});
}

$(document).ready(function(e) {
	activefilter();   
});
	
$(document).on( 'mouseover',filter, function() {
	if (!$(this).is('.to-grid-filter-overlay, .to-filters-line')) {
		filterMove($(this));
	}
}).on( 'mouseleave',filter, function() {
	if (!$(this).is('.to-grid-filter-overlay, .to-filters-line')) {
		filterMove($(this).closest(filters).find(filter+'.actived'));
	}
});

function filterMove(el) {
	var index = el.position().left;
	var width = el.outerWidth();
	movingFilter(el.closest('.option-set').find(filterLine),width,index);
}

function movingFilter(el,w,off) {
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

/**********************************************************************************************
SET CLICK TOUCH GRID ACTIONS
***********************************************************************************************/

$(document).on('click', defaults.filterC, function () {	
	$this = $(this).closest(defaults.wrapper);
	$(this).parent().children().removeClass('actived');
	$(this).addClass('actived');
	var selector = '.'+$(this).attr('data-filter').replace(/\s/g,".");
	if (selector == '.*') {
		selector = '*';
	}
	$this.find(defaults.grid).isotope({ 
		filter: selector 
	});
	var curWidth = $this.find(defaults.slider).width();
	iniOptions($this);
	checkWidth($this);			
	checkSly($this);
	if (rownb == 1 && $this.find(defaults.slider).hasClass(defaults.horizontal)) {
		$this.find(defaults.slider).sly('toStart', true);
	}
	return false;	
});

$(document).on('change', '.option-set-mobile', function () {
	var $this = $(this).closest(defaults.wrapper);
	var selector = $(this).val();
	$this.find(defaults.grid).isotope({ 
		filter: selector
	});	
	checkSly($this);
	return false;	
});

$(document).on('touchend', defaults.filterC, function() {
	if ($(window).width() <= 480) {
		setTimeout(function(){
			$(this).closest('.filter-grid-queries').css('display', 'none');
		}, 1050);
	}
});

$(document).on('touchstart', defaults.filter, function() {
	if (!$(this).closest('.filter-grid-queries').is(':visible') && $(window).width() <= 480) {
		$(this).closest('.filter-grid-queries').css('display', 'block');
	}
});

$(document).on('click', defaults.toggle, function() {
	var t = $('#inner-container').scrollTop();
	$this = $(this).closest(defaults.wrapper);
	iniOptions($this);
	if ($this.find(defaults.slider).add($this.find(defaults.grid)).hasClass(defaults.horizontal)) {
		$this.find(defaults.slider).add($this.find(defaults.grid)).removeClass(defaults.horizontal).addClass(defaults.vertical).toggleClass('toggle');
	} else {
		$this.find(defaults.slider).add($this.find(defaults.grid)).removeClass(defaults.vertical).addClass(defaults.horizontal).toggleClass('toggle');
	}
	checkWidth($this);
	switchLayout($this);
	checkIsotope($this);	
	checkSly($this);
	$('#inner-container').scrollTop(t);	
	return false;
});

$(document).on('touchend', defaults.pageLi, function() {
	if (smoothScroll === true) {
			if (!$(this).hasClass('active')) {
			$this = $(this).closest(defaults.wrapper);
			$this.find(defaults.slider).stop();
			$this.find(defaults.pages).children().removeClass('active');
			var selectedSlide = $(this).index();
			var scrollToX = selectedSlide*$this.width();
			$this.find(defaults.slider).animate({scrollLeft: scrollToX}, 700, 'easeOutQuad');
		}
	}
});

$(document).on('touchstart', defaults.next, function(){
	if (smoothScroll === true) {
		$this = $(this).closest(defaults.wrapper);
		var myPos = $this.find(defaults.slider).scrollLeft();
		$this.find(defaults.slider).animate({scrollLeft: myPos+$this.find(defaults.slider).width()}, 700, 'easeOutQuad');
	}
});
	
$(document).on('touchstart', defaults.prev, function(){
	if (smoothScroll === true) {
		$this = $(this).closest(defaults.wrapper);
		var myPos = $this.find(defaults.slider).scrollLeft();
		$this.find(defaults.slider).animate({scrollLeft: myPos-$this.find(defaults.slider).width()}, 700, 'easeOutQuad');
	}
});


/**********************************************************************************************
LOAD NEW GRID ITEM WITH AJAX CALL
***********************************************************************************************/

var type,
	gType,
	postSize,
	portSize,
	portStyle,
	postNb,
	postTt,
	pageNb = 1,
	gutter,
	orderby,
	category,
	$newEls,
	msgNext,
	t;
	
function load_posts(el){
	$.ajax({
		type: 'POST',
		url: wp_ajax.url,
		data: { 
			action: 'mobius_grid', 
			ajax_nonce: wp_ajax.nonce, 
			type: type,
			gridType: gridType,
			postSize: postSize,
			portSize: portSize,
			portStyle: portStyle,
			pageNb: pageNb,
			postNb: postNb,
			gutter: gutter,
			orderby: orderby,
			category: category
		},
		beforeSend : function(){
			msgNext = el.find('span').html();	
			if (!el.closest('.grid-home-page').length) {
				el.find('span').html('').addClass('is-loading');
				el.css({width:'45px', padding:'0'});
				setTimeout(function() {
					if (el.find('span').hasClass('is-loading')) {
						el.addClass('load');
					}
				}, 400);
			}
			t = $(window).scrollTop();
		},
		success : function(data){
			el.find('span').removeClass('is-loading')
			el.removeClass('load');
			setTimeout(function() {
				if (!el.closest('.grid-home-page').length) {
					el.css({width: '185px'});
				}
			}, 400);
			if (data !== 0) {
				$newEls = $(data);
				$newEls.imagesLoaded( function() {
					el.closest(defaults.wrapper).find(defaults.grid).isotope( 'insert', $newEls);
					ajaxGrid(el.closest(defaults.wrapper));
					$('#inner-container').scrollTop(t);
					countFilter(el.closest(defaults.wrapper));
					if ($(data).length < postNb || el.closest(defaults.wrapper).find(defaults.grid).children().length >= postTt){
						el.find('span').html('No more post');
						el.add(el.find('span')).addClass('notransition').delay(2000).animate({borderWidth: 0, height: 0, width: 0, padding: 0, marginTop: 0, marginBottom: 0, opacity: 0, lineHeight: 0, fontSize: 0}, 800);
					} else {
						el.find('span').html(msgNext);
						el.closest(defaults.wrapper).attr('data-pageNb', pageNb);
					}
				});
			} else {
				el.find('span').html('No more post');
				el.addClass('notransition').delay(2000).animate({borderWidth: 0, height: 0, width: 0, padding: 0, marginTop: 0, marginBottom: 0,opacity: 0, lineHeight: 0, fontSize: 0}, 800);
			}
			if ((ie > 9 || !ie) && History.enabled) {
				$('body').ajaxify();
			}
			loadNext = false;
			return false;
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		}
	});
}

$(document).on('click', defaults.load, function() {
	if (loadNext === false) {
		loadNext = true;
		$this     = $(this);
		type      = $this.parents(defaults.wrapper).attr('data-type');
		gridType  = $this.parents(defaults.wrapper).attr('data-grid-type');
		postSize  = $this.parents(defaults.wrapper).attr('data-postSize');
		portSize  = $this.parents(defaults.wrapper).attr('data-portSize');
		portStyle = $this.parents(defaults.wrapper).attr('data-portStyle');
		postNb    = $this.parents(defaults.wrapper).attr('data-postNb');
		postTt    = $this.parents(defaults.wrapper).attr('data-ttposts');
		pageNb    = $this.parents(defaults.wrapper).attr('data-pageNb');
		gutter    = $this.parents(defaults.wrapper).attr('data-gutter');
		orderby   = $this.parents(defaults.wrapper).attr('data-orderby');
		category  = $this.parents(defaults.wrapper).attr('data-category');
		pageNb++;
		load_posts($this);
	}
});

/**********************************************************************************************
INIT THEMEONE GRID ON DOCUMENT READY AND AJAX CALL
***********************************************************************************************/

$(window).on('resize', function(){
	if (touchDevice === false && $(defaults.wrapper).length > 0) {		
		resizeGrid();
	} 
});

$(window).bind('orientationchange', function(){
	if ($(defaults.wrapper).length > 0) {
		resizeGrid();
	}
});

$(document).ready(function() {
	if ($.fn.toGrid && $(defaults.wrapper).length > 0) {
		$(defaults.wrapper).toGrid();  
	}
});

$(window).on('statechangecomplete', function() {
	if ($.fn.toGrid && $(defaults.wrapper).length > 0) {
		$(defaults.wrapper).toGrid();
		activefilter();
	}
});

/**********************************************************************************************
GALLERY GRID RANDOM ANIMATION TIMER
***********************************************************************************************/

var toGallery = '.to-item.portfolio.gallery',
	imgGallery = '.to-img-gallery',
	galleryHolder = '.portfolio .to-item-image',
	arrayGallery = '.portfolio .to-img-gallery.hidden',
	galleryTime = 4000,
	galleryTimer,
	randomGallery;

function checkGallery() {
	$(toGallery).each(function() {
		$(this).find(imgGallery).addClass('hidden');
		$(this).find(imgGallery).first().removeClass('hidden');
	});
}

function shuffle(array) {
  var m = array.length, t, i;
  while (m) {
    i = Math.floor(Math.random() * m--);
    t = array[m];
    array[m] = array[i];
    array[i] = t;
  }
  return array;
}

function galleryAnim() {
	randomGallery = shuffle($(arrayGallery)).slice(0,1);
	var curGallery = randomGallery.closest(galleryHolder).find(imgGallery);
	curGallery.addClass('hidden');
	randomGallery.removeClass('hidden');
}

function galleryGridInit() {
	if ($(toGallery).length) {
		checkGallery();
		setTimeout(function () {
			galleryTimer = setInterval(function () {
				galleryAnim();
			}, galleryTime);
		}, galleryTime);
	}
}

$(document).ready(function() {
	galleryGridInit();  
});

$(window).on('statechange', function() {
	clearInterval(galleryTimer);
	galleryTimer = null;
});

$(window).on('statechangecomplete', function() {
	galleryGridInit();
	$(toGallery).each(function(index, element) {
		var $this = $(this);
		if ($this.find(imgGallery).first().hasClass('hidden')) {
			$this.find(imgGallery).first().removeClass('hidden');
		}
	});
});

function imgslide(){
	$('.to-item.blog .to-item-image').each(function() {
		var slidenb = $(this).find('img, .to-img-gallery').length;
		if (slidenb >= 2 && !$(this).find('.to-item-image-slider').length) {
			var cat = $(this).find('.to-item-cat-holder').clone();
			$(this).find('.to-item-cat-holder').remove();
			$(this).find('img').removeClass('to-item-img');
			$(this).not('span').wrapInner('<ul class="to-item-image-slider" data-slide-nb="'+slidenb+'" data-slide-index="0"></ul>');
			$(this).find('img, .to-img-gallery').wrap('<li class="to-item-image-slide"></li>');
			$(this).append('<ul class="to-item-image-pages"></ul>');
			$(this).append(cat);
			if ((ie > 9 || !ie) && History.enabled) {
				$(document.body).ajaxify();
			}
			for (var i = 0; i < slidenb; i++ ) {
				if (i === 0) {
					$(this).find('.to-item-image-pages').append('<li class="to-item-image-page active"></li>');
				} else {
					$(this).find('.to-item-image-pages').append('<li class="to-item-image-page"></li>');
				}
			}
			var hammerSlider = new Hammer($(this).find('.to-item-image-slider'), { drag_lock_to_axis: true }).on('release dragup dragdown swipeup swipedown', itemSlider);
		}
	});	
	imgslideresize();
}

function imgslideresize() {
	$('.to-item-image-slider:visible').each(function() {
		var $pagesTop = $(this).closest('.to-item-image').find('.to-item-image-pages');
		$pagesTop.css('margin-top',-$pagesTop.outerHeight()/2);
		if ($(this).closest('.to-grid-container').data('grid-type') != 'masonry') {
			$(this).find('.to-item-image-slide').height($(this).closest('.to-item-image').outerHeight());
			$(this).find('.to-item-image-slide').width($(this).closest('.to-item-image').outerWidth());
		} else {
			var width = $(this).closest('.to-item-wrapper').width();
			$(this).closest('.to-item-image').height(width*3/4);
			$(this).closest('.to-item-image').width(width);
			$(this).find('.to-item-image-slide').height(width*3/4);
			$(this).find('.to-item-image-slide').width(width);
		}
	});
}

var percent,
	current_slide,
	slide_count,
	newSlide;
	
function itemSlider(ev) {
	ev.gesture.preventDefault();
	var $this = $(ev.currentTarget);
	current_slide = $this.data('slide-index');
	slide_count   = $this.data('slide-nb');
	switch(ev.type) {
		case 'dragdown':
		case 'dragup':
			$this.addClass('dragged');
			var slide_height = $this.find('.to-item-image-slide').height();
			var pane_offset  = -(100/slide_count)*current_slide;
			var drag_offset  = ((100/slide_height)*ev.gesture.deltaY) / slide_count;
			percent = drag_offset+pane_offset;
			if (percent > 0 || percent < -(slide_count-1)/(slide_count)*100) {
				percent = drag_offset*0.3+pane_offset;
			}
			slideTransform($this,percent);
		break;
		case 'swipeup':
			newSlide = current_slide+1;
			nextSlide($this,newSlide,slide_count);
			ev.gesture.stopDetect();
			break;
		case 'swipedown':
			newSlide = current_slide-1;
			nextSlide($this,newSlide,slide_count);
			ev.gesture.stopDetect();
			break;
		case 'release':
			$this.removeClass('dragged');
			if(Math.abs(ev.gesture.deltaY) > $this.find('.to-item-image-slide').height()/2.5) {
				if(ev.gesture.direction == 'up') {
					newSlide = current_slide+1;
					nextSlide($this,newSlide,slide_count);
					ev.gesture.stopDetect();
				} else {
					newSlide = current_slide-1;
					nextSlide($this,newSlide,slide_count);
					ev.gesture.stopDetect();
				}
			} else {
				newSlide = current_slide;
				percent = -(current_slide)/slide_count*100;
				slideTransform($this,percent);
			}
			$this.data('slide-index',newSlide);
		break;
	}
}

function nextSlide($el,newSlide,slide_count) {
	if (newSlide < 0) {
		newSlide = newSlide+1;
	} else if (newSlide > slide_count-1) {
		newSlide = newSlide-1;
	}
	var percent = -(newSlide)/slide_count*100;
	$el.removeClass('dragged');
	$el.closest('.to-item-image').find('.to-item-image-pages li').removeClass('active');
	$el.closest('.to-item-image').find('.to-item-image-pages li').eq(newSlide).addClass('active');
	$el.data('slide-index',newSlide);
	slideTransform($el,percent);
}

function slideTransform($el,x) {
	if (Modernizr.csstransforms) {
		$el.css({
		  '-webkit-transform' : 'translateY('+x+'%)',
		  '-moz-transform'    : 'translateY('+x+'%)',
		  '-ms-transform'     : 'translateY('+x+'%)',
		  '-o-transform'      : 'translateY('+x+'%)',
		  'transform'         : 'translateY('+x+'%)'
		});
	} else {
		$el.css('top',x+'%');
	}
}

$(document).on('click', function(e) {
	if (!$(e.target).attr('class')) {
      return;
    }
	if ($(e.target).attr('class').indexOf('to-item-image-page') === 0) {
		$this = $(e.target).closest('.to-item-image').find('.to-item-image-slider');
		var current_slide = $(e.target).index();
		var slide_count   = $this.data('slide-nb');
		var percent       = -(current_slide)/slide_count*100;
		$this.data('slide-index',current_slide);
		$this.closest('.to-item-image').find('.to-item-image-pages li').removeClass('active');
		$this.closest('.to-item-image').find('.to-item-image-pages li').eq(current_slide).addClass('active');
		slideTransform($this,percent);
	}
});

})(jQuery);