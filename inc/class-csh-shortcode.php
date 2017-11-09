<?php
/**
 * class - creates shorcodes
 * two shorcodes created
 *  shape  - give img id - based on that it created shape
 *  shape_img  - just give img id - it adds image, creates shape 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_Shortcode' ) ) :

 class CSH_Shortcode {



    /**
     * use shortcode to add img, shape
     * e.g. - [shape id=57] -  id - is image id.
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - html code with img tag, 
     *           inline styles with shape-outside, float, shape-margin properties
     */
    public function shape( $atts = [], $content = 'null', $shortcode = '') {
        
    /**
     * @array key values 
     * @key int id - image id - based on this get the image path
     * @key string url  - image url - shape can be given using image id or direct url
     * @key string float - float - left or right - default to left
     * @key string margin - set shape-margin
     * @key string width - widht of image - suffix with css units - px, em ..
     * @key string height - height of image - suffix with css units - px, em ..
     * @key string shape - declare image shape - 
     *                      polygon, circle, eclipse, inset ..
     * @key boolean clip  - default false - dont clip the image,
     *                      if true of anything clip the image @uses shape value
     * 
     * @var $img_id  - declare with shortcode attribute id to this variable
     * @var $\float  - decalre with shortcode attribute float to this variable
     * @var $margin  - declare with shortcode attribute margin value
     * @var $url     - decalre with shortcode attribute url value
     * @var $width  - declare with shortcode attribute width value
     * @var $height  - declare with shortcode attribute height value
     * @var $shape  - declare with shortcode attribute shape value
     * @var $clip  - declare with shorcode attribute clip value - true or false
     * 
     * @var $url_id  - get image url based on given img id
     * @var $custom_shape  - css shape-outside value - here given image url
     *                       works well if it is a transparent image, svg
     * @var $float_class  - if float given is right - add class csh-right - image flow to right
     *                     if left - add class csh-left - default one - img flow to left
     * @var $clip_path  - if true clip the image by using $custom_shape
     */
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'margin' => '1em',
                'width' => null,
                'height' => null,
                'class' => '',
                'shape' => '',
                'clip' => false,
            ), $atts, $shortcode );
            // use like -  '.$a["id"].'   
        
        $img_id = $a["id"];
        $float = $a["float"];
        $margin = $a["margin"];
        $width = $a["width"];
        $height = $a["height"];
        $class = $a["class"];
        $custom_shape = $a["shape"];
        $clip = $a["clip"];
        
        $url_id =  wp_get_attachment_url( $img_id );

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        
        /**
         * there is a problem if width, height pass in this way - with suffix for - svg images
         * return like this - <img width="1" height="1"  --  1 * 1 - its not displaying
         * instead added styles using style attributes
         * 
         * @see https://core.trac.wordpress.org/ticket/26256
         */
        // $array_size = array( $width, $height );

      
        $class .= " shape csh-image wp-image-$img_id";
        $class .= " $float_class";

        if ( '' == $custom_shape || null == $custom_shape ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = $custom_shape;
        }

        if ( false == $clip ) {
            $clip_path = '';
        } else {
            $clip_path = $custom_shape;
        }


        $array_attr = array(
            'class' => ' '.$class.' ',
            // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
            'style' => 'width: '.$width.'; height: '.$height.'; shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.'; clip-path: '.$clip_path.' ',
        );


        $o = '';
        // $o .= ' '. wp_get_attachment_image( $img_id, $array_size, '', $array_attr ).' ';
        $o .= ' '. wp_get_attachment_image( $img_id, '', '', $array_attr ).' '; 
        $o .= '';
        $o .= '';

        return $o;
    }



    /**
     * 
     * wrap the shortcode with in image - [shape_svg]image [/shape_svg]
     * 
     * for svg, transparent images it good.. 
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - html content with inline css - which return image, shape 
     */
    public function shape_svg( $atts = [], $content = 'null', $shortcode = '') {
        
        /**
         * 
         * @param int id - image id - based on this get the image path
         * @param string url  - image url - shape can be given using image id or direct url
         * @param string float - float - left or right - default to left
         * @param string margin - set shape-margin
         * @param string class  - to add class names
         * 
         * in this shorcode width, height is not needed, 
         * as this shortcode wrap to already exist/ seteled image with widht, height
         * 
         * @var $img_id  - declare with shortcode attribute id to this variable
         * @var $\float  - decalre with shortcode attribute float to this variable
         * @var $margin  - declare with shortcode attribute margin value
         * @var $url     - decalre with shortcode attribute url value
         * @var $class     - decalre with shortcode attribute class value
         * 
         * @var $url_id  - get image url based on given img id
         * @var $shape_outside  - css shape-outside value - here given image url
         *                       works well if it is a transparent image, svg
         * @var $float_class  - if float given is right - add csh-right - image flow to right
         *                     if left - add csh-left - default one - img flow to left
         * @var $class  - add class names - img-80, img-90 - to make maxwidth to the image parent
         */
        $a = shortcode_atts(
            array(
                'id' => '',
                'url' => '',
                'float' => 'left',
                'margin' => '1em',
                'class' => '',
            ), $atts, $shortcode );
            // use like -  '.$a["title"].'   
        
        $img_id = $a["id"];
        $float = $a["float"];
        $margin = $a["margin"];
        $url = $a["url"];
        $class = $a["class"];
        
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
        $o .= '<span class=" '.$float_class.' '.$class.' shape" style="shape-outside: '.$shape_outside.'; shape-margin: '.$margin.' " >';
        $o .= $content;
        $o .= '</span>';
        
        return $o;
    }

            

    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shape' ) );
        add_shortcode('shape_svg', array( $this, 'shape_svg' ) );
    }

}

endif; // END class_exists check