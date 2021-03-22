<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_theme_options' ) ) {

    class Redux_Framework_theme_options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'HaruReduxFramework' ) ) {
                return;
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'init', array( $this, 'remove_demo' ) );

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new HaruReduxFramework( $this->sections, $this->args );
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'starter' ),
                'desc'   => esc_html__( 'Welcome to Haru Starter theme options panel! You can easy to customize the theme for your purpose!', 'starter' ),
                'icon'   => 'el el-cog',
                'fields' => array(
                    array(
                        'id'       => 'haru_layout_style',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Layout Style', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'wide'  => array(
                                'title' => esc_html__( 'Wide', 'starter' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-wide.png'
                            ),
                            'boxed' => array(
                                'title' => esc_html__( 'Boxed', 'starter' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-boxed.png'
                            ),
                            'float' => array(
                                'title' => esc_html__( 'Float', 'starter' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-float.png'
                            )
                        ),
                        'default'  => 'wide'
                    ),

                    array(
                        'id'       => 'haru_layout_site_max_width',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Site Max Width (px)', 'starter' ),
                        'subtitle' => esc_html__( 'Set the site max width of body', 'starter' ),
                        'default'  => '1200',
                        "min"      => 980,
                        "step"     => 10,
                        "max"      => 1600,
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Body Background Mode', 'starter' ),
                        'subtitle' => esc_html__( 'Chose Background Mode', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'background' => esc_html__( 'Background', 'starter' ),
                            'pattern'    => esc_html__( 'Pattern', 'starter' )
                        ),
                        'default'  => 'background',
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'starter' ),
                        'subtitle' => esc_html__( 'Body background (Use only for Boxed layout style).', 'starter' ),
                        'default'  => array(
                            'background-color'      => '',
                            'background-repeat'     => 'no-repeat',
                            'background-position'   => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size'       => 'cover'
                        ),
                        'required'  => array(
                            array('haru_body_background_mode', '=', array('background'))
                        ),
                    ),

                    array(
                        'id'       => 'haru_body_background_pattern',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Background Pattern', 'starter' ),
                        'subtitle' => esc_html__( 'Body background pattern (Use only for Boxed layout style)', 'starter' ),
                        'desc'     => '',
                        'height'   => '40px',
                        'options'  => array(
                            'pattern-1.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-8.png'),
                            'pattern-9.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-9.png'),
                            'pattern-10.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-10.png'),
                        ),
                        'default'  => 'pattern-1.png',
                        'required' => array(
                            array('haru_body_background_mode', '=', array('pattern'))
                        ) ,
                    ),
                    
                    array(
                        'id'       => 'haru_home_preloader',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Page Preloader', 'starter' ),
                        'subtitle' => esc_html__( 'Please leave empty if you don\'t want to use this!', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'square-1'   => esc_html__('Square 01', 'starter' ),
                            'square-2'   => esc_html__('Square 02', 'starter' ),
                            'square-3'   => esc_html__('Square 03', 'starter' ),
                            'square-4'   => esc_html__('Square 04', 'starter' ),
                            'square-5'   => esc_html__('Square 05', 'starter' ),
                            'square-6'   => esc_html__('Square 06', 'starter' ),
                            'square-7'   => esc_html__('Square 07', 'starter' ),
                            'square-8'   => esc_html__('Square 08', 'starter' ),
                            'square-9'   => esc_html__('Square 09', 'starter' ),
                            'round-1'    => esc_html__('Round 01', 'starter' ),
                            'round-2'    => esc_html__('Round 02', 'starter' ),
                            'round-3'    => esc_html__('Round 03', 'starter' ),
                            'round-4'    => esc_html__('Round 04', 'starter' ),
                            'round-5'    => esc_html__('Round 05', 'starter' ),
                            'round-6'    => esc_html__('Round 06', 'starter' ),
                            'round-7'    => esc_html__('Round 07', 'starter' ),
                            'round-8'    => esc_html__('Round 08', 'starter' ),
                            'round-9'    => esc_html__('Round 09', 'starter' ),
                        ),
                        'default' => ''
                    ),

                    array(
                        'id'       => 'haru_home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Preloader background color', 'starter' ),
                        'subtitle' => '',
                        'default'  => array(),
                        'mode'     => 'background',
                        'validate' => 'colorrgba',
                        'required' => array('haru_home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'haru_home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Preloader spinner color', 'starter' ),
                        'subtitle' => '',
                        'default'  => '#e8e8e8',
                        'validate' => 'color',
                        'required' => array( 'haru_home_preloader', 'not_empty_and', array('none') ),
                    ),

                    array(
                        'id'       => 'haru_back_to_top',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Back To Top', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),

                    // Custom CSS & Script
                    array(
                        'id'       => 'haru_custom_js',
                        'type'     => 'ace_editor',
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'title'    => esc_html__('Custom JS', 'starter'),
                        'subtitle' => esc_html__('Insert your Javscript code here. You can add your Google Analytics Code here. Please do not place any <script> tags in here! From WordPress version 4.7+ you can add Custom CSS in Themes » Customize » Additional CSS.', 'starter'),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array('minLines'=> 10, 'maxLines' => 60)
                    ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'haru_header',
                        'type'     => 'header',
                        'title'    => esc_html__( 'Header Builder Type', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'starter' ),
                    ),
                    array(
                        'id'       => 'haru_header_transparent',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Transparent', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'starter' ),
                        'default'  => '0',
                    ),
                    array(
                        'id'       => 'haru_header_sticky',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Sticky', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'starter' ),
                        'default'  => '0',
                    ),
                    array(
                        'id'       => 'haru_header_sticky_element',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Sticky Element', 'starter' ),
                        'desc'     => esc_html__( 'You can choose sticky Header or only Menu (section include Haru Nav Menu widget in Elementor).', 'starter' ),
                        'options'  => array(
                            'header' => esc_html__( 'Header', 'starter' ),
                            'menu'  => esc_html__( 'Menu', 'starter' ),
                        ),
                        'default'  => 'header',
                        'required' => array( 'haru_header_sticky', '=', array( '1' ) ),
                    ),
                )
            );
            

            // Navigation
            $this->sections[] = array(
                'title'      => esc_html__( 'Navigation', 'starter' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_menu_animation',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Mega Menu Animation', 'starter' ),
                        'subtitle' => esc_html__( 'Select animation for mega menu', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'menu_fadeIn'            => esc_html__( 'fadeIn', 'starter' ),
                            'menu_fadeInDown'        => esc_html__( 'fadeInDown', 'starter' ),
                            'menu_fadeInUp'          => esc_html__( 'fadeInUp', 'starter' ),
                            'menu_bounceIn'          => esc_html__( 'bounceIn', 'starter' ),
                            'menu_flipInX'           => esc_html__( 'flipInX', 'starter' ),
                            'menu_bounceInRight'     => esc_html__( 'bounceInRight', 'starter' ),
                            'menu_fadeInRight'       => esc_html__( 'fadeInRight', 'starter' ),
                        ),
                        'default' => 'menu_fadeIn'
                    ),
                    // array(
                    //     'id'      => 'haru_header_nav_layout',
                    //     'type'    => 'button_set',
                    //     'title'   => esc_html__( 'Header navigation layout', 'starter' ),
                    //     'options' => array(
                    //         'container'    => esc_html__( 'Container','starter' ),
                    //         'nav-fullwith' => esc_html__( 'Full width','starter' ),
                    //     ),
                    //     'default'  => 'container'
                    // ),

                    // array(
                    //     'id'       => 'haru_header_nav_layout_padding',
                    //     'type'     => 'slider',
                    //     'title'    => esc_html__( 'Header navigation padding left/right (px)', 'starter' ),
                    //     'default'  => '100',
                    //     'min'      => 0,
                    //     'step'     => 1,
                    //     'max'      => 200,
                    //     'required' => array('haru_header_nav_layout','=','nav-fullwith'),
                    // ),
                    array(
                        'id'       => 'haru_header_layout_over_slideshow',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Transparent', 'starter' ),
                        'subtitle' => esc_html__( 'Header Transparent usually set to Off and should use this only for Homepage in Single Options.', 'starter' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'haru_header_navigation_skin',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Navigation Skin', 'starter' ),
                        'subtitle' => esc_html__( 'Use for Menu text color Header On Slideshow', 'starter' ),
                        'options'  => array(
                            'navigation_dark'  => esc_html__( 'Dark', 'starter' ),
                            'navigation_light' => esc_html__( 'Light', 'starter' ),
                        ),
                        'default'  => 'navigation_dark',
                        'required' => array('haru_header_layout_over_slideshow','=',true),
                    ),
                    array(
                        'id'       => 'haru_header_over_slideshow_hover',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header On Slideshow Hover Effect', 'starter' ),
                        'subtitle' => esc_html__( 'Turn On/Off effect when hover with Header On Slideshow.', 'starter' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'haru_header_layout_under_slideshow',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Under Slideshow', 'starter' ),
                        'subtitle' => esc_html__( 'Use this when set Revolution Slider layout is Full-Screen and this will override Header On Slideshow option. Should use only in Single Options.', 'starter' ),
                        'default'  => false,
                    ),
                    // array(
                    //     'id'       => 'haru_header_sticky',
                    //     'type'     => 'switch',
                    //     'title'    => esc_html__( 'Header Sticky', 'starter' ),
                    //     'subtitle' => '',
                    //     'default'  => true
                    // ),
                    // array(
                    //     'id'       => 'haru_header_sticky_skin',
                    //     'type'     => 'button_set',
                    //     'title'    => esc_html__( 'Header Sticky Skin', 'starter' ),
                    //     'subtitle' => '',
                    //     'options'  => array(
                    //         'sticky_dark'  => esc_html__( 'Dark', 'starter' ),
                    //         'sticky_light' => esc_html__( 'Light', 'starter' ),
                    //     ),
                    //     'default'  => 'sticky_light'
                    // ),
                )
            );

            // Mobile Header
            $this->sections[] = array(
                'title'      => esc_html__( 'Mobile Header', 'starter' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_mobile_header_layout',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Header Layout', 'starter' ),
                        'subtitle' => esc_html__( 'Set header mobile layout from List', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'header-mobile-1' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-1.jpg'),
                            'header-mobile-2' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-2.jpg'),
                            'header-mobile-3' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-3.jpg'),
                        ),
                        'default' => 'header-mobile-1'
                    ),
                    array(
                        'id'       => 'haru_mobile_header_menu_drop',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Menu Mobile Type', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'fly'      => esc_html__( 'Fly Menu', 'starter' ),
                            'dropdown' => esc_html__( 'Dropdown Menu', 'starter' ),
                        ),
                        'default'  => 'fly'
                    ),
                    array(
                        'id'       => 'haru_mobile_header_search',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Search', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_account',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header User Account', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_watch_later',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Watch Later', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_cart',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Cart', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_social',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Social', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_social_network',
                        'type'     => 'select',
                        'multi'    => true,
                        'width'    => '100%',
                        'title'    => esc_html__( 'Social networks', 'starter' ),
                        'subtitle' => esc_html__( 'Select social networks', 'starter' ),
                        'options'  => array(
                            'twitter'    => esc_html__( 'Twitter', 'starter' ),
                            'facebook'   => esc_html__( 'Facebook', 'starter' ),
                            'vimeo'      => esc_html__( 'Vimeo', 'starter' ),
                            'linkedin'   => esc_html__( 'LinkedIn', 'starter' ),
                            'googleplus' => esc_html__( 'Google+', 'starter' ),
                            'flickr'     => esc_html__( 'Flickr', 'starter' ),
                            'youtube'    => esc_html__( 'YouTube', 'starter' ),
                            'pinterest'  => esc_html__( 'Pinterest', 'starter' ),
                            'instagram'  => esc_html__( 'Instagram', 'starter' ),
                            'behance'    => esc_html__( 'Behance', 'starter' ),
                        ),
                        'desc'    => '',
                        'default' => '', 
                        'required'  => array('haru_mobile_header_social','=', true)
                    ),
                    array(
                        'id'       => 'haru_mobile_header_top_header',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Top Header', 'starter' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_mobile_header_stick',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Sticky Mobile Header', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                )
            );

            // Footer
            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-lines',
                'fields' => array(
                    array(
                        'id'       => 'haru_footer_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Layout', 'starter'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container'
                    ),
                    array(
                        'id'       => 'haru_footer',
                        'type'     => 'footer',
                        'title'    => esc_html__('Footer Block', 'starter'),
                        'subtitle' => '',
                    ),

                )
            );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo & Favicon', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-picture',
                'fields' => array(
                    array(
                        'id'       => 'haru_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_logo_black',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo Black', 'starter' ),
                        'subtitle' => '',
                        'desc'     => esc_html__('Use when hover with Header On Slideshow - Background Light', 'starter'),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo-black.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_sticky_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Sticky Logo', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'      => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_logo_retina',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Retina Logo', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_logo_black_retina',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo Black Retina', 'starter' ),
                        'subtitle' => '',
                        'desc'     => esc_html__('Use when hover with Header On Slideshow - Background Light', 'starter'),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo-black@2x.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_sticky_logo_retina',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Sticky Logo Retina', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'      => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_mobile_header_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Mobile Logo', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_mobile_header_logo_retina',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Mobile Logo Retina', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_custom_favicon',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Custom favicon', 'starter'),
                        'subtitle' => esc_html__( 'Upload a 16px x 16px Png/Gif/ico image.', 'starter' ),
                        'desc'     => ''
                    ),
                )
            );

            // Styling Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Color Scheme', 'starter' ),
                'desc'   => esc_html__( 'To make color scheme work you need enable SCSS Compiler.', 'starter' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'haru_dark_mode',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Dark Mode', 'starter' ),
                        'subtitle' => esc_html__( 'Set Background to Dark', 'starter' ),
                        'desc'     => esc_html__( 'This option to change Theme style to Dark Mode.', 'starter' ),
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Primary Color', 'starter' ),
                        'subtitle' => esc_html__( 'Set Primary Color', 'starter' ),
                        'compiler' => true,
                        'default'  => '#fe2854',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Secondary Color', 'starter' ),
                        'subtitle' => esc_html__( 'Set Secondary Color', 'starter' ),
                        'compiler' => true,
                        'default'  => '#fe5b34',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color', 'starter' ),
                        'subtitle' => esc_html__( 'Set Text Color.', 'starter' ),
                        'compiler' => true,
                        'default'  => '#7e7e7e',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_text_color_secondary',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color Secondary', 'starter' ),
                        'subtitle' => esc_html__( 'Set Text Color Secondary.', 'starter' ),
                        'compiler' => true,
                        'default'  => '#aba4ac',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_text_color_tertiary',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color Tertiary', 'starter' ),
                        'subtitle' => esc_html__( 'Set Text Color Tertiary.', 'starter' ),
                        'compiler' => true,
                        'default'  => '#757575',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_text_color_menu',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Menu Text Color (Level 0)', 'starter' ),
                        'subtitle' => esc_html__( 'Set Text Color for Menu Level 0.', 'starter' ),
                        'compiler' => true,
                        'default'  => '#757575',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_heading_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Heading Color', 'starter' ),
                        'subtitle' => esc_html__( 'Set Heading Color.', 'starter' ),
                        'default'  => '#1a051d',
                        'compiler' => true,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Color', 'starter' ),
                        'subtitle' => esc_html__( 'Set Link Color.', 'starter' ),
                        'compiler' => true,
                        'default'  => array(
                            'regular'  => '#7e7e7e',
                            'hover'    => '#fe2854',
                            'active'   => '#fe2854',
                        ),
                    ),
                )
            );

            // SCSS Compile
            $this->sections[] = array(
                'title'      => esc_html__( 'SCSS Compiler', 'starter' ),
                'desc'       => esc_html__( 'If you want to custom color or CSS you must enable this option.', 'starter' ),
                'icon'       => 'el el-edit',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'haru_scss_compiler',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'SCSS Compiler', 'starter' ),
                        'subtitle' => esc_html__( 'To make this option work you need install plugin Less & scss PHP Compilers.', 'starter' ),
                        'default'  => false
                    ),

                )
            );

            // Typography
            $this->sections[] = array(
                'icon'   => 'el el-font',
                'title'  => esc_html__( 'Typograhpy', 'starter' ),
                'desc'   => '',
                'fields' => array(
                    array(
                        'id'     => 'haru_section_body_font',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Body Font', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'             => 'haru_body_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Body Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set body font properties.', 'starter' ),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '400',
                            'google'      => true,
                        ),
                    ),
                    array(
                        'id'             => 'haru_secondary_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Secondary Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set secondary font properties.', 'starter' ),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Lato',
                            'font-weight' => '400',
                            'google'      => true,
                        ),
                    ),
                    array(
                        'id'     => 'haru_section_heading_font',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Heading Font', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'             => 'haru_h1_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H1 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H1 font properties.', 'starter' ),
                        'google'         => true,
                        'letter-spacing' => false,
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '36px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_h2_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H2 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H2 font properties.', 'starter' ),
                        'google'         => true,
                        'letter-spacing' => false,
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '28px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_h3_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H3 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H3 font properties.', 'starter' ),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '24px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_h4_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H4 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H4 font properties.', 'starter' ),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '21px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_h5_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H5 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H5 font properties.', 'starter' ),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '18px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_h6_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'H6 Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set H6 font properties.', 'starter' ),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '700',
                        ),
                    ),
                    array(
                        'id'     => 'haru_section_menu_font',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Menu Font', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'             => 'haru_menu_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Menu Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set Menu font properties.', 'starter' ),
                        'google'         => true,
                        'all_styles'     => false, // Enable all Google Font style/weight variations to be added to the page
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'font-style'     => false,
                        'subsets'        => true,
                        'text-transform' => false,
                        'output'         => array( '.haru-nav-menu li a' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array( '' ), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Open Sans',
                            'font-size'      => '14px',
                            'font-weight'    => '700',
                        ),
                    ),
                    array(
                        'id'     => 'haru_section_page_title_font',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Page Title Font', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'             => 'haru_page_title_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Page Title Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set page title font properties.', 'starter' ),
                        'google'         => true,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'    => false,
                        'color'          => false,
                        'text-align'     => false,
                        'font-style'     => true,
                        'subsets'        => true,
                        'font-size'      => true,
                        'font-weight'    => true,
                        'text-transform' => false,
                        'output'         => array( '.page-title-inner h1' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Open Sans',
                            'font-size'      => '36px',
                            'font-weight'    => '700',
                        ),
                    ),
                    array(
                        'id'             => 'haru_page_sub_title_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Page Sub Title Font', 'starter' ),
                        'subtitle'       => esc_html__( 'Set page sub title font properties.', 'starter' ),
                        'google'         => true,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'    => false,
                        'color'          => false,
                        'font-style'     => true,
                        'text-align'     => false,
                        'subsets'        => true,
                        'font-size'      => true,
                        'font-weight'    => true,
                        'text-transform' => false,
                        'output'         => array( '.page-title-inner .page-sub-title' ), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Open Sans',
                            'font-size'      => '14px',
                            'font-weight'    => '400italic',
                        ),
                    ),
                ),
            );
            
            // WordPress Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'WordPress Setting', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(

                )
            );

            // Pages Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Pages Setting', 'starter' ),
                'desc'       => '',
                'icon'       => 'el el-website',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_page_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'options'  => array(
                            'container'       => esc_html__( 'Container', 'starter' ),
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                        ),
                        'default'  => 'container'
                    ),
                    array(
                        'id'       => 'haru_page_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'starter' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right, Two Sidebar', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'options'  => array(
                            'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                            'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png'),
                            'two'   => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-two.png'),
                        ),
                        'default' => 'none'
                    ),
                    array(
                        'id'       => 'haru_page_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'starter' ),
                        'subtitle' => esc_html__( 'Choose the default left sidebar', 'starter' ),
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_page_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'starter' ),
                        'subtitle' => esc_html__( 'Choose the default right sidebar', 'starter' ),
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_page_sidebar', '=', array( 'right', 'two' ) ),
                    ),
                    array(
                        'id'     => 'haru-section-page-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Page Title Setting', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_page_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Page Title', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_page_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Layout', 'starter' ),
                        'subtitle' => esc_html__( 'This option will use for Background Image layout', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'full',
                        'required' => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Content Layout', 'starter' ),
                        'subtitle' => esc_html__( 'This option will use for Title, Sub Title and Breadcrumbs layout', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container',
                        'required' => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Page Title Background', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'starter' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'starter' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'starter' ),
                        'default'  => true,
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                )
            );

            // Archive Blog Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Archive (Blog) Setting', 'starter' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => 'el el-folder-close',
                'fields'     => array(
                    array(
                        'id'       => 'haru_archive_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container'
                    ),
                    array(
                        'id'       => 'haru_archive_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'starter' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right or Two Sidebar', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                            'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                            'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                            'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'haru_archive_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'data'     => 'sidebars',
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_archive_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'data'     => 'sidebars',
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_archive_sidebar', '=', array( 'right', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_display_type',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Archive Blog Style', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'large-image'  => esc_html__( 'Large Image', 'starter' ),
                            'medium-image' => esc_html__( 'Medium Image', 'starter' ),
                            'grid'         => esc_html__( 'Grid', 'starter' ),
                        ),
                        'default'  => 'large-image'
                    ),
                    array(
                        'id'       => 'haru_archive_display_columns',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Archive Display Columns', 'starter' ),
                        'subtitle' => esc_html__( 'Choose the number of columns to display on archive pages.', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            '2'     => '2',
                            '3'     => '3',
                            '4'     => '4',
                        ),
                        'default'  => '2',
                        'required' => array( 'haru_archive_display_type', '=', array( 'grid' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_paging_style',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Blog Paging Style', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'default'         => esc_html__( 'Default', 'starter' ),
                            'load-more'       => esc_html__( 'Load More', 'starter' ),
                        ),
                        'default'  => 'default'
                    ),
                    array(
                        'id'        => 'haru_archive_number_exceprt',
                        'type'      => 'text',
                        'title'     => esc_html__( 'Length of excerpt (words)', 'starter' ),
                        'default'   => '30'
                    ),
                    array(
                        'id'     => 'haru-section-archive-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Archive Title Setting', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_archive_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Archive Page Title', 'starter' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_archive_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'full',
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Content Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container',
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Archive Title Background', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  =>  array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'starter' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'starter' ),
                        'subtitle' => '',
                        'default'  => true,
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                )
            );

            // Single Blog Settings
            $this->sections[] = array(
                'title'      => esc_html__( 'Single (Blog) Setting', 'starter' ),
                'desc'       => '',
                'icon'       => 'el el-file',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_single_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container'
                    ),
                    array(
                        'id'       => 'haru_single_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'starter' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right or Two Sidebar', 'starter' ),
                        'desc'     => '',
                        'options'  => array(
                            'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                            'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                            'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                            'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'haru_single_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'starter' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_single_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'starter' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_single_sidebar', '=', array( 'right', 'two' ) ),
                    ),

                    array(
                        'id'       => 'haru_single_navigation',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post Navigation', 'starter' ),
                        'subtitle' => esc_html__( 'Show/Hide Next/Pre post', 'starter' ),
                        'default'  => true
                    ),

                    array(
                        'id'       => 'haru_single_author_info',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Author Info', 'starter' ),
                        'subtitle' => esc_html__( 'Show/Hide Author Info', 'starter' ),
                        'default'  => true
                    ),

                    array(
                        'id'     => 'haru-section-single-blog-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Single Blog Title Setting', 'starter' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_single_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Single Blog Title', 'starter' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_single_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'full',
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Content Layout', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'starter' ),
                            'container'       => esc_html__( 'Container', 'starter' ),
                        ),
                        'default'  => 'container',
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Single Blog Title Background', 'starter' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  =>  array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required'  => array( 'haru_show_single_title', '=', array( '1' ) )
                    ),
                    array(
                        'id'       => 'haru_single_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'starter' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'starter' ),
                        'subtitle' => '',
                        'default'  => true,
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                )
            );

            if ( true == haru_check_woocommerce_status() ) {
                // WooCommerce
                $this->sections[] = array(
                    'title'  => esc_html__( 'WooCommerce', 'starter' ),
                    'desc'   => '',
                    'icon'   => 'el el-shopping-cart-sign',
                    'fields' => array(
                        array(
                            'id'       => 'haru_product_sale_flash_mode',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Sale Badge Mode', 'starter' ),
                            'subtitle' => esc_html__( 'Choose Sale Badge Mode', 'starter' ),
                            'desc'     => '',
                            'options'  => array(
                                'text'    => esc_html__( 'Text', 'starter' ),
                                'percent' => esc_html__( 'Percent', 'starter' )
                            ),
                            'default'  => 'percent'
                        ),
                        array(
                            'id'       => 'haru_product_attribute',
                            'type'     => 'product_attribute',
                            'title'    => esc_html__( 'Product Attribute', 'starter' ),
                            'subtitle' => esc_html__( 'Show Product Attribute (Apply for Color, Image & Label attribute type in Products -> Attributes)', 'starter' ),
                        ),
                        array(
                            'id'       => 'haru_product_quick_view',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Quick View Button', 'starter' ),
                            'subtitle' => esc_html__( 'Enable/Disable Quick View', 'starter' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_wishlist',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Wishlist Button', 'starter' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Wishlist Button', 'starter' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_to_compare',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Compare Button', 'starter' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Compare Button', 'starter' ),
                            'default'  => true
                        ),
                    )
                );

                // Archive Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Archive Product (Shop)', 'starter' ),
                    'desc'       => '',
                    'icon'       => 'el el-book',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'       => 'haru_product_per_page',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Products Per Page', 'starter' ),
                            'desc'     => esc_html__( 'This must be numeric or empty (default 12).', 'starter' ),
                            'subtitle' => '',
                            'validate' => 'numeric',
                            'default'  => '12',
                        ),

                        array(
                            'id'       => 'haru_product_display_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Products Display Columns', 'starter' ),
                            'subtitle' => esc_html__( 'Choose the number of columns to display on shop/category pages.', 'starter' ),
                            'options'  => array(
                                '2'     => '2',
                                '3'     => '3',
                                '4'     => '4',
                                '5'     => '5'
                            ),
                            'desc'    => '',
                            'default' => '3',
                            'select2' => array( 'allowClear' =>  false ),
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'starter' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ), 
                            ),
                            'default'  => 'container'
                        ),
                        array(
                            'id'       => 'haru_archive_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Archive Product Sidebar', 'starter' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'starter' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                                'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                                'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                                'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                            ),
                            'default'  => 'left',
                        ),
                        array(
                            'id'       => 'haru_archive_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Left Sidebar', 'starter' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_sidebar', '=', array( 'left', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Right Sidebar', 'starter' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_sidebar', '=', array( 'right', 'two' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'starter' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_show_archive_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Archive Product Title', 'starter' ),
                            'subtitle' => '',
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ),
                            ),
                            'default'  => 'full',
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_content_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Content Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ),
                            ),
                            'default'  => 'container',
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Archive Product Title Background', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(
                                'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                            ),
                            'required'  => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_heading',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Heading', 'starter' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_breadcrumbs',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs', 'starter' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required'  => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),

                    )
                );

                // Single Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Single Product', 'starter' ),
                    'desc'       => '',
                    'icon'       => 'el el-laptop',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'     => 'haru-section-single-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'starter' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_single_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ),
                            ),
                            'default'  => 'container'
                        ),
                        array(
                            'id'       => 'haru_single_product_style',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Style', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'horizontal'     => esc_html__( 'Horizontal Slide', 'starter' ),
                                'vertical'       => esc_html__( 'Vertical Slide', 'starter' ),
                                'vertical_gallery'       => esc_html__( 'Vertical Gallery', 'starter' ),
                            ),
                            'default'  => 'horizontal'
                        ),
                        array(
                            'id'       => 'haru_single_product_thumbnail_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Product Thumbnail Columns', 'starter' ),
                            'subtitle' => esc_html__( 'Choose the number of columns to display thumbnails.', 'starter' ),
                            'options'  => array(
                                '2'     => '2',
                                '3'     => '3',
                                '4'     => '4',
                                '5'     => '5'
                            ),
                            'desc'    => '',
                            'default' => '4',
                            'required'  => array( 'haru_single_product_style', '=', array( 'horizontal', 'vertical' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_thumbnail_position',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Product Thumbnails Position', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'thumbnail-left'        => esc_html__( 'Left', 'starter' ),
                                'thumbnail-right'       => esc_html__( 'Right', 'starter' ),
                            ),
                            'default'  => 'thumbnail-left',
                            'required'  => array( 'haru_single_product_style', '=', array( 'vertical' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Single Product Sidebar', 'starter' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'starter' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                                'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                                'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                                'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                            ),
                            'default' => 'none'
                        ),
                        array(
                            'id'       => 'haru_single_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Left Sidebar', 'starter' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_single_product_sidebar', '=', array( 'left', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Right Sidebar', 'starter' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_single_product_sidebar', '=', array( 'right', 'two' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-single-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-single-product-related-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Related Product Options', 'starter' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_related_product_count',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Related Products Number', 'starter' ),
                            'subtitle' => '',
                            'validate' => 'number',
                            'default'  => '6',
                        ),
                        array(
                            'id'       => 'haru_related_product_display_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Related Product Display Columns', 'starter' ),
                            'subtitle' => '',
                            'options'  => array(
                                '3'     => esc_html__( '3', 'starter' ),
                                '4'     => esc_html__( '4', 'starter' ),
                            ),
                            'desc'    => '',
                            'default' => '4'
                        ),
                        array(
                            'id'     => 'haru-section-single-product-related-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-single-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'starter' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_show_single_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Single Title', 'starter' ),
                            'subtitle' => '',
                            'default'  => false
                        ),
                        array(
                            'id'       => 'haru_single_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Title Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ),
                            ),
                            'default'  => 'full',
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_content_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Content Layout', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'starter' ),
                                'container'       => esc_html__( 'Container', 'starter' ),
                            ),
                            'default'  => 'container',
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Single Product Title Background', 'starter' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(
                                'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                            ),
                            'required'  => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_heading',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Heading', 'starter' ),
                            'subtitle' => '',
                            'default'  => false,
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_breadcrumbs',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs', 'starter' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required'  => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-single-product-title-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                    )
                );
            }

            // Social options
            $this->sections[] = array(
                'title'  => esc_html__( 'Social Settings', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-facebook',
                'fields' => array(
                    array(
                        'title'    => esc_html__( 'Social Share', 'starter' ),
                        'subtitle' => esc_html__( 'Show the social sharing in blog posts or custom posttype', 'starter' ),
                        'id'       => 'haru_social_sharing',
                        'type'     => 'checkbox',
                        // Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook'  => esc_html__( 'Facebook', 'starter' ),
                            'twitter'   => esc_html__( 'Twitter', 'starter' ),
                            'linkedin'  => esc_html__( 'Linkedin', 'starter' ),
                            'tumblr'    => esc_html__( 'Tumblr', 'starter' ),
                            'pinterest' => esc_html__( 'Pinterest', 'starter' ),
                            'vk'        => esc_html__( 'VK', 'starter' ),
                            'telegram'  => esc_html__( 'Telegram', 'starter' ),
                        ),

                        // See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook'  => '1',
                            'twitter'   => '1',
                            'linkedin'  => '1',
                            'tumblr'    => '1',
                            'pinterest' => '1',
                            'vk'        => '1',
                            'telegram'  => '1',
                        )
                    )
                )
            );

            // Popup Configs
            $this->sections[] = array(
                'title'  => esc_html__( 'Newsletter Popup', 'starter' ),
                'desc'   => '',
                'icon'   => 'el el-photo',
                'fields' => array(
                    array(
                        'id'       => 'haru_show_popup',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Popup', 'starter' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_popup_width',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Width', 'starter' ),
                        'subtitle' => esc_html__( 'Please set with of popup (number only in px)', 'starter' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '750'
                    ),
                    array(
                        'id'       => 'haru_popup_height',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Height', 'starter' ),
                        'subtitle' => esc_html__( 'Please set height of popup (number only in px)', 'starter' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '450'
                    ),
                    array(
                        'id'       => 'haru_popup_effect',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Popup Effect', 'starter' ),
                        'subtitle' => '',
                        'options'  => array(
                            'mfp-zoom-in'         => esc_html__( 'ZoomIn', 'starter' ),
                            'mfp-newspaper'       => esc_html__( 'Newspaper', 'starter' ),
                            'mfp-move-horizontal' => esc_html__( 'Move Horizontal', 'starter' ),
                            'mfp-move-from-top'   => esc_html__( 'Move From Top', 'starter' ),
                            'mfp-3d-unfold'       => esc_html__( '3D Unfold', 'starter' ),
                            'mfp-zoom-out'        => esc_html__( 'ZoomOut', 'starter' ),
                            'hinge'               => esc_html__( 'Hinge', 'starter' )
                        ),
                        'desc'     => '',
                        'default'  => 'mfp-zoom-in'
                    ),
                    array(
                        'id'       => 'haru_popup_delay',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Delay', 'starter' ),
                        'subtitle' => esc_html__( 'Please set delay of popup (caculate by miliseconds)', 'starter' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '5000'
                    ),
                    array(
                        'id'       => 'haru_popup_content',
                        'type'     => 'editor',
                        'title'    => esc_html__( 'Popup Content', 'starter' ),
                        'subtitle' => esc_html__( 'Please set content of popup. You can use shortcode here.', 'starter' ),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_popup_background',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Popup Background', 'starter' ),
                        'url'      => true,
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'  =>  ''
                        ),
                    ),

                )
            );
        }

        public function setHelpTabs() {

        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'haru_starter_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu', // or submenu under Appearence
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'starter' ),
                'page_title'         => esc_html__( 'Theme Options', 'starter' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'forced_dev_mode_off' => true,
                // To forcefully disable the dev mode
                'templates_path'     => get_template_directory().'/framework/core/templates/panel',
                // Path to the templates file for various Redux elements
                'customizer'         => true,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => esc_html__( 'Visit us on GitHub', 'starter' ),
                'icon'  => 'el el-github'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => esc_html__( 'Like us on Facebook', 'starter' ),
                'icon'  => 'el el-facebook'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://twitter.com/reduxframework',
                'title' => esc_html__( 'Follow us on Twitter', 'starter' ),
                'icon'  => 'el el-twitter'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://www.linkedin.com/company/redux-framework',
                'title' => esc_html__( 'Find us on LinkedIn', 'starter' ),
                'icon'  => 'el el-linkedin'
            );

        }

    }

    // global $reduxConfig;
    $reduxConfig = new Redux_Framework_theme_options();
}