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

if ( ! class_exists( 'Haru_Starter_Project_Carousel_Widget' ) ) {
	class Haru_Starter_Project_Carousel_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-project-carousel';
		}

		public function get_title() {
			return esc_html__( 'Haru Project Carousel', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-slides';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
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
					'label' => __( 'Pre Project Carousel', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Project Carousel you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Project Carousel 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Project Carousel 2', 'haru-starter' ),
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
				]
			);

			$repeater->add_control(
				'list_description', [
					'label' => esc_html__( 'Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'List Description' , 'haru-starter' ),
					'label_block' => true,
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
				]
			);

			$repeater->add_control(
				'list_btn_text', [
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Slide List', 'haru-starter' ),
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

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'project-carousel', 'class', 'haru-project-carousel' );

        	if ( 'none' != $settings['pre_style'] ) {
				$this->add_render_attribute( 'project-carousel', 'class', 'haru-project-carousel--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'project-carousel', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'project-carousel' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul class="haru-slick" data-slick='{"slidesToShow" : 1, "slidesToScroll" : 1, "arrows" : true, "infinite" : false, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767,"settings" : {"slidesToShow" : 1}}] }'>
						<?php 
							foreach (  $settings['list'] as $item ) :
							$target = $item['list_content']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['list_content']['nofollow'] ? ' rel="nofollow"' : '';
						?>
							<li class="haru-project-carousel__item">
								<img src="<?php echo esc_url( $item['list_image']['url'] ); ?>" class="haru-project-carousel__image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<div class="haru-project-carousel__content">
									<div class="haru-project-carousel__sub-title"><?php echo $item['list_sub_title']; ?></div>
									<h6 class="haru-project-carousel__title">
										<a href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?> >
											<?php echo $item['list_title']; ?>
										</a>
									</h6>
									<div class="haru-project-carousel__description"><?php echo $item['list_description']; ?></div>
									<?php if ( 'style-2' != $settings['pre_style'] ) : ?>
									<a href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?> class="haru-button haru-button--text haru-button--text-primary"><?php echo $item['list_btn_text']; ?><span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span></a>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
