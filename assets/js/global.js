$ = jQuery;
var animating = false;

//Pre-load
/*
$(window).on("load", function() {
  $('.page-loading').addClass('done')
});

$('.page-loading').click(function(){
  $('.page-loading').removeClass('preload').addClass('done');
});

window.addEventListener("beforeunload", function (event) {
  $('.page-loading').removeClass('done').addClass('preload');
});
*/

//scroll stuff
jQuery('g.grows').click(function(e) {
  var target = $(this).attr('link');
  console.log(target)

    e.preventDefault();
    if (target !== "") {
      jQuery('html, body').stop().animate({
          scrollTop: jQuery(target).offset().top - 80
      }, 900, 'swing', function () {
          //window.location.hash = target;
      });
    }

});

$(document).ready(function(){
	
  $('body.search-results div.result a').removeClass();

  $(".bx-wrapper div.caption").show();

  //Slick
  $('.slick-message').slick({
		fade: true,
		infinite: true,
		speed: 1800,
		slidesToShow: 1,
		autoplay: true,
		autoplaySpeed: 3000,
		arrows: false,
		dots: false,
    pauseOnHover: false
	});



  // Smooth scroll
  /*
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        animating = true;
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000, function(){
          animating = false;
        });
        return false;
      }
    }
  });

  $('.announcements').slideDown(300).delay(800).fadeIn(400);
  */
  $('button[data-action="open-profile-window"]').click(function(){
    $('.background-cover').fadeIn();
    var this_window = $(this).next('.profile-window');
    $(this_window).fadeIn().addClass('active');
    $(this_window).css({
        'margin-top': '-' + this_window.height() / 2 + 'px',
        'margin-left': '-' + this_window.width() / 2 + 'px'
    });
  });

  $('button[data-action="close-profile-window"], .background-cover').click(function(){
    $('.profile-window .active').removeClass('active');
    $('.profile-window').fadeOut();
    $('.background-cover').fadeOut();
  });

  //Current Vacancies
	$('.career-vacancies .description').hide();
	$('.career-vacancies .link').bind('click', function(e) {
		e.preventDefault();
		$this_description = $(this).parent().parent().find('div.description');
		//$('.career-vacancies .description').hide();

		if ($this_description.is(":visible")){
			$this_description.hide('fast');
		} else {
			$('.career-vacancies .description').hide('fast');
			$this_description.show('fast');
		}
	});

  //News menu toggle
  $(document).ready(function(){
    $('#news_cats_opener').on("click", function(){
      $(this).toggleClass("open");
      $('#news_cats_opener + ul').slideToggle(500);
    });
  });

  //Mobile menu button
	$(window).on('load resize', function() {
		if ( $(window).width() <= 1024 ) {
      $('.nav-block #nav').hide();
			$('.navigation-button').delay(300).queue(function (next) {
	    	$('.navigation-button').css('top', '34px');
	    	next();
	  	});
		}else{
      $('.nav-block #nav').show();
      $('.navigation-button').delay(300).queue(function (next) {
	    	$('.navigation-button').css('top', '-134px');
	    	next();
	  	});
    }
	});

  //Navigation
	$('.navigation-button').click(function(event) {
    $('#header').toggleClass('active');
		$(this).toggleClass('active');
		$('.nav-block #nav').toggle();
    $('html, body').animate({
        scrollTop: $("#header").offset().top
    }, 200);
	});

});


//Navigation functions
if ($("#nav > ul").find(".nav_home_icon").length == 0 && $('body').width() > 1184 ){
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

// Move CCGS WORLD menu item to the top on mobile view
if ($(window).width() < 1024) {
  $('ul#menu-main-menu-new li.ccgs-world').each(function(){
    $(this).parent().prepend(this);
  });

  //Menu sub items expand
  $('.main_menu_new > .menu-item-has-children > .sub-menu').each(function(){
    $(this).before('<i class="fa fa-chevron-down d-hide"></i>');
  });

  $('.d-hide').click(function(){
    if ($(this).next('.sub-menu').hasClass('active')){
      $(this).next('.sub-menu').toggleClass('active');
    }else{
      $('.main_menu_new > .menu-item-has-children > .sub-menu').removeClass('active');
      $(this).next('.sub-menu').addClass('active');
    }
  });
}
$(window).resize(function() {
  if ($(window).width() < 1024) {
    $('ul#menu-main-menu-new li.ccgs-world').each(function(){
      $(this).parent().prepend(this);
    });
  }
  else {
    $('ul#menu-main-menu-new li.ccgs-world').each(function(){
      $(this).insertAfter('ul#menu-main-menu-new li.news-events');
    });
  }
});


$(document).ready(function() {
  $('table').wrap('<div class="mobile-tables"></div>').removeAttr('style width height');
  $('table tr').removeAttr('style width height');
  $('table').attr('cellspacing',8);
});
