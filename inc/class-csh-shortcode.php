<?php
/**
 * 
 * 
 */

class CSH_Shortcode {

    public function shortcode( $atts = [], $content = null, $shortcode = '') {
        return 'hello';
    }


    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shortcode' ) );
    }

}