<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

/* Register Font */
if (!function_exists('haru_fonts_url')) {
    function haru_fonts_url() {
        $font_url = '';
        
        $lato = _x( 'on', 'Lato font: on or off', 'starter' );
        $playfair = _x( 'on', 'Montserrat font: on or off', 'starter' );

        if ( 'off' !== $lato || 'off' !== $playfair ) {
            $font_families = array();
        }

        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,700,400italic,500italic,700italic';
        }

        if ( 'off' !== $playfair ) {
            $font_families[] = 'Montserrat:400,500,600,700,400italic,500italic,600italic,700italic';
        }

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

        return esc_url_raw( $fonts_url );
    }
}

/* Load theme css */
if (!function_exists('haru_enqueue_styles')) {
    function haru_enqueue_styles() {
        /* Bootstrap CSS */
        // $url_bootstrap = get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap.min.css';
        // wp_enqueue_style( 'bootstrap', $url_bootstrap, array() );

        // /* Font-awesome */
        // wp_enqueue_style( 'font-awesome-all', get_template_directory_uri() . '/assets/libraries/font-awesome/css/all.min.css', array() );
        // wp_enqueue_style( 'font-awesome-shims', get_template_directory_uri() . '/assets/libraries/font-awesome/css/v4-shims.min.css', array() );
        // wp_enqueue_style( 'font-awesome-animation', get_template_directory_uri() . '/assets/libraries/font-awesome/css/font-awesome-animation.min.css', array() );

        /* Themify */ 
        wp_enqueue_style( 'themify', get_template_directory_uri() . '/assets/libraries/themify/themify-icons.css', array() );

        /* jPlayer */ 
        wp_enqueue_style( 'jplayer', get_template_directory_uri() . '/assets/libraries/jPlayer/skin/haru/skin.css', array() );

        /* owl-carousel */ 
        wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array() );

        /* slick */ 
        wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/libraries/slick/slick.css', array() );

        // fancybox
        wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/libraries/fancybox/jquery.fancybox.min.css', array() );

        // /* prettyPhoto */ 
        // wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/assets/libraries/prettyPhoto/css/prettyPhoto.min.css', array() );

        /* Magnific Popup */ 
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/libraries/magnificPopup/magnific-popup.css', array() );

        // /* Mega Menu */ 
        // wp_enqueue_style( 'haru-animate', get_template_directory_uri() . '/framework/core/megamenu/assets/css/animate.css' );

        // /* VC Customize */ 
        // wp_enqueue_style( 'haru-vc-customize', get_template_directory_uri() . '/assets/css/vc-customize.css' );

        // $woo_deps = class_exists( 'WooCommerce' ) ? array( 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general' ) : array();

        // Validate HTML: dashicons style

        // Load Theme CSS custom
        $style_dir  = get_theme_root();
        $style_uri  = get_theme_root_uri();

        if ( file_exists( $style_dir . '/starter/style-custom.min.css' ) && !defined('HARU_DEVELOPE_MODE') ) {
            wp_enqueue_style( 'haru-theme-style', $style_uri . '/starter/style-custom.min.css', array(), filemtime( $style_dir . '/starter/style-custom.min.css' ) );
        } else {
            /* Theme CSS */
            wp_enqueue_style( 'haru-theme-style', get_template_directory_uri() . '/style.css' );
        }

        // Load default font
        if ( !class_exists('ReduxFramework') ) {
            wp_enqueue_style( 'haru-fonts', haru_fonts_url(), array(), '1.0.0' );
        }
    }

    add_action('wp_enqueue_scripts', 'haru_enqueue_styles' );
    add_action('wp_enqueue_scripts', 'haru_enqueue_custom_css', 11); // Add Theme Options custom CSS after theme-style enqueued
}

