$(function () {

//FACEBOOK COMP
BASE = $('link[rel="canonical"]').attr('href');

        //SHARE :: FACEBOOK
        $('.facebook a').click(function () {
            var share = 'https://www.facebook.com/sharer/sharer.php?u=';
            window.open(share + BASE, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, width=660, height=400");
            return false;
        });

        //COUNT :: FACEBOOK

//        var facebook = $('.sharebox .facebook a').attr('href');
//        $.getJSON('https://graph.facebook.com/?id=' + facebook, function (data) {
//            $('.sharebox .facebook .count').text(data.shares);
//        });


//    MENU MOBILE
$('.content_mobile').on('click', function () {
    $('.ul_sub_mobile').toggleClass('ds_none');
    $(this).toggleClass('content_mobile_active');
});

//    VALIDAR EMAIL
function ValidarEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return filter.test(email);
}

//    CAPTURAR EMAIL
function CaptEmail() {
    var modal = $('#modalEmail');
    $('#btnEmail').click(function (e) {
        e.preventDefault();
        var email_visit = $('#emailForm').val();
        modal.show().animate({'opacity': '1'}, 200, function () {
            $('.modal-content').animate({'margin-top': '100px', 'opacity': '1'}, 400);
            $('#inpNomeModal').focus();
            $('#inpEmailModal').val(email_visit);
        });
    });
    $('#formModal').submit(function (e) {
//            (e).preventDefault(); 
if ($('#inpNomeModal').val() === '') {
    $('.notfy_nome').html('<span class="mal_span"><span class="icon-sad"></span>Insira seu nome!</span>');
    return false;
} else {
    $('.notfy_nome').html(''); 
}

if ($('#inpEmailModal').val() === '') {
    $('.notfy_email').html('<span class="mal_span"><span class="icon-sad"></span>Insira seu e-mail!</span>');
    return false;
} else if (!ValidarEmail($('#inpEmailModal').val())) {
    $('.notfy_email').html('<span class="mal_span"><span class="icon-sad"></span>Informe um e-mail válido!</span>');
    return false;
} else {
    return true;
}
});

    $('.close').click(function () {
        $('.modal-content').animate({'margin-top': '-100px', 'opacity': '0'}, 400, function () {
            modal.animate({'opacity': '0'}, 400, function () {
                modal.hide();
            });
        });
    });
}

CaptEmail();

setTimeout(function () {
    $('.main_header_content_article_btn').animate({'opacity': '1'}, 400);
}, 4000);
});