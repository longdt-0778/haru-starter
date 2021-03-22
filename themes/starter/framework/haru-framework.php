<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! function_exists( 'haru_framework' ) ) {
    function haru_framework() {
        // Load include libraries: theme_setup, theme_options,...
        if ( file_exists( get_template_directory() . '/framework/includes/include_init.php' ) ) {
            require_once get_template_directory() . '/framework/includes/include_init.php';
        }

        // Load core functions: theme redux framework, mega menu, ...
        if ( file_exists( get_template_directory() . '/framework/core/core_init.php' ) ) {
            require_once get_template_directory() . '/framework/core/core_init.php';
        }

        // Load theme tax meta (taxonomy metabox)
        if ( true == haru_check_core_plugin_status() ) {
            require_once( get_template_directory() . '/framework/includes/plugin-functions.php' );
        }

    }

    haru_framework();
}

// Check WooCommerce is active before use WooCommerce in theme
function haru_check_woocommerce_status() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( class_exists( 'WooCommerce' ) ) {
        return true;
    } else {
        return false;
    }
}

// Check Haru Core plugin load
function haru_check_core_plugin_status() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( class_exists( 'Haru_Starter' ) ) {
        return true;
    } else {
        return false;
    }
}
