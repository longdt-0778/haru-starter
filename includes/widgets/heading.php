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
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Heading_Widget' ) ) {
	class Haru_Starter_Heading_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-heading';
		}

		public function get_title() {
			return esc_html__( 'Haru Heading', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-t-letter';
		}

		public function get_categories() {
			return [ 'haru-elements', 'haru-footer-elements' ];
		}

		public function get_keywords() {
            return [
                'heading',
                'title',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
				'section_settings',
				[
					'label' => __( 'Heading Settings', 'haru-starter' ),
				]
			);

			$this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Heading', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Heading you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Footer 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Heading 1', 'haru-starter' ),
						'style-3' 	=> __( 'Pre Heading 2', 'haru-starter' ),
						'style-4' 	=> __( 'Pre Heading 3', 'haru-starter' ),
					]
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'haru-starter' ),
					'default' => __( 'Add Your Heading Text Here', 'haru-starter' ),
				]
			);

			$this->add_control(
				'sub_title',
				[
					'label' => __( 'Sub Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your sub title', 'haru-starter' ),
					'default' => __( 'Add Your Sub Heading Text Here', 'haru-starter' ),
					'condition' => [
						'pre_style' => [ 'style-2' ],
					],
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
					'default' => [
						'url' => '',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'size',
				[
					'label' => __( 'Size', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 100,
						],
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-heading-title' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'header_size',
				[
					'label' => __( 'HTML Tag', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
						'span' => 'span',
						'p' => 'p',
					],
					'default' => 'h2',
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'haru-starter' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'haru-starter' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'haru-starter' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'haru-starter' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'haru-starter' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
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

			$this->add_control(
				'view',
				[
					'label' => __( 'View', 'haru-starter' ),
					'type' => Controls_Manager::HIDDEN,
					'default' => 'traditional',
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
				'title_color',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-heading-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selector' => '{{WRAPPER}} .haru-heading-title',
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'text_shadow',
					'selector' => '{{WRAPPER}} .haru-heading-title',
				]
			);

			$this->add_control(
				'blend_mode',
				[
					'label' => __( 'Blend Mode', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => __( 'Normal', 'haru-starter' ),
						'multiply' => 'Multiply',
						'screen' => 'Screen',
						'overlay' => 'Overlay',
						'darken' => 'Darken',
						'lighten' => 'Lighten',
						'color-dodge' => 'Color Dodge',
						'saturation' => 'Saturation',
						'color' => 'Color',
						'difference' => 'Difference',
						'exclusion' => 'Exclusion',
						'hue' => 'Hue',
						'luminosity' => 'Luminosity',
					],
					'selectors' => [
						'{{WRAPPER}} .haru-heading-title' => 'mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['title'] ) {
				return;
			}

			$this->add_render_attribute( 'title', 'class', 'haru-heading-title' );

			if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'title', 'class', 'haru-heading-title--' . $settings['pre_style'] );
			}

			if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'title', 'class', $settings['el_class'] );
			}

			$this->add_inline_editing_attributes( 'title' );

			$title = $settings['title'];
			$sub_title = $settings['sub_title'];

			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_link_attributes( 'url', $settings['link'] );

				if ( ( $settings['sub_title'] != '' ) && in_array( $settings['pre_style'], array( 'style-2' ) ) ) {
					$title = sprintf( '<a %1$s><span class="haru-heading-title__sub">%2$s</span>%3$s</a>', $this->get_render_attribute_string( 'url' ), $sub_title, $title );
				} else {
					$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
				}
			}

			if ( ( $settings['sub_title'] != '' ) && in_array( $settings['pre_style'], array( 'style-2' ) ) ) {
				$title_html = sprintf( '<%1$s %2$s><span class="haru-heading-title__sub">%3$s</span>%4$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $sub_title, $title );
			} else {
				$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
			}

			echo $title_html;
		}

	}
}
