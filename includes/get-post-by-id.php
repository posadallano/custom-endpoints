<?php
/**
 * Grab post by ID
 *
 * @param array $request_data
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */

function post_by_id( $request_data ) {
	
	// setup query argument
	$args = array(
		'post_type' => 'post',
		'p' => $request_data['post_id']
	);

	// get posts
	$posts = get_posts($args);

	if (empty( $posts ) ) {
		return null;
	}

	foreach ($posts as $post) {
		$title = get_the_title( $post->ID );
		$image = get_the_post_thumbnail_url( $post->ID );
		$content = get_field('post_editor', $post->ID);
		$categories = get_the_category($post->ID);
		$categoriesList = Array();

		// Get Categories associated with post
		foreach( $categories as $category) {
			$catname = $category->name;
			$catlink = $category->term_id;
			$categoriesList[] = Array(
				'name' => $catname,
				'link' => $catlink
			);
		}
		
		$response = [
			'title' => $title,
			'image' => $image,
			'content' => $content,
			'categories' => $categoriesList,
		];
		$data[] = $response;
	}
	
	return $data;
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/posts/v1/detail/{post_id}
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'posts/v1', '/detail/(?P<post_id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'post_by_id'
		) );
} );

?>