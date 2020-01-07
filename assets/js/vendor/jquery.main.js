function boxSnatch() {
	$('.image-frame img').each(function(i, item) {
		var img_height = $(item).height();
		//var div_height = $(item).parent().height();
		var div_height = $(item).parents('.box').height();
		if(img_height<div_height){
			//INCREASE HEIGHT OF IMAGE TO MATCH CONTAINER
			$(item).css({'width': 'auto', 'height': div_height });
			//GET THE NEW WIDTH AFTER RESIZE
			var img_width = $(item).width();
			//GET THE PARENT WIDTH
			var div_width = $(item).parent().width();
			//GET THE NEW HORIZONTAL MARGIN
			var newMargin = (div_width-img_width)/2+'px';
			//SET THE NEW HORIZONTAL MARGIN (EXCESS IMAGE WIDTH IS CROPPED)
			$(item).css({'margin-left': newMargin });
		}else{
			//CENTER IT VERTICALLY (EXCESS IMAGE HEIGHT IS CROPPED)
			//var newMargin = (div_height-img_height)/2+'px';
			//$(item).css({'margin-top': newMargin});
		}
	});
}


// page init
jQuery(function($){

	// Interactive Map - add new title for Visitor Venues
	$('a[data="MBlockDebate"]').parent().prepend('<br /><h3>Visitor Venues</h3>');

	//new
	/* ------------------
		Homepage Video
	------------------ */
	var videoContent = $('.intro_video').html();

	$('div.img_container').click(function(e) {
	    e.preventDefault();
	    var videoId = $(this).next('div.intro_video').attr("data-video-id");
	  	$(this).replaceWith('<div class="video-wrapper"><iframe src="https://player.vimeo.com/video/'+ videoId +'?autoplay=1&color=ffffff&title=0&byline=0&portrait=0" width="880" height="495" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>');
	});


if ($(".onecolumn .post-content .gallery").length > 0){
  contentHeight = $(".onecolumn .post-content").height();
  $(".onecolumn .post-content .gallery").css("height",contentHeight+"px");
}

if ($("#nav > ul").find(".nav_home_icon").length == 0){
  $("#nav > ul").prepend("<li><a class='nav_home_icon'><i class='fa fa-home'></i></a></li>");
  $("#nav > ul").append("<li><a class='nav_search_icon'><i class='fa fa-search'></i></a></li>");
}


$("#nav .nav_home_icon").on("click", function(){
  homeURL = $("#header .logo a").attr("href");
  window.location = homeURL;
});

$("#nav_search .submit_search").on("click", function(){
  $("#nav_search form").submit();
});

$("#nav .nav_search_icon").on("click", function(){
  $("#nav_search").slideDown(600);
});

$("#nav_search .close_search").on("click", function(){
  $("#nav_search").slideUp(400);
});

var lastScrollTop = 0;
var headerStatus = "DOWN";

$(window).scroll(function(event){
  var bWidth = $('body').width();
  var st = $(this).scrollTop();
  if (st > 0){
    // make the header smaller
    if (st > lastScrollTop){
      // downscroll code
      if (st < 54){
        // shrink the header until it gets down to 80px
        //$("#header div.header-holder div.header-frame div.logo a").css("height",(94-st)+"px");
        $("#header div.header-holder div.header-frame div.logo a img").css({
          height: (94-st)+"px",
          opacity: 1-(st/54)
        });
        //$("#main").css("paddingTop",(134-st)+"px");
        if (bWidth > 1024) {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight",(134-st)+"px");
        }
        else {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","21px");
        }
      } else {
        $("#header div.header-holder div.header-frame div.logo a").css("height","40px");
        $("#header div.header-holder div.header-frame div.logo a img").css({
          height: "40px",
          opacity: 0
        });
        //$("#main").css("paddingTop","80px");
        if (bWidth > 1024) {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","80px");
        }
        else {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","21px");
        }
      }
      if (st > 400){
        // slide the header out of view
        if (animating == false){
					//$("#header").slideUp(400);
        }
      }
    } else {
      // upscroll code
      // slide the header into view
      if (st < 54){
        // shrink the header until it gets down to 80px
        $("#header div.header-holder div.header-frame div.logo a").css("height",(94-st)+"px");
        $("#header div.header-holder div.header-frame div.logo a img").css({
          height: (94-st)+"px",
          opacity: 1-(st/54)
        });
        //$("#main").css("paddingTop",(134-st)+"px");
        if (bWidth > 1024) {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight",(134-st)+"px");
        }
        else {
          $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","21px");
        }
      } else {
        if (animating == false){
					//$("#header").slideDown(100);
        }
      }
    }
  } else {
    // return the header to full view
    $("#header div.header-holder div.header-frame div.logo a").css("height","94px");
    $("#header div.header-holder div.header-frame div.logo a img").css({
      opacity: 1,
      height: '94px'
    });
    //$("#main").css("paddingTop","134px");
    if (bWidth > 1024) {
      $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","134px");
    }
    else {
      $("#header div.header-holder div.header-frame div.nav-block #nav ul li").css("lineHeight","21px");
    }
  }
  lastScrollTop = st;
});

$(document).on('hover', '#fancybox-content .gallery-icon a', function(){
  $('#fancybox-content .gallery-icon a').unbind('click.fb');
  $(this).css('cursor','default');
});
$(document).on('click', '#fancybox-content .gallery-icon a', function(e){
  e.preventDefault();
});

$('.news_panel .np_more').on('click', function(e){
  e.preventDefault();
  var myData = $(this).parent("a").attr("href") + ' #news_content';
//  console.log(myData);
  $('#temp').load(myData, function(){
    var temp = $('#temp').html();
    $.fancybox(
      temp,
      {
      autoSize	    : true,
      autoScale     : true,
      maxWidth	    : 1000,
      maxHeight	    : 800,
      fitToView	    : false,
      width		    : '80%',
      height		: '70%'
    });
  });
});
//$(".news_panel").fancybox({
//  maxWidth	: 1000,
//  maxHeight	: 800,
//  fitToView	: false,
//  width		: '80%',
//  height		: '80%',
//  autoSize	: false,
//  closeClick	: false,
//  openEffect	: 'none',
//  closeEffect	: 'none'
//});

  //slideshow
  $('ul.bxslider').bxSlider({
      mode: 'fade',
      auto: true,
      pause: 7000
  });
	/*
    jQuery(window).on('resize', function() {
      var bWidth = $('body').width();
      if (bWidth < 1024){
        if (!$("#nav").hasClass("js-slide-hidden")){
          initOpenClose();
        }
      }
    });
	*/

	//initOpenClose();
	jQuery('input, textarea').placeholder();
	initSlideBoxes();

	$('#header, #footer').bind('mouseover', function() {
		var activeClass = 'active';
		var animSpeed = 400;
		jQuery('.features-holder').each(function(){
			var wrap = jQuery(this);
			var boxes = wrap.find('.box');
			var news = wrap.find('#news');
			var world = wrap.find('#world');
			var motivating = wrap.find('#motivating');

			motivating.find(".scroll-pane").mCustomScrollbar("disable");
			world.find(".scroll-pane").mCustomScrollbar("disable");
			news.find(".scroll-pane").mCustomScrollbar("disable");

			motivating.find('.thumbs').fadeOut(animSpeed);
			world.find('.thumbs').fadeOut(animSpeed);
			news.find('.thumbs').fadeOut(animSpeed);

			boxes.removeClass(activeClass);
			wrap.find('.block').css({'margin':'0'});
			news.stop(true).animate({'width':'33.83%'}, animSpeed, 'swing');
			world.stop(true).animate({'width':'33.83%'}, animSpeed, 'swing');
			motivating.stop(true).animate({'width':'auto'}, animSpeed, 'swing');
			//news.width('33.83%');
			//world.width('24.83%');
			//motivating.width('auto');
		});
	});
	//Replaced with fancybox
	/*
	var bWidth = $('body').width();
	if(bWidth > 1024) {
		jQuery('.onclick-popupx').bind('click', function(e) {
			e.preventDefault();
			var parent = $(this).parent();
			$('.notices .slide-popup').remove();
			var slideContent = $(this).siblings('.slide').html();
			//get width of #content
			var popupWidth = $('#content').width();
			var containerWidth = $('#main .container').width();
			var twocolumnsWidth = $('#main .twocolumns').width();
			//sidebar
			var sidebarWidth = $('#sidebar').width();
			// space between content areas
			var variableSpace = containerWidth - (twocolumnsWidth + sidebarWidth);

			popupWidth = popupWidth + variableSpace;
			popupWidth = popupWidth - 26;
			sidebarWidth = sidebarWidth + 2;
			parent.append('<div class="slide-popup" style="width:'+popupWidth+'px;left:'+sidebarWidth+'px;"><div class="slide-popup-close"></div><div class="slide-popup-inner">'+slideContent+'</div></div>');
			$('.slide-popup', parent).fadeIn(400, function() {
				jQuery(".slide-popup-inner").mCustomScrollbar({
					scrollButtons:{
						enable:false
					},
					scrollInertia:0
				});
				$('.slide-popup .slide-popup-close').bind('click', function() {$('.notices .slide-popup').remove();});
      	$('.slide-popup-inner a.print').click(function(e){
      	  window.print();
        	e.preventDefault();
      	});
			});

		});
	} else {
		initOpenClose();
	}*/
});

