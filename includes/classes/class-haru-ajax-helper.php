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

            global $wp_query, $paged;

            if ( is_front_page() ) {
                $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
            } else {
                $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            }

            $original_query = $wp_query;

            // Sort
            // if ( $_sort == '' ) {
            //     $orderby = 'date';
            //     $order = 'DESC';
            // } elseif ( $_sort == 'date-desc' ) {
            //     $orderby = 'date';
            //     $order = 'DESC';
            // } elseif ( $_sort == 'date-asc' ) {
            //     $orderby = 'date';
            //     $order = 'ASC';
            // } elseif ( $_sort == 'title-desc' ) {
            //     $orderby = 'title';
            //     $order = 'DESC';
            // } elseif ( $_sort == 'title-asc' ) {
            //     $orderby = 'title';
            //     $order = 'ASC';
            // } elseif ( $_sort == 'rand' ) {
            //     $orderby = 'rand';
            //     $order = 'DESC';
            // } else {
            //     $orderby = 'date';
            //     $order = 'DESC';
            // }


            $args = array(
                'posts_per_page' => $_per_page, // -1 is Unlimited film
                's'              => $_s,
                'post_type'      => 'haru_recruitment',
                'paged'          => $paged,
                'post_status'    => 'publish',
                'tax_query'      => array(),
                'meta_query'     => array()
            );

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
            <div class="recruitment-list">
                <?php 
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                    ?>
                        <div class="recruitment-item">
                            <div class="recruitment-item-content">
                                <div class="recruitment-item-meta">
                                    <div class="recruitment-item-location">
                                        <?php echo get_the_term_list( get_the_ID(), 'recruitment_location', '', ', ' ); ?>
                                    </div>
                                </div>
                                <div class="recruitment-item-status">
                                    <?php echo get_the_term_list( get_the_ID(), 'recruitment_status', '', ', ' ); ?>
                                </div>
                                <a class="recruitment-item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                // If no content, include the "No posts found" template.
                ?>
                    <div class="no-more-item"><?php echo esc_html__( 'It seems we can’t find what you’re looking for. Please try other search', 'haru-starter' ); ?></div>
                <?php
                endif;
                ?>
            </div>

            <?php if ( ( $wp_query->max_num_pages > 1 ) ) : ?>
                <div class="recruitment-pagination">
                    <?php echo Haru_Ajax_Helper::haru_paging_nav_cpt(); ?>
                </div>
            <?php endif; ?>

            <?php
            wp_reset_query();
            $wp_query = $original_query;
            die;
        }

        public function haru_paging_nav_cpt() {
            // if ( ! defined( 'DOING_AJAX' ) && ! DOING_AJAX ) {
            // if ( wp_doing_ajax() ) {
            //     global $wp_rewrite, $wp_query;

            //     // Again - hard coded, you should make it dynamic though
            //     $base = trailingslashit( 'http://localhost:1234/vendor_new/display-vendor-results' ) . "{$wp_rewrite->pagination_base}/%#%/";
            //     $html = '<div class="mypagination">' . paginate_links( array(
            //         'base' => $base,
            //         'format' => '?paged=%#%',
            //         'current' => max( 1, $paged ),
            //         'total' => $wp_query->max_num_pages,
            //         'mid_size' => 1,
            //         'end_size' => 1,
            //     ) ) . '</div>';

            //     return $html;
            // } else {
                the_posts_pagination(
                    array(
                        'mid_size'  => 1,
                        'prev_text' => esc_html__( 'Prev', 'haru-starter' ),
                        'next_text' => esc_html__( 'Next', 'haru-starter' )
                    )
                );
            // }
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
                    <?php echo esc_html__( 'Xem thêm', 'haru-starter' ); ?>
                </a>
            <?php
            endif;
        }

        public function haru_paging_infinitescroll_cpt() {
            global $wp_query;

            if ( $wp_query->max_num_pages < 2 ) {
                return;
            }

            $link = get_next_posts_page_link( $wp_query->max_num_pages );
            if ( ! empty( $link ) ) :
            ?>
                <nav id="infinite_scroll_button" data-max-page="<?php echo esc_attr( $wp_query->max_num_pages ); ?>" data-msgText="<?php echo esc_attr__( 'Loading...', 'haru-starter' ); ?>" data-finishedMsg="<?php echo esc_attr__( 'All items loaded.', 'haru-starter' ); ?>">
                    <a href="<?php echo esc_url( $link ); ?>"></a>
                </nav>
                <div id="infinite_scroll_loading" class="align-center infinite-scroll-loading"></div>
            <?php
            endif;
        }
    }
}

Haru_Ajax_Helper::instance();
