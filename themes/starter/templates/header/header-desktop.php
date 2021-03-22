<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_class = array( 'haru-header haru-header--main', 'haru-header--desktop' );
$header_transparent = get_post_meta( get_the_ID(), 'haru_header_transparent', true );
if ( ( $header_transparent == '' ) || ( $header_transparent == 'default' ) ) {
    $header_transparent = haru_get_option( 'haru_header_transparent', '0' );
}

if ( $header_transparent == '1' ) {
    $header_class[] = 'haru-header--transparent';
}

$header_sticky = get_post_meta( get_the_ID(), 'haru_header_sticky', true );
if ( ( $header_sticky == '' ) || ( $header_sticky == 'default' ) ) {
    $header_sticky = haru_get_option( 'haru_header_sticky', '0' );
}

if ( $header_sticky == '1' ) {
    $header_class[] = 'haru-header--sticky';
}

$header_sticky_element = get_post_meta( get_the_ID(), 'haru_header_sticky_element', true );
if ( ( $header_sticky_element == '' ) || ( $header_sticky_element == 'default' ) ) {
    $header_sticky_element = haru_get_option( 'haru_header_sticky_element', 'header' );
}

if ( $header_sticky == '1' ) {
    $header_class[] = 'haru-header--sticky-' . $header_sticky_element;
}

?>
<header id="haru-header" class="<?php echo esc_attr( join( ' ', $header_class ) ); ?>">
    <div class="haru-header__desktop">
        <?php
            $header_id = apply_filters( 'haru_get_header_layout', haru_get_header_layout() );
            haru_render_header_layout( $header_id );
        ?>
    </div>
</header>