<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
?>

<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" class="haru-banner__image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
<?php if ( 'style-1' == $settings['pre_style'] ) : ?>
<a class="haru-banner__btn haru-button haru-button--bg-black haru-button--size-large haru-button--round-large" href="<?php echo $settings['link']['url']; ?>" <?php echo $target . $nofollow; ?>><?php echo $settings['button_text']; ?>
	<span class="haru-button__icon"><i class="haru-icon haru-arrow-right"></i></span>
</a>
<?php endif; ?>

