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

if ( ! class_exists( 'Haru_Starter_Business_Widget' ) ) {
	class Haru_Starter_Business_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-business';
		}

		public function get_title() {
			return esc_html__( 'Haru Business', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-social-icons';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
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
					'label' => __( 'Pre Business', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Business you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Business 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Business 2', 'haru-starter' ),
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
					'label' => esc_html__( 'Link List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_sub_title' => esc_html__( 'Sub Title', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
							'list_btn_text' => esc_html__( 'Click Here', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_sub_title' => esc_html__( 'Sub Title', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
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
				'section_title_style',
				[
					'label' => __( 'Title', 'haru-starter' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'business', 'class', 'haru-business' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'business', 'class', 'haru-business--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'business', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'business' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul>
						<?php 
							foreach ( $settings['list'] as $key => $item ) : 
							$target = $item['list_content']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['list_content']['nofollow'] ? ' rel="nofollow"' : '';
						?>
							<li class="haru-business__item <?php echo ($key == 0) ? 'haru-business__item--active' : ''; ?>">
								<div class="haru-business__sub-title"><?php echo $item['list_sub_title']; ?></div>
								<div class="haru-business__title"><?php echo $item['list_title']; ?></div>
								<div class="haru-business__description"><?php echo $item['list_description']; ?></div>
								<?php if ( 'style-1' == $settings['pre_style'] ) : ?>
								<a class="haru-business__btn haru-button haru-button--bg-<?php echo ($key == 0) ? 'white' : 'black'; ?> haru-button--size-large haru-button--round-large" href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $item['list_btn_text']; ?>
									<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
								</a>
								<?php elseif ( 'style-2' == $settings['pre_style'] ) : ?>
								<a class="haru-button haru-button--text haru-button--text-<?php echo ($key == 0) ? 'white' : 'primary'; ?>" href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $item['list_btn_text']; ?>
									<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
								</a>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
