<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com     
*/

// Get Sidebar List
if ( ! function_exists( 'haru_get_sidebar_list_options' ) ) {
    function haru_get_sidebar_list_options() {

        if ( ! is_admin() ) {
            return array();
        }

        $sidebar_list = array();

        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[ $sidebar['id'] ] = ucwords( $sidebar['name'] );
        }

        return $sidebar_list;
    }
}

// Get Header List
if ( ! function_exists( 'haru_starter_get_header_list_options' ) ) {
    function haru_starter_get_header_list_options() {

        if ( !is_admin() ) {
            return array();
        }

        $query_args  = array(
            'post_type'         => 'haru_header',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
        );

        $page_query = new WP_Query( $query_args );

        $page_list = array();

        if ( $page_query->have_posts() ) {
            while($page_query->have_posts()) : $page_query->the_post();
                $key = get_the_ID();
                $page_list[$key] = get_the_title();
            endwhile;
        }

        return $page_list;
    }
}

// Get Footer List
if ( ! function_exists( 'haru_starter_get_footer_list_options' ) ) {
    function haru_starter_get_footer_list_options() {

        if ( !is_admin() ) {
            return array();
        }

        $query_args  = array(
            'post_type'         => 'haru_footer',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
        );

        $page_query = new WP_Query( $query_args );

        $page_list = array();

        if ( $page_query->have_posts() ) {
            while($page_query->have_posts()) : $page_query->the_post();
                $key = get_the_ID();
                $page_list[$key] = get_the_title();
            endwhile;
        }

        return $page_list;
    }
}

