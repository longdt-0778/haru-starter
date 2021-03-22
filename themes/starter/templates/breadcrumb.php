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
<?php
	// https://faish.al/2014/01/06/check-if-it-is-woocommerce-page/
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$args = array(
			'delimiter' => '<span class="delimiter"></span>',
			'wrap_before' => '<div class="haru-breadcrumb">',
			'wrap_after' => '</div>',
			'before' => '<span class="current">',
			'after' => '</span>',
			'home' => esc_html__( 'Home', 'starter' ),
		);

		echo woocommerce_breadcrumb( $args );
	} else {
		echo haru_get_breadcrumbs();
	}
?>