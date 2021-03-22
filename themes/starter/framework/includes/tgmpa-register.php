<?php
/**
 * Plugin installation and activation for WordPress themes.
 *
 * Please note that this is a drop-in library for a theme or plugin.
 * The authors of this library (Thomas, Gary and Starterte) are NOT responsible
 * for the support of your plugin or theme. Please contact the plugin
 * or theme author for support.
 *
 * @package   TGM-Plugin-Activation
 * @version   2.6.1 for parent theme Haru Starter for publication on ThemeForest
 * @link      http://tgmpluginactivation.com/
 * @author    Thomas Griffin, Gary Jones, Starterte Reinders Folmer
 * @copyright Copyright (c) 2011, Thomas Griffin
 * @license   GPL-2.0+
 */

/*
    Copyright 2011 Thomas Griffin (thomasgriffinmedia.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', '_haru_starter_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function _haru_starter_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'               => 'Haru Starter Core', // The plugin name
            'slug'               => 'haru-starter-core', // The plugin slug (typically the folder name)
            'source'             => get_template_directory() . '/plugins/haru-starter-core.zip', // The plugin source
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'      => esc_html__( 'Redux Framework', 'starter' ),
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Meta Box', 'starter' ),
            'slug'      => 'meta-box',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Less PHP Compiler', 'starter' ),
            'slug'      => 'lessphp',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'WPBakery Page Builder', 'starter' ),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/plugins/js_composer.zip',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'BuddyPress', 'starter' ),
            'slug'      => 'buddypress',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'myCred – Points, Rewards, Gamification, Ranks, Badges & Loyalty Plugin', 'starter' ),
            'slug'      => 'mycred',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Haru Vidi - Video WordPress plugin', 'starter' ),
            'slug'      => 'haru-vidi',
            'source'    => get_template_directory() . '/plugins/haru-vidi.zip',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Youzer', 'starter' ),
            'slug'      => 'youzer',
            'source'    => get_template_directory() . '/plugins/youzer.zip',
            'required'  => true,
        ),
        array(
            'name'     => esc_html__( 'Paid Memberships Pro', 'starter' ), // The plugin name
            'slug'     => 'paid-memberships-pro', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => esc_html__( 'Post Views Counter', 'starter' ), // The plugin name
            'slug'     => 'post-views-counter', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => esc_html__( 'Contact Form 7', 'starter' ), // The plugin name
            'slug'     => 'contact-form-7', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'starter' ),
            'slug'      => 'woocommerce',
            'required'  => true,
        )
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}
