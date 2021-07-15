<?php

//Register Global Variables for Location Label
$hccasmod_location_label = get_option( 'hccasmod_general_location_label');
	if (!empty( $hccasmod_location_label)) {
		$hccasmod_location_label = $hccasmod_location_label;
		$hccasmod_location_label = strtolower("$hccasmod_location_label");
	}
	else {
		$hccasmod_location_label = 'Location';
		$hccasmod_location_slug = strtolower('locations');
	}
	global $hccasmod_location_label, $hccasmod_location_slug;




//Register Location Options
function hccasmod_register_options() {
	register_setting( 'asp-archive-settings', 'hccasmod_location_dropdown_orderby');
	register_setting( 'asp-archive-settings', 'hccasmod_location_dropdown_order');
	register_setting( 'asp-general-settings', 'hccasmod_archive_hide_filter_location');
	register_setting( 'asp-general-settings', 'hccasmod_general_location_label');
}
add_action( 'admin_init' , 'hccasmod_register_options');





//Dynamically populate location data into sermon archive filter
function hccasmod_filter_terms_dropdown_location($taxonomies , $args) {
	global $hccasmod_location_label;
	$hccasmod_location_terms = get_terms($taxonomies , $args);
	//var_dump($hccasmod_location_terms);
	if (!empty($hccasmod_location_terms)) {
		echo "<select name='locations' class='hccasmod-filter-location'>";
		echo '<option value="">' . __("All", "advanced-sermons") . " " . "Locations" . '</option>';
		foreach( $hccasmod_location_terms as $term) {
			$root_url = get_bloginfo('url');
			$term_taxonomy = $term->taxonomy;
			$term_slug = $term->slug;
			$term_name = $term->name;
			$link = $term_slug;
			if (!empty( $_GET['location'])) {
				echo "<option " . selected($_GET['location'], $link)." value='$link'>$term_name</option>";
			}
			else {
				echo "<option value='$link'>$term_name</option>";
			}

		}
		echo "</select>";
	}

}



//Add location to the sermon archive & filter bar
function hccasmod_archive_filter_location() {

		$hccasmod_location_orderby = get_option( 'hccasmod_location_dropdown_orderby' );
		if ( !empty( $hccasmod_location_orderby ) ) { $hccasmod_location_orderby = $hccasmod_location_orderby; } else { $hccasmod_location_orderby = 'name'; }
		$hccasmod_location_order = get_option( 'hccasmod_location_dropdown_orderby' );
		if ( !empty( $hccasmod_location_order ) ) { $ahccasmod_location_order = $hccasmod_location_order; } else { $hccasmod_location_order = 'ASC'; }

		$hccasmod_hide_filter_location = get_option( 'hccasmod_archive_hide_filter_location' );
		global $hccasmod_filter_orderby, $hccasmod_filter_order;
		if (empty($hccasmod_hide_filter_location)) {
		    $taxonomies = array( 'locations' );
		    $args = array( "orderby" => "$hccasmod_location_orderby", "hide_empty" => true, "order" => "$hccasmod_location_order" );
		    $select = hccasmod_filter_terms_dropdown_location($taxonomies, $args);
		    $select = preg_replace("#<select([^>]*)>#", "<select$1>", $select);
		    echo $select;
		}

}
add_action( 'asp_hook_filter_bar_fields' , 'hccasmod_archive_filter_location' );





//Archive Filter Critera Box for location
function hccasmod_filter_critera_box() {
	global $post, $hccasmod_location_label;
	$hccasmod_hide_filtering = get_option('asp_archive_hide_filtering');
	$hccasmod_hide_criteria_box = get_option('asp_archive_hide_criteria_box');

	if (!empty( $_GET['location'] )) {
		$selected_location = $_GET['location'];

		echo("Selected Location");
		var_dump($selected_location);

		$selected_location_slug = get_term_by('slug', "$selected_location", 'location');

		echo("Selected Location Slug");
		var_dump($selected_location_slug);

		$selected_location_name = $selected_location_slug->name;

		echo("Selected Location Name");
		var_dump($selected_location_name);
	}

	if (empty( $hccasmod_hide_filtering) && empty($hccasmod_hide_criteria_box)) {
		if( isset( $selected_location_name)) { ?>
			<div class="asp-critera-box">
				<p class="asp-selected-location"><?php _e( 'Filtered by' , 'advanced-sermons'); ?>:</p>
				<?php if(isset($selected_location_name)) { ?>
					<p class='selected-location'><?php _e( "$hccasmod_location_label", "advanced-sermons");
					?>: <?php _e("$selected_location_name", "advanced-sermons"); ?></p><?php
				}?>
			</div>
		<?php }
	}

}

add_action ('asp_hook_filter_critera_box' , 'hccasmod_filter_critera_box');