<?php
/**
 *  
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

/* 
 * TABLE OF FUNCTIONS
 * 0. Add a pingback url auto-discovery header for single posts, pages, or attachments.
 * 1. Add/Delete Custom Sidebar 
 * 2. Get current page url
 * 3. Get sidebar list
 * 4. Get option by option name
 * 5. Adds custom classes to the array of body classes
 * 6. Archive blog paging
 * 7. Post thumbnail
 * 8. Get post meta
 * 9. Breadcrumb
 * 10. Add post classes
 * 11. Footer Stylesheet
 * 12. Generate less to css
*/

/**
 * 1. Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if ( ! function_exists( 'haru_pingback_header' ) ) {
    function haru_pingback_header() {
        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }
    }

    add_action( 'wp_head', 'haru_pingback_header' );
}

/* 
 * 3. Get sidebar list
*/
if ( ! function_exists( 'haru_get_sidebar_list' ) ) {
    function haru_get_sidebar_list() {

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

/**
 * 4. Get option by option name
 * @param $haru_starter_options
 * @return string
 */
if ( ! function_exists( 'haru_get_option' ) ) {
    function haru_get_option( $option_name = '', $default = '' ) {
        
        if ( ! class_exists( 'ReduxFramework' ) ) return $default;

        global $haru_starter_options;

        if ( isset( $haru_starter_options[$option_name] ) ) {
            $option_name =  $haru_starter_options[$option_name];
        } else {
            $option_name = $default;
        }

        return $option_name;
    }
}

/**
 * 5. Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'haru_body_classes' ) ) {
    function haru_body_classes( $classes ) {
        // Adds layout style class to body
        $layout_style = get_post_meta( get_the_ID(), 'haru_layout_style', true );
        if ( $layout_style == '-1' || $layout_style == '' ) {
            $layout_style = haru_get_option( 'haru_layout_style', 'wide' );
        }

        // Adds a class of group-blog to blogs with more than 1 published author.
        if ( is_multi_author() ) {
            $classes[] = 'group-blog';
        }

        if ( isset( $layout_style ) && $layout_style == 'boxed' ) {
            $classes[] = 'layout-boxed';
        }

        if ( isset( $layout_style ) && $layout_style == 'wide' ) {
            $classes[] = 'layout-wide';
        }

        if ( isset( $layout_style ) && $layout_style == 'float' ) {
            $classes[] = 'layout-float';
        }

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class site preload to body
        $home_preloader = haru_get_option( 'haru_home_preloader', '' );
        if ( isset( $home_preloader ) && $home_preloader != '' ) {
            $classes[] = 'haru-site-preloader';
        }

        // Adds popup class to body
        $show_popup =  haru_get_option( 'haru_show_popup', false );
        if ( $show_popup != false ) {
            $classes[] = 'open-popup';
        }

        // Add extra class to page
        $extra_class = get_post_meta( get_the_ID(), 'haru_extra_class', true );
        if ( $extra_class != '' ) {
            $classes[] = $extra_class;
        }

        // One Page
        $page_ongepage = get_post_meta( get_the_ID(), 'haru_page_onepage', true );
        if ( $page_ongepage == '1' ) {
            $classes[] = 'onepage';
        }

        // Dark Mode
        $dark_mode = isset( $_GET['dark-mode'] ) ? $_GET['dark-mode'] : '';

        if ( $dark_mode != '1' ) {
            $dark_mode = haru_get_option( 'haru_dark_mode', '0' );
        }

        if ( $dark_mode == '1' ) {
            $classes[] = 'dark-mode';
        }

        return $classes;
    }

    add_filter( 'body_class', 'haru_body_classes' );
}

/* 6. Haru Header Layout */
if ( ! function_exists( 'haru_get_header_layout' ) ) {
    function haru_get_header_layout() {
        $haru_header_single = NULL;

        if ( is_page() || is_singular( array( 'post', 'product' ) ) ) {
            $haru_header_single = get_post_meta( get_the_ID(), 'haru_header', true );
        }

        $haru_header = haru_get_option( 'haru_header', '' );

        if ( $haru_header_single ) {
            $header_layout = $haru_header_single;
        } else {
            $header_layout = $haru_header;
        }

        if ( $header_layout ) {
            return $header_layout;
        } else {
            return;
        }
    }

    add_filter( 'haru_get_header_layout', 'haru_get_header_layout' );
}

if ( ! function_exists( 'haru_render_header_layout' ) ) {
    function haru_render_header_layout( $header_id ) {
        if ( ! $header_id  ) return;

        $args = array(
            'orderby'        => 'post__in',
            'post__in'       => explode( ',', $header_id ),
            'post_type'      => 'haru_header',
            'post_status'    => 'publish'
        );

        $posts = get_posts( $args );
        $post = $posts[0];

        echo apply_filters( 'haru_render_post_builder', do_shortcode( $post->post_content ), $post);
    }
}

/* 6. Haru Footer Layout */
if ( ! function_exists( 'haru_get_footer_layout' ) ) {
    function haru_get_footer_layout() {
        $haru_footer_single = NULL;

        if ( is_page() || is_singular( array( 'post', 'product' ) ) ) {
            $haru_footer_single = get_post_meta( get_the_ID(), 'haru_footer', true );
        }

        $haru_footer = haru_get_option( 'haru_footer', '' );

        if ( $haru_footer_single ) {
            $footer_layout = $haru_footer_single;
        } else {
            $footer_layout = $haru_footer;
        }

        if ( $footer_layout ) {
            return $footer_layout;
        } else {
            return;
        }
    }

    add_filter( 'haru_get_footer_layout', 'haru_get_footer_layout' );
}

if ( ! function_exists( 'haru_render_footer_layout' ) ) {
    function haru_render_footer_layout( $footer_id ) {
        if ( ! $footer_id  ) return;

        $args = array(
            'orderby'        => 'post__in',
            'post__in'       => explode( ',', $footer_id ),
            'post_type'      => 'haru_footer',
            'post_status'    => 'publish'
        );

        $posts = get_posts( $args );
        $post = $posts[0];

        echo apply_filters( 'haru_render_post_builder', do_shortcode( $post->post_content ), $post);
    }
}

/* 7. Archive blog paging */
/* 7.1. Paging Load More */
if ( ! function_exists( 'haru_paging_load_more' ) ) {
    function haru_paging_load_more() {
        global $wp_query;
        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }

        $link = get_next_posts_page_link( $wp_query->max_num_pages );

        if ( ! empty( $link ) ) :
            ?>
            <button data-href="<?php echo esc_url( $link ); ?>" type="button" data-loading-text="<?php echo esc_html__( 'Loading...', 'starter' ); ?>" class="blog-load-more haru-button haru-button--loading haru-button--size-medium haru-button--bg-primary haru-button--round-normal">
                <?php echo esc_html__( 'Load More', 'starter' ); ?>
            </button>
        <?php
        endif;
    }
}

/* 7.2. Paging Infinite Scroll */
if ( ! function_exists( 'haru_paging_infinitescroll' ) ) {
    function haru_paging_infinitescroll(){
        global $wp_query;
        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }

        $link = get_next_posts_page_link( $wp_query->max_num_pages );

        if ( ! empty( $link ) ) :
            ?>
            <nav id="infinite_scroll_button">
                <a href="<?php echo esc_url( $link ); ?>"></a>
            </nav>
            <div id="infinite_scroll_loading" class="text-center infinite-scroll-loading"></div>
        <?php
        endif;
    }
}

