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
         * @param url  - image url - shape can be given using image id or direct url
         * 
         * @var url_id  - get image url based on id
         */
        $a = shortcode_atts(
            array(
                'id' => '',
                'url' => '',
                'float' => 'left',
                'margin' => '1em',
            ), $atts, $shortcode );
           // use like -  '.$a["title"].'   
        
        $img_id = $a["id"];
        $float = $a["float"];
        $margin = $a["margin"];
        $url = $a["url"];
        
        $url_id =  wp_get_attachment_url( $img_id );

        if ( '' == $url || null == $url ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = "url($url)";
        }

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }


        
        $o = '';
        $o .= '<span class=" '.$float_class.' shape " style="shape-outside: '.$shape_outside.'; shape-margin: '.$margin.' " >';
        $o .= $content;
        $o .= '</span>';
        
        return $o;
    }






    // directly adding images..
    public function img( $atts = [], $content = 'null', $shortcode = '') {
        
        $a = shortcode_atts(
            array(
                'id' => '',
                'url' => '',
                'float' => 'left',
                'shape-outside' => '',
                'margin' => '1em',
                'width' => null,
                'height' => null,
            ), $atts, $shortcode );
            // use like -  '.$a["title"].'   
        
        $img_id = $a["id"];
        $float = $a["float"];
        $shape = $a["shape-outside"];
        $margin = $a["margin"];
        $width = $a["width"];
        $height = $a["height"];
        
        $url_id =  wp_get_attachment_url( $img_id );

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        if ( '' == $url || null == $url ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = "url($url)";
        }
        
        // if( null == $shape || '' == $shape ) {
        //     $shape_outside = "url($url_id)";
        // } else {
        //     $shape_outside = $shape;
        // }

        

        // polygon(39% 0%, 87% 72%, 86% 99%, 100% 100%, 100% 0%);
        
        // $o = '';
        // $o .= '<img src=" '.$url_id.' ">';
        // $o .= '';
        

        // there is a problem if pass this type - with suffix for - svg images ..
        // return like this - <img width="1" height="1"  --  1 * 1 - its not displaying ..
        $array_size = array( $width, $height );

      
        $array_attr = array(
            'class' => ' '.$float_class.' ',
            // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
            'style' => 'width: '.$width.'; height: '.$height.'; shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.'; ',
        );


        $i = '';
        // $i .= ' '. wp_get_attachment_image( $img_id, $array_size, '', $array_attr ).' ';
        $i .= ' '. wp_get_attachment_image( $img_id, '', '', $array_attr ).' '; 
        $i .= '';
        $i .= '';



        return $i;
        // return $o;
    }







    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shortcode' ) );
        add_shortcode('img', array( $this, 'img' ) );
    }

}