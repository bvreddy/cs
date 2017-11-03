<?php


class CSH_images {

    /**
     * add mime types
     * @action upload_mimes
     * @param Current array of mime types
     * @return Updated array of mime types
     */
    public static function add_mime_types( $mimes ) {

        // New allowed mime types.
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';

        return $mimes;
    }


}