/* 7.3. Paging Nav */
if ( ! function_exists( 'haru_paging_nav' ) ) {
    function haru_paging_nav() {
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => esc_html__( 'Prev', 'starter' ),
                'next_text' => esc_html__( 'Next', 'starter' )
            )
        );
    }
}

/* 8. Get post thumbnail */
/* 8.1. Get post thumbnail */
if ( ! function_exists( 'haru_post_thumbnail' ) ) {
    function haru_post_thumbnail() {
        $html = '';

        if ( 'image' == get_post_format() ) {
            $args = array(
                'meta_key' => ''
            );

            $image = haru_get_image( $args );

            if ( ! $image ) return;

            $html = haru_get_image_html( $image, get_permalink(), the_title_attribute('echo=0'),get_the_ID() );
        } elseif ( 'gallery' == get_post_format() ) {
            $images = get_post_meta( get_the_ID(), 'haru_post_gallery_images', true );

            if ( $images && count( $images ) > 0 ) {
                $html = '<div class="haru-carousel owl-carousel owl-theme post-gallery haru-carousel--nav-opacity haru-carousel--nav-center" 
                            data-items="1" 
                            data-items-tablet="1"
                            data-items-mobile="1"
                            data-margin="20"
                            data-autoplay="false"
                            data-slide-duration="6000">';
                foreach ( $images as $image ) {
                    if ( $image ) {
                        $html .= haru_get_image_html( $image, get_permalink(), the_title_attribute( 'echo=0' ), get_the_ID(), 1 );
                    }
                }

                $html .= '</div>';
            }
        } elseif ( 'video' == get_post_format() ) {
            $video = get_post_meta( get_the_ID(), 'haru_post_video_source', true );

            if ( ! is_single() ) {
                $args = array(
                    'meta_key' => ''
                );

                $image = haru_get_image( $args );

                if ( ! $image ) {
                    if ( $video ) {
                        $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive">';

                        // If URL: show oEmbed HTML
                        if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
                            $args = array(
                                'wmode' => 'transparent'
                            );
                            $html .= wp_oembed_get( $video, $args );
                        } else {
                            // If embed code: just display
                            $html .= $video;
                        }

                        $html .= '</div>';
                    }
                } else {
                    if ( $video ) {
                        if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
                            $html .= haru_get_video_html( $image, get_permalink(), get_the_title(), $video );
                        } else {
                            $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive">';
                            $html .= $video;
                            $html .= '</div>';
                        }
                    }
                }
            } else {
                if ( $video ) {
                    $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive">';

                    // If URL: show oEmbed HTML
                    if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
                        $args = array(
                            'wmode' => 'transparent'
                        );

                        $html .= wp_oembed_get( $video, $args );
                    } else {
                        // If embed code: just display
                        $html .= $video;
                    }

                    $html .= '</div>';
                }
            }
        } elseif ( 'audio' == get_post_format() ) {
            $audio = get_post_meta( get_the_ID(), 'haru_post_audio_url', true );

            if ( $audio ) {
                if ( filter_var( $audio, FILTER_VALIDATE_URL ) ) {
                    $html .= wp_oembed_get( $audio );
                    $title = esc_attr( get_the_title() );
                    $audio = esc_url( $audio );

                    if ( empty( $html ) ) {
                        $id   = uniqid();
                        $html .= "<div data-player='$id' class='jp-jplayer' data-audio='$audio' data-title='$title'></div>";
                        $html .= haru_jplayer( $id );
                    }
                } else {
                    $html .= $audio;
                }

                $html .= '<div class="wp-clearfix"></div>';
            }
        } elseif ( 'link' == get_post_format() ) {
            $link_url = get_post_meta( get_the_ID(), 'haru_post_link_url', true );
            $link_text = get_post_meta( get_the_ID(), 'haru_post_link_text', true );

            if ( $link_url && $link_text ) {
                $html .= '<div class="post-link">';
                $html .= '<a href="' . esc_url( $link_url ) . '" rel="bookmark" title="' . esc_attr( $link_text ) . '">' . esc_html( $link_text ) . '</a>';
                $html .= '</div>';
            }
        } elseif ( 'quote' == get_post_format() ) {
            $quote = get_post_meta( get_the_ID(), 'haru_post_quote_text', true );
            $quote_author = get_post_meta( get_the_ID(), 'haru_post_quote_author', true );
            $quote_author_url = get_post_meta( get_the_ID(), 'haru_post_quote_url', true );

            if ( $quote ) {
                $html .= '<blockquote><div class="post-quote">';
                $html .= $quote;
                $html .= '</div></blockquote>';
            }

            if ( $quote_author ) {
                $html .= '<cite>';

                if ( $quote_author_url ) {
                    $html .= '<a href="' . $quote_author_url . '">';
                }

                $html .= $quote_author;

                if ( $quote_author_url ) {
                    $html .= '</a>';
                }

                $html .= '</cite>';
            }
        } else {
            $args = array(
                'meta_key' => ''
            );

            $image = haru_get_image( $args );

            if ( ! $image ) {
                return;
            }

            $html = haru_get_image_html( $image, get_permalink(), get_the_title(), get_the_ID() );
        }

        return $html;
    }
}

