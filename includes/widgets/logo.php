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

if ( ! class_exists( 'Haru_Starter_Logo_Widget' ) ) {
	class Haru_Starter_Logo_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-logo';
		}

		public function get_title() {
			return esc_html__( 'Haru Header Logo', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-header-elements', 'haru-footer-elements' ];
		}

		public function get_keywords() {
            return [
                'logo retina',
                'logo',
                'retina',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'section_settings',
	            [
	                'label' 	=> esc_html__( 'Logo Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
	            'logo',
	            [
	                'label' 	=> esc_html__( 'Choose Logo', 'haru-starter' ),
	                'type' 		=> Controls_Manager::MEDIA,
	                'dynamic' 	=> [
	                    'active' 	=> true,
	                ],
	                'default' 	=> [
	                    'url'		=> Utils::get_placeholder_image_src(),
	                ],
	            ]
	        );

	        $this->add_control(
	            'logo_retina',
	            [
	                'label' 	=> esc_html__( 'Choose Logo Retina', 'haru-starter' ),
	                'type' 		=> Controls_Manager::MEDIA,
	                'dynamic' 	=> [
	                    'active' 	=> true,
	                ],
	                'default' 	=> [
	                    'url' 		=> Utils::get_placeholder_image_src(),
	                ],
	            ]
	        );

	        $this->add_control(
				'max_height',
				[
					'label' 	=> __( 'Logo Max Height', 'haru-starter' ),
					'type' 		=> Controls_Manager::NUMBER,
					'min' 		=> 1,
					'max' 		=> 200,
					'step' 		=> 1,
					'default' 	=> 40,
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
			$settings = $this->get_settings_for_display();

        	$this->add_render_attribute( 'logo', 'class', 'haru-logo' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'logo', 'class', $settings['el_class'] );
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'logo' ); ?>>
    			<?php echo Haru_Template::haru_get_template( 'logo/logo.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
