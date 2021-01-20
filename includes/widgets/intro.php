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
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Intro_Widget' ) ) {
	class Haru_Starter_Intro_Widget extends Widget_Base {

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
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
				'pre_style',
				[
					'label' => __( 'Pre Intro', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Intro you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style-1',
					'options' => [
						'style-1' 	=> __( 'Pre Intro 1', 'haru-starter' ),
						'style-2' 	=> __( 'Pre Intro 2', 'haru-starter' ),
						'style-3' 	=> __( 'Pre Intro 3', 'haru-starter' ),
						'style-4' 	=> __( 'Pre Intro 4', 'haru-starter' ),
						'style-5' 	=> __( 'Pre Intro 5', 'haru-starter' ),
						'style-6' 	=> __( 'Pre Intro 6', 'haru-starter' ),
						'style-7' 	=> __( 'Pre Intro 7', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'title', [
					'label' => esc_html__( 'Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-2', 'style-3', 'style-4' ],
					],
				]
			);

			$this->add_control(
				'sub_title', [
					'label' => esc_html__( 'Sub Title', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Sub Title' , 'haru-starter' ),
					'label_block' => true,
					'condition' => [
						'pre_style' => [ 'style-2', 'style-3', 'style-4' ],
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

        	$this->add_render_attribute( 'intro', 'class', 'haru-intro' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'intro', 'class', 'haru-intro--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'intro', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'intro' ); ?>>
        		<?php if ( in_array( $settings['pre_style'], array( 'style-1', 'style-2', 'style-3' ) ) ) : ?>
        		<div class="haru-intro__content">
	        		<div class="haru-intro__sub-title"><?php echo $settings['sub_title']; ?></div>
					<div class="haru-intro__title"><?php echo $settings['title']; ?></div>
				</div>
				<div class="haru-intro__description"><?php echo $settings['description']; ?></div>
				<div class="haru-intro__image">
					<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
				<?php elseif ( in_array( $settings['pre_style'], array( 'style-4' ) ) ) : ?>
					<div class="haru-intro__image">
						<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</div>
					<div class="haru-intro__content">
		        		<div class="haru-intro__sub-title"><?php echo $settings['sub_title']; ?></div>
						<div class="haru-intro__title"><?php echo $settings['title']; ?></div>
						<div class="haru-intro__description"><?php echo $settings['description']; ?></div>
					</div>
				<?php elseif ( in_array( $settings['pre_style'], array( 'style-5', 'style-6', 'style-7' ) ) ) : ?>
					<div class="haru-intro__image">
						<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</div>
					<div class="haru-intro__content">
						<div class="haru-intro__description"><?php echo $settings['description']; ?></div>
					</div>
				<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