/* 8.2 Get post image */ 
if ( ! function_exists( 'haru_get_image' ) ) {
    function haru_get_image( $args ) {
        $default = apply_filters(
            'haru_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );

        $args   = wp_parse_args( $args, $default );

        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }

        $image_src = '';

        // Get post thumbnail
        if ( has_post_thumbnail( $args['post_id'] ) ) {
            $post_thumbnail_id = get_post_thumbnail_id( $args['post_id'] );
            $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );

            if ( $image_src_arr ) {
                $image_src = $image_src_arr[0];
            }
        }

        // Get the first image in the custom field
        if ( ( ! isset( $image_src ) || empty( $image_src ) )  && $args['meta_key'] ) {
            $post_thumbnail_id = get_post_meta( $args['post_id'], $args['meta_key'], true );
            if ( $post_thumbnail_id ) {
                $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                if ( $image_src_arr ) {
                    $image_src = $image_src_arr[0];
                }
            }
        }

        // Get the first image in the post content
        if ( (! isset( $image_src ) || empty( $image_src ) ) && ( $args['scan'] ) ) {
            preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

            if ( ! empty( $matches ) ) {
                $image_src  = $matches[1];
            }
        }

        // Use default when nothing found
        if ( (! isset( $image_src ) || empty( $image_src ) ) && ! empty( $args['default'] ) ) {
            if ( is_array( $args['default'] ) ){
                $image_src  = $args['src'];
            } else {
                $image_src = $args['default'];
            }
        }

        if ( ! isset( $image_src ) || empty( $image_src ) ) {
            return false;
        }

        return $image_src;
    }
}

