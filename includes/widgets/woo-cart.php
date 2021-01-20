<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

namespace Haru_Starter\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Woo_Cart_Widget' ) ) {
	class Haru_Starter_Woo_Cart_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-woo-cart';
		}

		public function get_title() {
			return esc_html__( 'Haru Woo Cart', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-cart-medium';
		}

		public function get_categories() {
			return [ 'haru-header-elements' ];
		}

		public function get_keywords() {
            return [
                'cart',
                'mini cart',
                'header',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'section_settings',
	            [
	                'label' 	=> esc_html__( 'Cart Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'show_price',
				[
					'label' 		=> esc_html__( 'Show Price', 'haru-starter' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'haru-starter' ),
					'label_off' 	=> esc_html__( 'Hide', 'haru-starter' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

	        $this->add_control(
				'el_class',
				[
					'label' => __( 'CSS Classes', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
					'title' => __( 'Add your custom class WITHOUT the dot. e.g: my-class', 'haru-starter' ),
				]
			);

	        $this->end_controls_section();

		}

		protected function render() {
			if ( null === WC()->cart ) {
				return;
			}

			$settings = $this->get_settings_for_display();

        	$this->add_render_attribute( 'cart', 'class', 'haru-cart' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'cart', 'class', $settings['el_class'] );
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'cart' ); ?>>
    			<?php echo Haru_Template::haru_get_template( 'woo-cart/woo-cart.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
