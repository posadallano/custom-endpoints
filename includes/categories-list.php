<?php
/**
 * Get all Categories from the Blog posts
 *
 * @param array $request_data
 * @return array|null returns an array of Categories
 * @since 0.0.1
 */

function categories_list( $request_data ) {

	// Get Categories
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => true,
	) );

	// Loop the terms array
	foreach ($terms as $term) {
		$catname = $term->name;
		$catid = $term->term_id;
		$categoriesList = Array(
			'cat_name'	=> $catname,
			'cat_id' => $catid,
		);

		// add categories data to catList array
		$catList[] = $categoriesList;
	}	
	
	return $catList;
}	


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/news/v1/categories
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'news/v1', '/categories/', array(
		'methods' => 'GET',
		'callback' => 'categories_list'
		) );
} );

?>