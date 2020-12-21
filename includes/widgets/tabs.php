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
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Haru_Starter\Classes\Helper;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Tabs_Widget' ) ) {
    class Haru_Starter_Tabs_Widget extends Widget_Base {

        public function get_name() {
            return 'haru-tabs';
        }

        public function get_title() {
            return esc_html__( 'Haru Tabs', 'haru-starter' );
        }

        public function get_icon() {
            return 'eicon-tabs';
        }

        public function get_categories() {
            return [ 'haru-elements' ];
        }

        public function get_keywords() {
            return [
                'tab',
                'tabs',
                'panel',
                'navigation',
                'group',
                'tabs content',
                'product tabs',
            ];
        }

        public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

        protected function _register_controls() {

            $this->start_controls_section(
                'settings_section',
                [
                    'label' => esc_html__( 'General Settings', 'haru-starter'  ),
                ]
            );

            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', 'haru-starter' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'label_block' => false,
                    'options' => [
                        'horizontal' => esc_html__( 'Horizontal', 'haru-starter' ),
                        'vertical' => esc_html__( 'Vertical', 'haru-starter' ),
                    ],
                ]
            );

            $this->add_control(
                'icon_show',
                [
                    'label' => esc_html__( 'Enable Icon', 'haru-starter' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'return_value' => 'yes',
                ]
            );

            $this->add_control(
                'icon_position',
                [
                    'label' => esc_html__( 'Icon Position', 'haru-starter' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'inline-icon',
                    'label_block' => false,
                    'options' => [
                        'top-icon' => esc_html__( 'Stacked', 'haru-starter' ),
                        'inline-icon' => esc_html__( 'Inline', 'haru-starter' ),
                    ],
                    'condition' => [
                        'icon_show' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'pre_style',
                [
                    'label' => __( 'Pre Tab', 'haru-starter' ),
                    'description'   => __( 'If you choose Pre Tab you will use Style default from our theme.', 'haru-starter' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'      => __( 'None', 'haru-starter' ),
                        'style-1'   => __( 'Pre Tab 1', 'haru-starter' ),
                        'style-2'   => __( 'Pre Tab 2', 'haru-starter' ),
                    ]
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'content_section',
                [
                    'label' => esc_html__( 'Content', 'haru-starter' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'list_title', [
                    'label' => esc_html__( 'Title', 'haru-starter' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Title' , 'haru-starter' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'list_show_as_default', [
                    'label' => __( 'Set as Default', 'haru-starter' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'inactive',
                    'return_value' => 'active-default',
                ]
            );

            $repeater->add_control(
                'list_icon_type', [
                    'label' => esc_html__( 'Icon', 'haru-starter' ),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'none' => [
                            'title' => esc_html__( 'None', 'haru-starter' ),
                            'icon' => 'fa fa-ban',
                        ],
                        'icon' => [
                            'title' => esc_html__( 'Icon', 'haru-starter' ),
                            'icon' => 'fa fa-gear',
                        ],
                        'image' => [
                            'title' => esc_html__( 'Image', 'haru-starter' ),
                            'icon' => 'fa fa-picture-o',
                        ],
                    ],
                    'default' => 'icon',
                ]
            );

            $repeater->add_control(
                'list_title_icon', [
                    'label' => esc_html__( 'Icon', 'haru-starter' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'label_block' => true,
                    'condition' => [
                        'list_icon_type' => 'icon',
                    ],
                ]
            );

            $repeater->add_control(
                'list_title_image', [
                    'label' => esc_html__( 'Image', 'haru-starter' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'list_icon_type' => 'image',
                    ],
                ],
            );

            $repeater->add_control(
                'list_text_type', [
                    'label' => __( 'Content Type', 'haru-starter' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'content' => __( 'Content', 'haru-starter' ),
                        'template' => __( 'Saved Templates', 'haru-starter' ),
                    ],
                    'default' => 'content',
                ],
            );

            $repeater->add_control(
                'list_primary_templates', [
                    'label' => __( 'Choose Template', 'haru-starter' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => Helper::get_elementor_templates(),
                    'condition' => [
                        'list_text_type' => 'template',
                    ],
                ],
            );

            $repeater->add_control(
                'list_tab_content', [
                    'label' => esc_html__( 'Tab Content', 'haru-starter' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'haru-starter' ),
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'list_text_type' => 'content',
                    ],
                ],
            );

            $this->add_control(
                'list',
                [
                    'label' => esc_html__( 'Tab List', 'haru-starter' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => esc_html__( 'Tab Title 1', 'haru-starter' ),
                            'list_show_as_default' => 'inactive',
                            'list_icon_type' => 'icon',
                            'list_title_icon' => '',
                            'list_title_image' => '',
                            'list_text_type' => 'content',
                            'list_primary_templates' => '',
                            'list_tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'haru-starter' ),
                        ],
                        [
                            'list_title' => esc_html__( 'Tab Title 2', 'haru-starter' ),
                            'list_show_as_default' => 'inactive',
                            'list_icon_type' => 'icon',
                            'list_title_icon' => '',
                            'list_title_image' => '',
                            'list_text_type' => 'content',
                            'list_primary_templates' => '',
                            'list_tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'haru-starter' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
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

            // $this->add_control(
            //     'tab',
            //     [
            //         'type' => Controls_Manager::REPEATER,
            //         'seperator' => 'before',
            //         'default' => [
            //             ['eael_adv_tabs_tab_title' => esc_html__('Tab Title 1', 'haru-starter' )],
            //             ['eael_adv_tabs_tab_title' => esc_html__('Tab Title 2', 'haru-starter' )],
            //             ['eael_adv_tabs_tab_title' => esc_html__('Tab Title 3', 'haru-starter' )],
            //         ],
            //         'fields' => [
            //             [
            //                 'name' => 'eael_adv_tabs_tab_show_as_default',
            //                 'label' => __('Set as Default', 'haru-starter' ),
            //                 'type' => Controls_Manager::SWITCHER,
            //                 'default' => 'inactive',
            //                 'return_value' => 'active-default',
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_icon_type',
            //                 'label' => esc_html__('Icon Type', 'haru-starter' ),
            //                 'type' => Controls_Manager::CHOOSE,
            //                 'label_block' => false,
            //                 'options' => [
            //                     'none' => [
            //                         'title' => esc_html__('None', 'haru-starter' ),
            //                         'icon' => 'fa fa-ban',
            //                     ],
            //                     'icon' => [
            //                         'title' => esc_html__('Icon', 'haru-starter' ),
            //                         'icon' => 'fa fa-gear',
            //                     ],
            //                     'image' => [
            //                         'title' => esc_html__('Image', 'haru-starter' ),
            //                         'icon' => 'fa fa-picture-o',
            //                     ],
            //                 ],
            //                 'default' => 'icon',
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_tab_title_icon_new',
            //                 'label' => esc_html__('Icon', 'haru-starter' ),
            //                 'type' => Controls_Manager::ICONS,
            //                 'fa4compatibility' => 'eael_adv_tabs_tab_title_icon',
            //                 'default' => [
            //                     'value' => 'fas fa-home',
            //                     'library' => 'fa-solid',
            //                 ],
            //                 'condition' => [
            //                     'eael_adv_tabs_icon_type' => 'icon',
            //                 ],
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_tab_title_image',
            //                 'label' => esc_html__('Image', 'haru-starter' ),
            //                 'type' => Controls_Manager::MEDIA,
            //                 'default' => [
            //                     'url' => Utils::get_placeholder_image_src(),
            //                 ],
            //                 'condition' => [
            //                     'eael_adv_tabs_icon_type' => 'image',
            //                 ],
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_tab_title',
            //                 'label' => esc_html__('Tab Title', 'haru-starter' ),
            //                 'type' => Controls_Manager::TEXT,
            //                 'default' => esc_html__('Tab Title', 'haru-starter' ),
            //                 'dynamic' => ['active' => true],
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_text_type',
            //                 'label' => __('Content Type', 'haru-starter' ),
            //                 'type' => Controls_Manager::SELECT,
            //                 'options' => [
            //                     'content' => __('Content', 'haru-starter' ),
            //                     'template' => __('Saved Templates', 'haru-starter' ),
            //                 ],
            //                 'default' => 'content',
            //             ],
            //             [
            //                 'name' => 'eael_primary_templates',
            //                 'label' => __('Choose Template', 'haru-starter' ),
            //                 'type' => Controls_Manager::SELECT,
            //                 // 'options' => Helper::get_elementor_templates(),
            //                 'condition' => [
            //                     'eael_adv_tabs_text_type' => 'template',
            //                 ],
            //             ],
            //             [
            //                 'name' => 'eael_adv_tabs_tab_content',
            //                 'label' => esc_html__('Tab Content', 'haru-starter' ),
            //                 'type' => Controls_Manager::WYSIWYG,
            //                 'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'haru-starter' ),
            //                 'dynamic' => ['active' => true],
            //                 'condition' => [
            //                     'eael_adv_tabs_text_type' => 'content',
            //                 ],
            //             ],
            //         ],
            //         'title_field' => '{{eael_adv_tabs_tab_title}}',
            //     ]
            // );
            $this->end_controls_section();

            /**
             * -------------------------------------------
             * Tab Style Advance Tabs Generel Style
             * -------------------------------------------
             */
            $this->start_controls_section(
                'eael_section_adv_tabs_style_settings',
                [
                    'label' => esc_html__('General', 'haru-starter' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'eael_adv_tabs_padding',
                [
                    'label' => esc_html__('Padding', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_margin',
                [
                    'label' => esc_html__('Margin', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'eael_adv_tabs_border',
                    'label' => esc_html__('Border', 'haru-starter' ),
                    'selector' => '{{WRAPPER}} .eael-advance-tabs',
                ]
            );

            $this->add_responsive_control(
                'eael_adv_tabs_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'eael_adv_tabs_box_shadow',
                    'selector' => '{{WRAPPER}} .eael-advance-tabs',
                ]
            );
            $this->end_controls_section();
            /**
             * -------------------------------------------
             * Tab Style Advance Tabs Content Style
             * -------------------------------------------
             */
            $this->start_controls_section(
                'eael_section_adv_tabs_tab_style_settings',
                [
                    'label' => esc_html__('Tab Title', 'haru-starter' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_title_typography',
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_title_width',
                [
                    'label' => __('Title Min Width', 'haru-starter' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs.eael-tabs-vertical > .eael-tabs-nav > ul' => 'min-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'eael_adv_tab_layout' => 'eael-tabs-vertical',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_icon_size',
                [
                    'label' => __('Icon Size', 'haru-starter' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 16,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_icon_gap',
                [
                    'label' => __('Icon Gap', 'haru-starter' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .eael-tab-inline-icon li i, {{WRAPPER}} .eael-tab-inline-icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .eael-tab-top-icon li i, {{WRAPPER}} .eael-tab-top-icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_padding',
                [
                    'label' => esc_html__('Padding', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_margin',
                [
                    'label' => esc_html__('Margin', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('eael_adv_tabs_header_tabs');
            // Normal State Tab
            $this->start_controls_tab('eael_adv_tabs_header_normal', ['label' => esc_html__('Normal', 'haru-starter' )]);
            $this->add_control(
                'eael_adv_tabs_tab_color',
                [
                    'label' => esc_html__('Background Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f1f1f1',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_bgtype',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li',
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_text_color',
                [
                    'label' => esc_html__('Text Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_icon_color',
                [
                    'label' => esc_html__('Icon Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'eael_adv_tabs_icon_show' => 'yes',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_border',
                    'label' => esc_html__('Border', 'haru-starter' ),
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_tab();
            // Hover State Tab
            $this->start_controls_tab('eael_adv_tabs_header_hover', ['label' => esc_html__('Hover', 'haru-starter' )]);
            $this->add_control(
                'eael_adv_tabs_tab_color_hover',
                [
                    'label' => esc_html__('Tab Background Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_bgtype_hover',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover',
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_text_color_hover',
                [
                    'label' => esc_html__('Text Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_icon_color_hover',
                [
                    'label' => esc_html__('Icon Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover > i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'eael_adv_tabs_icon_show' => 'yes',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_border_hover',
                    'label' => esc_html__('Border', 'haru-starter' ),
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_border_radius_hover',
                [
                    'label' => esc_html__('Border Radius', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_tab();
            // Active State Tab
            $this->start_controls_tab('eael_adv_tabs_header_active', ['label' => esc_html__('Active', 'haru-starter' )]);
            $this->add_control(
                'eael_adv_tabs_tab_color_active',
                [
                    'label' => esc_html__('Tab Background Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#444',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active-default' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_bgtype_active',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active,{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active-default',
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_text_color_active',
                [
                    'label' => esc_html__('Text Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul .active-default .eael-tab-title' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_icon_color_active',
                [
                    'label' => esc_html__('Icon Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active > i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active-default > i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'eael_adv_tabs_icon_show' => 'yes',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'eael_adv_tabs_tab_border_active',
                    'label' => esc_html__('Border', 'haru-starter' ),
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active, {{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active-default',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_tab_border_radius_active',
                [
                    'label' => esc_html__('Border Radius', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();

            /**
             * -------------------------------------------
             * Tab Style Advance Tabs Content Style
             * -------------------------------------------
             */
            $this->start_controls_section(
                'eael_section_adv_tabs_tab_content_style_settings',
                [
                    'label' => esc_html__('Content', 'haru-starter' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'adv_tabs_content_bg_color',
                [
                    'label' => esc_html__('Background Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'adv_tabs_content_bgtype',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div',
                ]
            );
            $this->add_control(
                'adv_tabs_content_text_color',
                [
                    'label' => esc_html__('Text Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'eael_adv_tabs_content_typography',
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_content_padding',
                [
                    'label' => esc_html__('Padding', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_content_margin',
                [
                    'label' => esc_html__('Margin', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'eael_adv_tabs_content_border',
                    'label' => esc_html__('Border', 'haru-starter' ),
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div',
                ]
            );
            $this->add_responsive_control(
                'eael_adv_tabs_content_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'haru-starter' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .eael-tabs-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'eael_adv_tabs_content_shadow',
                    'selector' => '{{WRAPPER}} .eael-advance-tabs .eael-tabs-content > div',
                    'separator' => 'before',
                ]
            );
            $this->end_controls_section();

            /**
             * -------------------------------------------
             * Tab Style Advance Tabs Caret Style
             * -------------------------------------------
             */
            $this->start_controls_section(
                'eael_section_adv_tabs_tab_caret_style_settings',
                [
                    'label' => esc_html__('Caret', 'haru-starter' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_caret_show',
                [
                    'label' => esc_html__('Show Caret on Active Tab', 'haru-starter' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'return_value' => 'yes',
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_caret_size',
                [
                    'label' => esc_html__('Caret Size', 'haru-starter' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:after' => 'border-width: {{SIZE}}px; bottom: -{{SIZE}}px',
                        '{{WRAPPER}} .eael-advance-tabs.eael-tabs-vertical > .eael-tabs-nav > ul li:after' => 'right: -{{SIZE}}px; top: calc(50% - {{SIZE}}px) !important;',
                    ],
                    'condition' => [
                        'eael_adv_tabs_tab_caret_show' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'eael_adv_tabs_tab_caret_color',
                [
                    'label' => esc_html__('Caret Color', 'haru-starter' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#444',
                    'selectors' => [
                        '{{WRAPPER}} .eael-advance-tabs .eael-tabs-nav > ul li:after' => 'border-top-color: {{VALUE}};',
                        '{{WRAPPER}} .eael-advance-tabs.eael-tabs-vertical > .eael-tabs-nav > ul li:after' => 'border-top-color: transparent; border-left-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'eael_adv_tabs_tab_caret_show' => 'yes',
                    ],
                ]
            );
            $this->end_controls_section();

            /**
             * -------------------------------------------
             * Tab Style: Advance Tabs Responsive Controls
             * -------------------------------------------
             */
            $this->start_controls_section(
                'eael_ad_responsive_controls',
                [
                    'label' => esc_html__('Responsive Controls', 'essential-addons-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'responsive_vertical_layout',
                [
                    'label' => __('Vertical Layout', 'essential-addons-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'haru-starter' ),
                    'label_off' => __('No', 'haru-starter' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            if ( '' === $settings['list'] ) {
                return;
            }

            $this->add_render_attribute( 'tab', 'class', [ 'haru-tab', 'haru-tab--' . $settings['layout'] ] );

            if ( 'none' != $settings['pre_style']  ) {
                $this->add_render_attribute( 'tab', 'class', 'haru-tab--' . $settings['pre_style'] );
            }

            if ( ! empty( $settings['el_class'] ) ) {
                $this->add_render_attribute( 'tab', 'class', $settings['el_class'] );
            }

            $this->add_render_attribute( 'tab', 'id', 'haru-tab-' . $this->get_id() );

            $this->add_render_attribute( 'icon_position', 'class', $settings['icon_position'] );


            // $eael_find_default_tab = [];
            // $eael_adv_tab_id = 1;
            // $eael_adv_tab_content_id = 1;
            // $tab_icon_migrated = isset($settings['__fa4_migrated']['eael_adv_tabs_tab_title_icon_new']);
            // $tab_icon_is_new = empty($settings['eael_adv_tabs_tab_title_icon']);

            // $this->add_render_attribute(
            //     'eael_tab_wrapper',
            //     [
            //         'id' => "eael-advance-tabs-{$this->get_id()}",
            //         'class' => ['eael-advance-tabs', $settings['eael_adv_tab_layout']],
            //         'data-tabid' => $this->get_id(),
            //     ]
            // );
            // if ($settings['eael_adv_tabs_tab_caret_show'] != 'yes') {
            //     $this->add_render_attribute('eael_tab_wrapper', 'class', 'active-caret-on');
            // }

            // if ($settings['responsive_vertical_layout'] != 'yes') {
            //     $this->add_render_attribute('eael_tab_wrapper', 'class', 'responsive-vertical-layout');
            // }

            // $this->add_render_attribute('eael_tab_icon_position', 'class', esc_attr($settings['eael_adv_tab_icon_position']));
            ?>

            <div <?php echo $this->get_render_attribute_string( 'tab' ); ?>>
                <div class="haru-tab__nav">
                    <?php if ( $settings['list'] ) : ?>
                    <ul <?php echo $this->get_render_attribute_string( 'icon_position' ); ?>>
                        <?php foreach ( $settings['list'] as $tab ) : ?>
                            <li class="<?php echo esc_attr( $tab['list_show_as_default'] ); ?>">
                                <?php if ( $settings['icon_show'] === 'yes' ) : ?>
                                    <?php if ( $tab['list_icon_type'] === 'icon' ) : ?>
                                    <span class="haru-tab__icon"><?php Icons_Manager::render_icon( $tab['list_title_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                    <?php elseif ( $tab['list_icon_type'] === 'image') : ?>
                                        <img src="<?php echo esc_attr( $tab['list_title_image']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $tab['list_title_image']['id'], '_wp_attachment_image_alt', true ) ); ?>">
                                    <?php endif;?>
                                <?php endif; ?><span class="haru-tab__title"><?php echo $tab['list_title']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="haru-tab__content">
                    <?php foreach ( $settings['list'] as $tab ) : ?>
                        <div class="clearfix <?php echo esc_attr( $tab['list_show_as_default'] ); ?>">
                            <?php if ( 'content' == $tab['list_text_type'] ) : ?>
                                <?php echo do_shortcode( $tab['list_tab_content'] ); ?>
                            <?php elseif ( 'template' == $tab['list_text_type'] ) : ?>
                                <?php 
                                    if ( ! empty( $tab['list_primary_templates'] ) ) :
                                        echo Plugin::$instance->frontend->get_builder_content( $tab['list_primary_templates'], true );
                                    endif;
                                ?>
                            <?php endif;?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }

    }
}
