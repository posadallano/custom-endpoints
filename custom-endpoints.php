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

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/custom-endpoints-scripts.php');

// Home content
require_once( plugin_dir_path( __FILE__ ) . 'includes/home-content.php' );

?>