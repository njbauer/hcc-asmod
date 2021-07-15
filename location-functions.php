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
		"add_new_item" => __( "Add New Location" ),
		"new_item_name" => __( "New Location Name" ),
		"menu_name" => __( "Locations" ),
	);
	register_taxonomy( "locations", array( "locations" ) );
}

add_action( 'asp_hook_sermon_details_metabox_top', 'register_location_taxonomy');