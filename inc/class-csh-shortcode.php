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
     * wrap the shortcode with in image - [shape]image [/shape]
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
    public function shape( $atts = [], $content = 'null', $shortcode = '') {

        /**
         * 
         * @param int id - image id - based on this get the image path
         * @param string url  - image url - shape can be given using image id or direct url
         * @param string float - float - left or right - default to left
         * @param string margin - set shape-margin 
         * 
         * in this shorcode width, height is not needed, 
         * as this shortcode wrap to already exist/ seteled image with widht, height
         * 
         * @var img_id  - declare with shortcode attribute id to this variable
         * @var \float  - decalre with shortcode attribute float to this variable
         * @var margin  - declare with shortcode attribute margin value
         * @var url     - decalre with shortcode attribute url value
         * 
         * @var url_id  - get image url based on given img id
         * @var shape_outside  - css shape-outside value - here given image url
         *                       works well if it is a transparent image, svg
         * @var float_class  - if float given is right - add csh-right - image flow to right
         *                     if left - add csh-left - default one - img flow to left
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


    /**
     * use shortcode to add img, shape
     * e.g. - [shape_img id=57] -  id - is image id.
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - htm with img , insine styles with shape properties
     */
    public function shape_img( $atts = [], $content = 'null', $shortcode = '') {
        
    /**
     * 
     * @param int $id - image id - based on this get the image path
     * @param string $url  - image url - shape can be given using image id or direct url
     * @param string $float - float - left or right - default to left
     * @param string $margin - set shape-margin
     * @param string $width - widht of image - suffix with css units - px, em ..
     * @param string $height - height of image - suffix with css units - px, em ..
     * 
     * @var $img_id  - declare with shortcode attribute id to this variable
     * @var $\float  - decalre with shortcode attribute float to this variable
     * @var $margin  - declare with shortcode attribute margin value
     * @var $url     - decalre with shortcode attribute url value
     * @var $width  - declare with shortcode attribute width value
     * @var $height  - declare with shortcode attribute height value
     * 
     * @var $url_id  - get image url based on given img id
     * @var s$hape_outside  - css shape-outside value - here given image url
     *                       works well if it is a transparent image, svg
     * @var $float_class  - if float given is right - add class csh-right - image flow to right
     *                     if left - add class csh-left - default one - img flow to left
     */
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'margin' => '1em',
                'width' => null,
                'height' => null,
            ), $atts, $shortcode );
            // use like -  '.$a["title"].'   
        
        $img_id = $a["id"];
        $float = $a["float"];
        $margin = $a["margin"];
        $width = $a["width"];
        $height = $a["height"];
        
        $url_id =  wp_get_attachment_url( $img_id );

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        $shape_outside = "url($url_id)";
        
        /**
         * there is a problem if pass this way - with suffix for - svg images ..
         * return like this - <img width="1" height="1"  --  1 * 1 - its not displaying ..
         * instead added styles using style attributes
         */
        // $array_size = array( $width, $height );

      
        $array_attr = array(
            'class' => ' '.$float_class.' ',
            // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
            'style' => 'width: '.$width.'; height: '.$height.'; shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.'; ',
        );


        $o = '';
        // $o .= ' '. wp_get_attachment_image( $img_id, $array_size, '', $array_attr ).' ';
        $o .= ' '. wp_get_attachment_image( $img_id, '', '', $array_attr ).' '; 
        $o .= '';
        $o .= '';

        return $o;
    }



    //  Register shortcode
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shape' ) );
        add_shortcode('shape_img', array( $this, 'shape_img' ) );
    }

}

endif; // END class_exists check