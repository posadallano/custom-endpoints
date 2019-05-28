<?php
/**
 * Gets a collection of posts.
 *
 * @param array $request Options for the function.
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */

function get_posts( WP_REST_Request $request ) {

	// count posts
	$count_posts = wp_count_posts('post');
	$published_posts = $count_posts->publish;

	// check for params
	$posts_per_page = $request['per_page']?: '10';
	$offset = $request['offset']?: '0';

	// setup query argument
	$args = array(
		'numberposts' => -1,
		'post_type' => 'post',
		'posts_per_page' => $posts_per_page,
		'offset' => $offset,
	);

	// get posts
	$posts = get_posts($args);

	// Null if none
	if (empty( $posts ) ) {
		return null;
	}

	// Create array
	$postsList = Array();

	// add custom field data to data array	
	foreach ($posts as $post) {
		// get the post data
        $title = get_the_title( $post->ID );
		$image = get_the_post_thumbnail_url($post->ID);
        $date = get_post_time('U', true, $post->ID);
		$link = $post->ID;
		$categories = get_the_category($post->ID);
		$catList = Array();

		// Get Categories by post
		foreach( $categories as $category) {
			$cat_name = $category->name;
			$cat_link = $category->term_id;
			$catList[] = Array(
				'name' => $cat_name,
				'link' => $cat_link
			);
		}

		// Get post data
		$postsList = Array(
            'title'	=> $title,
			'image' => $image,
            'date'  => $date,
			'link'  => $link,
			'categories' => $catList,
		);
		
		$data['items'][] = $postsList;
	}

	// Array total posts
	$totalPosts = Array(
		'total_records' => $published_posts
	);

	$postsArchive[] = array_merge ($totalPosts, $data);

    return $postsArchive;
	
	// Restore original Post Data
	wp_reset_postdata();	
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/posts/v1/archive?per_page={integer}&offset={integer}
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'posts/v1', '/archive/', array(
		'methods' => 'GET',
		'callback' => 'get_posts',
		// Optional parameters: per_page & offset
		'args' => array(
			'per_page' => array(
				'description'       => 'Maxiumum number of items to show per page.',
				'type'              => 'integer',
				'validate_callback' => function( $param, $request, $key ) {
					return is_numeric( $param );
				},
				'sanitize_callback' => 'absint',
			),
			'offset' =>  array(
				'description'       => 'The position of the post where the output starts.',
				'type'              => 'integer',
				'validate_callback' => function( $param, $request, $key ) {
					return is_numeric( $param );
				},
				'sanitize_callback' => 'absint'
			),
		),
	  ) );
} );


?>