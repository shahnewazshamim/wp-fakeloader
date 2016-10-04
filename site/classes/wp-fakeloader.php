<?php
// Die if basepath is not defined
defined('ABSPATH') or die('No script kiddies please!');

if (!class_exists('WpFakeLoader', false)) {

    class WpFakeLoader
    {

        /**
         * @var Declare properties.
         */
        private static $instance;

        private $stylesheet = 'wp-fakeloader/site/assets/css/style.css';

        private $javascript = 'wp-fakeloader/site/assets/js/script.js';

        private $fakeloader = 'wp-fakeloader/site/assets/js/fakeloader.min.js';

        private $adminclass = '/admin/classes/wp-fakeloader-admin.php';

        private $templates = '/templates/';


        /**
         * WpFakeLoader constructor.
         */
        protected function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'registerPluginStyle'));

            add_action('wp_enqueue_scripts', array($this, 'registerPluginScript'));

            add_shortcode('fakeloader', array($this, 'fakeloaderContent'));
        }


        /**
         * @return WpFakeLoader
         */
        public static function init()
        {
            if (is_null(self::$instance)) {

                self::$instance = new self();

            }

            return self::$instance;
        }


        /**
         * @return WpFakeLoaderAdmin
         */
        public function admin()
        {
            if ( is_admin() ) {

                require dirname(dirname(__DIR__)) . $this->adminclass;

                WpFakeLoaderAdmin::init();
            }
        }


        /**
         * Register Plugin Stylesheet
         */
        public function registerPluginStyle()
        {
            wp_register_style('wp-fakeloader-style', plugins_url($this->stylesheet));

            wp_enqueue_style('wp-fakeloader-style');
        }


        /**
         * Register Plugin Javascript
         */
        public function registerPluginScript()
        {
            wp_register_script('wp-fakeloader-script', plugins_url($this->fakeloader), array('jquery'), 1.0);

            wp_register_script( 'wp-fakeloader-init-script', plugins_url( $this->javascript ) );

            $script_params = array(

                'delayTime' => (get_option('fakeloader-delay-time') != '') ? get_option('fakeloader-delay-time') : 1200,

                'zIndex' => (get_option('fakeloader-z-index') != '') ? get_option('fakeloader-z-index') : 999,

                'spinner' => (get_option('fakeloader-spinner') != '') ? get_option('fakeloader-spinner') : 'spinner1',

                'bgColor' => (get_option('fakeloader-bg-color') != '') ? get_option('fakeloader-bg-color') : '#4ebf2f',

                'isImage' => (get_option('fakeloader-is-image') != '') ? get_option('fakeloader-is-image') : '',

                'customImage' => (get_option('fakeloader-spinner-file') != '') ? get_option('fakeloader-spinner-file') : '',
            );

            wp_localize_script( 'wp-fakeloader-init-script', 'fkinit', $script_params );

            wp_enqueue_script('wp-fakeloader-script');

            wp_enqueue_script('wp-fakeloader-init-script');
        }

        /**
         * HTML content of Shortcode [fakeloader]
         */
        public function fakeloaderContent()
        {
            $fileName = 'shortcode-fakeloader-content.php';
            require dirname(dirname(__DIR__)) .  $this->templates . $fileName;
        }

    }

}

