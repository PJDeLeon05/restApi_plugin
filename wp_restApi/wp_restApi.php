<?php
/*
  Plugin Name: Rest Api Plugin
  Description: A simple plugin for Wordpress Rest Api Requests
  Version: 1.0.0
  Author: Patrick James O. De leon
  Textdomain: restApi-plugin
*/

// Check if php is accessed with / on wordpress
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//php file for creating Custom Post Type
include( 'make_cpt.php' );

//php file for Get Api
include( 'get-api.php' );

// php file for custom-page-template
include( 'page-template-filter.php' );

// Execute create_custom_post_type_inside_funtionFile when plugin activate
register_activation_hook( __FILE__, 'create_custom_post_type_inside_funtionFile' );

// Execute wp_get_api when plugin is activated
register_activation_hook( __FILE__, 'wp_get_api' );

// Execute katana_page_template when in page named katana
// and its url is <base>/katana
add_filter( 'page_template', 'katana_page_template' );
