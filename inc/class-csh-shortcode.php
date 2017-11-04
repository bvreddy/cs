<?php
/**
 * 
 * 
 */

 class CSH_Shortcode {

    // for svg, transparent images it good.. 
    public function shortcode( $atts = [], $content = 'null', $shortcode = '') {

        /**
         * 
         * @param id - image id
         * @param shape-outside -  shape-outside value
         */
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'margin' => '1em',
            ), $atts, $shortcode );
           // use like -  '.$a["title"].'   
        
        $id = $a["id"];
        $float = $a["float"];
        $margin = $a["margin"];
        
        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        $url =  wp_get_attachment_url( $id );
        $shape_outside = "url($url)";

        
        $o = '';
        $o .= '<span class=" '.$float_class.' " style="shape-outside: '.$shape_outside.'; shape-margin: '.$margin.' " >';
        $o .= $content;
        $o .= '</span>';
        
        return $o;
    }






    // directly adding images..
    public function img( $atts = [], $content = 'null', $shortcode = '') {
        
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'shape' => '',
            ), $atts, $shortcode );
            // use like -  '.$a["title"].'   
        
        $id = $a["id"];
        $float = $a["float"];
        $shape = $a["shape"];
        

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        if( null == $shape || '' == $shape ) {
            $url =  wp_get_attachment_url( $id );
            $shape_outside = "url($url)";
        } else {
            $shape_outside = $shape;
        }

        



        // polygon(39% 0%, 87% 72%, 86% 99%, 100% 100%, 100% 0%);
        
        $o = '';
        $o .= '<img src=" '.$url.' ">';
        $o .= '';
        
        // $i = wp_get_attachment_image( $id );
        // return $i;

        return $o;
    }







    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shortcode' ) );
        add_shortcode('img', array( $this, 'img' ) );
    }

}