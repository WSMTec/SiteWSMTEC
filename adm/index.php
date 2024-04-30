<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="https://wsmtec.com.br/themes/wsm/images/flavicon.png">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    </head>
    <body>
        <main class="container">
            <section class="box">
                <h1>
                    <img style="width: 40%;" src="./images/logo_peq.png"/>
                </h1>
                <p>
                    Painel administrativo wsmtec, realize o login para ter acesso.
                </p>
                <?php
                $login = new Login(0);
                if ($login->CheckLogin()):
                    header('Location: painel.php'); 
                endif;
                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['AdminLogin'])):
                    $login->ExeLogin($dataLogin);
                    if (!$login->getResult()):
                        WSErro($login->getError()[0], $login->getError()[1]);
                    else:
                        header('Location: painel.php');
                    endif;
                endif;
                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if ($get == 'restrito'):
                        WSErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
                    elseif ($get == 'logoff'):
                        WSErro('<b>Sucesso ao fazer logoff:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
                    endif;
                endif;
                ?>
                <form name="AdminLoginForm" action="" method="post">
                    <div class="row">
                        <label>
                            <span class="lnr lnr-user"></span> E-mail
                        </label>
                        <input name="user" type="text" placeholder="E-mail" required="">
                    </div>
                    <div class="row">
                        <label>
                            <span class="lnr lnr-lock"></span> Senha
                        </label> 
                        <input name="pass" type="password" placeholder="Senha" required="">
                    </div>
                    <div class="row">
                        <button class="btn-green" name="AdminLogin" type="submit" value="login" >Entrar no Painel</button>

                        <a style="
                           padding: 1em 0.5em;
                           flex-basis: 100%;
                           margin-top: 4%;
                           color: #eee;
                           border: none;
                           text-transform: uppercase;
                           font-weight: 600;
                           border-radius: 4px;
                           text-align: center;
                           text-decoration: none;
                           font-size: 13px;
                           " class="btn-blue" href="<?= HOME; ?>">Voltar para o site</a>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>
<?php
ob_end_flush();
