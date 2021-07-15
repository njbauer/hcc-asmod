<?php
//Create location taxonomy
function register_location_taxonomy() {
	$labels = array(
		"name" => __( "Locations" , "taxonomy general name" ),
		"singular_name" => __( "Location" , "taxonomy single name" ),
		"search_items" => __( "Search Locations" ),
		"all_items" => __( "All Locations" ),
		"edit_item" => __( "Edit Location" ),
		"udpate_item" => __( "Update Location" ),
		"add_new" => __( "Add New Location"),
		"add_new_item" => __( "Add New Location" ),
		"new_item_name" => __( "New Location Name" ),
		"menu_name" => __( "Locations" ),
		"view_item" => __("View location"),
		"back_to_items" => __("Back to locations"),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'has_archive' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
	);

	register_taxonomy( 'locations', array("sermons") , $args );
}
add_action( 'init' , 'register_location_taxonomy' );