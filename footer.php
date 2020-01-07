<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 */

$category_id = 5;
$post_type = 'post';

?>
		</div>
	</div>

	<footer id="footer">
    <div class="footer-bottom">
    	<div class="holder">

				<section class="left-col">
					<?php
            if (has_nav_menu('footer_navigation')) :
              wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footer-nav'));
            endif;
          ?>

          <div class="social-media-links">
              <a href="https://www.facebook.com/CCGSClaremont/" target="_blank"><span class="fa fa-facebook"></span></a>
							<!--<a href="#" target="_blank"><span class="fa fa-linkedin"></span></a>-->
              <a href="https://twitter.com/CCGSSport" target="_blank"><span class="fa fa-twitter"></span></a>
							<a href="https://www.instagram.com/ccgswa/" target="_blank"><span class="fa fa-instagram"></span></a>
              <a href="<?php bloginfo('rss_url'); ?>" target="_blank"><span class="fa fa-rss"></span></a>

              <?php //echo do_shortcode('[google-translator]'); ?>
          </div>

					<p class="copyright">Copyright &copy; <?php echo date("Y"); ?> Christ Church Grammar School / CRICOS NO 00433G</p>
				</section>

				<section class="right-col">
					<img src="<?php echo THEME_URL ?>/assets/img/ccgs-logo-full.svg"/>
					<ul>
						<li><span class="fa fa-phone"></span> +61 8 9442 1555</li>
						<li><span class="fa fa-envelope"></span> <a href="mailto:info@ccgs.wa.edu.au">info@ccgs.wa.edu.au</a></li>
						<li><span class="fa fa-map-marker"></span> Queenslea Drive, Claremont Western Australia 6010</li>
					</ul>
					<br>
					<a href="https://www.theibsc.org/" target="_blank" class="member"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/IBSC.svg"/></a>
					<a href="http://www.cois.org/" target="_blank" class="member"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/cis_member_icon.svg"/></a>
				</section>

			</div>
		</div>
	</footer>

</div>

<?php wp_footer(); ?>

<?php if(WP_DEBUG): ?>
<!-- Grunt liverelaod -->
<script src="//localhost:35729/livereload.js"></script>
<?php endif; ?>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5239298.js"></script>
<!-- End of HubSpot Embed Code -->

</body>
</html>
