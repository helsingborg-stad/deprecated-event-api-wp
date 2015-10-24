<?php 
	
	/*
	Plugin Name: Helsingborg Event Manager	
	Plugin URI:  https://github.com/helsingborg-stad/event-api-wp
	Description: Mange event
	Version:     0.1-alpha
	Author:      Helsingborgs stad
	Author URI:  https://github.com/helsingborg-stad/
	Text Domain: hbg-event-manager
	*/
	
	//Block external access
	if(!defined("ABSPATH")) {die("nope");}
	
	//Import configuration 

	//Import class
	require plugin_dir_path( __FILE__ ).'lib/class/event-manager.php'; 