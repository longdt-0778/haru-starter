<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Process Archive Product options: https://gist.github.com/Bradley-D/7287723 or wc_get_page_id( 'shop' )
$shop_page_id = get_option( 'woocommerce_shop_page_id' );
$archive_layout = get_post_meta( $shop_page_id, 'haru_layout', true );
if ( ( $archive_layout == '' ) || ( $archive_layout == 'default' ) ) {
    $archive_layout = haru_get_option( 'haru_archive_product_layout', 'container' );
}

$archive_sidebar = get_post_meta( $shop_page_id, 'haru_sidebar', true );

if ( ( $archive_sidebar == '' ) || ( $archive_sidebar == 'default' ) ) {
    $archive_sidebar = haru_get_option( 'haru_archive_product_sidebar', 'left' );
}

$archive_left_sidebar = get_post_meta( $shop_page_id, 'haru_left_sidebar', true );
if ( ( $archive_left_sidebar == '' ) || ( $archive_left_sidebar == 'default' ) ) {
    $archive_left_sidebar = haru_get_option( 'haru_archive_product_left_sidebar', 'woocommerce' );
}

$archive_right_sidebar = get_post_meta( $shop_page_id, 'haru_right_sidebar', true );
if ( ( $archive_right_sidebar == '' ) || ( $archive_right_sidebar == 'default' ) ) {
    $archive_right_sidebar = haru_get_option( 'haru_archive_product_right_sidebar', 'woocommerce' );
}

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
do_action( 'woocommerce_before_main_content' );

?>
<?php
    /**
     * @hooked - haru_page_heading - 5
     **/
    do_action( 'haru_before_page' );
?>
<div class="woocommerce-products-header <?php echo esc_attr( $archive_layout == 'full' ? '' : 'haru-container' ); ?>">
    <?php
    /**
     * Hook: woocommerce_archive_description.
     *
     * @hooked woocommerce_taxonomy_archive_description - 10
     * @hooked woocommerce_product_archive_description - 10
     */
    do_action( 'woocommerce_archive_description' );
    ?>
</div>
<div class="haru-archive-product <?php echo esc_attr( $archive_layout == 'full' ? '' : 'haru-container' ); ?>">
    <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
    ?>

	<!-- Content -->
	<div class="archive-content <?php if ( is_active_sidebar( $archive_left_sidebar ) && in_array( $archive_sidebar, array( 'left', 'two' ) ) ) echo esc_attr( 'has-left-sidebar' ); ?> <?php if ( is_active_sidebar( $archive_right_sidebar ) && in_array( $archive_sidebar, array( 'right', 'two' ) ) ) echo esc_attr( 'has-right-sidebar' ); ?>">
        
        <div class="archive-product">

            <?php
                /**
                 * Hook: haru_before_archive_product_tools.
                 *
                 * @hooked - woocommerce_output_all_notices - 10
                 **/
                add_action( 'haru_before_archive_product_tools', 'woocommerce_output_all_notices', 10 );
                do_action( 'haru_before_archive_product_tools' );
            ?>

            <?php if ( woocommerce_product_loop() ) : ?>

                <?php
                    if ( isset( $_COOKIE['shopDefaultLayout'] ) ) {
                        $shopDefaultLayout = $_COOKIE['shopDefaultLayout'];
                    } else {
                        $shopDefaultLayout = 'layout-grid';
                    }
                ?>
                <div class="shop-filter">
                    <div class="shop-filter__layout">
                        <span class="shop-filter__grid <?php echo ( $shopDefaultLayout == 'layout-grid' ) ? 'active' : '' ?>"></span>
                        <span class="shop-filter__list <?php echo ( $shopDefaultLayout == 'layout-list' ) ? 'active' : '' ?>"></span>
                    </div>
                    <div class="shop-filter__catalog">
	                    <?php
	                        /**
                             * Hook: woocommerce_before_shop_loop.
                             *
                             * @hooked woocommerce_output_all_notices - 10
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
                            do_action( 'woocommerce_before_shop_loop' );
	                    ?>
                    </div>
                </div>

                <?php 
                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                        }
                    }

                    woocommerce_product_loop_end();
                ?>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php else : ?>

                <?php 
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action( 'woocommerce_no_products_found' );
                ?>

            <?php endif; ?>

        </div>
    </div>

    <!-- Sidebar -->
    <?php if ( is_active_sidebar( $archive_left_sidebar ) && in_array( $archive_sidebar, array( 'left', 'two' ) ) ) : ?>
        <div class="archive-sidebar left-sidebar">
            <?php dynamic_sidebar( $archive_left_sidebar ); ?>
        </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( $archive_right_sidebar ) && in_array( $archive_sidebar, array( 'right', 'two' ) ) ) : ?>
        <div class="archive-sidebar right-sidebar">
            <?php dynamic_sidebar( $archive_right_sidebar );?>
        </div>
    <?php endif; ?>

</div>
<?php
    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' ); 
?>
<?php get_footer( 'shop' ); ?>