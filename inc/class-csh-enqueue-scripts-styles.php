<?php
/**
 * 
 */

class CSH_Enqueue_Scripts_Sytles {


    public static function enqueue() {

        wp_enqueue_style( 'csh_styles', plugins_url( 'assets/css/main.css', CSH_PLUGIN_FILE ), '', CSH_VERSION );

        // wp_enqueue_script( 'csh_polyfill', plugins_url( 'assets/js/shapes-polyfill.js', CSH_PLUGIN_FILE ), '', true );
    }


}