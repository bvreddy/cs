<?php
/**
 * 
 * @package csh
 * @subpackage Administration
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;


require_once('class-csh-admin.php');




$admin = new CSH_Admin();
add_action('admin_menu',  array( $admin, 'csh_options_page') );
add_action( 'admin_init', array( $admin, 'csh_custom_settings' ) );