<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( !class_exists( 'Haru_Recruitment_Post_Type' ) ) {
    class Haru_Recruitment_Post_Type {
        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

        public function __construct(){

            add_action( 'init', array( $this, 'haru_recruitment' ) );

        }
        
        public function haru_recruitment() {
            $labels = array(
                'menu_name'          => esc_html__( 'Recruitment', 'haru-starter' ),
                'singular_name'      => esc_html__( 'Recruitment', 'haru-starter' ),
                'name'               => esc_html__( 'All Recruitment', 'haru-starter' ),
                'add_new'            => esc_html__( 'Add New', 'haru-starter' ),
                'add_new_item'       => esc_html__( 'Add New Recruitment', 'haru-starter' ),
                'edit_item'          => esc_html__( 'Edit Recruitment', 'haru-starter' ),
                'new_item'           => esc_html__( 'Add New Recruitment', 'haru-starter' ),
                'view_item'          => esc_html__( 'View Recruitment', 'haru-starter' ),
                'search_items'       => esc_html__( 'Search Recruitment', 'haru-starter' ),
                'not_found'          => esc_html__( 'No Recruitment items found', 'haru-starter' ),
                'not_found_in_trash' => esc_html__( 'No Recruitment items found in trash', 'haru-starter' ),
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display Recruitment of site', 'haru-starter' ),
                'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'starter'),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_icon'             => 'dashicons-menu',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => false,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'rewrite'           => array(
                    'slug'          => 'recruitment',
                    'with_front'    => true
                ) ,
            );

            register_post_type( 'haru_recruitment', $args );

            // Register a taxonomy for Recruitment Category.
            $category_labels = array(
                'name'              => esc_html__( 'Recruitment Category', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Category', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Category', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Category', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Category', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Category:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Category', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Category', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Recruitment Category', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Category Name', 'haru-starter' ),
            );

            $category_args = array(
                'labels'       => $category_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'recruitment-category',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Recruitment Category
            register_taxonomy('recruitment_category', array(
                'haru_recruitment'
            ), $category_args);

            // Register a taxonomy for Recruitment Location.
            $location_labels = array(
                'name'              => esc_html__( 'Recruitment Location', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Location', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Location', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Location', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Location', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Location:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Location', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Location', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Recruitment Location', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Location Name', 'haru-starter' ),
            );

            $location_args = array(
                'labels'       => $location_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'location',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Recruitment Location
            register_taxonomy('recruitment_location', array(
                'haru_recruitment'
            ), $location_args);

            // Register a taxonomy for Recruitment Status.
            $status_labels = array(
                'name'              => esc_html__( 'Recruitment Status', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Status', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Status', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Status', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Status', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Status:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Status', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Status', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Recruitment Status', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Status Name', 'haru-starter' ),
            );

            $status_args = array(
                'labels'       => $status_labels,
                'public'       => true,
                'hierarchical' => false,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'status',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Recruitment Category
            register_taxonomy('recruitment_status', array(
                'haru_recruitment'
            ), $status_args);
        }
    }
}

Haru_Recruitment_Post_Type::instance();
