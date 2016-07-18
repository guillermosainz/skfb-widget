<?php
/**
 * @package Sketchfab Widget
 * @version 1.0
 */
/*
Plugin Name: Sketchfab Widget
Plugin URI: https://www.sketchfab.com/
Description: This widget adds a Simple Sketchfab Profile Widget into your WordPress website sidebar within few minutes.
Author: Guillermo Sainz
Version: 1.0
Author URI: https://sketchfab.com/guillermosainz
Text Domain: sketchfab-profile-widget
*/
function skfbwidget_activate() {}
register_activation_hook( __FILE__, 'skfbwidget_activate' );

function skfbwidget_deactivate() {
        delete_option( 'widget_skfbw_id' );
        unregister_sidebar( 'sketchfab_widget' );
        global $current_user;
        $user_id = $current_user->ID;
        delete_user_meta($user_id,'skfb_ignore_notice');
}
register_deactivation_hook( __FILE__, 'skfbwidget_deactivate' );

function LoadSkfbtextDomain() {
    load_plugin_textdomain( 'sketchfab-profile-widget',false, basename( dirname( __FILE__ ) ) );
}
add_action( 'init', 'LoadSkfbtextDomain' );

$widget_sketchfab_widget = get_option('widget_fbw_id');

if(empty($widget_sketchfab_widget)) {
	add_action('admin_notices', 'skfb_admin_notice');
}

function skfb_admin_notice() {
	global $current_user ;
    $user_id 	=	$current_user->ID;
	if ( ! get_user_meta($user_id, 'skfb_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
            printf(__( 'Please configure your awesome Sketchfab widget <a href="widgets.php">here</a> | <a href="%1$s">Hide Notice</a>'), '?skfb_nag_ignore=0', 'sketchfab-profile-widget' );
        echo "</p></div>";
	}
}

add_action('admin_init', 'skfb_nag_ignore');
function skfb_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['skfb_nag_ignore']) && '0' == $_GET['skfb_nag_ignore'] ) {
             add_user_meta($user_id, 'skfb_ignore_notice', 'true', true);
	}
}

if(!defined('SKFB_WIDGET_PLUGIN_URL'))
	define('SKFB_WIDGET_PLUGIN_URL', plugin_dir_url( __FILE__ ));

if(!defined('SKFB_WIDGET_PLUGIN_BASE_URL'))
	define('SKFB_WIDGET_PLUGIN_BASE_URL',dirname( __FILE__ ));

require_once(SKFB_WIDGET_PLUGIN_BASE_URL.'/skfb_class.php');
require_once(SKFB_WIDGET_PLUGIN_BASE_URL.'/short_code.php');
?>