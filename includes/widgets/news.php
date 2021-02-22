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
				'news_tag',
				[
					'label' => esc_html__( 'News Tag', 'haru-starter' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'tuyen-dung' , 'haru-starter' ),
					'label_block' => true,
				]
			);

	  //       $this->add_control(
			// 	'button_text',
			// 	[
			// 		'label' => esc_html__( 'Button Text', 'haru-starter' ),
			// 		'type' => Controls_Manager::TEXT,
			// 		'default' => esc_html__( 'Click Here' , 'haru-starter' ),
			// 		'label_block' => true,
			// 	]
			// );

	  //       $this->add_control(
			// 	'link',
			// 	[
			// 		'label' => __( 'Link', 'haru-starter' ),
			// 		'type' => Controls_Manager::URL,
			// 		'dynamic' => [
			// 			'active' => true,
			// 		],
			// 		'placeholder' => __( 'https://your-link.com', 'haru-starter' ),
			// 		'default' => [
			// 			'url' => '#',
			// 		],
			// 	]
			// );

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

			if ( function_exists( 'pll_current_language' ) ) {
				$current_language = pll_current_language();
			} else {
				$current_language = 'vi';
			}
        	?>

        	<div <?php echo $this->get_render_attribute_string( 'news' ); ?>>
        		<?php if ( 'carousel' == $settings['pre_style']  ) : ?>
	        		<ul class="haru-slick" data-slick='{"slidesToShow" : 3, "slidesToScroll" : 1, "arrows" : true, "infinite" : true, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767, "settings" : {"slidesToShow" : 1, "slidesToScroll" : 1}}] }'>
		        		<?php
		        			$news_link = 'https://news.sun-asterisk.com/api/tags/' . $settings['news_tag'] . '/posts';
				          	$json = file_get_contents($news_link);
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 6 && $i < count($news); $i++ ) : ?>
				        	<?php if ( $news[$i]->{ 'on_ready_' . $current_language } ) : ?>
					        <li class="haru-news__item">
					        	<div class="haru-news__image">
					        		<img src="<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>">
					        		<?php if ( $news[$i]->category->data->slug == 'hotnews' ) : ?>
					        		<div class="haru-news__label"><span><?php echo $news[$i]->category->data->name; ?><span></div>
				        			<?php endif; ?>
					        	</div>
					        	<div class="haru-news__content">
						          	<h6 class="haru-news__title">
						          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>">
						          			<?php echo $news[$i]->{ 'title_' . $current_language }; ?>
						          		</a>
						          	</h6>
						          	<div class="haru-news__preview"><?php echo $news[$i]->{ 'preview_' . $current_language }; ?></div>
						          	<div class="haru-news__btn-detail">
						          		<!-- Xem chi tiết -->
						          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>" target="_blank" rel="nofollow" class="haru-button haru-button--text haru-button--text-primary" tabindex="0"><?php echo esc_html__( 'See detail', 'haru-starter' ); ?>
						          			<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
						          		</a>
					          		</div>
					          	</div>
					        </li>
					    	<?php endif; ?>
				        <?php endfor; ?>
			        </ul>
			        <!-- Xem nhiều tin hơn -->
			        <div class="haru-news__btn-more">
			        	<a class="haru-button haru-button--bg-black haru-button--size-large haru-button--round-large" href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language ); ?>" target="_blank"><?php echo esc_html__( 'See more', 'haru-starter' ); ?>
			        		<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
			        	</a>
		        	</div>
	        	<?php elseif ( 'grid' == $settings['pre_style']  ) : ?>
	        		<ul class="haru-news__grid">
		        		<?php
				          	$news_link = 'https://news.sun-asterisk.com/api/tags/' . $settings['news_tag'] . '/posts';
				          	$json = file_get_contents($news_link);
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 6 && $i < count($news); $i++ ) : ?>
				        	<?php if ( $news[$i]->{ 'on_ready_' . $current_language } ) : ?>
					        <li class="haru-news__item">
					        	<div class="haru-news__image">
					        		<img src="<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>">
					        		<?php if ( $news[$i]->category->data->slug == 'hotnews' ) : ?>
					        		<div class="haru-news__label"><span><?php echo $news[$i]->category->data->name; ?><span></div>
				        			<?php endif; ?>
					        	</div>
					        	<div class="haru-news__content">
						          	<h6 class="haru-news__title">
						          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>">
						          			<?php echo $news[$i]->{ 'title_' . $current_language }; ?>
						          		</a>
						          	</h6>
						          	<div class="haru-news__preview"><?php echo $news[$i]->{ 'preview_' . $current_language }; ?></div>
						          	<div class="haru-news__btn-detail">
						          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>" target="_blank" rel="nofollow" class="haru-button haru-button--text haru-button--text-primary" tabindex="0"><?php echo esc_html__( 'See detail', 'haru-starter' ); ?>
						          			<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
						          		</a>
					          		</div>
					          	</div>
					        </li>
					        <?php endif; ?>
				        <?php endfor; ?>
			        </ul>
			        <div class="haru-news__btn-more">
			        	<a class="haru-button haru-button--bg-black haru-button--size-large haru-button--round-large" href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language ); ?>" target="_blank"><?php echo esc_html__( 'See more', 'haru-starter' ); ?>
			        		<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
			        	</a>
		        	</div>
		        	<!-- Tin tức nổi bật -->
	        	<?php elseif ( 'list' == $settings['pre_style']  ) : ?>
	        		<h6 class="haru-news__heading"><?php echo esc_html__( 'Featured news', 'haru-starter' ); ?></h6>
	        		<ul class="haru-news__list">
		        		<?php
				          	$news_link = 'https://news.sun-asterisk.com/api/tags/' . $settings['news_tag'] . '/posts';
				          	$json = file_get_contents($news_link);
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>

				        <?php for ( $i = 0; $i < 6 && $i < count($news); $i++ ) : ?>
				        	<?php if ( $news[$i]->{ 'on_ready_' . $current_language } ) : ?>
					        <li class="haru-news__item">
					        	<div class="haru-news__image" style="background-image: url('<?php echo esc_url( $news[$i]->bannerImage->data->origin_path ); ?>');">
					        	</div>
					        	<div class="haru-news__content">
						          	<h6 class="haru-news__title">
						          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>">
						          			<?php echo $news[$i]->{ 'title_' . $current_language }; ?>
						          		</a>
						          	</h6>
						          	<div class="haru-news__preview"><?php echo $news[$i]->{ 'preview_' . $current_language }; ?></div>
					          	</div>
					        </li>
					        <?php endif; ?>
				        <?php endfor; ?>
			        </ul>
	        	<?php elseif ( 'featured' == $settings['pre_style']  ) : ?>
	        		<ul class="haru-slick" data-slick='{"slidesToShow" : 1, "slidesToScroll" : 1, "arrows" : true, "infinite" : true, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767, "settings" : {"slidesToShow" : 1, "slidesToScroll" : 1}}] }'>
	        			<?php
				          	$news_link = 'https://news.sun-asterisk.com/api/tags/' . $settings['news_tag'] . '/posts';
				          	$json = file_get_contents($news_link);
				          	$obj = json_decode($json);
				          	$news = $obj->data;
				        ?>
				        <?php for ( $i = 0; $i < 3 && $i < count($news); $i++ ) : ?>
				        	<li class="haru-news__item">
					        	<div class="haru-news__featured">
					        		<div class="haru-news__image">
					        			<img src="<?php echo esc_url( $news[$i]->bannerImage->data->mobile_path ); ?>">
				        			</div>
				        			<div class="haru-news__content">
							          	<h6 class="haru-news__title">
							          		<a href="<?php echo esc_url( 'https://news.sun-asterisk.com/' . $current_language . $news[$i]->url ); ?>">
							          			<?php echo $news[$i]->{ 'title_' . $current_language }; ?>
							          		</a>
							          	</h6>
							          	<div class="haru-news__preview"><?php echo $news[$i]->{ 'preview_' . $current_language }; ?></div>
							          	<div class="haru-news__meta">
							          		<!-- Đăng bởi -->
							          		<span class="haru-news__meta-author"><?php echo esc_html__( 'Posted by', 'haru-starter' ); ?> <?php echo $news[$i]->name_author; ?></span>
							          		<!-- Lượt xem -->
							          		<span class="haru-news__meta-view"><?php echo $news[$i]->views_count; ?> <?php echo esc_html__( 'Views', 'haru-starter' ); ?></span>
							          		<span class="haru-news__meta-date"><?php echo $news[$i]->publish_at; ?></span>
						          		</div>
						          	</div>
					        	</div>
				        	</li>
			        	<?php endfor; ?>
		        	</ul>
		        <?php endif; ?>
    		</div>

    		<?php
		}

	}
}
