<?php
/**
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! class_exists( 'Haru_Starter_Libraries' ) ) {
    class Haru_Starter_Libraries {
        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

        public function __construct() {

            $this->includes();

        }

        public function includes() {
            if ( file_exists( WP_PLUGIN_DIR . '/cmb2/init.php' ) && !defined( 'CMB2_LOADED') ) {
                require_once WP_PLUGIN_DIR . '/cmb2/init.php';
            } else {
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2/init.php';
            }

            if ( defined( 'CMB2_LOADED') ) {
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-conditionals/cmb2-conditionals.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-attached-posts/cmb2-attached-posts-field.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-radio-image/cmb2-radio-image.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-switch-button/cmb2-switch-button.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb-field-select2/cmb-field-select2.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-text-list/cmb2-text-list.php';
                require_once HARU_STARTER_CORE_DIR . '/core/libraries/cmb2-tabs/cmb2-tabs.php';
            }
            
            require_once( HARU_STARTER_CORE_DIR . '/core/libraries/theme-metabox.php' );
        }
    }
}

Haru_Starter_Libraries::instance();
