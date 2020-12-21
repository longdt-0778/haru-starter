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
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Contact_Widget' ) ) {
	class Haru_Starter_Contact_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-contact';
		}

		public function get_title() {
			return esc_html__( 'Haru Contact', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-bullet-list';
		}

		public function get_categories() {
			return [ 'haru-elements', 'haru-footer-elements' ];
		}

		public function get_keywords() {
            return [
                'contact',
                'contact us',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' => esc_html__( 'Contact Settings', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Contact', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Contact you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Contact 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Contact 2', 'haru-starter' ),
						'style-3' 	=> __( 'Pre Contact 3', 'haru-starter' ),
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
				'list_icon', [
					'label' => esc_html__( 'Icon', 'haru-starter' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_content', [
					'label' => esc_html__( 'Content', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'placeholder' => __( 'Please insert content', 'haru-starter' ),
					'default' => '',
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Contact List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);

			$this->add_control(
				'heading', [
					'label' => esc_html__( 'Heading', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Contact Us' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-3' ],
					],
				]
			);

			$this->add_control(
				'map_link', [
					'label' => esc_html__( 'Map Link', 'haru-starter' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
					'condition' => [
						'pre_style' => [ 'style-3' ],
					],
				]
			);

			$this->add_control(
				'map_btn', [
					'label' => esc_html__( 'Map Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'View Map' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-3' ],
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
					'raw' => '<strong>' . __( 'You can set style if you set Pre Contact is None.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => __( 'Icon Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__icon' => 'color: {{VALUE}};',
						'{{WRAPPER}} .haru-contact__icon svg path' => 'fill: {{VALUE}}!important;',
					],
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'content_color_active',
				[
					'label' => __( 'Content Color', 'haru-starter' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__desc, {{WRAPPER}} .haru-contact__desc a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'hr',
				[
					'type' => Controls_Manager::DIVIDER,
					'condition' => [
						'pre_style' => [ 'none' ],
					],
				]
			);

			$this->add_control(
				'icon_font_size',
				[
					'label' => __( 'Icon Font Size', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__icon' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'title_font_size',
				[
					'label' => __( 'Title Font Size', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__title' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'content_font_size',
				[
					'label' => __( 'Content Font Size', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 60,
						],
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-contact__desc, {{WRAPPER}} .haru-contact__desc a' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'contact', 'class', 'haru-contact' );

        	if ( 'none' != $settings['pre_style'] ) {
				$this->add_render_attribute( 'contact', 'class', 'haru-contact--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'contact', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'contact' ); ?>>
        		<?php echo Haru_Template::haru_get_template( 'contact/contact.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
