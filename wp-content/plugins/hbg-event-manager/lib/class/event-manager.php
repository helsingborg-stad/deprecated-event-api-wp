<?php

	//Set namespace	
	namespace Helsingborg\EventManager;
	
	//Block external access 
	if(!defined("ABSPATH")) {die("nope");}
	
	
	Class HbgEventManager {
		
		public function __construct() {
			 add_action('init', '\Helsingborg\EventManager\HbgEventManager::register_cpt');
		}
	
		public static function register_cpt () {
		
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
				'menu_position'      => 10,
				'supports'           => array( 'title', 'editor', 'author' )
			);
		
			register_post_type( 'event', $args );	
			
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
	