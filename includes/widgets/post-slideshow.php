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
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Haru_Starter\Classes\Helper as ControlsHelper;
use \Haru_Starter\Classes\Haru_Template;

if ( ! class_exists( 'Haru_Starter_Post_Slideshow_Widget' ) ) {
	class Haru_Starter_Post_Slideshow_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-post-slideshow';
		}

		public function get_title() {
			return esc_html__( 'Haru Post Carousel', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-slides';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
	        return [
	            'post',
	            'posts',
	            'grid',
	            'post grid',
	            'posts grid',
	            'blog post',
	            'article',
	            'custom posts',
	            'masonry',
	            'content views',
	            'blog view',
	            'content marketing',
	            'blogger',
	        ];
	    }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		protected function _register_controls() {

			$post_types = array();
			$post_types['post'] = __( 'Posts', 'haru-starter' );
        	$post_types['by_id'] = __( 'Manual Selection', 'haru-starter' );

        	$taxonomies = get_taxonomies([], 'objects');

			$this->start_controls_section(
	            'content_section',
	            [
	                'label' 	=> esc_html__( 'Content', 'haru-starter' ),
	                'tab' 		=> Controls_Manager::TAB_CONTENT,
	            ]
	        );

	        $this->add_control(
	            'post_type',
	            [
	                'label' => __( 'Source', 'haru-starter' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => $post_types,
	                'default' => key($post_types),
	            ]
	        );

	        $this->add_control(
	            'posts_ids',
	            [
	                'label' => __( 'Search & Select', 'haru-starter' ),
	                'type' => Controls_Manager::SELECT2,
	                'options' => ControlsHelper::get_post_list(),
	                'label_block' => true,
	                'multiple' => true,
	                'condition' => [
	                    'post_type' => 'by_id',
	                ],
	            ]
	        );

	        $this->add_control(
	            'authors', [
	                'label' => __( 'Author', 'haru-starter' ),
	                'label_block' => true,
	                'type' => Controls_Manager::SELECT2,
	                'multiple' => true,
	                'default' => [],
	                'options' => ControlsHelper::get_authors_list(),
	                'options' => array(),
	                'condition' => [
	                    'post_type!' => ['by_id'],
	                ],
	            ]
	        );

	        foreach ($taxonomies as $taxonomy => $object) {
	            if ( ( ! isset( $object->object_type[0] ) ) || ( ! in_array( $object->object_type[0], array_keys($post_types) ) ) ) {
	                continue;
	            }

	            $this->add_control(
	                $taxonomy . '_ids',
	                [
	                    'label' => $object->label,
	                    'type' => Controls_Manager::SELECT2,
	                    'label_block' => true,
	                    'multiple' => true,
	                    'object_type' => $taxonomy,
	                    'options' => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
	                    'condition' => [
	                        'post_type' => $object->object_type,
	                    ],
	                ]
	            );
	        }

	        $this->add_control(
	            'post__not_in',
	            [
	                'label' => __( 'Exclude', 'haru-starter' ),
	                'type' => Controls_Manager::SELECT2,
	                'options' => ControlsHelper::get_post_list(),
	                'label_block' => true,
	                'post_type' => '',
	                'multiple' => true,
	                'condition' => [
	                    'post_type!' => ['by_id'],
	                ],
	            ]
	        );

	        $this->add_control(
	            'posts_per_page',
	            [
	                'label' => __( 'Posts Per Page', 'haru-starter' ),
	                'type' => Controls_Manager::NUMBER,
	                'default' => '4',
	            ]
	        );

	        $this->add_control(
	            'offset',
	            [
	                'label' => __( 'Offset', 'haru-starter' ),
	                'type' => Controls_Manager::NUMBER,
	                'default' => '0',
	            ]
	        );

	        $this->add_control(
	            'orderby',
	            [
	                'label' => __( 'Order By', 'haru-starter' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => ControlsHelper::get_post_orderby_options(),
	                'default' => 'date',

	            ]
	        );

	        $this->add_control(
	            'order',
	            [
	                'label' => __( 'Order', 'haru-starter' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => [
	                    'asc' => 'Ascending',
	                    'desc' => 'Descending',
	                ],
	                'default' => 'desc',

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

        	$this->add_render_attribute( 'post', 'class', 'haru-post' );

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'post', 'class', $settings['el_class'] );
			}

			$args = ControlsHelper::get_query_args( $settings );
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'post' ); ?>>
        		<?php
        			$query = new \WP_Query( $args );
        			if ( $query->have_posts() ) :
                        while ( $query->have_posts() ) :
                            $query->the_post();
                ?>
                	<?php echo Haru_Template::haru_get_template( 'post-slideshow/post-slideshow.php', $settings ); ?>
                <?php
                        endwhile;
                    else :
        		?>
        		<p class="no-items-found"><?php echo esc_html__( 'No items found!', 'haru-starter' ); ?></p>
        		<?php endif; ?>
    		</div>

    		<?php
		}

	}
}
