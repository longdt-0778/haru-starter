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

<?php if ( $settings['list'] ) : ?>
	<?php if ( 'style-1' == $settings['pre_style'] ) : ?>
	<ul class="haru-slick" data-slick='{"slidesToShow" : <?php echo esc_attr( $settings['slidesToShow'] ); ?>, "slidesToScroll" : <?php echo esc_attr( $settings['slidesToScroll'] ); ?>, "arrows" : <?php echo esc_attr( ( 'yes' == $settings['arrows'] ) ? 'true' : 'false' ); ?>, "infinite" : false, "centerMode" : false, "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint" : 991,"settings" : {"slidesToShow" : <?php echo esc_attr( $settings['slidesToShow_tablet'] ); ?>, "slidesToScroll" : <?php echo esc_attr( $settings['slidesToScroll_tablet'] ); ?>}}, {"breakpoint" : 767,"settings" : {"slidesToShow" : <?php echo esc_attr( $settings['slidesToShow_mobile'] ); ?>, "slidesToScroll" : <?php echo esc_attr( $settings['slidesToScroll_mobile'] ); ?>}}] }'>
		<?php 
			foreach (  $settings['list'] as $item ) :
			$target = $item['list_content']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['list_content']['nofollow'] ? ' rel="nofollow"' : '';
		?>
			<li class="haru-images-gallery__item">
				<img src="<?php echo esc_url( $item['list_image']['url'] ); ?>" class="haru-images-gallery__image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<div class="haru-images-gallery__content">
					<div class="haru-images-gallery__sub-title"><?php echo $item['list_sub_title']; ?></div>
					<h6 class="haru-images-gallery__title"><?php echo $item['list_title']; ?></h6>
					<div class="haru-images-gallery__description"><?php echo $item['list_description']; ?></div>
					<?php if ( $item['list_content']['url'] ) : ?>
					<a href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?> class="haru-button haru-button--text haru-button--text-primary"><?php echo $item['list_btn_text']; ?><i class="haru-icon haru-arrow-right"></i></a>
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

<?php endif; ?>
