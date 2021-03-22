<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

// Load the embedded Redux Framework - use this to override redux core
if ( file_exists( WP_PLUGIN_DIR . '/redux-framework/ReduxCore/framework.php') ) {
    require_once WP_PLUGIN_DIR . '/redux-framework/ReduxCore/framework.php';
}

// Use this to load extensions for Redux as custom fields,...
if ( file_exists( WP_PLUGIN_DIR . '/haru-starter/core/redux-extensions/loader.php') ) {
    require_once WP_PLUGIN_DIR . '/haru-starter/core/redux-extensions/loader.php';
}

if ( ! class_exists( 'HaruReduxFramework' ) && class_exists( 'ReduxFramework' ) ) { // Fixed for bug if not install redux framework
    class HaruReduxFramework extends ReduxFramework {
        // We can override ReduxFramework here
    }

    do_action( 'redux/init', HaruReduxFramework::init() );
}
