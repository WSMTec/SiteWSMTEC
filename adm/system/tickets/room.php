<style>
    *, ::after, ::before {
        box-sizing: border-box;
        clear: both;
    }
</style>

<main class="content">
    <?php
    $Code = filter_input(INPUT_GET, "ticket", FILTER_VALIDATE_INT);
    $designate = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $msg = null;

    if (!empty($designate)):
        $Update = new Update;
        $Update->ExeUpdate("tb_tickets", $designate, "WHERE id = :u", "u={$Code}");

        if ($Update):

            $Read = new Read;

            $Read->ExeRead("tb_usuarios", "WHERE IdUsuario = :i", "i={$designate['idsuporte']}");

            $nomeuser = $Read->getResult()[0]['NomeUsuario'];
            $emailuser = $Read->getResult()[0]['EmailUsuario'];

            $Read->ExeRead("tb_tickets", "WHERE id = :id", "id={$Code}");

            $Codd = $Read->getResult()[0]["codigo"];

            require('../_app/Library/PHPMailer/class.phpmailer.php');

            $Mail = new PHPMailer;
            $Mail->Host = MAILHOST;
            $Mail->Port = MAILPORT;
            $Mail->Username = MAILUSER;
            $Mail->Password = MAILPASS;
            $Mail->CharSet = 'UTF-8';
            $Mail->IsSMTP();
            $Mail->SMTPAuth = true;
            $Mail->IsHTML();
            //REMETENTE E RETORNO
            $Mail->From = MAILUSER;
            $Mail->FromName = $userlogin['NomeUsuario'];
            $Mail->AddReplyTo($userlogin['EmailUsuario'], $userlogin['NomeUsuario']);
            //ASSUNTO, MENSAGEM E DESTINO
            $Mail->Subject = "Suporte designado para você - WSMTEC!";
            $Mail->Body = "O ticket de codigo:<b>{$Codd}</b>, foi designado á você!";
            $Mail->AddAddress($emailuser, $nomeuser);
//            echo "<pre>";
//            var_dump($Codd, $Code, $Mail);
//            echo "</pre>";
            $Mail->Send();

            $msg = "<div class='msg-flash'><span class='msg-text-flash'>O Chamado foi designado para outro usuário, e-mail enviado!</span></div>";
        endif;
    endif;

    $Read = new Read;

    $Read->ExeRead("tb_tickets", "WHERE id = :id", "id={$Code}");
    $Suporte = $Read->getResult()[0]["idsuporte"];
    $Status = $Read->getResult()[0]["status"];
    $Codd = $Read->getResult()[0]["codigo"];

    if (!$Adm && !$Coord):
        if ($Read->getResult()[0]['iduser'] !== $userlogin['IdUsuario']):
            header("Location: painel.php");
        endif;

        $Update = new Update;
        $Update->ExeUpdate("tb_mensagens", array("statusmsg" => "S"), "WHERE idticket = :u AND remetente != :r", "u={$Code}&r={$userlogin['IdUsuario']}");
    else:
        $Update = new Update;
        $Update->ExeUpdate("tb_mensagens", array("statusmsg" => "S"), "WHERE idticket = :u AND remetente != :r", "u={$Code}&r={$userlogin['IdUsuario']}");
    endif;
    ?>

    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h"><?= $Read->getResult()[0]["assunto"]; ?></h2>
        <div class="header-box-btn">
                      
            <form id="form-tickets-designate" method="post" class="form-tickets-designate" action="" enctype="multipart/form-data" >
                <select required="" name="idsuporte">
                    <option value="">Selecionar</option>
                    <?php
                    $Read->FullRead("SELECT * FROM tb_usuarios WHERE NivelUsuario = 'ADM' AND IdUsuario != '{$userlogin['IdUsuario']}'");

                    foreach ($Read->getResult() as $it):
                        ?>
                        <option value="<?= $it['IdUsuario'] ?>"><?= $it['NomeUsuario'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <button class="btn-default btn-green btn-left" type="submit">Designar</button>
            </form>

            <?php
            if ($Suporte === $userlogin["IdUsuario"] && $Status !== "FINALIZADO"):
                ?>
                <a class="btn-default btn-clean btn-designate-rigth" id="btn-designar"><span class="lnr lnr-list"></span>  Designar</a>
                <?php
            endif;
            ?>
            <a class="btn-default btn-blue btn-left" href="?exe=tickets/index"><span class="lnr lnr-list"></span>  Tickets</a>
        </div>
    </header>

    <div class="loader">

        <div class="processing"></div>

    </div>

    <!--</div>-->



    <div class="box content-box">

        <?php
        if (!empty($msg)):

            echo $msg;

        endif;
        ?>

        <ul class="room" id="<?= "{$Code}-{$userlogin['IdUsuario']}"; ?>">

            <?php
            $Read->FullRead(""
                    . "SELECT tb_mensagens.*, tb_usuarios.NomeUsuario FROM tb_mensagens "
                    . "INNER JOIN tb_usuarios ON IdUsuario = remetente "
                    . "WHERE idticket = :u ORDER BY idmsg ASC", "u={$Code}");

            if ($Read->getResult()) {

                foreach ($Read->getResult() as $Msg) {

                    $class = ($Msg['remetente'] !== $userlogin['IdUsuario'] ? "left-room" : "right-room");

                    $user = ($Msg['remetente'] !== $userlogin['IdUsuario'] ? "<strong class=''>{$Msg['NomeUsuario']}</strong><small class=''>" . date("d/m/Y H:i", strtotime($Msg['datamsg'])) . "</small>" : "<small class=''>" . date("d/m/Y H:i", strtotime($Msg['datamsg'])) . "</small><strong class=''>{$Msg['NomeUsuario']}</strong>");

                    $file = ($Msg['file'] ? "<br><img style='width: 100%;' src='" . HOME . "/adm/uploads/tickets/{$Msg['file']}' />" : "");

                    echo ""
                    . "<li class='{$class} li-room' id='{$Msg['idmsg']}'>"
                    . "<div class='header-room'>"
                    . "{$user}"
                    . "</div>"
                    . "<p>{$Msg['mensagem']} {$file}</p>"
                    . "</li>"
                    . "<div class='border-b'></div>";
                }
            }
            ?>

        </ul> 

    </div>

    <?php
    if ($Suporte === $userlogin['IdUsuario'] || $userlogin['nivel_user'] < 3):
        if ($Status !== "FINALIZADO") {
            ?>
            <div class="box content-box">
                <form id="form-tickets-msg" method="post" class="form-tickets-msg" action="tickets-msg" enctype="multipart/form-data" >
                    <div class="row-f">
                        <label>
                            <span class="lnr lnr-bubble"></span>   Mensagem
                        </label>
                        <input style="margin-bottom: 1%;" name="file" type="file"/>
                        <textarea name="mensagem" style="margin-top: 2%" class="inpt-null js_editor"></textarea>
                    </div>
                    <div class="row-btn">
                        <input name="id" value="<?= $Code; ?>" type="hidden"/>
                        <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Enviar Mensagem</button>
                    </div>
                </form>
            </div>
            <?php
        }
    endif;
    ?>
</main>