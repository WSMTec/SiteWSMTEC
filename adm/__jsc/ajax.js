$(function () {

    var body = $("body").attr("id");
    modalData();
    notificacao();
    $('.carregando').hide();


    $('#form-companies').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-companies-update').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-sitemap').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-sitemap-update').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-department').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-department-update').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-user').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-user-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-user-profile').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-servicos').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-servicos-update').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-reports').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-reports-update').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-upload').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-client').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-upload-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-client-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-categories-update').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        var action = $(this).attr('action');
        AjaxMidia(action, data);
    });
    $('#form-categories').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-categories-solution-update').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        var action = $(this).attr('action');
        AjaxMidia(action, data);
    });
    $('#form-categories-solution').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        Ajax(action, data);
    });
    $('#form-solution').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-solution-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-posts').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-posts-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-popup').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-popup-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-services').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-services-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-product').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-product-update').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-newsletter').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-tickets').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('#form-tickets-msg').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        jQueryForm(action, form);
    });
    $('body').on('click', 'button[name="btn-href[]"]', function (e) {
        e.preventDefault();
        var action = $(this).data("href");
        window.location.href = action;
    });
    $('body').on('click', 'button[name="btn-print[]"]', function (e) {
        e.preventDefault();
        var action = $(this).data("href");
        window.open(action, '_blank');
    });
    $('#btn-notificacao').click(function (e) {
        e.preventDefault();
        notificacao();
    });
    $('#form').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });


    $('#IdEmpresa').change(function () {
        if ($(this).val()) {
            $('#dep_id').hide();
            $('.carregando').show();

            $.getJSON('_models/AdminManager.php?action=search-list-department', {codigo: $(this).val()}, function (j) {
                var options = '<option value=""></option>';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' +
                            j[i].dep_id + '">' +
                            j[i].dep_title + '</option>';
                }
                $('#dep_id').html(options).show();
                $('.carregando').hide();
            });
        } else {
            $('#dep_id').html('<option value="">Escolha um departamento</option>');
        }
    });

    function notificacao() {
        var action = "notification";
        var codigo = 0;
        $.post('_models/AdminManager.php?action=search-' + action, {codigo: codigo}, function (data) {
            $(".wd-not").html(data);
        });
    }
    function emptyForm(data) {
        var vazios = $(data).filter(function () {
            return !this.value;
        }).get();
        if (vazios.length) {
            $(vazios).addClass('vazio');
            return false;
        }
    }
    function trigger(data) {
        if (data[0]) {
            $.each(data, function (key, value) {
                triggerNotify(data[key]);
            });
        } else {
            triggerNotify(data);
        }
    }

    function Ajax(action, data, codigo = null) {
        var intp = $('.inpt-null');
        var btn = $('#btn-form').html();
        intp.removeClass('vazio');
        if (emptyForm(intp)) {
            return false;
        }
        if ($('.trigger_notify').length) {
            $('.trigger_notify').remove();
        }
        $.ajax({
            url: '_models/AdminManager.php?action=' + action,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.reset === true) {
                    $('form').trigger("reset");
                }
                if (data.rows === true) {
                    $(".remove-row").parent('div').remove();
                }
                if (data.reloadtime === true) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }
                if (data.training === true) {
                    $('input[name*=NomeTes]').attr("disabled", "disabled");
                }

                if (data.erro === true) {
                    trigger(data.notify);
//                    $('#btn-form').removeAttr("disabled").removeClass('form-btn-create').html(btn);
                } else {
                    trigger(data.notify);
//                    $('#btn-form').removeAttr("disabled").removeClass('form-btn-create').html(btn);
                }
            }
        });
    }
    function AjaxMidia(action, data, codigo = null) {
        var intp = $('.inpt-null');
        var btn = $('#btn-form').html();
        intp.removeClass('vazio');
        if (emptyForm(intp)) {
            return false;
        }
        if ($('.trigger_notify').length) {
            $('.trigger_notify').remove();
        }
        $('#btn-form').attr("disabled", "disabled").addClass('form-btn-create').html("<img src='images/carregando.gif' width='15'/> Carregando");
        $.ajax({
            url: '_models/AdminManager.php?action=' + action,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.reset === true) {
                    $('form').trigger("reset");
                }
                if (data.reloadtime === true) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }
                if (data.rows === true) {
                    $(".remove-row").parent('div').remove();
                }
                if (data.erro === true) {
                    trigger(data.notify);
                    $('#btn-form').removeAttr("disabled").removeClass('form-btn-create').html(btn);
                } else {
                    trigger(data.notify);
                    $('#btn-form').removeAttr("disabled").removeClass('form-btn-create').html(btn);
                }
            }
        });
    }
    function jQueryForm(action, form, codigo = null) {
        var intp = $('.inpt-null');
        var btn = $('#btn-form').html();
        intp.removeClass('vazio');
        if (emptyForm(intp)) {
            return false;
        }
        if ($('.trigger_notify').length) {
            $('.trigger_notify').remove();
        }
        var per = $('.processing');
        form.ajaxSubmit({
            url: '_models/AdminManager.php?action=' + action,
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function () {
                $('#btn-form').attr("disabled", "disabled").addClass('form-btn-create').html("<img src='images/carregando.gif' width='15'/> Carregando");
            },
            uploadProgress: function (event, position, total, percent) {
                per.fadeIn("fast");
                per.width(percent + "%");


                if (form.find(".load").length) {
                    form.find(".load b").text(percent + "%");
                } else {
                    $('#btn-form').html("<span class='load'><b>" + percent + "%</b></span> Carregando");
                }
            },
            success: function (data) {
                if (data.reset === true) {
                    form.trigger("reset");
                }
                if (data.rows === true) {
                    $(".remove-row").parent('div').remove();
                }
                if (data.erro === true) {
                    trigger(data.notify);
                } else {
                    trigger(data.notify);
                }
            },
            complete: function () {
                window.setTimeout(function () {
                    per.width('0%');
                    $('.load').remove();
                    $('#btn-form').removeAttr("disabled").removeClass('form-btn-create').html(btn);
                }, 10);
            }
        });
    }

    function triggerNotify(data) {
        var triggerContent = "<div class='trigger_notify trigger_notify_" + data.color + "' style='left: 100%; opacity: 0;'>";
        triggerContent += "<span class='" + data.icon + "'></span> " + data.title + "";
        triggerContent += "<span class='trigger_notify_timer'></span>";
        triggerContent += "</div>";
        if (!$('.trigger_notify_box').length) {
            $('body').prepend("<div class='trigger_notify_box'></div>");
        }

        $('.trigger_notify_box').prepend(triggerContent);
        $('.trigger_notify').stop().animate({'left': '0', 'opacity': '1'}, 200, function () {
            $(this).find('.trigger_notify_timer').animate({'width': '100%'}, data.timer, 'linear', function () {
                $(this).parent('.trigger_notify').animate({'left': '100%', 'opacity': '0'}, function () {
                    $(this).remove();
                });
            });
        });
        $('body').on('click', '.trigger_notify', function () {
            $(this).animate({'left': '100%', 'opacity': '0'}, function () {
                $(this).remove();
            });
        });
    }
    function modalData() {
        var btn = null;
        var action = null;
        var codigo = null;
        var row = null;
        var grid = null;
        var t = null;

        $('body').on('click', 'button[name="btn-modal[]"]', function (e) {
            e.preventDefault();
            t = $(this);
            btn = $('.btn-accept').html();
            action = $(this).data("function");
            codigo = $(this).val();
            row = $(this).parent().parent().parent();
            grid = $(this).parent();

            $.post('_models/AdminManager.php?action=search-' + action, {codigo: codigo}, function (data) {
                $('.modal-all .header-modal-box h4').text(data.title);
                $('.modal-all .row-f label').html(data.description);
                Modal();
            }, 'json');
        });

        $('.btn-accept').click(function (i) {
            i.preventDefault();
            if ($('.trigger_notify').length) {
                $('.trigger_notify').remove();
            }

            $('.btn-accept').attr("disabled", "disabled").addClass('disabled').html("<img src='images/carregando.gif' width='15'/> Carregando");
            $.ajax({
                url: '_models/AdminManager.php?action=' + action,
                method: 'POST',
                data: {codigo: codigo},
                dataType: 'json',
                success: function (data) {
                    if (data.row === true) {
                        row.remove();
                    }
                    if (data.grid === true) {
                        grid.remove();
                    }
                    if (data.reloadtime === true) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    }
                    if (data.ticket === true) {
                        t.remove();
                        $('.status-ticket-' + codigo).text('FINALIZADO');
                    }

                    if (data.erro === true) {
                        trigger(data.notify);
                        closeModal();
                        $('.btn-accept').removeAttr("disabled").removeClass('disabled').html(btn);
                    } else {
                        trigger(data.notify);
                        closeModal();
                        $('.btn-accept').removeAttr("disabled").removeClass('disabled').html(btn);
                    }
                    if (data.href.length) {
                        window.setTimeout(function () {
                            window.location.href = data.href;
                        }, 4000);
                    }
                }
            });
        });
    }


    function Modal() {
        var modal = $('.modal-function');
        modal.show().css('display', 'flex').animate({'opacity': '1'}, 100, function () {
            $('.modal-box').animate({'margin-top': '100px', 'opacity': '1'}, 100);
        });
        $('.modal-function').click(function (e) {
            var close = e.target.closest('.modal-box');
            if (!close) {
                $('.modal-box').animate({'margin-top': '-100px', 'opacity': '0', 'display': 'none'}, 0, function () {
                    modal.animate({'opacity': '0'}, 0, function () {
                        modal.hide();
                    });
                });
            }
        });
        $('.close').click(function () {
            $('.modal-box').animate({'margin-top': '-100px', 'opacity': '0', 'display': 'none'}, 0, function () {
                modal.animate({'opacity': '0'}, 0, function () {
                    modal.hide();
                });
            });
        });
        $('.btn-cancel').click(function () {
            $('.modal-box').animate({'margin-top': '-100px', 'opacity': '0', 'display': 'none'}, 0, function () {
                modal.animate({'opacity': '0'}, 0, function () {
                    modal.hide();
                });
            });
        });
    }
    function closeModal() {
        $('.modal-box').animate({'margin-top': '-100px', 'opacity': '0', 'display': 'none'}, 0, function () {
            $('.modal-function').animate({'opacity': '0'}, 0, function () {
                $('.modal-function').hide();
            });
        });
    }



