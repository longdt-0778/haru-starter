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
use \Elementor\Plugin;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Meaning_Widget' ) ) {
	class Haru_Starter_Meaning_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-meaning';
		}

		public function get_title() {
			return esc_html__( 'Haru Meaning', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-info-box';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_script_depends() {

			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['magnific-popup'];
		    }

		    return [ 'magnific-popup' ];

		}

		public function get_style_depends() {
			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['magnific-popup'];
		    }

			return [ 'magnific-popup' ];
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
					'label' => __( 'Pre Meaning', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Meaning you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Meaning 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Meaning 2', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'title', [
					'label' => esc_html__( 'Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Title' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Sub Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-2' ],
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
	            'image_bg',
	            [
	                'label' 	=> esc_html__( 'Choose Background Image', 'haru-starter' ),
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
				'btn_text', [
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
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
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'default' => [
						'url' => '#',
					],
					'condition' => [
						'pre_style' => [ 'style-2' ],
					],
				]
			);

			$this->add_control(
				'popup_title', [
					'label' => esc_html__( 'Popup Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Popup Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-1' ],
					],
				]
			);

			$this->add_control(
				'popup_content', [
					'label' => esc_html__( 'Popup Content', 'haru-starter' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Popup Content' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-1' ],
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

        	$this->add_render_attribute( 'meaning', 'class', 'haru-meaning' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'meaning', 'class', 'haru-meaning--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'meaning', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'meaning' ); ?>>
        		<div class="haru-meaning__wrap" style="background-image: url(<?php echo esc_url( $settings['image_bg']['url'] ); ?>);">
					<div class="haru-meaning__image">
						<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</div>
					<div class="haru-meaning__content">
						<div class="haru-meaning__sub-title"><?php echo $settings['sub_title']; ?></div>
						<div class="haru-meaning__title"><?php echo $settings['title']; ?></div>
						<div class="haru-meaning__description"><?php echo $settings['description']; ?></div>
						<div class="haru-meaning__btn">
							<?php if ( in_array( $settings['pre_style'], array( 'style-1' ) ) ) : ?>
							<a href="#meaning-popup-<?php echo esc_attr( $this->get_id() ); ?>" class="haru-meaning__click haru-button haru-button--text haru-button--text-white"><?php echo $settings['btn_text']; ?>
								<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
							</a>
							<?php elseif ( in_array( $settings['pre_style'], array( 'style-2' ) ) ) : 
								$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
							?>
							<a href="<?php echo $settings['link']['url']; ?>" <?php echo $target . $nofollow; ?> class="haru-button haru-button--text haru-button--text-white"><?php echo $settings['btn_text']; ?>
								<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div id="meaning-popup-<?php echo esc_attr( $this->get_id() ); ?>" class="white-popup mfp-hide haru-meaning__popup-content">
					<div class="haru-meaning__popup-image">
						<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</div>
					<div class="haru-meaning__popup-description">
						<h6 class="haru-meaning__popup-heading"><?php echo $settings['title']; ?></h6>
						<div class="haru-meaning__popup-info">
							<?php echo $settings['popup_content']; ?>
						</div>
					</div>
				</div>
    		</div>

    		<?php
		}

	}
}
