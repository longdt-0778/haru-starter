<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

// This templte copy from conten-single-product.php
// Set default
$product_single_style = 'horizontal';
$gallery_thumb_position = 'thumbnail-left';

?>

<div class="woocommerce product-quick-view white-popup-block mfp-with-anim">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        
        <div class="single-product-top">
            <div class="single-product-image-wrap <?php echo esc_attr( $product_single_style . ' ' . $gallery_thumb_position ); ?>">
                <?php
                    /**
                     * woocommerce_before_single_product_summary hook.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>
            <div class="single-product-summary">
                <div class="summary entry-summary haru-scroll-content">
                    <?php
                        /**
                         * woocommerce_single_product_summary hook.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked haru_woocommerce_template_single_size_guide - 25
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        remove_action( 'woocommerce_single_product_summary', 'haru_woocommerce_template_single_size_guide', 25 );
                        remove_action( 'woocommerce_after_add_to_cart_button', 'haru_woocomerce_template_loop_wishlist', 5 );
                        remove_action( 'woocommerce_after_add_to_cart_button', 'haru_woocomerce_template_loop_compare', 5 );
                        do_action( 'woocommerce_single_product_summary' );
                    ?>

                </div><!-- .summary -->
            </div>
        </div>

    </div><!-- #product-<?php the_ID(); ?> -->
</div>
