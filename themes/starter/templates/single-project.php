<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

?>
<div class="haru-single-project haru-container">
    <div class="single-wrapper">
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
        <?php
            $images_slideshow = get_post_meta( get_the_ID(), 'haru_project_images_slideshow', true );
            if ( $images_slideshow ) :
        ?>
        <div class="single-project-top">
            <div class="single-project-heading"><?php echo esc_html__( 'Dự án', 'starter' ); ?></div>
            <div class="single-project-slideshow">
                <ul class="haru-slick" data-slick='{"slidesToShow" : 1, "slidesToScroll" : 1, "arrows" : true, "infinite" : false, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767,"settings" : {"slidesToShow" : 1}}] }'>
                    <?php 
                        foreach ( $images_slideshow as $image ) :
                    ?>
                        <li class="single-project-slideshow__item">
                            <img src="<?php echo esc_url( $image ); ?>" class="single-project-slideshow__image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="single-project-title">
            <?php 
                $client = get_the_terms( get_the_ID(), 'project_client' );
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
            <div class="single-project-title__sub"><?php echo esc_html( $client_string ); ?></div>
            <?php endif; ?>
            <h2 class="single-project-title__main"><?php the_title(); ?></h2>
        </div>

        <div class="single-project-main">

            <div class="single-project-info-wrap">
                <div class="single-project-info">
                    <h5 class="single-project-info-heading"><?php echo esc_html__( 'Project Info', 'starter' ); ?></h6>
                    <?php 
                        $client = get_the_terms( get_the_ID(), 'project_client' );
                        if ( $client ) :
                            $client_string = '';
                            $lastElement = end( $client );
                            foreach ( $client as $item ) {
                                $client_string .= '<span>' . $item->name . '</span>';
                            }
                    ?>
                        <div class="single-project-info-item">
                            <div class="single-project-info-title"><?php echo esc_html__( 'Client', 'starter' ); ?></div>
                            <div class="single-project-info-value"><?php echo wp_kses( $client_string, 'post' ); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $service = get_the_terms( get_the_ID(), 'project_service' );
                        if ( $service ) :
                            $service_string = '';
                            $lastElement = end( $service );
                            foreach ( $service as $item ) {
                                $service_string .= '<span>' . $item->name . '</span>';
                            }
                    ?>
                        <div class="single-project-info-item">
                            <div class="single-project-info-title"><?php echo esc_html__( 'Services', 'starter' ); ?></div>
                            <div class="single-project-info-value"><?php echo wp_kses( $service_string, 'post' ); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $team = get_the_terms( get_the_ID(), 'project_team' );
                        if ( $team ) :
                            $team_string = '';
                            $lastElement = end( $team );
                            foreach ( $team as $item ) {
                                $team_string .= '<span>' . $item->name . '</span>';
                            }
                    ?>
                        <div class="single-project-info-item">
                            <div class="single-project-info-title"><?php echo esc_html__( 'Sun* Team', 'starter' ); ?></div>
                            <div class="single-project-info-value"><?php echo wp_kses( $team_string, 'post' ); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $solution = get_the_terms( get_the_ID(), 'project_solution' );
                        if ( $solution ) :
                            $solution_string = '';
                            $lastElement = end( $solution );
                            foreach ( $solution as $item ) {
                                $solution_string .= '<span>' . $item->name . '</span>';
                            }
                    ?>
                        <div class="single-project-info-item">
                            <div class="single-project-info-title"><?php echo esc_html__( 'Solution', 'starter' ); ?></div>
                            <div class="single-project-info-value"><?php echo wp_kses( $solution_string, 'post' ); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="single-project-content">
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

        <?php
            $args = array(
                'post__not_in'       => array( get_the_ID() ),
                'posts_per_page'     => 3,
                'orderby'            => 'rand',
                'post_type'          => 'haru_project',
                'post_status'        => 'publish',
            );
            $related_projects         = new WP_Query( $args );
        ?>

        <?php if ( $related_projects->have_posts() ) : ?>
        <div class="single-project-related">
            <h6 class="single-project-related-title"><?php echo esc_html__( 'Dự án khác của chúng tôi', 'starter' ); ?></h6>
            <ul class="haru-slick" data-slick='{"slidesToShow" : 2, "slidesToScroll" : 1, "arrows" : true, "infinite" : false, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 767,"settings" : {"slidesToShow" : 1}}] }'>
                <?php while ( $related_projects->have_posts() ) : $related_projects->the_post(); ?>
                    <li class="single-project-related__item">
                        <div class="project-thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="project-meta">
                            <?php 
                                $client = get_the_terms( get_the_ID(), 'project_client' );
                                if ( $client ) :
                                    $client_string = '';
                                    $lastElement = end( $client );
                                    foreach ( $client as $item ) {
                                        $client_string .= '<span>' . $item->name . '</span>';
                                    }
                            ?>
                            <div class="project-client"><?php echo wp_kses( $client_string, 'post' ); ?></div>
                            <?php endif; ?>
                            <h5 class="project-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" target="_self"><?php the_title(); ?></a></h5>
                            <div class="project-content"><?php echo wp_trim_words( get_the_content(), 12, '...' ); ?></div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <?php
            endif;
            wp_reset_query();
        ?>
    </div>
</div>