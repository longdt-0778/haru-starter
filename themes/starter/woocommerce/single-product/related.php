<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $related_products ) : 

$related_product_display_columns = haru_get_option( 'haru_related_product_display_columns', '4' );

?>

    <section class="related products">

        <?php
        $heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related Products', 'starter' ) );

        if ( $heading ) : ?>
            <h2 class="haru-heading haru-heading--style-1"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <ul class="haru-carousel haru-carousel--nav-top-right haru-carousel--nav-normal related-products owl-carousel owl-theme"
            data-items="<?php echo esc_attr( $related_product_display_columns ); ?>"
            data-items-tablet="3"
            data-items-mobile="2"
            data-margin="30"
            data-autoplay="false"
            data-loop="false"
            data-slide-duration="6000"
        >

            <?php foreach ( $related_products as $related_product ) : ?>

                <?php
                    $post_object = get_post( $related_product->get_id() );

                    setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                    wc_get_template_part( 'content', 'product' );
                ?>

            <?php endforeach; ?>

        </ul>

    </section>

<?php endif;

wp_reset_postdata();
