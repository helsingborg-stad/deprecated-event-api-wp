<?php

	//Set namespace	
	namespace Helsingborg\EventManager;
	
	//Block external access 
	if(!defined("ABSPATH")) {die("nope");}
	
	
	Class HbgEventManager {
		
		public function __construct() {
			add_action('init', '\Helsingborg\EventManager\HbgEventManager::register_cpt_event');
			add_action('init', '\Helsingborg\EventManager\HbgEventManager::register_cpt_location');
			add_action('init', '\Helsingborg\EventManager\HbgEventManager::register_cpt_organisation');
		}
	
		public static function register_cpt_event () {
		
			$labels = array(
				'name'               => _x( 'Event', 'post type general name', 'hbg-event-manager' ),
				'singular_name'      => _x( 'Event', 'post type singular name', 'hbg-event-manager' ),
				'menu_name'          => _x( 'Events', 'admin menu', 'hbg-event-manager' ),
				'name_admin_bar'     => _x( 'Events', 'add new on admin bar', 'hbg-event-manager' ),
				'add_new'            => _x( 'Add New', 'book', 'hbg-event-manager' ),
				'add_new_item'       => __( 'Add New Event', 'hbg-event-manager' ),
				'new_item'           => __( 'New Event', 'hbg-event-manager' ),
				'edit_item'          => __( 'Edit Event', 'hbg-event-manager' ),
				'view_item'          => __( 'View Event', 'hbg-event-manager' ),
				'all_items'          => __( 'All Event', 'hbg-event-manager' ),
				'search_items'       => __( 'Search Events', 'hbg-event-manager' ),
				'parent_item_colon'  => __( 'Parent Events:', 'hbg-event-manager' ),
				'not_found'          => __( 'No event found.', 'hbg-event-manager' ),
				'not_found_in_trash' => __( 'No event found in Trash.', 'hbg-event-manager' )
			);
		
			$args = array(
				'labels'             => $labels,
		        'description'        => __( 'Custom post type for event', 'hbg-event-manager' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => __("event",'hbg-event-manager') ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 11,
				'supports'           => array( 'title', 'editor' )
			);
		
			register_post_type( 'event', $args );	
			
		}
		
		public static function register_cpt_location () {
		
			$labels = array(
				'name'               => _x( 'Location', 'post type general name', 'hbg-event-manager' ),
				'singular_name'      => _x( 'Location', 'post type singular name', 'hbg-event-manager' ),
				'menu_name'          => _x( 'Locations', 'admin menu', 'hbg-event-manager' ),
				'name_admin_bar'     => _x( 'Locations', 'add new on admin bar', 'hbg-event-manager' ),
				'add_new'            => _x( 'Add New', 'book', 'hbg-event-manager' ),
				'add_new_item'       => __( 'Add New Location', 'hbg-event-manager' ),
				'new_item'           => __( 'New Location', 'hbg-event-manager' ),
				'edit_item'          => __( 'Edit Location', 'hbg-event-manager' ),
				'view_item'          => __( 'View Location', 'hbg-event-manager' ),
				'all_items'          => __( 'All Location', 'hbg-event-manager' ),
				'search_items'       => __( 'Search Locations', 'hbg-event-manager' ),
				'parent_item_colon'  => __( 'Parent Locations:', 'hbg-event-manager' ),
				'not_found'          => __( 'No location found.', 'hbg-event-manager' ),
				'not_found_in_trash' => __( 'No location found in Trash.', 'hbg-event-manager' )
			);
		
			$args = array(
				'labels'             => $labels,
		        'description'        => __( 'Custom post type for event', 'hbg-event-manager' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => __("location",'hbg-event-manager') ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 15,
				'supports'           => array( 'title' )
			);
		
			register_post_type( 'location', $args );	
			
		}
		
		public static function register_cpt_organisation () {
		
			$labels = array(
				'name'               => _x( 'Organisation', 'post type general name', 'hbg-event-manager' ),
				'singular_name'      => _x( 'Organisation', 'post type singular name', 'hbg-event-manager' ),
				'menu_name'          => _x( 'Organisations', 'admin menu', 'hbg-event-manager' ),
				'name_admin_bar'     => _x( 'Organisations', 'add new on admin bar', 'hbg-event-manager' ),
				'add_new'            => _x( 'Add New', 'book', 'hbg-event-manager' ),
				'add_new_item'       => __( 'Add New Organisation', 'hbg-event-manager' ),
				'new_item'           => __( 'New Organisation', 'hbg-event-manager' ),
				'edit_item'          => __( 'Edit Organisation', 'hbg-event-manager' ),
				'view_item'          => __( 'View Organisation', 'hbg-event-manager' ),
				'all_items'          => __( 'All Organisations', 'hbg-event-manager' ),
				'search_items'       => __( 'Search Organisations', 'hbg-event-manager' ),
				'parent_item_colon'  => __( 'Parent Organisations:', 'hbg-event-manager' ),
				'not_found'          => __( 'No organisation found.', 'hbg-event-manager' ),
				'not_found_in_trash' => __( 'No organisation found in Trash.', 'hbg-event-manager' )
			);
		
			$args = array(
				'labels'             => $labels,
		        'description'        => __( 'Custom post type for event-organisations', 'hbg-event-manager' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => __("organisation",'hbg-event-manager') ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 12,
				'supports'           => array( 'title' )
			);
		
			register_post_type( 'organisation', $args );	
			
		}
		
		public function make_ping( $to, $post_id ) {
			
			//Validate id 
			if ( !is_numeric( $post_id ) || get_post_status( $post_id ) === false ) {
				return new WP_Error( 'broke', __( "Not a valid ping to value. Post dosent exists.", 'hbg-event-manager' ) );
			}
			
			//Ping urls 
			switch ($to) {
			    case "search":
			        $ping_url = get_option("event_manager_search_ping_url", ""); 
			        break;
			    default:
					return new WP_Error( 'broke', __( "Not a valid ping to value.", 'hbg-event-manager' ) );
			}
			
			//Validate url 
			if (!filter_var($ping_url, FILTER_VALIDATE_URL) === false) { 
				
				if ( !empty( parse_url($ping_url)['query'] ) ) {
					$delimiter = "?"; 
				} else {
					$delimiter = "&"; 
				}
				
				wp_remove_head($ping_url.$delimiter.$post_id, array(
					'timeout' 		=> 2, 
					'user-agent'	=> 'wp-event-manager/1.0'
				)); 
				
				
			} else {
				return new WP_Error( 'broke', __( "Not a valid ping url.", 'hbg-event-manager' ) );
			} 
			
		}
		
		public function __destruct() {
			
		}
		
	}
	
	new HbgEventManager; 
	