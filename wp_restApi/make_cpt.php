<?php
/*
*  php responsible for creating a new custom post type and adding it to functions.ph of currently active theme
*/

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
  if ( !function_exists( 'pjd_register_new_post_type' ))
  {
    fwrite( $functionContent, PHP_EOL . "function pjd_register_new_post_type() {" );
    fwrite( $functionContent, PHP_EOL . "  $" . "args = array(" );
    fwrite( $functionContent, PHP_EOL . "     'label'                => __( 'Artwork', 'restApi-plugin' )," );
    fwrite( $functionContent, PHP_EOL . "     'has_archive'          => true," );
    fwrite( $functionContent, PHP_EOL . "     'public'               => true," );
    fwrite( $functionContent, PHP_EOL . "     'hierarchical'         => false," );
    fwrite( $functionContent, PHP_EOL . "     'show_in_rest'         => true," );
    fwrite( $functionContent, PHP_EOL . "     'supports'             => array(" );
    fwrite( $functionContent, PHP_EOL . "         'title'," );
    fwrite( $functionContent, PHP_EOL . "         'editor'," );
    fwrite( $functionContent, PHP_EOL . "         'excerpt'," );
    fwrite( $functionContent, PHP_EOL . "         'custom-fields'," );
    fwrite( $functionContent, PHP_EOL . "         'thumbnail'," );
    fwrite( $functionContent, PHP_EOL . "         'page-attributes'" );
    fwrite( $functionContent, PHP_EOL . "     )," );
    fwrite( $functionContent, PHP_EOL . "     'register_meta_box_cb' => 'wp_add_meta'" );
    fwrite( $functionContent, PHP_EOL . "  );" . PHP_EOL );
    fwrite( $functionContent, PHP_EOL . "  register_post_type( 'artwork', $" . "args);" );
    fwrite( $functionContent, PHP_EOL . "}" );
    fwrite( $functionContent, PHP_EOL . PHP_EOL . "add_action( 'init', 'pjd_register_new_post_type');" );
    fwrite( $functionContent, PHP_EOL . "function wp_add_meta() {" );
    fwrite( $functionContent, PHP_EOL . "   add_meta_box( 'artwork-artist', 'Artist', 'artwork_artist_callback', 'artwork', 'normal', 'high' );");
    fwrite( $functionContent, PHP_EOL . "   add_meta_box( 'artwork-price', 'Price', 'artwork_price_callback', 'artwork', 'normal', 'high' );");
    fwrite( $functionContent, PHP_EOL . "}" );
    fwrite( $functionContent, PHP_EOL . "function artwork_artist_callback() {" );
    fwrite( $functionContent, PHP_EOL . "   global $" . "post;");
    fwrite( $functionContent, PHP_EOL . "   wp_nonce_field( basename( __FILE__ ), 'event_fields' );");
    fwrite( $functionContent, PHP_EOL . "   $" . "artist = get_post_meta( $" . "post->ID, 'artist', true );");
    fwrite( $functionContent, PHP_EOL . "   echo '" . '<input type="text" name="artist" value="' . "' . " . 'esc_textarea( $artist )' . " . '" . '" class="widefat"' . ">';" );
    fwrite( $functionContent, PHP_EOL . "}" );
    fwrite( $functionContent, PHP_EOL . "function artwork_price_callback() {" );
    fwrite( $functionContent, PHP_EOL . "   global $" . "post;");
    fwrite( $functionContent, PHP_EOL . "   wp_nonce_field( basename( __FILE__ ), 'event_fields' );");
    fwrite( $functionContent, PHP_EOL . "   $" . "price = get_post_meta( $" . "post->ID, 'price', true );");
    fwrite( $functionContent, PHP_EOL . "   echo '" . '<input type="text" name="price" value="' . "' . " . 'esc_textarea( $price )' . " . '" . '" class="widefat"' . ">';" );
    fwrite( $functionContent, PHP_EOL . "}" );
  }
}
