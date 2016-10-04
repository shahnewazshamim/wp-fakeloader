<?php
// Die if Basepath is not defined
defined('ABSPATH') or die('No script kiddies please!');

/*
Plugin Name: WP Fakeloader
Plugin URI: http://softyardbd.com/wp-fakeloader/
Description: WP Fakeloader is an awesome Preloader based on Fakeloader JS. This is <strong>simple to customize</strong> and super lightweight plugin for wordpress website with some nice <strong>predefined spinner</strong>.
Author: Md. Shamim Shahnewaz
Version: 1.1
Author URI: http://softyardbd.com/
License: GPL2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('PLUGIN_BASENAME', plugin_basename(__FILE__));

require plugin_dir_path(__FILE__) . 'site/classes/wp-fakeloader.php';

WpFakeLoader::init()->admin();