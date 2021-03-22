<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/


wp_enqueue_script( 'sticky-sidebar' );
?>
<div class="haru-single-recruitment haru-container">
    <div class="single-wrap">
        <div class="single-main">
            <?php
                if ( have_posts() ):
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
            ?>

            <div class="single-recruitment-title">
                <?php 
                    $client = get_the_terms( get_the_ID(), 'recruitment_client' );
                    if ( $client ) :
                        $client_string = '';
                        $lastElement = end( $client );
                        foreach ( $client as $item ) {
                            if ( $item != $lastElement ) {
                                $client_string .= $item->name . ',';
                            } else {
                                $client_string .= $item->name;
                            }
                        }
                ?>
                <div class="single-recruitment-title__sub"><?php echo esc_html__( 'at Sun* Inc.', 'starter' ); ?></div>
                <?php endif; ?>
                <h2 class="single-recruitment-title__main"><?php the_title(); ?></h2>
            </div>

            <div class="single-recruitment-main">
                <div class="single-recruitment-content">
                    <?php
                                the_content();
                            endwhile;
                        else :
                            // If no content, include the "No posts found" template.
                            get_template_part( 'templates/archive/content-none');
                        endif;
                    ?>
                </div>
            </div>
        </div>

        <div class="single-sidebar-right">
            <div class="single-sidebar-right-inner">
                <div class="single-recruitment-testimonial">
                    <div class="testimonial-item">
                        <div class="testimonial-item__avatar">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/avatar.jpg' ); ?>">
                        </div>
                        <h6 class="testimonial-item__name"><?php echo esc_html__( 'Nguyen Viet Anh', 'starter' ); ?></h6>
                        <div class="testimonial-item__position"><?php echo esc_html__( 'QA Unit 2', 'starter' ); ?></div>
                        <div class="testimonial-item__quote"><?php echo esc_html__( 'Từ ngày làm nghề này mình thấy yêu đời hẳn', 'starter' ); ?></div>
                    </div>
                </div>

                <div class="single-recruitment-apply">
                    <div class="single-recruitment-bear"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bear-recruitment.png' ); ?>"></div>
                    <h6><?php echo esc_html__( 'Bạn đã sẵn sàng ứng tuyển chưa ?', 'starter' ); ?></h6>
                    <ul class="recruitment-apply-list">
                        <li class="recruitment-apply-item"><?php echo esc_html__( 'Môi trường năng động, sáng tạo', 'starter' ); ?></li>
                        <li class="recruitment-apply-item"><?php echo esc_html__( 'Nhiều sự kiện', 'starter' ); ?></li>
                        <li class="recruitment-apply-item"><?php echo esc_html__( 'Nhiều chính sách đãi ngộ', 'starter' ); ?></li>
                    </ul>
                    <a class="recruitment-apply-btn haru-button haru-button--bg-white haru-button--size-medium haru-button--round-large" href="#recruitement-contact-form" rel="nofollow"><?php echo esc_html__( 'Ứng tuyển ngay', 'starter' ); ?><i class="haru-icon haru-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="recruitement-contact-form" class="recruitement-contact-form">
    <div class="haru-container">
        <h6 class="recruitement-contact-form-title"><?php echo esc_html__( 'Apply for this Job', 'starter' ); ?></h6>
        <?php echo do_shortcode( '[contact-form-7 id="2844" title="Contact Form"]' ); ?>
    </div>
</div>