function initSlideBoxes() {
	var activeClass = 'active';
	var animSpeed = 400;
	jQuery('.features-holder').each(function(){
		var wrap = jQuery(this);
		var boxes = wrap.find('.box');
		var news = wrap.find('#news');
		var world = wrap.find('#world');
		var motivating = wrap.find('#motivating');
		var slideActive = false;

		function boxesHeight(){
			var w1Height;
			var headerHeight = $('#header').height() + 8;
			var footerHeight = $('#footer').height();
			var fat = headerHeight + footerHeight;
			var wHeight = $('body').height();
			w1Height = wHeight - fat;

			boxes.each(function(){
				var box = jQuery(this);
				box.css({
					//height: parseFloat(Math.max(news.innerWidth(),world.innerWidth(), motivating.innerWidth())) + 5
					height: parseFloat(w1Height)
				});
				motivating.css({
					height: news.height()
				})
			});
		}

		boxesHeight();

		jQuery(window).on('resize', function() { boxesHeight(); });

		news.bind('mouseover', function(e){
			if(!news.hasClass(activeClass)){
				showHideMargin('news');
				var bodyWidth = $('body').width();
				var worldWidth = world.width();
				var newsWidth = news.width();
				var motivatingWidth = motivating.width();

				if(slideActive) {
					worldWidth = bodyWidth * 0.3383;
					newsWidth = bodyWidth * 0.3383;
					motivatingWidth = bodyWidth * 0.3234;
				}
				worldWidth = worldWidth - 126;
				newsWidth = newsWidth + 252;
				motivatingWidth = motivatingWidth - 126;

				slideActive = true;

				world.find('.btn-holder').css('z-index', '999');
				world.find('.thumbs_wrapper2').css('z-index', '995');
				motivating.find('.btn-holder').css('z-index', '999');
				motivating.find('.thumbs_wrapper2').css('z-index', '995');
				news.find('.btn-holder').css('z-index', '995');
				news.find('.thumbs_wrapper2').css('z-index', '999');

				motivating.find(".scroll-pane").mCustomScrollbar("disable");
				world.find(".scroll-pane").mCustomScrollbar("disable");

				e.preventDefault();
				boxes.removeClass(activeClass);
				news.addClass(activeClass);
				motivating.find('.thumbs').fadeOut(animSpeed);
				world.find('.thumbs').fadeOut(animSpeed);
				news.stop(true).animate({'width':newsWidth+'px'}, animSpeed, 'swing', function(){ news.find('.thumbs').fadeIn(animSpeed, function() {
						news.find(".scroll-pane").mCustomScrollbar("update");
						news.find(".scroll-pane").mCustomScrollbar("scrollTo","bottom",{
							scrollInertia:20000
						});
						news.find('.mCSB_scrollTools').css('display', 'block');

				}); });
				world.stop(true).animate({'width':worldWidth+'px'}, animSpeed, 'swing');
			}
		});

		world.bind('mouseover', function(e){
			if(!world.hasClass(activeClass)){
				showHideMargin('world');
				var bodyWidth = $('body').width();
				var worldWidth = world.width();
				var newsWidth = news.width();
				var motivatingWidth = motivating.width();

				if(slideActive) {
					worldWidth = bodyWidth * 0.3383;
					newsWidth = bodyWidth * 0.3383;
					motivatingWidth = bodyWidth * 0.3234;
				}

				worldWidth = worldWidth + 252;
				newsWidth = newsWidth - 126;
				motivatingWidth = motivatingWidth - 126;

				slideActive = true;

				world.find('.btn-holder').css('z-index', '995');
				world.find('.thumbs_wrapper2').css('z-index', '999');
				motivating.find('.btn-holder').css('z-index', '999');
				motivating.find('.thumbs_wrapper2').css('z-index', '995');
				news.find('.btn-holder').css('z-index', '999');
				news.find('.thumbs_wrapper2').css('z-index', '995');

				motivating.find(".scroll-pane").mCustomScrollbar("disable");
				news.find(".scroll-pane").mCustomScrollbar("disable");

				e.preventDefault();
				boxes.removeClass(activeClass);
				world.addClass(activeClass);
				news.find('.thumbs').fadeOut(animSpeed);
				motivating.find('.thumbs').fadeOut(animSpeed);
				news.stop(true).animate({'width':newsWidth+'px'}, animSpeed, 'swing',  function(){ world.find('.thumbs').fadeIn(animSpeed, function(){
						//

						world.find(".scroll-pane").mCustomScrollbar("update");
						world.find(".scroll-pane").mCustomScrollbar("scrollTo","bottom",{
							scrollInertia:17000
						});

				})});
				world.stop(true).animate({'width':worldWidth+'px'}, animSpeed, 'swing');
			}
		})
		motivating.bind('mouseover', function(e){
			if(!motivating.hasClass(activeClass)){
				showHideMargin('motivating');
				var bodyWidth = $('body').width();
				var worldWidth = world.width();
				var newsWidth = news.width();
				var motivatingWidth = motivating.width();

				if(slideActive) {
					worldWidth = bodyWidth * 0.3383;
					newsWidth = bodyWidth * 0.3383;
					motivatingWidth = bodyWidth * 0.3234;
				}

				worldWidth = worldWidth - 126;
				newsWidth = newsWidth - 126;
				motivatingWidth = motivatingWidth + 252;

				slideActive = true;

				world.find('.btn-holder').css('z-index', '999');
				world.find('.thumbs_wrapper2').css('z-index', '995');
				motivating.find('.btn-holder').css('z-index', '995');
				motivating.find('.thumbs_wrapper2').css('z-index', '999');
				news.find('.btn-holder').css('z-index', '999');
				news.find('.thumbs_wrapper2').css('z-index', '995');

				world.find(".scroll-pane").mCustomScrollbar("disable");
				news.find(".scroll-pane").mCustomScrollbar("disable");

				e.preventDefault();
				boxes.removeClass(activeClass);
				motivating.addClass(activeClass);
				news.find('.thumbs').fadeOut(animSpeed);
				world.find('.thumbs').fadeOut(animSpeed);
				world.stop(true).animate({'width':worldWidth+'px'}, animSpeed, 'swing',  function(){
					motivating.find('.thumbs').fadeIn(animSpeed, function(){
						motivating.find(".scroll-pane").mCustomScrollbar("update");
						motivating.find(".scroll-pane").mCustomScrollbar("scrollTo","bottom",{
							scrollInertia:26000
						});

				})});
				news.stop(true).animate({'width':newsWidth+'px'}, animSpeed, 'swing');
			}
		})

	})

	boxSnatch();
}

