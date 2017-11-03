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
                'float' => 'left',
            ), $atts, $shortcode );
           // use like -  '.$a["title"].'   
        
        $id = $a["id"];
        $float = $a["float"];

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        $url =  wp_get_attachment_url( $id );

        $o = '';
        $o .= '<div class=" '.$float_class.' csh-margin" style="shape-outside: url('.$url.'); " >';
        $o .= $content;
        $o .= '</div >';
        
        // $i = wp_get_attachment_image( $id );
        // return $i;

        return $o;
    }


    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shortcode' ) );
    }

}