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

$posts_per_page = 3;

?>
<form role="search" method="get" id="recruitment-searchform" class="recruitment-searchform" action="<?php echo esc_url( site_url() ); ?>" data-ajax-url="<?php echo get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true'; ?>" data-per-page="<?php echo esc_attr( $posts_per_page ); ?>">
    <div class="data-search" 
        data-current_page="<?php echo esc_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>" 
        data-per_page="<?php echo esc_attr( $posts_per_page ); ?>">

        <div class="data-search__input">
            <input type="text" value="" name="s" id="s" placeholder="<?php echo esc_html__( 'Keyword', 'haru-starter' ); ?>" />
        </div>

        <div class="data-search__select">
             <select name="location" id="location">
                <option value=""><?php echo esc_html__( 'Location', 'haru-starter' ); ?></option>
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
            <input type="submit" id="searchsubmit" value="<?php echo esc_html__( 'Search', 'haru-starter' ); ?>" class="search-recruitment"/>
        </div>

        <input type="hidden" name="post_type" value="haru_recruitment" />
    </div>
</form>

<div class="recruitment-content">
    <div class="recruitment-list">
        <?php
            $args = array(
               'taxonomy' => 'recruitment_category',
               // 'orderby' => 'name',
               'order'   => 'ASC'
            );

            $cats = get_categories($args);
        ?>
        <?php foreach( $cats as $cat ) :
            $haru_recruit_image = get_term_meta( $cat->term_id, 'haru_recruit_featured_image', true );
        ?>
            <div class="recruitment-category">
                <div class="recruitment-category-wrap">
                    <div class="recruitment-category-image" style="background-image: url('<?php echo esc_url( $haru_recruit_image ); ?>');">
                    </div>
                    <div class="recruitment-category-content">
                        <h6><a href="<?php echo get_category_link( $cat->term_id ) ?>"><?php echo $cat->name; ?></a></h6>
                        <div class="recruitment-category-desc"><?php echo wp_trim_words( $cat->description, 18, '...' ); ?></div>
                        <a href="<?php echo get_category_link( $cat->term_id ) ?>" class="recruitment-category-more"><?php echo esc_html__( 'See detail', 'haru-starter' ); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
	wp_reset_query();
    $wp_query = $original_query;   
?>
