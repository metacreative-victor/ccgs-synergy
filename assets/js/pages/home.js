(function($) {
$(document).ready( function() {
  var $window = $(window);
  var slider = $('#home-slider div.home-slider-inner');
  var audio_status = 'off';

  function _resizeBgVideo() {
    if( 0 === $( this ).find( 'video' ).length ) {
      return;
    }

    var wrap      = $(this),
      wrapHeight  = wrap.outerHeight(),
      wrapWidth   = wrap.outerWidth(),
      vid         = wrap.find('video'),
      vidHeight   = wrap.data('height'),
      vidWidth    = wrap.data('width'),
      newWidth    = wrapWidth,
      newHeight   = Math.round(vidHeight * wrapWidth/vidWidth),
      newLeft     = 0,
      newTop      = 0;

    if ( vid.length ) {
      if(vidHeight === '' || typeof vidHeight === 'undefined' || vidWidth === '' || typeof vidWidth === 'undefined') {
        vid.css({
          'left'      : '0px',
          'top'       : '0px',
          'width'     : newWidth + 'px'
        });

        // Try to set the actual video dimension on 'loadedmetadata' when using URL as video source
        vid.on('loadedmetadata', _resizeOnLoadedMeta);

      }
      else {

        if(newHeight < wrapHeight) {
          newHeight   = wrapHeight;
          newWidth    = Math.round(vidWidth * wrapHeight/vidHeight);
          newLeft     = -((newWidth - wrapWidth)/2);
        }
        else {
          newTop      = -((newHeight - wrapHeight)/2);
        }

        vid.css({
          'left'      : newLeft + 'px',
          'top'       : newTop + 'px',
          'height'    : newHeight + 'px',
          'width'     : newWidth + 'px'
        });
      }
    }
  }

  function _resizeOnLoadedMeta() {
    var video     = $(this),
      wrapHeight  = video.parent().outerHeight(),
      wrapWidth   = video.parent().outerWidth(),
      vidWidth    = video[0].videoWidth,
      vidHeight   = video[0].videoHeight,
      newHeight   = Math.round(vidHeight * wrapWidth/vidWidth),
      newWidth    = wrapWidth,
      newLeft     = 0,
      newTop      = 0;

    if(newHeight < wrapHeight) {
      newHeight   = wrapHeight;
      newWidth    = Math.round(vidWidth * wrapHeight/vidHeight);
      newLeft     = -((newWidth - wrapWidth)/2);
    }
    else {
      newTop      = -((newHeight - wrapHeight)/2);
    }

    video.parent().data('width', vidWidth);
    video.parent().data('height', vidHeight);

    video.css({
      'left'      : newLeft + 'px',
      'top'       : newTop + 'px',
      'width'     : newWidth + 'px',
      'height'  : newHeight + 'px'
    });
  }

  function _resizeBgVideos() {
    $('.slide-video').each( function() {
      _resizeBgVideo.apply( this );
    });
  }

  function _playPauseVideo(slick, control) {
    var currentSlide = slick.find(".slick-current");
    var video = currentSlide.find("video").get(0);

    if( video != null ) {
      if( control === "play" ) {
        video.play();

        if( audio_status == 'off' ) {
          $(video).prop('muted', true);
          $('#home-slider button.audio-controls i.fa').removeClass( 'fa-volume-up' ).addClass('fa-volume-off');
        } else if( audio_status == 'on' ) {
          $(video).prop('muted', false);
          $('#home-slider button.audio-controls i.fa').removeClass( 'fa-volume-off' ).addClass('fa-volume-up');
        }

      } else {
        video.pause();
      }
    }
  }

  $window.on('resize', function() {
    _resizeBgVideos();
  });

  slider.on("init", function(slick) {
    slick = $(slick.currentTarget);

    _resizeBgVideos();

    setTimeout( function() {
      _playPauseVideo(slick, "play");
    }, 1000);
  });

  slider.on("beforeChange", function(event, slick) {
    slick = $(slick.$slider);

    _playPauseVideo(slick, "pause");
  });

  slider.on("afterChange", function(event, slick) {
    slick = $(slick.$slider);

    _playPauseVideo(slick, "play");
  });

  slider.slick({
    'autoplay': false,
    'arrows': false,
    'dots': true,
    'fade': true,
    'speed': 600,
    'lazyLoad': 'progressive'
  });

  $('#home-slider button.audio-controls').on('click', function(e) {
    var currentSlide = slider.find(".slick-current");
    var video = currentSlide.find("video").get(0);

    if( audio_status == 'off' ) {
      $(video).prop('muted', false);
      $('#home-slider button.audio-controls i.fa').removeClass( 'fa-volume-off' ).addClass('fa-volume-up');
      audio_status = 'on';
    } else if( audio_status == 'on' ) {
      $(video).prop('muted', true);
      $('#home-slider button.audio-controls i.fa').removeClass( 'fa-volume-up' ).addClass('fa-volume-off');
      audio_status = 'off';
    }

    e.preventDefault();
  });
});
})(jQuery);


