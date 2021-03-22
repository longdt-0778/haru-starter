<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
?>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
  <div class="content-none">
    <p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'starter' ), 'post' ), admin_url('post-new.php')); ?></p>
  </div>
<?php elseif (is_search()) : ?>
  <div class="content-none">
    <p class="search-not-found"><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'starter' ); ?></p>
    <?php get_search_form(); ?>
  </div>
<?php else: ?>
  <div class="content-none">
    <p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'starter' ); ?></p>
    <?php get_search_form(); ?>
  </div>
<?php endif; ?>
