<?php
//Display location in grid view
function hccasmod_location_grid_view() {
	global $post, $asp_archive_slug;
	$hccasmod_location = wp_get_post_terms($post->ID, 'locations', array("fields" => "names"));
	$hccasmod_location_slug = wp_get_post_terms($post->ID, 'locations', array("fields" => "slugs"));

	if (isset($hccasmod_location[0])) { ?><div class='sermon-book'><p><?php _e( 'Location:', 'advanced-sermons'); ?> <a href='<?php echo get_home_url(); ?>/<?php echo $asp_archive_slug ?>/?location=<?php echo $hccasmod_location_slug[0]?>'><?php print_r($hccasmod_location[0]); ?></a></p></div><?php }
}

add_action( 'asp_hook_sermon_archive_header_details' , 'hccasmod_location_grid_view' );