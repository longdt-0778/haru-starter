<?php
/** 
 * @package    HaruTheme/Haru Starter
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

use \Elementor\Icons_Manager;

if ( $settings['list'] ) : ?>
	<ul>
		<?php
			foreach (  $settings['list'] as $item ) : 
			$target = $item['list_content']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['list_content']['nofollow'] ? ' rel="nofollow"' : '';
		?>
			<li>
				<a href="<?php echo $item['list_content']['url']; ?>" <?php echo $target . $nofollow; ?>>
					<div class="haru-social__icon"><?php Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
					<div class="haru-social__title"><?php echo $item['list_title']; ?></div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
