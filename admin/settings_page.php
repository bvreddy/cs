<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="wrap">

    <?php settings_errors(); ?>
    
    <form action="options.php" method="post" class="">
        <?php settings_fields( 'csh_settings_group' ); ?>
        <?php do_settings_sections( 'csh_options_settings' ) ?>
        <?php submit_button() ?>
    </form>
        
</div>