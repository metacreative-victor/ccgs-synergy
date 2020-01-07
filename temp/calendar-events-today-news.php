<section class="events">
	<h2>Today's Events</h2>

<?php 

	global $ai1ec_calendar_helper;
	global $ai1ec_events_helper;

	// Get localized time
	$timestamp = time();
	$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	$end = mktime(23, 59, 59, date('m'), date('d'), date('Y'));

	// Set $limit to the specified category/tag
	$limit = array(
		'cat_ids'   => '',
		'tag_ids'   => '',
		'post_ids'  => '',
	);

	// Get events, then classify into date array
	//$event_results = $ai1ec_calendar_helper->get_events_relative_to( $timestamp, $events_per_page, 0, $limit );
	$event_results = $ai1ec_calendar_helper->get_events_between( $start, $end, $limit, true );

	if( ! $event_results ) :
	?>
		<ul>
			<li><?php _e( 'There are no events today.', AI1EC_PLUGIN_NAME ); ?></li>
		</ul>
	<?php else: ?>
		<ul>
			<?php foreach( $event_results as $event ): ?>
			<li>
				<div class="ai1ec-event ai1ec-event-id-<?php echo $event->post_id; ?> ai1ec-event-instance-id-<?php echo $event->instance_id; ?> <?php if( $event->allday ) echo 'ai1ec-allday'; ?>">
					<span class="ai1ec-popup-title popover-title">

						<?php echo esc_html( apply_filters( 'the_title', mb_strimwidth( $event->post->post_title, 0, 100, '...' ), $event->post_id ) ); ?>
						<?php if ( $show_location_in_title && isset( $event->venue ) && $event->venue != '' ): ?>
							<span class="ai1ec-event-location"><?php echo esc_html( sprintf( __( '@ %s', AI1EC_PLUGIN_NAME ), $event->venue ) ); ?></span>
						<?php endif; ?>
					</span>

					<!--<div class="ai1ec-event-time"><?php echo $event->get_short_start_date(); ?></div>-->

					<?php if ( $event->get_post_excerpt() ): ?>
						<div class="ai1ec-popup-excerpt"><?php echo esc_html( $event->get_post_excerpt() ) ?></div>
					<?php endif ?>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php 
	endif;
	?>
	<div class="view-calendar"><a href="<?php echo home_url(); ?>/ccgs-world-page/calendar">View All Calendar Events</a></div>
</section>