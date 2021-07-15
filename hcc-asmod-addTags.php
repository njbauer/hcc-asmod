<?php

function hccasmod_add_tags() {
	register_taxonomy_for_object_type( 'post_tag' , 'sermons');
}
add_action ('init' , 'hccasmod_add_tags');