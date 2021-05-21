<?php
//Rest Api GET and POST with utl home_url() . '/wp-json/katana/posts'
function register_new_APIroute() {
	$args = [
		['methods' 			   => WP_REST_SERVER::READABLE,
		'callback' 			   => 'wp_get_request',
		'timeout'			   => 10,
		'permission_callback'  => '__return_true'],
		['methods' 			   => WP_REST_SERVER::CREATABLE,
		'callback' 			   => 'wp_post_request',
		'timeout'			   => 10,
		'args'				   => array(
				'post_title'   		  => array(
					'required'			=> true,
					'sanitize_callback' => 'wp_filter_nohtml_kses'
				),
				'post_content' 		  => array(
					'required'			=> true,
					'sanitize_callback' => 'wp_filter_post_kses'
				),
				'post_status'  		  => array(
					'default' 			 => 'publish',
					'sanitize_callback'  => 'wp_filter_nohtml_kses'
				),
				'katana_post_token'	  => array(
					'sanitize_callback'	 =>	'wp_filter_nohtml_kses'
				),
				'katana_referrer_url' => array(
					'sanitize_callback'  => 'wp_filter_nohtml_kses'
				)
		),
		'permission_callback' => '__return_true',],
	];
	register_rest_route( 'katana', 'posts', $args );
}

function wp_get_request ( WP_REST_Request $request ) {
	if ( is_wp_error( $request->has_valid_params() ) ) { return 'Invalid Parameters'; }
	
	if ( is_wp_error( $request->sanitize_params() ) ) { return 'Cannot Clean Parameters'; }
	
	$request->set_default_params( array( 'numberposts' => '-1' ) );
	
	$request_params = $request->get_params();
	
	if ( array_key_exists('numberposts', $request_params ) ){
		if ( !is_numeric($request_params['numberposts'])) { $request_params['numberposts'] = '-1'; }
	}
	
	return get_posts( $request_params );
}

function wp_post_request ( WP_REST_Request $request ){
	$retry_count = 0;
	while($retry_count <= 2) {
		if ($retry_count > 0) { echo 'Retry #' . $retry_count . PHP_EOL; }
		
		if ( is_wp_error( $request->has_valid_params() ) ) {
			echo 'Invalid Parameters' . PHP_EOL;
			$retry_count++;
			continue;
		}
		
		if ( is_wp_error( $request->sanitize_params() ) ) {
			echo 'Cannot Clean Parameters' . PHP_EOL;
			$retry_count++;
			continue;
		}
		
		$request_params = $request->get_params();
		
		if ( empty( $request_params )) {
			echo 'Failed. No Post Arguments added' . PHP_EOL;
			$retry_count++;
			continue;
		}

		if ( is_wp_error( wp_insert_post( $request_params, true ) ) ) {
			echo 'Cannot Add Post' . PHP_EOL;
			$retry_count++;
			continue;
		}
		
		return 'Successfully Added a new Post';
	}
}

function wp_register_rest_field() {
	
	$args_token = array(
		'object_subtype' => 'katana',
		'type' 		     => 'string',
		'description'    => 'Meta for Katana Post Token',
		'single'         => true,
		'show_in_rest'   => true
	);
	
	$args_referrer = array(
		'type' 		   => 'string',
		'description'  => 'Meta for Katana Referrer Url',
		'single'       => true,
		'show_in_rest' => true
	);
	
	if ( !register_meta( 'post', 'katana_post_token', $args_token ) ) { return 'failed to register meta named katana_post_token'; }
	
	if ( !register_meta( 'post', 'katana_referrer_url', $args_referrer ) ) { return 'failed to register meta named katana_referrer_url'; }
}