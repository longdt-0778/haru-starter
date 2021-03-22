<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Product style
$product_single_style = get_post_meta( get_the_ID(), 'haru_product' . '_single_style', true );
if ( ! in_array( $product_single_style, array( 'horizontal', 'vertical', 'vertical_gallery' ) ) ) {
    $product_single_style = haru_get_option( 'haru_product_single_style', 'horizontal' );
}

$gallery_thumb_position = get_post_meta( get_the_ID(), 'haru_product' . '_gallery_thumb_position', true );
if ( ! in_array( $gallery_thumb_position, array( 'thumbnail-left', 'thumbnail-right' ) ) ) {
    $gallery_thumb_position = haru_get_option( 'haru_gallery_thumb_position', 'thumbnail-left' );
}

?>

<?php
    /**
     * woocommerce_before_single_product hook.
     *
     * @hooked wc_print_notices - 10
     */
     do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
    }
?>

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
            <div class="summary entry-summary">
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
                    do_action( 'woocommerce_single_product_summary' );
                ?>

            </div><!-- .summary -->
        </div>
    </div>
    <div class="single-product-bottom">
        <?php
            /**
             * woocommerce_after_single_product_summary hook.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
            do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>
    <?php add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 ) ?>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
