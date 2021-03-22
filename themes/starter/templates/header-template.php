<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, harutheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$haru_header_layout = haru_get_header_layout();

// Show Header
$header_show_hide = '1'; // Always show header (can add option in metabox to hide header on special page)
$search_box_type  = haru_get_option('haru_search_box_type');
?>
<?php if ( $header_show_hide == '1' ) : ?>
    <?php get_template_part( 'templates/header/', 'header-mobile' ); ?>
    <?php
    	if ( $haru_header_layout ) :
    		get_template_part( 'templates/header/' . 'header-desktop' );
		else :
			get_template_part( 'templates/header/' . 'header-default' );
		endif;
    ?>
    <?php if ( isset( $search_box_type ) ) : ?>
        <?php get_template_part( 'templates/header/header-elements/search', 'popup' ); ?>
    <?php endif; ?>
<?php endif; ?>