<?php
/**
 * Compare button template - Loop Layout
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Compare
 * @version 3.0.0
 */

if ( ! class_exists( 'YITH_Woocompare' ) ) {
	exit;
} //

?>
<?php if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
   	<?php 
   		if ( class_exists( 'YITH_Woocompare' ) ) {
			global $yith_woocompare, $product;

			$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			if ( $yith_woocompare->is_frontend() || $is_ajax ) {
				if ( $is_ajax ) {
					// @TODO: update woocommerce cause this doesn't work: $yith_woocompare->obj = new YITH_Woocompare_Frontend();
					// return;
				}

				if ( wp_is_mobile() ) {
					return;
				}

				// <a href="https://starter.local?action=yith-woocompare-add-product&amp;id=2641" class="compare button" data-product_id="2641" rel="nofollow">Compare</a>

				echo '<div class="product-button product-button--compare">';
				echo '<a class="compare button" href="' . esc_url( $yith_woocompare->obj->add_product_url( $product->get_id() ) ) . '" data-product_id="' . $product->get_id() .'" rel="nofollow" data-tooltip_text="'. esc_html( 'Compare', 'starter') . '">'.'<span class="haru-tooltip button-tooltip">' . get_option('yith_woocompare_button_text') . '</span></a>';
				// echo do_shortcode( '[yith_compare_button]' );
				// echo '<span class="haru-tooltip button-tooltip">'.get_option('yith_woocompare_button_text').'</span>';
				echo '</div>';
			}
		}
   	?>
<?php endif; ?>