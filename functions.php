<?php 

$GLOBALS['THEME_NAME'] = 'cso-master-child-st-bedes-chisholm';
$GLOBALS['CHILD_THEME_COLORS'] = array(
	'white' => 'ffffff',
	'black' => '000000',
	'primary-dark' => '3e3e63',
	'primary-light' => 'fdb515',
	'secondary-dark' => '548eb0',
	'secondary-light' => 'd9e3eb',
	'warning' => 'E31E39',
	'success' => '2DC98D'
);


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
    // get the parent object
    $parent_theme = wp_get_theme()->parent();
    // get parent version
    $csomaster_version = '0.1';
    if (!empty($parent_theme)) $csomaster_version = $parent_theme->Version;

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css?v='.$csomaster_version );
}

/* Default brand colors for MCE color picker */
function csomaster_mce4_options($init) {

	// Loop through THEME_COLORS and add them to the MCE color picker
	$THEME_COLORS = $GLOBALS['CHILD_THEME_COLORS'];

	$custom_colours = "";

	foreach($THEME_COLORS as $name => $hex) {
		$custom_colours .= "'$hex',' $name',";
	}

    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
    $init['textcolor_rows'] = 1;

    return $init;
}
add_filter('tiny_mce_before_init', 'csomaster_mce4_options');


require get_stylesheet_directory() . '/inc/child-settings.php';
require get_stylesheet_directory() . '/inc/child-updater.php';


$update_key = get_option('update_key', 'csomasterchild_updates_key');

$updater = new CatholicSchoolsMN_Theme_Updater( __FILE__ );
$updater->set_logging(false);

if( $update_key ) {
    $updater->authorize($update_key);    
}

$updater->set_username( 'BeechAgency' );
$updater->set_repository( $GLOBALS['THEME_NAME'] );
$updater->set_theme( $GLOBALS['THEME_NAME'] ); 

/**
 * Call the updater and initialize it.
 */
$updater->initialize();