// Page Metabox
if ( ! function_exists( 'haru_starter_field_metaboxes_page' ) ) {
	function haru_starter_field_metaboxes_page() {

		$prefix = 'haru_';

		$cmb_page = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => esc_html__( 'Page Metabox', 'haru-starter' ),
			'object_types'  => array( 'page', 'post' ), // Post type
			'vertical_tabs' => true, // Set vertical tabs, default false
	        'tabs' => array(
	            array(
	                'id'    	=> $prefix . 'page_layout_meta_box',
	                'icon' 		=> 'dashicons-text',
	                'title' 	=> esc_html__( 'Layout', 'haru-starter' ),
	                'fields' => array(
	                    $prefix . 'layout_style',
	                    $prefix . 'layout',
	                    $prefix . 'sidebar',
	                    $prefix . 'left_sidebar',
	                    $prefix . 'right_sidebar',
	                    $prefix . 'extra_class',
	                ),
	            ),
	            array(
	                'id'    => $prefix . 'page_header_meta_box',
	                'icon' => 'dashicons-align-left',
	                'title' => esc_html__( 'Header', 'haru-starter' ),
	                'fields' => array(
	                    $prefix . 'header',
	                    $prefix . 'header_transparent',
	                    $prefix . 'header_sticky',
	                    $prefix . 'header_sticky_skin',
	                ),
	            ),
	            array(
	                'id'    => $prefix . 'page_footer_meta_box',
	                'icon' => 'dashicons-align-right',
	                'title' => esc_html__( 'Footer', 'haru-starter' ),
	                'fields' => array(
	                    $prefix . 'footer',
	                ),
	            ),
	            array(
	                'id'    => $prefix . 'page_title_meta_box',
	                'icon' => 'dashicons-menu-alt',
	                'title' => esc_html__( 'Title', 'haru-starter' ),
	                'fields' => array(
	                    $prefix . 'show_title',
	                    $prefix . 'title_layout',
	                    $prefix . 'title_content_layout',
	                    $prefix . 'title_bg_image',
	                    $prefix . 'title_custom',
	                    $prefix . 'sub_title_custom',
	                    $prefix . 'title_breadcrumbs',
	                ),
	            ),
	        )
		) );

		$cmb_page->add_field( array(
			'name'          => esc_html__( 'Layout Style', 'haru-starter' ),
			'desc' 			=> esc_html__( 'Set Layout Style for this page. This option will override settings in Theme Options -> General Settings -> Layout Style.', 'haru-starter' ),
			'id'            => $prefix . 'layout_style',
			'type'    		=> 'radio_inline',
            'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                'boxed' 	=> esc_html__( 'Boxed', 'haru-starter' ),
                'wide'  	=> esc_html__( 'Wide', 'haru-starter' ),
                'float' 	=> esc_html__( 'Float', 'haru-starter' )
            ),
            'default' => 'default',
		) );

		$cmb_page->add_field( array(
			'name'          => esc_html__( 'Page Layout', 'haru-starter' ),
			'desc' 			=> esc_html__( 'Set Page Layout for this page. This option will override settings in Theme Options -> XXX -> Layout.', 'haru-starter' ),
			'id'            => $prefix . 'layout',
			'type'    		=> 'radio_inline',
            'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                'full'      => esc_html__( 'Full Width', 'haru-starter' ),
                'container' => esc_html__( 'Container', 'haru-starter' )
            ),
            'default' => 'default',
		) );

		$cmb_page->add_field( array(
			'name'          => esc_html__( 'Page Sidebar', 'haru-starter' ),
			'desc' 			=> esc_html__( 'Set Page Sidebar for this page. This option will override settings in Theme Options -> XXX -> Sidebar.', 'haru-starter' ),
			'id'            => $prefix . 'sidebar',
			'type'          => 'radio_image',
			'options'       => array(
				'default'  	=> esc_html__( 'Default', 'haru-starter' ),
				'none'  	=> esc_html__( 'No Sidebar', 'haru-starter' ),
				'left'  	=> esc_html__( 'Left Sidebar', 'haru-starter' ),
				'right' 	=> esc_html__( 'Right Sidebar', 'haru-starter' ),
				'two'   	=> esc_html__( 'Two Sidebar', 'haru-starter' ),
			),
			'images_path'      => plugins_url( HARU_STARTER_CORE_NAME . '/assets/'),
			'images'           => array(
				'default'  	=> 'images/sidebar-none.png',
				'none'  	=> 'images/sidebar-none.png',
				'left'  	=> 'images/sidebar-left.png',
				'right' 	=> 'images/sidebar-right.png',
				'two'   	=> 'images/sidebar-two.png',
			),
		) );

		$cmb_page->add_field( array(
		  	'name' 				=> esc_html__( 'Sidebar Left', 'haru-starter' ),
		  	'desc' 				=> esc_html__( 'Select a sidebar to display if use layout have sidebar left. This option will override settings in Theme Options -> XXX -> Sidebar Left.', 'haru-starter' ),
		  	'id' 				=> $prefix . 'left_sidebar',
		  	'type'             	=> 'pw_select',
			'options_cb' 		=> 'haru_get_sidebar_list_options',
			'attributes' => array(
				'placeholder' 				=> esc_html__( 'Select sidebar Left for Single Page', 'haru-starter' ),
				'required'               	=> true, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'sidebar',
				'data-conditional-value' 	=> wp_json_encode( array( 'left', 'two' ) ),
			),
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 				=> esc_html__( 'Sidebar Right', 'haru-starter' ),
		  	'desc' 				=> esc_html__( 'Select a sidebar to display if use layout have sidebar right. This option will override settings in Theme Options -> XXX -> Sidebar Right.', 'haru-starter' ),
		  	'id' 				=> $prefix . 'right_sidebar',
		  	'type'             	=> 'pw_select',
			'options_cb' 		=> 'haru_get_sidebar_list_options',
			'attributes' => array(
				'placeholder' 				=> esc_html__( 'Select sidebar Right for Single Page', 'haru-starter' ),
				'required'               	=> true, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'sidebar',
				'data-conditional-value' 	=> wp_json_encode( array( 'right', 'two' ) ),
			),
	  	) );

	  	$cmb_page->add_field( array(
	        'name'          => esc_html__( 'Extra Class', 'haru-starter' ),
	        'desc' 			=> esc_html__( 'Add extra class to body and use Custom CSS to get different style.', 'haru-starter' ),
	        'id'            => $prefix . 'extra_class',
	        'type'          => 'text',
	    ) );

	  	// Header
	  	$cmb_page->add_field( array(
		  	'name' 				=> esc_html__( 'Header Layout', 'haru-starter' ),
		  	'desc' 				=> esc_html__( 'Set Header for page. This option will override settings in Theme Options -> Header -> Header Builder Type.', 'haru-starter' ),
		  	'id' 				=> $prefix . 'header',
		  	'type'             	=> 'pw_select',
			'options_cb' 		=> 'haru_starter_get_header_list_options',
			'attributes' => array(
				'placeholder' 			=> esc_html__( 'Select Header', 'haru-starter' ),
				'required'               => false, // Will be required only if visible.
			),
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Header Transparent', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'Enable/Disable Header Transparent. This option will override settings in Theme Options -> Header -> Header Transparent.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'header_transparent',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                '1' 		=> esc_html__( 'On', 'haru-starter' ),
                '0'  		=> esc_html__( 'Off', 'haru-starter' )
            ),
            'default' => 'default',
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Header Sticky', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'Enable/Disable Header Sticky. This option will override settings in Theme Options -> Header -> Header Sticky.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'header_sticky',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                '1' 		=> esc_html__( 'On', 'haru-starter' ),
                '0'  		=> esc_html__( 'Off', 'haru-starter' )
            ),
            'default' => 'default',
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Header Sticky Skin', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'Set Header Sticky. This option will override settings in Theme Options -> Header.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'header_sticky_skin',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                'light'  	=> esc_html__( 'Light', 'haru-starter' ),
                'dark' 		=> esc_html__( 'Dark', 'haru-starter' ),
            ),
            'default' => 'default',
	  	) );

	  	// Footer
	  	$cmb_page->add_field( array(
		  	'name' 				=> esc_html__( 'Footer Layout', 'haru-starter' ),
		  	'desc' 				=> esc_html__( 'Set Footer for page. This option will override settings in Theme Options -> Footer.', 'haru-starter' ),
		  	'id' 				=> $prefix . 'footer',
		  	'type'             	=> 'pw_select',
			'options_cb' 		=> 'haru_starter_get_footer_list_options',
			'attributes' => array(
				'placeholder' 			=> esc_html__( 'Select Footer', 'haru-starter' ),
				'required'               => false, // Will be required only if visible.
			),
	  	) );

	  	// Title
	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Title', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'Show/Hide Page Title. This option will override settings in Theme Options -> XXX -> Page Title.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'show_title',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                '1' 		=> esc_html__( 'On', 'haru-starter' ),
                '0'  		=> esc_html__( 'Off', 'haru-starter' )
            ),
            'default' => 'default',
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Title Layout', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'This option will override settings in Theme Options -> XXX -> Page Title Layout.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'title_layout',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   	=> esc_html__( 'Default', 'haru-starter' ),
                'container' 	=> esc_html__( 'Container', 'haru-starter' ),
                'full'  		=> esc_html__( 'Full Width', 'haru-starter' )
            ),
            'default' => 'default',
            'attributes' => array(
				'required'               	=> true, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'show_title',
				'data-conditional-value' 	=> wp_json_encode( array( '1' ) ),
			),
	  	) );

	  	$cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Title Content Layout', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'This option will override settings in Theme Options -> XXX -> Page Title Content Layout.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'title_content_layout',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   	=> esc_html__( 'Default', 'haru-starter' ),
                'container' 	=> esc_html__( 'Container', 'haru-starter' ),
                'full'  		=> esc_html__( 'Full Width', 'haru-starter' )
            ),
            'default' => 'default',
            'attributes' => array(
				'required'               	=> true, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'show_title',
				'data-conditional-value' 	=> wp_json_encode( array( '1' ) ),
			),
	  	) );

	    $cmb_page->add_field( array(
	        'name'          => esc_html__( 'Title Background Image', 'haru-starter' ),
	        'desc' 			=> esc_html__( 'This option will override settings in Theme Options -> XXX -> Page Title Background.', 'haru-starter' ),
	        'id'            => $prefix . 'title_bg_image',
	        'type'    		=> 'file',
	        'options' => array(
				'url' => true, // Hide the text input for the url
			),
			'query_args' => array(
				'type' => array(
					'image/gif',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => 'medium',
	        'attributes' => array(
				'required'               	=> false, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'show_title',
				'data-conditional-value' 	=> wp_json_encode( array( '1' ) ),
			),
	    ) );

	  	$cmb_page->add_field( array(
	        'name'          => esc_html__( 'Title Heading Custom', 'haru-starter' ),
	        'id'            => $prefix . 'title_custom',
	        'desc' 			=> esc_html__( 'This option will override auto generate Title.', 'haru-starter' ),
	        'type'          => 'text',
	        'attributes' => array(
				'required'               	=> false, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'show_title',
				'data-conditional-value' 	=> wp_json_encode( array( '1' ) ),
			),
	    ) );

	    $cmb_page->add_field( array(
	        'name'          => esc_html__( 'Sub Title Custom', 'haru-starter' ),
	        'id'            => $prefix . 'sub_title_custom',
	        'desc' 			=> esc_html__( 'This option will override auto generate Sub Title.', 'haru-starter' ),
	        'type'          => 'text',
	        'attributes' => array(
				'required'               	=> false, // Will be required only if visible.
				'data-conditional-id'    	=> $prefix . 'show_title',
				'data-conditional-value' 	=> wp_json_encode( array( '1' ) ),
			),
	    ) );

	    $cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Title Heading', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'This option will override settings in Theme Options -> XXX -> Heading.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'title_heading',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                '1' 		=> esc_html__( 'On', 'haru-starter' ),
                '0'  		=> esc_html__( 'Off', 'haru-starter' )
            ),
            'default' => 'default',
	  	) );

	    $cmb_page->add_field( array(
		  	'name' 			=> esc_html__( 'Title Breadcrumbs', 'haru-starter' ),
		  	'desc' 			=> esc_html__( 'This option will override settings in Theme Options -> XXX -> Breadcrumbs.', 'haru-starter' ),
		  	'id' 			=> $prefix . 'title_breadcrumbs',
		  	'type'    		=> 'radio_inline',
		  	'options' 		=> array(
                'default'   => esc_html__( 'Default', 'haru-starter' ),
                '1' 		=> esc_html__( 'On', 'haru-starter' ),
                '0'  		=> esc_html__( 'Off', 'haru-starter' )
            ),
            'default' => 'default',
	  	) );
	}

	add_action( 'cmb2_admin_init', 'haru_starter_field_metaboxes_page' );
}

