<?php
// Die if basepath is not defined
defined('ABSPATH') or die('No script kiddies please!');

if (!class_exists('WpFakeLoaderAdmin', false)) {

    class WpFakeLoaderAdmin
    {

        /**
         * @var Declare properties.
         */
        private static $instance;

        private static $wpFakeloaderSettingsPage = '/templates/admin-wp-fakeloader-settings.php';

        private $stylesheet = 'assets/css/style.css';

        private $javascript = 'assets/js/script.js';

        private $colorpicker = 'assets/js/color-picker.js';

        private $pluginlinks = array();


        /**
         * WpFakeLoaderAdmin constructor.
         */
        protected function __construct()
        {
            add_action('admin_menu', array($this, 'adminSubMenu'));

            add_action('admin_init', array($this, 'registerSettings'));

            add_action('admin_enqueue_scripts', array($this, 'registerPluginScript'));

            add_filter('plugin_action_links_' . PLUGIN_BASENAME, array($this, 'pluginLinkMenu'));
        }


        /**
         * @return WpFakeLoaderAdmin
         */
        public static function init()
        {
            if (is_null(self::$instance)) {

                self::$instance = new self();

            }

            return self::$instance;
        }


        /**
         * Register Plugin Admin Javascript
         */
        public function registerPluginScript()
        {
            wp_enqueue_style('wp-color-picker');

            wp_enqueue_script('admin-script-handle', plugins_url($this->colorpicker, __DIR__), array('wp-color-picker'), false, true);
        }


        /**
         * Add Submenu with WP options page
         */
        public function adminSubMenu()
        {
            add_submenu_page(

                'options-general.php',

                __('WP Fakeloader Settings', 'wp-fakeloader'),

                __('WP Fakeloader', 'wp-fakeloader'),

                'manage_options',

                'wp-fakeloader-settings',

                array($this, 'wpFakeloaderSettingsPage')

            );
        }


        /**
         * Add Plugin Settings and other Menus in plugin page
         */
        public function pluginLinkMenu($links)
        {
            $this->pluginlinks = array(

                '<a href="' . admin_url( 'options-general.php?page=wp-fakeloader-settings' ) . '">Settings</a>',

                '<a href="http://softyardbd.com/wp-fakeloader/" target="_blank">Demo</a>',

                '<a href="https://profiles.wordpress.org/mdshamimshahnewaz/#content-plugins" target="_blank">More Plugins</a>',
            );

            return array_merge($links, $this->pluginlinks);
        }


        /**
         * Load Fakeloader settings page : menu callback
         */
        public function wpFakeloaderSettingsPage()
        {
            include dirname(dirname(__DIR__)) . self::$wpFakeloaderSettingsPage;
        }


        /**
         * Register the settings
         */
        public function registerSettings()
        {
            register_setting('wp-fakeloader-settings', 'fakeloader-delay-time');

            register_setting('wp-fakeloader-settings', 'fakeloader-z-index');

            register_setting('wp-fakeloader-settings', 'fakeloader-spinner');

            register_setting('wp-fakeloader-settings', 'fakeloader-bg-color');

            register_setting('wp-fakeloader-settings', 'fakeloader-is-image');

            register_setting('wp-fakeloader-settings', 'fakeloader-spinner-file', array($this, 'spinnerUpload'));
        }


        /**
         * Upload spinner image
         */
        public function spinnerUpload($option)
        {
            if (!function_exists('wp_handle_upload')) {

                require_once(ABSPATH . 'wp-admin/includes/file.php');

            }

            $uploadedfile = $_FILES['fakeloader-spinner-file'];

            $upload_overrides = array('test_form' => false);

            $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

            if ($movefile && !isset($movefile['error'])) {

                $temp = $movefile['url'];

                return $temp;
            }

            if (get_option('fakeloader-spinner-file')) {

                return get_option('fakeloader-spinner-file');

            } else {

                return $option;

            }
        }

    }

}

