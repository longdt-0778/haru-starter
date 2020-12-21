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

if ( ! class_exists( 'Haru_Starter_List_Content_Widget' ) ) {
	class Haru_Starter_List_Content_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-list-content';
		}

		public function get_title() {
			return esc_html__( 'Haru List Content', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-social-icons';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'list',
                'content',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
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
					'label' => __( 'Pre List Content', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre List Content you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre List Content 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre List Content 2', 'haru-starter' ),
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
				'list_description', [
					'label' => esc_html__( 'Description', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
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

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Link List', 'haru-starter' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_description' => esc_html__( 'Description', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
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

			$this->add_control(
				'section_title_style_description',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set style if you set Pre Social is None.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	$this->add_render_attribute( 'list-content', 'class', 'haru-list-content' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'list-content', 'class', 'haru-list-content--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'list-content', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'list-content' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul>
						<?php foreach (  $settings['list'] as $item ) : ?>
							<li>
								<div class="haru-list-content__icon"><i class="haru-icon haru-icon-check"></i></div>
								<div class="haru-list-content__content">
									<div class="haru-list-content__title"><?php echo $item['list_title']; ?></div>
									<div class="haru-list-content__description"><?php echo $item['list_description']; ?></div>
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
