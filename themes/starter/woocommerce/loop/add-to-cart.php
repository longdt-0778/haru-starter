<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?>
<?php if ( ! $product->is_in_stock() ) : ?>
	<div class="product-button product-button--add-to-cart">
		<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->get_id() ) ); ?>" class="product_type_soldout btn_add_to_cart" title="<?php echo esc_attr__( 'Sold out', 'starter' ); ?>">
			<span class="haru-tooltip button-tooltip"><?php echo esc_html__( 'Sold out', 'starter' ); ?></span>
		</a>
	</div>
<?php else : ?>
<?php
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf( '<div class="product-button product-button--add-to-cart"><a href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" %s><span class="haru-tooltip button-tooltip">%s</span></a></div>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		),
		$product,
		$args
	);
?>
<?php endif; ?>