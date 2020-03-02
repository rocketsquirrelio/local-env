<?php
/**
 * Default Content
 * 
 * This will override the WordPress default content generation.
 * 
 * Reference: https://developer.wordpress.org/reference/functions/wp_install_defaults/
 */

function wp_install_defaults() {

	$do_not_activate = array(
		'akismet/akismet.php',
		'hello.php',
	);

	$plugins = get_plugins();
	foreach( $do_not_activate as $plugin_slug ):
		unset( $plugins[$plugin_slug] );
	endforeach;
	

	foreach( $plugins as $plugin_slug => $plugin_details ) {
		activate_plugin( $plugin_slug );
	}
}
