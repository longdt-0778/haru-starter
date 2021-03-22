<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

//Add class header customize
$header_elements_class = array('header-elements header-elements-right');

//Check option add to header customize
$enable_header_elements = get_post_meta( get_the_ID(), 'haru_' . 'enable_header_elements_right', false ); // true/false
$header_elements = array();
if ( is_array($enable_header_elements) && !empty($enable_header_elements) ) {
    $enable_header_elements = $enable_header_elements[0];
}

if ( $enable_header_elements == '1' ) {
    $page_header_elements = get_post_meta( get_the_ID(), 'haru_' . 'header_elements_right', true );
    if ( isset($page_header_elements['enable']) && !empty($page_header_elements['enable']) ) {
        $header_elements = explode('||', $page_header_elements['enable']);
    }
} else { // use in theme options
    if ( haru_get_option('haru-option-header-elements-right') == '1' ) {
        $enable_header_elements = true;
        $header_elements_right = haru_get_option('haru_header_elements_right');
        if ( isset($header_elements_right) && isset($header_elements_right['enabled']) && is_array($header_elements_right['enabled']) ) {
            foreach ( $header_elements_right['enabled'] as $key => $value ) {
                $header_elements[] = $key;
            }
        }
    } else {
        return;
    }
}

?>
<?php if ( $enable_header_elements == '1' ) : ?>
    <?php if (count($header_elements) > 0) : ?>
    <div class="<?php echo esc_attr( join(' ', $header_elements_class) ); ?>">
        <?php foreach ( $header_elements as $key ) {
            switch ( $key ) {
                case 'video-search-box':
                    get_template_part('templates/header/header-elements/video-search-box');
                    break;
                case 'video-search-button':
                    get_template_part('templates/header/header-elements/video-search-button');
                    break;
                case 'video-user-menu':
                    get_template_part('templates/header/header-elements/video-user-menu');
                    break;
                case 'video-watch-later':
                    get_template_part('templates/header/header-elements/video-watch-later');
                    break;
                case 'mini-cart':
                    if (class_exists( 'WooCommerce' )) {
                        get_template_part('templates/header/header-elements/mini-cart');
                    }
                    break;
                case 'social-network':
                    get_template_part('templates/header/header-elements/social-network', 'right');
                    break;
                case 'custom-text':
                    get_template_part('templates/header/header-elements/custom-text', 'right');
                    break;
                case 'canvas-sidebar':
                    get_template_part('templates/header/header-elements/canvas-sidebar');
                    break;
            }
        } 
        ?>
    </div>
    <?php endif; ?>
<?php endif; ?>