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
include( 'make-cpt.php' );

//php file for Get and Post API
include( 'request-api.php' );

// php file for custom-page-template
include( 'page-template-filter.php' );

// Execute create_custom_post_type_inside_funtionFile when plugin activate
register_activation_hook( __FILE__, 'create_custom_post_type_inside_funtionFile' );

// Add custom route for get and post api
add_action ( 'rest_api_init', 'register_new_APIroute');

// Add custom rest field
add_action ( 'rest_api_init', 'wp_register_rest_field' );

// Execute katana_page_template when in page named katana
// and its url is <base>/katana
add_filter( 'page_template', 'katana_page_template' );

// Add the styles.css
function add_style_file(){
  wp_enqueue_style( 'pjd-katana-style', plugin_dir_url( __FILE__ ) . '/styles.css' );
}
add_action ('wp_enqueue_scripts', 'add_style_file');
