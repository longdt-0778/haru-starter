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
use \Elementor\Repeater;
use \Elementor\Plugin;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Logo_Showcase_Widget' ) ) {
	class Haru_Starter_Logo_Showcase_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-logo-showcase';
		}

		public function get_title() {
			return esc_html__( 'Haru Logo Showcase', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-slider-album';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'logo',
                'client',
                'showcase',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

        public function get_script_depends() {

			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['slick', 'other_conditional_script'];
		    }

			// if ( $this->get_settings_for_display( 'layout_style' ) == 'carousel' ) {
		 //        return [ 'slick' ];
		 //    } else if ( $this->get_settings_for_display( 'condition' ) === 'yes' ) {
		 //        return [ 'other_conditional_script' ];
		 //    }

		    return [ 'slick' ];

		}

		public function get_style_depends() {
			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['slick', 'other_conditional_script'];
		    }

			return [ 'slick' ];
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
					'label' => __( 'Pre Logo Showcase', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Logo Showcase you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'slick' 	=> __( 'Slick Carousel', 'haru-starter' ),
						'grid' 		=> __( 'Grid', 'haru-starter' ),
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
	            'list_logo',
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

			$repeater->add_control(
				'list_link', [
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
				'list',
				[
					'label' => esc_html__( 'Link List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_logo' => esc_html__( 'Select Image', 'haru-starter' ),
							'list_link' => esc_html__( 'Item Link. Click the edit button to change this text.', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_logo' => esc_html__( 'Select Image', 'haru-starter' ),
							'list_link' => esc_html__( 'Item Link. Click the edit button to change this text.', 'haru-starter' ),
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
	            'grid_section',
	            [
	                'label' => esc_html__( 'Grid Options', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'section_title_grid_description',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set Grid Options if you set Pre Logo Showcase is Grid or None layout.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
	     	
	     	$this->add_control(
				'heading_desktop_grid_options',
				[
					'label' 	=> __( 'Desktop Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);

	        $this->add_control(
				'columns',
				[
					'label' => __( 'Columns', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 8,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);
	     	
	     	$this->add_control(
				'heading_tablet_grid_options',
				[
					'label' 	=> __( 'Tablet Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);

			$this->add_control(
				'columns_tablet',
				[
					'label' => __( 'Columns', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 6,
					'step' => 1,
					'default' => 4,
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);
	     	
	     	$this->add_control(
				'heading_mobile_grid_options',
				[
					'label' 	=> __( 'Mobile Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);

			$this->add_control(
				'columns_mobile',
				[
					'label' => __( 'Columns', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 4,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'none', 'grid' ],
					],
				]
			);

			$this->end_controls_section();

	        $this->start_controls_section(
	            'slide_section',
	            [
	                'label' => esc_html__( 'Slide Options', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_STYLE,
	            ]
	        );

	        $this->add_control(
				'section_title_slide_description',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set Slide Options if you set Pre Logo Showcase is Slick layout.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
                'arrows', [
                    'label' => __( 'Arrows', 'haru-starter' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'haru-starter' ),
					'label_off' => __( 'Hide', 'haru-starter' ),
					'return_value' => 'yes',
					'default' => 'yes',
	                'condition' => [
						'pre_style' => [ 'slick' ],
					],
                ]
            );

            $this->add_control(
				'rows',
				[
					'label' => __( 'Number of Rows', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 3,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);
	     	
	     	$this->add_control(
				'heading_desktop_slide_options',
				[
					'label' 	=> __( 'Desktop Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

	        $this->add_control(
				'slidesToShow',
				[
					'label' => __( 'Slide To Show', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 3,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

			$this->add_control(
				'slidesToScroll',
				[
					'label' => __( 'Slide To Scroll', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);
	     	
	     	$this->add_control(
				'heading_tablet_slide_options',
				[
					'label' 	=> __( 'Tablet Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

			$this->add_control(
				'slidesToShow_tablet',
				[
					'label' => __( 'Slide To Show', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 3,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

			$this->add_control(
				'slidesToScroll_tablet',
				[
					'label' => __( 'Slide To Scroll', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);
	     	
	     	$this->add_control(
				'heading_mobile_slide_options',
				[
					'label' 	=> __( 'Mobile Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

			$this->add_control(
				'slidesToShow_mobile',
				[
					'label' => __( 'Slide To Show', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

			$this->add_control(
				'slidesToScroll_mobile',
				[
					'label' => __( 'Slide To Scroll', 'haru-starter' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 1,
					'condition' => [
						'pre_style' => [ 'slick' ],
					],
				]
			);

	        $this->end_controls_section();

	        $this->start_controls_section(
				'layout_section',
				[
					'label' => __( 'Layout', 'haru-starter' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'hover',
				[
					'label' => __( 'Hover Style', 'haru-starter' ),
					'description' 	=> __( 'Choose Logo Hover style.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'opacity' 	=> __( 'Opacity', 'haru-starter' ),
						'scale' 	=> __( 'Scale', 'haru-starter' ),
					]
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'logo-showcase', 'class', 'haru-logo-showcase' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'logo-showcase', 'class', 'haru-logo-showcase--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'logo-showcase', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'logo-showcase' ); ?>>
        		<?php echo Haru_Template::haru_get_template( 'logo-showcase/logo-showcase.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
