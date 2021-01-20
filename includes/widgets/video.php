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
use \Elementor\Modules\DynamicTags\Module;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Video_Widget' ) ) {
	class Haru_Starter_Video_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-video';
		}

		public function get_title() {
			return esc_html__( 'Haru Video', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-instagram-video';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'videos',
                'video',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' => esc_html__( 'Content', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Video', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Video you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Video 1', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'video_desktop_url',
				[
					'label' => __( 'Video Desktop File', 'elementor' ),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
						'categories' => [
							Module::MEDIA_CATEGORY,
						],
					],
					'media_type' => 'video',
				]
			);

			$this->add_control(
				'video_mobile_url',
				[
					'label' => __( 'Video Mobile File', 'elementor' ),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
						'categories' => [
							Module::MEDIA_CATEGORY,
						],
					],
					'media_type' => 'video',
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

	        $this->start_controls_section(
				'section_title_style',
				[
					'label' => __( 'Title', 'haru-starter' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'section_title_style_description',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set style if you set Pre Video is None.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['video_desktop_url'] ) {
				return;
			}

        	$this->add_render_attribute( 'video', 'class', 'haru-video' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'video', 'class', 'haru-video--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'video', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'video' ); ?>>
        		<?php echo Haru_Template::haru_get_template( 'video/video.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
