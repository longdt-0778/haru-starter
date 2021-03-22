<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com     
*/

/**
 * Register meta boxes
 * https://metabox.io/docs/registering-meta-boxes/
 * https://metabox.io/docs/filters/
 * https://metabox.io/docs/meta-box-conditional-logic/#section-the-example
 */
function haru_register_meta_boxes() {

    /* PAGE SIDEBARS */
    $sidebar_list = array();
    if ( function_exists( 'haru_get_sidebar_list' ) ) {
        $sidebar_list = haru_get_sidebar_list();
    }

    // Product special metabox
    $meta_boxes[] = array(
        'id'         => 'haru_product' . '_metabox',
        'title'      => esc_html__( 'Product Metaboxes', 'starter' ),
        'post_types' => array( 'product' ),
        'fields'     => array(
            array(
                'name'             => esc_html__('Product Guide', 'starter'),
                'id'               => 'haru_' . 'single_product_size_guide',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'desc'             => esc_html__( 'Select an image for Product Guide', 'starter' )
            ),
            array(
                'id'   => 'haru_'.  'single_product_style',
                'name' => esc_html__( 'Single Product Style', 'starter' ),
                'type' => 'select',
                'options' => array(
                    '-1'    => esc_html__( 'Default','starter' ),
                    'horizontal' => esc_html__( 'Horizontal','starter' ),
                    'vertical'  => esc_html__( 'Vertical','starter' ),
                    'vertical_gallery'  => esc_html__( 'Vertical Gallery','starter' )
                ),
                'std'      => '-1',
            ),
            array(
                'id'   => 'haru_'.  'single_product_thumbnail_columns',
                'name' => esc_html__( 'Product Thumbnail Columns', 'starter' ),
                'type' => 'select',
                'options' => array(
                    '-1'    => esc_html__( 'Default','starter' ),
                    '2'     => '2',
                    '3'     => '3',
                    '4'     => '4',
                    '5'     => '5'
                ),
                'std'      => '-1',
                'hidden' => array( 'haru_' . 'single_product_style', 'not in', array('-1','horizontal', 'vertical') )
            ),
            array(
                'id'   => 'haru_'.  'single_product_thumbnail_position',
                'name' => esc_html__( 'Product Thumbnail Position', 'starter' ),
                'type' => 'button_set',
                'options' => array(
                    '-1'    => esc_html__( 'Default','starter' ),
                    'thumbnail-left'        => 'Left',
                    'thumbnail-right'       => 'Right',
                ),
                'std'      => '-1',
                'hidden' => array( 'haru_' . 'single_product_style', '!=', 'vertical' )
            ),
        )
    );


    // POST FORMAT: Image
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Image', 'starter' ),
        'id'         => 'haru_' .'meta_box_post_format_image',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name'             => esc_html__('Image', 'starter'),
                'id'               => 'haru_' . 'post_format_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'desc'             => esc_html__( 'Select an image for post', 'starter' )
            ),
        ),
    );

    // POST FORMAT: Gallery
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Gallery', 'starter' ),
        'id'         => 'haru_' . 'meta_box_post_format_gallery',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name' => esc_html__( 'Images', 'starter' ),
                'id'   => 'haru_' . 'post_format_gallery',
                'type' => 'image_advanced',
                'desc' => esc_html__( 'Select images gallery for post','starter' )
            ),
        ),
    );

    // POST FORMAT: Video
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Video', 'starter' ),
        'id'         => 'haru_' . 'meta_box_post_format_video',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name' => esc_html__( 'Video URL or Embeded Code', 'starter' ),
                'id'   => 'haru_' . 'post_format_video',
                'type' => 'textarea',
            ),
        ),
    );

    // POST FORMAT: Audio
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Audio', 'starter' ),
        'id'         => 'haru_' . 'meta_box_post_format_audio',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name' => esc_html__( 'Audio URL or Embeded Code', 'starter' ),
                'id'   => 'haru_' . 'post_format_audio',
                'type' => 'textarea',
            ),
        ),
    );

    // POST FORMAT: QUOTE
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Quote', 'starter' ),
        'id'         => 'haru_' . 'meta_box_post_format_quote',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name' => esc_html__( 'Quote', 'starter' ),
                'id'   => 'haru_' . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Author', 'starter' ),
                'id'   => 'haru_' . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Author Url', 'starter' ),
                'id'   => 'haru_' . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
    //--------------------------------------------------
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Format: Link', 'starter' ),
        'id'         => 'haru_' . 'meta_box_post_format_link',
        'post_types' => array('post'),
        'fields'     => array(
            array(
                'name' => esc_html__( 'Url', 'starter' ),
                'id'   => 'haru_' . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => esc_html__( 'Text', 'starter' ),
                'id'   => 'haru_' . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );

    // PAGE LAYOUT
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_layout_meta_box',
        'title'      => esc_html__( 'Layout', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'    => esc_html__( 'Layout Style', 'starter' ),
                'id'      => 'haru_' . 'layout_style',
                'type'    => 'button_set',
                'options' => array(
                    '-1'    => esc_html__( 'Default','starter' ),
                    'boxed' => esc_html__( 'Boxed','starter' ),
                    'wide'  => esc_html__( 'Wide','starter' ),
                    'float' => esc_html__( 'Float','starter' )
                ),
                'std'      => '-1',
                'multiple' => false,
            ),

            array(
                'name'    => esc_html__( 'Page Layout', 'starter' ),
                'id'      => 'haru_' . 'page_layout',
                'type'    => 'button_set',
                'options' => array(
                    '-1'              => esc_html__( 'Default','starter' ),
                    'full'            => esc_html__( 'Full Width','starter' ),
                    'container'       => esc_html__( 'Container','starter' ),
                ),
                'std'      => '-1',
                'multiple' => false,
            ),

            array(
                'name'       => esc_html__( 'Page Sidebar', 'starter' ),
                'id'         => 'haru_' . 'page_sidebar',
                'type'       => 'image_set',
                'allowClear' => true,
                'options'    => array(
                    'none'    => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png',
                    'left'    => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png',
                    'right'   => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png',
                ),
                'std'      => '',
                'multiple' => false,
            ),

            array(
                'name'           => esc_html__( 'Left Sidebar', 'starter' ),
                'id'             => 'haru_' . 'page_left_sidebar',
                'type'           => 'select',
                'options'        => $sidebar_list,
                'placeholder'    => esc_html__( 'Select Sidebar','starter' ),
                'std'            => '',
                'hidden' => array( 'haru_' . 'page_sidebar', 'not in', array('','left') )
            ),

            array(
                'name'           => esc_html__( 'Right Sidebar', 'starter' ),
                'id'             => 'haru_' . 'page_right_sidebar',
                'type'           => 'select',
                'options'        => $sidebar_list,
                'placeholder'    => esc_html__( 'Select Sidebar','starter' ),
                'std'            => '',
                'hidden' => array( 'haru_' . 'page_sidebar', 'not in', array('','right') )
            ),

            array(
                'name'  => esc_html__( 'Is OnePage? (For Page only)', 'starter' ),
                'id'    => 'haru_' . 'page_onepage',
                'type'  => 'checkbox_advanced',
                'std'   => 0,
            ),

            array(
                'name'  => esc_html__( 'Page Extra Class', 'starter' ),
                'id'    => 'haru_' . 'page_extra_class',
                'type'  => 'text',
                'std'   => ''
            ),
        )
    );

    // PAGE TOP
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'site_top_meta_box',
        'title'      => esc_html__( 'Top Header', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'    => esc_html__( 'Show/Hide Top Header', 'starter' ),
                'id'      => 'haru_' . 'top_header',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default','starter' ),
                    '1'  => esc_html__( 'Show','starter' ),
                    '0'  => esc_html__( 'Hide','starter' )
                ),
            ),
            array(
                'id'      => 'haru_' . 'top_header_layout_width',
                'name'    => esc_html__( 'Top Header layout width', 'starter' ),
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1'           => esc_html__( 'Default', 'starter' ),
                    'container'    => esc_html__( 'Container', 'starter' ),
                    'topheader-fullwith' => esc_html__( 'Full width', 'starter' ),
                ),
                'visible' => array( 'haru_' . 'top_header', '!=', '0' )
            ),
            array(
                'name'       => esc_html__( 'Top Header Layout', 'starter' ),
                'id'         => 'haru_' . 'top_header_layout',
                'desc'       => esc_html__( 'If layout 1 column, it will display left sidebar.', 'starter' ),
                'type'       => 'image_set',
                'allowClear' => true,
                'width'      => '80px',
                'std'        => '',
                'options'    => array(
                    'top-header-1' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/top-header-layout-1.jpg',
                    'top-header-2' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/top-header-layout-2.jpg',
                ),
                'visible' => array( 'haru_' . 'top_header', '!=', '0' )
            ),

            array(
                'name'           => esc_html__( 'Top Left Sidebar', 'starter' ),
                'id'             => 'haru_' . 'top_header_left_sidebar',
                'type'           => 'select',
                'options'        => $sidebar_list,
                'std'            => '',
                'placeholder'    => esc_html__( 'Select Sidebar', 'starter' ),
                'multiple'       => false,
                'hidden' => array( 'haru_' . 'top_header_layout', 'not in', array('top-header-1','top-header-2') )
            ),

            array(
                'name'           => esc_html__( 'Top Right Sidebar', 'starter' ),
                'id'             => 'haru_' . 'top_header_right_sidebar',
                'type'           => 'select',
                'options'        => $sidebar_list,
                'std'            => '',
                'placeholder'    => esc_html__( 'Select Sidebar','starter' ),
                'hidden' => array( 'haru_' . 'top_header_layout', 'not in', array('top-header-1') )
            ),

        )
    );

    // PAGE LOGO
    //--------------------------------------------------
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_logo_meta_box',
        'title'      => esc_html__( 'Logo', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product', 'haru_video'),
        'tab'        => true,
        'fields'     => array(
            array(
                'id'               => 'haru_'.  'logo',
                'name'             => esc_html__( 'Logo Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'               => 'haru_'.  'logo_black',
                'name'             => esc_html__( 'Logo Black Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Black Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'               => 'haru_'.  'sticky_logo',
                'name'             => esc_html__( 'Sticky Logo Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Sticky Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'               => 'haru_'.  'logo_retina',
                'name'             => esc_html__( 'Logo Retina Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Retina Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'               => 'haru_'.  'logo_black_retina',
                'name'             => esc_html__( 'Logo Black Retina Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Black Retina Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'id'               => 'haru_'.  'sticky_logo_retina',
                'name'             => esc_html__( 'Sticky Logo Retina Image', 'starter' ),
                'desc'             => esc_html__( 'Logo Sticky Retina Image for page.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
        )
    );

    // PAGE HEADER
    //--------------------------------------------------
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_header_meta_box',
        'title'      => esc_html__( 'Header', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product', 'haru_video'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'       => esc_html__( 'Header Layout', 'starter' ),
                'id'         => 'haru_' . 'header_layout',
                'type'       => 'image_set',
                'allowClear' => true,
                'std'        => '',
                'options'    => array(
                    'header-1'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_1.jpg',
                    'header-2'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_2.jpg',
                    'header-3'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_3.jpg',
                    'header-10'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_10.jpg',
                    'header-4'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_4.jpg',
                    'header-5'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_5.jpg',
                    'header-6'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_6.jpg',
                    'header-7'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_7.jpg',
                    'header-8'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_8.jpg',
                    'header-9'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_9.jpg',
                ),
            ),

            array(
                'id'      => 'haru_' . 'header_nav_layout',
                'name'    => esc_html__( 'Header navigation layout', 'starter' ),
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1'           => esc_html__( 'Default', 'starter' ),
                    'container'    => esc_html__( 'Container', 'starter' ),
                    'nav-fullwith' => esc_html__( 'Full width', 'starter' ),
                ),
            ),

            array(
                'name'    => esc_html__( 'Header On Slideshow', 'starter' ),
                'id'      => 'haru_' . 'header_layout_over_slideshow',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default','starter' ),
                    '1'  => esc_html__( 'Enable','starter' ),
                    '0'  => esc_html__( 'Disable','starter' )
                ),
                'desc' => esc_html__( 'Enable/disable header On Slideshow.', 'starter' ),
            ),
            array(
                'name'    => esc_html__( 'Header Navigation Skin', 'starter' ),
                'id'      => 'haru_' . 'header_navigation_skin',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1'               => esc_html__( 'Default','starter' ),
                    'navigation_dark'  => esc_html__( 'Dark','starter' ),
                    'navigation_light' => esc_html__( 'Light','starter' )
                ),
                'desc' => esc_html__( 'Use for Menu text color Header On Slideshow', 'starter' ),
                'hidden' => array( 'haru_' . 'header_layout_over_slideshow', '!=', '1' )
            ),
            array(
                'name'    => esc_html__( 'Header On Slideshow Hover Effect', 'starter' ),
                'id'      => 'haru_' . 'header_over_slideshow_hover',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default','starter' ),
                    '1'  => esc_html__( 'Enable','starter' ),
                    '0'  => esc_html__( 'Disable','starter' )
                ),
                'desc' => esc_html__( 'Enable/disable header On Slideshow Hover effect.', 'starter' ),
            ),
            array(
                'name'    => esc_html__( 'Header Under Slideshow', 'starter' ),
                'id'      => 'haru_' . 'header_layout_under_slideshow',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default','starter' ),
                    '1'  => esc_html__( 'Enable','starter' ),
                    '0'  => esc_html__( 'Disable','starter' )
                ),
                'desc' => esc_html__( 'This option will override Header Float option.', 'starter' ),
            ),

            array(
                'name'    => esc_html__( 'Header Sticky', 'starter' ),
                'id'      => 'haru_' . 'header_sticky',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default', 'starter' ),
                    '1'  => esc_html__( 'Enable', 'starter' ),
                    '0'  => esc_html__( 'Disable', 'starter' ),
                ),
            ),

            array(
                'id'      => 'haru_' . 'header_sticky_skin',
                'name'    => esc_html__( 'Header Sticky Skin', 'starter' ),
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1'           => esc_html__( 'Default', 'starter' ),
                    'sticky_dark'  => esc_html__( 'Dark', 'starter' ),
                    'sticky_light' => esc_html__( 'Light', 'starter' ),
                ),
            ),
        )
    );

    // HEADER CUSTOMIZE
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_header_elements_meta_box',
        'title'      => esc_html__( 'Header Elements', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product', 'haru_video'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'  => esc_html__( 'Set header elements navigation?', 'starter' ),
                'id'    => 'haru_' . 'enable_header_elements_nav',
                'type'  => 'checkbox_advanced',
                'std'   => 0,
            ),

            // Header elements navigation
            array(
                'name'    => esc_html__( 'Header Elements Navigation', 'starter' ),
                'id'      => 'haru_' . 'header_elements_nav',
                'type'    => 'sorter',
                'std'     => '',
                'desc'    => esc_html__( 'Select element for header elements navigation. Drag to change element order', 'starter' ),
                'options' => array(
                    'video-search-box'          => esc_html__( 'Video Search Box', 'starter' ),
                    'video-search-button'       => esc_html__( 'Video Search Button', 'starter' ),
                    'video-user-menu'           => esc_html__( 'Video User Menu', 'starter' ),
                    'video-watch-later'         => esc_html__( 'Video Watch Later', 'starter' ),
                    'mini-cart'                 => esc_html__( 'Mini Cart', 'starter' ),
                    'custom-text'               => esc_html__( 'Custom Text', 'starter' ),
                    'canvas-sidebar'            => esc_html__( 'Canvas Sidebar','starter' ),
                    'social-network'            => esc_html__( 'Social Network', 'starter' ),
                ),
                'hidden' => array( 'haru_' . 'enable_header_elements_nav', '!=', '1' )
            ),

            array(
                'name'        => esc_html__( 'Social networks', 'starter' ),
                'id'          => 'haru_' . 'header_elements_nav_social_network',
                'type'        => 'select_advanced',
                'placeholder' => esc_html__( 'Select social networks', 'starter' ),
                'std'         => '',
                'multiple'    => true,
                'options'     => array(
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
            ),

            array(
                'name'           => esc_html__( 'Custom text content', 'starter' ),
                'id'             => 'haru_' . 'header_elements_nav_text',
                'type'           => 'textarea',
                'std'            => '',
                'required-field' => array('haru_' . 'enable_header_elements_nav','=','1'),
            ),

            // Header Elements left
            array(
                'name'  => esc_html__( 'Set header elements left?', 'starter' ),
                'id'    => 'haru_' . 'enable_header_elements_left',
                'type'  => 'checkbox_advanced',
                'std'   => 0,
            ),
            array(
                'name'    => esc_html__( 'Header Elements Left', 'starter' ),
                'id'      => 'haru_' . 'header_elements_left',
                'type'    => 'sorter',
                'std'     => '',
                'desc'    => esc_html__( 'Select element for header elements left. Drag to change element order', 'starter' ),
                'options' => array(
                    'video-search-box'          => esc_html__( 'Video Search Box', 'starter' ),
                    'video-search-button'       => esc_html__( 'Video Search Button', 'starter' ),
                    'video-user-menu'           => esc_html__( 'Video User Menu', 'starter' ),
                    'video-watch-later'         => esc_html__( 'Video Watch Later', 'starter' ),
                    'mini-cart'                 => esc_html__( 'Mini Cart', 'starter' ),
                    'custom-text'               => esc_html__( 'Custom Text', 'starter' ),
                    'canvas-sidebar'            => esc_html__( 'Canvas Sidebar','starter' ),
                    'social-network'            => esc_html__( 'Social Network', 'starter' ),
                ),
                'hidden' => array( 'haru_' . 'enable_header_elements_left', '!=', '1' )
            ),

            array(
                'name'        => esc_html__( 'Social networks left', 'starter' ),
                'id'          => 'haru_' . 'header_elements_left_social_network',
                'type'        => 'select_advanced',
                'placeholder' => esc_html__( 'Select social networks','starter' ),
                'std'         => '',
                'multiple'    => true,
                'options'     => array(
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
            ),

            array(
                'name'           => esc_html__( 'Custom text content left', 'starter' ),
                'id'             => 'haru_' . 'header_elements_left_text',
                'type'           => 'textarea',
                'std'            => '',
            ),

            // Header elements right
            array(
                'name'  => esc_html__( 'Set header elements right?', 'starter' ),
                'id'    => 'haru_' . 'enable_header_elements_right',
                'type'  => 'checkbox_advanced',
                'std'   => 0,
            ),

            array(
                'name'    => esc_html__( 'Header Elements Right', 'starter' ),
                'id'      => 'haru_' . 'header_elements_right',
                'type'    => 'sorter',
                'std'     => '',
                'desc'    => esc_html__( 'Select element for header elements right. Drag to change element order', 'starter' ),
                'options' => array(
                    'video-search-box'          => esc_html__( 'Video Search Box', 'starter' ),
                    'video-search-button'       => esc_html__( 'Video Search Button', 'starter' ),
                    'video-user-menu'           => esc_html__( 'Video User Menu', 'starter' ),
                    'video-watch-later'         => esc_html__( 'Video Watch Later', 'starter' ),
                    'mini-cart'                 => esc_html__( 'Mini Cart', 'starter' ),
                    'custom-text'               => esc_html__( 'Custom Text', 'starter' ),
                    'canvas-sidebar'            => esc_html__( 'Canvas Sidebar','starter' ),
                    'social-network'            => esc_html__( 'Social Network', 'starter' ),
                ),
                'hidden' => array( 'haru_' . 'enable_header_elements_right', '!=', '1' )
            ),

            array(
                'name'        => esc_html__( 'Social networks right', 'starter' ),
                'id'          => 'haru_' . 'header_elements_right_social_network',
                'type'        => 'select_advanced',
                'placeholder' => esc_html__( 'Select social networks', 'starter' ),
                'std'         => '',
                'multiple'    => true,
                'options'     => array(
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
            ),

            array(
                'name'           => esc_html__( 'Custom text content right', 'starter' ),
                'id'             => 'haru_' . 'header_elements_right_text',
                'type'           => 'textarea',
                'std'            => '',
            ),
        )
    );

    // HEADER MOBILE
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_header_mobile_meta_box',
        'title'      => esc_html__( 'Header Mobile', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product', 'haru_video'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'       => esc_html__( 'Header Mobile Layout', 'starter' ),
                'id'         => 'haru_' . 'mobile_header_layout',
                'type'       => 'image_set',
                'allowClear' => true,
                'std'        => '',
                'options'    => array(
                    'header-mobile-1'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-1.jpg',
                    'header-mobile-2'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-2.jpg',
                    'header-mobile-3'       => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-3.jpg',
                )
            ),

            array(
                'id'      => 'haru_' . 'mobile_header_menu_drop',
                'name'    => esc_html__( 'Menu Drop Type', 'starter' ),
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1'        => esc_html__( 'Default', 'starter' ),
                    'dropdown'  => esc_html__( 'Dropdown Menu', 'starter' ),
                    'fly'       => esc_html__( 'Fly Menu', 'starter' ),
                )
            ),

            array(
                'name'    => esc_html__( 'Header mobile sticky', 'starter' ),
                'id'      => 'haru_' . 'mobile_header_stick',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default', 'starter' ),
                    '1'  => esc_html__( 'Enable', 'starter' ),
                    '0'  => esc_html__( 'Disable', 'starter' ),
                ),
            ),
        )
    );

    // PAGE TITLE
    //--------------------------------------------------
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_title_meta_box',
        'title'      => esc_html__( 'Page Title', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product', 'haru_video'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'    => esc_html__( 'Show/Hide Page Title?', 'starter' ),
                'id'      => 'haru_' . 'show_page_title',
                'type'    => 'button_set',
                'std'     => '-1',
                'options' => array(
                    '-1' => esc_html__( 'Default', 'starter' ),
                    '1'  => esc_html__( 'Show', 'starter' ),
                    '0'  => esc_html__( 'Hide', 'starter' ),
                )

            ),

            array(
                'name'    => esc_html__( 'Page Title Layout', 'starter' ),
                'id'      => 'haru_' . 'page_title_layout',
                'type'    => 'button_set',
                'options' => array(
                    '-1'              => esc_html__( 'Default', 'starter' ),
                    'full'            => esc_html__( 'Full Width', 'starter' ),
                    'container'       => esc_html__( 'Container', 'starter' ),
                ),
                'std'            => '-1',
                'multiple'       => false,
                'hidden' => array( 'haru_' . 'show_page_title', '=', '0' )
            ),

            // PAGE TITLE LINE 1
            array(
                'name'           => esc_html__( 'Custom Page Title', 'starter' ),
                'id'             => 'haru_' . 'page_title_custom',
                'desc'           => esc_html__( "Enter a custom page title if you'd like.", 'starter' ),
                'type'           => 'text',
                'std'            => '',
                'hidden' => array( 'haru_' . 'show_page_title', '=', '0' )
            ),

            // PAGE TITLE LINE 2
            array(
                'name'           => esc_html__( 'Custom Page Subtitle', 'starter' ),
                'id'             => 'haru_' . 'page_subtitle_custom',
                'desc'           => esc_html__( "Enter a custom page title if you'd like.", 'starter' ),
                'type'           => 'text',
                'std'            => '',
                'hidden' => array( 'haru_' . 'show_page_title', '=', '0' )
            ),

            // BACKGROUND IMAGE
            array(
                'id'               => 'haru_'.  'page_title_bg_image',
                'name'             => esc_html__( 'Background Image', 'starter' ),
                'desc'             => esc_html__( 'Background Image for page title.', 'starter' ),
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'hidden' => array('haru_' . 'show_page_title','=','0'),
            ),

            // Breadcrumbs in Page Title
            array(
                'name'    => esc_html__( 'Breadcrumbs', 'starter' ),
                'id'      => 'haru_' . 'breadcrumbs_in_page_title',
                'desc'    => esc_html__( "Show/Hide Breadcrumbs", 'starter' ),
                'type'    => 'button_set',
                'options' => array(
                    '-1' => esc_html__( 'Default', 'starter' ),
                    '1'  => esc_html__( 'Show', 'starter' ),
                    '0'  => esc_html__( 'Hide', 'starter' ),
                ),
                'std' => '-1',
            ),
        )
    );

    // PAGE FOOTER
    //--------------------------------------------------
    $meta_boxes[] = array(
        'id'         => 'haru_' . 'page_footer_meta_box',
        'title'      => esc_html__( 'Footer', 'starter' ),
        'post_types' => array('post', 'page',  'haru_portfolio','product'),
        'tab'        => true,
        'fields'     => array(
            array(
                'name'    => esc_html__( 'Footer Layout', 'starter' ),
                'id'      => 'haru_' . 'footer_layout',
                'type'    => 'button_set',
                'options' => array(
                    '-1'              => esc_html__( 'Default', 'starter' ),
                    'full'            => esc_html__( 'Full Width', 'starter' ),
                    'container'       => esc_html__( 'Container', 'starter' ),
                ),
                'std'      => '-1',
                'multiple' => false,
            ),
            array(
                'name' => esc_html__( 'Select Footer', 'starter' ),
                'id'   => 'haru_' . 'footer',
                'type' => 'footer',
                'desc' => esc_html__( 'Select footer to override footer selected in Theme Options', 'starter' ),
            ),
        )
    );
    
    return $meta_boxes;
}

// Add new field type to RW Metabox. More details: https://metabox.io/docs/create-field-type/
add_action( 'admin_init', 'haru_load_rw_custom_fields', 1 ); // Use this for back-end
add_action( 'rwmb_meta_boxes', 'haru_load_rw_custom_fields', 1 ); // Use this for front-end @TODO: do not know now

function haru_load_rw_custom_fields() {
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/footer.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/footer.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/button-set.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/button-set.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/image-set.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/image-set.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/checkbox-advanced.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/checkbox-advanced.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/sorter.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/sorter.php';
    }
    // Starter
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/timeline.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/timeline.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/social.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/social.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/videos.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/videos.php';
    }
    if ( file_exists( WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/video-url.php') ) {
        require_once WP_PLUGIN_DIR.'/haru-starter-core/includes/metabox-extensions/custom-fields/video-url.php';
    }
}

// Hook to 'rwmb_meta_boxes' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_filter( 'rwmb_meta_boxes', 'haru_register_meta_boxes' ); // From version 4.8.0