/* 8.3 Get image html */ 
if ( ! function_exists( 'haru_get_image_html' ) ) {
    function haru_get_image_html( $image, $url, $title, $post_id, $gallery = 0 ) {
        if ( ! is_single() ) { 
            return sprintf( '<div class="post-thumbnail">
                                <a href="%1$s" class="post-thumbnail-link">
                                    <img class="img-responsive" src="%3$s" alt="%2$s"/>
                                </a>
                            </div>',
                $url,
                $title,
                $image
            );
        } else { 
            return sprintf( '<div class="post-thumbnail">
                                <img class="img-responsive" src="%2$s" alt="%1$s"/>
                            </div>',
                $title,
                $image
            );
        }
    }
}

/* 8.4 Get video hover */ 
if ( ! function_exists( 'haru_get_video_html' ) ) {
    function haru_get_video_html( $image, $url, $title, $video_url ) {
        return sprintf('<div class="post-thumbnail">
                            <a href="%1$s" class="post-thumbnail-link" >
                                <img class="img-responsive" src="%3$s" alt="%2$s"/>
                            </a>
                        </div>',
            $url,
            $title,
            $image
        );
    }
}

/* 8.5 Get JPlayer */ 
if ( ! function_exists( 'haru_jplayer' ) ) {
    function haru_jplayer( $id = 'jp-container-1' ) {
        ob_start();
        ?>
        <div id="<?php echo esc_attr( $id ); ?>" class="jp-audio">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls jp-play-pause">
                        <li><a href="#" class="jp-play" tabindex="1"><?php echo esc_html__( 'play', 'starter' ); ?></a></li>
                        <li><a href="#" class="jp-pause" tabindex="1"><?php echo esc_html__( 'pause', 'starter' ); ?></a></li>
                    </ul>

                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>

                    <ul class="jp-controls jp-volume">
                        <li>
                            <a href="#" class="jp-mute" tabindex="1" title="<?php echo esc_attr__( 'mute', 'starter' ); ?>"><?php echo esc_html__( 'mute', 'starter' ); ?></a>
                        </li>
                        <li>
                            <a href="#" class="jp-unmute" tabindex="1" title="<?php echo esc_attr__( 'unmute', 'starter' ); ?>"><?php echo esc_html__( 'unmute', 'starter' ); ?></a>
                        </li>
                        <li>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </li>
                    </ul>

                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                    </div>
                    <ul class="jp-toggles">
                        <li>
                            <a href="#" class="jp-shuffle" tabindex="1" title="<?php echo esc_attr__( 'shuffle', 'starter' ); ?>"><?php echo esc_html__( 'shuffle', 'starter' ); ?></a>
                        </li>
                        <li>
                            <a href="#" class="jp-shuffle-off" tabindex="1" title="<?php echo esc_attr__( 'shuffle off', 'starter' ); ?>"><?php echo esc_html__( 'shuffle off', 'starter' ); ?></a>
                        </li>
                        <li>
                            <a href="#" class="jp-repeat" tabindex="1" title="<?php echo esc_attr__( 'repeat', 'starter' ); ?>"><?php echo esc_html__( 'repeat', 'starter' ); ?></a>
                        </li>
                        <li>
                            <a href="#" class="jp-repeat-off" tabindex="1" title="<?php echo esc_attr__( 'repeat off', 'starter' ); ?>"><?php echo esc_html__( 'repeat off', 'starter' ); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="jp-no-solution">
                    <?php printf( esc_html__( '<span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="%s" target="_blank">Flash plugin</a>.', 'starter' ), 'https://get.adobe.com/flashplayer/' ); ?>
                </div>
            </div>
        </div>

        <?php
        $content = ob_get_clean();

        return $content;
    }
}

