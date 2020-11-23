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

if ( ! class_exists( 'Haru_Starter_Business_Widget' ) ) {
	class Haru_Starter_Business_Widget extends \Elementor\Widget_Base {

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
	                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Business', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Business you will use Style default from our theme.', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Business 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Business 2', 'haru-starter' ),
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
				'list_sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'List Sub Title' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_description', [
					'label' => esc_html__( 'Description', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'List Description' , 'haru-starter' ),
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

			$repeater->add_control(
				'list_btn_text', [
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
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

			// $this->add_control(
			// 	'section_title_style_description',
			// 	[
			// 		'type' => \Elementor\Controls_Manager::RAW_HTML,
			// 		'raw' => '<strong>' . __( 'You can set style if you set Pre Business is None.', 'haru-starter' ) . '</strong><br>',
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
			// 			'{{WRAPPER}} .haru-business__icon' => 'color: {{VALUE}};',
			// 			'{{WRAPPER}} .haru-business__icon svg path' => 'fill: {{VALUE}}!important;',
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
			// 			'{{WRAPPER}} .haru-business__title' => 'color: {{VALUE}};',
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
			// 			'{{WRAPPER}} .haru-business__icon' => 'font-size: {{SIZE}}{{UNIT}}',
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
			// 			'{{WRAPPER}} .haru-business__title' => 'font-size: {{SIZE}}{{UNIT}}',
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

        	extract( $settings );

        	$this->add_render_attribute( 'list', 'class', 'haru-business' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'list', 'class', 'haru-business--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'list', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'list' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul>
						<?php foreach (  $settings['list'] as $key => $item ) : ?>
							<li class="haru-business__item <?php echo ($key == 0) ? 'haru-business__item--active' : ''; ?>">
								<div class="haru-business__sub-title"><?php echo $item['list_sub_title']; ?></div>
								<div class="haru-business__title"><?php echo $item['list_title']; ?></div>
								<div class="haru-business__description"><?php echo $item['list_description']; ?></div>
								<a class="haru-business__btn haru-button <?php echo ($key == 0) ? 'haru-button--bg-white' : 'haru-button--bg-black'; ?> haru-button--size-large haru-button--round-large" href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $item['list_btn_text']; ?><i class="haru-icon haru-arrow-right"></i></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
