<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
	<img src="<?php echo esc_url( $settings['logo']['url'] ); ?>" class="haru-logo__default" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" style="max-height: <?php echo esc_attr( $settings['max_height'] ); ?>px;">
	<img src="<?php echo esc_url( $settings['logo_retina']['url'] ); ?>" class="haru-logo__retina" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" style="max-height: <?php echo esc_attr( $settings['max_height'] ); ?>px;">
</a>
