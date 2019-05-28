<?php
/**
 * Get the Home page content
 *
 * @param array $request_data
 * @return array|null Single page data, or null if none.
 * @since 0.0.1
 */

function pagecontent_home( $request_data ) {

	// get page
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-home.php'
	));

	// Null if none
	if (empty( $pages ) ) {
		return null;
	}

	// add custom field data to data array	
	foreach ($pages as $page) {
		// get the ACF data: 'flexible content' field
		$content_block_home = get_field('content_blocks_home', $page->ID);
		$api_response = [
			'content_blocks_home'  => $content_block_home
		];
		$data[] = $api_response;
	}
	
	return $data;
}

/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/pagecontent/v1/home
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'pagecontent/v1', '/home/', array(
		'methods' => 'GET',
		'callback' => 'pagecontent_home'
		) );
} );

?>