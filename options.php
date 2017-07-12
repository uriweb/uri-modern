<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
 
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	// echo $themename;
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {
	
    // Global nav visibility 
    $globalnav_vis = array(
        'on' => 'Show',
        'off' => 'Hide'
    );
        
	$options = array();

/** HOMEPAGE OPTIONS **/


	$options[] = array(
		'name' => 'Site Setup',
		'type' => "heading"
	);

	$options[] = array(
        'name' => 'Global Navigation',
        'desc' => 'Choose whether to display the global navigation on this site.',
        'id' => 'urim_gnvis',
        'std' => 'on',
        'type' => 'radio',
        'options' => $globalnav_vis
    );
    
    return $options;
    
}