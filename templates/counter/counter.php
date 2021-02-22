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
		<?php foreach (  $settings['list'] as $item ) : ?>
			<li>
				<?php if ( $item['list_icon'] ) : ?>
					<div class="haru-counter__icon"><?php Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
				<?php endif; ?>
				<div class="haru-counter__number-wrap gr-animated">
					<div class="haru-counter__number gr-number-counter" data-from="0" data-to="<?php echo esc_attr( $item['list_number'] ); ?>"><?php echo $item['list_number']; ?></div>
					<div class="haru-counter__label"><?php echo $item['list_label']; ?></div>
				</div>
				<div class="haru-counter__title"><?php echo $item['list_title']; ?></div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