/* 
 * 10. Breadcrumb
*/

// CPT Breadcrumbs: https://wordpress.stackexchange.com/questions/204738/breadcrumbs-with-custom-post-type-without-plugin
if ( ! function_exists( 'haru_get_breadcrumbs' ) ) {
    function haru_get_breadcrumbs() {
        // Set variables for later use
        $home_link        = home_url('/');
        $home_text        = esc_html__( 'Home', 'starter' );
        $link_before      = '<span typeof="v:Breadcrumb">';
        $link_after       = '</span>';
        $link_attr        = ' rel="v:url" property="v:title"';
        $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $delimiter        = '<span class="delimiter"></span>';              // Delimiter between crumbs: 
        $before           = '<span class="current">'; // Tag before the current crumb
        $after            = '</span>';                // Tag after the current crumb
        $page_addon       = '';                       // Adds the page number if the query is paged
        $breadcrumb_trail = '';
        $category_links   = '';

        /** 
         * Set our own $wp_the_query variable. Do not use the global variable version due to 
         * reliability
         */
        $wp_the_query   = $GLOBALS['wp_the_query'];
        $queried_object = $wp_the_query->get_queried_object();

        // Handle single post requests which includes single pages, posts and attatchments
        if ( is_singular() ) {
            /** 
             * Set our own $post variable. Do not use the global variable version due to 
             * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
             */
            $post_object = sanitize_post( $queried_object );

            // Set variables 
            $title          = apply_filters( 'the_title', $post_object->post_title );
            $parent         = $post_object->post_parent;
            $post_type      = $post_object->post_type;
            $post_id        = $post_object->ID;
            $post_link      = $before . $title . $after;
            $parent_string  = '';
            $post_type_link = '';

            if ( 'post' === $post_type ) {
                // Get the post categories
                $categories = get_the_category( $post_id );
                if ( $categories ) {
                    // Lets grab the first category
                    $category  = $categories[0];

                    $category_links = get_category_parents( $category, true, $delimiter );
                    $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                    $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
                }
            }

            if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) ) {
                $post_type_object = get_post_type_object( $post_type );
                $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

                $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->menu_name ); // @TODO: singular_name -> menu_name
            }

            // Get post parents if $parent !== 0
            if ( 0 !== $parent ) {
                $parent_links = [];
                while ( $parent ) {
                    $post_parent = get_post( $parent );

                    $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                    $parent = $post_parent->post_parent;
                }

                $parent_links = array_reverse( $parent_links );

                $parent_string = implode( $delimiter, $parent_links );
            }

            // Lets build the breadcrumb trail
            if ( $parent_string ) {
                $breadcrumb_trail = $parent_string . $delimiter . $post_link;
            } else {
                $breadcrumb_trail = $post_link;
            }

            if ( $post_type_link )
                $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

            if ( $category_links )
                $breadcrumb_trail = $category_links . $breadcrumb_trail;
        }

        // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
        if ( is_archive() ) {
            if ( is_category() || is_tag() || is_tax() ) {
                // Set the variables for this section
                $term_object        = get_term( $queried_object );
                $taxonomy           = $term_object->taxonomy;
                $term_id            = $term_object->term_id;
                $term_name          = $term_object->name;
                $term_parent        = $term_object->parent;
                $taxonomy_object    = get_taxonomy( $taxonomy );
                $current_term_link  = $before . $taxonomy_object->labels->menu_name . ': ' . $term_name . $after; // @TODO: singular_name -> menu_name
                $parent_term_string = '';

                if ( 0 !== $term_parent ) {
                    // Get all the current term ancestors
                    $parent_term_links = [];
                    while ( $term_parent ) {
                        $term = get_term( $term_parent, $taxonomy );

                        $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                        $term_parent = $term->parent;
                    }

                    $parent_term_links  = array_reverse( $parent_term_links );
                    $parent_term_string = implode( $delimiter, $parent_term_links );
                }

                if ( $parent_term_string ) {
                    $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
                } else {
                    $breadcrumb_trail = $current_term_link;
                }

            } elseif ( is_author() ) {

                $breadcrumb_trail = esc_html__( 'Author archive for ', 'starter' ) .  $before . $queried_object->data->display_name . $after;

            } elseif ( is_date() ) {
                // Set default variables
                $year     = $wp_the_query->query_vars['year'];
                $monthnum = $wp_the_query->query_vars['monthnum'];
                $day      = $wp_the_query->query_vars['day'];

                // Get the month name if $monthnum has a value
                if ( $monthnum ) {
                    $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                    $month_name = $date_time->format( 'F' );
                }

                if ( is_year() ) {

                    $breadcrumb_trail = $before . $year . $after;

                } elseif( is_month() ) {

                    $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                    $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

                } elseif( is_day() ) {

                    $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                    $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                    $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
                }

            } elseif ( is_post_type_archive() ) {

                $post_type        = $wp_the_query->query_vars['post_type'];
                $post_type_object = get_post_type_object( $post_type );

                $breadcrumb_trail = $before . $post_type_object->labels->menu_name . $after; // @TODO: singular_name -> menu_name

            }
        }   

        // Handle the search page
        if ( is_search() ) {
            $breadcrumb_trail = esc_html__( 'Search query for: ', 'starter' ) . $before . get_search_query() . $after;
        }

        // Handle 404's
        if ( is_404() ) {
            $breadcrumb_trail = $before . esc_html__( 'Error 404', 'starter' ) . $after;
        }

        // Handle paged pages
        if ( is_paged() ) {
            $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
            $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
        }

        $breadcrumb_output_link  = '';
        $breadcrumb_output_link .= '<div class="haru-breadcrumb">';

        if ( is_home() || is_front_page() ) {
            // Show on home or front page @TODO not is link if not is_paged
            if ( is_front_page() ) {
                $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            } else {
                if ( is_home() ) {
                    $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
                    $breadcrumb_output_link .= $delimiter . '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'starter' ) . '</a>';
                }
            }

            // Check if have paged
            if ( is_paged() ) {
                $breadcrumb_output_link .= $page_addon;
            }
        } else {
            $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
            $breadcrumb_output_link .= $delimiter;
            $breadcrumb_output_link .= $breadcrumb_trail;
            $breadcrumb_output_link .= $page_addon;
        }

        $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

        return $breadcrumb_output_link;
    }
}

