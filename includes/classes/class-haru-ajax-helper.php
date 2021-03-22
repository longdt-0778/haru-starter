<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

namespace Haru_Starter\Classes;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Haru_Ajax_Helper' ) ) {
    class Haru_Ajax_Helper {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

        public function __construct(){

            add_action( 'wp_ajax_haru_recruitment_widget_ajax_search', array( $this, 'haru_recruitment_widget_ajax_search' ) );
            add_action( 'wp_ajax_nopriv_haru_recruitment_widget_ajax_search', array( $this, 'haru_recruitment_widget_ajax_search' ) );
            // add_action( 'wp_ajax_haru_recruitment_widget_ajax_search_loadmore', array( $this, 'haru_recruitment_widget_ajax_search_loadmore' ) );
            // add_action( 'wp_ajax_nopriv_haru_recruitment_widget_ajax_search_loadmore', array( $this, 'haru_recruitment_widget_ajax_search_loadmore' ) );

        }

        public function haru_recruitment_widget_ajax_search() {
            $_s            = $_POST['input'];
            $_location     = $_POST['location'];
            $_per_page     = $_POST['per_page'];
            $_current_page = $_POST['current_page'];

            global $wp_query;

            $original_query = $wp_query;

            $args = array(
                'posts_per_page' => $_per_page, // -1 is Unlimited film
                's'              => $_s,
                'post_type'      => 'haru_recruitment',
                'post_status'    => 'publish',
                // 'exact'          => true,
                'tax_query'      => array(),
                'meta_query'     => array()
            );

            if ( $_current_page ) {
                $args['offset'] = $_per_page * $_current_page;
            }

            // Check Search Form Fields
            if ( $_location ) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'recruitment_location',
                    'field'    => 'slug',
                    'terms'    => explode( ',', $_location ),
                );
            }

            $wp_query = new WP_Query( $args );

            ?>
            <div class="recruit-list" data-max_pages="<?php echo esc_attr( $wp_query->max_num_pages ); ?>">
                <?php 
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        $title = get_the_title();
                        $keys = explode(" ",$_s);
                        if ( $_s != '' ) {
                            $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-highlight-title">\0</strong>', $title);
                        }

                        $content = wp_trim_words( get_the_content(), 80, '...' );
                        $content_keys = explode(" ",$_s);
                        if ( $_s != '' ) {
                            $content = preg_replace('/('.implode('|', $content_keys) .')/iu', '<strong class="search-highlight-content">\0</strong>', $content);
                        }
                    ?>
                        <div class="recruit-item">
                            <div class="recruitment-item-location">
                                <?php echo get_the_term_list( get_the_ID(), 'recruitment_location', '', ', ' ); ?>
                            </div>
                            <h6><a class="recruitment-item-title" href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h6>
                            <div class="recruitment-item-status">
                                <?php echo get_the_term_list( get_the_ID(), 'recruitment_status', '', ', ' ); ?>
                            </div>
                            <div class="recruitment-item-description"><?php echo $content; ?></div>
                            <div class="recruitment-item-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'View more', 'starter' ); ?></a></div>
                        </div>
                        <?php
                    endwhile;
                else :
                // If no content, include the "No posts found" template.
                ?>
                    <div class="no-recruit-item"><?php echo esc_html__( 'No job available. Please try other search', 'haru-starter' ); ?></div>
                <?php
                endif;
                ?>
            </div>

            <?php if ( ( $wp_query->max_num_pages > 1 ) ) : ?>
                <div class="recruitment-pagination">
                    <a href="javascript:;" data-current_page="1" class="recruit-load-more"><?php echo esc_html__( 'Xem thêm', 'haru-starter' ); ?>
                        <span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
                    </a>
                </div>
            <?php endif; ?>

            <?php
            wp_reset_query();
            $wp_query = $original_query;
            die;
        }

        public function haru_paging_load_more_cpt() {
            global $wp_query;

            if ( $wp_query->max_num_pages < 2 ) {
                return;
            }

            $link = get_next_posts_page_link( $wp_query->max_num_pages );

            if ( ! empty( $link ) ) :
            ?>
                <a data-href="<?php echo esc_url( $link ); ?>" type="button" class="cpt-load-more haru-button haru-button--bg-black haru-button--size-large haru-button--round-large"></i>
                    <?php echo esc_html__( 'Load more', 'haru-starter' ); ?>
                </a>
            <?php
            endif;
        }
    }
}

Haru_Ajax_Helper::instance();
