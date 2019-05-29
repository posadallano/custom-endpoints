<?php

/**
 * Get the 10 Upcoming Events (posts) from now (by date)
 *
 * @param array $request_data
 * @return array|null Upcoming Events array,  * or null if none.
 * @since 0.0.1
 */
function upcoming_events_posts( $request_data ) {

	// Save date now to 'date_now' variable
    $date_now = date('Y-m-d'); 

	// Setup query argument. Get the 10 upcoming events from now.
	$args = array(
		'posts_per_page'   => 10,
		'post_type'   => 'event',
		'meta_key'  => 'date',
		'order' => 'ASC',
		'orderby' => 'meta_value',
        'meta_query'  => array(
            array(          
				'key'      => 'date',
				'compare'  => '>=',
				'value'    => $date_now,
				'type'     => 'DATE',
        	)
        ),
	);

	// get posts
	$events = get_posts($args);

	// Null if none
	if (empty( $events ) ) {
		return null;
	}

	// add custom field data to data array	
	foreach ($events as $event) {
        $title = get_the_title( $event->ID );
		$date = get_field('date', $event->ID);
		$link = $event->ID;
		// Convert date to timestamp
		$timestamp_date = strtotime(get_field('date', $event->ID));

		$response = [
            'title'	=> $title,
            'date'  => $timestamp_date,
			'link'  => $link,
		];
        $data[] = $response;
	}
	
    return $data;
    
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/posts/v1/upcoming_events
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'posts/v1', '/upcoming_events/', array(
		'methods' => 'GET',
		'callback' => 'upcoming_events_posts'
		) );
} );

?>