// Term Metabox
if ( ! function_exists( 'haru_starter_field_metaboxes_term' ) ) {
	function haru_starter_field_metaboxes_term() {
		$prefix = 'haru_';

		$cmb_product_category = new_cmb2_box( array(
			'id'            => $prefix . 'metabox_product_category',
			'title'         => esc_html__( 'Term Metabox', 'haru-starter' ),
			'object_types'  => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
			'taxonomies'    => array( 'category', 'post_tag', 'product_cat', 'product_tag' ),
		) );

		$cmb_product_category->add_field( array(
	 		'name' => esc_html__( 'Title Background', 'haru-starter' ), 
	 		'desc' => esc_html__( 'This image use for Term Page Title background like Category, Tag...', 'haru-starter' ), 
	 		'id'   => $prefix . 'title_bg_image',
	 		'type' => 'file',
	 		'preview_size' => 'thumbnail',
	 	) );

	 	$cmb_recruit_category = new_cmb2_box( array(
			'id'            => $prefix . 'metabox_recruit_category',
			'title'         => esc_html__( 'Recruit Metabox', 'haru-starter' ),
			'object_types'  => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
			'taxonomies'    => array( 'recruitment_category' ),
		) );

		$cmb_recruit_category->add_field( array(
	 		'name' => esc_html__( 'Category Image', 'haru-starter' ), 
	 		'desc' => esc_html__( 'This image use for Recruit Category Featured Image', 'haru-starter' ), 
	 		'id'   => $prefix . 'recruit_featured_image',
	 		'type' => 'file',
	 		'preview_size' => 'thumbnail',
	 	) );
	}

	add_action( 'cmb2_admin_init', 'haru_starter_field_metaboxes_term' );
}

