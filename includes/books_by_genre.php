<?php
/**
 * Gets books by genre.
 *
 * @param array $request_data Options for the function.
 * @return array|null Post array,  * or null if none.
 * @since 0.0.1
 */

function books_by_genre( $request_data ) {
	
	// Get genre terms
	$terms = get_terms( array(
		'taxonomy' => 'genre',
		'hide_empty' => true,
		'number' => 5,
		'meta_query' => array(
			array(
			   'key'     => 'show_in_landing',
			   'compare' => '=',
				'value'  => '1'
			)
	   )
	) );
	
	foreach ( $terms as $term ) {
		
		// Get posts grouped by genre terms
		$args = array(
			'post_type' => 'collection',
			'tax_query' => array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $term->slug
				),
			),
		);
		
		$tax_terms_posts = get_posts( $args );
		
		// Create arrays
		$genreArray = Array();
		$carouselArray = Array();
		$carouselArrayTemp = Array();
		$topArray = Array();

		// Get Top genre data: title, description & image
		$termid = $term->taxonomy . '_' . $term->term_id;
		$gernrename = $term->name;
		$genredescr = get_field('genre_description', $termid);
		$genreimage = get_field('genre_image', $termid);

		// Send data to array
		$topArray = Array(
			"genre_title" => $termname,
			"genre_description" => $genredescr,
			"genre_image" => $genreimage
		);

		// Get The Carousel data
		$caroutitle = get_field('carousel_title', $termid);
		$caroudescr = get_field('carousel_description', $termid);

		// Send data to array
		$topCarouArray = Array();
		$topCarouArray[] = Array(
			"title" => $caroutitle,
			"description" => $caroudescr
		);

		// Loop carousel: get the images and send data to array
		if( have_rows('carousel_slides', $termid) ):
			while ( have_rows('carousel_slides', $termid) ) : the_row();
				$image = get_sub_field('image', $termid);
				$carouselArrayTemp[] = Array(
					"image" => $image,
				);
			endwhile;
		endif;

		// Merge carousel data
		$carouselArray['carousel'] = array_merge($topCarouArray, $carouselArrayTemp);

		// Loop the Books posts
		foreach ( $tax_terms_posts as $post ) {
			$genreArray['books'][] = Array(
				"title" => $post->post_title,
				'image' => get_field('landing_image', $post->ID),
				'description' => get_field('description', $post->ID),
				"link" => $post->ID,
			);
		}

		// Merge arrays
		$data[$term->slug][] = array_merge($topArray, $genreArray, $carouselArray); 	

	}
	wp_reset_postdata();
	return $data;
}


/*
*
* Register Rest API Endpoint
* Route: {URL}/wp-json/books/v1/bygenre
*
*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'books/v1', '/bygenre/', array(
		'methods' => 'GET',
		'callback' => 'books_by_genre'
		) );
} );

?>