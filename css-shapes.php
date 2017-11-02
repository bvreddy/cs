<?php
/*
Plugin Name: CSS Shapes
Plugin URI:  https://wordpress.org/plugins/
Description: CSS Shapes
Version:     0.1
Author:      Venkat
Author URI:  https://venkat.club/shapes
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: csh_text
*/

/**
 * WordPress CSS Shapes 
 * @package csh
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'CSH_VERSION', '0.1' );
define( 'CSH_WP_MIN_VERSION', '3.1.0' );
define( 'CSH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CSH_PLUGIN_FILE', __FILE__ );

// include in admin and public pages
require_once('inc/class-csh-register.php');
require_once('admin/class-csh-images.php');


if ( is_admin() ) {
    // include this in admin pages

} else {
    // include only in public pages ( not wp admin )
    require_once('inc/class-csh-enqueue-scripts-styles.php');

}


register_activation_hook( __FILE__, array( 'CSH_Register', 'activate' )  );
// register_deactivation_hook( __FILE__, array( 'CSH_Register', 'deactivate' )  );
// register_uninstall_hook(__FILE__, array( 'CSH_Register', 'uninstall' ) );

// when plugin updated - check version diff
add_action('plugins_loaded', array( 'CSH_Register', 'plugin_update' ) );


// add mimes types - add support svg upload
add_filter( 'upload_mimes', array( 'CSH_images', 'add_mime_types' ) );

// CSH_enqueue_Scripts_Sytles
add_action('wp_enqueue_scripts', array( 'CSH_enqueue_Scripts_Sytles', 'enqueue' ) );
