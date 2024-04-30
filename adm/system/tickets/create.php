<?php
//if (!$Adm):
//    header('Location: ../../painel.php');
//    die;
//endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de tickets no sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=tickets/index"><span class="lnr lnr-list"></span>  Tickets</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>
    <!--</div>-->

    <div class="box content-box">
        <form id="form-tickets" method="post" class="form-tickets" action="tickets" enctype="multipart/form-data">
            <?php if ($Adm): ?>
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-user"></span>  Cliente
                    </label>
                    <select class="inpt-null" name="iduser">
                        <option></option>
                        <?php
                        $Read = new Read;
                        $Read->FullRead("SELECT * FROM tb_usuarios INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_usuarios.IdEmpresaUsuario WHERE nivel_user < :nivel", "nivel=3");
                        foreach ($Read->getResult() as $d):
                            extract($d);
                            ?>
                            <optgroup label="<?= $NomeEmpresa; ?>">
                                <option value="<?= $IdUsuario; ?>-<?= $IdEmpresa; ?>"><?= $NomeUsuario; ?></option>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <?php
            if ($Coord):
                ?>
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-user"></span>  Cliente
                    </label>
                    <select class="inpt-null" name="iduser">
                        <option></option>
                        <?php
                        $Read = new Read;
                        $Read->FullRead("SELECT * FROM tb_usuarios "
                                . " INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_usuarios.IdEmpresaUsuario "
                                . " WHERE nivel_user < :nivel AND tb_usuarios.IdEmpresaUsuario = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'", "nivel=3");
                        foreach ($Read->getResult() as $d):
                            extract($d);
                            ?>
                            <optgroup label="<?= $NomeEmpresa; ?>">
                                <option value="<?= $IdUsuario; ?>-<?= $IdEmpresa; ?>"><?= $NomeUsuario; ?></option>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input name="IdEmpresaRelatorio" type="hidden" value="<?= $_SESSION['userlogin']['IdEmpresaUsuario']; ?>"/>
                <?php
            endif;
            ?>
            <!--<div class="row-m">-->
            <div class="row-f">
                <label>
                    <span class="lnr lnr-list"></span>   Assunto
                </label>
                <input class="inpt-null" name="assunto" type="text"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-list"></span>  Importância
                </label>
                <select class="inpt-null" name="status_tickets">
                    <option></option>
                    <option value="BAIXA">Baixa</option>
                    <option value="MEDIA">Média</option>
                    <option value="ALTA">Alta</option>
                </select>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Imagem?
                </label>
                <input class="inpt-null" name="file" type="file"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-bubble"></span>   Mensagem
                </label>
                <textarea name="mensagem" class="inpt-null" style="border: 1px solid #aaa; height: 100px"></textarea>
            </div>
            <div class="row-btn">
                <input name="iduser" type="hidden" value="<?= "{$userlogin['IdUsuario']}-{$userlogin['IdEmpresaUsuario']}" ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Solicitar Suporte</button>
            </div>
        </form>
    </div>
</main>
