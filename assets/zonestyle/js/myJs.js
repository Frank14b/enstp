$(document).ready(function(){
    $.fn.zsForm = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    //"refreshTile": "1000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $_this = $(this);
            var $that = $_this.find('.zs_input').attr('placeholder', '');
            var $_that = $_this.find('.file');
            $_that.parent().append('<input type="text" class="zs_input input_file" readonly placeholder="" style="display:none;"/>');
            $that.on('focus', function () {
                $(this).parent().addClass('is_focus');
            });
            $that.on('blur', function () {
                if ($(this).val() == "") {
                    $(this).parent().removeClass('is_focus');
                }
                ;
            });
            $_that.next('.zs_file').on('change', function () {
                var files = $(this)[0].files;
                if (files.length == 0) {
                    $(this).parent().removeClass('is_focus');
                    $(this).parent().children('.input_file').fadeOut();
                } else if (files.length == 1) {
                    $(this).parent().addClass('is_focus');
                    $(this).parent().children('.input_file').fadeIn();
                    var Filename = $(this).val().split('\\').pop();
                    $(this).parent().children('.input_file').attr("placeholder", Filename);
                } else {
                    $(this).parent().addClass('is_focus');
                    $(this).parent().children('.input_file').fadeIn();
                    $(this).parent().children('.input_file').attr("placeholder", files.length + ' Fichiers a uploader');
                }
            });
            $_this.find('.zs_checkbox').attr('', function () {
                $(this).after('<span class="zs_check"></span>');
            });
            $_this.find('.zs_radio').attr('', function () {
                $(this).after('<span class="zs_check"></span>');
            });
            $_this.find('.switch').attr('', function () {
                $(this).after('<span class="zs_switch"><span class="switch_yes">Yes</span><span class="switch_contenaire"></span><span class="switch_control"><a><i class="icone icon_check"></i><i class="icone icon_close"></i></a></span><span class="switch_no">No</span></span>')
                $(this).parent().find('.zs_check').hide();
            });
        });
    };

    $.fn.zsModale = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "position": "180",
                    "refreshTile": "1000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            $this.after('<div class="modale_cover scroll scroll_bleu"></div>');
            $("[data-modale]").on('click', function (e) {
                //alert($(this).data('target'));
                $('#' + $(this).data('target')).next('.modale_cover').fadeIn(500);
                $('#' + $(this).data('target')).fadeIn();
                $('#' + $(this).data('target')).css({'transform': 'scale(1)'})
            });
            $('.modale_cover').on('click', function () {
                $(this).prev('.zs_modale').css({'transform': 'scale(0.1)'});
                $(this).prev('.zs_modale').fadeOut();
                $(this).fadeOut();
            });

            $this.find('.fermer_modale').on('click', function () {
                $this.css({'transform': 'scale(0.1)'});
                $this.fadeOut();
                $this.next('.modale_cover').fadeOut();
            });
        });
    };
    
});