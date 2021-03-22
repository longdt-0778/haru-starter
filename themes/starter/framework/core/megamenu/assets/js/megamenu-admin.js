/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

jQuery( function( $ ) { 
    var count = 1;

    $(document).on('click', '.haru-icon .select_icon', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var id    = $(this).data('id');
        var icons = $('.search-'+ id).val( $('#edit-menu-item-megamenu_icon-'+id).val() );
        var list  = [
            "icofont icofont-aids", "icofont icofont-ambulance", "icofont icofont-autism", "icofont icofont-bandage", "icofont icofont-blind", "icofont icofont-blood-drop", "icofont icofont-blood-test", "icofont icofont-capsule", "icofont icofont-crutches", "icofont icofont-dna", "icofont icofont-dna-alt-1", "icofont icofont-doctor-alt", "icofont icofont-drug", "icofont icofont-drug-pack", "icofont icofont-eye-alt", "icofont icofont-first-aid-alt", "icofont icofont-garbage", "icofont icofont-heart-alt", "icofont icofont-heartbeat", "icofont icofont-herbal", "icofont icofont-hospital", "icofont icofont-injection-syringe", "icofont icofont-medical-sign-alt", "icofont icofont-nurse", "icofont icofont-nurse-alt", "icofont icofont-nursing-home", "icofont icofont-operation-theater", "icofont icofont-paralysis-disability", "icofont icofont-prescription", "icofont icofont-stethoscope", "icofont icofont-stethoscope-alt", "icofont icofont-stretcher", "icofont icofont-surgeon", "icofont icofont-tablets", "icofont icofont-test-bottle", "icofont icofont-test-tube", "icofont icofont-thermometer-alt", "icofont icofont-xray", "icofont icofont-tooth", "icofont icofont-pulse", "icofont icofont-blood", "icofont icofont-medical-sign", "icofont icofont-pills", "icofont icofont-laboratory", "icofont icofont-icu", "icofont icofont-doctor", "icofont icofont-bed-patient",
            "fa-adjust", "fa-anchor", "fa-archive", "fa-area-chart", "fa-arrows", "fa-arrows-h", "fa-arrows-v", "fa-asterisk", "fa-at", "fa-automobile", "fa-balance-scale", "fa-ban", "fa-bank", "fa-bar-chart", "fa-bar-chart-o", "fa-barcode", "fa-bars", "fa-battery-0", "fa-battery-1", "fa-battery-2", "fa-battery-3", "fa-battery-4", "fa-battery-empty", "fa-battery-full", "fa-battery-half", "fa-battery-quarter", "fa-battery-three-quarters", "fa-bed", "fa-beer", "fa-bell", "fa-bell-o", "fa-bell-slash", "fa-bell-slash-o", "fa-bicycle", "fa-binoculars", "fa-birthday-cake", "fa-bolt", "fa-bomb", "fa-book", "fa-bookmark", "fa-bookmark-o", "fa-briefcase", "fa-bug", "fa-building", "fa-building-o", "fa-bullhorn", "fa-bullseye", "fa-bus", "fa-cab", "fa-calculator", "fa-calendar", "fa-calendar-check-o", "fa-calendar-minus-o", "fa-calendar-o", "fa-calendar-plus-o", "fa-calendar-times-o", "fa-camera", "fa-camera-retro", "fa-car", "fa-caret-square-o-down", "fa-caret-square-o-left", "fa-caret-square-o-right", "fa-caret-square-o-up", "fa-cart-arrow-down", "fa-cart-plus", "fa-cc", "fa-certificate", "fa-check", "fa-check-starter", "fa-check-starter-o", "fa-check-square", "fa-check-square-o", "fa-child", "fa-starter", "fa-starter-o", "fa-starter-o-notch", "fa-starter-thin", "fa-clock-o", "fa-clone", "fa-close", "fa-cloud", "fa-cloud-download", "fa-cloud-upload", "fa-code", "fa-code-fork", "fa-coffee", "fa-cog", "fa-cogs", "fa-comment", "fa-comment-o", "fa-commenting", "fa-commenting-o", "fa-comments", "fa-comments-o", "fa-compass", "fa-copyright", "fa-creative-commons", "fa-credit-card", "fa-crop", "fa-crosshairs", "fa-cube", "fa-cubes", "fa-cutlery", "fa-dashboard", "fa-database", "fa-desktop", "fa-diamond", "fa-dot-starter-o", "fa-download", "fa-edit", "fa-ellipsis-h", "fa-ellipsis-v", "fa-envelope", "fa-envelope-o", "fa-envelope-square", "fa-eraser", "fa-exchange", "fa-exclamation", "fa-exclamation-starter", "fa-exclamation-triangle", "fa-external-link", "fa-external-link-square", "fa-eye", "fa-eye-slash", "fa-eyedropper", "fa-fax", "fa-feed", "fa-female", "fa-fighter-jet", "fa-file-archive-o", "fa-file-audio-o", "fa-file-code-o", "fa-file-excel-o", "fa-file-image-o", "fa-file-movie-o", "fa-file-pdf-o", "fa-file-photo-o", "fa-file-picture-o", "fa-file-powerpoint-o", "fa-file-sound-o", "fa-file-video-o", "fa-file-word-o", "fa-file-zip-o", "fa-starter", "fa-filter", "fa-fire", "fa-fire-extinguisher", "fa-flag", "fa-flag-checkered", "fa-flag-o", "fa-flash", "fa-flask", "fa-folder", "fa-folder-o", "fa-folder-open", "fa-folder-open-o", "fa-frown-o", "fa-futbol-o", "fa-gamepad", "fa-gavel", "fa-gear", "fa-gears", "fa-gift", "fa-glass", "fa-globe", "fa-graduation-cap", "fa-group", "fa-hand-grab-o", "fa-hand-lizard-o", "fa-hand-paper-o", "fa-hand-peace-o", "fa-hand-pointer-o", "fa-hand-rock-o", "fa-hand-scissors-o", "fa-hand-spock-o", "fa-hand-stop-o", "fa-hdd-o", "fa-headphones", "fa-heart", "fa-heart-o", "fa-heartbeat", "fa-history", "fa-home", "fa-hotel", "fa-hourglass", "fa-hourglass-1", "fa-hourglass-2", "fa-hourglass-3", "fa-hourglass-end", "fa-hourglass-half", "fa-hourglass-o", "fa-hourglass-start", "fa-i-cursor", "fa-image", "fa-inbox", "fa-industry", "fa-info", "fa-info-starter", "fa-institution", "fa-key", "fa-keyboard-o", "fa-language", "fa-laptop", "fa-leaf", "fa-legal", "fa-lemon-o", "fa-level-down", "fa-level-up", "fa-life-bouy", "fa-life-buoy", "fa-life-ring", "fa-life-saver", "fa-lightbulb-o", "fa-line-chart", "fa-location-arrow", "fa-lock", "fa-magic", "fa-magnet", "fa-mail-forward", "fa-mail-reply", "fa-mail-reply-all", "fa-male", "fa-map", "fa-map-marker", "fa-map-o", "fa-map-pin", "fa-map-signs", "fa-meh-o", "fa-microphone", "fa-microphone-slash", "fa-minus", "fa-minus-starter", "fa-minus-square", "fa-minus-square-o", "fa-mobile", "fa-mobile-phone", "fa-money", "fa-moon-o", "fa-mortar-board", "fa-startercycle", "fa-mouse-pointer", "fa-music", "fa-navicon", "fa-newspaper-o", "fa-object-group", "fa-object-ungroup", "fa-paint-brush", "fa-paper-plane", "fa-paper-plane-o", "fa-paw", "fa-pencil", "fa-pencil-square", "fa-pencil-square-o", "fa-phone", "fa-phone-square", "fa-photo", "fa-picture-o", "fa-pie-chart", "fa-plane", "fa-plug", "fa-plus", "fa-plus-starter", "fa-plus-square", "fa-plus-square-o", "fa-power-off", "fa-print", "fa-puzzle-piece", "fa-qrcode", "fa-question", "fa-question-starter", "fa-quote-left", "fa-quote-right", "fa-random", "fa-recycle", "fa-refresh", "fa-registered", "fa-remove", "fa-reorder", "fa-reply", "fa-reply-all", "fa-retweet", "fa-road", "fa-rocket", "fa-rss", "fa-rss-square", "fa-search", "fa-search-minus", "fa-search-plus", "fa-send", "fa-send-o", "fa-server", "fa-share", "fa-share-alt", "fa-share-alt-square", "fa-share-square", "fa-share-square-o", "fa-shield", "fa-ship", "fa-shopping-cart", "fa-sign-in", "fa-sign-out", "fa-signal", "fa-sitemap", "fa-sliders", "fa-smile-o", "fa-soccer-ball-o", "fa-sort", "fa-sort-alpha-asc", "fa-sort-alpha-desc", "fa-sort-amount-asc", "fa-sort-amount-desc", "fa-sort-asc", "fa-sort-desc", "fa-sort-down", "fa-sort-numeric-asc", "fa-sort-numeric-desc", "fa-sort-up", "fa-space-shuttle", "fa-spinner", "fa-spoon", "fa-square", "fa-square-o", "fa-star", "fa-star-half", "fa-star-half-empty", "fa-star-half-full", "fa-star-half-o", "fa-star-o", "fa-sticky-note", "fa-sticky-note-o", "fa-street-view", "fa-suitcase", "fa-sun-o", "fa-support", "fa-tablet", "fa-tachometer", "fa-tag", "fa-tags", "fa-tasks", "fa-taxi", "fa-television", "fa-terminal", "fa-thumb-tack", "fa-thumbs-down", "fa-thumbs-o-down", "fa-thumbs-o-up", "fa-thumbs-up", "fa-ticket", "fa-times", "fa-times-starter", "fa-times-starter-o", "fa-tint", "fa-toggle-down", "fa-toggle-left", "fa-toggle-off", "fa-toggle-on", "fa-toggle-right", "fa-toggle-up", "fa-trademark", "fa-trash", "fa-trash-o", "fa-tree", "fa-trophy", "fa-truck", "fa-tty", "fa-tv", "fa-umbrella", "fa-university", "fa-unlock", "fa-unlock-alt", "fa-unsorted", "fa-upload", "fa-user", "fa-user-plus", "fa-user-secret", "fa-user-times", "fa-users", "fa-video-camera", "fa-volume-down", "fa-volume-off", "fa-volume-up", "fa-warning", "fa-wheelchair", "fa-wifi", "fa-wrench", "fa-hand-grab-o", "fa-hand-lizard-o", "fa-hand-o-down", "fa-hand-o-left", "fa-hand-o-right", "fa-hand-o-up", "fa-hand-paper-o", "fa-hand-peace-o", "fa-hand-pointer-o", "fa-hand-rock-o", "fa-hand-scissors-o", "fa-hand-spock-o", "fa-hand-stop-o", "fa-thumbs-down", "fa-thumbs-o-down", "fa-thumbs-o-up", "fa-thumbs-up", "fa-ambulance", "fa-automobile", "fa-bicycle", "fa-bus", "fa-cab", "fa-car", "fa-fighter-jet", "fa-startercycle", "fa-plane", "fa-rocket", "fa-ship", "fa-space-shuttle", "fa-subway", "fa-taxi", "fa-train", "fa-truck", "fa-wheelchair", "fa-genderless", "fa-intersex", "fa-mars", "fa-mars-double", "fa-mars-stroke", "fa-mars-stroke-h", "fa-mars-stroke-v", "fa-mercury", "fa-neuter", "fa-transgender", "fa-transgender-alt", "fa-venus", "fa-venus-double", "fa-venus-mars", "fa-file", "fa-file-archive-o", "fa-file-audio-o", "fa-file-code-o", "fa-file-excel-o", "fa-file-image-o", "fa-file-movie-o", "fa-file-o", "fa-file-pdf-o", "fa-file-photo-o", "fa-file-picture-o", "fa-file-powerpoint-o", "fa-file-sound-o", "fa-file-text", "fa-file-text-o", "fa-file-video-o", "fa-file-word-o", "fa-file-zip-o", "fa-starter-o-notch", "fa-cog", "fa-gear", "fa-refresh", "fa-spinner", "fa-check-square", "fa-check-square-o", "fa-starter", "fa-starter-o", "fa-dot-starter-o", "fa-minus-square", "fa-minus-square-o", "fa-plus-square", "fa-plus-square-o", "fa-square", "fa-square-o", "fa-cc-amex", "fa-cc-diners-club", "fa-cc-discover", "fa-cc-jcb", "fa-cc-mastercard", "fa-cc-paypal", "fa-cc-stripe", "fa-cc-visa", "fa-credit-card", "fa-google-wallet", "fa-paypal", "fa-area-chart", "fa-bar-chart", "fa-bar-chart-o", "fa-line-chart", "fa-pie-chart", "fa-bitcoin", "fa-btc", "fa-cny", "fa-dollar", "fa-eur", "fa-euro", "fa-gbp", "fa-gg", "fa-gg-starter", "fa-ils", "fa-inr", "fa-jpy", "fa-krw", "fa-money", "fa-rmb", "fa-rouble", "fa-rub", "fa-ruble", "fa-rupee", "fa-shekel", "fa-sheqel", "fa-try", "fa-turkish-lira", "fa-usd", "fa-won", "fa-yen", "fa-align-center", "fa-align-justify", "fa-align-left", "fa-align-right", "fa-bold", "fa-chain", "fa-chain-broken", "fa-clipboard", "fa-columns", "fa-copy", "fa-cut", "fa-dedent", "fa-eraser", "fa-file", "fa-file-o", "fa-file-text", "fa-file-text-o", "fa-files-o", "fa-floppy-o", "fa-font", "fa-header", "fa-indent", "fa-italic", "fa-link", "fa-list", "fa-list-alt", "fa-list-ol", "fa-list-ul", "fa-outdent", "fa-paperclip", "fa-paragraph", "fa-paste", "fa-repeat", "fa-rotate-left", "fa-rotate-right", "fa-save", "fa-scissors", "fa-strikethrough", "fa-subscript", "fa-superscript", "fa-table", "fa-text-height", "fa-text-width", "fa-th", "fa-th-large", "fa-th-list", "fa-underline", "fa-undo", "fa-unlink", "fa-angle-double-down", "fa-angle-double-left", "fa-angle-double-right", "fa-angle-double-up", "fa-angle-down", "fa-angle-left", "fa-angle-right", "fa-angle-up", "fa-arrow-starter-down", "fa-arrow-starter-left", "fa-arrow-starter-o-down", "fa-arrow-starter-o-left", "fa-arrow-starter-o-right", "fa-arrow-starter-o-up", "fa-arrow-starter-right", "fa-arrow-starter-up", "fa-arrow-down", "fa-arrow-left", "fa-arrow-right", "fa-arrow-up", "fa-arrows", "fa-arrows-alt", "fa-arrows-h", "fa-arrows-v", "fa-caret-down", "fa-caret-left", "fa-caret-right", "fa-caret-square-o-down", "fa-caret-square-o-left", "fa-caret-square-o-right", "fa-caret-square-o-up", "fa-caret-up", "fa-chevron-starter-down", "fa-chevron-starter-left", "fa-chevron-starter-right", "fa-chevron-starter-up", "fa-chevron-down", "fa-chevron-left", "fa-chevron-right", "fa-chevron-up", "fa-exchange", "fa-hand-o-down", "fa-hand-o-left", "fa-hand-o-right", "fa-hand-o-up", "fa-long-arrow-down", "fa-long-arrow-left", "fa-long-arrow-right", "fa-long-arrow-up", "fa-toggle-down", "fa-toggle-left", "fa-toggle-right", "fa-toggle-up", "fa-arrows-alt", "fa-backward", "fa-compress", "fa-eject", "fa-expand", "fa-fast-backward", "fa-fast-forward", "fa-forward", "fa-pause", "fa-play", "fa-play-starter", "fa-play-starter-o", "fa-random", "fa-step-backward", "fa-step-forward", "fa-stop", "fa-youtube-play", "fa-500px", "fa-adn", "fa-amazon", "fa-android", "fa-angellist", "fa-apple", "fa-behance", "fa-behance-square", "fa-bitbucket", "fa-bitbucket-square", "fa-bitcoin", "fa-black-tie", "fa-btc", "fa-buysellads", "fa-cc-amex", "fa-cc-diners-club", "fa-cc-discover", "fa-cc-jcb", "fa-cc-mastercard", "fa-cc-paypal", "fa-cc-stripe", "fa-cc-visa", "fa-chrome", "fa-codepen", "fa-connectdevelop", "fa-contao", "fa-css3", "fa-dashcube", "fa-delicious", "fa-deviantart", "fa-digg", "fa-dribbble", "fa-dropbox", "fa-drupal", "fa-empire", "fa-expeditedssl", "fa-facebook", "fa-facebook-f", "fa-facebook-official", "fa-facebook-square", "fa-firefox", "fa-flickr", "fa-fonticons", "fa-forumbee", "fa-foursquare", "fa-ge", "fa-get-pocket", "fa-gg", "fa-gg-starter", "fa-git", "fa-git-square", "fa-github", "fa-github-alt", "fa-github-square", "fa-gittip", "fa-google", "fa-google-plus", "fa-google-plus-square", "fa-google-wallet", "fa-gratipay", "fa-hacker-news", "fa-houzz", "fa-html5", "fa-instagram", "fa-internet-explorer", "fa-ioxhost", "fa-joomla", "fa-jsfiddle", "fa-lastfm", "fa-lastfm-square", "fa-leanpub", "fa-linkedin", "fa-linkedin-square", "fa-linux", "fa-maxcdn", "fa-meanpath", "fa-medium", "fa-odnoklassniki", "fa-odnoklassniki-square", "fa-opencart", "fa-openid", "fa-opera", "fa-optin-monster", "fa-pagelines", "fa-paypal", "fa-pied-piper", "fa-pied-piper-alt", "fa-pinterest", "fa-pinterest-p", "fa-pinterest-square", "fa-qq", "fa-ra", "fa-rebel", "fa-reddit", "fa-reddit-square", "fa-renren", "fa-safari", "fa-sellsy", "fa-share-alt", "fa-share-alt-square", "fa-shirtsinbulk", "fa-simplybuilt", "fa-skyatlas", "fa-skype", "fa-slack", "fa-slideshare", "fa-soundcloud", "fa-spotify", "fa-stack-exchange", "fa-stack-overflow", "fa-steam", "fa-steam-square", "fa-stumbleupon", "fa-stumbleupon-starter", "fa-tencent-weibo", "fa-trello", "fa-tripadvisor", "fa-tumblr", "fa-tumblr-square", "fa-twitch", "fa-twitter", "fa-twitter-square", "fa-viacoin", "fa-vimeo", "fa-vimeo-square", "fa-vine", "fa-vk", "fa-wechat", "fa-weibo", "fa-weixin", "fa-whatsapp", "fa-wikipedia-w", "fa-windows", "fa-wordpress", "fa-xing", "fa-xing-square", "fa-y-combinator", "fa-y-combinator-square", "fa-yahoo", "fa-yc", "fa-yc-square", "fa-yelp", "fa-youtube", "fa-youtube-play", "fa-youtube-square",
        ];
        var content = '';
        $.each(list, function(i, icon) {
            content += "<span data-tooltip=\""+ icon +"\"><i data-icon=\"" + icon + "\" class=\"fa " + icon + "\"></i></span>";
        });

        $('.list-entry-'+ id).show('fast');
        $('.list-entry-'+ id + ' .mega-list-icon').html(content);
        $('.color-'+ id).hide();
        
        if ( count % 2 === 0 ) {
            $('.list-entry-'+ id).hide('fast');
        } else {
            $('.list-entry-'+ id).show('fast');
        }
        
        var curent_icon = $('#edit-menu-item-megamenu_icon-' + id);
        
        if ( curent_icon.val() != '' ) $('.list-entry-'+ id + ' .'+ curent_icon.val()).css('background', '#E7DEDE');

        $('.list-entry-' + id).on('click', 'span i', function(event) {
            event.preventDefault();
            var icon = $(this).data('icon');
            $('.list-entry-' + id + ' span i').css('background', 'transparent');
            $(this).css('background', '#E7DEDE');
            curent_icon.val( icon );
            $('.icon-' + id).html( "<i class=\"fa " + icon + "\"></i>" ).show('fast');
            $('.search-'+ id).val(icon);
        });

        // Live search icon
        $('.search-'+ id).keyup(function(event) {

            $('.list-entry-'+ id + ' .mega-list-icon').html();
            var content_live = '';
            var search_icon = this.value;

            if ( search_icon == '' ) {

                $('.mega-entry i').css('background', 'transparent');
                $('.icon-' + id).html('').hide('fast');
                $('.search-'+ id).val('');
                $('#edit-menu-item-megamenu_icon-'+ id).val('');

            }

            $.each(list, function(i, icon){
                if (icon.indexOf(search_icon) !== -1) {
                    content_live += "<span data-tooltip=\""+ icon +"\"><i data-icon=\"" + icon + "\" class=\"fa " + icon + "\"></i></span>";
                    // console.log('found in array '+i, icon);
                }
            });
            $('.list-entry-'+ id + ' .mega-list-icon').html(content_live);
        });

        count++;

    });
    
    // Select sub label color
    $(document).ready(function() {
        var sub_label_ids = [];

        $('.haru-icon .select_color').each(function(){
            var sub_label_id = $(this).data('id');
            sub_label_ids.push(sub_label_id);
        })
    
        // Select color picker
        for(var i = 0; i < sub_label_ids.length; i++) {
            $('.sub-label-color-picker-'+ sub_label_ids[i]).wpColorPicker({
                change: function(event, ui) {
                    $( '.icon-' + sub_label_ids[i] ).css('color', ui.color.toCSS());
                }
            }); 
        }
        // Init select image for menu
        megamenu_media_init('.media-input', '.media-button');
    });

    $(document).on('click', '.haru-icon .select_color', function(event) {
        event.stopPropagation();
        event.preventDefault();
        
        var id = $(this).data('id');

        $('.list-entry-'+ id).hide();
        $('.color-'+ id).show('fast');

        if ( count % 2 === 0 ) {
            $('.color-'+ id).hide('fast');
        } else { 
            $('.color-'+ id).show('fast');
        }

        // Select color picker
        $('.color-picker-'+ id).wpColorPicker({
            change: function(event, ui) {
                $( '.icon-' + id ).css('color', ui.color.toCSS());
            }
        });

        // Get font size
        $('#edit-menu-item-megamenu_icon_size-'+ id).change(function(event) {
            var size = $(this).val() + 'px';
            $( '.icon-' + id ).css('font-size', size);
        });
        
        count++;

    });

    $(".enable_megamenu").change(function() {
        var id = $(this).data('id');
        if(this.checked) {
            $('.enable_megamenu_child-'+ id).show('fast');
        } else {
            $('.enable_megamenu_child-'+ id).hide('fast');
        }
    });

});