function showHideMargin(id) {
	$('.features-holder .box .block').css({'margin':'0px'});
	$('#'+id+' .block').css({'margin-right': '332px'});
}

// open-close init
function initOpenClose() {
	jQuery('div.nav-block').openClose({
		hideOnClickOutside: true,
		activeClass: 'active',
		opener: '.opener',
		//slider: '#nav',
		animSpeed: 400,
		effect: 'slide'
	});
	jQuery('.notices li').openClose({
		activeClass: 'active',
		opener: '.opener',
		slider: '.slide',
		animSpeed: 400,
		effect: 'slide'
	});
}

/*
 * jQuery Open/Close plugin
 */
;(function($) {
	function OpenClose(options) {
		this.options = $.extend({
			addClassBeforeAnimation: true,
			hideOnClickOutside: false,
			activeClass:'active',
			opener:'.opener',
			slider:'.slide',
			animSpeed: 400,
			effect:'fade',
			event:'click'
		}, options);
		this.init();
	}
	OpenClose.prototype = {
		init: function() {
			if(this.options.holder) {
				this.findElements();
				this.attachEvents();
				this.makeCallback('onInit');
			}
		},
		findElements: function() {
			this.holder = $(this.options.holder);
			this.opener = this.holder.find(this.options.opener);
			this.slider = this.holder.find(this.options.slider);
		},
		attachEvents: function() {
			// add handler
			var self = this;
			this.eventHandler = function(e) {
				e.preventDefault();
				if (self.slider.hasClass(slideHiddenClass)) {
					self.showSlide();
				} else {
					self.hideSlide();
				}
			};
			self.opener.bind(self.options.event, this.eventHandler);

			// hover mode handler
			if(self.options.event === 'over') {
				self.opener.bind('mouseenter', function() {
					self.showSlide();
				});
				self.holder.bind('mouseleave', function() {
					self.hideSlide();
				});
			}

			// outside click handler
			self.outsideClickHandler = function(e) {
				if(self.options.hideOnClickOutside) {
					var target = $(e.target);
					if (!target.is(self.holder) && !target.closest(self.holder).length) {
						self.hideSlide();
					}
				}
			};

			// set initial styles
			if (this.holder.hasClass(this.options.activeClass)) {
				$(document).bind('click touchstart', self.outsideClickHandler);
			} else {
				this.slider.addClass(slideHiddenClass);
			}
		},
		showSlide: function() {
			var self = this;
			if (self.options.addClassBeforeAnimation) {
				self.holder.addClass(self.options.activeClass);
			}
			self.slider.removeClass(slideHiddenClass);
			$(document).bind('click touchstart', self.outsideClickHandler);

			self.makeCallback('animStart', true);
			toggleEffects[self.options.effect].show({
				box: self.slider,
				speed: self.options.animSpeed,
				complete: function() {
					if (!self.options.addClassBeforeAnimation) {
						self.holder.addClass(self.options.activeClass);
					}
					self.makeCallback('animEnd', true);
				}
			});
		},
		hideSlide: function() {
			var self = this;
			if (self.options.addClassBeforeAnimation) {
				self.holder.removeClass(self.options.activeClass);
			}
			$(document).unbind('click touchstart', self.outsideClickHandler);

			self.makeCallback('animStart', false);
			toggleEffects[self.options.effect].hide({
				box: self.slider,
				speed: self.options.animSpeed,
				complete: function() {
					if (!self.options.addClassBeforeAnimation) {
						self.holder.removeClass(self.options.activeClass);
					}
					self.slider.addClass(slideHiddenClass);
					self.makeCallback('animEnd', false);
				}
			});
		},
		destroy: function() {
			this.slider.removeClass(slideHiddenClass).css({display:''});
			this.opener.unbind(this.options.event, this.eventHandler);
			this.holder.removeClass(this.options.activeClass).removeData('OpenClose');
			$(document).unbind('click touchstart', this.outsideClickHandler);
		},
		makeCallback: function(name) {
			if(typeof this.options[name] === 'function') {
				var args = Array.prototype.slice.call(arguments);
				args.shift();
				this.options[name].apply(this, args);
			}
		}
	};

	// add stylesheet for slide on DOMReady
	var slideHiddenClass = 'js-slide-hidden';
	$(function() {
		var tabStyleSheet = $('<style type="text/css">')[0];
		var tabStyleRule = '.' + slideHiddenClass;
		tabStyleRule += '{position:absolute !important;left:-9999px !important;top:-9999px !important;display:block !important}';
		if (tabStyleSheet.styleSheet) {
			tabStyleSheet.styleSheet.cssText = tabStyleRule;
		} else {
			tabStyleSheet.appendChild(document.createTextNode(tabStyleRule));
		}
		$('head').append(tabStyleSheet);
	});

	// animation effects
	var toggleEffects = {
		slide: {
			show: function(o) {
				o.box.stop(true).hide().slideDown(o.speed, o.complete);
			},
			hide: function(o) {
				o.box.stop(true).slideUp(o.speed, o.complete);
			}
		},
		fade: {
			show: function(o) {
				o.box.stop(true).hide().fadeIn(o.speed, o.complete);
			},
			hide: function(o) {
				o.box.stop(true).fadeOut(o.speed, o.complete);
			}
		},
		none: {
			show: function(o) {
				o.box.hide().show(0, o.complete);
			},
			hide: function(o) {
				o.box.hide(0, o.complete);
			}
		}
	};

	// jQuery plugin interface
	$.fn.openClose = function(opt) {
		return this.each(function() {
			jQuery(this).data('OpenClose', new OpenClose($.extend(opt, {holder: this})));
		});
	};
}(jQuery));

