<?php
/*
*   Plugin Name: Rest Api Plugin
*   Description: A simple plugin for Wordpress Rest Api Requests
*   Version: 1.0.0
*   Author: Patrick James O. De leon
*/

// Check if php is accessed with / on wordpress
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Function for creating post type and adding the registration of post type to the function.php of activated theme
function create_custom_post_type_inside_funtionFile( /*$name, array $args, array $labels = []*/ ) {
  $functionFile = '';
  if ( get_template_directory() !== get_stylesheet_directory() ) {
    // Using Child Theme
    if ( file_exists( get_stylesheet_directory() . '/functions.php') ) {
      $functionFile = get_stylesheet_directory() . '/functions.php';
    }
  }
  else {
    //Using Parent theme or Have no Child Theme
    if (file_exists( get_template_directory() . '/functions.php') ) {
      $functionFile = get_template_directory() . '/functions.php';
    }
  }

// Try Opening the Functions.php and exit if failed.
  $functionContent = fopen($functionFile, 'a') or die('Unable to open file');

// Concept for now
/*  $texts_to_append = (
    "function new_custom_post() {",
    " $args = array("
  );
  $text_to_appendNext = ();

  if ( count( $labels ) > 0 ){
    $texts_to_append = (
      "function new_custom_post() {",
      " $labels = array("
    );

    $text_to_appendFirst = (
      " );",
      " $args = array("
    );
  }

  $texts_to_appendLast = (
    " );",
    " register_post_type( '" . $name . "', $args );",
    "}",
    "",
    "add_action( 'init', 'new_custom_post');"
  );

  if ( count( $labels ) > 0 ) { foreach($text_to_appendFirst as $item) { $text_to_append.array_push($item); }}

  foreach($args as $item){ $text_to_append.array_push($item); }

  foreach($texts_to_appendLast as $item) { $text_to_append.array_push($item); } */

  //Adding Custom Type script to functions.php of the active theme
  if ( !function_exists( 'new_custom_post_artwork' ))
  {
    fwrite( $functionContent, PHP_EOL . "function new_custom_post_artwork() {" );
    fwrite( $functionContent, PHP_EOL . "  $" . "args = array();" );
    fwrite( $functionContent, PHP_EOL . "  register_post_type( 'Artwork', $" . "args);" );
    fwrite( $functionContent, PHP_EOL . "}" );
    fwrite( $functionContent, PHP_EOL . PHP_EOL . "add_action( 'init', 'new_custom_post_artwork');" );
    fclose( $functionContent );
  }
}

register_activation_hook( __FILE__, 'create_custom_post_type_inside_funtionFile');
