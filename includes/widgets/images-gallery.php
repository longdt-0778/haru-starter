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
use \Elementor\Utils;
use \Elementor\Plugin;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Images_Gallery_Widget' ) ) {
	class Haru_Starter_Images_Gallery_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-images-gallery';
		}

		public function get_title() {
			return esc_html__( 'Haru Images Gallery', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-photo-library';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'image',
                'images',
                'gallery',
                'portfolio',
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
	                // 'tab' => Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Images Gallery', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Images Gallery you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Images Gallery (Carousel)', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Images Gallery 2', 'haru-starter' ),
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
				'list_sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'List Sub Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-1' ],
					],
				]
			);

			$repeater->add_control(
				'list_description', [
					'label' => esc_html__( 'Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'List Description' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-1' ],
					],
				]
			);

			$repeater->add_control(
	            'list_image',
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

			$repeater->add_control(
				'list_content', [
					'label' => esc_html__( 'Link', 'haru-starter' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
					'condition' => [
						'pre_style!' => [ 'style-1' ],
					],
				]
			);

			$repeater->add_control(
				'list_btn_text', [
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-1' ],
					],
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Images List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_sub_title' => esc_html__( 'Sub Title', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
							'list_image' => esc_html__( 'Select Image', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
							'list_btn_text' => esc_html__( 'Click Here', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_sub_title' => esc_html__( 'Sub Title', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
							'list_image' => esc_html__( 'Select Image', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
							'list_btn_text' => esc_html__( 'Click Here', 'haru-starter' ),
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
	            'slide_section',
	            [
	                'label' => esc_html__( 'Slide Options', 'haru-starter' ),
	                'tab' => Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'section_title_slide_description',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set Slide Options if you set Pre Images Gallery is Slide layout.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
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
                ]
            );
	     	
	     	$this->add_control(
				'heading_tablet_slide_options',
				[
					'label' 	=> __( 'Tablet Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
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
				]
			);
	     	
	     	$this->add_control(
				'heading_mobile_slide_options',
				[
					'label' 	=> __( 'Mobile Settings', 'haru-starter' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
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
				]
			);

	        $this->end_controls_section();
		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'images-gallery', 'class', 'haru-images-gallery' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'images-gallery', 'class', 'haru-images-gallery--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'images-gallery', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'images-gallery' ); ?>>
        		<?php echo Haru_Template::haru_get_template( 'images-gallery/images-gallery.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
