<?php
/*
Plugin Name: OB Rewrite
Plugin URI: http://localhost/wp-content/mu-plugins/ngrok.php
Description: Find every instance of <code>localhost</code> and rewrite it to the ngrok host.
Version: 1.0.0
Author: Cody Ogden
Author URI: https://codyogden.com
Text Domain: ngrok-rewrite
*/

// Run a replace on all output
add_action( 'wp_loaded', function(){
	if(
		isset( $_SERVER['HTTP_X_ORIGINAL_HOST'] ) &&
		$_SERVER['HTTP_X_ORIGINAL_HOST'] !== "localhost"
	)
	{
		ob_start( function ( $string ) {
			return  preg_replace( '/(localhost)(\/)?/mi', $_SERVER['HTTP_X_ORIGINAL_HOST'] . '/', $string );
		});
	}
});
