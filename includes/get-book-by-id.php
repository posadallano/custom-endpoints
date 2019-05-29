<?php
/**
 * Books detail.
 *
 * @param array $request_data Options for the function.
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */

function books_detail( $request_data ) {
	
	// setup query argument
	$args = array(
		'post_type' => 'books',
		'p' => $request_data['book_id']
	);

	// get posts
	$books = get_posts($args);

	// Null if none
	if (empty( $books ) ) {
		return null;
	}

	foreach ($books as $book) {
		$title = get_the_title( $book->ID );
		$content_blocks = get_field('content_blocks_books', $book->ID);
		
		$response = [
			'title' => $title,
			'content_blocks' => $content_blocks
		];
		$data[] = $response;
	}
	
	return $data;
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/books/v1/detail/{book_id}
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'books/v1', '/detail/(?P<book_id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'books_detail'
		) );
} );

?>