/*! http://mths.be/placeholder v2.0.6 by @mathias */
;(function(window, document, $) {

	var isInputSupported = 'placeholder' in document.createElement('input'),
	    isTextareaSupported = 'placeholder' in document.createElement('textarea'),
	    prototype = $.fn,
	    valHooks = $.valHooks,
	    hooks,
	    placeholder;
	if(navigator.userAgent.indexOf('Opera/') != -1) {
		isInputSupported = isTextareaSupported = false;
	}
	if (isInputSupported && isTextareaSupported) {

		placeholder = prototype.placeholder = function() {
			return this;
		};

		placeholder.input = placeholder.textarea = true;

	} else {

		placeholder = prototype.placeholder = function() {
			var $this = this;
			$this
				.filter((isInputSupported ? 'textarea' : ':input') + '[placeholder]')
				.not('.placeholder')
				.bind({
					'focus.placeholder': clearPlaceholder,
					'blur.placeholder': setPlaceholder
				})
				.data('placeholder-enabled', true)
				.trigger('blur.placeholder');
			return $this;
		};

		placeholder.input = isInputSupported;
		placeholder.textarea = isTextareaSupported;

		hooks = {
			'get': function(element) {
				var $element = $(element);
				return $element.data('placeholder-enabled') && $element.hasClass('placeholder') ? '' : element.value;
			},
			'set': function(element, value) {
				var $element = $(element);
				if (!$element.data('placeholder-enabled')) {
					return element.value = value;
				}
				if (value == '') {
					element.value = value;
					// Issue #56: Setting the placeholder causes problems if the element continues to have focus.
					if (element != document.activeElement) {
						// We can’t use `triggerHandler` here because of dummy text/password inputs :(
						setPlaceholder.call(element);
					}
				} else if ($element.hasClass('placeholder')) {
					clearPlaceholder.call(element, true, value) || (element.value = value);
				} else {
					element.value = value;
				}
				// `set` can not return `undefined`; see http://jsapi.info/jquery/1.7.1/val#L2363
				return $element;
			}
		};

		isInputSupported || (valHooks.input = hooks);
		isTextareaSupported || (valHooks.textarea = hooks);

		$(function() {
			// Look for forms
			$(document).delegate('form', 'submit.placeholder', function() {
				// Clear the placeholder values so they don’t get submitted
				var $inputs = $('.placeholder', this).each(clearPlaceholder);
				setTimeout(function() {
					$inputs.each(setPlaceholder);
				}, 10);
			});
		});

		// Clear placeholder values upon page reload
		$(window).bind('beforeunload.placeholder', function() {
			$('.placeholder').each(function() {
				this.value = '';
			});
		});

	}

	function args(elem) {
		// Return an object of element attributes
		var newAttrs = {},
		    rinlinejQuery = /^jQuery\d+$/;
		$.each(elem.attributes, function(i, attr) {
			if (attr.specified && !rinlinejQuery.test(attr.name)) {
				newAttrs[attr.name] = attr.value;
			}
		});
		return newAttrs;
	}

	function clearPlaceholder(event, value) {
		var input = this,
		    $input = $(input),
		    hadFocus;
		if (input.value == $input.attr('placeholder') && $input.hasClass('placeholder')) {
			hadFocus = input == document.activeElement;
			if ($input.data('placeholder-password')) {
				$input = $input.hide().next().show().attr('id', $input.removeAttr('id').data('placeholder-id'));
				// If `clearPlaceholder` was called from `$.valHooks.input.set`
				if (event === true) {
					return $input[0].value = value;
				}
				$input.focus();
			} else {
				input.value = '';
				$input.removeClass('placeholder');
			}
			hadFocus && input.select();
		}
	}

	function setPlaceholder() {
		var $replacement,
		    input = this,
		    $input = $(input),
		    $origInput = $input,
		    id = this.id;
		if (input.value == '') {
			if (input.type == 'password') {
				if (!$input.data('placeholder-textinput')) {
					try {
						$replacement = $input.clone().attr({ 'type': 'text' });
					} catch(e) {
						$replacement = $('<input>').attr($.extend(args(this), { 'type': 'text' }));
					}
					$replacement
						.removeAttr('name')
						.data({
							'placeholder-password': true,
							'placeholder-id': id
						})
						.bind('focus.placeholder', clearPlaceholder);
					$input
						.data({
							'placeholder-textinput': $replacement,
							'placeholder-id': id
						})
						.before($replacement);
				}
				$input = $input.removeAttr('id').hide().prev().attr('id', id).show();
				// Note: `$input[0] != input` now!
			}
			$input.addClass('placeholder');
			$input[0].value = $input.attr('placeholder');
		} else {
			$input.removeClass('placeholder');
		}
	}

}(this, document, jQuery));

