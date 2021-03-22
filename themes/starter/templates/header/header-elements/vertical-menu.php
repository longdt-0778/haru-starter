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
<div class="header-elements-item vertical-menu-wrap">
    <a class="vertical-menu-toggle" href="javascript:;"><i class="fa fa-list"></i><?php echo esc_html__('Categories', 'starter'); ?></a>
    <?php if (has_nav_menu('vertical')) : ?>
        <div id="vertical-menu-wrap" class="menu-wrap" data-items-show="8">
            <?php
                $arg_menu = array(
                    'menu_id'        => 'vertical-menu',
                    'container'      => '',
                    'theme_location' => 'vertical',
                    'menu_class'     => 'haru-vertical-menu nav-collapse navbar-nav vertical-megamenu',
                    'fallback_cb'    => 'haru_please_set_menu',
                    'walker'         => new HARU_MegaMenu_Walker()
                );
                wp_nav_menu( $arg_menu );
            ?>
            <div class="menu-item-toggle">
                <a href="javascript:;" class="vertical-view-cate" data-open-text="<?php echo esc_attr__( 'View More', 'starter' ); ?>" data-close-text="<?php echo esc_attr__( 'Close', 'starter' ); ?>"><?php echo esc_html__( 'View More', 'starter' ); ?></a>
            </div>
        </div>
    <?php endif; ?>
</div>