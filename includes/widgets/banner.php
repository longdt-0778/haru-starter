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

if ( ! class_exists( 'Haru_Starter_Banner_Widget' ) ) {
	class Haru_Starter_Banner_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-banner';
		}

		public function get_title() {
			return esc_html__( 'Haru Banner', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'banner',
                'image',
                'advertising',
                'advertise',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'section_settings',
	            [
	                'label' 	=> esc_html__( 'Banner Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Banner', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Banner you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Banner 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Banner 2', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
	            'image',
	            [
	                'label' 	=> esc_html__( 'Choose Image', 'haru-starter' ),
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
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
				]
			);

	        $this->add_control(
				'link',
				[
					'label' => __( 'Link', 'haru-starter' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'default' => [
						'url' => '#',
					],
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

        	$this->add_render_attribute( 'banner', 'class', 'haru-banner' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'banner', 'class', 'haru-banner--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'banner', 'class', $settings['el_class'] );
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'banner' ); ?>>
    			<?php echo Haru_Template::haru_get_template( 'banner/banner.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
