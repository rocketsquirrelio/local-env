<?php
/*
Plugin Name: MailHog Email Catcher
Plugin URI: http://localhost/wp-content/mu-plugins/mailhog.php
Description: MailHog development email catcher.
Version: 1.0.0
Author: Cody Ogden
Author URI: https://codyogden.com
Text Domain: mailhog-catcher
*/
add_action( 'phpmailer_init', 'setup' );
function setup( PHPMailer $phpmailer ) {
    $phpmailer->Host = 'mailhog';
    $phpmailer->Port = 1025;
    $phpmailer->IsSMTP();
}