//    window.setTimeout(function () {
//        $('.title_p').html('(2) Painel');
//    }, 8000);


    if (body === "tickets-room") {
//        alert(1);
        setInterval(function () {
            var commentsId = $('.li-room').map(function () {
                return this.id;
            }).get();
//            console.log(commentsId);
            var ticketId = $('.room').attr('id').split('-');
            var Id = ticketId[0];
            var User = ticketId[1];
            var lastId = Math.max.apply(null, commentsId);

            console.log(lastId);

            $.post('_models/AdminManager.php?action=search-ticket-msg', {codigo: Id, last: lastId}, function (data) {
                if (data.comments) {
                    $.each(data.comments, function (key, value) {
                        var Class = value.remetente !== User ? "left-room" : "right-room";
                        var Id = value.remetente !== User ? "<strong class=''>" + value.NomeUsuario + "</strong><small class=''>" + value.datamsg + "</small>" : "<small class=''>" + value.datamsg + "</small><strong class=''>" + value.NomeUsuario + "</strong>";
                        var File = value.file !== null ? "<br><img style='width: 100%;' src='https://wsmtec.com.br/adm/uploads/tickets/" + value.file + "' />" : "";
                        $('.room').append(
                                "<li class='" + Class + " li-room' id='" + value.idmsg + "'>" +
                                "<div class='header-room'>" + Id + "</div>" +
                                "<p>" + value.mensagem + "" + File + "</p>" +
                                "</li>" +
                                "<div class='border-b'></div>"
                                );
                    });
                }
            }, 'json');
        }, 4000);
    }
});

