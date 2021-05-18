<?php
//Rest Api GET home_url() . '/wp-json/katana/posts' and put the result in a text file
if ( !function_exists( 'wp_get_api' ) ) {
function wp_get_api() {
    $url =  home_url() . '/wp-json/katana/posts';

    $response = wp_remote_get( $url );

    if ( is_wp_error( $response ) ) { return; }

  	$data = wp_remote_retrieve_body( $response );

    if ( is_wp_error( $data ) ) { return; }
  	// Writing the response to a file named 'response.txt'
    // This function will replace older stored response
  	$file = plugin_dir_path( __FILE__ ) . '/response.txt';

  	$fileEdit = fopen( $file, 'w') or die('Unable to open file');

  	fwrite( $fileEdit, $data );

  	fclose( $fileEdit );
  }
}
