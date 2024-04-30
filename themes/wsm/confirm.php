<?php
$EbookMail = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!isset($EbookMail) && !isset($EbookMail['SendEbookForm'])):
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
$Ebook = $EbookMail['ebook'];
unset($EbookMail['SendEbookForm'], $EbookMail['ebook']);
?>

<section class="section_confirm">
    <header class="section_confirm_header">
        <div class="content">
            <?php
            $Read = new Read;
            $Read->ExeRead("tb_ebook", "WHERE ebook_name = :e LIMIT 1", "e={$Ebook}");
            extract($Read->getResult()[0]);

            $Read->ExeRead("tb_newsletter", "WHERE new_email = :mail", "mail={$EbookMail['new_email']}");
            if ($Read->getRowCount() < 1):
                $Create = new Create();
                $Create->ExeCreate("tb_newsletter", $EbookMail);
            endif;

            $EbookMail = array_map('strip_tags', $EbookMail);
            $EbookMail = array_map('trim', $EbookMail);


            $Mail['Assunto'] = "Sua demostração está pronta! WSM Tecnologia em informática.";
            $Mail['Mensagem'] = "<img width='204' title='WSM Tecnologia em Infomática' alt='[WSM Tecnologia em Infomática]' src='https://www.wsmtec.com.br/themes/wsm/images/logo/logo_med.png'/>"
                    . "<br/><br/>"
                    . "A <strong>WSM Tecnologia em informática</strong>, agradece o seu interesse!"
                    . "<br/> Para ter acesso ao <b>{$ebook_title}</b>, basta clicar no botão abaixo: <br/><br/><br/>"
                    . "<a href='" . HOME . "/demo/{$ebook_name}' style='padding: 0.7em 1em;
                        background-color: #FF512F;
                        border: 1px solid transparent;
                        border-radius: 5px;
                        text-decoration: none;
                        color: #ffffff;
                        font-weight: 300;'>Vamos lá!</a> <br/><br/><br/>";
            $Mail['RemetenteNome'] = "WSM Tecnologia em informática";
            $Mail['RemetenteEmail'] = "contato@wsmtec.com.br";
            $Mail['DestinoNome'] = "{$EbookMail['new_nome']}";
            $Mail['DestinoEmail'] = "{$EbookMail['new_email']}";
            $SendMail = new EmailContato;
            $SendMail->EnviarC($Mail);
            if ($SendMail->getError()):
                ?>
                <div class="emoji">
                    <img src="<?= INCLUDE_PATH . '/images/icones/happy.png' ?>"/>
                </div>
                <h1>Tudo certo!!! <br/> <?= $EbookMail['new_nome']; ?>, enviamos sua demontração para o e-mail <?= $EbookMail['new_email']; ?></h1>
                <p><a href="<?= HOME . '/blog'; ?>" class="section_confirm_ancor">Conheça nosso blog</a></p>
                <?php
            endif;
            ?>
        </div>
    </header>
</section>