jQuery(function($) {
	$('#decrease-text').bind('click', function() {
		var fontSize = parseInt($(".intro-box, .twocolumns article").css("font-size"));
		var lineHeight = parseInt($(".intro-box, .twocolumns article").css("line-height"));

		if(fontSize!=10) fontSize -= 1;
		fontSize = fontSize + "px";
		$(".intro-box, .twocolumns article").css({'font-size':fontSize});

		if(lineHeight!=11) lineHeight -= 1;
		lineHeight = lineHeight + "px";
		$(".intro-box, .twocolumns article").css({'line-height':lineHeight});
	});
	$('#increase-text').bind('click', function() {
		var fontSize = parseInt($(".intro-box, .twocolumns article").css("font-size"));
		var lineHeight = parseInt($(".intro-box, .twocolumns article").css("line-height"));

		if(fontSize!=28) fontSize += 1;
		fontSize = fontSize + "px";
		$(".intro-box, .twocolumns article").css({'font-size':fontSize});

		if(lineHeight!=29) lineHeight += 1;
		lineHeight = lineHeight + "px";
		$(".intro-box, .twocolumns article").css({'line-height':lineHeight});
	});
});

jQuery('document').ready(function($) {
	if ($('body').hasClass('search-results')) {
  	$('.search-notice').each(function(){
    	var $this = $(this);

    	$('.notice-read-more', $this).click(function(e) {
      	if ($this.hasClass('open')) {
        	$('.search-notice-content', $this).hide();
        	$this.removeClass('open');
      	}
      	else {
        	$('.search-notice-content', $this).show();
        	$this.addClass('open');
      	}
    	});
  	});
	}

	move_translate();

	$('.sub-items').addClass('load');
	$('.bx-wrapper').addClass('load');

});

var move_translate = function() {
  setTimeout(function(){
  	$('#WidgetFloaterPanels').appendTo('#MicrosoftTranslatorWidget');
  	$('#WidgetCloseButton').remove();

  	if ($('#WidgetFloaterPanels').parent().attr('id') != 'MicrosoftTranslatorWidget') {
      move_translate();
    }
  }, 1000);
}