/* Load theme js */
if (!function_exists('haru_enqueue_script')) {
    function haru_enqueue_script() {
        /* Bootstrap JS */
        // wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);

        /* Comments */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script('comment-reply');
        }

        /* jPlayer */
        wp_enqueue_script( 'jplayer', get_template_directory_uri() . '/assets/libraries/jPlayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );

        /* owl-carousel */ 
        wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '', true );

        // /* slick */ 
        wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/libraries/slick/slick.min.js', array( 'jquery' ), '', true );
        // sticky sidebar
        wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/libraries/sticky-sidebar/sticky-sidebar.min.js', array( 'jquery' ), '', true );

        // fancybox
        wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/libraries/fancybox/jquery.fancybox.min.js', array( 'jquery' ), '', true );

        // /* prettyPhoto */ 
        // wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/assets/libraries/prettyPhoto/js/jquery.prettyPhoto.min.js', array( 'jquery' ), '', true );

        // /* imagesloaded */ 
        // wp_enqueue_script( array('imagesloaded') ); // From WordPress core

        // /* infinite scroll */ 
        // wp_enqueue_script( 'jquery-infinitescroll', get_template_directory_uri() . '/assets/libraries/infinitescroll/jquery.infinitescroll.min.js', array( 'jquery' ), '', true );

        // /* isotope */ 
        // wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', array( 'jquery' ), '', true );

        // /* stellar */ 
        // wp_enqueue_script( 'jquery-stellar', get_template_directory_uri() . '/assets/libraries/stellar/jquery.stellar.min.js', array( 'jquery' ), '', true );

        /* Cookie and Magnific popup */
        wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/libraries/cookie/jquery.cookie.js', array( 'jquery' ), '', true);
        wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/libraries/magnificPopup/jquery.magnific-popup.min.js', array( 'jquery' ), '', true);
        
        // /* Mega Menu */
        // wp_enqueue_script( 'haru-megamenu-js', get_template_directory_uri() . '/framework/core/megamenu/assets/js/megamenu.js', array(), false, true );

        /* Cart variation on quick view */
        if ( class_exists( 'WooCommerce' ) ) {
            wp_enqueue_script( 'wc-add-to-cart-variation' );
            wp_enqueue_script( 'wc-add-to-cart' );
        }

        // /* Sidebar Sticky */ 
        // wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/libraries/sticky-sidebar/sticky-sidebar.min.js', array( 'jquery' ), '', true );

        /* Load theme main js */
        // wp_enqueue_script( 'haru-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'haru-theme-script', get_template_directory_uri() . '/assets/js/index.js', array( 'jquery' ), false, true );

        // wp_enqueue_script( 'haru-shop', get_template_directory_uri() . '/assets/js/haru-shop.js', array( 'jquery' ), false, true );
        // wp_enqueue_script( 'haru-shop-ajax', get_template_directory_uri() . '/assets/js/haru-shop-ajax.js', array( 'jquery' ), false, true );
        // /* Load starter js */
        // wp_enqueue_script( 'haru-starter-script', get_template_directory_uri() . '/assets/js/haru-starter.js', array( 'jquery' ), false, true );

        // wp_localize_script( 'haru-theme-script', 'haru_framework_ajax_url', get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true' );
        // wp_localize_script( 'haru-theme-script', 'searchUrl', home_url( '?s=' ) );
        // /* Localize the script (constants) */
        // $translation_array = array(
        //     'product_compare'  => esc_html__( 'Compare', 'starter' ), // Add translate css tooltip for compare button
        //     'product_viewcart' => esc_html__( 'View Cart', 'starter' ), // Add translate css tooltip for view cart button
        // );
        // wp_localize_script('haru-theme-script', 'haru_framework_constant', $translation_array);
        // wp_localize_script('haru-theme-script', 'haru_framework_theme_url', get_template_directory_uri());

    }
    add_action( 'wp_enqueue_scripts', 'haru_enqueue_script' );
    add_action( 'wp_enqueue_scripts', 'haru_enqueue_custom_script', 15 );
}

/* Enqueue admin */ 
// Load enqueue script Haru Mega Menu
add_action( 'admin_enqueue_scripts', 'haru_mega_menu_enqueue_script_admin' ); // back-end
if ( !function_exists('haru_mega_menu_enqueue_script_admin') ) {
    function haru_mega_menu_enqueue_script_admin( $hook ) {

        if ( $hook != 'nav-menus.php' ) {
            return;
        }
        // Enqueue style for Mega Menu admin
        wp_enqueue_style( 'haru-megamenu-admin', get_template_directory_uri() . '/framework/core/megamenu/assets/css/megamenu-admin.css' );

        // Load color picker library
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'haru-megamenu-admin-js', get_template_directory_uri() . '/framework/core/megamenu/assets/js/megamenu-admin.js', array( 'wp-color-picker' ), false, true );

        // Use this for select image from library
        wp_enqueue_script( 'haru-megamenu-media-init-js', get_template_directory_uri() . '/framework/core/megamenu/assets/js/media-init.js', array( 'jquery' ), false, true );

        wp_enqueue_style( 'font-awesome-all', get_template_directory_uri() . '/assets/libraries/font-awesome/css/all.min.css', array() );
        wp_enqueue_style( 'font-awesome-shims', get_template_directory_uri() . '/assets/libraries/font-awesome/css/v4-shims.min.css', array() );
    }
}

/* Load theme options custom css */
if ( !function_exists('haru_enqueue_custom_css') ) {
    function haru_enqueue_custom_css() {
        $custom_css = haru_get_option('custom_css');

        wp_add_inline_style( 'haru-theme-style', $custom_css );
    }
}

/* Load theme options custom js */
if( !function_exists('haru_enqueue_custom_script') ) {
    function haru_enqueue_custom_script() {
        $custom_js = haru_get_option('haru_custom_js');

        wp_add_inline_script( 'haru-theme-script', $custom_js );
    }
}