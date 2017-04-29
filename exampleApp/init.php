<?php
/*
Plugin Name: Full Throttle - exampleApp
Description: Plugin for exampleApp toolbar
Version: 1.0
Author: Stream Companies
Author URI: 
*/

add_action( 'wp_enqueue_scripts', 'example_app_scripts' );
add_action( 'admin_enqueue_scripts', 'example_app_scripts' );
add_action( 'admin_enqueue_scripts', 'example_app_admin_scripts' );

$table_name = $wpdb->prefix . "exampleApp";
 
// function to create the DB / Options / Defaults					
function exampleApp_db_init() {
   	global $wpdb;
  	global $table_name;
 
	// create the ECPT metabox database table
	$sql = "CREATE TABLE " . $table_name . " (
	`id` mediumint(9) NOT NULL AUTO_INCREMENT,
	`field_1` mediumtext NOT NULL,
	`field_2` tinytext NOT NULL,
	`field_3` tinytext NOT NULL
	UNIQUE KEY id (id)
	);";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql); 
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'exampleApp_db_init');
//hook called function(s)
function example_app_scripts() {
//    wp_enqueue_script( '$handle', 'src', array( 'dependencies' ), null, inFooter(boolean)false );
    wp_enqueue_style( 'exampleApp-styles', plugins_url( '/style.css', __FILE__ ), NULL, filemtime(plugins_url( '/style.css')));
    wp_enqueue_script('exampleApp-js', plugins_url( '/js/exampleApp-frontend.js', __FILE__ ), NULL, filemtime(plugins_url( '/js/exampleApp-frontend.js')), array('jquery', 'jquery-ui', 'details-pack'), null, true);
}
function example_app_admin_scripts() {
    wp_enqueue_script('exampleApp-admin-js', plugins_url( '/admin/admin.js', __FILE__ ), NULL, filemtime(plugins_url( '/admin/admin.js')), array('jquery', 'jquery-ui', 'details-pack'), null, true);
}

//menu items
add_action('admin_menu','exampleApp_modifymenu');
function exampleApp_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('exampleApp', //page title
	'exampleApp', //menu title
	'manage_options', //capabilities
	'exampleApp_list', //menu slug
	'exampleApp_list' //function
	);
	
	//this is a submenu
	add_submenu_page('exampleApp_list', //parent slug
	'Add New exampleApp', //page title
	'Add New', //menu title
	'manage_options', //capability
	'exampleApp_create', //menu slug
	'exampleApp_create'); //function

	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update exampleApp', //page title
	'Update', //menu title
	'manage_options', //capability
	'exampleApp_update', //menu slug
	'exampleApp_update'); //function
	
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'exampleApp-list.php');
require_once(ROOTDIR . 'exampleApp-create.php');
require_once(ROOTDIR . 'exampleApp-update.php');

?>