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

//Rest Api Get
function wp_get_api()
{
  $getRequest = XML
}

//php file for creating Custom Post Type
include('make_cpt.php');

// Execute create_custom_post_type_inside_funtionFile when plugin activate
register_activation_hook( __FILE__, 'create_custom_post_type_inside_funtionFile' );
