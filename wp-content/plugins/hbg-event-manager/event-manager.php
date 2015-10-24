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
	
	$import_folders = array("include", "class", "controller");
	
	if(!empty( $import_folders) && is_array( $import_folders ) ) {
		foreach( $import_folders as $folder ) {
			foreach (glob("*.php") as $filename) {
				include './lib/'.$folder."/".$filename; 
			}
		}
	}