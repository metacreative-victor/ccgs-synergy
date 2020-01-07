<section class="events">
	<h2>Calendar of Events</h2>

<?php 

	global $ai1ec_calendar_helper;
	global $ai1ec_events_helper;

	// Get localized time
	$timestamp = $ai1ec_events_helper->gmt_to_local( time() );
	$events_per_page = 3;

	// Set $limit to the specified category/tag
	$limit = array(
		'cat_ids'   => '',
		'tag_ids'   => '',
		'post_ids'  => '',
	);

	// Get events, then classify into date array
	$event_results = $ai1ec_calendar_helper->get_events_relative_to( $timestamp, $events_per_page, 0, $limit );
	$dates = $ai1ec_calendar_helper->get_agenda_like_date_array( $event_results['events'] );

	if( ! $dates ) :
	?>
		<ul>
			<li><?php _e( 'There are no upcoming events.', AI1EC_PLUGIN_NAME ); ?></li>
		</ul>
	<?php else: ?>
		<ul>
		<?php foreach( $dates as $timestamp => $date_info ): ?>
			<?php foreach( $date_info['events'] as $category ): ?>
				<?php foreach( $category as $event ): ?>
				<li>
					<div class="ai1ec-event ai1ec-event-id-<?php echo $event->post_id; ?> ai1ec-event-instance-id-<?php echo $event->instance_id; ?> <?php if( $event->allday ) echo 'ai1ec-allday'; ?>">
						<span class="ai1ec-popup-title popover-title">

							<?php echo esc_html( apply_filters( 'the_title', mb_strimwidth( $event->post->post_title, 0, 100, '...' ), $event->post_id ) ); ?>
							<?php if ( $show_location_in_title && isset( $event->venue ) && $event->venue != '' ): ?>
								<span class="ai1ec-event-location"><?php echo esc_html( sprintf( __( 'at %s', AI1EC_PLUGIN_NAME ), $event->venue ) ); ?></span>
							<?php endif; ?>
						</span>

						<div class="ai1ec-event-time"><?php echo $event->get_short_start_date(); ?></div>

						<?php if ( $event->get_post_excerpt() ): ?>
							<div class="ai1ec-popup-excerpt"><?php echo esc_html( $event->get_post_excerpt() ) ?></div>
						<?php endif ?>
					</div>
				</li>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</ul>
	<?php 
	endif;
	?>
	<div class="view-calendar"><a href="<?php echo home_url(); ?>/ccgs-world-page/calendar">View All Calendar Events</a></div>
</section>