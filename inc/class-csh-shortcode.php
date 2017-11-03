<?php
/**
 * 
 * 
 */

class CSH_Shortcode {

    public function shortcode( $atts = [], $content = 'null', $shortcode = '') {

        $a = shortcode_atts(
            array(
                'id' => 'default-one',
            ), $atts, $shortcode );
           // use like -  '.$a["title"].'   
        
        $id = $a["id"];

        $url =  wp_get_attachment_url( $id );

        $o = '';
        $o .= '<div class="csh-left csh-margin" style="shape-outside: url('.$url.'); " >';
        $o .= $content;
        $o .= '</div >';
        
        return $o;
    }


    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shortcode' ) );
    }

}