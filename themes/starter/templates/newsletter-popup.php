<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
$popup_width      = haru_get_option('haru_popup_width');
$popup_width      = ( isset($popup_width) ) ? haru_get_option('haru_popup_width') : 700;
$popup_height     = haru_get_option('haru_popup_height');
$popup_height     = ( isset($popup_height) ) ? haru_get_option('haru_popup_height') : 350;
$popup_effect     = haru_get_option('haru_popup_effect');
$popup_effect     = ( isset($popup_effect) ) ? haru_get_option('haru_popup_effect') : 'mfp-zoom-in';
$popup_delay      = haru_get_option('haru_popup_delay');
$popup_delay      = ( isset($popup_delay) ) ? haru_get_option('haru_popup_delay') : '2000';
$popup_background = haru_get_option('haru_popup_background');
if ( $popup_background ) {
    $popup_background = ( isset($popup_background) ) ? $popup_background['url'] : '';
} else {
    $popup_background = '';
}
$popup_content    = haru_get_option('haru_popup_content');

?>
<?php if ( haru_get_option('haru_show_popup') != false ) : ?>
    <!-- Display newsletter popup -->
    <div class="haru_popup_link hide"><a class="haru-popup open-click" href="#haru-popup" data-effect="<?php echo esc_attr( $popup_effect ); ?>" data-delay="<?php echo esc_attr( $popup_delay ); ?>"><?php echo esc_html__( 'Newsletter', 'starter' ); ?></a></div>
    <div id="haru-popup" data-effect="mfp-zoom-in" style="width: <?php echo esc_attr( $popup_width ).'px'; ?>; height: <?php echo esc_attr( $popup_height ) . 'px'; ?>;" 
    class="white-popup-block mfp-hide mfp-with-anim">
        <div class="popup-left" style="background: url('<?php echo esc_url( $popup_background ); ?>');">

        </div>
        <div class="popup-right">
            <div class="popup-right-content">
                <?php echo ( isset($popup_content) ) ? do_shortcode($popup_content) : ''; ?>
                <p class="checkbox-label">
                    <input type="checkbox" value="do-not-show" name="showagain" id="showagain" class="showagain" />
                    <label for="showagain"><?php echo esc_html__( "Don't show this popup again", 'starter' ); ?></label>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>