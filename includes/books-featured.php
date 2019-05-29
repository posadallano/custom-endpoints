<?php

/**
 * Featured Books
 *
 * @param array $request_data Options for the function.
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */
function feat_books( $request_data ) {

	// setup query argument
	$args = array(
		'post_type' => 'books',
		'posts_per_page'  => 10,
		'orderby' => array(
			'featured' => 'ASC',
			'order' => 'ASC',
        ),
		'meta_query' => array(
			'relation' => 'AND',
			'featured' => array(
				'key' => 'featured',
				'value' => 'yes',
			),
			'order' => array(
				'key' => 'order',
				'orderby' => 'meta_value_num',
				'type' => 'NUMERIC',
                'compare' => 'EXISTS',
			), 
		),
	);

	// get posts
	$posts = get_posts($args);

	if (empty( $posts ) ) {
		return null;
	}

	// add custom field data to data array	
	foreach ($posts as $post) {
		$title = get_the_title( $post->ID );
		$link = $post->ID;
		$description = get_field('description', $post->ID);
		$image = get_field('image', $post->ID);
		$order = get_field('order', $post->ID);
		$response = [
			'title'	=> $title,
			'description' => $description,
			'image' => $image,
			'link'  => $link,
			'order'  => $order
		];
		$data[] = $response;
	}
	
	return $data;
}

/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/books/v1/featured
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'books/v1', '/featured/', array(
		'methods' => 'GET',
		'callback' => 'feat_books'
		) );
} );

?>