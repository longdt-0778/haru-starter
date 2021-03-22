/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
 */

(function($){
    "use strict";
    var HaruAdmin = {
        initialize: function() {
            HaruAdmin.addCustomSidebar();
            HaruAdmin.cmb2_box_show_hide();
            HaruAdmin.widget_select2_process();
        },
        addCustomSidebar: function() {
            var add_sidebar_form = $('#haru-form-add-sidebar');

            if ( add_sidebar_form.length > 0 ) {
                var add_sidebar_form_new = add_sidebar_form.clone();

                add_sidebar_form.remove();
                $('#widgets-right').append('<div class="wp-clearfix"></div>');
                add_sidebar_form = $('#widgets-right').append(add_sidebar_form_new);
                
                $('#haru-add-sidebar').on('click', function(e) {
                    e.preventDefault();
                    var sidebar_name = $.trim( $(this).siblings('#sidebar_name').val() );
                    if ( sidebar_name != '' ) {
                        $(this).attr('disabled', true);
                        var data = {
                            action: 'haru_add_custom_sidebar',
                            sidebar_name: sidebar_name
                        };
                        
                        $.ajax({
                            type : 'POST',
                            url : ajaxurl,
                            data : data,
                            success : function(response) {
                                window.location.reload(true);
                            }
                        });
                    }
                });
            }
            
            if ( $('.sidebar-haru-custom-sidebar').length > 0 ) {
                var delete_button = '<span class="delete-sidebar dashicons-before dashicons-trash"></span>';
                $('.sidebar-haru-custom-sidebar .sidebar-name').prepend(delete_button);
                
                $('.sidebar-haru-custom-sidebar .delete-sidebar').on('click', function() {
                    var sidebar_name = $(this).parent().find('h2').text();
                    var widget_block = $(this).parents('.widgets-holder-wrap');
                    var ok = confirm('Do you want to delete this sidebar?');
                    if ( ok ) {
                        widget_block.hide();
                        var data = {
                            action: 'haru_delete_custom_sidebar',
                            sidebar_name: sidebar_name
                        };
                        
                        $.ajax({
                            type : 'POST',
                            url : ajaxurl,
                            data : data,
                            success : function(response) {
                                if ( response != '' ) {
                                    widget_block.remove();
                                } else {
                                    widget_block.show();
                                    alert('Cant delete the sidebar. Please try again!');
                                }
                            }
                        });
                    }
                });
            }
        },
        cmb2_box_show_hide: function() {
            var prefix  = 'haru_';

            // Classic Editor
            if ( $('#post').length > 0 ) {
                var cmb2_post_format = $('[id^="'+ prefix +'post_metabox_"]').hide();

                setTimeout(function(){
                    var current_format = $("#post-formats-select").find('input[type=radio]:checked').val();

                    if ( current_format != 'standard' ) {
                        $('#' + prefix +  'post_metabox_' + current_format).show();
                    }

                    $("#post-formats-select").find('input[type=radio]').on('change', function() {
                        var new_format = $(this).val();

                        cmb2_post_format.hide();
                        $('#' + prefix +  'post_metabox_' + new_format).show();
                    })
                }, 100);
            } else {
                // Gutenberg
                var cmb2_post_format = $('[id^="'+ prefix +'post_metabox_"]').hide();

                setTimeout(function(){
                    if ( $('.editor-post-format').find('select').val() != 'standard' ) {
                        var current_format = $('.editor-post-format').find('select').val();
                        $('#' + prefix +  'post_metabox_' + current_format).show();
                    }

                    $('.editor-post-format').find('select').on('change', function() {
                        var new_format = $(this).val();
                        console.log(new_format);
                        cmb2_post_format.hide();
                        $('#' + prefix +  'post_metabox_' + new_format).show();
                    })
                }, 100);
            }
        },
        widget_select2: function(event, widget) {
            if ( typeof (widget) == "undefined" ) {
                $('#widgets-right select.widget-select2:not(.select2-ready)').each(function(){
                    HaruAdmin.widget_select2_item(this);
                });
            } else {
                $('select.widget-select2:not(.select2-ready)', widget).each(function(){
                    HaruAdmin.widget_select2_item(this);
                });
            }
        },
        widget_select2_item: function(target){
            $(target).addClass('select2-ready'); // select2-ready 

            var data_value = $(target).attr('data-value');

            var choices = [];

            if ( data_value != '' ) {
                var arr_data_value = data_value.split('||');

                for ( var i = 0; i < arr_data_value.length; i++ ) {
                    var option = $('option[value='+ arr_data_value[i]  + ']', target);
                    choices[i] = { 'id':arr_data_value[i], 'text':option.text()};

                    $('option[value='+ arr_data_value[i]  + ']', target).prop("selected","selected");
                }

            }

            $(target).select2({
                'data': choices
            });

            $(target).on("select2:select", function(e) { // select2-selecting 
                var ids = $('input',$(this).parent()).val();
                if ( ids != "" ) {
                    ids +="||";
                }
                ids += e.params.data.id;
                $('input',$(this).parent()).val(ids);
            }).on("select2:unselect", function(e) { // select2-removed
                var ids = $('input',$(this).parent()).val();
                var arr_ids = ids.split("||");
                var newIds = "";
                for(var i = 0 ; i < arr_ids.length; i++) {
                    if (arr_ids[i] != e.params.data.id){
                        if (newIds != "") {
                            newIds += "||";
                        }
                        newIds += arr_ids[i];
                    }
                }
                $('input',$(this).parent()).val(newIds);
            });
        },
        widget_select2_process: function() {
            $(document).on('widget-added', HaruAdmin.widget_select2);
            $(document).on('widget-updated', HaruAdmin.widget_select2);
            HaruAdmin.widget_select2();
        }
    };

    $(document).ready(function(){
        HaruAdmin.initialize();
    });
    
})(jQuery);