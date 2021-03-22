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
use \Elementor\Core\Responsive\Responsive;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Plugin;
use \Haru_Starter\Classes\Haru_Template;
use \Haru_Nav_Menu;

if ( ! class_exists( 'Haru_Starter_Nav_Menu_Widget' ) ) {
	class Haru_Starter_Nav_Menu_Widget extends Widget_Base {

		protected $nav_menu_index = 1;

		public function get_name() {
			return 'haru-nav-menu';
		}

		public function get_title() {
			return esc_html__( 'Haru Nav Menu', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-nav-menu';
		}

		public function get_categories() {
			return [ 'haru-header-elements' ];
		}

		public function get_keywords() {
            return [
                'menu',
                'nav',
                'nav menu',
                'mega menu',
                'menu columns',
                'menu tab',
                'menu dropdown'
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		public function get_style_depends() {
			return [ 'animate' ];
		}

		protected function get_nav_menu_index() {
			return $this->nav_menu_index++;
		}

		private function get_available_menus() {
			$menus = wp_get_nav_menus();

			$options = [];

			foreach ( $menus as $menu ) {
				$options[ $menu->slug ] = $menu->name;
			}

			return $options;
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'section_settings',
				[
					'label' => __( 'Menu Settings', 'haru-starter' ),
					'tab' 		=> Controls_Manager::TAB_CONTENT,
				]
			);

			$menus = $this->get_available_menus();

			if ( ! empty( $menus ) ) {
				$this->add_control(
					'menu',
					[
						'label' => __( 'Menu', 'haru-starter' ),
						'type' => Controls_Manager::SELECT,
						'options' => $menus,
						'default' => array_keys( $menus )[0],
						'save_default' => true,
						'separator' => 'after',
						'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'haru-starter' ), admin_url( 'nav-menus.php' ) ),
					]
				);
			} else {
				$this->add_control(
					'menu',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => '<strong>' . __( 'There are no menus in your site.', 'haru-starter' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'haru-starter' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
						'separator' => 'after',
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
					]
				);
			}

			$this->add_control(
				'layout',
				[
					'label' => __( 'Layout', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'haru-starter' ),
						'vertical' => __( 'Vertical', 'haru-starter' ),
						// 'dropdown' => __( 'Dropdown', 'haru-starter' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'align_items',
				[
					'label' => __( 'Align', 'haru-starter' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'haru-starter' ),
							'icon' => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'haru-starter' ),
							'icon' => 'eicon-h-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'haru-starter' ),
							'icon' => 'eicon-h-align-right',
						],
						'justify' => [
							'title' => __( 'Stretch', 'haru-starter' ),
							'icon' => 'eicon-h-align-stretch',
						],
					],
					'prefix_class' => 'haru-nav-menu__align-',
					'condition' => [
						'layout!' => 'dropdown',
					],
				]
			);

			$this->add_control(
				'pointer',
				[
					'label' 	=> __( 'Pointer', 'haru-starter' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'none',
					'options' 	=> [
						'none' 			=> __( 'None', 'haru-starter' ),
						'underline' 	=> __( 'Underline', 'haru-starter' ),
						'overline' 		=> __( 'Overline', 'haru-starter' ),
						'double-line' 	=> __( 'Double Line', 'haru-starter' ),
					],
					'style_transfer' => true,
					'condition' => [
						'layout!' 	=> 'dropdown',
					],
				]
			);

			$this->add_control(
				'animation_line',
				[
					'label' 	=> __( 'Animation', 'haru-starter' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'fade',
					'options' 	=> [
						'fade' 		=> 'Fade',
						'slide' 	=> 'Slide',
						'grow' 		=> 'Grow',
						'drop-in' 	=> 'Drop In',
						'drop-out' 	=> 'Drop Out',
						'none' 		=> 'None',
					],
					'condition' => [
						'layout!' => 'dropdown',
						'pointer' => [ 'underline', 'overline', 'double-line' ],
					],
				]
			);

			$this->add_control(
				'indicator',
				[
					'label' 	=> __( 'Submenu Indicator', 'haru-starter' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'classic',
					'options' 	=> [
						'none' 		=> __( 'None', 'haru-starter' ),
						'classic' 	=> __( 'Classic', 'haru-starter' ),
						'chevron' 	=> __( 'Chevron', 'haru-starter' ),
						'angle' 	=> __( 'Angle', 'haru-starter' ),
						'plus'	 	=> __( 'Plus', 'haru-starter' ),
					],
					'prefix_class' => 'haru-nav-menu--indicator-',
				]
			);

			$this->add_control(
				'heading_mobile_dropdown',
				[
					'label' 	=> __( 'Mobile Dropdown', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'layout!' => 'dropdown',
					],
				]
			);

			if ( ! empty( $menus ) ) {
				$this->add_control(
					'menu_mobile',
					[
						'label' => __( 'Menu Mobile', 'haru-starter' ),
						'type' => Controls_Manager::SELECT,
						'options' => $menus,
						'default' => array_keys( $menus )[0],
						'save_default' => true,
						'separator' => 'after',
						'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'haru-starter' ), admin_url( 'nav-menus.php' ) ),
					]
				);
			} else {
				$this->add_control(
					'menu_mobile',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => '<strong>' . __( 'There are no menus in your site.', 'haru-starter' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'haru-starter' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
						'separator' => 'after',
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
					]
				);
			}

			$breakpoints = Responsive::get_breakpoints();

			$this->add_control(
				'dropdown',
				[
					'label' 	=> __( 'Breakpoint', 'haru-starter' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'tablet',
					'options' 	=> [
						/* translators: %d: Breakpoint number. */
						'mobile' 	=> sprintf( __( 'Mobile (< %dpx)', 'haru-starter' ), $breakpoints['md'] ),
						/* translators: %d: Breakpoint number. */
						'tablet' 	=> sprintf( __( 'Tablet (< %dpx)', 'haru-starter' ), $breakpoints['lg'] ),
						'none' 		=> __( 'None', 'haru-starter' ),
					],
					'prefix_class' 	=> 'haru-nav-menu--dropdown-',
					'condition' 	=> [
						'layout!' => 'dropdown',
					],
				]
			);

			$this->add_control(
				'full_width',
				[
					'label' 		=> __( 'Full Width', 'haru-starter' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'description' 	=> __( 'Stretch the dropdown of the menu to full width.', 'haru-starter' ),
					'prefix_class' 	=> 'haru-nav-menu--',
					'return_value' 	=> 'stretch',
					'frontend_available' => true,
					'condition' => [
						'dropdown!' => 'none',
					],
				]
			);

			$this->add_control(
				'text_align',
				[
					'label' 		=> __( 'Align', 'haru-starter' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT,
					'default' 		=> 'aside',
					'options' 		=> [
						'aside' 	=> __( 'Aside', 'haru-starter' ),
						'center' 	=> __( 'Center', 'haru-starter' ),
					],
					'prefix_class' 	=> 'haru-nav-menu__text-align-',
					'condition' 	=> [
						'dropdown!' => 'none',
					],
				]
			);

			$this->add_control(
				'toggle',
				[
					'label' 	=> __( 'Toggle Button', 'haru-starter' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'burger',
					'options' 	=> [
						'' 			=> __( 'None', 'haru-starter' ),
						'burger' 	=> __( 'Hamburger', 'haru-starter' ),
					],
					'prefix_class' 	=> 'haru-nav-menu--toggle haru-nav-menu--',
					'render_type' 	=> 'template',
					'frontend_available' => true,
					'condition' => [
						'dropdown!' 	=> 'none',
					],
				]
			);

			$this->add_control(
				'toggle_align',
				[
					'label' 	=> __( 'Toggle Align', 'haru-starter' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'default' 	=> 'center',
					'options' 	=> [
						'left' => [
							'title' 	=> __( 'Left', 'haru-starter' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' => [
							'title' 	=> __( 'Center', 'haru-starter' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' => [
							'title' 	=> __( 'Right', 'haru-starter' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
					'selectors_dictionary' => [
						'left' 		=> 'margin-right: auto',
						'center' 	=> 'margin: 0 auto',
						'right' 	=> 'margin-left: auto',
					],
					'selectors' => [
						'{{WRAPPER}} .haru-menu-toggle' => '{{VALUE}}',
					],
					'condition' => [
						'toggle!' 	=> '',
						'dropdown!' => 'none',
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

	        $this->start_controls_section(
	            'section_style_main-menu',
	            [
	                'label' => esc_html__( 'Main Menu', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'menu_typography',
					'default' => '',
					'selector' => '{{WRAPPER}} .haru-nav-menu .haru-item',
				]
			);

			$this->start_controls_tabs( 'tabs_menu_item_style' );

			$this->start_controls_tab(
				'tab_menu_item_normal',
				[
					'label' => __( 'Normal', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_menu_item',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_menu_item_hover',
				[
					'label' => __( 'Hover', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_menu_item_hover',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item:hover,
						{{WRAPPER}} .haru-nav-menu--main .haru-item.haru-item-active,
						{{WRAPPER}} .haru-nav-menu--main .haru-item.highlighted,
						{{WRAPPER}} .haru-nav-menu--main .haru-item:focus' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'pointer_color_menu_item_hover',
				[
					'label' => __( 'Pointer Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item:before,
						{{WRAPPER}} .haru-nav-menu--main .haru-item:after' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'pointer!' => [ 'none' ],
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_menu_item_active',
				[
					'label' => __( 'Active', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_menu_item_active',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item.haru-item-active' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'pointer_color_menu_item_active',
				[
					'label' => __( 'Pointer Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item.haru-item-active:before,
						{{WRAPPER}} .haru-nav-menu--main .haru-item.haru-item-active:after' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'pointer!' => [ 'none' ],
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

			$this->add_responsive_control(
				'pointer_width',
				[
					'label' => __( 'Pointer Width', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 20,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru--pointer-underline .haru-item:after,
						 {{WRAPPER}} .haru--pointer-overline .haru-item:before,
						 {{WRAPPER}} .haru--pointer-double-line .haru-item:before,
						 {{WRAPPER}} .haru--pointer-double-line .haru-item:after' => 'height: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'pointer' => [ 'underline', 'overline', 'double-line' ],
					],
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label' => __( 'Horizontal Padding', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'padding_vertical_menu_item',
				[
					'label' => __( 'Vertical Padding', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main .haru-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'menu_space_between',
				[
					'label' => __( 'Space Between', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'selectors' => [
						'body:not(.rtl) {{WRAPPER}} .haru-nav-menu--layout-horizontal .haru-nav-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .haru-nav-menu--layout-horizontal .haru-nav-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .haru-nav-menu--main:not(.haru-nav-menu--layout-horizontal) .haru-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

	        $this->end_controls_section();

	        $this->start_controls_section(
				'section_style_dropdown',
				[
					'label' => __( 'Dropdown Mobile', 'haru-starter' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'dropdown_description',
				[
					'raw' => __( 'On mobile, this will affect the entire menu.', 'haru-starter' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
				]
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

			$this->start_controls_tab(
				'tab_dropdown_item_normal',
				[
					'label' => __( 'Normal', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_dropdown_item',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' =>  Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a, {{WRAPPER}} .haru-menu-toggle' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'background_color_dropdown_item',
				[
					'label' => __( 'Background Color', 'haru-starter' ),
					'type' =>  Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown' => 'background-color: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_dropdown_item_hover',
				[
					'label' => __( 'Hover', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_dropdown_item_hover',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a:hover,
						{{WRAPPER}} .haru-nav-menu--dropdown a.haru-item-active,
						{{WRAPPER}} .haru-nav-menu--dropdown a.highlighted,
						{{WRAPPER}} .haru-menu-toggle:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'background_color_dropdown_item_hover',
				[
					'label' => __( 'Background Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a:hover,
						{{WRAPPER}} .haru-nav-menu--dropdown a.haru-item-active,
						{{WRAPPER}} .haru-nav-menu--dropdown a.highlighted' => 'background-color: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_dropdown_item_active',
				[
					'label' => __( 'Active', 'haru-starter' ),
				]
			);

			$this->add_control(
				'color_dropdown_item_active',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a.haru-item-active' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'background_color_dropdown_item_active',
				[
					'label' => __( 'Background Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a.haru-item-active' => 'background-color: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'dropdown_typography',
					'default' => '',
					'exclude' => [ 'line_height' ],
					'selector' => '{{WRAPPER}} .haru-nav-menu--dropdown .haru-item, {{WRAPPER}} .haru-nav-menu--dropdown  .haru-sub-item',
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'dropdown_border',
					'selector' => '{{WRAPPER}} .haru-nav-menu--dropdown',
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label' => __( 'Border Radius', 'haru-starter' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .haru-nav-menu--dropdown li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
						'{{WRAPPER}} .haru-nav-menu--dropdown li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'dropdown_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '{{WRAPPER}} .haru-nav-menu--main .haru-nav-menu--dropdown, {{WRAPPER}} .haru-nav-menu__container.haru-nav-menu--dropdown',
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label' => __( 'Horizontal Padding', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
					],
					'separator' => 'before',

				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label' => __( 'Vertical Padding', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'heading_dropdown_divider',
				[
					'label' => __( 'Divider', 'haru-starter' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'dropdown_divider',
					'selector' => '{{WRAPPER}} .haru-nav-menu--dropdown li:not(:last-child)',
					'exclude' => [ 'width' ],
				]
			);

			$this->add_control(
				'dropdown_divider_width',
				[
					'label' => __( 'Border Width', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--dropdown li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'dropdown_top_distance',
				[
					'label' => __( 'Distance', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-nav-menu--main > .haru-nav-menu > li > .haru-nav-menu--dropdown, {{WRAPPER}} .haru-nav-menu__container.haru-nav-menu--dropdown' => 'margin-top: {{SIZE}}{{UNIT}} !important',
					],
					'separator' => 'before',
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$available_menus = $this->get_available_menus();

			if ( ! $available_menus ) {
				return;
			}

			$settings = $this->get_settings();

	        $args = array(
                // 'theme_location' => 'primary-menu',
	        	'echo' 				=> false,
                'menu' 				=> $settings['menu'],
                // 'menu_class' 		=> 'haru-nav-menu ' . $effect,
                'menu_class' 		=> 'haru-nav-menu',
                'menu_id' 			=> 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
                'fallback_cb' 		=> '__return_empty_string',
                'container' 		=> '',
                'walker' 			=> new Haru_Nav_Menu()
            );

            if ( 'vertical' === $settings['layout'] ) {
				$args['menu_class'] .= ' sm-vertical';
			}

            // Add custom filter to handle Nav Menu HTML output.
			add_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ], 10, 4 );
			// add_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
			add_filter( 'nav_menu_item_id', '__return_empty_string' );

            // General Menu.
			$menu_html = wp_nav_menu( $args );

			// Dropdown Menu Mobile.
			$args['menu'] = $settings['menu_mobile'];
			$args['menu_id'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();
			$dropdown_menu_html = wp_nav_menu( $args );

			remove_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ] );
			// remove_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
			remove_filter( 'nav_menu_item_id', '__return_empty_string' );

			if ( empty( $menu_html ) ) {
				return;
			}

			$this->add_render_attribute( 'menu-toggle', [
				'class' 		=> 'haru-menu-toggle',
				'role' 			=> 'button',
				'tabindex' 		=> '0',
				'aria-label' 	=> __( 'Menu Toggle', 'haru-starter' ),
				// 'aria-expanded' => 'false',
			] );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'menu-toggle', [
					'class' => 'elementor-clickable',
				] );
			}

			if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'main-menu', 'class', $settings['el_class'] );
				$this->add_render_attribute( 'menu-toggle', 'class', $settings['el_class'] );
			}

			if ( 'dropdown' !== $settings['layout'] ) :
				$this->add_render_attribute( 'main-menu', 'class', [
					'haru-nav-menu--main',
					'haru-nav-menu__container',
					'haru-nav-menu--layout-' . $settings['layout'],
				] );

				if ( $settings['pointer'] ) :
					$this->add_render_attribute( 'main-menu', 'class', 'haru--pointer-' . $settings['pointer'] );

					foreach ( $settings as $key => $value ) :
						if ( 0 === strpos( $key, 'animation' ) && $value ) :
							$this->add_render_attribute( 'main-menu', 'class', 'haru--animation-' . $value );

							break;
						endif;
					endforeach;
				endif; ?>

				<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?> role="navigation">
                	<?php echo $menu_html; ?>
                </nav>
                <?php
			endif;
			?>
			<div <?php echo $this->get_render_attribute_string( 'menu-toggle' ); ?>>
				<i class="eicon-menu-bar" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php _e( 'Menu', 'haru-starter' ); ?></span>
			</div>
			<nav class="haru-nav-menu--dropdown haru-nav-menu__container" role="navigation" aria-hidden="true">
				<!-- <div class="haru-nav-menu__title"><?php echo esc_html__( 'Menu', 'haru-starter' ); ?></div> -->
				<?php echo $dropdown_menu_html; ?>
			</nav>
			<?php
		}

		public function handle_link_classes( $atts, $item, $args, $depth ) {
			$classes = $depth ? 'haru-sub-item' : 'haru-item';
			$is_anchor = false !== strpos( $atts['href'], '#' );

			if ( ! $is_anchor && in_array( 'current-menu-item', $item->classes ) ) {
				$classes .= ' haru-item-active';
			}

			if ( $is_anchor ) {
				$classes .= ' haru-item-anchor';
			}

			if ( empty( $atts['class'] ) ) {
				$atts['class'] = $classes;
			} else {
				$atts['class'] .= ' ' . $classes;
			}

			return $atts;
		}

		public function handle_sub_menu_classes( $classes ) {
			$classes[] = 'haru-nav-menu--dropdown';

			return $classes;
		}

	}
}
