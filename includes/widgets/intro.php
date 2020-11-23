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

if ( ! class_exists( 'Haru_Starter_Intro_Widget' ) ) {
	class Haru_Starter_Intro_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'haru-intro';
		}

		public function get_title() {
			return esc_html__( 'Haru Intro', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' 	=> esc_html__( 'Content', 'haru-starter' ),
	                'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Intro', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Intro you will use Style default from our theme.', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Intro 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Intro 2', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'title', [
					'label' => esc_html__( 'Title', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-2' ],
					],
				]
			);

			$this->add_control(
				'sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::TEXT,
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
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Description' , 'haru-starter' ),
					'label_block' => true,
				]
			);

	        $this->add_control(
	            'image',
	            [
	                'label' 	=> esc_html__( 'Choose Image', 'haru-starter' ),
	                'type' 		=> \Elementor\Controls_Manager::MEDIA,
	                'dynamic' 	=> [
	                    'active' 	=> true,
	                ],
	                'default' 	=> [
	                    'url'		=> \Elementor\Utils::get_placeholder_image_src(),
	                ],
	            ]
	        );

	        $this->add_control(
	            'el_class',
	            [
	                'label'         => esc_html__( 'Extra Class', 'haru-starter' ),
	                'type'          => \Elementor\Controls_Manager::TEXT,
	                'placeholder'   => esc_html__( 'Add extra class for Element and use custom CSS for get different style.', 'haru-starter' ),
	            ]
	        );

	        $this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

        	extract( $settings );

        	$this->add_render_attribute( 'intro', 'class', 'haru-intro' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'intro', 'class', 'haru-intro--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'intro', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'intro' ); ?>>
        		<div class="haru-intro__content">
	        		<div class="haru-intro__sub-title"><?php echo $settings['sub_title']; ?></div>
					<div class="haru-intro__title"><?php echo $settings['title']; ?></div>
				</div>
				<div class="haru-intro__description"><?php echo $settings['description']; ?></div>
				<div class="haru-intro__image">
					<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
    		</div>

    		<?php
		}

	}
}
