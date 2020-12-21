<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

use \Haru_Starter\Classes\Haru_Ajax_Helper;

$posts_per_page = 4;

global $wp_query, $paged;
            
if ( is_front_page() ) {
    $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
} else {
    $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
}

$original_query = $wp_query;

$args = array(
    'posts_per_page' => $posts_per_page, // -1 is Unlimited recruitment
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_type'      => 'haru_recruitment',
    'paged'          => $paged,
    'post_status'    => 'publish'
);

$wp_query = new WP_Query($args);

?>
<form role="search" method="get" id="recruitment-searchform" class="recruitment-searchform" action="<?php echo esc_url( site_url() ); ?>" data-ajax-url="<?php echo get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true'; ?>" data-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
    <div class="data-search" 
        data-current_page="<?php echo esc_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>" 
        data-per_page="<?php echo esc_attr( $posts_per_page ); ?>">

        <div class="data-search__input">
            <input type="text" value="" name="s" id="s" placeholder="<?php echo esc_html__( 'Tìm kiếm từ khoá', 'haru-starter' ); ?>" />
        </div>

        <div class="data-search__select">
             <select name="location" id="location">
                <option value=""><?php echo esc_html__( 'Địa điểm', 'haru-starter' ); ?></option>
                <?php 
                    $terms = get_terms( array(
                        'taxonomy' => 'recruitment_location',
                        'hide_empty' => false,
                    ) );
                ?>
                <?php foreach ( $terms as $term ) : ?>
                <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_attr( $term->name ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="data-search__submit">
            <input type="submit" id="searchsubmit" value="<?php echo esc_html__( 'Tìm kiếm', 'haru-starter' ); ?>" class="search-recruitment"/>
        </div>

        <input type="hidden" name="post_type" value="haru_recruitment" />
    </div>
</form>

<div class="recruitment-content">
    <div class="recruitment-list">
        <?php while ( have_posts() ) : the_post(); ?>
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
        <?php endwhile; ?>
    </div>

    <?php if ( ( $wp_query->max_num_pages > 1 ) ) : ?>
        <div class="recruitment-pagination">
            <?php echo Haru_Ajax_Helper::haru_paging_nav_cpt(); ?>
        </div>
    <?php endif; ?>
</div>
<?php
	wp_reset_query();
    $wp_query = $original_query;   
?>
