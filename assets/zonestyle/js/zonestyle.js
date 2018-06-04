/* 
 Created on : 7 mars 2017, 00:37:21
 Author     : Frank Donald Fontcha
 */

(function ($) {
    $.fn.navigationHover = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "position": "180",
                    "refreshTile": "1000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $_this = $(this);
            setInterval(function () {
                var posScroll = $(document).scrollTop();
                if (posScroll > data.position) {
                    $_this.css({'box-shadow': '0 12px 17px 0 rgba(0,0,0,.16),0 12px 20px 0 rgba(0,0,0,.12)'});
                } else {
                    $_this.css({'box-shadow': '0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)'});
                }

            }, data.refreshTime);
        });
    };
    $('.barre_navigation').navigationHover();

    $.fn.zsUpload = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "position": "180",
                    "time": "3400",
                    "refreshTile": "1000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $_this = $(this);
            $_this.append('<div class="upload_preview">Upload File !</div>');

            $_this.find('.image').change(function () {
                var $this = $(this);
                var ext = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), ext) === -1) {
                    $_this.children('.upload_preview').fadeIn();
                    $_this.children('.upload_preview').text('Erreur: Format non Valide image requise');
                    $_this.css({"border": "1px solid #B35E60"});
                    $_this.children('.upload_preview').css({"background": "red", "color": "#fff"});
                    var $this = $(this);
                    setTimeout(function () {
                        $_this.children('.upload_preview').fadeOut();
                    }, data.time);
                    $this.addClass('erreur');
                } else {
                    $_this.children('.upload_preview').fadeIn();
                    $_this.css({"border": "0px solid green"});
                    $_this.children('.upload_preview').css({"background": "#fff"});
                    $_this.children('.upload_preview').html('<img src="" class="image_fluid preview"/>');
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $_this.children('.upload_preview').children(".preview").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                    $this.removeClass('erreur');
                }
            });
        });
    };
    $('.zs_upload').zsUpload();

    $.fn.alertModal = function (options)
    {
        var defauts =
                {
                    "vitesse": "100",
                    "refreshTime": "3000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $_this = $(this);
            $_this.on('click', function (e) {
                e.preventDefault();
                var $this = $(this);

                $('#' + $(this).data('target')).fadeIn(data.vitesse);
                $('#' + $(this).data('target')).css({'transform': 'scale(1)'});

                setTimeout(function () {
                    $('#' + $this.data('target')).css({'transform': 'scale(0.2)'});
                    $('#' + $this.data('target')).fadeOut();
                }, data.refreshTime);
            });
        });
    };
    $('[data-alert]').alertModal();

    $.fn.navSearch = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "position": "180",
                    "refreshTile": "1000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $that = $(this);
            $(this).before('<div class="navSearch_cover"></div>');
            $that.find('.zs_input').on('focus', function () {
                $that.addClass('is_hover');
                $('.navSearch_cover').fadeIn(300);
            });
            $that.find('.zs_input').on('blur', function () {
                if ($(this).val() == "") {
                    $that.removeClass('is_hover');
                    $('.navSearch_cover').fadeOut();
                }
                ;
            });
        });
    };
    $('.zs_search').navSearch();

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
    $('.zs_form').zsForm();
    $.fn.zsSlider = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "refreshTile": "1000",
                    "time": "7000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            setInterval(function () {
                var winWidth = $(document).width();
                var items = $this.find('.element_slider').length;
                $this.children('.contenu_slider').css({'width': 'calc(' + winWidth + 'px * ' + items + ')', 'position': 'relative'});
                $this.find('.image_slider').css({'width': winWidth + 'px', 'position': 'relative'});
                var hauteur = $this.find('.image_slider').height();
                $this.find('.texte_slider').css({'text-align': 'center', 'width': winWidth + 'px', 'position': 'absolute', 'height': hauteur + 'px', 'bottom': '0', 'top': '0', 'right': '0', 'z-index': '9999'});
            }, data.refreshTime);

            /*setInterval(function() {
             $this.find('.actif_slider').attr('', function() {
             var width = $('.image_slider').width();
             var $suivant = $(this).next('.element_slider').attr('id');
             if ($suivant === undefined) {
             $this.children('.contenu_slider').css({"left": "0"}, 300);
             $(this).removeClass('actif_slider');
             $('.element_slider:first-child').addClass('actif_slider');
             $this.find('.option_actif').attr('', function() {
             $('.option_item:first-child').addClass('option_actif');
             $(this).removeClass('option_actif');
             });
             } else {
             $(this).next('.element_slider').addClass('actif_slider');
             $(this).removeClass('actif_slider');
             $this.children('.contenu_slider').animate({"left": "-=" + width}, 600);
             $this.find('.option_actif').attr('', function() {
             $(this).next('.option_item').addClass('option_actif');
             $(this).removeClass('option_actif');
             });
             }
             });
             }, data.time);*/

            $this.find('.progression').attr('', function () {
                var $that = $(this);
                $that.append('<div class="etat animer" style="animation: animer ' + (data.time / 1000) + 's linear infinite"></div>')
            });

            $this.find('.control_avant').on('click', function () {
                $this.find('.actif_slider').attr('', function () {
                    var width = $('.image_slider').width();
                    var $suivant = $(this).next('.element_slider').attr('id');
                    if ($suivant === undefined) {
                        $this.children('.contenu_slider').animate({"left": "0"}, 600);
                        $(this).removeClass('actif_slider');
                        $('.element_slider:first-child').addClass('actif_slider');
                        $this.find('.option_actif').attr('', function () {
                            $('.option_item:first-child').addClass('option_actif');
                            $(this).removeClass('option_actif');
                        });
                    } else {
                        $(this).next('.element_slider').addClass('actif_slider');
                        $(this).removeClass('actif_slider');
                        $this.children('.contenu_slider').animate({"left": "-=" + width}, 600);
                        $this.find('.option_actif').attr('', function () {
                            $(this).next('.option_item').addClass('option_actif');
                            $(this).removeClass('option_actif');
                        });
                    }
                });
            });
            $this.find('.control_arriere').on('click', function () {
                var items = $this.find('.element_slider').length;
                $this.find('.actif_slider').attr('', function () {
                    var width = $('.image_slider').width();
                    var $suivant = $(this).prev('.element_slider').attr('id');
                    if ($suivant === undefined) {
                        $this.children('.contenu_slider').animate({"left": "-=" + width * (items - 1)}, 600);
                        $(this).removeClass('actif_slider');
                        $('.element_slider:last-child').addClass('actif_slider');
                        $this.find('.option_actif').attr('', function () {
                            $('.option_item:last-child').addClass('option_actif');
                            $(this).removeClass('option_actif');
                        });
                    } else {
                        $(this).prev('.element_slider').addClass('actif_slider');
                        $(this).removeClass('actif_slider');
                        $this.children('.contenu_slider').animate({"left": "+=" + width}, 600);
                        $this.find('.option_actif').attr('', function () {
                            $(this).prev('.option_item').addClass('option_actif');
                            $(this).removeClass('option_actif');
                        });
                    }
                });
            });
            /*$this.find('.option_item').on('click', function() {
             var width = $('.image_slider').width();
             $(this).parent().find('.option_actif').attr('', function() {
             $(this).removeClass('option_actif');
             });
             $(this).addClass('option_actif');
             var index = $('.option_item').index(this);
             var target = $(this).attr('data-target');
             /*$('.element_slider').removeClass('actif_slider');
             var slide = $('#' + $(this).data('target')).addClass('actif_slider');*/

            /*$this.find('.actif_slider').attr('', function() {
             /*var $suivant = $(this).prev('.element_slider').attr('id');
             var $suiv = $(this).next('.element_slider').attr('id');*/

            /*var indexSlider = $('.element_slider').index(this);
             alert(indexSlider);
             if ($suivant === undefined) {
             $this.children('.contenu_slider').animate({"left": "-=" + width * (items - 1)}, 600);
             } else if ($suiv === undefined) {
             $this.children('.contenu_slider').animate({"left": "0"}, 600);
             }
             {
             $this.children('.contenu_slider').animate({"left": "+=" + width}, 600);
             }
             });
             });*/
        });
    };
    $('.zs_slider').zsSlider();

    $.fn.checkForm = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "min_character": "2",
                    "time": "3400"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            $('.zs_image').after('<div class="zs_alert" id="input_image_verify">'
                    + '<div class="alert_contenu fond_blanc border_no">'
                    + 'Erreur choisir une image valide'
                    + '</div>'
                    + '</div>');
            $this.find('input[required]').attr('', function () {

                $(this).after('<div class="zs_alert check_text">'
                        + '<div class="alert_contenu fond_blanc border_no">'
                        + '</div>'
                        + '</div>');
                $(this).keyup(function () {
                    var type = $(this).attr('type');
                    if (type === "text") {
                        var ext = new RegExp("[A-Za-z]");
                        if ($(this).val().length < data.min_character) {
                            $(this).next('.check_text').fadeIn();
                            $(this).next('.check_text').children(".alert_contenu").text('Erreur: le champ est vide ou < 2');
                            $(this).next('.check_text').children().css({"color": "red"});
                            $(this).addClass('erreur');
                        } else {
                            if (ext.test($(this).val())) {
                                var rr = $(this).val();
                                $(this).next('.check_text').fadeIn();
                                $(this).next('.check_text').children(".alert_contenu").text('Valide: ' + rr);
                                $(this).next('.check_text').children().css({"color": "green"});
                                $(this).removeClass('erreur');
                            } else {
                                $(this).next('.check_text').fadeIn();
                                $(this).next('.check_text').children(".alert_contenu").text('Erreur: Format non Valide entier requis');
                                $(this).next('.check_text').children().css({"color": "red"});
                                $(this).addClass('erreur');
                            }
                        }
                    } else if (type === "email") {
                        var ext = new RegExp("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$");
                        if ($(this).val().length < data.min_character) {
                            $(this).next('.check_text').fadeIn();
                            $(this).next('.check_text').children(".alert_contenu").text('Erreur: le champ est vide ou < 2');
                            $(this).next('.check_text').children().css({"color": "red"});
                            $(this).addClass('erreur');
                        } else {
                            if (ext.test($(this).val())) {
                                var rr = $(this).val();
                                $(this).next('.check_text').fadeIn();
                                $(this).next('.check_text').children(".alert_contenu").text('Valide: ' + rr);
                                $(this).next('.check_text').children().css({"color": "green"});
                                $(this).removeClass('erreur');
                            } else {
                                $(this).next('.check_text').fadeIn();
                                $(this).next('.check_text').children(".alert_contenu").text('Erreur: Format non Valide email requis');
                                $(this).next('.check_text').children().css({"color": "red"});
                                $(this).addClass('erreur');
                            }
                        }
                    }
                });
                $(this).on('blur', function () {
                    var $_this = $(this);
                    setTimeout(function () {
                        $_this.next('.check_text').hide();
                    }, data.time);
                });
            });
        });
    };
    $('.check_form').checkForm();

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
            alert('me');
            var $this = $(this);
            $this.after('<div class="modale_cover scroll scroll_bleu"></div>');
            $("[data-modale]").on('click', function (e) {
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
    $('.zs_modale').zsModale();


    $.fn.SliderMini = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                    "refreshTile": "1000",
                    "time": "7000"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            setInterval(function () {
                var winWidth = $(document).width();
                var items = $this.find('.element_slider').length;
                $this.children('.contenu_slider').css({'width': 'calc(' + (winWidth) + 'px * ' + items + ')', 'position': 'relative', 'padding': '12px'});
                $this.find('.image_slider').css({'width': (winWidth / 4) + 'px', 'position': 'relative', 'height': (winWidth / 4) + 'px', 'margin-left': '5px', 'margin-right': '5px'});
                var hauteur = $this.find('.image_slider').height();
                $this.find('.texte_slider').css({'text-align': 'center', 'width': (winWidth / 4) + 'px', 'position': 'absolute', 'height': hauteur + 'px', 'bottom': '0', 'top': '0', 'right': '0', 'z-index': '9999'});
            }, data.refreshTime);

            $this.find('.control_avant').on('click', function () {
                var $control = $(this);
                $this.find('.control_arriere').show();

                $this.find('.actif_slider').attr('', function () {
                    var test = $this.children('.contenu_slider').children('.element_slider').children('.image_slider').width();
                    var winWidth = $(document).width();
                    //var items = $this.find('.element_slider').length;
                    var width = (test / 2);


                    var $suivant = $(this).next('.element_slider').attr('id');
                    if ($suivant === undefined) {
                        $control.fadeOut();
                    } else {
                        $(this).next('.element_slider').addClass('actif_slider');
                        $(this).removeClass('actif_slider');
                        $('.actif_slider').prevUntil().removeClass('actif_slider');
                        $('.actif_slider').nextUntil().removeClass('actif_slider');
                        $this.children('.contenu_slider').animate({"left": "-=" + (width)}, 600);
                    }
                });
            });

            $this.find('.control_arriere').on('click', function () {
                var $control = $(this);
                $this.find('.control_avant').show();

                var items = $this.find('.element_slider').length;
                $this.find('.actif_slider').attr('', function () {
                    var test = $this.children('.contenu_slider').children('.element_slider').children('.image_slider').width();
                    var winWidth = $(document).width();
                    //var items = $this.find('.element_slider').length;
                    var width = (test / 2);

                    var $suivant = $(this).prev('.element_slider').attr('id');
                    if ($suivant === undefined) {
                        $control.fadeOut();
                    } else {
                        $(this).prev('.element_slider').addClass('actif_slider');
                        $(this).removeClass('actif_slider');
                        $('.actif_slider').prevUntil().removeClass('actif_slider');
                        $('.actif_slider').nextUntil().removeClass('actif_slider');
                        $this.children('.contenu_slider').animate({"left": "+=" + (width)}, 600);
                    }
                });
            });
        });
    };
    $('.slider_mini').SliderMini();

    $.fn.zsAlert = function (options)
    {
        var defauts =
                {
                    "vitesse": "300",
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);

            $this.find('.fermer').on('click', function () {
                $(this).parent('.zs_alert').css({'transform': 'scale(0.1)'});
                $(this).parent('.zs_alert').fadeOut(data.vitesse);
            });
        });
    };
    $('.zs_alert').zsAlert();

    $.fn.zsScrollTop = function (options)
    {
        var defauts =
                {
                    "vitesse": "fast",
                    "refreshTime": "1000",
                    "position": "150",
                    "animation": "-=450px"
                };
        var datas = $.extend(defauts, options);
        return this.each(function () {
            var $_this = $(this);
            setInterval(function () {
                var posScroll = $(document).scrollTop();
                if (posScroll > datas.position) {
                    $_this.fadeIn(datas.vitesse);
                } else {
                    $_this.hide();
                }

            }, datas.refreshTime);
            $(this).click(function () {
                $('html, body').animate({
                    scrollTop: datas.animation}, datas.vitesse);
                return false;
            });
        });
    };
    $('.to_top').zsScrollTop();

    $.fn.zsScrollBottom = function (options)
    {
        var defauts =
                {
                    "vitesse": "fast",
                    "animation": "+=450px",
                    "refreshTime": "1000"
                };
        var datas = $.extend(defauts, options);
        return this.each(function () {
            var $__this = $(this);
            setInterval(function () {
                var posScroll = $(document).scrollTop();
                var winHeight = $(document).height();
                var a = winHeight - 1000;
                if (posScroll < a) {
                    $__this.fadeIn(datas.vitesse);
                } else {
                    $__this.hide();
                }
            }, datas.refreshTime);
            $(this).click(function () {
                $('html, body').animate({
                    scrollTop: datas.animation}, datas.vitesse);
                return false;
            });
        });
    };
    $('.to_bottom').zsScrollBottom();

    $.fn.btLoading = function (options)
    {
        var defauts =
                {
                    "option": "click",
                    "texte": 'Veuillez Patienter...'
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            $(this).on(data.option, function () {
                var $this = $(this);
                var text = $(this).html();
                $(this).html(data.texte);
                $(this).prepend('<i class="icone icon_loading tourner agauche" style="margin-right: 3px;"></i>');
                $(this).css({'text-transform': 'capitalize'});
                setTimeout(function () {
                    $this.html(text);
                    $this.css({'text-transform': 'uppercase'});
                }, 6000);
            });
        });
    };
    $('.bt_loading').btLoading();

    $.fn.infosBulle = function (options)
    {
        var defauts =
                {
                    "span1": '<span class="bulle"><i class="pointing arrow_carrot-2up">'
                            + '</i><i class="icone icon_info_alt"></i>&nbsp;',
                    "span2": "</span>",
                    "direction": "bottom"
                };
        var data = $.extend(defauts, options);
        return this.each(function () {

            var infos = $(this).attr('data-infos');
            $(this).append(data.span1 + infos + data.span2);
            var $this = $(this);
            $this.mouseover(function () {
                $(this).children('.bulle').css({'display': 'table'});
            });
            $this.mouseleave(function () {
                $(this).children('.bulle').hide();
            });
        });
    };
    $('.infos_bulle').infosBulle();

    $.fn.infosBlock = function (options)
    {
        var defauts =
                {
                    "option": "click",
                    "vitesse": 'fast'
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            $('.block').append('<i class="pointing arrow_carrot-2up"></i>');
            $(this).on(data.option, function () {
                $('#' + $(this).data('target')).fadeToggle(data.vitesse);
            });
        });
    };

    $.fn.onglets = function (options)
    {
        var defauts =
                {
                    "option": "click",
                    "vitesse": 'fast'
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            $this.find('[data-onglet]').on(data.option, function () {
                $this.find('[data-onglet]').removeClass('lien_actif');
                $(this).addClass('lien_actif');

                $this.find('.onglet').removeClass('onglet_actif');
                $('#' + $(this).data('target')).addClass('onglet_actif');
            });
        });
    };
    $('.zs_onglet').onglets();

    $.fn.openToggle = function (options)
    {
        var defauts =
                {
                    "option": "click",
                    "vitesse": 'fast'
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            $this.on('click', function () {
                $(this).next('.element_toggle').slideToggle(data.vitesse);
            });
        });
    };
    $('.open_toggle').openToggle();

    $('.barre_outil').before('<button class="bt_outil zs_boutton adroite" style="margin-right: 50px; margin-top: 22px; float:right"><i class="icone icon_tools"></i></button>');
    $('.zs_menu').before('<button class="bt_menu zs_boutton adroite" style="margin-top: 22px; float:right"><i class="icone icon_menu"></i></button>');

    $.fn.zsMenu = function (options)
    {
        var defauts =
                {
                    "option": "click",
                    "vitesse": 'fast'
                };
        var data = $.extend(defauts, options);
        return this.each(function () {
            var $this = $(this);
            $this.on('click', function () {
                $('.zs_menu').slideToggle(data.vitesse);
            });
        });
    };
    $('.bt_menu').zsMenu();

})(jQuery);





