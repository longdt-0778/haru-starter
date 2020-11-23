/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

var HARUSTARTER = HARUSTARTER || {};

(function ($) {
	// Base functions
    HARUSTARTER.base = {
    	init: function() {
            HARUSTARTER.base.elementorAccordion();
        },
        elementorAccordion: function() {
        	alert('test');
        	var delay = 10; 

        	setTimeout( function() { 
				$('.elementor-tab-title').removeClass( 'elementor-active' );
			 	$('.elementor-tab-content').css( 'display', 'none' ); 
			}, delay );
        }
    }

    // Document ready
    HARUSTARTER.onReady = {
        init: function () {
            HARU.base.init();
        }
    };

    $(document).ready( HARUSTARTER.onReady.init );
})(jQuery);
