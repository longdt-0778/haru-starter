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

if ( ! class_exists( 'Haru_Starter_Counter_Widget' ) ) {
	class Haru_Starter_Counter_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'haru-counter';
		}

		public function get_title() {
			return esc_html__( 'Haru Counter', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-number-field';
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
					'label' => __( 'Pre Counter', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Counter you will use Style default from our theme.', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Counter 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Counter 2', 'haru-starter' ),
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
				'list_number', [
					'label' => esc_html__( 'Number', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'default' => 10,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_label', [
					'label' => esc_html__( 'Label', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( '+' , 'haru-starter' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'list_icon', [
					'label' => esc_html__( 'Icon', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'label_block' => true,
					'condition' => [
						'pre_style!' => [ 'style-1' ],
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
							'list_number' => esc_html__( '10', 'haru-starter' ),
							'list_label' => esc_html__( '+', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
						],
						[
							'list_title' => esc_html__( 'Title #2', 'haru-starter' ),
							'list_number' => esc_html__( '10', 'haru-starter' ),
							'list_label' => esc_html__( '+', 'haru-starter' ),
							'list_icon' => esc_html__( 'Item icon. Click to select icon', 'haru-starter' ),
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
			// 		'raw' => '<strong>' . __( 'You can set style if you set Pre Counter is None.', 'haru-starter' ) . '</strong><br>',
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
			// 			'{{WRAPPER}} .haru-social__icon' => 'color: {{VALUE}};',
			// 			'{{WRAPPER}} .haru-social__icon svg path' => 'fill: {{VALUE}}!important;',
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
			// 			'{{WRAPPER}} .haru-social__title' => 'color: {{VALUE}};',
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
			// 			'{{WRAPPER}} .haru-social__icon' => 'font-size: {{SIZE}}{{UNIT}}',
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
			// 			'{{WRAPPER}} .haru-social__title' => 'font-size: {{SIZE}}{{UNIT}}',
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

        	$this->add_render_attribute( 'list', 'class', 'haru-counter' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'list', 'class', 'haru-counter--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'list', 'class', $settings['el_class'] );
			}
			
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'list' ); ?>>
        		<?php if ( $settings['list'] ) : ?>
					<ul>
						<?php foreach (  $settings['list'] as $item ) : ?>
							<li>
								<?php if ( $item['list_icon'] ) : ?>
									<div class="haru-counter__icon"><?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
								<?php endif; ?>
								<div class="haru-counter__number-wrap">
									<div class="haru-counter__number"><?php echo $item['list_number']; ?></div>
									<div class="haru-counter__label"><?php echo $item['list_label']; ?></div>
								</div>
								<div class="haru-counter__title"><?php echo $item['list_title']; ?></div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}