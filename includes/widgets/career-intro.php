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

if ( ! class_exists( 'Haru_Starter_Career_Intro_Widget' ) ) {
	class Haru_Starter_Career_Intro_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-career-intro';
		}

		public function get_title() {
			return esc_html__( 'Haru Career Intro', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' 	=> esc_html__( 'Content', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Career Intro', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Career Intro you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Career Intro 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Career Intro 2', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'title', [
					'label' => esc_html__( 'Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-2' ],
					],
				]
			);

			$this->add_control(
				'sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Sub Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-2' ],
					],
				]
			);

	        $this->add_control(
				'description', [
					'label' => esc_html__( 'Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Description' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'sub_description', [
					'label' => esc_html__( 'Sub Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Sub Description' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'link', [
					'label' => esc_html__( 'Link', 'haru-starter' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
				]
			);

			$this->add_control(
				'btn_description', [
					'label' => esc_html__( 'Button Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Button Description' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'btn_text', [
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
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

        	$this->add_render_attribute( 'career-intro', 'class', 'haru-career-intro' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'career-intro', 'class', 'haru-career-intro--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'career-intro', 'class', $settings['el_class'] );
			}

			$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'career-intro' ); ?>>
        		<div class="haru-career-intro__content" style="background-image: url(<?php echo esc_url( $settings['image']['url'] ); ?>);">
	        		<div class="haru-career-intro__sub-title"><?php echo $settings['sub_title']; ?></div>
					<div class="haru-career-intro__title"><?php echo $settings['title']; ?></div>
					<div class="haru-career-intro__description"><?php echo $settings['description']; ?></div>
					<div class="haru-career-intro__sub-description"><?php echo $settings['sub_description']; ?></div>
					<div class="haru-career-intro__btn-wrap">
						<a class="haru-career-intro__btn haru-button haru-button--bg-white haru-button--size-large haru-button--round-large" href="<?php echo $settings['link']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $settings['btn_text']; ?>
							<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
						</a>
					</div>
				</div>
    		</div>

    		<?php
		}

	}
}
