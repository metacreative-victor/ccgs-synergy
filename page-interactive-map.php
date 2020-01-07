<?php
get_header(); ?>

 <?php get_template_part('templates/page','header');?>

<?php the_post();?>
<section class="paddit sectionit">
  <div class="wrap-large">

    <div id="inline" style="display:none;width:500px;">
    	<?php if( have_rows('image') ): ?>
    	    <?php while( have_rows('image') ): the_row(); ?>
    	        <a href="<?php the_sub_field('image_item'); ?>" data-fancybox="mapgallery" class="mapgallery" rel="<?php the_sub_field('slug'); ?>" title="<?php the_sub_field('description'); ?>" /></a>
    	    <?php endwhile; ?>
    	<?php endif; ?>
    </div>

    <div class="interactive-map">
    		<h1><?php the_title(); ?></h1>
    		<img src="<?php the_field('interactive_map'); ?>" alt="" usemap="#map" id="chirstchurch" />
    		<map name="map" id="chirstchurch_map">
    			<?php if( have_rows('item') ): ?>
    			    <?php while( have_rows('item') ): the_row(); ?>
    			        <area shape="poly" coords="<?php the_sub_field('coords'); ?>" title="<?php the_sub_field('name'); ?>" id="<?php the_sub_field('slug'); ?>" href="#" />
    			    <?php endwhile; ?>
    			<?php endif; ?>
    		</map>
    		<div style="clear: both;" id="selections"></div>

    		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    	  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>-->
    		<!--<script src="<?php echo SITE_URL; ?>/assets/js/vendor/jquery.imagemapster.min.js"></script>-->

    		<script type="text/javascript">
    			$(document).ready(function(e) {

    		    	// image.rwdImageMaps();

    		  		// $('area').on('click', function() {
    				// 	alert($(this).attr('title') + ' clicked');
    				// });

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
    				areas:  [
    					<?php if( have_rows('item') ): ?>
    					    <?php while( have_rows('item') ): the_row(); ?>
    					        {
    				               key: "<?php the_sub_field('slug'); ?>",
    				               <?php
    				                $output = get_sub_field('description');
    				                $output = str_replace(array("\r\n", "\r"), "\n", $output);
    								$lines = explode("\n", $output);
    								$new_lines = array();
    								foreach ($lines as $i => $line) {
    								    if(!empty($line))
    								        $new_lines[] = trim($line);
    								}
    								echo 'toolTip: "'.implode($new_lines).'"';  ?>
    				            },
    					    <?php endwhile; ?>
    					<?php endif; ?>
    		        ]
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
          /*
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
          */
    			$(".mapmenu").on("click", function(event){
            event.preventDefault();
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
    		</script>
    </div>

    <div class="map-items">
    	<h3><?php echo get_field('post_subtitle'); ?></h3>
    	<ul>
    		<?php if( have_rows('item') ): ?>
    		    <?php while( have_rows('item') ): the_row(); ?>
    		        <li><a href="#" class="mapmenu" data="<?php the_sub_field('slug'); ?>"><?php the_sub_field('name'); ?></a></li>
    		    <?php endwhile; ?>
    		<?php endif; ?>
    	</ul>
    </div>

  </div>
</section>
<?php get_footer(); ?>
