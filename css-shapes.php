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
 * 
 * csh - simply called for CssSHapes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'CSH_VERSION', '0.1' );
define( 'CSH_WP_MIN_VERSION', '3.1.0' );
define( 'CSH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CSH_PLUGIN_FILE', __FILE__ );

// include in admin and public pages ( non-admin )
require_once('inc/class-csh-register.php');
require_once('admin/class-csh-images.php');
require_once('inc/class-csh-shortcode.php');


/**
 * is_admin - include file to admin area - only if it is_admin
 * else - include files to non-admin area 
 */
if ( is_admin() ) {

} else {
    require_once('inc/class-csh-enqueue-scripts-styles.php');

}

/**
 * Register hooks - when plugin activate, deactivate, uninstall
 * commented deactivation, uninstall hook - its not needed as now
 */
register_activation_hook( __FILE__, array( 'CSH_Register', 'activate' )  );
// register_deactivation_hook( __FILE__, array( 'CSH_Register', 'deactivate' )  );
// register_uninstall_hook(__FILE__, array( 'CSH_Register', 'uninstall' ) );

// when plugin updated - check version diff
add_action('plugins_loaded', array( 'CSH_Register', 'plugin_update' ) );

// add mimes types - add support for svg upload
add_filter( 'upload_mimes', array( 'CSH_images', 'add_mime_types' ) );

// Enqueue Styles, Scripts for non-admin area
add_action('wp_enqueue_scripts', array( 'CSH_Enqueue_Scripts_Sytles', 'enqueue' ) );


$shortcode = new CSH_Shortcode();

// Register shorcodes
add_action('init', array( $shortcode, 'csh_shortcodes_init' ) );