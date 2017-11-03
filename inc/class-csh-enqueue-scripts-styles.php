<?php
/**
 * 
 */

class CSH_Enqueue_Scripts_Sytles {


    public static function enqueue() {

        wp_enqueue_style( 'csh_styles', plugins_url( 'assets/css/main.css', CSH_PLUGIN_FILE ), '', CSH_VERSION );
    }


}