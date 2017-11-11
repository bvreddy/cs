<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_Admin' ) ) :
    
class CSH_Admin {


    // add menu
    public function csh_options_page() {
        add_menu_page(
            'WordPress CSS Shapes - Settings Page',
            'WP CSS Shapes',
            'manage_options',
            'wp-css-shapes',
            array( $this, 'settings_page' ),
            'dashicons-format-chat'
        );
    }


    // setting page
    public function settings_page() {
        
        if ( ! current_user_can('manage_options') ) {
            return;
        }

        require_once('settings_page.php'); 
    }


    public function csh_custom_settings() {

        register_setting( 'csh_settings_group', 'csh_options' , 'csh_options_sanitize' );
        
        add_settings_section( 'csh_settings', '', array( $this, 'csh_settings_section_cb' ), 'csh_options_settings' );
        
        add_settings_field( 'csh_enable_svg', 'Enable SVG images upload', array( $this, 'csh_svg_enable_cb' ), 'csh_options_settings', 'csh_settings' );

    }

    // heading
    function csh_settings_section_cb() {
        echo '<h1>WP CSS Shapes - Settings</h1>';
    }
    

    public function csh_svg_enable_cb() {

        $csh_svg_enable = get_option('csh_options');
        
        if ( isset( $csh_svg_enable['svg_enable'] ) ) {
        ?>
            <input type="checkbox" name="csh_options[svg_enable]" checked value="1" id="">
            <!-- <input type="checkbox" name="csh_options[svg_enable]" <?php //checked( $csh_svg_enable['svg_enable'], 1 ); ?> value="1" id=""> -->
            enabled
        <?php
        } else {
        ?>
            <input type="checkbox" name="csh_options[svg_enable]" id="">
        <?php
        }
        ?>
        <p class="description">checkmark to Enable SVG Images upload - <a href="#">moreinfo</a> </p>
        <?php
    }






    /**
     * Sanitize callback
     *
     * @param 
     * @return
     */
    public function csh_options_sanitize( $input ) {

        // if ( ! current_user_can( 'manage_options' ) ) {
        //     wp_die( 'not allowed to modify - please contact admin ' );
        // }

        // $new_input = array();

        // if( isset( $input['enable'] ) )
        // $new_input['enable'] = sanitize_text_field( $input['enable'] );

        // return $new_input;
    }














}
    
    

    
    
    endif; // END class_exists check