<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Haru_Starter_Footer_Link_Widget' ) ) {
	class Haru_Starter_Footer_Link_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'haru-footer-link';
		}

		public function get_title() {
			return esc_html__( 'Haru Footer Link', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-text';
		}

		public function get_categories() {
			return [ 'haru-footer-elements' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' => esc_html__( 'Content', 'haru-starter' ),
	                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Footer Link', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Footer Link you will use Style default from our theme.', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Footer Link 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Footer Link 2', 'haru-starter' ),
					]
				]
			);

	        $repeater = new \Elementor\Repeater();

	        $repeater->add_control(
				'list_title', [
					'label' => esc_html__( 'Title', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'List Title' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_content', [
					'label' => esc_html__( 'Link', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::URL,
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
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => esc_html__( 'Title #1', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'haru-starter' ),
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);

	        $this->add_control(
	            'el_class',
	            [
	                'label'         => esc_html__( 'Extra Class', 'haru-starter' ),
	                'type'          => \Elementor\Controls_Manager::TEXT,
	                'description'   => esc_html__( 'Add extra class for Element and use custom CSS for get different style.', 'haru-starter' ),
	                'placeholder'   => esc_html__( 'Ex: haru-extra', 'haru-starter' ),
	            ]
	        );

	        $this->end_controls_section();

	        $this->start_controls_section(
				'section_title_style',
				[
					'label' => __( 'Title', 'haru-starter' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'section_title_style_description',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'You can set style if you set Pre Footer Link is None.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

	        $this->start_controls_tabs( 
	        	'footer_link_item_style',
	        	[
	        		'condition' => [
						'pre_style' => [ 'none' ],
					],
	        	]
	        );

			$this->start_controls_tab(
				'footer_link_item_normal',
				[
					'label' => __( 'Normal', 'haru-starter' ),
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-footer-link a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'footer_link_item_hover',
				[
					'label' => __( 'Hover', 'haru-starter' ),
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-footer-link a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'footer_link_item_active',
				[
					'label' => __( 'Active', 'haru-starter' ),
				]
			);

			$this->add_control(
				'title_color_active',
				[
					'label' => __( 'Text Color', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'global' => [
						'default' => '',
					],
					'condition' => [
						'pre_style' => [ 'none' ],
					],
					'selectors' => [
						'{{WRAPPER}} .haru-footer-link a:active' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['list'] ) {
				return;
			}

        	extract( $settings );

        	$this->add_render_attribute( 'list', 'class', 'haru-footer-link' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'list', 'class', 'haru-footer-link--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'list', 'class', $settings['el_class'] );
			}

			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'list' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul>
						<?php
							foreach (  $settings['list'] as $item ) :
							$target = $item['list_content']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['list_content']['nofollow'] ? ' rel="nofollow"' : '';
						?>
							<li><a href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $item['list_title']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}