<?php get_header(); ?>
<section class="sectionit paddit">
	<div class="wrap-large">
		
		<div class="twocolumns single_online_payment">

			<?php if( have_posts() ) while( have_posts() ): the_post(); ?>

				<header>
					<h1><?php the_title(); ?></h1>
				</header>

				<div class="meta">
					<?php $years = wp_get_post_terms($post->ID,'payment_year');
					foreach ($years as $year) {
						echo '<span>' . $year->name . '</span>';
					}
					?>
				</div>

				<div class="post-content">



					<div class="image"><?php echo the_post_thumbnail('medium');?></div>

					<?php the_content(); ?>

					<?php
						$field = get_field_object('payment_url');
						$value = $field['value'];
						$label = $field['choices'][ $value ];
						if ($value) :
					?>

					<div class="payment_button">
						<a href="<?php echo $value;?>" target="_blank">Make a payment now</a>
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/credits.jpg" class="credit">
					</div>

					<span class="note">You will be directed to our WestPac payment page</span>

					<?php endif; ?>

				</div>

			<?php endwhile; ?>

		  <?php get_template_part('part','pagination'); ?>

		</div>

		<?php get_template_part('part','online_payment_navigation'); ?>

	</div>
</section>
<?php get_footer(); ?>
