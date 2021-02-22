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
use \Elementor\Repeater;
use \Elementor\Plugin;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Counter_Widget' ) ) {
	class Haru_Starter_Counter_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-counter';
		}

		public function get_title() {
			return esc_html__( 'Haru Counter', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-number-field';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'counter',
                'count',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

        public function get_script_depends() {

			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['appear', 'countTo'];
		    }

		    return [ 'appear', 'countTo' ];

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
					'label' => __( 'Pre Counter', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Counter you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Counter 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Counter 2', 'haru-starter' ),
					]
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
				'list_number', [
					'label' => esc_html__( 'Number', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 0,
					'default' => 10,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_label', [
					'label' => esc_html__( 'Label', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '+' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_icon', [
					'label' => esc_html__( 'Icon', 'haru-starter' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-1' ],
					],
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Link List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_number' => esc_html__( '10', 'haru-starter' ),
							'list_label' => esc_html__( '+', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_number' => esc_html__( '10', 'haru-starter' ),
							'list_label' => esc_html__( '+', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
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

	        $this->end_controls_section();

	        $this->start_controls_section(
				'section_title_style',
				[
					'label' => __( 'Title', 'haru-starter' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			// $this->add_control(
			// 	'section_title_style_description',
			// 	[
			// 		'type' => \Elementor\Controls_Manager::RAW_HTML,
			// 		'raw' => '<strong>' . __( 'You can set style if you set Pre Counter is None.', 'haru-starter' ) . '</strong><br>',
			// 		'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			// 	]
			// );

			// $this->add_control(
			// 	'icon_color',
			// 	[
			// 		'label' => __( 'Icon Color', 'haru-starter' ),
			// 		'type' => \Elementor\Controls_Manager::COLOR,
			// 		'global' => [
			// 			'default' => '',
			// 		],
			// 		'condition' => [
			// 			'pre_style' => [ 'none' ],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .haru-social__icon' => 'color: {{VALUE}};',
			// 			'{{WRAPPER}} .haru-social__icon svg path' => 'fill: {{VALUE}}!important;',
			// 		],
			// 	]
			// );

			// $this->add_control(
			// 	'title_color',
			// 	[
			// 		'label' => __( 'Title Color', 'haru-starter' ),
			// 		'type' => \Elementor\Controls_Manager::COLOR,
			// 		'global' => [
			// 			'default' => '',
			// 		],
			// 		'condition' => [
			// 			'pre_style' => [ 'none' ],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .haru-social__title' => 'color: {{VALUE}};',
			// 		],
			// 	]
			// );

			// $this->add_control(
			// 	'hr',
			// 	[
			// 		'type' => \Elementor\Controls_Manager::DIVIDER,
			// 		'condition' => [
			// 			'pre_style' => [ 'none' ],
			// 		],
			// 	]
			// );

			// $this->add_control(
			// 	'icon_font_size',
			// 	[
			// 		'label' => __( 'Icon Font Size', 'haru-starter' ),
			// 		'type' => \Elementor\Controls_Manager::SLIDER,
			// 		'range' => [
			// 			'px' => [
			// 				'max' => 60,
			// 			],
			// 		],
			// 		'condition' => [
			// 			'pre_style' => [ 'none' ],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .haru-social__icon' => 'font-size: {{SIZE}}{{UNIT}}',
			// 		],
			// 	]
			// );

			// $this->add_control(
			// 	'title_font_size',
			// 	[
			// 		'label' => __( 'Title Font Size', 'haru-starter' ),
			// 		'type' => \Elementor\Controls_Manager::SLIDER,
			// 		'range' => [
			// 			'px' => [
			// 				'max' => 60,
			// 			],
			// 		],
			// 		'condition' => [
			// 			'pre_style' => [ 'none' ],
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .haru-social__title' => 'font-size: {{SIZE}}{{UNIT}}',
			// 		],
			// 	]
			// );

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'counter', 'class', 'haru-counter' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'counter', 'class', 'haru-counter--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'counter', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'counter' ); ?>>
        		<?php echo Haru_Template::haru_get_template( 'counter/counter.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
