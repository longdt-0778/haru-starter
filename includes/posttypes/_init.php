<?php
/**
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! class_exists( 'Haru_Starter_Posttypes' ) ) {
	class Haru_Starter_Posttypes {
		private static $_instance = null;

		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;

		}

		public function __construct() {

			add_action( 'init', [ $this, 'includes' ], 0 );

		}


		public function includes() {
			require_once( HARU_STARTER_CORE_DIR . 'includes/posttypes/header.php');
			require_once( HARU_STARTER_CORE_DIR . 'includes/posttypes/footer.php');
			require_once( HARU_STARTER_CORE_DIR . 'includes/posttypes/megamenu.php');
			require_once( HARU_STARTER_CORE_DIR . 'includes/posttypes/recruitment.php');
			require_once( HARU_STARTER_CORE_DIR . 'includes/posttypes/project.php');
		}
	}
}

Haru_Starter_Posttypes::instance();