// CPT Project Metabox
if ( ! function_exists( 'haru_starter_field_metaboxes_project' ) ) {
	function haru_starter_field_metaboxes_project() {
		$prefix = 'haru_project_';

		$cmb_cpt_project = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => esc_html__( 'Project Metabox', 'haru-starter' ),
			'object_types'  => array( 'haru_project' ), // Post type
		) );

		$cmb_cpt_project->add_field( array(
			'name' => esc_html__( 'Image Layout', 'haru-starter' ), 
	 		'desc' => esc_html__( 'This images use for display Project List Masonry layout', 'haru-starter' ), 
	 		'id'   => $prefix . 'image_layout',
	 		'type' => 'file',
	 		'preview_size' => 'thumbnail',
		) ); 

		$cmb_cpt_project->add_field( array(
	 		'name' => esc_html__( 'Images Slideshow', 'haru-starter' ), 
	 		'desc' => esc_html__( 'These images use for Slideshow at Top of Single Project', 'haru-starter' ), 
	 		'id'   => $prefix . 'images_slideshow',
	 		'type' => 'file_list',
	 		'preview_size' => array( 50, 50 ),
	 	) ); 
	}

	add_action( 'cmb2_admin_init', 'haru_starter_field_metaboxes_project' );
}

// CPT Recruitment Metabox
if ( ! function_exists( 'haru_starter_field_metaboxes_recruit' ) ) {
	function haru_starter_field_metaboxes_recruit() {
		$prefix = 'haru_recruit_';

		$cmb_cpt_recruitment = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => esc_html__( 'Recruitment Metabox', 'haru-starter' ),
			'object_types'  => array( 'haru_recruitment' ), // Post type
			'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,
		) );

		$group_repeat = $cmb_cpt_recruitment->add_field( array(
	 		'id'   => $prefix . 'testimonial',
	 		'type'        => 'group',
	 		'repeatable'  => true,
	 		'options'     => array(
                'group_title'   => esc_html__( 'Testimonial', 'haru-starter' ) . ' {#}', // {#} gets replaced by row number
                'add_button'    => esc_html__( 'Add another Testimonial', 'haru-starter' ),
                'remove_button' => esc_html__( 'Remove Testimonial', 'haru-starter' ),
                'sortable'      => true, // beta
            ),
		) ); 

		$cmb_cpt_recruitment->add_group_field( $group_repeat, array(
	 		'name' => esc_html__( 'Image', 'haru-starter' ),
	 		'id'   => $prefix . 'testimonial_image',
	 		'type' => 'file',
	 		'preview_size' => array( 50, 50 ),
	 	) ); 

	 	$cmb_cpt_recruitment->add_group_field( $group_repeat, array(
	        'name'          => esc_html__( 'Title', 'haru-starter' ),
	        'id'            => $prefix . 'title',
	        'type'          => 'text',
	    ) );

	    $cmb_cpt_recruitment->add_group_field( $group_repeat, array(
	        'name'          => esc_html__( 'Sub Title', 'haru-starter' ),
	        'id'            => $prefix . 'sub_title',
	        'type'          => 'text',
	    ) );

	    $cmb_cpt_recruitment->add_group_field( $group_repeat, array(
	        'name'          => esc_html__( 'Description', 'haru-starter' ),
	        'id'            => $prefix . 'description',
	        'type'          => 'textarea',
	    ) );
	}

	add_action( 'cmb2_admin_init', 'haru_starter_field_metaboxes_recruit' );
}