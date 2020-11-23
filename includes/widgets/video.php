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

if ( ! class_exists( 'Haru_Starter_Video_Widget' ) ) {
	class Haru_Starter_Video_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'haru-video';
		}

		public function get_title() {
			return esc_html__( 'Haru Video', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-instagram-video';
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
					'label' => __( 'Pre Video', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre Video you will use Style default from our theme.', 'haru-starter' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' 		=> __( 'None', 'haru-starter' ),
						'style-1' 	=> __( 'Pre Video 1', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'video_desktop_url',
				[
					'label' => __( 'Video Desktop File', 'elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
						'categories' => [
							Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
						],
					],
					'media_type' => 'video',
				]
			);

			$this->add_control(
				'video_mobile_url',
				[
					'label' => __( 'Video Mobile File', 'elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
						'categories' => [
							Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
						],
					],
					'media_type' => 'video',
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
					'raw' => '<strong>' . __( 'You can set style if you set Pre Video is None.', 'haru-starter' ) . '</strong><br>',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->end_controls_section();

		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			if ( '' === $settings['video_desktop_url'] ) {
				return;
			}

        	extract( $settings );

        	$this->add_render_attribute( 'video', 'class', 'haru-video' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'video', 'class', 'haru-video--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'video', 'class', $settings['el_class'] );
			}

        	?>

        	<div <?php echo $this->get_render_attribute_string( 'video' ); ?>>
        		<?php if ( $settings['video_desktop_url'] ) : ?>
        		<video src="<?php echo $settings['video_desktop_url']['url']; ?>" muted webkit-playsinline playsinline loop></video>
        		<?php endif; ?>
        		<?php if ( $settings['video_mobile_url'] ) : ?>
        		<!-- <video src="<?php echo $settings['video_mobile_url']['url']; ?>" muted webkit-playsinline playsinline loop></video> -->
        		<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
