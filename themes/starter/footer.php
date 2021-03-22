<?php
/**
 * The template for displaying the footer
 *
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
 */
?>
            <?php 
                /*
                * @hooked - Haru Main Content end
                */
                do_action( 'haru_main_content_end' );
            ?>
            </div>
            <!-- Close Haru Main Content -->

            <?php
                /*
                * @hooked - haru_footer_block - 5
                */
                do_action( 'haru_footer_main' );
            ?>

        </div>
        <!-- Close Haru Main -->
        <?php
            /*
            * @hooked - haru_back_to_top - 5
            * @hooked - haru_ajax_loading - 10
            */
            do_action( 'haru_after_page_main' );

        ?>
    <?php wp_footer(); ?>
    </body>
</html>