/* 13. Tag cloud size: https://codex.wordpress.org/Plugin_API/Filter_Reference/widget_tag_cloud_args */ 
if ( ! function_exists( 'haru_set_tag_cloud_sizes' ) ) {
    function haru_set_tag_cloud_sizes( $args ) {
        $args = array(
            'smallest'  => 13, 
            'default'   => 16, 
            'largest'   => 22, 
            'unit'      => 'px',
            'format'    => 'flat', 
            'separator' => "", 
            'orderby'   => 'name', 
            'order'     => 'ASC',
            'exclude'   => '', 
            'include'   => '', 
            'link'      => 'view',
            'post_type' => '', 
            'echo'      => false
        );

        return $args;
    }

    add_filter( 'widget_tag_cloud_args', 'haru_set_tag_cloud_sizes' );
}

/* 14. Add span for count list category and archive */ 
if ( ! function_exists( 'haru_cat_count_span' ) ) {
    function haru_cat_count_span( $links ) {
        $links = str_replace( array( ')', ')</span>' ), '</span>', $links );
        $links = str_replace( array( '(', '<span class="count">(' ), '<span class="count">', $links );

        return $links;
    }

    add_filter( 'wp_list_categories', 'haru_cat_count_span' );
}

/* This code filters the Archive widget to include the post count inside the link */
if ( ! function_exists( 'haru_archive_count_span' ) ) {
    function haru_archive_count_span( $links ) {
        $links = str_replace( '</a>&nbsp;(', '</a> <span class="count">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;
    }

    add_filter( 'get_archives_link', 'haru_archive_count_span' );
}

/* 15. Add function fixed load style custom */ 
if ( ! function_exists( 'haru_ssl_upload_url' ) ) {
    function haru_ssl_upload_url( $uploads ) {
        if ( is_ssl() )
            $uploads['url'] = str_replace( 'http://', 'https://', $uploads['url'] );

        return $uploads;
    }

    add_filter( 'upload_dir', 'haru_ssl_upload_url' );
}
