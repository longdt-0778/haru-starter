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

if ( ! class_exists( 'Haru_Starter_News_Widget' ) ) {
	class Haru_Starter_News_Widget extends Widget_Base {

		public function get_name() {
			return 'haru-news';
		}

		public function get_title() {
			return esc_html__( 'Haru News', 'haru-starter' );
		}

		public function get_icon() {
			return 'eicon-table-of-contents';
		}

		public function get_categories() {
			return [ 'haru-elements' ];
		}

		public function get_keywords() {
            return [
                'news',
                'posts',
                'new',
                'post',
                'articles',
                'article',
                'blog'
            ];
        }

		public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

		public function get_script_depends() {

			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['slick', 'other_conditional_script'];
		    }

			if ( $this->get_settings_for_display( 'pre_style' ) == 'carousel' ) {
		        return [ 'slick' ];
		    } else if ( $this->get_settings_for_display( 'condition' ) === 'yes' ) {
		        return [ 'other_conditional_script' ];
		    }

		    return [ 'slick' ];

		}

		public function get_style_depends() {
			if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
		        return ['slick', 'other_conditional_script'];
		    }

			return [ 'slick' ];
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
					'label' => __( 'Pre News', 'haru-starter' ),
					'description' 	=> __( 'If you choose Pre News you will use Style default from our theme.', 'haru-starter' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'carousel',
					'options' => [
						'carousel' 	=> __( 'Carousel 1', 'haru-starter' ),
						'grid' 		=> __( 'Grid 1', 'haru-starter' ),
						'list' 		=> __( 'List 1', 'haru-starter' ),
						'featured' 	=> __( 'Featured 1', 'haru-starter' ),
					]
				]
			);

	        $this->add_control(
				'button_text',
				[
					'label' => esc_html__( 'Button Text', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here' , 'haru-starter' ),
					'label_block' => true,
				]
			);

	        $this->add_control(
				'link',
				[
					'label' => __( 'Link', 'haru-starter' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
					'default' => [
						'url' => '#',
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

        	$this->add_render_attribute( 'news', 'class', 'haru-news' );

        	if ( 'none' != $settings['pre_style']  ) {
				$this->add_render_attribute( 'news', 'class', 'haru-news--' . $settings['pre_style'] );
			}

        	if ( ! empty( $settings['el_class'] ) ) {
				$this->add_render_attribute( 'news', 'class', $settings['el_class'] );
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'news' ); ?>>
        		<?php if ( 'carousel' == $settings['pre_style']  ) : ?>
	        		<ul class="haru-slick" data-slick='{"slidesToShow" : 3, "slidesToScroll" : 3, "arrows" : true, "infinite" : false, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767, "settings" : {"slidesToShow" : 1, "slidesToScroll" : 1}}] }'>
		        		<?php
				          	$json = file_get_contents('https://news.sun-asterisk.com/api/post/newest');
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 4; $i++ ) : ?>
				        <li class="haru-news__item">
				        	<div class="haru-news__image">
				        		<img src="<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>">
				        		<div class="haru-news__label"><span><?php echo $news[$i]->type; ?><span></div>
				        	</div>
				        	<div class="haru-news__content">
					          	<h6 class="haru-news__title">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>">
					          			<?php echo $news[$i]->title_vi; ?>
					          		</a>
					          	</h6>
					          	<div class="haru-news__preview"><?php echo $news[$i]->preview_vi; ?></div>
					          	<div class="haru-news__btn-detail">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>" target="_blank" rel="nofollow" class="haru-button haru-button--text haru-button--text-primary" tabindex="0"><?php echo esc_html__( 'Xem chi tiết', 'haru-starter' ); ?>
					          			<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
					          		</a>
				          		</div>
				          	</div>
				        </li>
				        <?php endfor; ?>
			        </ul>
			        <div class="haru-news__btn-more">
			        	<a class="haru-button haru-button--bg-black haru-button--size-large haru-button--round-large" href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' ); ?>"><?php echo esc_html__( 'Xem nhiều tin hơn', 'haru-starter' ); ?>
			        		<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
			        	</a>
		        	</div>
	        	<?php elseif ( 'grid' == $settings['pre_style']  ) : ?>
	        		<ul class="haru-news__grid">
		        		<?php
				          	$json = file_get_contents('https://news.sun-asterisk.com/api/post/newest');
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 6; $i++ ) : ?>
				        <li class="haru-news__item">
				        	<div class="haru-news__image">
				        		<img src="<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>">
				        		<div class="haru-news__label"><span><?php echo $news[$i]->type; ?><span></div>
				        	</div>
				        	<div class="haru-news__content">
					          	<h6 class="haru-news__title">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>">
					          			<?php echo $news[$i]->title_vi; ?>
					          		</a>
					          	</h6>
					          	<div class="haru-news__preview"><?php echo $news[$i]->preview_vi; ?></div>
					          	<div class="haru-news__btn-detail">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>" target="_blank" rel="nofollow" class="haru-button haru-button--text haru-button--text-primary" tabindex="0"><?php echo esc_html__( 'Xem chi tiết', 'haru-starter' ); ?>
					          			<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
					          		</a>
				          		</div>
				          	</div>
				        </li>
				        <?php endfor; ?>
			        </ul>
			        <div class="haru-news__btn-more">
			        	<a class="haru-button haru-button--bg-black haru-button--size-large haru-button--round-large" href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' ); ?>"><?php echo esc_html__( 'Xem nhiều tin hơn', 'haru-starter' ); ?>
			        		<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
			        	</a>
		        	</div>
	        	<?php elseif ( 'list' == $settings['pre_style']  ) : ?>
	        		<h6 class="haru-news__heading"><?php echo esc_html__( 'Tin tức nổi bật', 'haru-starter' ); ?></h6>
	        		<ul class="haru-news__list">
		        		<?php
				          	$json = file_get_contents('https://news.sun-asterisk.com/api/post/newest');
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 6; $i++ ) : ?>
				        <li class="haru-news__item">
				        	<div class="haru-news__image" style="background-image: url('<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>');">
				        	</div>
				        	<div class="haru-news__content">
					          	<h6 class="haru-news__title">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>">
					          			<?php echo $news[$i]->title_vi; ?>
					          		</a>
					          	</h6>
					          	<div class="haru-news__preview"><?php echo $news[$i]->preview_vi; ?></div>
				          	</div>
				        </li>
				        <?php endfor; ?>
			        </ul>
	        	<?php elseif ( 'featured' == $settings['pre_style']  ) : ?>
        			<?php
			          	$json = file_get_contents('https://news.sun-asterisk.com/api/post/newest');
			          	$obj = json_decode($json);
			          	$news = $obj->data;
			        ?>
			        <?php for ( $i = 0; $i < 1; $i++ ) : //var_dump($news[$i]->bannerImage->data); ?>
			        	<div class="haru-news__featured">
			        		<div class="haru-news__image">
			        			<img src="<?php echo esc_url( $news[$i]->bannerImage->data->mobile_path ); ?>">
		        			</div>
		        			<div class="haru-news__content">
					          	<h6 class="haru-news__title">
					          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/vi' . $news[$i]->url ); ?>">
					          			<?php echo $news[$i]->title_vi; ?>
					          		</a>
					          	</h6>
					          	<div class="haru-news__preview"><?php echo $news[$i]->preview_vi; ?></div>
					          	<div class="haru-news__meta">
					          		<span class="haru-news__meta-author"><?php echo esc_html__( 'Đăng bởi', 'haru-starter' ); ?> <?php echo $news[$i]->name_author; ?></span>
					          		<span class="haru-news__meta-view"><?php echo $news[$i]->views_count; ?> <?php echo esc_html__( 'Lượt xem', 'haru-starter' ); ?></span>
					          		<span class="haru-news__meta-date"><?php echo $news[$i]->publish_at; ?></span>
				          		</div>
				          	</div>
			        	</div>
		        	<?php endfor; ?>
		        <?php endif; ?>
    		</div>

    		<?php
		}

	}
}
