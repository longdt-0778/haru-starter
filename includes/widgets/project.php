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

if ( ! class_exists( 'Haru_Starter_Project_Widget' ) ) {
	class Haru_Starter_Project_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-project';
		}

		public function get_title() {
			return esc_html__( 'Haru Project', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'project',
                'job',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

        public function get_script_depends() {

			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['imagesloaded', 'isotope'];
		    }

		    return [ 'imagesloaded', 'isotope' ];

		}

		protected function _register_controls() {

			$this->start_controls_section(
	            'section_settings',
	            [
	                'label' 	=> esc_html__( 'Project Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
	            'per_page',
	            [
	                'label' 	=> esc_html__( 'Result per page', 'haru-starter' ),
	                'type' => Controls_Manager::TEXT,
	                'default' => '10',
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

        	$this->add_render_attribute( 'project', 'class', 'haru-project' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'project', 'class', $settings['el_class'] );
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'project' ); ?>>
    			<?php echo Haru_Template::haru_get_template( 'project/project.php', $settings ); ?>
    		</div>

    		<?php
		}

	}
}
