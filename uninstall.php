<?php
// If uninstall is not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {

    exit();

}

$options = array(

    'delay_time', 'z_index', 'bg_color', 'spinner', 'is_image', 'spinner_file'
);

foreach ($options as $option) {

    // Delete options
    delete_option($option);

    // Delete options for Multisite
    delete_site_option($option);
}