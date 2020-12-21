<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( !class_exists( 'Haru_Project_Post_Type' ) ) {
    class Haru_Project_Post_Type {
        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

        public function __construct(){

            add_action( 'init', array( $this, 'haru_project' ) );

        }
        
        public function haru_project() {
            $labels = array(
                'menu_name'          => esc_html__( 'Project', 'haru-starter' ),
                'singular_name'      => esc_html__( 'Project', 'haru-starter' ),
                'name'               => esc_html__( 'All Project', 'haru-starter' ),
                'add_new'            => esc_html__( 'Add New', 'haru-starter' ),
                'add_new_item'       => esc_html__( 'Add New Project', 'haru-starter' ),
                'edit_item'          => esc_html__( 'Edit Project', 'haru-starter' ),
                'new_item'           => esc_html__( 'Add New Project', 'haru-starter' ),
                'view_item'          => esc_html__( 'View Project', 'haru-starter' ),
                'search_items'       => esc_html__( 'Search Project', 'haru-starter' ),
                'not_found'          => esc_html__( 'No Project items found', 'haru-starter' ),
                'not_found_in_trash' => esc_html__( 'No Project items found in trash', 'haru-starter' ),
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display Project of site', 'haru-starter' ),
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
                'has_archive'           => false,
                'exclude_from_search'   => true,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'rewrite'           => array(
                    'slug'          => 'project',
                    'with_front'    => false
                ) ,
            );

            register_post_type( 'haru_project', $args );

            // Register a taxonomy for Project Client.
            $client_labels = array(
                'name'              => esc_html__( 'Project Client', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Client', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Client', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Client', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Client', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Client:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Client', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Client', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Project Client', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Client Name', 'haru-starter' ),
            );

            $client_args = array(
                'labels'       => $client_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'client',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Project Client
            register_taxonomy('project_client', array(
                'haru_project'
            ), $client_args);

            // Register a taxonomy for Project Service.
            $service_labels = array(
                'name'              => esc_html__( 'Project Service', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Service', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Service', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Service', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Service', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Service:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Service', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Service', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Project Service', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Service Name', 'haru-starter' ),
            );

            $service_args = array(
                'labels'       => $service_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'service',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Project Service
            register_taxonomy('project_service', array(
                'haru_project'
            ), $service_args);

            // Register a taxonomy for Project Team.
            $team_labels = array(
                'name'              => esc_html__( 'Project Team', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Team', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Team', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Team', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Team', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Team:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Team', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Team', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Project Team', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Team Name', 'haru-starter' ),
            );

            $team_args = array(
                'labels'       => $team_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'team',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Project Team
            register_taxonomy('project_team', array(
                'haru_project'
            ), $team_args);

            // Register a taxonomy for Project Solution.
            $solution_labels = array(
                'name'              => esc_html__( 'Project Solution', 'taxonomy general name', 'haru-starter' ),
                'singular_name'     => esc_html__( 'Solution', 'taxonomy singular name', 'haru-starter' ),
                'menu_name'         => esc_html__( 'Solution', 'haru-starter' ) ,
                'search_items'      => esc_html__( 'Search Types', 'haru-starter' ),
                'all_items'         => esc_html__( 'All Solution', 'haru-starter' ),
                'parent_item'       => esc_html__( 'Parent Solution', 'haru-starter' ),
                'parent_item_colon' => esc_html__( 'Parent Solution:', 'haru-starter' ),
                'edit_item'         => esc_html__( 'Edit Solution', 'haru-starter' ),
                'update_item'       => esc_html__( 'Update Solution', 'haru-starter' ),
                'add_new_item'      => esc_html__( 'Add New Project Solution', 'haru-starter' ),
                'new_item_name'     => esc_html__( 'New Solution Name', 'haru-starter' ),
            );

            $solution_args = array(
                'labels'       => $solution_labels,
                'public'       => true,
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 
                    'slug'       => 'solution',
                    'with_front' => false
                ),
            );

            // Custom taxonomy for Project Solution
            register_taxonomy('project_solution', array(
                'haru_project'
            ), $solution_args);
        }
    }
}

Haru_Project_Post_Type::instance();
