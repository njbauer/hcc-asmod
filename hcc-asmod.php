<?php
/*
Plugin Name: Advanced Sermons Extension
Plugin URI:  http://link to your plugin homepage
Description: Extends the Advanced Sermons Plug-in by adding support to filter sermons by Location. Also activates tags for sermons.
Version:     0.8-alpha
Author:      Hope Community Church
Author URI:  https://hopecc.com
License:     GNU General Public License v.3
*/

//Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

//Call the function to add original tag taxonomy to sermons
require(plugin_dir_path(__FILE__) . 'hcc-asmod-addTags.php');

//Call the register location taxonomy file
require(plugin_dir_path(__FILE__) . 'hcc-asmod-register-location.php');

//Call the location taxonomy file
require (plugin_dir_path(__FILE__) . 'hcc-asmod-locations-taxonomy.php');

//Call the location grid view file
require(plugin_dir_path(__FILE__) . 'hcc-asmod-location-grid-view.php');