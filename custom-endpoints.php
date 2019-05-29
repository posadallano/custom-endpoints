<?php
/*
Plugin Name: Custom Endpoints
Plugin URI:  https://github.com/posadallano/custom-endpoints
Description: Serves up WP Rest API endpoints using Advanced Custom Fields
Version:     1.0
Author:      Andres Posada
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if Accessed Directly
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Home content
require_once( plugin_dir_path( __FILE__ ) . 'includes/home-content.php' );

// Archive posts
require_once( plugin_dir_path( __FILE__ ) . 'includes/get-posts.php' );

// Posts by ID
require_once( plugin_dir_path( __FILE__ ) . 'includes/get-post-by-id.php' );

// Categories list
require_once( plugin_dir_path( __FILE__ ) . 'includes/categories-list.php' );

// Upcoming events
require_once( plugin_dir_path( __FILE__ ) . 'includes/upcoming-events.php' );

// Books by genre
require_once( plugin_dir_path( __FILE__ ) . 'includes/books_by_genre.php' );

// Books featured
require_once( plugin_dir_path( __FILE__ ) . 'includes/books-featured.php' );

// Books by ID
require_once( plugin_dir_path( __FILE__ ) . 'includes/get-book-by-id.php' );

// Hero
require_once( plugin_dir_path( __FILE__ ) . 'includes/hero-posts.php' );

?>