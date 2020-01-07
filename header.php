<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?> Christ Church Grammar School</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--[if IE]><script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/vendor/ie.js"></script><![endif]-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/favicon.ico">
	<?php wp_head(); ?>
	
	<?php if (is_page('Calendar')) : ?>
	  <!-- non-retina iPhone pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-57×57-calendar.png" sizes="57x57">
  	<!-- non-retina iPad pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-72×72-calendar.png" sizes="72x72">
  	<!-- retina iPhone pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-114×114-calendar.png" sizes="114x114">
	<?php else : ?>
  	<!-- non-retina iPhone pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-57×57-precomposed.png" sizes="57x57">
  	<!-- non-retina iPad pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-72×72-precomposed.png" sizes="72x72">
  	<!-- retina iPhone pre iOS 7 -->
  	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-114×114-precomposed.png" sizes="114x114">
	<?php endif; ?>

	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '611155519365715');
	  fbq('track', 'PageView');
	</script>
	<noscript>
	  <img height="1" width="1" style="display:none" 
	       src="https://www.facebook.com/tr?id=611155519365715&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->

</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<?php //get_template_part('templates/loading');?>
	<header id="header">

		<div class="header-holder">

			<div class="header-frame">

	    	<div class="logo"><a href="<?php echo home_url(); ?>">
					<img src="<?php echo THEME_URL ?>/assets/img/ccgs-logo-full.svg" alt="Christ Church Grammar School Perth, Western Australia"/></a>
				</div>

				<ul class="navigation-button">
		    	<li></li><li></li><li></li>
		    </ul>
	<?php echo do_shortcode('[google-translator]'); ?>
				<div class="nav-block">
					<nav id="nav">
						<?php
						wp_nav_menu( array(
							'menu_class' => 'main_menu_new',
							'container' => '',
							'menu' => 'Main Menu New',
							'depth' => 3
						) );
						?>
					</nav>
				</div>

			</div>

		</div>

    <div id="nav_search">
      <a class="close_search"><i class="fa fa-close"></i></a>
      <form method="get" id="searchform" action="<?php echo home_url(); ?>" role="search">
        <label for="s">Search the website</label>
        <span>
          <input name="s" id="s" type="text" tabindex="1" placeholder="Search this site..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search this site...'">
          <a class="submit_search"><i class="fa fa-search"></i></a>
        </span>
      </form>
    </div>

     <?php //get_template_part('templates/home-page','announcements'); ?>

	</header>

	<div id="main">

		<?php if(!is_front_page()): ?>

		<section class="breadcrumb paddit">

				<?php yoast_breadcrumb('<div class="wrap-large">','</div>'); ?>

		</section>
		<?php endif; ?>

		<div class="container">
