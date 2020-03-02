<?php
/*
Plugin Name: LiveReload
Plugin URI: https://localhost
Description: LiveReload listener.
Version: 0.0.0
Author: Cody Ogden
Author URI: https://codyogden.com
Text Domain: livereload-listener
*/


add_action('wp_enqueue_scripts', function(){
	wp_enqueue_script( 'livereload', '//localhost:35729/livereload.js?snipver=1', array(), false, true );
});
