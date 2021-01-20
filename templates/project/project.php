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

$posts_per_page = $settings['per_page'];

global $wp_query, $paged;
            
if ( is_front_page() ) {
    $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
} else {
    $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
}

$original_query = $wp_query;

$args = array(
    'posts_per_page' => $posts_per_page, // -1 is Unlimited project
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_type'      => 'haru_project',
    'paged'          => $paged,
    'post_status'    => 'publish'
);

$wp_query = new WP_Query($args);

?>

<div class="project-content">
    <div class="project-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="project-item">
                <div class="project-item__wrap">
                    <?php 
                        $image_layout = get_post_meta( get_the_ID(), 'haru_project_image_layout', true );
                        if ( $image_layout ) :
                    ?>
                    <div class="project-item__image-wrap">
                        <img src="<?php echo esc_url( $image_layout ); ?>" class="project-item__image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="project-item__content">
                        <?php 
                            $client = get_the_terms( get_the_ID(), 'project_client' );
                            if ( $client ) :
                                $client_string = '';
                                $lastElement = end( $client );
                                foreach ( $client as $item ) {
                                    $client_string .= '<span>' . $item->name . '</span>';
                                }
                        ?>
                        <div class="project-item__sub-title"><?php echo wp_kses( $client_string, 'post' ); ?></div>
                        <?php endif; ?>
                        <h6 class="project-item__title"><a class="project-item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                        <div class="project-item__description"><?php echo wp_trim_words( get_the_content(), 12, '...' ); ?></div>
                        <a href="<?php the_permalink(); ?>" <?php echo $target . $nofollow; ?> class="haru-button haru-button--text haru-button--text-primary"><?php echo esc_html__( 'Xem chi tiết', 'haru-starter' ); ?>
                            <span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if ( ( $wp_query->max_num_pages > 1 ) ) : ?>
        <div class="project-pagination">
            <?php echo Haru_Ajax_Helper::haru_paging_load_more_cpt(); ?>
        </div>
    <?php endif; ?>
</div>
<?php
	wp_reset_query();
    $wp_query = $original_query;   
?>
