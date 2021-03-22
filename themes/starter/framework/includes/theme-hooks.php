<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

/* 
 * TABLE OF FUNCTIONS
 * 1. haru_before_page_main
 * 2. haru_before_page_main_content
 * 3. haru_after_page_main
 * 3. haru_archive_heading
 * 4. haru_after_single_post_content
 * 5. haru_after_single_post
 * 6. haru_before_page
 * 7. haru_footer_main
*/

// 1. haru_before_page_main
if ( ! function_exists( 'haru_loading_animation' ) ) {
  function haru_loading_animation() {
    get_template_part( 'templates/loading-animation' );
  }
}
add_action( 'haru_before_page_main', 'haru_loading_animation', 5 );

if ( ! function_exists( 'haru_newsletter_popup' ) ) {
  function haru_newsletter_popup() {
    get_template_part( 'templates/newsletter-popup' );
  }
}
add_action( 'haru_before_page_main', 'haru_newsletter_popup', 10 );

if ( ! function_exists( 'haru_onepage_navigation' ) ) {
  function haru_onepage_navigation() {
    get_template_part( 'templates/onepage-navigation' );
  }
}
add_action( 'haru_before_page_main', 'haru_onepage_navigation', 15 );

// 2. haru_before_page_main_content
// 2.1. Haru Header
if ( ! function_exists( 'haru_page_header' ) ) {
  function haru_page_header() {
    get_template_part( 'templates/header', 'template' );
  }
  add_action( 'haru_before_page_main_content', 'haru_page_header', 5 );
}

// 3. haru_after_page_main
// 3.1. Back to Top
if ( ! function_exists( 'haru_back_to_top' ) ) {
  function haru_back_to_top() {
    get_template_part( 'templates/back-to-top' );
  }
}
$back_to_top = haru_get_option('haru_back_to_top');
if ( NULL !== $back_to_top && $back_to_top == true ) {
  add_action( 'haru_after_page_main', 'haru_back_to_top', 5 );
}

// 3.2. Login Popup
if ( ! function_exists( 'haru_login_popup' ) ) {
  function haru_login_popup() {
    // Check is maintenance pagmain      
    if ( ! shortcode_exists( 'woocommerce_my_account' ) ) {
      return;
    }
    if ( is_user_logged_in() ) {
      return;
    }
    ?>
    <div id="login-popup" class="login-modal unero-modal woocommerce-account" tabindex="-1" role="dialog">
      <div class="modal-content">
        <div class="container">
          <?php echo do_shortcode( '[woocommerce_my_account]' ) ?>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="close-modal"><?php echo esc_html__( 'Close', 'starter' ) ?></a>
      </div>
    </div>
    <?php
  }
}
// add_action( 'haru_after_page_main', 'haru_login_popup', 5 );

// 3.3. Ajax loading overflow (also can change loading effect similar page loading)
function haru_ajax_loading() {
  ?>
  <!-- @TODO: check condition -->
  <div class="haru-ajax-overflow">
    <div class="haru-ajax-loading">
      <div class="loading-wrapper">
        <div class="spinner" id="spinner_one"></div>
        <div class="spinner" id="spinner_two"></div>
        <div class="spinner" id="spinner_three"></div>
        <div class="spinner" id="spinner_four"></div>
        <div class="spinner" id="spinner_five"></div>
        <div class="spinner" id="spinner_six"></div>
        <div class="spinner" id="spinner_seven"></div>
        <div class="spinner" id="spinner_eight"></div>
      </div>
    </div>
  </div>
  <?php
}
add_action( 'haru_after_page_main', 'haru_ajax_loading', 10 );

/* 3. haru_archive_heading */
if (!function_exists('haru_archive_heading')) {
  function haru_archive_heading() {
    get_template_part( 'templates/page-heading' );
  }
}
add_action( 'haru_before_archive', 'haru_archive_heading', 5 );


/* 4. haru_after_single_post_content */
/* 4.1. Link pages */
if (!function_exists('haru_link_pages')) {
  function haru_link_pages() {
    wp_link_pages(array(
      'before'      => '<div class="haru-page-links"><span class="haru-page-links-title">' . esc_html__( 'Pages:', 'starter' ) . '</span>',
      'after'       => '</div>',
      'link_before' => '<span class="haru-page-link">',
      'link_after'  => '</span>',
    ));
  }
  add_action('haru_after_single_post_content', 'haru_link_pages', 5);
}
/* 4.2. Post tags */
if (!function_exists('haru_post_tags')) {
  function haru_post_tags() {
    get_template_part('templates/single/post-tags');
  }
  add_action( 'haru_after_single_post_content', 'haru_post_tags', 10 );
}

/* 5. haru_after_single_post */
/* 5.1. Post navigation */
if (!function_exists('haru_post_nav')) {
  function haru_post_nav() {
    get_template_part( 'templates/single/post-nav' );
  }
  add_action( 'haru_after_single_post', 'haru_post_nav', 5 );
}

/* 5.2. Post Author */
if (!function_exists('haru_post_author')) {
  function haru_post_author() {
    get_template_part( 'templates/single/post-author' );
  }
  add_action( 'haru_after_single_post', 'haru_post_author', 10 );
}
/* 5.3. Post Related */
if (!function_exists('haru_post_related')) {
  function haru_post_related() {
    get_template_part( 'templates/single/post-related' );
  }
  add_action( 'haru_after_single_post', 'haru_post_related', 15 );
}

/* 6. haru_before_page */
/* 6.1. Page Heading */
if ( !function_exists( 'haru_page_heading' ) ) {
  function haru_page_heading() {
    get_template_part( 'templates/page-heading' );
  }
  add_action( 'haru_before_page', 'haru_page_heading', 5 );
}

