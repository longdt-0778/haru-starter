<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_class = array('haru-mobile-header');

// Get header mobile layout
$mobile_header_layout = get_post_meta( get_the_ID(), 'haru_' . 'mobile_header_layout', true );
if ( $mobile_header_layout == '' ) {
    $mobile_header_layout = haru_get_option('haru_mobile_header_layout');
    if ( isset($mobile_header_layout)  && !empty($mobile_header_layout) ) {
        $mobile_header_layout = haru_get_option('haru_mobile_header_layout');
    } else {
        $mobile_header_layout = 'header-mobile-1';
    }
}
$header_class[] = $mobile_header_layout;

// Mobile menu sticky
$mobile_header_stick = get_post_meta( get_the_ID(), 'haru_' . 'mobile_header_stick', true );
if ( ($mobile_header_stick == '') || ($mobile_header_stick == '-1') ) {
    $mobile_header_stick = haru_get_option('haru_mobile_header_stick');
    $mobile_header_stick = ( isset($mobile_header_stick) ) ? haru_get_option('haru_mobile_header_stick') : '0';
}
if ( $mobile_header_stick == '1' ) {
    $header_class[] = 'header-mobile-sticky';
}

// Get logo url for mobile
$logo_url           = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png';
$mobile_header_logo = haru_get_option('haru_mobile_header_logo');
$logo               = haru_get_option('haru_logo');
if ( isset($mobile_header_logo) && !empty( $mobile_header_logo ) ) {
    $logo_url = haru_get_option('haru_mobile_header_logo')['url'];
} elseif ( isset($logo) && !empty($logo) ) { // Get logo desktop
    $logo_url = haru_get_option('haru_logo')['url'];
}
// Get Logo Retina
$logo_retina_url = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png';
$mobile_header_logo_retina = haru_get_option('haru_mobile_header_logo_retina');
if ( isset($mobile_header_logo_retina) && !empty( $mobile_header_logo_retina ) ) {
    $logo_retina_url = haru_get_option('haru_mobile_header_logo_retina')['url'];
}
// Menu drop (fly or dropdown)
$mobile_header_menu_drop = get_post_meta( get_the_ID(),'haru_' . 'mobile_header_menu_drop', true );
if ( ($mobile_header_menu_drop == '') || ($mobile_header_menu_drop == '-1') ) {
    $mobile_header_menu_drop = haru_get_option('haru_mobile_header_menu_drop');
    if ( isset($mobile_header_menu_drop) && !empty($mobile_header_menu_drop) ) {
        $mobile_header_menu_drop = haru_get_option('haru_mobile_header_menu_drop');
    } else {
        $mobile_header_menu_drop = 'dropdown';
    }
}

$header_container_wrapper_class = array('haru-mobile-header-wrap', 'menu-mobile-' . $mobile_header_menu_drop);

// Search and cart on mobile header
$mobile_header_search = haru_get_option('haru_mobile_header_search');
// Set default
if ( !isset( $mobile_header_search ) ) {
    $mobile_header_search = '1';
}
$mobile_header_cart = haru_get_option('haru_mobile_header_cart');
// Set default
if ( !isset($mobile_header_cart) ) {
    $mobile_header_cart = '1';
}
$mobile_header_watch_later = haru_get_option('haru_mobile_header_watch_later');
// Set default
if ( !isset($mobile_header_watch_later) ) {
    $mobile_header_watch_later = '1';
}
$mobile_header_social = haru_get_option('haru_mobile_header_social');
// Set default
if ( !isset($mobile_header_social) ) {
    $mobile_header_social = '1';
}
$mobile_header_account = haru_get_option('haru_mobile_header_account');
// Set default
if ( !isset($mobile_header_account) ) {
    $mobile_header_account = '1';
}

// Process menu for mobile
$theme_location = 'primary';
if ( wp_is_mobile() || has_nav_menu( 'mobile' ) ) {
    $theme_location = 'mobile';
}

$header_mobile_nav = array('haru-mobile-header-nav' , 'menu-mobile-' . $mobile_header_menu_drop);

?>
<header id="haru-mobile-header" class="<?php echo esc_attr( join(' ', $header_class) ); ?>">
    <?php if ( $mobile_header_layout == 'header-mobile-2' ) : ?>
        <div class="header-mobile-above">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile-default" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
            </a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile-retina" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                <img src="<?php echo esc_url( $logo_retina_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
            </a>
        </div>
    <?php endif;?>
    <div class="<?php echo esc_attr( join(' ', $header_container_wrapper_class) ); ?>">
        <div class="container haru-mobile-header-container">
            <div class="haru-mobile-header-inner">
                <?php if ( has_nav_menu($theme_location) ) : ?>
                    <div class="toggle-icon-wrap toggle-mobile-menu" data-ref="haru-nav-mobile-menu" data-drop-type="<?php echo esc_attr($mobile_header_menu_drop); ?>">
                        <div class="toggle-icon"> <span></span></div>
                    </div>
                <?php endif; ?>

                <!-- Header mobile customize -->
                <div class="header-elements" style="font-size: inherit;">
                    <?php if ( $mobile_header_search == '1' ) : ?>
                        <?php get_template_part( 'templates/header/header-elements/search-button-mobile' ); ?>
                    <?php endif; ?>

                    <?php if ( $mobile_header_account == '1' ) : ?>
                        <?php get_template_part('templates/header/header-elements/video-user-menu'); ?>
                    <?php endif; ?>
                    
                    <?php if ( $mobile_header_watch_later == '1' ) : ?>
                    <?php get_template_part('templates/header/header-elements/video-watch-later'); ?>
                    <?php endif; ?>

                    <?php if ( class_exists( 'WooCommerce' ) && $mobile_header_cart == '1' ) : ?>
                        <?php get_template_part( 'templates/header/header-elements/mini-cart' ); ?>
                    <?php endif; ?>
                </div>
                <!-- End Header mobile customize -->
                <?php if ( $mobile_header_layout != 'header-mobile-2' ): ?>
                    <div class="header-logo-mobile">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile-default" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
                        </a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile-retina" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                            <img src="<?php echo esc_url( $logo_retina_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
                        </a>
                    </div>
                <?php endif;?>
            </div>
            <div id="haru-nav-mobile-menu" class="<?php echo esc_attr( join(' ', $header_mobile_nav) ); ?>">
                <div class="mobile-menu-header"><?php echo esc_html__( 'Menu', 'starter' ); ?><span class="mobile-menu-close"></span></div>

                <?php echo apply_filters( 'haru_before_menu_mobile_filter', '' ); // Use to add search box or something ?>
                <?php if ( has_nav_menu($theme_location) ) : ?>
                    <?php
                        $args = array(
                            'container'      => '',
                            'theme_location' => $theme_location,
                            'menu_class'     => 'haru-nav-mobile-menu', // Note: if edit this class must edit in function: 
                            'fallback_cb'    => 'haru_please_set_menu',
                            'walker'         => new HARU_MegaMenu_Walker(),
                        );
                        wp_nav_menu( $args );
                    ?>
                <?php endif; ?>
                <?php echo apply_filters( 'haru_after_menu_mobile_filter', '' ); ?>

                <?php if ( $mobile_header_social == '1' ) : ?>
                    <div class="mobile-header-social">
                        <?php get_template_part( 'templates/header/header-elements/social-network-mobile' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ( $mobile_header_menu_drop == 'fly' ) : ?>
                <div class="haru-mobile-menu-overlay"></div>
            <?php endif;?>
        </div>
    </div>
</header>