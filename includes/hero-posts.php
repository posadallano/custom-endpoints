<?php
/**
 * Posts Hero from Options page
 *
 * @param array $request_data Options for the function.
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */

function hero( $request_data ) {

	// Null if none
	if (empty( 'hero' ) ) {
		return null;
	}

	// Get fields
	if( have_rows('hero', 'option') ):
		while( have_rows('hero', 'option') ): the_row();	
			$title = get_sub_field('title');
			$description = get_sub_field('description');
			$background_options = get_sub_field('background');
			$response = [
				'title'  => $title,
				'description'  => $description,
				'background'  => $background_options
			];
			$data[] = $response;
		endwhile;
	endif;

	return $data;
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/posts/v1/hero
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'posts/v1', '/hero/', array(
		'methods' => 'GET',
		'callback' => 'hero'
		) );
} );

?>