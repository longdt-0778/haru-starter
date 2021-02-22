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

if ( ! class_exists( 'Haru_Starter_Language_Switcher_Widget' ) ) {
	class Haru_Starter_Language_Switcher_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-language-switcher';
		}

		public function get_title() {
			return esc_html__( 'Haru Language Switcher', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'haru-header-elements', 'haru-footer-elements' ];
		}

		public function get_keywords() {
            return [
                'language-switcher',
                'language',
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$this->start_controls_section(
	            'section_settings',
	            [
	                'label' 	=> esc_html__( 'Switcher Settings', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
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

        	$this->add_render_attribute( 'language-switcher', 'class', 'haru-language-switcher' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'language-switcher', 'class', $settings['el_class'] );
			}
        	?>

        	<ul <?php echo $this->get_render_attribute_string( 'language-switcher' ); ?>>
    			<?php
	    			$args   = [
						'show_flags' => 0,
						'show_names' => 1,
						'display_names_as' => 'slug',
						'echo'       => 0,
					];
					echo pll_the_languages( $args );
    			?>
    		</ul>

    		<?php
		}

	}
}
