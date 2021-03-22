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
<div class="header-elements-item">
	<?php
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	    if ( class_exists( 'Haru_Vidi' ) ) {
	    	echo do_shortcode( '[haru_video_search layout="button"]'); 
	    }
    ?>
</div>