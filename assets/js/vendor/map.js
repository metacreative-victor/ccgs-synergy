$(document).ready(function(e) {

    // image.rwdImageMaps();

    // $('area').on('click', function() {
  // 	alert($(this).attr('title') + ' clicked');
  // });
  var array_list = [];
  $('.location-list li a').each(function(){
    array_list += '{key':$(this).data('slug'),'toolTip':$(this).data('description')+'}'
  });
  array_list += [array_list];
  console.log(array_list);
  var defaultDipTooltip = '';
  var image = $('#chirstchurch');

  image.mapster(
  {
    configTimeout: 90000,
      fillOpacity: 0.3,
      fillColor: "00305e",
      stroke: false,
      strokeColor: "00305e",
      strokeOpacity: 0.8,
      strokeWidth: 1,
      singleSelect: true,
      mapKey: 'id',
      listKey: 'id',
      scaleMap: true,
      onClick: function (e) {
        var areaId = jQuery(this).attr("id");
      //alert(contentPanelId);
         $('a[rel="'+areaId+'"]').eq(0).trigger("click");
         $('a[rel="'+areaId+'"]').mapster('deselect');
      },
      showToolTip: true,
      toolTipClose: ['image-mouseout', "area-click"],
      toolTipContainer: '<div class="map-tooltip"></div>',
      areas: array_list
  });

  var resizeTime = 100;     // total duration of the resize effect, 0 is instant
var resizeDelay = 100;    // time to wait before checking the window size again
                        // the shorter the time, the more reactive it will be.
                        // short or 0 times could cause problems with old browsers.


// Resize the map to fit within the boundaries provided

function resize(maxWidth,maxHeight) {
     var image =  $('#chirstchurch'),
        imgWidth = image.width(),
        imgHeight = image.height(),
        newWidth=0,
        newHeight=0;

    if (imgWidth/maxWidth>imgHeight/maxHeight || imgWidth/maxWidth<imgHeight/maxHeight) {
        newWidth = maxWidth;
    } else {
        newHeight = maxHeight;
    }
    image.mapster('resize',newWidth,newHeight,resizeTime);
}

// Track window resizing events, but only actually call the map resize when the
// window isn't being resized any more

function onWindowResize() {

    var curWidth = $('.interactive-map').width(),
        curHeight = $('.interactive-map').height(),
        checking=false;
    if (checking) {
        return;
            }
    checking = true;
    window.setTimeout(function() {
        var newWidth = $('.interactive-map').width(),
           newHeight = $('.interactive-map').height();
        if (newWidth === curWidth &&
            newHeight === curHeight) {
            resize(newWidth,newHeight);
        }
        checking=false;
    },resizeDelay );
}

$(window).bind('resize',onWindowResize);
window.onload = resize;

$(".mapgallery").fancybox({
  maxWidth	: 800,
  maxHeight	: 600,
  fitToView	: true,
  width		: '70%',
  height		: '70%',
  autoSize	: false,
  closeClick	: false,
  openEffect	: 'none',
  closeEffect	: 'none',
  nextEffect : 'none',
  prevEffect : 'none',
  type: 'image'
});

$(".mapmenu").on("click", function(){
  var areaId = jQuery(this).attr("data");
  $('a[rel="'+areaId+'"]').eq(0).trigger("click");
  $('img').mapster('tooltip');
  $('area').mapster('deselect');
});

$(".mapmenu").hover(
    function () {
     var areaId = jQuery(this).attr("data");
      $( 'area[id="' + areaId +'"]').mapster('select');
      $( 'area[id="' + areaId +'"]').mapster('tooltip');


  },
    function () {
      $('img').mapster('tooltip');
      $('area').mapster('deselect');
    }
  );


});