/* 7. haru_footer_main */
if ( ! function_exists( 'haru_footer_block' ) ) {
  function haru_footer_block() {
    get_template_part( 'templates/footer', 'template' );
  }
  add_action( 'haru_footer_main',  'haru_footer_block', 5 );
}


/* 9. Render Comments */
if ( ! function_exists( 'haru_render_comments' ) ) {
  function haru_render_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
  ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
      <div id="comment-<?php comment_ID(); ?>" class="comment-body">
        <div class="author-avatar">
          <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <div class="comment-text">
          <div class="author">
            <div class="author-name"><?php printf( esc_html__( '%s', 'starter' ), get_comment_author_link() ) ?></div>
          </div>
          <div class="text">
            <?php comment_text(); ?>
            <?php if ( $comment->comment_approved == '0' ) : ?>
              <em><?php echo esc_html__( 'Your comment is awaiting moderation.', 'starter' ) ?></em>
            <?php endif; ?>
          </div>
          <div class="comment-meta">
            <div class="comment-meta-date">
              <span class="time">
                <?php echo get_comment_date(); ?>
              </span>
            </div>
            <div class="comment-meta-action">
              <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
              <?php edit_comment_link( esc_html__( 'Edit', 'starter' ), '', '' ); ?>
            </div>
          </div>
        </div>
      </div>
  <?php
  }
}

/* 13. Comments Form */
if ( ! function_exists('haru_comment_form') ) {
  function haru_comment_form( $args = array(), $post_id = null ) {
    global $id;

    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    if ( null === $post_id ) {
      $post_id = $id;
    } else {
      $id = $post_id;
    }

    if ( comments_open( $post_id ) ) :
  ?>
    <div id="respond-wrapper">
      <?php
        $commenter = wp_get_current_commenter();
        $req       = get_option( 'require_name_email' );
        $aria_req  = ( $req ? " aria-required='true'" : '' );

        $fields    =  array(
          'author'        => '<div class="haru-row haru-field-group"><div class="comment-form-author haru-field haru-col-sm-6 haru-col-xs-12"><input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Enter Your Name*', 'starter' ) . '" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
          'email'         => '<div class="comment-form-email haru-field haru-col-sm-6 haru-col-xs-12"><input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Enter Your Email*', 'starter' ) . '" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
          'comment_field' => '<div class="haru-row haru-field-group"><div class="haru-col-sm-12"><div class="comment-form-comment haru-field"><textarea class="form-control" placeholder="' . esc_attr__( 'Enter Your Comment', 'starter' ) . '" id="comment" name="comment" cols="40" rows="6" aria-required="true"></textarea></div></div></div>'
        );

        $comments_args = array(
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'logged_in_as'         => '<p class="logged-in-as">' .
            sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out?</a>', 'starter' ),
              admin_url( 'profile.php' ),
              $user_identity,
              wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
            ) . '</p>',
            'title_reply'          => esc_html__( 'Leave us a comment', 'starter' ),
            'title_reply_to'       => esc_html__( 'Leave a reply to %s', 'starter' ),
            'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title haru-heading haru-heading--style-1">',
            'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'starter' ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s haru-button haru-button--size-medium haru-button--bg-primary haru-button--round-normal" value="%4$s" />',
            'label_submit'         => esc_html__( 'Post Comment', 'starter' ),
            'comment_field'        => '',
            'must_log_in'          => ''
        );

        if ( is_user_logged_in() ) {
          $comments_args['comment_field'] = '<p class="comment-form-comment"><textarea class="form-control" placeholder="' . esc_attr__( 'Enter Your Comment', 'starter' ) . '" id="comment" name="comment" cols="40" rows="6" aria-required="true"></textarea></p>';
        }

        comment_form( $comments_args );
      ?>
    </div>

    <?php
    endif;
  }
}

// Remove the comment reply button from it's default location
if ( ! function_exists( 'haru_remove_comment_reply_link' ) ) {
  function haru_remove_comment_reply_link( $link ) {
    return '';
  }

  add_filter( 'cancel_comment_reply_link', 'haru_remove_comment_reply_link', 10 );
}


// Add the comment reply button to the end of the comment form.
// Remove the haru_remove_comment_reply_link filter first so that it will actually output something.
if ( ! function_exists( 'haru_after_comment_form' ) ) {
  function haru_after_comment_form( $post_id ) {
    remove_filter( 'cancel_comment_reply_link', 'haru_remove_comment_reply_link', 10 );
    cancel_comment_reply_link( esc_html__( 'Cancel Reply', 'starter' ) );
  }

  add_action( 'comment_form', 'haru_after_comment_form', 99 );
}

if ( ! function_exists( 'haru_get_cancel_comment_reply_link' ) ) {
  function haru_get_cancel_comment_reply_link( $text ) {
    if ( empty( $text ) ) {
      $text = __( 'Click here to cancel reply.' );
    }
   
    $style = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
    $link  = esc_html( remove_query_arg( array( 'replytocom', 'unapproved', 'moderation-hash' ) ) ) . '#respond';
   
    $formatted_link = '<a rel="nofollow" class="submit haru-button haru-button--size-medium haru-button--border-primary haru-button--round-normal" id="cancel-comment-reply-link" href="' . $link . '"' . $style . '>' . $text . '</a>';

    return $formatted_link;
  }
}


/* 14. Comments Time by ago */
if ( ! function_exists( 'haru_relative_time' ) ) {
  function haru_relative_time( $a = '' ) {
     return human_time_diff( $a, current_time( 'timestamp' ) );
  }
}
