<?php
ob_start();
require('./_app/Config.inc.php');
$Session = new Session;

$Modal = false;

if (!isset($_COOKIE["cookieModal"])) {
    $Read = new Read;
    $Read->ExeRead("tb_ebook", "WHERE ebook_status = 1");

    if ($Read->getRowCount()) {
        $diasparaexpirar = 1;
        setcookie('cookieModal', 'ok', (time() + ($diasparaexpirar * 24 * 3600)));

        $Modal = true;
    }
}

$logoff = filter_input(INPUT_GET, 'sair', FILTER_VALIDATE_BOOLEAN);
?>


<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/Article">
    <head>
        <meta charset="UTF-8">
        <meta name="mit" content="2017-05-16T12:07:01-03:00+48186">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--[if lt IE 9]>
        <script src"<?= HOME; ?>/_cdn/html5.js"></script>
        <![endif]-->
        <link rel="alternate" type="application/rss+xml" href="<?= HOME; ?>/rss.xml"/>
        <link rel="sitemap" type="application/xml" href="<?= HOME; ?>/sitemap.xml"/>

        <?php
        $Link = new Link;
        $Link->getTags();
        ?>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/icon/fonticon.css" type="text/css"/>
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/boot.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M6DXRYFNZW"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-M6DXRYFNZW');
        </script>
    </head>
    <body>
        <?php
        ($_SERVER['REQUEST_URI'] !== '/' ? require(REQUIRE_PATH . '/inc/header_thin.inc.php') : require(REQUIRE_PATH . '/inc/header.inc.php'));

        if (!require($Link->getPatch())):
            Erro('Erro ao incluir arquivo de navegação!', ERROR, true);
        endif;

        require(REQUIRE_PATH . '/inc/footer.inc.php');
        ?>

        <div id="modal_form_login" class="modal_login">
            <div class="modal_login_div" style="display: none;">
                <span class="close">&times;</span>
                <div class="content_flex content_modal">
                    <div class="div_form">
                        <div class="notify_site">
                            <!--<div class="msg_notify"></div>-->
                        </div>

                        <form id="form_modal_login" method="post" action="visitor_login">
                            <span class="title_modal">Login</span>
                            <div class="div_input">
                                <input type="email" name="visitor_email" placeholder="Seu e-mail" class="inpt-null"/>
                                <span class="notfy_email"></span>
                            </div>
                            <div class="div_input">
                                <input type="password" name="visitor_password" placeholder="Sua senha" class="inpt-null"/>
                                <span class="notfy_nome"></span>
                            </div>
                            <div class="div_input">
                                <button class="button_submit_logar" id="btn_form" type="submit">Entrar</button>
                            </div>
                        </form>

                        <form id="form_modal_create" method="post" action="visitor">
                            <span class="title_modal">Cadastre-se</span>
                            <div class="div_input">
                                <input type="text" name="visitor_name" placeholder="Seu nome" class="inpt-null"/>
                                <span class="notfy_nome"></span>
                            </div>
                            <div class="div_input">
                                <input type="email" name="visitor_email" placeholder="Seu melhor e-mail" class="inpt-null"/>
                                <span class="notfy_email"></span>
                            </div>
                            <div class="div_input">
                                <input type="tel" name="visitor_phone" placeholder="Seu telefone"/>
                                <span class="notfy_nome"></span>
                            </div>
                            <div class="div_input">
                                <input type="password" name="visitor_password" placeholder="Sua senha"/>
                                <span class="notfy_nome"></span>
                            </div>

                            <label class="label_check"> 
                                <span>Desejo receber novidades e eBooks gratuitamente.</span>
                                <input type="checkbox" checked="checked" name="visitor_type" value="all" class="inpt-null">
                                <span class="checkmark"></span>
                            </label>

                            <div class="div_input">
                                 <!--<input type="submit" value="oi">-->
                                <button class="button_submit_visitor" id="btn_form" type="submit">Cadastrar</button>
                            </div>
                        </form>

                        <form id="form_modal_pass" method="post" action="">
                            <span class="title_modal">Recuperar senha</span>
                            <div class="div_input">
                                <input type="email" name="new_email" placeholder="Seu e-mail" class="inpt-null"/>
                                <span class="notfy_email"></span>
                            </div>

                            <div class="div_input">
                                <button class="button_submit" id="btn_form" type="submit">Recuperar</button>
                            </div>
                        </form>

                        <div class="ancor_login">
                            <a href="" class="ancor_lg" style="display: none;">Faça o login</a>
                            <a href="" class="pass_lg">Recuperar senha</a>
                            <a href="" class="create_lg">Cadastre-se</a>
                        </div>
                    </div>
                </div>
                <hr/>
                <span class="footer_modal"><p>A WSM Tecnologia agradece o seu interesse!</p></span>
            </div>
        </div> 
    </body>

    <script type="text/javascript">
        var LHCChatOptions = {};
        LHCChatOptions.opt = {widget_height: 340, widget_width: 300, popup_height: 520, popup_width: 500, domain: 'wsmtec.com.br'};
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://') + 1)) : '';
            var location = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';

            po.src = '//wsmtec.com.br/lhc_web/index.php/por/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true?r=' + referrer + '&l=' + location;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
    <script src="<?= HOME ?>/_cdn/jquery.js"></script>
    <script src="<?= HOME ?>/_cdn/typed.min.js"></script>
    <script src="<?= HOME ?>/_cdn/demos.js"></script>
    <script src="<?= HOME ?>/_cdn/script.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('.autoplay').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    });
    </script>
    <!-- 
        <h1>migração do site beta</h1>
         -->
         <h6>beta</h6>
</html>
<?php
ob_end_flush();