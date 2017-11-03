<?php




$x = wp_get_attachment_url( 57 );

$y = wp_get_attachment_image( 57 );


$z = wp_get_attachment_link( 42 );

$images = get_children( 'post_type=attachment&post_mime_type=image' );

// echo '<pre>';
// var_dump( $x );
// echo '</pre>';

