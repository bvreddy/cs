<?php

add_action('init', 'add_button');

function add_button() {
    if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
    {
      add_filter('mce_external_plugins', 'add_plugin');
      add_filter('mce_buttons', 'register_button');
    }
 }

 function register_button($buttons) {
    array_push($buttons, "quote");
    return $buttons;
 }


 function add_plugin($plugin_array) {
    $plugin_array['quote'] = plugins_url( 'assets/js/app.js', CSH_PLUGIN_FILE );
    return $plugin_array;
 }