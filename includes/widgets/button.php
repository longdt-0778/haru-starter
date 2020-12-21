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
use \Elementor\Icons_Manager;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Button_Widget' ) ) {
	class Haru_Starter_Button_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-button';
		}

		public function get_title() {
			return esc_html__( 'Haru Button', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-button';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'button',
                'link',
                'action',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		public static function get_button_sizes() {
			return [
				'xs' => __( 'Extra Small', 'haru-starter' ),
				'sm' => __( 'Small', 'haru-starter' ),
				'md' => __( 'Medium', 'haru-starter' ),
				'lg' => __( 'Large', 'haru-starter' ),
				'xl' => __( 'Extra Large', 'haru-starter' ),
			];
		}

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' 	=> esc_html__( 'Button Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Button', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Button you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Button 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Button 2', 'haru-starter' ),
						'style-3' 	=> __( 'Pre Button 3', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'text',
				[
					'label' => __( 'Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => __( 'Click here', 'haru-starter' ),
					'placeholder' => __( 'Click here', 'haru-starter' ),
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
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'haru-starter' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
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
					'prefix_class' => 'haru-align-',
					'default' => '',
				]
			);

			$this->add_control(
				'size',
				[
					'label' => __( 'Size', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'sm',
					'options' => self::get_button_sizes(),
					'style_transfer' => true,
					'condition' => [
						'pre_style' => [ 'none' ],
					],
				]
			);

			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'haru-starter' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
				]
			);

			$this->add_control(
				'icon_align',
				[
					'label' => __( 'Icon Position', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'left',
					'options' => [
						'left' => __( 'Before', 'haru-starter' ),
						'right' => __( 'After', 'haru-starter' ),
					],
					'condition' => [
						'selected_icon[value]!' => '',
					],
				]
			);

			$this->add_control(
				'icon_indent',
				[
					'label' => __( 'Icon Spacing', 'haru-starter' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-button .haru-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .haru-button .haru-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
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

			$this->add_control(
				'button_css_id',
				[
					'label' => __( 'Button ID', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => '',
					'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'haru-starter' ),
					'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'haru-starter' ),
					'separator' => 'before',
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

        	$this->add_render_attribute( 'button-wrap', 'class', 'haru-button-wrap' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'button-wrap', 'class', $settings['el_class'] );
			}

        	$this->add_render_attribute( 'button', 'class', ['haru-button', 'elementor-button1'] );
        	$this->add_render_attribute( 'button', 'role', 'button' );

        	if ( 'style-1' == $settings['pre_style'] ) {
				$this->add_render_attribute( 
					'button',
					'class',
					[
						'haru-button--' . $settings['pre_style'],
						'haru-button--bg-black',
						'haru-button--round-small', 
						'haru-button--size-medium'
					]
				);
			} else if ( 'style-2' == $settings['pre_style'] ) {
				$this->add_render_attribute( 
					'button',
					'class',
					[
						'haru-button--' . $settings['pre_style'],
						'haru-button--bg-black',
						'haru-button--round-full'
					]
				);
			} else if ( 'style-3' == $settings['pre_style'] ) {
				$this->add_render_attribute( 
					'button',
					'class',
					[
						'haru-button--' . $settings['pre_style'],
						'haru-button--bg-black',
						'haru-button--size-large',
						'haru-button--round-small'
					]
				);
			} else {
				$this->add_render_attribute( 
					'button',
					'class',
					[
						'haru-button--' . $settings['pre_style'],
						'haru-button--bg-black',
						'haru-button--round-small'
					]
				);
			}

			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_link_attributes( 'button', $settings['link'] );
				$this->add_render_attribute( 'button', 'class', 'elementor-button-link1 haru-button-link' );
			}

			if ( ! empty( $settings['button_css_id'] ) ) {
				$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
			}

			if ( ! empty( $settings['size'] ) ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
			}

			if ( $settings['hover_animation'] ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
        		<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
        			<?php $this->render_text(); ?>
    			</a>
    		</div>

    		<?php
		}

		protected function render_text() {
			$settings = $this->get_settings_for_display();

			$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
			$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			if ( ! $is_new && empty( $settings['icon_align'] ) ) {
				// @todo: remove when deprecated
				// added as bc in 2.6
				//old default
				$settings['icon_align'] = $this->get_settings( 'icon_align' );
			}

			$this->add_render_attribute( [
				'content-wrapper' => [
					'class' => 'elementor-button-content-wrapper1 haru-button-content-wrapper',
				],
				'icon-align' => [
					'class' => [
						// 'elementor-button-icon',
						'haru-button-icon',
						// 'elementor-align-icon-' . $settings['icon_align'],
						'haru-align-icon-' . $settings['icon_align'],
					],
				],
				'text' => [
					'class' => 'elementor-button-text1 haru-button-text',
				],
			] );

			$this->add_inline_editing_attributes( 'text', 'none' );
			?>
			<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
				<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
					<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
			</span>
			<?php
		}

		public function on_import( $element ) {
			return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon' );
		}

	}
}
